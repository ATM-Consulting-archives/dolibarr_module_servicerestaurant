<?php



dol_include_once('/product/class/product.class.php');
dol_include_once('/commande/class/commande.class.php');
dol_include_once("/categories/class/categorie.class.php");
dol_include_once("/user/class/user.class.php");
dol_include_once("/societe/class/client.class.php");
dol_include_once("/user/class/usergroup.class.php");
dol_include_once("/product/stock/class/entrepot.class.php");

class ControllerServiceRestaurant
{
	// Privates var
	private $db;

	// Publics var
	public $conf;
	public $user;


	/**
	 *	Constructor
	 *
	 * @param	$db		DataBase	Dolibarr Database Object
	 * @param	$conf	array()		Array with all Dolibarr configs
	 * @param	$user	User		Dolibarr User Object
	 */
	function __construct($db,$conf,$user) {
		$this->db = $db;
		$this->conf = $conf;
		$this->user = $user;
	}

	/**
	 *	Function generate_order
	 * @param	$table_id	Societe		Dolibarr Societe Object
	 *
	 * @return	int		(0 = error, 0 < OK)
	 */
	function generate_order($table_id)
        {
            $commande = new Commande($this->db);
            $Tid_OrderBySociete=$this->getAllCommandesInvalidBySociete($this->db,$table_id);
            if(sizeof($Tid_OrderBySociete)==0)
            {
                $commande->socid=$table_id;
                $commande->date=time();
                $commande->create($this->user);
                return $commande->rowid;
            }
            else
            {
                echo "Une commande est déjà en cour de saisie sur cette table. ";
                return 0;
            }
	}

        /**
	 *	Function update_order
	 * @param	$table_id	Societe		Dolibarr Societe Object
	 *
	 * @return	int		(0 = error, 0 < OK)
	 */
	function update_order($table_id)
        {
            $Tid_commande=$this->getAllCommandesInvalidBySociete($this->db,$table_id);
            $id_commande=$Tid_commande[0];
            $commande= new Commande($this->db);
            $error_commande=$commande->fetch($id_commande);
            if($error_commande<0)
            {
                return 0;
            }
            return $commande->id;
        }

        /**
	 *	Function valiate_order
	 * @param	$table_id	Societe		Dolibarr Societe Object
	 *
	 * @return	int		(0 = error, 1 = OK)
	 */
	function validate_order($table_id)
        {
            $commande= new Commande($this->db);
            $id_commande=$this->getAllCommandesInvalidBySociete($this->db,$table_id)[0];
            $error_commande=$commande->fetch($id_commande);
            if($error_commande<0)
            {
                return 0;
            }
            $commande->valid($this->user);
            return 1;
        }

        /**
	 *	Function getAllCommandesInvalidBySociete
         * @param       $db             Database
	 * @param   	$table_id	Societe		Dolibarr Societe Object
         *
	 *
	 * @return	array() with all rowid of invalid order
	 */
        function getAllCommandesInvalidBySociete($db,$table_id)
        {
            $sql="Select rowid from ".MAIN_DB_PREFIX."commande where fk_soc=$table_id and fk_statut=0;";
            $stmt=$db->query($sql);
            $Tid_order=array();
            if($stmt->num_rows==0)
            {
                return array();
            }
            foreach($stmt as $row)
            {
                $Tid_order[]=$row['rowid'];
            }
            return $Tid_order;
        }

        /**
	 *	Function getRestaurant
	 *
	 * @return	the id of the Restaurant
	 */
        function getRestaurant()
        {
            $restaurant=new Categorie($this->db);
            $cat_error=$restaurant->fetch('', "Restaurant");
            if($cat_error>0)
            {
                return $restaurant;
            }
            else
            {
                return -1;
            }
        }

        /**
	 *	Function getAllProductsCategories
	 *
	 * @return	array() with all rowid of products categorie
	 */
        function getAllProductsCategories()
        {
            $res=array();
            $categorie=new Categorie($this->db);
            $cat_error=$categorie->fetch('',"Restaurant");
            if($cat_error>0)
            {
                $Tcateg=$categorie->get_filles();
                foreach($Tcateg as $categ)
                {
                    $res[]=$categ->id;
                }
                asort($res);
                return ($res);
            }
            return "Creer une Catégorie \"Restaurant\"";
        }

        /**
	 *	Function getAllProductsCategories
         * @param       $id_categorie             Categorie		Dolibarr Categorie Object
         *
	 *
	 * @return	array() with all rowid of products of the categorie set
	 */
        function getAllProductByCategorie($id_categorie)
        {
            $res=array();
            $categorie=new Categorie($this->db);
            $cat_error=$categorie->fetch($id_categorie);
            if($cat_error>0)
            {
                $Tproduct=$categorie->getObjectsInCateg("product");
                foreach($Tproduct as $product)
                {
                    $res[$product->label.$product->id]=$product->id;
                }
                asort($res);
                return ($res);
            }
            return $res;
        }/**
	 *	Function getAllProductOrderByCategorie
         *
	 *
	 * @return	array() with all rowid of products of the restaurant
	 */
        function getAllProductOrderByCategorie()
        {
            $res=array();
            $Tcategorie_restaurant=$this->getAllProductsCategories();
            foreach($Tcategorie_restaurant as $id_categorie)
            {
                $Tid_categorie=$this->getAllProductByCategorie($id_categorie);
                foreach($Tid_categorie as $id_product_by_categorie)
                {
                    $res[]=$id_product_by_categorie;
                }
            }
            return $res;
        }

        function init_test_game()
        {
            $usergroup= new UserGroup($this->db);
            $usergroup->fetch('',"Serveurs");
            if(!isset($usergroup->nom) || $usergroup->nom !="Serveurs")
            {
                $this->test_game();
            }
        }

        function test_game()
        {
            $admin=new User($this->db);
            $admin->fetch(1);
            $this->TestGameUserAndUsergroup($this->db,$admin);
            $this->TestGameSocieteAndCategories($this->db,$admin);
            $this->TestGameProductAndCategories($this->db,$admin);
        }

        function TestGameUserAndUsergroup($db,$admin)
        {
            $usergroup= new UserGroup($db);
            $usergroup->name="Serveurs";
            $usergroup->entity=1;
            $usergroup->note="Les serveurs du restaurant";
            $usergroup->create();
            $id_group=$usergroup->id;

            $Ids_right=array(11,12,31,81,82,87,121,122,21,342,343,1001);
            foreach ($Ids_right as $id_right)
            {
                $usergroup->addrights($id_right);
            }

            $user=new User($db);
            $user->login="Serveur1";
            $user->lastname="serveur";
            $user->firstname="test";
            $user->entity=1;
            $user->pass="";
            $user->create($admin);
            $user->SetInGroup($id_group,1);
        }

        function TestGameSocieteAndCategories($db,$admin)
        {
            $categorie=new Categorie($db);
            $categorie->entity=1;
            $categorie->fk_parent=0;
            $categorie->label="Tables";
            $categorie->type=2;
            $categorie->description="Liste des tables du restaurant";
            $categorie->visible=0;
            $categorie->create($admin);
            $id_categorie=$categorie->id;

            for ($i=1;$i<11;$i++)
            {
                $societe=new Societe($db);
                $societe->nom="Table $i";
                $societe->client=1;
                $societe->create($admin);
                $societe->setCategories($id_categorie, 'customer');
            }
        }

        function TestGameProductAndCategories($db,$admin)
        {
            $entrepot=new Entrepot($db);
            $entrepot->libelle="E1";
            $entrepot->description="Entrepot 1";
            $entrepot->statut=1;
            $entrepot->tosell=1;
            $entrepot->tobuy=1;
            $entrepot->country_id=1;
            $entrepot->create($admin);
            $id_entrepot=$entrepot->id;

            $mainCategorie=new Categorie($db);
            $mainCategorie->entity=1;
            $mainCategorie->fk_parent=0;
            $mainCategorie->label="Restaurant";
            $mainCategorie->type=0;
            $mainCategorie->description="Les produits du restaurant";
            $mainCategorie->visible=0;
            $mainCategorie->create($admin);
            $id_mainCategorie=$mainCategorie->id;

            $categProduct=array(
                array("Apéritifs", "Les apéritifs du restaurant", "A", "Apéritif"),
                array("Entrées", "Les entrées du restaurant", "E", "Entrée"),
                array("Plats", "Les plats du restaurant", "P" ,"Plat"),
                array("Desserts", "Les desserts du restaurant", "D" ,"Dessert"),
                array("Vins", "Les vins du restaurant", "V" ,"Vin"),
                array("Boissons", "Les boissons du restaurant", "B" ,"Boisson")
            );
            foreach ($categProduct as $categName)
            {
                $categorie=new Categorie($db);
                $categorie->entity=1;
                $categorie->fk_parent=$id_mainCategorie;
                $categorie->label=$categName[0];
                $categorie->type=0;
                $categorie->description=$categName[1];
                $categorie->visible=0;
                $categorie->create($admin);
                $id_categorie=$categorie->id;

                for ($i=1;$i<4;$i++)
                {
                    $product=new Product($db);
                    $product->ref="$categName[2]$i";
                    $product->stock_reel=10;
                    $product->label="$categName[3] $i";
                    $product->tosell=1;
                    $product->tobuy=1;
                    $product->create($admin);
                    $product->setCategories($id_categorie);
                    $product->correct_stock($admin, $id_entrepot, 10, 0);
                }
            }
        }

        function showTables(){
                $html='';
        	$tables=$this->getsAllTables();
        	foreach ($tables as $tab){
                    if($this->getAllCommandesInvalidBySociete($this->db, $tab->id)== array())
                    {
                        $html.= "<div class=\"container-square\" name=\"libre\">";
                    }
                    else
                    {
                        $html.= "<div class=\"container-square\" name=\"occupe\">";
                    }
                    $html.="<div class=\"square\" style=\"background-size: cover;\">
                                <a href=\"#\" data-toggle=\"modal\" data-target=\"\" id=\"table_".$tab->id."\" class=\"table\">
                                    <div class=\"square__content\">
                                        $tab->name
                                    </div>
                                </a>
                            </div>
                        </div>";
        	}
                echo $html;

        }
        /**
         * @return all the tables in an array
         */

        function getsAllTables(){
            $categorie= new Categorie($this->db);
            $error_categorie=$categorie->fetch("","Tables");
            if($error_categorie<0) return 0;
            $T_Table=$categorie->getObjectsInCateg("customer");
            return $T_Table;

        }
        /**
         *
         * @param $table_id id of table
         * @param $id_product  id of the product we add to the order
	 *
	 * @return	int		(0 <= error, 1 = OK)
         */
        function addProduct($table_id, $id_product){
            $commande = new Commande($this->db);
            $commande_id=$this->getAllCommandesInvalidBySociete($this->db, $table_id)[0];
            if($commande_id=='')
            {
                $this->generate_order($table_id);
                $this->addProduct($table_id, $id_product);
            }
            $error_commande=$commande->fetch($commande_id);
            if($error_commande<0)
            {
                return -1;
            }
            $product=new Product($this->db);
            $error_product=$product->fetch($id_product);
            if($error_product<0)
            {
                return -2;
            }
            foreach($commande->lines as $line)
            {
                if($line->fk_product == $id_product)
                {
                    $commande->updateline($line->id, '', $product->price, $line->qty+1, 0, $product->tva_tx);
                    return $line->qty+1;
                }
            }
            $commande->addline('', $product->price, 1, $product->tva_tx, 0, 0, $product->id, 0, 0, 0, 'HT', 0, '', '', 0, -1, 0, 0,null, 0, $label='');
            return 1;
        }

        /**
         *
         * @param $table_id id of table
         * @param $id_product  id of the product we remove from the order
         *
	 * @return	int		(0 < error, 0 <= OK)
         */
        function removeProduct($table_id,$id_product)
        {
            $commande = new Commande($this->db);
            $commande_id=$this->getAllCommandesInvalidBySociete($this->db, $table_id)[0];
            $error_commande=$commande->fetch($commande_id);
            if($error_commande<0)
            {
                return -1;
            }
            $product=new Product($this->db);
            $error_product=$product->fetch($id_product);
            if($error_product<0)
            {
                return -2;
            }
            foreach($commande->lines as $line)
            {
                if($line->fk_product == $id_product)
                {
                    if($line->qty>1)
                    {
                        $commande->updateline($line->id, '', $product->price, $line->qty-1, 0, $product->tva_tx);
                        return $line->qty-1;
                    }
                    else
                    {
                        $commande->deleteline($line->id);
                        return 0;
                    }
                }
            }
        }

        /**
	 *	Function getProductFromOrder
	 * @param	$table_id	Societe		Dolibarr Societe Object
	 *
	 * @return	array with all rowid of the product in the order
	 */
        function getProductFromOrder($table_id)
        {
            $commande= new Commande($this->db);
            $id_commande=$this->getAllCommandesInvalidBySociete($this->db, $table_id)[0];
            $error_commande=$commande->fetch($id_commande);
            if($error_commande<0)
            {
                return array();
            }
            $T_id_product=array();
            foreach($commande->lines as $line)
            {
                $product= new Product($this->db);
                $product->fetch($line->fk_product);
                $T_id_product[]=$product->id;
            }
            return $T_id_product;
        }

        function getProductQuantityFromOrder($table_id, $id_product){
            $commande = new Commande($this->db);
            $commande_id=$this->getAllCommandesInvalidBySociete($this->db, $table_id)[0];
            if($commande_id=='')
            {
                return 0;
            }
            $error_commande=$commande->fetch($commande_id);
            if($error_commande<0)
            {
                return -1;
            }
            $product=new Product($this->db);
            $error_product=$product->fetch($id_product);
            if($error_product<0)
            {
                return -2;
            }
            foreach($commande->lines as $line)
            {
                if($id_product==$line->fk_product)
                {
                    return $line->qty;
                }
            }
            return 0;
        }

        function buttonLeaveModule()
        {
            return "<a href='".DOL_URL_ROOT."'>Retour vers Dolibarr</a>";
        }

        function buttonBackToTablePage()
        {
            return "<a href='".dol_buildpath("servicerestaurant/tables.php",1)."'>Retour vers la séléction des tables</a>";
        }
}
