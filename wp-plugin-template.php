<?php
/*
Plugin Name: WP Plugin Template
Plugin URI: http://www.foo.com/template-uri
Description: A stock template WordPress plugins.
Version: 1.0.0
Author: Justin Russell
Author URI: http://jrussell.me
*/

// -----------------------------------------------------
// Setup some constants
// -----------------------------------------------------
$this_dir = dirname(__file__);
$lib_dir = $this_dir . "/lib";


// -----------------------------------------------------
// Include our library files
// -----------------------------------------------------
if ($handle = opendir($lib_dir)) {
	while (false !== ($file = readdir($handle))) {
		// Don't include hidden files or directories
		$file_path = $lib_dir . "/" . $file;
		if (preg_match("/(lib|class)-[\w-]+\.php/", $file_path) && is_file($file_path)) { 
			// Do Something with file
			include_once($file_path);
		}
	}
	closedir($handle);
}


// -----------------------------------------------------
// Register our options menu item and options page
// -----------------------------------------------------
add_action("admin_menu", "template_ui::print_plugin_menu");


// -----------------------------------------------------
// Activation, Deactivation, and Install routines
// -----------------------------------------------------
register_activation_hook(__FILE__, "template_wp::set_options");
register_deactivation_hook(__FILE__, "template_wp::unset_options");
add_action("admin_init", "template_wp::register_settings");

// -----------------------------------------------------
// Closing php tag omitted
// -----------------------------------------------------
