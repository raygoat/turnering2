<?php
/**
 * Plugin Name: Fixtures
 * Plugin URI: http://fixtures.nl
 * Description: Spilleplan plugin til WP til visning af DBU Fixtures
 * Version: 1.0.0
 * Author: Ray Goat
 * Author URI: 
 * License: Private code
 */

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once( 'class.Turnament.php' );
require_once( 'class.Fixtures.php' );


function fixtures_main() {
    $kreds = isset( $_GET['k'] ) ? $_GET['k'] : 0;
    $age = isset( $_GET['a'] ) ? $_GET['a'] : 0;
    if( !$kreds ) {
        $turnament = new Turnament();
        $turnament->showTurnament();
    } else {
        echo "<h2>Spilleplan kreds " . $kreds . "</h2><br>";
        $fixtures = new Fixtures();
        $fixtures->setAge( $age );
        $fixtures->setKreds( $kreds );
        $fixtures->showFixtures();
    }

}

add_shortcode( 'fixtures', 'fixtures_main' );

