<?php 


function pepbrand_more_register( $wp_customize ) {

$wp_customize->add_section( 'pepthemes_more', array(
			'title'       => '' . esc_html__( 'View PRO Version', 'pepbrand' ),
			'priority'    => 2,
			'description' => sprintf(
				__( '<div class="upsell-container">
					
					<h2>Need More? Go PRO!</h2>
					
					<p> If you like the free version of this theme, 
					you will LOVE the full version of Pep Brand which 
					includes additional features 
					and more useful options to customize your website.</p>
					
                            
                   %s </div>', 'pepbrand' ),

			sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( pepbrand_get_pro_link() ), esc_html__( 'View Pep Brand PRO', 'pepbrand' ) )
			),
			) );

		$wp_customize->add_setting( 'pepbrand_more_desc', array(
			'default'           => '',
			'sanitize_callback' => 'pepbrand_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'pepbrand_more_desc', array(
			'section' => 'pepthemes_more',
			'type'    => 'hidden',
		) );

}
add_action( 'customize_register', 'pepbrand_more_register');


function pepbrand_get_pro_link() {
		return 'http://pepthemes.com/p/pepbrand/';
	}