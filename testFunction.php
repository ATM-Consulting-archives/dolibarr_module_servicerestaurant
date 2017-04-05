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
global $db,$conf;
$id_table=121;
$id_product=131;
$id_categorie=63;

function debug_to_console( $function, $data ) 
{
    $res="<script>console.log('$function: ";
    $output = $data;
    if( $function=="showTables" || $function=="buttonBackToTablePage" || $function=="buttonLeaveModule")
    {
        $output=  'les 50 premiers caractere -> "'. (substr($output, 0, 50)).'"';
    }
    if( $function=="getsAllTables")
    {
        foreach($output as $out)
        {
            $output2[]=$out->id;
        }
        $output=$output2;
    }
    if ( is_array( $output ) )
    {
        $output = implode( ',', $output);
    }
    $res.=$output . "');</script>";
    echo $res;
}

$servicerestaurant= new ControllerServiceRestaurant($db,$confs,$user);

debug_to_console("generate_order",$servicerestaurant->generate_order($id_table));
debug_to_console("update_order",$servicerestaurant->update_order($id_table));
debug_to_console("addProduct",$servicerestaurant->addProduct($id_table,$id_product));
debug_to_console("getProductFromOrder",$servicerestaurant->getProductFromOrder($id_table));
debug_to_console("removeProduct",$servicerestaurant->removeProduct($id_table,$id_product));
debug_to_console("getProductQuantityFromOrder",$servicerestaurant->getProductQuantityFromOrder($id_table,$id_product));
debug_to_console("buttonLeaveModule",$servicerestaurant->buttonLeaveModule());
debug_to_console("buttonBackToTablePage",$servicerestaurant->buttonBackToTablePage());
debug_to_console("getProductStock",$servicerestaurant->getProductStock($id_product));
debug_to_console("getTableName",$servicerestaurant->getTableName($id_table));
debug_to_console("validate_order",$servicerestaurant->validate_order($id_table));
debug_to_console("getAllCommandesInvalidBySociete",$servicerestaurant->getAllCommandesInvalidBySociete($db,$id_table));
debug_to_console("getRestaurant",$servicerestaurant->getRestaurant());
debug_to_console("getAllProductsCategories",$servicerestaurant->getAllProductsCategories());
debug_to_console("getAllProductByCategorie",$servicerestaurant->getAllProductByCategorie($id_categorie));
debug_to_console("init_test_game",$servicerestaurant->init_test_game());
debug_to_console("showTables",$servicerestaurant->showTables());
debug_to_console("getsAllTables",$servicerestaurant->getsAllTables());

?>