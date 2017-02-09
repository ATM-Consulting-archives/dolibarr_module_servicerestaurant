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
//$servicerestaurant->generate_order(1);
//$Tcmd=$servicerestaurant->getAllCommandesInvalidBySociete($db,1);
//echo("<br>cmd :".$Tcmd[0]);
//$id_commande=$servicerestaurant->update_order(1);
//echo "<br>cmd :".$id_commande."<br>";

//$servicerestaurant->valiate_order(1);
//$Tcmd=$servicerestaurant->getAllCommandesInvalidBySociete($db,1);
//echo("<br>cmd :".$Tcmd[0]);

$table=$servicerestaurant->getsAllTables();

$T_table_id=array();
foreach($table as $t)
{
    $T_table_id[]=$t->id;
}
$prodfuct=new Product($db);
$product->fetch(1);
//echo "<br>".$product->ref." - ".$product->label."<br>";
$servicerestaurant->showTables();
$id_commande=$servicerestaurant->validate_order(1);
$commande=new Commande($db);
//$commande->fetch($id_commande);
//$servicerestaurant->addProduct(1,4);
//$servicerestaurant->addProduct(1,1);
//$servicerestaurant->addProduct(1,5);
//uncomment the 3 ligne to remove product
//$servicerestaurant->removeProduct(1,4);
//$servicerestaurant->removeProduct(1,1);
//$servicerestaurant->removeProduct(1,5);
$commande->fetch($id_commande);
echo "<br>";
foreach($commande->lines as $line)
{
    echo "$line->description<br>"
         ."qty : $line->qty<br>";
}
/*
 * test Categ Résumé -> list de produit 
*/
$T_id_product=$servicerestaurant->getProductFromOrder(1);
foreach($T_id_product as $subC)
{
    $product=new Product($db);
    $product->fetch($subC);
    echo ("<div style='text-indent: 15px;'>$product->label :</div> "
            . "<div style='text-indent: 30px;'> -desc : $product->description</div>"
            . "<div style='text-indent: 30px;'> -prix :".substr($product->price,0,5)."&euro;</div>"
            . "<div style='text-indent: 30px;'> -stock :$product->stock_reel</div>");

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