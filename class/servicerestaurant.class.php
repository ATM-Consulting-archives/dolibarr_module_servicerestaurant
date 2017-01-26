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
	function valiate_order($table_id)
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
            $sql="Select rowid from ".MAIN_DB_PREFIX."commande where fk_soc= $table_id and fk_user_valid is null order by date_creation DESC;";
            $stmt=$this->db->query($sql);
            $Tid_order;
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
            else return -1;
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
                $Tcateg=$categorie->getObjectsInCateg("product");
                foreach($Tcateg as $categ)
                {
                    $res[]=$categ->id;
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
            if(!isset($usergroup->nom) && $usergroup->nom !="Serveurs")
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
            $id_group=$usergroup->create();

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
            $id_categorie=$categorie->create($admin);

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
            $id_entrepot=$entrepot->create($admin);

            $mainCategorie=new Categorie($db);
            $mainCategorie->entity=1;
            $mainCategorie->fk_parent=0;
            $mainCategorie->label="Restaurant";
            $mainCategorie->type=0;
            $mainCategorie->description="Les produits du restaurant";
            $mainCategorie->visible=0;
            $id_mainCategorie=$mainCategorie->create($admin);

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
                $id_categorie=$categorie->create($admin);

                for ($i=1;$i<4;$i++)
                {
                    $product=new Product($db);
                    $product->ref="$categName[2]$i";
                    $product->stock=10;
                    $product->label="$categName[3] $i";
                    $product->create($admin);
                    $product->setCategories($id_categorie);
                    $product->correct_stock($admin, $id_entrepot, 10, 0);
                }
            }
        }

        function buttonLeaveModule()
        {
            return "<a href='".DOL_URL_ROOT."'>Retour vers Dolibarr</a>";
        }
        
        function showTables(){
        	$tables=getAllTables();
        	foreach ($tables as $tab){
        		echo"<input type='button' name='".$tab->name."' value='".$tab->name."' onclick='".Order()."' >";
        	}
        
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
         * @param $idcommande id of order
         * @param $idproduct  id of the product we add to the order
         */
        function addProduct($idord, $idproduct){
        	if(!getLines($idord)){
        		post($idord);
        	}
        	if(!getLine($idord,$idproduct)){
        		postLine($idord, $idproduct);}
        		else{
        			$prod=get($idord,$idproduct);
        			$prod->qty=$prod->qty+1;
        			putLine($idord,$idproduct,$prod);
        		}
        }
        
        /**
         *
         * @param $idcommande id of order
         * @param $idproduct  id of the product we remove from the order
         */
        function removeProduct($idord,$idprod){
        	if(getLine($idord,$idprod)){
        		$product=getLine($idord,$idprod);
        		if($product->qty>1){
        			$product->qty=$product->qty-1;
        			putLine($idord,$idproduct,$product);
        			return $product->qty;
        		}
        		else{delLine($idord,$idprod);
        		}
        	}
        	return 0;
        }
}
