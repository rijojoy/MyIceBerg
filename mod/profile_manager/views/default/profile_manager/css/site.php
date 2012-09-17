<?php
	$plugin_graphics_folder = elgg_get_site_url() . "mod/profile_manager/graphics/"; 
?>
/* widgets */
#widget_profile_completeness_container {
	border: 1px solid #AAAAAA;
	position: relative;
}

#widget_profile_completeness_progress {
	position: absolute;
	line-height: 20px;
	font-weight: bold;
	width: 100%;
	text-align: center;
}

#widget_profile_completeness_progress_bar {
	background: #00FF00;
	height: 20px;
}

#custom_fields_userdetails.ui-accordion {
	margin-bottom: 10px;
}

#custom_fields_userdetails .ui-accordion-header {
	color: #666666;
	background: #EEEEEE;
	border: 2px solid #DEDEDE;
	cursor: pointer;
	margin-top: 5px;
	padding: 5px;
}

#custom_fields_userdetails .ui-accordion-content {
	border-style: solid;
	border-color: #DEDEDE;
	border-width: 0 2px 2px 2px;
	padding: 5px 5px 0px;
}

#custom_fields_userdetails .ui-accordion-header:hover {
	border-color: #CCCCCC;
}

#custom_fields_userdetails .ui-accordion-header .ui-icon {
	margin-top: 1px;
	background: url(<?php echo $plugin_graphics_folder; ?>accordion.png) no-repeat -16px 0;
	width: 16px;
	height: 16px;
	float: left;
}

#custom_fields_userdetails .ui-accordion-header:hover .ui-icon{
	background-position: -32px 0;
}

#custom_fields_userdetails .ui-accordion-header.ui-state-active .ui-icon {
	background-position: 0 0;
}

/* non_editables */
.hidden_non_editable {
	display: none;
}

/* profile type */
.custom_profile_type_description {
	display: none;
}

.datepicker_hidden{
	display: none;
}

/* fix for max-height multi-select drop down*/
.ui-dropdownchecklist-dropcontainer {
	max-height: 150px;
}
/* end fix */

.profile_manager_profile_edit_tab_content,
li.custom_fields_edit_profile_category {
	display: none;
}

/* registration field */
#profile_manager_register_left {
	float: left;
	min-width: 400px;
	margin-right: 10px;
}

#profile_manager_register_right {
	float: right;
	max-width: 400px;
}

#profile_manager_register_right > fieldset {
	margin-top: 10px;
}

/* registration form mandatory fields */

.profile_manager_register_missing {
	border: 1px solid red !important;
}
