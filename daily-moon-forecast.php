<?php
/*
Plugin Name: Daily Moon Forecast
Plugin URI: http://isabelcastillo.com/docs/category/daily-moon-forecast-wordpress-plugin
Description: Display the current moon zodiac sign along with a forecast, with option to add custom forecasts.
Version: 1.4.3
Author: Isabel Castillo
Author URI: http://isabelcastillo.com
License: GPL2
Text Domain: dmf
Domain Path: languages

Copyright 2013 - 2014 Isabel Castillo

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
if(!class_exists('Daily_Moon_Forecast')) {
	class Daily_Moon_Forecast{

	    public function __construct() {
	
		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		add_action('admin_init', array($this, 'page_init'));
	
		if( ! defined( 'DMF_PLUGIN_DIR' ) )
			define( 'DMF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		require_once DMF_PLUGIN_DIR . 'dmf-widget.php';
	    }
	
		public function add_plugin_page(){
			add_options_page(__('Daily Moon Forecast', 'dmf'), __('Daily Moon Forecast', 'dmf'), 'manage_options', 'dmf', array($this, 'create_admin_page'));
	    }
		
		public function create_admin_page(){
	        ?>
		<div class="wrap">
		    <?php screen_icon(); ?>
		    <h2><?php _e( 'Daily Moon Forecast - Custom Interpretations', 'dmf'); ?></h2>	
			<br /><a class="button-primary" target="_blank" title="Rate This Plugin" href="http://wordpress.org/support/view/plugin-reviews/daily-moon-forecast"><?php _e('Rate This Plugin', 'dmf'); ?></a>
		    <form method="post" action="options.php">
		        <?php
	                // This prints out all hidden setting fields
					settings_fields('dmf_options');	// @param 1 must be same as register settings'
					do_settings_sections('dmf');// page slug must match 4th param of add_settings_section
					submit_button(); ?>
		    </form>
		</div>
		<?php
	    }
		
		public function page_init(){	
			register_setting('dmf_options', 'dmf_options', array($this, 'sanitize'));
			// @param 1 must be same as the group name in settings_fields'
			// 2nd param is name of the option, will be an array
			add_settings_section(
				'dmf_options_main',// unique id for the section
				__('Enter your custom interpretation for each Moon sign.', 'dmf' ),
				false,// function callback to display
				'dmf'// page name. Must match the do_settings_sections function call. and match options menu page
			);	
			
			

			$dmf_settings = array(
				
						'aries' => array(
										'id' => 'aries',
										'name' => __('Aries', 'dmf')// just capital sign
						),
			
						'taurus' => array(
										'id' => 'taurus',
										'name' => __('Taurus', 'dmf')
						),
			
						'gemini' => array(
										'id' => 'gemini',
										'name' => __('Gemini', 'dmf')
						),
			
						'cancer' => array(
										'id' => 'cancer',
										'name' => __('Cancer', 'dmf')
						),
			
						'leo' => array(
										'id' => 'leo',
										'name' => __('Leo', 'dmf')
						),
			
						'virgo' => array(
										'id' => 'virgo',
										'name' => __('Virgo', 'dmf')
						),
			
						'libra' => array(
										'id' => 'libra',
										'name' => __('Libra', 'dmf')
						),
			
						'scorpio' => array(
										'id' => 'scorpio',
										'name' => __('Scorpio', 'dmf')
						),
			
						'sagittarius' => array(
										'id' => 'sagittarius',
										'name' => __('Sagittarius', 'dmf'),
						),
			
						'capricorn' => array(
										'id' => 'capricorn',
										'name' => __('Capricorn', 'dmf')
						),
						'aquarius' => array(
										'id' => 'aquarius',
										'name' => __('Aquarius', 'dmf')
						),
			
						'pisces' => array(
										'id' => 'pisces',
										'name' => __('Pisces', 'dmf')
						),
			
			); // end $dmf_settings
			
			
			
			foreach($dmf_settings as $dmf_setting) {
					
				add_settings_field(
					$dmf_setting['id'], // unique id for the field
					sprintf(__( 'Moon in %s:', 'dmf' ), $dmf_setting['name'] ),
					array($this, 'dmfci_textarea_callback'), // callback
					'dmf',// page name that this is attached to (same as the do_settings_sections)
					'dmf_options_main',	// the id of the settings section that this goes into (same as the first argument to add_settings_section).
					array( 
						'sign' => $dmf_setting['id']
					)
				);	
				
			} // end foreach
			
		} // end page_init
		
	
		public function dmfci_textarea_callback($args){
	
			$options = get_option('dmf_options');
			
			if( isset( $options[ $args['sign'] ] ) ) { $value = $options[ $args['sign'] ]; } else {	$value = ''; }

			// name must start with the second argument passed to register_setting
		
?><textarea class="large-text" cols="50" rows="2" id='dmf_<?php echo $args['sign']; ?>' name='dmf_options[<?php echo $args['sign']; ?>]'><?php echo esc_textarea( $value ); ?></textarea><?php			
	
	    }
		public function sanitize($input){
			return $input;
		}
		public function enqueue() {
			wp_register_style('dmf', plugins_url('/dmf.css', __FILE__));
			wp_register_style('dmf-style-rtl', plugins_url('/rtl.css', __FILE__) );
		}
		public function plugins_loaded() {
			load_plugin_textdomain( 'dmf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			$wantedPerms = 0755;
			$actualPerms = substr(sprintf('%o', fileperms(DMF_PLUGIN_DIR . '/sweph/isabelse')), -4);
			if($actualPerms !== $wantedPerms)
			chmod(DMF_PLUGIN_DIR . '/sweph/isabelse', $wantedPerms);
		}
		/** 
		 * Registers the widget.
		 * @since 1.0
		 */
		function register_widgets() {
			register_widget( 'dmf_widget' );
		}

		/** 
		 * Shortcode to insert widget anywhere
		 * @since 1.3.4
		 */
		function dailymoonforecast_shortcode($atts) {
			// Configure defaults and extract the attributes into variables
			extract( shortcode_atts( 
				array( 
					'title'  => __('Today\'s Moon Forecast', 'dmf'),
				), 
				$atts 
			));
			ob_start();
			the_widget( 'dmf_widget', $atts ); 
			$output = ob_get_clean();
			return $output;
		}	

	}
}
$Daily_Moon_Forecast = new Daily_Moon_Forecast();
add_shortcode( 'dailymoonforecast', array( 'Daily_Moon_Forecast', 'dailymoonforecast_shortcode' ) );