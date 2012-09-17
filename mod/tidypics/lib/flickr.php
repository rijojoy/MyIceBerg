<?php

function flickr_menu() {
	elgg_register_menu_item( elgg_echo( 'flickr:menusetup' ), "/mod/tidypics/pages/flickr/setup.php");
	elgg_register_menu_item( elgg_echo( 'flickr:menuimport' ), "/mod/tidypics/pages/flickr/importPhotosets.php" );
}
