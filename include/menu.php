<!DOCTYPE html>
<html lang="en">
<head>
    <title>Module restauration</title>
    <meta charset="UTF-8">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome-animation.min.css">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link rel="stylesheet/less" type="text/css" href="style/style.less" />
    <link rel="stylesheet/less" type="text/css" href="style/menu.less" />

</head>
<body>
  <?php
    require '../main.inc.php';
    require_once DOL_DOCUMENT_ROOT . '/core/lib/functions.lib.php';
    require_once DOL_DOCUMENT_ROOT . '/core/lib/functions2.lib.php';

    dol_include_once("/dolibarr_module_servicerestaurant/class/servicerestaurant.class.php");

    global $db,$conf;

    $servicerestaurant= new ControllerServiceRestaurant($db,$confs,$user);

    ?>
