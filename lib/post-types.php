<?php

function jb_wpen_register_post_type() {

	$labels = array(
		'name'                => __( 'Emails ', 'jb_wpen' ),
		'singular_name'       => __( 'Email', 'jb_wpen' ),
		'add_new'             => _x( 'Add New Email', 'jb_wpen', 'jb_wpen' ),
		'add_new_item'        => __( 'Add New Email', 'jb_wpen' ),
		'edit_item'           => __( 'Edit Email', 'jb_wpen' ),
		'new_item'            => __( 'New Email', 'jb_wpen' ),
		'view_item'           => __( 'View Email', 'jb_wpen' ),
		'search_items'        => __( 'Search Emails', 'jb_wpen' ),
		'not_found'           => __( 'No Emails found', 'jb_wpen' ),
		'not_found_in_trash'  => __( 'No Emails found in Trash', 'jb_wpen' ),
		'parent_item_colon'   => __( 'Parent Email:', 'jb_wpen' ),
		'menu_name'           => __( 'Emails', 'jb_wpen' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 75,
		'menu_icon'           => 'dashicons-email-alt',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capabilities' => array(
			'edit_post'		         => "edit_jb_wpen",
			'read_post'		         => "read_jb_wpen",
			'delete_post'		     => "delete_jb_wpen",
			'edit_posts'		     => "edit_jb_wpen",
			'edit_others_posts'	     => "edit_others_jb_wpen",
			'publish_posts'		     => "publish_jb_wpen",
			'read_private_posts'	 => "read_private_jb_wpen",
			'delete_posts'           => "delete_jb_wpen",
			'delete_private_posts'   => "delete_private_jb_wpen",
			'delete_published_posts' => "delete_published_jb_wpen",
			'delete_others_posts'    => "delete_others_jb_wpen",
			'edit_private_posts'     => "edit_private_jb_wpen",
			'edit_published_posts'   => "edit_published_jb_wpen"
		),
		'supports'            => array( 'title', 'editor' )
	);

	register_post_type( 'jb_wpen', $args );
}

add_action( 'init', 'jb_wpen_register_post_type' );