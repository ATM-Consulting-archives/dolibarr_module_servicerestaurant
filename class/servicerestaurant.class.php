<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
dol_include_once("/commande/class/commande.class.php");
dol_include_once("/categories/class/categories.class.php");
dol_include_once("/user/class/user.class.php");
dol_include_once("/societe/class/client.class.php");
dol_include_once("/product/class/product.class.php");
dol_include_once("/user/class/usergroup.class.php");
/**
 * Description of servicerestaurant
 *
 * @author Clément
 */
class Servicerestaurant {
    
    private $db;
    private $langs;
    private $conf;
    
    /**
     *	Constructor
     *
     *  @param		DoliDB		$db      Database handler
     */
    function __construct($db)
    {
        global $langs, $conf;
        $this->db = $db;

        $this->langs=$lang;
        $this->conf=$conf;

    }
    
    function jeu_essai()
    {
        global $db;
        $usergroup= new UserGroup($db);
        $usergroup->name="Serveurs";
        $usergroup->entity=1;
        $usergroup->note="Les serveurs du restaurant";
        $usergroup->create();
    }
}
