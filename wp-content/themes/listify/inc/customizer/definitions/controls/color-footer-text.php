<?php
/**
 * Footer Text Color
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'color-footer-text', array(
	'default' => listify_theme_color( 'color-footer-text' ),
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize,
	'color-footer-text',
	array(
		'label' => __( 'Footer Text Color', 'listify' ),
		'priority' => 40,
		'section' => 'color-footer'
	) 
) );
