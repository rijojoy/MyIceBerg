<?php
	/**
	 * Elgg Contacts importer plugin GPL VERSION
	 * This plugin allows users to import contacts from email providers and social networks
	 * @package Elgg Contacts webgalli_importer
	 * Contact : Email - info@webgalli.com , Skype - "team.webgalli"
	 * @license GNU2
	 * @author Sarath C @ Team Webgalli
	 * @link http://webgalli.com/ 
	 */
if (elgg_get_config('allow_registration')) {
	include(elgg_get_plugins_path()  . "importer/vendors/openinviter/example.php"); 
}else {
	echo elgg_echo('invitefriends:registration_disabled');
}
?>