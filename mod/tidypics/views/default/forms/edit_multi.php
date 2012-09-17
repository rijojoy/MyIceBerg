<?php
/**
 * form for mass editing all uploaded images
 */

$images = $vars['images'];
$album = get_entity($images[0]->container_guid);

?>
<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>mod/tidypics/actions/edit_multi.php" method="post">
<?php
	
	// make sure one of the images becomes the cover if there isn't one already
	//if (!$album->getCoverImageGuid()) {
	//$no_cover = true;
	//}
	
	foreach ($images as $key => $image) {
		$guid = $image->guid;
		$body = $image->description;
		$title = $image->title;
		$tags = $image->tags;
		
		// first one is default cover if there isn't one already
		if ($no_cover) {
			$val = $guid;
			$no_cover = false;
		}
		
		echo '<div class="tidypics_edit_image_container">';
		echo '<img src="' . $vars['url'] . 'mod/tidypics/thumbnail.php?file_guid=' . $guid . '&size=small" class="tidypics_edit_images" alt="' . $title . '"/>';
		echo '<div class="tidypics_image_info">';
		echo '<p><label>' . elgg_echo('album:title') . '</label>';
		echo elgg_view("input/text", array("name" => "title[$key]", "value" => $title,)) . "\n";
		echo '</p>';
		echo '<p><label>' . elgg_echo('caption') . "</label>";
		echo elgg_view("input/longtext",array("name" => "caption[$key]", "value" => $body, "class" => 'tidypics_caption_input',)) . "\n";
		echo "</p>";
		echo '<p><label>' . elgg_echo("tags") . "</label>\n";
		echo elgg_view("input/tags", array( "name" => "tags[$key]","value" => $tags)) . "\n";
		echo '</p>';
		echo '<input type="hidden" name="image_guid[' .$key. ']" value="'. $guid .'">' . "\n";
		echo elgg_view('input/securitytoken');
		
		echo elgg_view("input/radio", array("name" => "cover",
											"value" => $val,
											'options' => array(	elgg_echo('album:cover') => $guid,
																),
													));
		echo '</div>';
		echo '</div>';
	}
	
?>
<input type="hidden" name="container_guid" value="<?php echo $album->guid; ?>" />
<p><input type="submit" name="submit" value="<?php echo elgg_echo('save'); ?>" /></p>
</form>
</div>