<?php

/**
 * Enqueue
 */

function jb_wpen_admin_enqueue( $page ) {
    if ( $page == 'jb_wpen_page_jb_wpen-settings' ) {
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'jb_wpen-main', plugins_url( '../assets/js/main.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}
add_action( 'admin_enqueue_scripts', 'jb_wpen_admin_enqueue' );

/**
 * Setup Menu pages
 */
function jb_wpen_setup_menu_pages() {
	add_submenu_page( 'edit.php?post_type=jb_wpen', __( 'Settings', 'jb_wpen' ), __( 'Settings', 'jb_wpen' ), 'manage_options', 'jb_wpen-settings', 'jb_wpen_settings_callback' );
}
add_action( 'admin_menu', 'jb_wpen_setup_menu_pages' );

function jb_wpen_settings_callback() {
	include( JB_WPEN_DIR . 'partials/settings-page.php' );
}


/**
 * Setup Settings
 */

function jb_wpen_setup_settings() {

	// Settings
	register_setting( 'jb_wpen-settings', 'jb_wpen-bgcolor' );
	register_setting( 'jb_wpen-settings', 'jb_wpen-container-bgcolor' );
	register_setting( 'jb_wpen-settings', 'jb_wpen-textcolor' );

    add_settings_section( 'jb_wpen-section-layout', __( 'Layout', 'jb_wpen' ), 'intval', 'jb_wpen_settings_sections' );

    // Background color
    add_settings_field( 'jb_wpen-settings-layout-bgcolor', __( 'Background color', 'jb_wpen' ), 'jb_wpen_settings_layout_bgcolor', 'jb_wpen_settings_sections', 'jb_wpen-section-layout' );
    // Container background color
    add_settings_field( 'jb_wpen-settings-layout-container-bgcolor', __( 'Container background color', 'jb_wpen' ), 'jb_wpen_settings_layout_container_bgcolor', 'jb_wpen_settings_sections', 'jb_wpen-section-layout' );
    // Text color
    add_settings_field( 'jb_wpen-settings-layout-textcolor', __( 'Text color', 'jb_wpen' ), 'jb_wpen_settings_layout_textcolor', 'jb_wpen_settings_sections', 'jb_wpen-section-layout' );
}
add_action( 'admin_init', 'jb_wpen_setup_settings' );

function jb_wpen_settings_layout_bgcolor() {

	if ( ! $value = get_option( 'jb_wpen-bgcolor' ) ) {
		$value = '#f2f2f2';
	}
	echo '<input type="text" name="jb_wpen-bgcolor" class="jb_wpen-color" value="' . esc_attr( $value ) . '" data-default-color="#f2f2f2">';
}

function jb_wpen_settings_layout_container_bgcolor() {
	if ( ! $value = get_option( 'jb_wpen-container-bgcolor' ) ) {
		$value = '#ffffff';
	}
	echo '<input type="text" name="jb_wpen-container-bgcolor" class="jb_wpen-color" value="' . esc_attr( $value ) . '" data-default-color="#ffffff">';
}

function jb_wpen_settings_layout_textcolor() {
	if ( ! $value = get_option( 'jb_wpen-textcolor' ) ) {
		$value = '#424242';
	}
	echo '<input type="text" name="jb_wpen-textcolor" class="jb_wpen-color" value="' . esc_attr( $value ) . '" data-default-color="#424242">';
}

/**
 * JB_WPEN Email Posts Columns
 */
/** Manage which columns show */
function jb_wpen_columns( $columns ) {

	unset( $columns['date'] );
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-score-readability'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );

	$columns['usage'] = __( 'Usage', 'jb_wpen' );
	$columns['documentation'] = __( 'Documentation', 'jb_wpen' );

	return $columns;
}
add_filter( 'manage_jb_wpen_posts_columns', 'jb_wpen_columns', 15 );


/**
 * Columns content
 */
function jb_wpen_columns_content( $column_name, $post_id ) {

	switch ( $column_name ) {
		case 'usage':
			echo '<pre>',
				'$email = new JB_WPEN_Email_Notification( ' . $post_id . ' );<br />',
				'$email->send( [\'recipient@domain.com\'] );',
			'</pre>';
		break;
		case 'documentation':
			echo '<a href="https://bitbucket.org/internative/internative-email-notifications"  target="_blank">Documentation</a>';
			break;
	}
}
add_action( 'manage_jb_wpen_posts_custom_column', 'jb_wpen_columns_content', 10, 2 );
