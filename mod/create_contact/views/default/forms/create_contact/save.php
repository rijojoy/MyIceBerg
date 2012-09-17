<?php
ini_set("display_errors","on");
$user = elgg_get_logged_in_user_entity(); // calling user object for getting category creator id
$categories = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'create_category',
	
	
));
/*$checkboxes = '';
$options = array();
$keys = array();
foreach( $categories as $key => $category ) {
	$title = $category->cat_name;
	$index = "$title";
	$options[$key] = $key;
	$keys = $key;
}
*/


$options = '';
foreach ($categories as $key => $category) {
$label = $category->cat_name;
$input = elgg_view('input/checkbox', array(
'name' => "categories[]",
'value' => $category->guid,

));
$options .= "<label>$input$label</label><br />";
}


//echo '<pre>';
//print_r($tools);
// output our user settings area


?>
<div>
    <label><?php echo elgg_echo("First Name"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'fname')); ?>
</div>

<div>
    <label><?php echo elgg_echo("Last Name"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'lname')); ?>
</div>
<div>
    <label><?php echo elgg_echo("Email"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'email')); ?>
</div>
<div>
<?php
//print_r($categories);
echo  $options;
//print_r($options);
//$option1 = array(elgg_echo("Original") => "Original" , elgg_echo("Unoriginal") => "Unorginal");
//echo elgg_view('input/checkboxes',array('name' => 'categories' , 'options' => $options,));
?>
</div>
<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>