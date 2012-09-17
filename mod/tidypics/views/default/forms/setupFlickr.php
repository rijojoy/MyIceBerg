<?php
// Load Elgg engine
include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php";
//require_once(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/lib/flickr.php";

$user = elgg_get_logged_in_user_entity();


//echo "Owner Id".$owner->getGUID();
// get the album entity
$album_guid = $user->guid;
$album = get_entity($album_guid);
//echo '<pre>';
//print_r($album);

$options1 = array(
	'guid' => $user->guid
);

$options2 = array(
    'owner' => 35,
	'metadata_values' => 'test',
	'limit' => false
);

//$flickr_username = $user->username;;
//$flickr_album_id = elgg_get_metadata( $options2 );

/* Added By Rijo Joy for overriding deprecated functions */

$flickr_username = elgg_get_metadata(array(
			'guid' => $user->guid,
			'metadata_name' => 'flickr_username'
		));
		
$flickr_album_id = elgg_get_metadata(array(
			'guid' => $user->guid,
			'metadata_name' => 'flickr_album_id'
		));

/* End of Added By Rijo Joy for overriding deprecated functions */

//$flickr_username1 = get_metadata_byname( $user->guid, "flickr_username" );
//$flickr_album_id1 = get_metadata_byname( $user->guid, "flickr_album_id" );


$action = $vars['url'] . 'mod/tidypics/actions/flickrSetup.php';

$form_body = "<p>". elgg_echo( 'flickr:intro' ) . "</p><p>";
$form_body .= elgg_echo( 'flickr:usernamesetup') . " <input style='width: 20%;' type='text' name='flickr_username' value='".$flickr_username[0]->value."' ' class='input-text' /> <br />";
$form_body .= "<input type='hidden' name='return_url' value='$_SERVER[REQUEST_URI]' />";

/*$albums = elgg_get_entities(array(
	"type=" => "object",
	"subtype" => "album",
	"owner_guid" => $user->guid,
)); */

$albums = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'album',
	'container_guid' => $user->guid,
	
));

$options = array( 0 => elgg_echo( 'flickr:selectalbum' ));
foreach( $albums as $album ) {
	$title = $album->title;
	switch( $album->access_id ) {
		case ACCESS_PRIVATE:
			$title .= " (" . elgg_echo( 'private' ) . ")";
			break;
		case ACCESS_PUBLIC:
			$title .= " (" . elgg_echo( 'public' ) . ")";
			break;
		default:
			$title .= " (no known permission set)";
			break;
	}
	$options[$album->guid] = $title;
}

$form_body .= "<br />" . elgg_echo( 'flickr:albumdesc' );
$form_body .= elgg_view('input/dropdown', array('name' => 'album_id',
												'options_values' => $options,
												'value' => $flickr_album_id[0]->value ));
$form_body .= "<br />";
$form_body .= elgg_view('input/submit', array('value' => elgg_echo("save")));

//flickr_menu();

echo elgg_view('input/form', array('action' => $action, 'body' => $form_body));
