<?php

dol_include_once('/product/class/product.class.php');
dol_include_once('/commande/class/commande.class.php');

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
}