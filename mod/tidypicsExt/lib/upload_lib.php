<?php
    if ( $_POST['tidypics_image_upload_list_count'] > 0 ){
        unset($_FILES);
        $tmp_path = sys_get_temp_dir();
        $_FILES = array();
        for ($i = 0; $i < $_POST['tidypics_image_upload_list_count']; $i++){
            if ($_POST["tidypics_image_upload_list_{$i}_status"] == 'done'){
                $_FILES[$i]['tmp_name'] = $tmp_path.'/'.$_POST["tidypics_image_upload_list_{$i}_tmpname"];
                $_FILES[$i]['name'] = $_POST["tidypics_image_upload_list_{$i}_name"];

                $_FILES[$i]['type'] = mime_content_type($_FILES[$i]['tmp_name']);
                $_FILES[$i]['error'] = 0 ;
                $_FILES[$i]['size'] = filesize($_FILES[$i]['tmp_name']);
            }       
            
        }
    }
