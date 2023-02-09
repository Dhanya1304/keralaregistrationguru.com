<?php
/**
 * The template for adding Featured Content Settings in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Journal
 * @since Clean Journal 0.1 
 */

if ( ! defined( 'CLEAN_JOURNAL_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
	// Featured Content Options
	if ( 4.3 > get_bloginfo( 'version' ) ) {
		$wp_customize->add_panel( 'clean_journal_featured_content_options', array(
		    'capability'     => 'edit_theme_options',
			'description'    => __( 'Featured Content Options', 'clean-journal' ),
		    'priority'       => 400,
		    'title'    		 => __( 'Featured Content', 'clean-journal' ),
		) );


		$wp_customize->add_section( 'clean_journal_featured_content_settings', array(
			'panel'			=> 'clean_journal_featured_content_options',
			'priority'		=> 1,
			'title'			=> __( 'Featured Content Options', 'clean-journal' ),
		) );
	}
	else {
		$wp_customize->add_section( 'clean_journal_featured_content_settings', array(
			'priority'      => 400,
			'title'			=> __( 'Featured Content', 'clean-journal' ),
		) );
	}

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_option'],
		'sanitize_callback' => 'clean_journal_sanitize_select',
	) );

	$clean_journal_featured_slider_content_options = clean_journal_featured_slider_content_options();
	$choices = array();
	foreach ( $clean_journal_featured_slider_content_options as $clean_journal_featured_slider_content_option ) {
		$choices[$clean_journal_featured_slider_content_option['value']] = $clean_journal_featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_option]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Enable Featured Content on', 'clean-journal' ),
		'priority'	=> '1',
		'section'  	=> 'clean_journal_featured_content_settings',
		'settings' 	=> 'clean_journal_theme_options[featured_content_option]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_layout'],
		'sanitize_callback' => 'clean_journal_sanitize_select',
	) );

	$clean_journal_featured_content_layout_options = clean_journal_featured_content_layout_options();
	$choices = array();
	foreach ( $clean_journal_featured_content_layout_options as $clean_journal_featured_content_layout_option ) {
		$choices[$clean_journal_featured_content_layout_option['value']] = $clean_journal_featured_content_layout_option['label'];
	}

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_layout]', array(
		'active_callback'	=> 'clean_journal_is_featured_content_active',
		'choices'  			=> $choices,
		'label'    			=> __( 'Select Featured Content Layout', 'clean-journal' ),
		'priority'			=> '2',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_layout]',
		'type'	  			=> 'select',
	) );

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_position]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_position'],
		'sanitize_callback' => 'clean_journal_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_position]', array(
		'active_callback'	=> 'clean_journal_is_featured_content_active',
		'label'				=> __( 'Check to Move above Footer', 'clean-journal' ),
		'priority'			=> '3',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings'			=> 'clean_journal_theme_options[featured_content_position]',
		'type'				=> 'checkbox',
	) );

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_type'],
		'sanitize_callback'	=> 'clean_journal_sanitize_select',
	) );

	$clean_journal_featured_content_types = clean_journal_featured_content_types();
	$choices = array();
	foreach ( $clean_journal_featured_content_types as $clean_journal_featured_content_type ) {
		$choices[$clean_journal_featured_content_type['value']] = $clean_journal_featured_content_type['label'];
	}

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_type]', array(
		'active_callback'	=> 'clean_journal_is_featured_content_active',
		'choices'  			=> $choices,
		'label'    			=> __( 'Select Content Type', 'clean-journal' ),
		'priority'			=> '3',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_type]',
		'type'	  			=> 'select',
	) );

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_headline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_headline'],
		'sanitize_callback'	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_headline]' , array(
		'active_callback'	=> 'clean_journal_is_featured_content_active',
		'description'		=> __( 'Leave field empty if you want to remove Headline', 'clean-journal' ),
		'label'    			=> __( 'Headline for Featured Content', 'clean-journal' ),
		'priority'			=> '4',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_headline]',
		'type'	   			=> 'text',
		)
	);

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_subheadline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_subheadline'],
		'sanitize_callback'	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_subheadline]' , array(
		'active_callback'	=> 'clean_journal_is_featured_content_active',
		'description'		=> __( 'Leave field empty if you want to remove Sub-headline', 'clean-journal' ),
		'label'    			=> __( 'Sub-headline for Featured Content', 'clean-journal' ),
		'priority'			=> '5',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_subheadline]',
		'type'	   			=> 'text',
		) 
	);

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_number'],
		'sanitize_callback'	=> 'clean_journal_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_number]' , array(
		'active_callback'	=> 'clean_journal_is_demo_featured_content_inactive',
		'description'		=> __( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'clean-journal' ),
		'input_attrs' 		=> array(
						            'style' => 'width: 45px;',
						            'min'   => 0,
						            'max'   => 20,
						            'step'  => 1,
						        	),
		'label'    			=> __( 'No of Featured Content', 'clean-journal' ),
		'priority'			=> '6',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_number]',
		'type'	   			=> 'number',
		) 
	);

	$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_show]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_show'],
		'sanitize_callback'	=> 'clean_journal_sanitize_select',
	) ); 

	$clean_journal_featured_content_show = clean_journal_featured_content_show();
	$choices = array();
	foreach ( $clean_journal_featured_content_show as $clean_journal_featured_content_shows ) {
		$choices[$clean_journal_featured_content_shows['value']] = $clean_journal_featured_content_shows['label'];
	}

	$wp_customize->add_control( 'clean_journal_theme_options[featured_content_show]', array(
		'active_callback'	=> 'clean_journal_is_demo_featured_content_inactive',
		'choices'  			=> $choices,
		'label'    			=> __( 'Display Content', 'clean-journal' ),
		'priority'			=> '6.1',
		'section'  			=> 'clean_journal_featured_content_settings',
		'settings' 			=> 'clean_journal_theme_options[featured_content_show]',
		'type'	  			=> 'select',
	) );	



	//loop for featured page content
	for ( $i=1; $i <= $options['featured_content_number'] ; $i++ ) {
		$wp_customize->add_setting( 'clean_journal_theme_options[featured_content_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'clean_journal_sanitize_page',
		) );

		$wp_customize->add_control( 'clean_journal_theme_options[featured_content_page_'. $i .']', array(
			'active_callback'	=> 'clean_journal_is_demo_featured_content_inactive',
			'label'    			=> __( 'Featured Page', 'clean-journal' ) . ' ' . $i ,
			'priority'			=> '7' . $i,
			'section'  			=> 'clean_journal_featured_content_settings',
			'settings' 			=> 'clean_journal_theme_options[featured_content_page_'. $i .']',
			'type'	   			=> 'dropdown-pages',
		) );
	}
// Featured Content Setting End