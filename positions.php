<?php
/**
 * Plugin Name: Positions
 * Plugin URI: http://positions.nl
 * Description: Spilleplan plugin til WP til visning af DBU Positions
 * Version: 1.0.0
 * Author: Ray Goat
 * Author URI: 
 * License: Private code
 */

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once( 'class.Turnament.php' );
require_once( 'class.Positions.php' );


function positions_main() {
    $kreds = isset( $_GET['k'] ) ? $_GET['k'] : 0;
    $age = isset( $_GET['a'] ) ? $_GET['a'] : 0;
    if( !$kreds ) {
        $turnament = new Turnament();
        $turnament->showTurnament();
    } else {
	    echo "<h2>Stilling kreds " . $kreds . "</h2><br>";
        $standings = new Positions;
        $standings->setAge( $age );
        $standings->setKreds( $kreds );
        $standings->showPositions();
    }

}

add_shortcode( 'positions', 'positions_main' );

