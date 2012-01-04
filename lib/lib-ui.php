<?php
// -----------------------------------------------------
// Class:	template_ui
// Author:	Justin Russell
// Date:	
// Purpose:	Encapsulate functionality related to
// 			printing wordpress ui elements.
// -----------------------------------------------------

class template_ui 
{
	public static function print_plugin_menu() {
		$hook = add_options_page(
			template_wp::$plugin_name . " Options", // Page Title
			template_wp::$plugin_name, // Display for menu listing
			"manage_options", // Only show this option if user can manage options
			template_wp::$plugin_slug . "_manage", // Unique identifier for this menu (i.e. menu slug)
			"template_ui::print_plugin_options_form" // Callback - Refers to the function below
		);
		add_action("admin_enqueue_scripts", "template_ui::enqueue_options_scripts");
	}

	public static function print_plugin_options_form() {
		if(!current_user_can("manage_options")) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		include(dirname(__FILE__) . "/../form/options-form.php");
	}

	public static function enqueue_options_scripts() {
		self::enqueue_page_scripts("options-form");
	}

	public static function enqueue_page_scripts($page) {
		$this_dir = dirname(__FILE__);
		$plugin_dir_uri	= plugins_url(template_wp::$plugin_slug);
		if(file_exists($this_dir . "/../css/{$page}.css")) {
			wp_enqueue_style(template_wp::$plugin_name . "-{$page}-style", $plugin_dir_uri . "/css/{$page}.css");
		}
		if(file_exists($this_dir . "/../css/{$page}.js")) {
			wp_enqueue_script(template_wp::$plugin_name . "-{$page}-script", $plugin_dir_uri . "/js/{$page}.js");
		}
	}
}

// -----------------------------------------------------
// Closing php tag omitted
// -----------------------------------------------------
