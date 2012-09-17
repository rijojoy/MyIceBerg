<?php

    global $CONFIG;
    $images_sizes = unserialize(get_plugin_setting('image_sizes', 'tidypics'));	
    
    /*
    [large_image_width] => 600 [large_image_height] => 600 [small_image_width] => 153 [small_image_height] => 153 [thumb_image_width] => 60 [thumb_image_height] => 60 
    */

?>
<style type="text/css">@import url(<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/css/plupload.queue.css);</style>

<script type="text/javascript" src="<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/js/gears_init.js"></script>
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->

<script type="text/javascript" src="<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/js/plupload.full.min.js"></script>

<script type="text/javascript" src="<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/js/jquery.plupload.queue.min.js"></script>

<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {

$("input[type='submit']").attr("disabled", "true");
$("input[type='submit']").hide();
    plupload.addI18n({
            'Select files' : '<?php echo elgg_echo('tidypicsExt:plupload_header_title'); ?>',
            'Add files to the upload queue and click the start button.' : '<?php echo elgg_echo('tidypicsExt:plupload_header_text'); ?>',
            'Filename' : '<?php echo elgg_echo('tidypicsExt:plupload_file_name'); ?>',
            'Status' : '<?php echo elgg_echo('tidypicsExt:plupload_file_status'); ?>',
            'Size' : '<?php echo elgg_echo('tidypicsExt:plupload_file_size'); ?>',
            'Add files' : '<?php echo elgg_echo('tidypicsExt:plupload_button_add'); ?>',
            'Start upload': '<?php echo elgg_echo('tidypicsExt:plupload_start'); ?>',
            'Stop current upload' : '<?php echo elgg_echo('tidypicsExt:plupload_stop_current_upload'); ?>',
            'Start uploading queue' : '<?php echo elgg_echo('tidypicsExt:plupload_start_uploading_queue'); ?>',
            'Drag files here.' : '<?php echo elgg_echo('tidypicsExt:plupload_droptext'); ?>',
            'You must at least upload one file.': '<?php echo elgg_echo('tidypicsExt:error_message:no_files_uploaded'); ?>',
    });

	$("#tidypics_image_upload_list").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,gears,silverlight,browserplus,html4', // ver porque no anda con flash
		url : '<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/plupload.php',
		max_file_size : '<?php echo (float) get_plugin_setting('maxfilesize','tidypics'); ?>mb',
		chunk_size : '1mb',
		unique_names : true,
		

		// Resize images on clientside if we can
		resize : {width : <?php echo $images_sizes['large_image_width'] ?>, height : <?php echo $images_sizes['large_image_height'] ?>, quality : 90},

		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
                        {title : "Zip files", extensions : "zip"}			
		],

		// Flash settings
		flash_swf_url : '<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/js/plupload.flash.swf',

		// Silverlight settings
		silverlight_xap_url : '<?php echo $CONFIG->wwwroot ?>mod/tidypicsExt/vendors/plupload/js/plupload.silverlight.xap',
                init: {
                    FileUploaded: function(up) {                              
				$("input[type='submit']").removeAttr("disabled");
                                $("input[type='submit']").show();
			},
                   Error: function(up, args) {
				// Called when a error has occured
                                //@TODO: Make something
                             return 'error';
			}
                }
    });

//--- Translation Stuffs  ---

//---  ------   
    
});

//We override the deffault function because it cause some bug, and is not necesarry anymore
function displayProgress(){
    return false;
}
</script>




