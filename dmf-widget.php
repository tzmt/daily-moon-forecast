<?php
/**
 * Adds Daily Moon Forecast Widget
 *
 * @author	Isabel Castillo
 * @package 	Daily Moon Forecast
 * @extends 	WP_Widget
 */

class dmf_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'dmf_widget',
			__('Daily Moon Forecast', 'daily-moon-forecast'),
			array( 'description' => __( 'Display the current moon zodiac sign along with a forecast.', 'daily-moon-forecast' ), )
		);
	}

	function isa_get_moon_forecast($longitude) {
	
		$imgdir = plugins_url('/images/', __FILE__);
	
		$isa_moon_signs = array(
			array( 
				'id' => 'aries',
				'name' => __( 'Aries', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Aries today. Watch your head, but do jump in. It\'s time to conquer.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'taurus',
				'name' => __( 'Taurus', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through comfy Taurus today. Eat something you love. Have a second serving.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'gemini',
				'name' => __( 'Gemini', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through witty Gemini today. Call, text, send email, write letters. Visit someone you\'ve missed. Watch a movie and talk about it at a coffee shop. Be out and about. Don\'t sleep in.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'cancer',
				'name' => __( 'Cancer', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Cancer today. Beware of mood swings. Cook some soul food. Cuddle up with someone.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'leo',
				'name' => __( 'Leo', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Leo today. Shine and be proud! You rule right now!', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'virgo',
				'name' => __( 'Virgo', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through conscientious Virgo today. Watch for nagging. You probably are correct, but say it nicely. Run errands and don\'t forget to floss your teeth.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'libra',
				'name' => __( 'Libra', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through beautiful Libra today. Make it a date night. Smile, it looks good on you.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'scorpio',
				'name' => __( 'Scorpio', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Scorpio. Beware of jealousy. Passions are easily aroused. Desire is in the air. It\'s all or nothing, now. Love or hate, no middle ground. It\'s poker-face time.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'sagittarius',
				'name' => __( 'Sagittarius', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Sagittarius today. The grass looks greener on the other side during this time. Jump ship. Learn a new language. Tell it like it is. Make people laugh.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'capricorn',
				'name' => __( 'Capricorn', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Capricorn today. Make a list of goals. Work overtime. Climb higher. Don\'t sulk.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'aquarius',
				'name' => __( 'Aquarius', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Aquarius today. Go against the grain. Fight for a cause. Stand up for the underdog.', 'daily-moon-forecast' )
			),
			array( 
				'id' => 'pisces',
				'name' => __( 'Pisces', 'daily-moon-forecast' ),
				'interp' => __( 'Moon is traveling through Pisces today. You may feel disconnected. Serve others. Listen to music. Paint a picture. Daydream.', 'daily-moon-forecast' )
			),
		);
	
		foreach($isa_moon_signs as $isa_moon_sign) {
	
			$options = get_option('dmf_options');
		
			$interp = ( isset( $options[$isa_moon_sign['id']] ) && !empty($options[$isa_moon_sign['id']]) ) ? 
						$options[$isa_moon_sign['id']] : $isa_moon_sign['interp'];
	
			$isa_moon_forecast[] = '<h4>' . sprintf( __( 'Moon in %s', 'daily-moon-forecast' ) , $isa_moon_sign['name'] ) . '</h4><br /><img id="dmf-moonicon" alt="' . __('crescent moon button', 'daily-moon-forecast') . '" src="' . $imgdir . 'icon64-moon.png" /><img id="dmf-signicon" alt="' . $isa_moon_sign['name'] . __(' sign glyph symbol', 'daily-moon-forecast') . '" src="' . $imgdir . 'icon64-' . substr($isa_moon_sign['id'],0,3) . '.png" /><br /><p>' . $interp . '</p>';
	
		}

		
		// convert longitude decimal to sign num
		$sign_num = floor($longitude / 30);
	
		return $isa_moon_forecast[$sign_num];
	}

	
	/**
	 * Front-end display of widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */

	public function widget( $args, $instance ) {

		// get UT/GMT time for exec */
		
		$time = new DateTime('now', new DateTimeZone('UTC'));
		
		$utdate = $time->format('j').'.'.$time->format('n').'.'.$time->format('Y');// day.month.year (single-digit day, month, 4-digit month)
		$uttime = $time->format('H').'.'.$time->format('i').'.'.$time->format('s');  // HH:MM:SS
		
		$sweph = DMF_PLUGIN_DIR . 'sweph'; // set path to ephemeris
		
		unset($PATH,$moon);
		$PATH = '';// WordPress is picky picky
		putenv("PATH=$PATH:$sweph");
		
		// get moon, output is array $moon[0] = longitude decimal
		
		exec ("swetest -edir$sweph -b$utdate -ut$uttime -p1 -eswe -fl -g, -head", $moon);
		
		$moonlong = isset($moon[0]) ? $moon[0] : '';

		wp_enqueue_style('dmf');

		if ( is_rtl() ) {
			wp_enqueue_style( 'dmf-style-rtl' );
		}

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Today\'s Moon Forecast', 'daily-moon-forecast') : $instance['title'], $instance, $this->id_base ); 

		echo $args['before_widget'];

		if ( $title ) {
			echo '<h3 class="widget-title">'. $title . '</h3>';
		}

		// begin output to browser
		echo '<div id="moonforecast">' . $this->isa_get_moon_forecast($moonlong);

		// display local date and time
		echo '<p id="localtime">'; ?><script>var d=new Date();var n=d.toLocaleDateString();var t=d.toLocaleTimeString(); document.write(n + "<br />" + t);</script>
		<?php echo '</p>';
		echo "</div>";
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$defaults = array( 
					'title' => __('Today\'s Moon Forecast', 'daily-moon-forecast'),
					);
 		$instance = wp_parse_args( (array) $instance, $defaults );
    	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'daily-moon-forecast' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
				name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<?php 
	}
} ?>