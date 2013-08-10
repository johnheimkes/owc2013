<?php
/**
 * Manage upgrades for the Tribe Events Eventbrite plugin
 *
 * @author Peter Chester
 */

// Don't load directly
if( !defined( 'ABSPATH' ) ) die( '-1' );

if( !class_exists( 'TribeEventsEventbritePUE' ) ) {
	class TribeEventsEventbritePUE {

		/**
		 * @var string slug used for the plugin update engine
		 */
		private static $pue_slug = 'tribe-eventbrite';

		/**
		 * @var string plugin update url
		 */
		private static $update_url = 'http://tri.be/';

		/**
		 * @var string plugin file name
		 */
		private static $plugin_file;

		/**
		 * Constructor function. a.k.a. Let's get this party started!
		 *
		 * @param string $plugin_file file path.
		 */
		public function __construct( $plugin_file ) {
			self::$plugin_file = $plugin_file;
			if ( !class_exists( 'TribeCommonLibraries' ) ) {
				require_once( dirname( self::$plugin_file ) . '/vendor/tribe-common-libraries/tribe-common-libraries.class.php' );
			}
			TribeCommonLibraries::register( 'tribe-pue-client', '1.5', dirname( self::$plugin_file ) . '/vendor/pue-client/pue-client.php' );
			add_action( 'tribe_helper_activation_complete', array( $this, 'load_plugin_update_engine' ) );
			register_activation_hook( self::$plugin_file, array( $this, 'register_uninstall_hook' ) );
		}

		/**
		 * Load the Plugin Update Engine
		 */
		public function load_plugin_update_engine() {
			if( apply_filters( 'tribe_enable_pue', TRUE, self::$pue_slug ) && class_exists( 'TribePluginUpdateEngineChecker' ) ) {
				$this->pue_instance = new TribePluginUpdateEngineChecker( self::$update_url, self::$pue_slug, array(), plugin_basename( self::$plugin_file ) );
			}
		}

		/**
		 * Register the uninstall hook on activation
		 */
		public function register_uninstall_hook() {
			register_uninstall_hook( self::$plugin_file , array( get_class($this), 'uninstall' ) );
		}

		/**
		 * The uninstall hook for the pue option.
		 */
		public function uninstall() {
			$slug = str_replace( '-', '_', self::$pue_slug );
			delete_option( 'pue_install_key_' . $slug );
			delete_option( 'pu_dismissed_upgrade_' . $slug );
		}
	}
}
?>