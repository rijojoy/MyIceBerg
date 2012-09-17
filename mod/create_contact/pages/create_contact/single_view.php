<?php
gatekeeper();
/* Added By Rijo Joy for create contact */

elgg_register_menu_item('title', array(
			'name' => 'add_contact',
			'href' => 'create_contact/add',
			'text' => 'Add Contact',
			'link_class' => 'elgg-button elgg-button-action',
	));
/* End of Added By Rijo Joy */

$options = array(
'type' => 'object',
'subtype' => 'create_contact',
'guid' => $guid,
'limit' => 10
);

$title = "User Contact";
// add the form to this section
$content .= elgg_view_form("create_contact/single_view");
 
// optionally, add the content for the sidebar
$sidebar = "";
 
// layout the page
$body = elgg_view_layout('two_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));
 
// draw the page
echo elgg_view_page($title, $body);

?>