<?php
/**
 * Plugin Name: Gravity Forms - Uploads as Attachments
 * Plugin URI: https://elegantmodules.com/
 * Description: Adds an option to send files from the fileupload field(s) as attachment with notifications
 * Version: 1.3.0
 * Author: Elegant Modules
 * Author URI: https://elegantmodules.com
 * Text Domain: gf-uploads-as-attachments
 * Domain Path: /languages/
 *
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

/*
	Copyright 2020  Elegant Modules (hey@elegantmodules.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	Permission is hereby granted, free of charge, to any person obtaining a copy of this
	software and associated documentation files (the "Software"), to deal in the Software
	without restriction, including without limitation the rights to use, copy, modify, merge,
	publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
	to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or
	substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GF_Uploads_Attachments' ) ) :

class GF_Uploads_Attachments {

	private static $instance;

	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof GF_Uploads_Attachments ) ) {
			
			self::$instance = new GF_Uploads_Attachments;

			self::$instance->constants();
			self::$instance->includes();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Constants
	 */
	public function constants() {

		// Plugin version
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_VERSION' ) ) {
			define( 'GF_UPLOADS_ATTACHMENTS_VERSION', '1.3.0' );
		}

		// Plugin file
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_FILE' ) ) {
			define( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_FILE', __FILE__ );
		}

		// Plugin basename
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_BASENAME' ) ) {
			define( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_BASENAME', plugin_basename( GF_UPLOADS_ATTACHMENTS_PLUGIN_FILE ) );
		}

		// Plugin directory path
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_DIR_PATH' ) ) {
			define( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_DIR_PATH', trailingslashit( plugin_dir_path( GF_UPLOADS_ATTACHMENTS_PLUGIN_FILE )  ) );
		}

		// Plugin directory URL
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_DIR_URL' ) ) {
			define( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_DIR_URL', trailingslashit( plugin_dir_url( GF_UPLOADS_ATTACHMENTS_PLUGIN_FILE )  ) );
		}

		// Templates directory
		if ( ! defined( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_TEMPLATES_DIR_PATH' ) ) {
			define ( 'GF_UPLOADS_ATTACHMENTS_PLUGIN_TEMPLATES_DIR_PATH', GF_UPLOADS_ATTACHMENTS_PLUGIN_DIR_PATH . 'templates/' );
		}
	}

	/**
	 * Action/filter hooks
	 */
	public function hooks() {
		add_action( 'plugins_loaded', array( $this, 'loaded' ) );
	}

	/**
	 * Load plugin text domain
	 */
	public function loaded() {

		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'gf-uploads-as-attachments' );
		
		unload_textdomain( 'gf-uploads-as-attachments' );
		
		load_textdomain( 'gf-uploads-as-attachments', WP_LANG_DIR . '/gf-uploads-as-attachments/gf-uploads-as-attachments-' . $locale . '.mo' );
		load_plugin_textdomain( 'gf-uploads-as-attachments', false, dirname( GF_UPLOADS_ATTACHMENTS_PLUGIN_BASENAME ) . '/languages' );
	}

	public function includes() {
		include_once 'includes/helpers.php';
		include_once 'includes/class-settings.php';
		include_once 'includes/class-notifications.php';
	}
}

endif;

/**
 * Main function
 * 
 * @return object 	GF_Uploads_Attachments instance
 */
function gf_uploads_attachments() {
	return GF_Uploads_Attachments::instance();
}

gf_uploads_attachments();
