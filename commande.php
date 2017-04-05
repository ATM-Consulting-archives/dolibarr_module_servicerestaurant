<?php
require('config.php');
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions2.lib.php';

dol_include_once('/product/class/product.class.php');
dol_include_once('/commande/class/commande.class.php');

dol_include_once('/servicerestaurant/class/servicerestaurant.class.php');

$langs->load('servicerestaurant@servicerestaurant'); // Charge les clés de traductions du module
$controllerServiceRestaurant = new ControllerServiceRestaurant($db, $conf, $user);

include_once('include/menu.php');
$action = GETPOST('action', 'alpha');
$fk_product = GETPOST('fk_product', 'int');
$fk_table = GETPOST('fk_table', 'int');
$fk_categorie = GETPOST('fk_categorie', 'int');
$button_table = $controllerServiceRestaurant->buttonBackToTablePage();
$button_dolibarr = $controllerServiceRestaurant->buttonLeaveModule();
$restaurantName = $controllerServiceRestaurant->getRestaurant()->description;
$categories = $controllerServiceRestaurant->getAllProductsCategories();
$table_name = $controllerServiceRestaurant->getTableName($fk_table);
$T_Order = $controllerServiceRestaurant->getAllCommandesInvalidBySociete($db, $fk_table);
if ($action == 'add') {
    $controllerServiceRestaurant->addProduct($fk_table, $fk_product);
}
if ($action == 'rem') {
    $controllerServiceRestaurant->removeProduct($fk_table, $fk_product);
}
if ($action == 'valid') {
    $controllerServiceRestaurant->validate_order($fk_table);
    header('Location:' . dol_buildpath("/servicerestaurant/tables.php", 1));
}
?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img alt="logo" src="img/logo.png">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <a class="navbar-brand col-lg-2 col-md-2 col-sm-2 col-xs-12" href="#"><?php echo $restaurantName; ?></a>
            <a class="navbar-brand text-center col-lg-3 col-md-3 col-sm-3 col-xs-12" href="#">Commande <?php echo $table_name; ?></a>
<?php echo $button_dolibarr ?>
<?php echo $button_table; ?>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="main-wrap">
    <!-- Ouvrir / Fermer le menu sidebar catégories roduits -->
    <input id="slide-sidebar" type="checkbox" role="button" />
    <label for="slide-sidebar"></label>

    <!-- Menu sidebar catégories roduits -->
    <div class="sidebar">

        <ul>
<?php
if ($T_Order != array()) {
    echo '<a href="commande.php?fk_categorie=0&fk_table=' . $fk_table . '" name="Résumé"><li>Résumé</li></a>';
}

foreach ($categories as $cat) {
    $categorie = new Categorie($db);
    $categorie->fetch($cat);
    $id_categorie = $categorie->id;
    $label_categorie = $categorie->label;
    echo "<a href=\"commande.php?fk_categorie=$cat&fk_table=$fk_table\" name=\"$id_categorie\"><li>$label_categorie</li></a>";
}
?>
        </ul>
    </div>

    <!-- Titre -->
    <div class="main-container">


        <div id="allProducts" >
<?php
if ($fk_categorie == 0) {
    $Tproduct = $controllerServiceRestaurant->getProductFromOrder($fk_table);
    foreach ($Tproduct as $product_id) {
        $product = new Product($db);
        $product->fetch($product_id);
        $productStockReel = $product->stock_reel;
        $productStock = $controllerServiceRestaurant->getProductStock($product_id);
        $label_product = $product->label;
        $description_product = $product->description;
        $id_product = $product->id;
        $productQtyFromOrder = $controllerServiceRestaurant->getProductQuantityFromOrder($fk_table, $id_product);
        if (!is_numeric($productStock)) {
            $productStock = 0;
        }
        if ($productStock > 0) {
            echo '<section id="section"class="col-lg-12 col-sm-12 produits" >';
        }
        if ($productStock == 0) {
            echo '<section id="section"class="col-lg-12 col-sm-12 produits-out">';
        }
        ?>
                    <div class="col-lg-4 col-sm-12">
                        <h3><?php echo $label_product; ?></h3>
                        <p><?php echo $description_product; ?></p>
                        <p><br><b>Stock disponible : <br><span type="text" name="stock"><?php echo $productStockReel . ' (' . $productStock . " restant(s))"; ?></span></b></p>
                    </div>
                    <div class="col-lg-4 col-sm-12" style="height: 120px;">
                    <?php
                    if ($productStock > 0) {
                        echo '<textarea class="col-lg-12 infos-sup" name="name" rows="8" cols="80" placeholder="Ajouter des informations complémentaires"></textarea>';
                    }
                    ?>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <a class="link-boutons" href="commande.php?fk_categorie=0&action=rem&fk_product=<?php echo $id_product; ?>&fk_table=<?php echo $fk_table; ?>">
                            <div class="col-lg-4 col-sm-4 boutons">
                                -
                            </div>
                        </a>
                        <div class="col-lg-4 col-sm-4 count">
                        <?php echo $productQtyFromOrder; ?>
                        </div>
                        <a class="link-boutons" href="commande.php?fk_categorie=0&action=add&fk_product=<?php echo $id_product; ?>&fk_table=<?php echo $fk_table; ?>">
                            <div class="col-lg-4 col-sm-4 boutons">
                                +
                            </div>
                        </a>
                    </div>
                    </section>
        <?php
    }
}
foreach ($categories as $cat) {
    $categorie->fetch($cat);
    if ($fk_categorie == $categorie->id) {
        $Tproduct = $controllerServiceRestaurant->getAllProductByCategorie($fk_categorie);
        foreach ($Tproduct as $product_id) {
            $product = new Product($db);
            $product->fetch($product_id);
            $productStockReel = $product->stock_reel;
            $productStock = $controllerServiceRestaurant->getProductStock($product_id);
            $label_product = $product->label;
            $description_product = $product->description;
            $id_product = $product->id;
            $productQtyFromOrder = $controllerServiceRestaurant->getProductQuantityFromOrder($fk_table, $id_product);
            if (!is_numeric($productStock)) {
                $productStock = 0;
            }
            if ($productStock > 0) {
                echo '<section id="section"class="col-lg-12 col-sm-12 produits">';
            }
            if ($productStock == 0) {
                echo '<section id="section"class="col-lg-12 col-sm-12 produits-out">';
            }
            ?>
                        <div class="col-lg-4 col-sm-12">
                            <h3><?php echo $label_product; ?></h3>
                            <p><?php echo $description_product; ?></p>
                            <p><br><b>Stock disponible : <br><span type="text" name="stock"><?php echo $productStockReel . ' (' . $productStock . " restant(s))"; ?></span></b></p>
                        </div>
                        <div class="col-lg-4 col-sm-12" style="height: 120px;">
                        <?php
                        if ($productStock > 0) {
                            echo '<textarea class="col-lg-12 infos-sup" name="name" rows="8" cols="80" placeholder="Ajouter des informations complémentaires"></textarea>';
                        }
                        ?>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <a class="link-boutons" href="commande.php?fk_categorie=<?php echo $fk_categorie; ?>&action=rem&fk_product=<?php echo $id_product; ?>&fk_table=<?php echo $fk_table; ?>">
                                <div class="col-lg-4 col-sm-4 boutons">
                                    -
                                </div>
                            </a>
                            <div class="col-lg-4 col-sm-4 count">
            <?php echo $productQtyFromOrder; ?>
                            </div>
                            <a class="link-boutons" href="commande.php?fk_categorie=<?php echo $fk_categorie; ?>&action=add&fk_product=<?php echo $id_product; ?>&fk_table=<?php echo $fk_table; ?>">
                                <div class="col-lg-4 col-sm-4 boutons">
                                    +
                                </div>
                            </a>
                        </div>
                        </section>
            <?php
        }
    }
}
?>
        </div> <!-- All Products -->

    </div>
</div>

<script src="less/dist/less.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo dol_buildpath("/core/js/jnotify.js", 1); ?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<!-- <script src="js/color.js"></script> -->
<script src="js/cat.js"></script>
<!-- <script src="js/buttons.js"></script> -->

</body>
</html>
