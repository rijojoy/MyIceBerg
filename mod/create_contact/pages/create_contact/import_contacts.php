<?php
gatekeeper();
elgg_load_js('js');
$title = "Import Contacts";
// add the form to this section
$content .= elgg_view_form("create_contact/import_contacts");
 
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