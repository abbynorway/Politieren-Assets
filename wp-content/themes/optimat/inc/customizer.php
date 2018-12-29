<?php

/////////////////
// LOGO UPLOAD //
/////////////////

function an_setup() {
    add_theme_support('custom-logo');
    }

add_action('after_setup_theme','an_setup');


////////////////////////////////////////////
// Create Logo Setting and Upload Control //
///////////////////////////////////////////

function an_new_customizer_settings($wp_customize) {

///////////////////////////////////////////////////////////////////
//                      PANEL: STARTSEITE                       //
//////////////////////////////////////////////////////////////////
    
// Create custom panel.
	$wp_customize->add_panel( 'homepage', array(
		'priority'       => 130,
		'title'          => __( 'Startseite', 'lvh' ),
		'description'    => __( 'Die Inhalte auf der Startseite editieren.', 'lvh' ),
	) );
    
///////////////////////////////////////////////////////////////////
//                      SECTION: Über uns                       //
//////////////////////////////////////////////////////////////////
    
// Add section.
    $wp_customize->add_section( 'lvh_start', array(
        'title'     => 'Startseite',
        'priority'  => 201
        )
    );
    
// Add setting
    $wp_customize->add_setting( 'lvh_start_image', array(
        'default'      => '',
        'transport'    => 'postMessage'
        )
    );

// Add control
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize, 'lvh_start_image', array(
            'label'    => 'Foto auf der STartseite',
            'settings' => 'lvh_start_image',
            'section'  => 'lvh_start'
        )
    )
);   
    
// Add setting
	$wp_customize->add_setting( 'lvh_start_copyright', array(
		 'default'           => __( '(c) peter maffia', 'lvh' ),
		 'sanitize_callback' => 'sanitize_text'
	) );
    
// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'lvh_start_copyright',
		    array(
		        'label'    => __( 'Foto Copyright', 'lvh' ),
		        'section'  => 'lvh_start',
		        'settings' => 'lvh_start_copyright',
		        'type'     => 'text'
		    )
	    )
	); 
    
// Add setting
	$wp_customize->add_setting( 'lvh_start_head1', array(
		 'default'           => __( 'Landesverband Hochbegabung', 'lvh' ),
		 'sanitize_callback' => 'sanitize_text'
	) );
    
// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'lvh_start_head1',
		    array(
		        'label'    => __( 'Headline Startseite', 'lvh' ),
		        'section'  => 'lvh_start',
		        'settings' => 'lvh_start_head1',
		        'type'     => 'text'
		    )
	    )
	);     
    
// Add setting
	$wp_customize->add_setting( 'lvh_start_head2', array(
		 'default'           => __( 'Baden-Württemberg e.V.', 'lvh' ),
		 'sanitize_callback' => 'sanitize_text'
	) );
    
// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'lvh_start_head2',
		    array(
		        'label'    => __( 'Headline Startseite', 'lvh' ),
		        'section'  => 'lvh_start',
		        'settings' => 'lvh_start_head2',
		        'type'     => 'text'
		    )
	    )
	);    
    
    
 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
}


add_action('customize_register', 'an_new_customizer_settings');



?>