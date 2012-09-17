<?php

	/**
	 * Setup a users Flickr username
	 * 
	 */

	// Load Elgg engine
	include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php";
	

	
	/* Added By Rijo Joy for Flickr */
	elgg_register_menu_item('title', array(
			'name' => 'flickr_import_photos',
			'href' => 'mod/tidypics/pages/flickr/importPhotosets.php',
			'text' => elgg_echo('images:flickr_import_photos'),
			'link_class' => 'elgg-button elgg-button-action',
	));
	/* End of Added By Rijo Joy */
	
		/* Added By Rijo Joy for Flickr */
	elgg_register_menu_item('title', array(
			'name' => 'flickr_import_settings',
			'href' => 'mod/tidypics/pages/flickr/setup.php',
			'text' => elgg_echo('images:flickr_import_settings'),
			'link_class' => 'elgg-button elgg-button-action',
	));
	/* End of Added By Rijo Joy */
	
	$viewer = get_loggedin_user();
	$action = $vars['url'] . 'mod/tidypics/actions/flickrSetup.php'; // action url
	
	$title = elgg_view_title( elgg_echo( 'flickr:setup') );
	$vars = tidypics_prepare_form_vars();
    $content = elgg_view_form('setupFlickr', array('action' => $action ,'method' => 'post'), $vars);

	//print_r($content);
	
	
	// optionally, add the content for the sidebar
    $sidebar = "";
 
    // layout the page
   $body = elgg_view_layout('two_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));

// var_dump($body); 
// draw the page
echo elgg_view_page($title, $body);
	
	//echo "<pre>"; var_dump($body); echo "</pre>";
	//page_draw(  'flickr:setup', elgg_view_layout("two_column_left_sidebar", '', $body));
?>