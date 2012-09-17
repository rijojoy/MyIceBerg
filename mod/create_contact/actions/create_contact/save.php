<?php
// get the form inputs
$fname = get_input('fname');
$lname = get_input('lname');
$email = get_input('email');
$categories = get_input('categories');
// create a new my_blog object
$contact = new ElggObject();
$contact->subtype = "create_contact";
$contact->fname = $fname;
$contact->lname = $lname;
$contact->email = $email;
$contact->categories = $categories;
// for now make all contacts private
$contact->access_id = ACCESS_PRIVATE;
 
// owner is logged in user
$contact->owner_guid = elgg_get_logged_in_user_guid();
 
// save tags as metadata
$contact->tags = $tags;
 
// save to database and get id of the new my_blog
$contact_guid = $contact->save();
// Adding the page to activity stream - here we call river
   add_to_river('river/object/create_contact/create','create', elgg_get_logged_in_user_guid(), $contact->getGUID());
 // if the Create Contact  was saved, we want to display the new contact
// otherwise, we want to register an error and forward back to the form
if ($contact_guid) {
   
   // Printingout the Success Message 
   system_message("Your contact saved");
   
   
   
   // Forwarding the Page
   forward($contact->getURL());
} else {
   register_error("Your contact could not be saved!");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}
?>