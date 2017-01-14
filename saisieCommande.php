<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../main.inc.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions2.lib.php';

dol_include_once("/dolibarr_module_servicerestaurant/class/servicerestaurant.class.php");
echo "Bienvenu sur la saisie de commande";
global $db,$conf;

$servicerestaurant= new ControllerServiceRestaurant($db,$confs,$user); 
$servicerestaurant->generate_order(1);