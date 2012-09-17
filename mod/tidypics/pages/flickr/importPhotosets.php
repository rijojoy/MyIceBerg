<?php

	/**
	 * Import a set of photos from Flickr
	 */

	// Load Elgg engine
	include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php";
	$body = elgg_view_title( elgg_echo( 'flickr:importmanager' ));
	$body .= "<h2>" . elgg_echo( 'flickr:desc' ) . "</h2>";
	
	$viewer = elgg_get_logged_in_user_entity();
	
	require_once dirname(dirname(dirname(__FILE__))) . "/lib/phpFlickr/phpFlickr.php";
	require_once( dirname(dirname(dirname(__FILE__)))) . "/lib/flickr.php";
	$f = new phpFlickr("26b2abba37182aca62fe0eb2c7782050");
	
	$viewer = elgg_get_logged_in_user_entity();
	/* Deprecated 
	
	$flickr_username = get_metadata_byname( $viewer->guid, "flickr_username" );
	$flickr_id = get_metadata_byname( $viewer->guid, "flickr_id" );
	$album_id = get_metadata_byname( $viewer->guid, "flickr_album_id" );
	
	*/
	
	$flickr_username = elgg_get_metadata(array(
			'guid' => $viewer->guid,
			'metadata_name' => 'flickr_username'
		));
	
	
	$flickr_id = elgg_get_metadata(array(
			'guid' => $viewer->guid,
			'metadata_name' => 'flickr_id'
		));
	
	$album_id = elgg_get_metadata(array(
			'guid' => $viewer->guid,
			'metadata_name' => 'flickr_album_id'
		));
	
	if( intval( $album_id[0]->value ) <= 0 ) {
		register_error( sprintf( elgg_echo( 'flickr:errornoalbum' ), $album_id[0]->value ));
		forward( "/mib/mod/tidypics/pages/flickr/setup.php" );
	}
	
	$photosets = $f->photosets_getList( $flickr_id[0]->value );
	foreach( $photosets["photoset"] as $photoset ) {
		$content .= "<div class='tidypics_album_images'>";
		$content .= "$photoset[title]<br />";
		
		$count = 0;
		$looper = 0;
		//create links to import photos 10 at a time
		while( $photoset["photos"] > $count ) {
			$looper++;
			$content .= " <a href='/mib/mod/tidypics/actions/flickrImportPhotoset.php?set_id=$photoset[id]&page=$looper&album_id=".$album_id[0]->value."'>$looper</a>";
			$count = $count + 10;			
		}
		$content .= "<br />$photoset[photos] images";
		$content .= "</div>";
//		echo "<pre>"; var_dump( $photoset ); echo "</pre>"; die;
	}

$sidebar = "";
// layout the page
$body = elgg_view_layout('one_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));

$title = elgg_echo( 'flickr:importmanager' );
//	$body .= elgg_view("tidypics/forms/setupFlickr", array(), false, true );
	//flickr_menu();
	//page_draw( elgg_echo( 'flickr:importmanager' ), elgg_view_layout("two_column_left_sidebar", '', $body));
	
// draw the page
echo elgg_view_page($title, $body);
	
?>