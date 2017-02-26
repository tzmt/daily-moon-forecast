<?php
/*
Plugin Name: Daily Moon Forecast
Plugin URI: https://isabelcastillo.com/docs/about-daily-moon-forecast-wordpress-plugin
Description: Display the current moon zodiac sign along with a forecast, with option to add custom forecasts.
Version: 2.1
Author: Isabel Castillo
Author URI: http://isabelcastillo.com
License: GPL2
Text Domain: daily-moon-forecast
Domain Path: languages

Copyright 2013 - 2016 Isabel Castillo

This file is part of Daily Moon Forecast plugin.

Daily Moon Forecast plugin is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

Daily Moon Forecast plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Daily Moon Forecast plugin; if not, If not, see <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>.
*/
if ( ! class_exists( 'Daily_Moon_Forecast' ) ) {
	class Daily_Moon_Forecast{

		private static $instance = null;
		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		private function __construct() {		

			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
		
			if( ! defined( 'DMF_PLUGIN_DIR' ) )
				define( 'DMF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			require_once DMF_PLUGIN_DIR . 'dmf-widget.php';
	    }
	
		public function add_plugin_page(){
			add_options_page(__('Daily Moon Forecast', 'daily-moon-forecast'), __('Daily Moon Forecast', 'daily-moon-forecast'), 'manage_options', 'dmf', array($this, 'create_admin_page'));
	    }
		
		public function create_admin_page(){
	        ?>
		<div class="wrap">
		    <?php screen_icon(); ?>
		    <h1><?php _e( 'Daily Moon Forecast - Custom Interpretations', 'daily-moon-forecast'); ?></h1>	
			<br /><a class="button-primary" target="_blank" title="Rate This Plugin" href="http://wordpress.org/support/view/plugin-reviews/daily-moon-forecast"><?php _e('Rate This Plugin', 'daily-moon-forecast'); ?></a>
		    <form method="post" action="options.php">
		        <?php
	                // prints out all hidden setting fields
					settings_fields('dmf_options');
					do_settings_sections('dmf');
					submit_button(); ?>
		    </form>
		</div>
		<?php
	    }
		
		public function page_init(){	
			register_setting('dmf_options', 'dmf_options', array($this, 'sanitize'));
			add_settings_section(
				'dmf_options_main',// unique id for the section
				__('Enter your custom interpretation for each Moon sign.', 'daily-moon-forecast' ),
				false,// function callback to display
				'dmf'// page name. Must match the do_settings_sections function call. and match options menu page
			);	
			
			$dmf_settings = array(
				
						'aries' => array(
										'id' => 'aries',
										'name' => __('Aries', 'daily-moon-forecast')
						),
			
						'taurus' => array(
										'id' => 'taurus',
										'name' => __('Taurus', 'daily-moon-forecast')
						),
			
						'gemini' => array(
										'id' => 'gemini',
										'name' => __('Gemini', 'daily-moon-forecast')
						),
			
						'cancer' => array(
										'id' => 'cancer',
										'name' => __('Cancer', 'daily-moon-forecast')
						),
			
						'leo' => array(
										'id' => 'leo',
										'name' => __('Leo', 'daily-moon-forecast')
						),
			
						'virgo' => array(
										'id' => 'virgo',
										'name' => __('Virgo', 'daily-moon-forecast')
						),
			
						'libra' => array(
										'id' => 'libra',
										'name' => __('Libra', 'daily-moon-forecast')
						),
			
						'scorpio' => array(
										'id' => 'scorpio',
										'name' => __('Scorpio', 'daily-moon-forecast')
						),
			
						'sagittarius' => array(
										'id' => 'sagittarius',
										'name' => __('Sagittarius', 'daily-moon-forecast'),
						),
			
						'capricorn' => array(
										'id' => 'capricorn',
										'name' => __('Capricorn', 'daily-moon-forecast')
						),
						'aquarius' => array(
										'id' => 'aquarius',
										'name' => __('Aquarius', 'daily-moon-forecast')
						),
			
						'pisces' => array(
										'id' => 'pisces',
										'name' => __('Pisces', 'daily-moon-forecast')
						),
			
			);
			
			foreach ( $dmf_settings as $dmf_setting ) {
					
				add_settings_field(
					$dmf_setting['id'], // unique id for the field
					sprintf(__( 'Moon in %s:', 'daily-moon-forecast' ), $dmf_setting['name'] ),
					array($this, 'dmfci_textarea_callback'), // callback
					'dmf',// page name
					'dmf_options_main',// id of the settings section
					array( 
						'sign' => $dmf_setting['id']
					)
				);	
				
			}
			
		}
			
		public function dmfci_textarea_callback( $args ) {
	
			$options = get_option('dmf_options');
			
			if( isset( $options[ $args['sign'] ] ) ) { $value = $options[ $args['sign'] ]; } else {	$value = ''; }
			?><textarea class="large-text" cols="50" rows="2" id='dmf_<?php echo $args['sign']; ?>' name='dmf_options[<?php echo $args['sign']; ?>]'><?php echo esc_textarea( $value ); ?></textarea><?php			
	
	    }
		public function sanitize( $input ) {
			return $input;
		}
		public function enqueue() {
			wp_register_style('dmf', plugins_url('/dmf.css', __FILE__));
			wp_register_style('dmf-style-rtl', plugins_url('/rtl.css', __FILE__) );
		}
		/**
		 * Load textdomain.
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'daily-moon-forecast', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Run necessary checks for plugin to work.
		 */
		public function plugins_loaded() {
			$this->is_sweph_executable();

			// Is this site hosted on Windows?
			if ( strtolower( PHP_SHLIB_SUFFIX ) === 'dll' ) {
				if ( ! defined( 'ZP_WINDOWS_SERVER' ) ) {
					add_action( 'admin_notices', array( $this, 'admin_notice_windows_server' ) );
				}
			}

		}
		/** 
		 * Registers the widget.
		 * @since 1.0
		 */
		public function register_widgets() {
			register_widget( 'dmf_widget' );
		}

		/** 
		 * Shortcode to insert widget anywhere
		 * @since 1.3.4
		 */
		public function dailymoonforecast_shortcode($atts) {
			extract( shortcode_atts( 
				array( 
					'title'  => __('Today\'s Moon Forecast', 'daily-moon-forecast'),
				), 
				$atts 
			));
			ob_start();
			the_widget( 'dmf_widget', $atts ); 
			$output = ob_get_clean();
			return $output;
		}

	/**
	 * Checks if the Ephemeris has the required file permissions.
	 *
	 * Attemps to set the proper permission.
	 * @since 2.0
	 * @return bool true if permission is (or gets set to) 0755, otherwise false
	 */
	public function is_sweph_executable() {

		$out			= true;
		$file			= DMF_PLUGIN_DIR . 'sweph/swetest';
		$permissions	= substr( sprintf( '%o', fileperms( $file ) ), -4 );

		if ( '0755' !== $permissions ) {

			// If chmod() is enabled
			if ( function_exists( 'chmod' ) &&
			// AND NOT in the array of disabled functions
			! in_array( 'chmod', array_map( 'trim', explode( ', ', ini_get( 'disable_functions' ) ) ) ) &&
			// AND NOT in safe mode
			ini_get( 'safe_mode' ) != 1
			) {

				// Attempt to change permission.
				$change = chmod( $file, 0755 );
				
				if ( ! $change ) {
					$out = false;
					add_action( 'admin_notices', array( $this, 'admin_notice_chmod_failed' ) );
				}
			} else {
				$out = false;
				add_action( 'admin_notices', array( $this, 'admin_notice_chmod_failed' ) );
			}
		}

		return $out;
	}

	/**
	 * Add admin notice when file permissions on ephemeris will not permit the plugin to work.
	 * @since 2.0
	 */
	public function admin_notice_chmod_failed() {

		if ( $this->is_plugin_admin_page() ) {
			$msg = sprintf( __( 'Your server did not allow Daily Moon Forecast to set the necessary file permissions for the Ephemeris. Daily Moon Forecast requires this in order to show the correct position of the moon. <a href="%s" target="_blank" rel="nofollow">See this</a> to fix it.', 'daily-moon-forecast' ), 'https://isabelcastillo.com/docs/about-daily-moon-forecast-wordpress-plugin#swetest' );

			printf( '<div class="notice notice-error is-dismissible"><p>%s</p></div>', $msg );
		}
	}

	/**
	 * Add admin notice when site is hosted on Windows server.
	 * @since 2.0
	 */
	public function admin_notice_windows_server() {

		if ( $this->is_plugin_admin_page() ) {
			$msg = sprintf( __( 'ERROR: Your website server is using a Windows operating system (Windows hosting). For Daily Moon Forecast to work on your server, you need the "ZP Windows Server" plugin. See <a href="%s" target="_blank" rel="nofollow">this</a> for details.', 'daily-moon-forecast' ), 'https://cosmicplugins.com/downloads/zodiacpress-windows-server/' );

			printf( '<div class="notice notice-error is-dismissible"><p>%s</p></div>', $msg );
		}
	}
	/**
	 * Determines whether the current page is a DMF admin page or the main plugins.php page.
	 * @since 2.0
	 */
	public function is_plugin_admin_page() {
		global $pagenow;

		$page	= isset( $_GET['page'] ) ? strtolower( sanitize_text_field( $_GET['page'] ) ) : false;
		$found	= false;

		if ( 'plugins.php' == $pagenow ||
			( 'options-general.php' == $pagenow && 'dmf' == $page ) ) {
			$found = true;
		}
		return $found;
	}

	}
}
$Daily_Moon_Forecast = Daily_Moon_Forecast::get_instance();
add_shortcode( 'dailymoonforecast', array( $Daily_Moon_Forecast, 'dailymoonforecast_shortcode' ) );
