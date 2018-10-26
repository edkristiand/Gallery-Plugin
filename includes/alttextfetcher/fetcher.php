<?php
/*
 * Plugin Name: Alt Text Fetcher
 * Version: 2.0
 * Description: Fetch alt text from media library and set it as alt text of the images in the website.
 * Author: Braudy Pedrosa
 * Requires at least: 4.0
 * Tested up to: 4.8
 *
 *
 * @package WordPress
 * @author Braudy Pedrosa
 * @since 1.0.0
 */

add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

    if ( wp_attachment_is_image( $post_ID ) ) {

        $my_image_title = get_post( $post_ID )->post_title;
        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );
        $my_image_title = ucwords( strtolower( $my_image_title ) );

        $my_image_meta = array(
            'ID'        => $post_ID,            
            'post_title'    => $my_image_title, 
        );

        update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
        wp_update_post( $my_image_meta );

    } 
}