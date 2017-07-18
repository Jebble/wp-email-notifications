<?php

add_filter( 'rwmb_meta_boxes', 'jb_wpen_register_meta_boxes' );
function jb_wpen_register_meta_boxes( $meta_boxes ) {

    $prefix = 'jb_wpen_';

	$meta_boxes[] = array(
        'id'         => 'jb_wpen-email-information',
        'title'      => __( 'Email information', 'jb_wpen' ),
        'post_types' => array( 'jb_wpen' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
        	array(
                'name'  => __( 'Subject', 'jb_wpen' ),
                'id'    => $prefix . 'email_subject',
                'type'  => 'text',
                'desc'	=> __( 'The subject for the email', 'jb_wpen' ),
                'attributes' => array( 'required' => 'required' )
            ),
            array(
                'name'  => __( 'From name', 'jb_wpen' ),
                'id'    => $prefix . 'email_from_name',
                'type'  => 'text',
                'desc'	=> __( 'The name specified as the email sender', 'jb_wpen' )
            ),
            array(
                'name'  => __( 'From email', 'jb_wpen' ),
                'id'    => $prefix . 'email_from_email',
                'type'  => 'text',
                'desc'	=> __( 'The email specified as the email sender', 'jb_wpen' )
            ),
            array(
                'name'  => __( 'Attachments', 'jb_wpen' ),
                'id'    => $prefix . 'email_attachments',
                'type'  => 'file_advanced'
            ),
            array(
                'name'  => __( 'Logo / Header image', 'jb_wpen' ),
                'id'    => $prefix . 'email_logo',
                'type'  => 'file_advanced',
                'max_file_uploads' => 1,
                'desc' 	=> __( 'This image will be shown centered above the email.', 'jb_wpen' )
            ),
        )
    );

    return $meta_boxes;
}