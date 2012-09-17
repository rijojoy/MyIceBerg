<?php
// get the guid
//$uid = elgg_get_logged_in_user_guid();
$fname = get_input('fname');
$lname = get_input('lname');
$email = get_input('email');
$categories = get_input('categories');
$guid = get_input('guid');
$contact = get_entity($guid);
if (!$contact->canEdit()) {
		system_message(elgg_echo('Contact Save Failed'));
		forward(REFERRER);
	}
$contact->fname = $fname;
$contact->lname = $lname;
$contact->email = $email;
$contact->categories = $categories;
if($contact->save())
{
system_message("Contact Updated");
}
?>