<?php
/*
Plugin Name: WordPress Rounded Images
Plugin URI: http://www.spintheweb.org
Description: Rounds any images posted, offering a variety of configurations
Author: spintheweb
Version: 1
Author URI: http://www.spintheweb.org
*/
$wprnd_url	= trailingslashit( get_bloginfo('url') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
$wprnd_path	= WP_PLUGIN_DIR."/".dirname( plugin_basename(__FILE__) );

include('config.php');

require('wprnd-core.php');
require('wprnd-admin.php');
require('wprnd-install.php');

global $wprnd_by_default;
global $wprnd_page_slug;
global $wprnd_escape_class;
global $wprnd_rounded_class;
global $wprnd_dimensions;
global $wprnd_size;

/********************* INSTALATION/UNINSTALLATION *****************************/
register_activation_hook( __FILE__, "wprnd_install" );
register_deactivation_hook( __FILE__, "wprnd_uninstall" );


?>