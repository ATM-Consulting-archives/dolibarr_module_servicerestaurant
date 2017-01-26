<?php include_once('include/menu.php'); ?>

      <!-- MODAL A : Prendre une nouvelle commande -->
      <div class="modal fade position-modal" id="myModalNew" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <a href="commande.php"><button type="button" class="btn btn-default bouton col-lg-12 col-md-12 col-sm-12 col-xs-12" >Nouvelle</button></a>
        </div>
      </div> <!-- /. Fin Modal -->

      <!-- MODAL B : Une commande a déjà eu lieu et on peut la modifier ou la valider
      Nécessite : - Une redirection vers la commande séléctionnée-->
      <div class="modal fade position-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <!-- Récupérer le numéro de la commande -->
          <a href="commande.php?numCom=<?php echo $servicerestaurant->update_order(2);?>"><button type="button" class="btn btn-default bouton col-lg-12 col-md-12 col-sm-12 col-xs-12">Modifier</button></a>
          <a href="#" data-target="#myModalVerif" data-toggle="modal" data-dismiss="modal"><button type="button" class="btn btn-default bouton col-lg-12 col-md-12 col-sm-12 col-xs-12">Terminer</button></a>
        </div>
      </div> <!-- /. Fin Modal -->

      <!-- Modal de vérificatino -->
      <div class="modal fade position-modal" id="myModalVerif" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <h2 class="text-center" style="color: white;">Cette action va réinitialiser la table. Êtes-vous sur de vouloir continuer ?</h2>
            <!-- onClick : vider la table -->
          <button onclick="" type="button" class="btn btn-default bouton col-lg-12 col-md-12 col-sm-12 col-xs-12">OUI</button></a>
          <button type="button" class="btn btn-default bouton col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal">NON</button>
        </div>
      </div> <!-- /. Fin Modal -->

      <!-- Titre -->
      <h2 class="text-center title">
        Choisissez une table<br>
        <span class="fa-stack ">
            <i class="fa fa-angle-down fa-stack-2x faa-float animated blue"></i>
        </span>
      </h2>

      <!-- Légende couleurs -->
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1 legend">
          <div class="col-lg-6 text-center occupe">
            <p>Occupé</p>
          </div>
          <div class="col-lg-6 text-center libre">
            <p>Libre</p>
          </div>
        </div>
      </div>

      <!-- Liste de tables -->
      <div class="flux-cat col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 ">
        <div class="row">
          <div class="row">
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  <?php echo $servicerestaurant->update_order(2);?>
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="libre">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="libre">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="row">
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="row">
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="occupe">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
            <div class="container-square" name="libre">
              <div class="square" style="background-size: cover;">
                <a href="#" data-toggle="modal" data-target="">
                <div class="square__content">
                  TABLE
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="less/dist/less.js" type="text/javascript"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/etatTable.js"></script>

  </body>
</html>
