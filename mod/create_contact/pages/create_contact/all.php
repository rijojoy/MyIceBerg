<?php
$options = array(
'type' => 'object',
'subtype' => 'create_contact',
'limit' => 10
);

$body = elgg_list_entities($options);
$body = elgg_view_layout('two_sidebar', array('content' => $body));
 
echo elgg_view_page("All User Contacts", $body);

?>