<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../main.inc.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions2.lib.php';

dol_include_once("/servicerestaurant/class/servicerestaurant.class.php");
echo "Bienvenu sur la saisie de commande<br>";
global $db,$conf;

$servicerestaurant= new ControllerServiceRestaurant($db,$confs,$user);
$table_name=new Societe($db);
$table_name->fetch(123);
echo $table_name->name;
echo "<br>".$servicerestaurant->buttonLeaveModule()."<br>";