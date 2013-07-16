<?php
/*
Plugin Name: {{plugin_name}}
Plugin URI: {{plugin_uri}}
Description: {{plugin_desc}}
Version: {{plugin_version}}
Author: {{author_name}}
Author URI: {{author_uri}}
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
		if (preg_match("/(svc|class)-[\w-]+\.php/", $file_path) && is_file($file_path)) { 
			// Do Something with file
			include_once($file_path);
		}
	}
	closedir($handle);
}

// -----------------------------------------------------
// Register our options menu item and options page
// -----------------------------------------------------
add_action("admin_menu", "{{plugin_ns}}_ui::print_plugin_menu");

// -----------------------------------------------------
// Activation, Deactivation, and Install routines
// -----------------------------------------------------
register_activation_hook(__FILE__, "{{plugin_ns}}_wp::set_options");
register_deactivation_hook(__FILE__, "{{plugin_ns}}_wp::unset_options");
add_action("admin_init", "{{plugin_ns}}_wp::register_settings");

// -----------------------------------------------------
// Closing php tag omitted
// -----------------------------------------------------
