<?php
/**
 * Timber theme
 */

// Load Composer dependencies.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


if ( file_exists( dirname( __FILE__ ) . '/src/StarterSite.php' ) ) {
    require_once dirname( __FILE__ ) . '/src/StarterSite.php';
}

/**
 * Initialize all the core classes of the theme
 */
if ( class_exists( 'App\\Init' ) ) {
    App\Init::register_services();
}

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new StarterSite();
