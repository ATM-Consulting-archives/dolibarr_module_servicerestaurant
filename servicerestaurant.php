<?php

require('config.php');
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/functions2.lib.php';

dol_include_once('/product/class/product.class.php');
dol_include_once('/commande/class/commande.class.php');

dol_include_once('/servicerestaurant/class/servicerestaurant.class.php');

/*
 * 
 * if(!$user->rights->servicerestaurant->utiliser) accessforbidden();
 * 
 * permet de ne pas autoriser l'accès sans le droit (servicerestaurant->utiliser)
 * TODO créer le droit avant sinon vous serez redirigés à l'accueil
 * 
 */

$langs->load('servicerestaurant@servicerestaurant'); // Charge les clés de traductions du module
$controllerServiceRestaurant = new ControllerServiceRestaurant($db,$conf,$user);
/*
 * 
 * Un exemple de gestion d'action dans la page
$action = __get('action');

switch ($action) 
{
	case 'new_oder':
		$table_id = GETPOST('table'); // GETPOST sert à récuperer via $_GET ou $_POST le paramètre ($_GET['table'])). Comme ça on se pose pas la question
		$result = $controllerServiceRestaurant->generate_order($table_id);
		break;
	default:
		_fiche();
		break;
}

*/

_fiche();

function _fiche() {
	global $langs,$db,$conf,$user,$hookmanager;
	/***************************************************
	* PAGE
	****************************************************/
	
	$parameters = array();
	$reshook = $hookmanager->executeHooks('doActions',$parameters,$assetOf,$mode);    // Note that $action and $object may have been modified by hook
	
	// Include de tout l'aspect html du site
	dol_include_once('/servicerestaurant/tpl/servicerestaurant.tpl.php');
}
