<?php

/**************************** INSTALLATION/UNINSTALLATION *********************/

function	wprnd_install() {
    global $wprnd_by_default;
    global $wprnd_page_slug;
    global $wprnd_escape_class;
    global $wprnd_rounded_class;
    global $wprnd_dimensions;
    
    global $wprnd_size;
    
    // config
    $wprnd_by_default	= false; // true by default, any posted image will receive rounded corners
    $wprnd_page_slug	= 'wprnd_page';	// for wp-admin
    $wprnd_escape_class	= "wp-rounded-off";	// image will not receive rounding
    $wprnd_rounded_class	= "wp-rounded-on";	// image will receive rounding
    $wprnd_dimensions	= "8px";	// image dimensions, MUST BE IN PIXELS!
    
    define('WPRND_SMALL',	'wp-rounded-img-small');
    define('WPRND_MED',	'wp-rounded-img-med');
    define('WPRND_LARGE',	'wp-rounded-img-large');
    define('WPRND_CUSTOM',	'' );
    
    $wprnd_size		= WPRND_CUSTOM;
    
    $wprnd_options	= array(
	'round_by_default'	=> $wprnd_by_default,
	'page_slug'		=> $wprnd_page_slug,
	'escape_class'		=> $wprnd_escape_class,
	'round_class'		=> $wprnd_rounded_class,
	'dimensions'		=> $wprnd_dimensions,
	'size'			=> $wprnd_size
    );

    add_option('wprnd-options', $wprnd_options);
}

function	wprnd_uninstall() {
    delete_option('wprnd-options');
}

?>