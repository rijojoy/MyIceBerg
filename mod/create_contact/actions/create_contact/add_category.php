<?php
// get the form inputs
$cname = get_input('cat_name');
$cdesc = get_input('cat_desc');

 
// create a new my_blog object
$category = new ElggObject();
$category->subtype = "create_category";
$category->cat_name = $cname;
$category->cat_desc = $cdesc;
 
// for now make all my_blog posts public
$category->access_id = ACCESS_PRIVATE;
 
// owner is logged in user
$category->owner_guid = elgg_get_logged_in_user_guid();
 
// save tags as metadata
$category->tags = $tags;
 
// save to database and get id of the new my_blog
$category_guid = $category->save();
 
// if the my_blog was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($category_guid) {
   system_message("Category Saved");
   forward($category->getURL());
} else {
   register_error("Error saving Category!");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}
?>