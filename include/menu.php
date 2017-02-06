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
      <a class="navbar-brand" href="#">Restaurant's name</a>


      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $servicerestaurant->buttonLeaveModule(); ?></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
