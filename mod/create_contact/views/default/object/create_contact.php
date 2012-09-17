<?php
//echo '<pre>';
//print_r($vars['entity']);

/* This is to add access level, edit, delete , like menu links */

echo elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'create_contact',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
/* End of Adding menu links */

/* Looping the categories to get its name */
$cats_all = $vars['entity']->categories;
$cats = array();
foreach ($cats_all as $catid)
{
 $cats_meta = elgg_get_metadata(array(
	'type' => 'object',
	'subtype' => 'create_category',
	'guid' => $catid
	
	
));
$cats[] = $cats_meta[0]->value;
}
/* End of looping the categories name */
//print_r($cats);
//die();



echo '<div>';
echo elgg_view('output/url', array(
                                   'text' => $vars['entity']->fname. ' ' .$vars['entity']->lname,
								   'href' => 'create_contact/single_view/'.$vars['entity']->guid
								   )
			  );
echo '</div>';
echo '<div>';
echo elgg_view('output/email', array('value' => $vars['entity']->email));
echo '</div>';
echo elgg_view('output/tags', array('tags' => $cats)); 
echo '<hr>';
?>