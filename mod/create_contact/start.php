<?php
$action_path = elgg_get_plugins_path() . 'create_contact/actions/create_contact';
elgg_register_action("create_contact/save","$action_path/save.php");
elgg_register_action("create_contact/add_category","$action_path/add_category.php");
elgg_register_action("create_contact/single_view","$action_path/single_view.php");
elgg_register_action("create_contact/delete","$action_path/delete.php");
//elgg_register_action("create_contact/import_contacts","$action_path/import_contacts.php");
//elgg_register_page_handler('create_contact', 'create_contact_page_handler');
elgg_register_event_handler('init', 'system', 'create_contact_init');
$js_url = elgg_get_plugins_path() . 'create_contact/views/default/create_contact/js.js';
/* Registering Menu Top Menu Item */

function create_contact_init() 
{
	
/* Adding Javscript */
elgg_register_js('js',$js_url);
/* End of Adding Javascript */
elgg_register_page_handler('create_contact', 'create_contact_page_handler');
// add a menu item to primary site navigation
$item = new ElggMenuItem('create_contact', 'Create Contact', 'create_contact/all');
elgg_register_menu_item('site', $item);

/* Registering Sidebar Menu Items */
if (isloggedin()) { // Check If User Logged In

	  elgg_register_menu_item('page', array(
	  'name' => 'Create Contact',
	  'text' => 'Create Contact',
	  'href' => 'create_contact/add',
	  'contexts' => array('all'),
	  ));
	  elgg_register_menu_item('page', array(
	  'name' => 'Create Category',
	  'text' => 'Create Category',
	  'href' => 'create_contact/add_cat',
	  'contexts' => array('all'),
	  ));
	  elgg_register_menu_item('page', array(
	  'name' => 'My Categories',
	  'text' => 'My Categories',
	  'href' => 'create_contact/all_cat',
	  'contexts' => array('all'),
	  ));
	  
	  elgg_register_menu_item('page', array(
	  'name' => 'My Contacts',
	  'text' => 'My Contacts',
	  'href' => 'create_contact/all',
	  'contexts' => array('all'),
	  ));
	  
	  elgg_register_menu_item('page', array(
	  'name' => 'Import Contacts',
	  'text' => 'Import Contacts',
	  'href' => 'create_contact/facebook_contacts',
	  'contexts' => array('all'),
	  ));

} // End check if user logged In
}
/* End of Registering Sidebar Menu Items */



/* End of Registering Top Menu Item */




function create_contact_page_handler($segments) {
    switch ($segments[0]) {
        case 'add':
           include elgg_get_plugins_path() . 'create_contact/pages/create_contact/add.php';
           break;
 
        case 'add_cat':
           include elgg_get_plugins_path() . 'create_contact/pages/create_contact/add_cat.php';
           break;
 
        case 'all_cat':
           include elgg_get_plugins_path() . 'create_contact/pages/create_contact/all_cat.php';
           break;
	    
		case 'single_view':
           include elgg_get_plugins_path() . 'create_contact/pages/create_contact/single_view.php';
           break;
	   
	    case 'facebook_contacts':
		  gatekeeper();    
		  $title = elgg_echo('Import Contacts');
		  $body = elgg_view('forms/create_contact/facebook_contacts');
		  $params = array(
			  'content' => $body,
			  'title' => $title,
		  );
		  $body = elgg_view_layout('one_sidebar', $params);
		  echo elgg_view_page($title, $body);
		  return true;
	   
	   case 'gmail_contacts':
		  gatekeeper();    
		  $title = elgg_echo('Import Contacts');
		  $body = elgg_view('forms/create_contact/gmail_contacts');
		  $params = array(
			  'content' => $body,
			  'title' => $title,
		  );
		  $body = elgg_view_layout('one_sidebar', $params);
		  echo elgg_view_page($title, $body);
		  return true;
		  
		  
	   case 'twitter_contacts':
		  gatekeeper();    
		  $title = elgg_echo('Import Contacts');
		  $body = elgg_view('forms/create_contact/twitter_contacts');
		  $params = array(
			  'content' => $body,
			  'title' => $title,
		  );
		  $body = elgg_view_layout('one_sidebar', $params);
		  echo elgg_view_page($title, $body);
		  return true;	  
	   
	   case 'li_contacts':
		  gatekeeper();    
		  $title = elgg_echo('Import Contacts');
		  $body = elgg_view('forms/create_contact/li_contacts');
		  $params = array(
			  'content' => $body,
			  'title' => $title,
		  );
		  $body = elgg_view_layout('one_sidebar', $params);
		  echo elgg_view_page($title, $body);
		  return true;
	   
	   case 'salesforce_contacts':
		  gatekeeper();    
		  $title = elgg_echo('Import Contacts');
		  $body = elgg_view('forms/create_contact/salesforce_contacts');
		  $params = array(
			  'content' => $body,
			  'title' => $title,
		  );
		  $body = elgg_view_layout('one_sidebar', $params);
		  echo elgg_view_page($title, $body);
		  return true;
		  
	   case 'import_contacts':
          gatekeeper();
	      $title = elgg_echo('Import Contacts');
	      $body = elgg_view('forms/create_contact/import_contacts');
	       $params = array(
		 'content' => $body,
		 'title' => $title,
	    );
	$body = elgg_view_layout('one_sidebar', $params);
	echo elgg_view_page($title, $body);
	return true;
           break;
	  
	   case 'import_contacts_fb':
          gatekeeper();
	      $title = elgg_echo('Import Facebook Contacts');
	      $body = elgg_view('forms/create_contact/import_contacts_fb');
	       $params = array(
		 'content' => $body,
		 'title' => $title,
	    );
	$body = elgg_view_layout('one_sidebar', $params);
	echo elgg_view_page($title, $body);
	return true;
           break;
	   
	   case "edit":
			gatekeeper();
			set_input('guid', $segments[1]);
			include elgg_get_plugins_path() . 'create_contact/pages/create_contact/single_view.php';
			break;

	    case 'all':
        default:
           include elgg_get_plugins_path() . 'create_contact/pages/create_contact/all.php';
           break;
		   
    }
    return false;
}


?>