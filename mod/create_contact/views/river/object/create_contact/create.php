<?php
/**
 * New Create Contact river entry
 *
 * @package Create Contact
 */

$object = $vars['item']->getObjectEntity();
$excerpt = elgg_get_excerpt("Contact Created");

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => elgg_echo('Created'),
	/*'attachments' => elgg_view('output/url', array('href' => $object->address)),*/
));
