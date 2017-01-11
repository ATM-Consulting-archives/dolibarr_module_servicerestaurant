<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file		lib/servicerestaurant.lib.php
 *	\ingroup	servicerestaurant
 *	\brief		This file is an example module library
 *				Put some comments here
 */


require_once '/societe/class/api_contact.class.php';

function servicerestaurantAdminPrepareHead()
{
    global $langs, $conf;

    $langs->load("servicerestaurant@servicerestaurant");

    $h = 0;
    $head = array();

    $head[$h][0] = dol_buildpath("/servicerestaurant/admin/servicerestaurant_setup.php", 1);
    $head[$h][1] = $langs->trans("Parameters");
    $head[$h][2] = 'settings';
    $h++;
    $head[$h][0] = dol_buildpath("/servicerestaurant/admin/servicerestaurant_about.php", 1);
    $head[$h][1] = $langs->trans("About");
    $head[$h][2] = 'about';
    $h++;

    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    //$this->tabs = array(
    //	'entity:+tabname:Title:@servicerestaurant:/servicerestaurant/mypage.php?id=__ID__'
    //); // to add new tab
    //$this->tabs = array(
    //	'entity:-tabname:Title:@servicerestaurant:/servicerestaurant/mypage.php?id=__ID__'
    //); // to remove a tab
    complete_head_from_modules($conf, $langs, $object, $head, $h, 'servicerestaurant');

    return $head;
}

/**
 * @return all the tables in an array
 */

function getsAllTables(){
	$tables=getList();
	
	return $tables;
	
}

function showTables(){
	$tables=getAllTables();
	foreach ($tables as $tab){
		echo"<input type='button' name='".$tab->name."' value='".$tab->name."' onclick='".Order()."' >";
	}

}