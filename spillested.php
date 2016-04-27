<?php
/**
 * Plugin Name: Spillested
 * Plugin URI: http://spillested.nl
 * Description: Spillested plugin til WP til visning af info om spillesteder
 * Version: 1.0.0
 * Author: Ray Goat
 * Author URI: 
 * License: Private code
 */

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//require_once( 'class.Spillested.php' );


function spillested_main() {
    $stadion = isset( $_GET['s'] ) ? $_GET['s'] : 0;
    if( $stadion ) {
        echo "Stadion: " . $stadion;
    } else {
        echo "Uautoriseret!";
    }

}

add_shortcode( 'spillested', 'spillested_main' );
