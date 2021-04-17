<?php
// pagination
function theme_pagination( $pages = '' ) {

    global $paged;

    if ( is_page_template( 'template-home.php' ) ) {
        $paged = intval( get_query_var( 'page' ) );
    }

    if ( empty( $paged ) ) {
        $paged = 1;
    }

    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 2; // only change it to show more links
    $show_items = ( $range * 2 ) + 1;

    if ( $pages == '' ) {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if ( ! $pages ) {
            $pages = 1;
        }
    }

    if ( 1 != $pages ) {
        echo "<div class='pagination'>";
        echo ( $paged > 2 && $paged > $range + 1 && $show_items < $pages ) ? "<a href='" . get_pagenum_link( 1 ) . "' class='real-btn'>&laquo; " . __( 'First', 'framework' ) . "</a> " : "";
        echo ( $paged > 1 && $show_items < $pages ) ? "<a href='" . get_pagenum_link( $prev ) . "' class='real-btn' >&laquo; " . __( 'Previous', 'framework' ) . "</a> " : "";

        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $show_items ) ) {
                echo ( $paged == $i ) ? "<a href='" . get_pagenum_link( $i ) . "' class='real-btn current' >" . $i . "</a> " : "<a href='" . get_pagenum_link( $i ) . "' class='real-btn'>" . $i . "</a> ";
            }
        }

        echo ( $paged < $pages && $show_items < $pages ) ? "<a href='" . get_pagenum_link( $next ) . "' class='real-btn' >" . __( 'Next', 'framework' ) . " &raquo;</a> " : "";
        echo ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $show_items < $pages ) ? "<a href='" . get_pagenum_link( $pages ) . "' class='real-btn' >" . __( 'Last', 'framework' ) . " &raquo;</a> " : "";
        echo "</div>";
    }
}