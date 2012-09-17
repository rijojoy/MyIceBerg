<?php

	/**
	 * Elgg diapos plugin
	 *
	 * @package diapos
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Olivier de Lannoy
	 * @copyright 2012
	 */

	// Get the Elgg engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		
		//Link text php file to body and display page
		$body = elgg_view('diapos');
		$title = elgg_echo("diapos");
		// pour V1.8+
		echo elgg_view_page($title, $body);
		//elgg_echo($body);
?>