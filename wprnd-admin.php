<?php

include_once("wprnd-core.php");

/**************************** ADMIN MENUS *************************************/
add_action('admin_menu', 'wprnd_add_menu'); // add WP Rounded Image menu

function	wprnd_add_menu() {
    global $wprnd_page_slug;	// use page slug as defined in config
    add_options_page( __('WordPress Rounded Image - Plugin Options'), __('WP Rounded Image'), 'manage_options', $wprnd_page_slug, 'wprnd_page');
}

function	wprnd_page() {
    global $wprnd_page_slug;	// use page slug as defined in config
    
    $opt	= get_option('wprnd-options');
    ?>
    <div class="wrap" id="<?php echo $wprnd_page_slug; ?>">
	<h2>WordPress Rounded Image - Plugin Options</h2>
	<table>
	    <tr>
		<td>Round corners by default?</td>
		<td><input type="checkbox" name="round_by_default" <?php if ( $opt['round_by_default'] === true || $opt['round_by_default'] === "true"): echo 'checked="checked"'; endif; ?> value="yes" / ></td>
	    </tr>
	    <tr>
		<td>Use WP Rounded Image Captions(overrides [caption] shortcode)?</td>
		<td><input type="checkbox" name="captions_on" <?php if ( $opt['round_by_default'] === true || $opt['round_by_default'] === "true"): echo 'checked="checked"'; endif; ?> value="yes" / ></td>
	    </tr>
	    <tr>
		<td>Rounded corners CSS class</td>
		<td><input type="text" name="round_class" value="<?php echo $opt['round_class']; ?>" / ></td>
	    </tr>
	    <tr>
		<td>No rounding CSS class</td>
		<td><input type="text" name="escape_class" value="<?php echo $opt['escape_class']; ?>" / ></td>
	    </tr>
	    <tr>
		<td colspan="2">
		    <br / >
	<input type="button" value="Default Settings" / >
	<input id="wprnd_update" type="button" value="Update" / >
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    <br / >
		    <strong>Make all images in *all* posts rounded?</strong>
		    <br / >
		    <input id="wprnd_round_all" type="button" value="Round All Corners" / >
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    <br / >
		    <strong>Remove rounding from *all* images in all posts?</strong>
		    <br / >
		    <input id="wprnd_remove_all" type="button" value="Remove All Rounding" / >
		</td>
	    </tr>
	</table>
    </div>
    <?php
}

add_action('admin_head', 'wprnd_js');
function wprnd_js() {
    global $wprnd_page_slug;
    $result1	= preg_match("/.+\/([^\/]+\.[a-z]+)\?(.+)/", $_SERVER['REQUEST_URI'], $subs );
    if ( stristr($subs[2], $wprnd_page_slug) ): // is this the right page for code execution?
?>
<script type="text/javascript" >
(function($){
wprnd	= {};
wprnd.ajax	= function(action, options ) {
    $.ajax( {
	    url:  "<?php echo esc_js(admin_url('admin-ajax.php')); ?>",
	    data: "_nonce=<?php echo esc_js(wp_create_nonce('wprnd')); ?>&action=wprnd_"+action+options,
	    success: function(dat){
	    }
    });
}

$(document).ready(function() {
    $("#wprnd_round_all").click(function(){
	wprnd.ajax('round_all');
    });
    $("#wprnd_remove_all").click(function(){
	wprnd.ajax('remove_all');
    });
    
    $("#wprnd_update").click(function() {
	var args	= "";
	$("input[type=checkbox]").each(function(el,i){
	    if ( $(this).attr('checked') )
		args += "&"+$(this).attr('name')+"=true";
	    else
		args += "&"+$(this).attr('name')+"=false";
	});
	$("input[type=text]").each(function(el,i){
		args += "&"+$(this).attr('name')+"="+$(this).attr('value');
	});
	wprnd.ajax('update', args);
    });
})
})(jQuery);
</script>
<?php
    endif;
}

add_action('wp_ajax_wprnd_update', 'wprnd_update');
add_action('wp_ajax_wprnd_round_all', 'wprnd_round_all');
add_action('wp_ajax_wprnd_remove_all', 'wprnd_remove_all');

function	wprnd_update() {
    global $wpdb;
    
    $opt	= get_option('wprnd-options');
    
    foreach ( array_keys($opt) as $k )
	if ( isset($_GET[$k]) )
	    $opt[$k]	= $_GET[$k];
	    
    update_option('wprnd-options', $opt);
}

function	wprnd_round_all() {
    global $wpdb;
    //get every post
    //for each post
    //wprnd_replace
    $posts	= $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->posts));

    foreach ( $posts as $p ) {
	print $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET `post_content` = %s WHERE ID = $p->ID", wprnd_replace($p->post_content, true)));
    }
}

function	wprnd_remove_all() {
    global $wpdb;
    //get every post
    //for each post
    //wprnd_replace
    $posts	= $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->posts));

    foreach ( $posts as $p ) {
	print $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET `post_content` = %s WHERE ID = $p->ID", wprnd_replace($p->post_content, false)));
    }
}

?>