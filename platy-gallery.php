<?php
/*
Plugin Name: Platy Gallery
Description: Plugin for Gallery Pages
Author: Ed Daguit
Author URI: http://www.platypuslocal.com/
*/

/* ----------------------------------------------------------------------
Plugin Includes
--------------------------------------------------------------------*/
include_once('includes/advanced-custom-fields-pro/acf.php');
include_once('includes/acf-repeater/acf-repeater.php');
include_once('shortcodes/gallery-shortcodes.php');
include_once('custom-fields/custom-fields.php');

if(function_exists("register_options_page")) { 
	register_options_page('Galleries'); 
}

if( function_exists('acf_add_options_sub_page') ) {
	acf_add_options_sub_page('Gallery Filters');
}


add_action( 'wp_enqueue_scripts', 'frontend_scripts' );
function frontend_scripts() {

	wp_enqueue_style('main-style', plugin_dir_url( __FILE__ ) .'css/style.css');

	//FANCY BOX
	wp_enqueue_style('fancybox-css', plugin_dir_url( __FILE__ ) .'includes/fancybox/jquery.fancybox.min.css');
	wp_enqueue_script('fancybox-js', plugin_dir_url( __FILE__ ) .'includes/fancybox/jquery.fancybox.min.js', array(), false, true);

	//SLICK
	wp_enqueue_style('slick-css', plugin_dir_url( __FILE__ ) .'includes/slick/slick.css');
	wp_enqueue_style('slick-theme', plugin_dir_url( __FILE__ ) .'includes/slick/slick-theme.css');
	wp_enqueue_script('slick-js', plugin_dir_url( __FILE__ ) .'includes/slick/slick.min.js', array(), false, true);

	//ISOTOPE
	wp_enqueue_script('isotope-js', plugin_dir_url( __FILE__ ) .'includes/isotope/isotope.pkgd.min.js', array(), false, true);

	//VUE
	wp_enqueue_script('vue-js', plugin_dir_url( __FILE__ ) .'includes/vue/vue.js', array(), false, true);
	wp_enqueue_script('lodash-js', plugin_dir_url( __FILE__ ) .'includes/vue/lodash.min.js', array(), false, true);
	wp_enqueue_script('vueisotope-js', plugin_dir_url( __FILE__ ) .'includes/vue/vue_isotope.js', array(), false, true);

	//CUSTOM
	wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ) .'js/custom.js', array(), false, true);
	wp_enqueue_script('vuethumbnail-js', plugin_dir_url( __FILE__ ) .'js/vue-gallery.js', array(), false, true);

}


add_filter('acf/load_field/name=image_tags', 'acf_load_select_field_choices');
add_filter('acf/load_field/name=select_menu_filters', 'acf_load_select_field_choices');
function acf_load_select_field_choices( $field ) {

    $field['choices'] = array();

    if( have_rows('group', 'option') ) {
        
        while( have_rows('group', 'option') ) {
            
            the_row();
            
            $label = get_sub_field('category_name');

            $field['choices'][ $label ] = $label;
            
        }   
    }
    return $field; 
}
