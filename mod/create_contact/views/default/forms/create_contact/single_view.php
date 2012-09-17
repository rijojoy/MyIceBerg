<?php
ini_set("display_errors","on");
$guid =  explode("/",$_GET['page']);
//$guid = elgg_extract('guid', $vars, null);
/* Geeting single contact metadata */
$contact = elgg_get_metadata(array(
	'type' => 'object',
	'subtype' => 'create_contact',
	'guid' => $guid[1]
	
));
/* End of getting single contact metadata */

/* Get Categories id's */
$cat_ids = elgg_get_metadata(array(
	'type' => 'object',
	'subtype' => 'create_contact',
	'guid' => $guid[1],
	'metadata_names' => array('categories')
	
	
));

$cat_ids_array = array();
foreach ($cat_ids as $key => $cat_id)
{
$cat_ids_array[] = $cat_id->value;
}
/* End of getting categories id's */

//echo '<pre>';
//print_r( $cat_ids_array);

/* Assigning contact details to variable */
//echo '<pre>';
//print_r($contact);
$fname = $contact[0]->value;
$lname = $contact[1]->value;
$email = $contact[2]->value;
/* End of assigning contact details to variable */

$user = elgg_get_logged_in_user_entity(); // calling user object for getting category creator id
$categories = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'create_category',
	
	
));
$options = '';
$test = array();
foreach ($categories as $key => $category) {
if(in_array($category->guid,$cat_ids_array))
{
$boolean = true;
}
else
{
$boolean = false;
}
$test[] = $category->guid;
$label = $category->cat_name;
$input = elgg_view('input/checkbox', array(
'name' => "categories[]",
'value' => $category->guid,
'checked' => $boolean

));
$options .= "<label>$input$label</label><br />";
}

//echo '<pre>';
//print_r($tools);
// output our user settings area


?>
<div>
    <label><?php echo elgg_echo("First Name"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'fname','value' => $fname)); ?>
</div>

<div>
    <label><?php echo elgg_echo("Last Name"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'lname','value' => $lname)); ?>
</div>
<div>
    <label><?php echo elgg_echo("Email"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'email','value' => $email)); ?>
</div>
<div>
<?php
echo  $options;
//echo elgg_view('input/checkboxes',array('name' => 'categories' , 'options' => $options,));
?>
</div>
<div>
   
    <?php 
    if ($guid[1]) {
	echo elgg_view('input/hidden',array('name' => 'guid','value' => $guid[1])); 
	}
	?>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>