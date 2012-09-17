<?php
	
    function tidypicsExt_init() {
			
	    // Load system configuration
		    global $CONFIG;
		    
         // Extend View
            elgg_extend_view('tidypics/forms/upload','tidypicsExt/forms/upload');
     }
     
     // Make sure the status initialisation function is called on initialisation
		register_elgg_event_handler('init','system','tidypicsExt_init',9999);
		register_action("tidypics/upload", false, $CONFIG->pluginspath . "tidypicsExt/actions/upload.php");
