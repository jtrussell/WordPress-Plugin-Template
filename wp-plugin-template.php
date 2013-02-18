<?php
/*
Plugin Name: {{plugin-name}}
Plugin URI: {{plugin-uri}}
Description: {{plugin-desc}}
Version: {{plugin-version}}
Author: {{author-name}}
Author URI: {{author-uri}}
*/

// -----------------------------------------------------
// Setup some constants
// -----------------------------------------------------
$this_dir = dirname(__file__);
$lib_dir = $this_dir . "/{lib-dir}}";

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
add_action("admin_menu", "{{plugin-ns}}_ui::print_plugin_menu");

// -----------------------------------------------------
// Activation, Deactivation, and Install routines
// -----------------------------------------------------
register_activation_hook(__FILE__, "{{plugin-ns}}_wp::set_options");
register_deactivation_hook(__FILE__, "{{plugin-ns}}_wp::unset_options");
add_action("admin_init", "{{plugin-ns}}_wp::register_settings");

// -----------------------------------------------------
// Closing php tag omitted
// -----------------------------------------------------
