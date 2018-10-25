<?php

add_shortcode( 'platy-gallery', 'platy_gallery' );
function platy_gallery( $atts ) {

    $atts = shortcode_atts(
        array(
            'gallery_id' => ''
        ),
        $atts
    );
    $rows = get_field('add_new_gallery', 'option' );

    if($rows) {
        foreach( $rows as $row ) {
            if( $row['gallery_id'] == $atts['gallery_id'] ) {
                $gallery = $row;
                break;
            } else {
                echo '<div id="shortcode-error"><p>Shortcode Invalid! Check gallery ID.</p></div>';
            }
        }
    }

    $array_gallery = array();
    
    if( $gallery ) {
        foreach ( $gallery['thumbnail_gal_images'] as $gallery_image ) {

            // $gallery_filters = implode( ' ', get_field( 'image_tags', $gallery_image['id'] ) );
            $gallery_filters = get_field( 'image_tags', $gallery_image['id'] );

            array_push( $array_gallery, array(
                'image_url' => $gallery_image['url'],
                'medium_image_url' => $gallery_image['sizes']['medium'],
                'image_alt' => $gallery_image['alt'],
                'image_filter' => $gallery_filters
            ) );
        }
    } 
    
    $filters = array();
    if( $gallery['gallery_type'] == 'filter-gal' ) {
        //$filters = get_field('group', 'option' );
        $filters = $gallery['select_menu_filters'];
    }

    $vue_atts = esc_attr( json_encode( [
        'gallery'       => $array_gallery, 
        'type' => $gallery['gallery_type'],
        'filters'   => $filters,

    ] ) );

    return "<div id='mix-gallery' data-gallery-atts='{$vue_atts}'>loading poll...</div>";

}