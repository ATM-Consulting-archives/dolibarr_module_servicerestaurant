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
	 *	Function generate_first_usecase
	 * 
	 * Generate defaults products ... to test this module.
	 * 
	 * @return	int		(0 = error, 1 = OK)
	 */
	function generate_first_usecase() {
		$product = new Product($this->db);
		// TODO generate products
		
	}
	
	/**
	 *	Function generate_order
	 * @param	$table_id	Societe		Dolibarr Societe Object
	 * 
	 * @return	int		(0 = error, 1 = OK)
	 */
	function generate_order($table_id) {
		$commande = new Commande($this->db);
		// TODO generate order
		
	}
        
        function init_test_game()
        {
            $usergroup= new UserGroup($this->db);
            $usergroupTest=$usergroup->fetch('',"Serveurs");
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
            //$this->TestGameSocieteAndCategories($this->db,$admin);
            //$this->TestGameProductAndCategories($this->db,$admin);
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
            $entrepot->country_id=1;
            $id_entrepot=$entrepot->create($admin);
            
            $categProduct=array(
                array("Entrees", "Les entrees du restaurant", "E", "Entree"),
                array("Plats", "Les plats du restaurant", "P" ,"Plat"),
                array("Desserts", "Les desserts du restaurant", "D" ,"Dessert")
            );
            foreach ($categProduct as $categName)
            {
                $categorie=new Categorie($db);
                $categorie->entity=1;
                $categorie->fk_parent=0;
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
}
