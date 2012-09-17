<?php

	/**
	 * Elgg diapos plugin
	 *
	 * @package Diapos
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author O. de Lannoy
	 * @copyright 2012
	 */

	/**
	 * init function; 
	 *
	 */
		function diapos_init() {

			// Get config
				global $CONFIG;

			 register_page_handler('diapos','diapos_page_handler');
				
			// Add menu link
				add_menu(elgg_echo('diapos'), $CONFIG->wwwroot . "pg/diapos/");
				
				}

					function diapos_page_handler($page)
						{
							global $CONFIG;
							switch ($page[0])
							{
								default:
									include $CONFIG->pluginspath . 'diapos/index.php';
									break;	
							}
							exit;
						}

				
		register_elgg_event_handler('init', 'system', 'diapos_init');
?>