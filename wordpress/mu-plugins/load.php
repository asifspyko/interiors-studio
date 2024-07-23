<?php
/*
  Plugin Name: Required Plugins
  Description: Installed plugins: ACF Header Tag, ACF Spacing, ACF Unique ID
  Author: PROJECT_AUTHOR
  Version: PROJECT_VERSION
  Author URI: PROJECT_AUTHOR_URL
*/

/**
 * This file is for loading all mu-plugins within subfolders
 * where the PHP file name is exactly like the directory name + .php.
 *
 * Fixing autoloaded plugins:
 * 1. Replace 'dirname( plugin_basename( __FILE__ ) ) or dirname( __FILE__ )' with 'WPMU_PLUGIN_DIR'
 * 2. Replace 'plugin_dir_url( __FILE__ )' with 'WPMU_PLUGIN_URL . '/plugin-directory/';'
 * 3. Replace 'plugins_url( 'plugin-directory' )' with WPMU_PLUGIN_URL . '/plugin-directory/'
 */

 // Opens the must-use plugins directory
 $wpmu_plugin_dir = opendir(WPMU_PLUGIN_DIR);

 // Lists all the entries in this directory
 while (false !== ($entry = readdir($wpmu_plugin_dir))) {
 	$path = WPMU_PLUGIN_DIR . '/' . $entry;

 	// Is the current entry a subdirectory?
 	if ($entry != '.' && $entry != '..' && is_dir($path)) {
 		// Includes the corresponding plugin
 		require($path . '/' . $entry . '.php');
 	}
 }

 // Closes the directory
 closedir($wpmu_plugin_dir);
