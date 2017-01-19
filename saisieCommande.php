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
echo "<br>".$servicerestaurant->getRestaurant()->description."<br>";
var_dump($categ);
foreach($categ as $cat)
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
}
echo $servicerestaurant->buttonLeaveModule();
