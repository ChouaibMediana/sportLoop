<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Fitness_Gym_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-fitness-gym' ),
				'family'      => esc_html__( 'Font Family', 'vw-fitness-gym' ),
				'size'        => esc_html__( 'Font Size',   'vw-fitness-gym' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-fitness-gym' ),
				'style'       => esc_html__( 'Font Style',  'vw-fitness-gym' ),
				'line_height' => esc_html__( 'Line Height', 'vw-fitness-gym' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-fitness-gym' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-fitness-gym-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-fitness-gym-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-fitness-gym' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-fitness-gym' ),
        'Acme' => __( 'Acme', 'vw-fitness-gym' ),
        'Anton' => __( 'Anton', 'vw-fitness-gym' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-fitness-gym' ),
        'Arimo' => __( 'Arimo', 'vw-fitness-gym' ),
        'Arsenal' => __( 'Arsenal', 'vw-fitness-gym' ),
        'Arvo' => __( 'Arvo', 'vw-fitness-gym' ),
        'Alegreya' => __( 'Alegreya', 'vw-fitness-gym' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-fitness-gym' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-fitness-gym' ),
        'Bangers' => __( 'Bangers', 'vw-fitness-gym' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-fitness-gym' ),
        'Bad Script' => __( 'Bad Script', 'vw-fitness-gym' ),
        'Bitter' => __( 'Bitter', 'vw-fitness-gym' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-fitness-gym' ),
        'BenchNine' => __( 'BenchNine', 'vw-fitness-gym' ),
        'Cabin' => __( 'Cabin', 'vw-fitness-gym' ),
        'Cardo' => __( 'Cardo', 'vw-fitness-gym' ),
        'Courgette' => __( 'Courgette', 'vw-fitness-gym' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-fitness-gym' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-fitness-gym' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-fitness-gym' ),
        'Cuprum' => __( 'Cuprum', 'vw-fitness-gym' ),
        'Cookie' => __( 'Cookie', 'vw-fitness-gym' ),
        'Chewy' => __( 'Chewy', 'vw-fitness-gym' ),
        'Days One' => __( 'Days One', 'vw-fitness-gym' ),
        'Dosis' => __( 'Dosis', 'vw-fitness-gym' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-fitness-gym' ),
        'Economica' => __( 'Economica', 'vw-fitness-gym' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-fitness-gym' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-fitness-gym' ),
        'Francois One' => __( 'Francois One', 'vw-fitness-gym' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-fitness-gym' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-fitness-gym' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-fitness-gym' ),
        'Handlee' => __( 'Handlee', 'vw-fitness-gym' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-fitness-gym' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-fitness-gym' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-fitness-gym' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-fitness-gym' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-fitness-gym' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-fitness-gym' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-fitness-gym' ),
        'Kanit' => __( 'Kanit', 'vw-fitness-gym' ),
        'Lobster' => __( 'Lobster', 'vw-fitness-gym' ),
        'Lato' => __( 'Lato', 'vw-fitness-gym' ),
        'Lora' => __( 'Lora', 'vw-fitness-gym' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-fitness-gym' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-fitness-gym' ),
        'Merriweather' => __( 'Merriweather', 'vw-fitness-gym' ),
        'Monda' => __( 'Monda', 'vw-fitness-gym' ),
        'Montserrat' => __( 'Montserrat', 'vw-fitness-gym' ),
        'Muli' => __( 'Muli', 'vw-fitness-gym' ),
        'Marck Script' => __( 'Marck Script', 'vw-fitness-gym' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-fitness-gym' ),
        'Open Sans' => __( 'Open Sans', 'vw-fitness-gym' ),
        'Overpass' => __( 'Overpass', 'vw-fitness-gym' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-fitness-gym' ),
        'Oxygen' => __( 'Oxygen', 'vw-fitness-gym' ),
        'Orbitron' => __( 'Orbitron', 'vw-fitness-gym' ),
        'Patua One' => __( 'Patua One', 'vw-fitness-gym' ),
        'Pacifico' => __( 'Pacifico', 'vw-fitness-gym' ),
        'Padauk' => __( 'Padauk', 'vw-fitness-gym' ),
        'Playball' => __( 'Playball', 'vw-fitness-gym' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-fitness-gym' ),
        'PT Sans' => __( 'PT Sans', 'vw-fitness-gym' ),
        'Philosopher' => __( 'Philosopher', 'vw-fitness-gym' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-fitness-gym' ),
        'Poiret One' => __( 'Poiret One', 'vw-fitness-gym' ),
        'Quicksand' => __( 'Quicksand', 'vw-fitness-gym' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-fitness-gym' ),
        'Raleway' => __( 'Raleway', 'vw-fitness-gym' ),
        'Rubik' => __( 'Rubik', 'vw-fitness-gym' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-fitness-gym' ),
        'Russo One' => __( 'Russo One', 'vw-fitness-gym' ),
        'Righteous' => __( 'Righteous', 'vw-fitness-gym' ),
        'Slabo' => __( 'Slabo', 'vw-fitness-gym' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-fitness-gym' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-fitness-gym'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-fitness-gym' ),
        'Sacramento' => __( 'Sacramento', 'vw-fitness-gym' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-fitness-gym' ),
        'Tangerine' => __( 'Tangerine', 'vw-fitness-gym' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-fitness-gym' ),
        'VT323' => __( 'VT323', 'vw-fitness-gym' ),
        'Varela Round' => __( 'Varela Round', 'vw-fitness-gym' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-fitness-gym' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-fitness-gym' ),
        'Volkhov' => __( 'Volkhov', 'vw-fitness-gym' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-fitness-gym' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-fitness-gym' ),
			'100' => esc_html__( 'Thin',       'vw-fitness-gym' ),
			'300' => esc_html__( 'Light',      'vw-fitness-gym' ),
			'400' => esc_html__( 'Normal',     'vw-fitness-gym' ),
			'500' => esc_html__( 'Medium',     'vw-fitness-gym' ),
			'700' => esc_html__( 'Bold',       'vw-fitness-gym' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-fitness-gym' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-fitness-gym' ),
			'normal'  => esc_html__( 'Normal', 'vw-fitness-gym' ),
			'italic'  => esc_html__( 'Italic', 'vw-fitness-gym' ),
			'oblique' => esc_html__( 'Oblique', 'vw-fitness-gym' )
		);
	}
}
