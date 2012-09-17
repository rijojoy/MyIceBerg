<?php

/* Added By Rijo Joy for Flickr */
elgg_register_menu_item('title', array(
			'name' => 'add_category',
			'href' => 'create_contact/add_cat',
			'text' => 'Add Category',
			'link_class' => 'elgg-button elgg-button-action',
	));
	/* End of Added By Rijo Joy */

$options = array(
'type' => 'object',
'subtype' => 'create_category',
'limit' => 10
);
$body = elgg_list_entities($options);
$body = elgg_view_layout('two_sidebar', array('content' => $body));
 
echo elgg_view_page("All User Contacts", $body);

?>