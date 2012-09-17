<?php

echo elgg_view_title($vars['entity']->cat_name);
echo elgg_view('output/longtext', array('value' => $vars['entity']->cat_desc));
//echo elgg_view('output/tags', array('tags' => $vars['entity']->tags)); 
?>