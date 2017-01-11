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
/**
 * Description of servicerestaurant
 *
 * @author Clément
 */
class Servicerestaurant {
    
    
    
    /**
     *	Constructor
     *
     *  @param		DoliDB		$db      Database handler
     */
    function __construct()
    {
        global $langs, $conf, $db;
        $this->db = $db;

        $this->langs=$lang;
        $this->conf=$conf;

    }
}
