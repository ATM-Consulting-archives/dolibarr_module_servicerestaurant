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
$categ=$servicerestaurant->getAllProductsCategories();
//echo "<br>".$servicerestaurant->getRestaurant()->description."<br>";
//var_dump($categ);
foreach($categ as $cat)
{
    $categorie=new Categorie($db);
    $categorie->fetch($cat);
    //echo "<br>$categorie->label:<br>";
    $subCat=$servicerestaurant->getAllProductByCategorie($cat);
    foreach($subCat as $subC)
    {
        $product=new Product($db);
        $product->fetch($subC);
        /*echo ("<div style='text-indent: 15px;'>$product->label :</div> "
                . "<div style='text-indent: 30px;'> -desc : $product->description</div>"
                . "<div style='text-indent: 30px;'> -prix :".substr($product->price,0,5)."&euro;</div>"
                . "<div style='text-indent: 30px;'> -stock :$product->stock_reel</div>");*/

    }
}
$servicerestaurant->generate_order(1);
$Tcmd=$servicerestaurant->getAllCommandesInvalidBySociete($db,1);
//echo("<br>cmd :".$Tcmd[0]);
$id_commande=$servicerestaurant->update_order(1);
//echo "<br>cmd :".$id_commande."<br>";

$servicerestaurant->valiate_order(1);
$Tcmd=$servicerestaurant->getAllCommandesInvalidBySociete($db,1);
//echo("<br>cmd :".$Tcmd[0]);

$table=$servicerestaurant->getsAllTables();

$T_table_id=array();
foreach($table as $t)
{
    $T_table_id[]=$t->id;
}
var_dump($T_table_id);

$servicerestaurant->showTables();
$commande=new Commande($db);
$commande->fetch(29);
foreach($commande->lines as $line)
{
    print_r($line->ref);
}
$p= new Product($db);
$p->fetch(2);
echo $p->ref;
$t=$servicerestaurant->addProduct(29,4);
echo "<br>return:".$t."<br>".$servicerestaurant->addProduct(29,4)."<br>";
foreach($commande->lines as $line)
{
    print_r($line->id);
}
echo $servicerestaurant->buttonLeaveModule()."<br>";
/*$all_cat=$servicerestaurant->getAllProductOrderByCategorie();
foreach($all_cat as $cat)
{
    $categorie=new Categorie($db);
    $categorie->fetch($cat);
    echo "<br>$categorie->label:<br>";
    $subCat=$servicerestaurant->getAllProductByCategorie($cat);
    foreach($subCat as $subC)
    {
        $product=new Product($db);
        $product->fetch($subC);
        echo ("<div style='text-indent: 15px;'>$product->label :</div> "
                . "<div style='text-indent: 30px;'> -desc : $product->description</div>"
                . "<div style='text-indent: 30px;'> -prix :".substr($product->price,0,5)."&euro;</div>"
                . "<div style='text-indent: 30px;'> -stock :$product->stock_reel</div>");

    }
}*/