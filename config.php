<?php

if ( function_exists('get_option') && is_array(get_option('wprnd-options'))):
    $opt	= get_option('wprnd-options');

    // config
    $wprnd_by_default	= $opt['round_by_default']; // true by default, any posted image will receive rounded corners
    $wprnd_page_slug	= $opt['page_slug'];	// for wp-admin
    $wprnd_escape_class	= $opt['rounded_class'];	// image will not receive rounding
    $wprnd_rounded_class	= $opt['escape_class'];	// image will receive rounding
    $wprnd_dimensions	= $opt['dimensions'];	// image dimensions, MUST BE IN PIXELS!
    
    define('WPRND_SMALL',	'wp-rounded-img-small');
    define('WPRND_MED',	'wp-rounded-img-med');
    define('WPRND_LARGE',	'wp-rounded-img-large');
    define('WPRND_CUSTOM',	'' );
    
    $wprnd_size		= $opt['size'];

else:
    
    // config
    $wprnd_by_default	= true; // true by default, any posted image will receive rounded corners
    $wprnd_page_slug	= 'wprnd_page';	// for wp-admin
    $wprnd_escape_class	= "wp-rounded-off";	// image will not receive rounding
    $wprnd_rounded_class	= "wp-rounded-on";	// image will receive rounding
    $wprnd_dimensions	= "8px";	// image dimensions, MUST BE IN PIXELS!
    
    define('WPRND_SMALL',	'wp-rounded-img-small');
    define('WPRND_MED',	'wp-rounded-img-med');
    define('WPRND_LARGE',	'wp-rounded-img-large');
    define('WPRND_CUSTOM',	'' );
    
    $wprnd_size		= WPRND_CUSTOM;

endif;
?>