<?php

/**************************** CORE FUNCTIONALITY ******************************/

add_action('pre_post_content', 'wprnd_replace', 1, 1 ); // after you hit update/publish
add_action( 'wp_head', 'wprnd_styles' ); // add wprnd styling to the document
add_action( 'admin_head', 'wprnd_styles' ); // add wprnd styling to the document

// adds the wprnd styles to the document
function	wprnd_styles() {
    global $wprnd_url;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $wprnd_url.'/'; ?>css/wp-rounded-img.css.php" / >
<?php
}

// takes a chunk of text, $post and replaces it
// with necessary rounded corner markup
function	wprnd_replace($post, $add_corners = -1) {
    global	$wprnd_by_default;
    global	$wprnd_escape_class;
    global	$wprnd_rounded_class;
    
    $post	 = stripslashes($post);
    
    // save image classes to put back in
    preg_match_all( '/\<\s*img(.+(class\s*="(.+)".+)?)\>/Ui', $post, $imgs, PREG_OFFSET_CAPTURE );
    
    //check to see if this has been marked
    preg_match_all( '/\<\!\-\-\s+wp\-rounded\-img begin\s+\-\-\>.*(\<\s*img(.+(class\s*="(.+)".+)?)\>).+\<\!\-\-\s+wp\-rounded\-img end\s+\-\-\>/Usi', $post, $imgs_done, PREG_OFFSET_CAPTURE );
	    
    $strlen_delta	= 0;
    foreach ( $imgs[0] as $i=>$img ) {
	$done	= false; // already performed the rounded corners
	foreach ( $imgs_done[1] as $j=>$img_done ) // now prove that it hasn't been performed
	    if ( $img[1] == $img_done[1] ) {
		$done	= true;
		$imgs_done[0][$j]; // this is our magic img ref with rounded wrapping and all
		break;
	    }
	
	if ( $add_corners === false || ( $done && wprnd_should_remove_corners($imgs[3][$i][0]) ) ){
	    wprnd_remove_corners($post,$strlen_delta,$img,$imgs_done[0][$j]);
	}
	
	if ( $add_corners === false )
	    $done	= true;
	    
	else if ( $done )
	    continue; // nothing to see here, move along now
	
	if ( $add_corners === true || ( wprnd_should_add_corners($imgs[3][$i][0]) ) )
	    wprnd_add_corners($post,$strlen_delta,$img, $imgs[3][$i]);
    }
    
    return $post;
}

// checks config variables, WP options,
// returns whether corners should be removed on image
function	wprnd_should_remove_corners($img) {
    global	$wprnd_by_default;
    global	$wprnd_escape_class;
    global	$wprnd_rounded_class;
    
    if ( strlen($img) === 0 )
	return !$wprnd_by_default; // if default is false, then remove corners
    
    if ( stristr($img, $wprnd_rounded_class) )
	return false;
    
    if ( stristr($img, $wprnd_escape_class) )
	return true;
    
    return !$wprnd_by_default;
}

function	wprnd_remove_corners(&$post, &$strlen_delta, $img, $rnd_img) {
    $start	= substr($post, 0, $rnd_img[1]+$strlen_delta);
    $end	= substr($post, $rnd_img[1]+strlen($rnd_img[0])+$strlen_delta);
	
    $strlen_delta		= strlen($start.$img[0].$end)-strlen($post);
    $post	= $start.$img[0].$end;
}

// checks config variables, WP options,
// returns whether corners should be added on image
function	wprnd_should_add_corners($img) {
    global	$wprnd_by_default;
    global	$wprnd_escape_class;
    global	$wprnd_rounded_class;
    
    if ( stristr($img, $wprnd_rounded_class) )
	return true;
    
    if ( stristr($img, $wprnd_escape_class) )
	return false;
    
    return $wprnd_by_default; // if default is false, then remove corners
}

// add corners to image,
// must record the change in post length in $strlen_delta
// preserves the original image classes in $img_classes
function	wprnd_add_corners(&$post, &$strlen_delta, $img, $img_classes) {
    global $wprnd_size;
    
    $start	= substr($post, 0, $img[1]+$strlen_delta);
    $end	= substr($post, $img[1]+strlen($img[0])+$strlen_delta);
    
    $img[0]	= preg_replace("/\/\s*\>/U", "style=\"border: none 0em;\" />", $img[0] );
    
    $new	= '<!-- wp-rounded-img begin -->
	<div class="wp-rounded-img '.$img_classes[0].'">
	    <div class="wp-rounded-img-corner wp-rounded-img-tl"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tli"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-side wp-rounded-img-t"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tr"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tri"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-side wp-rounded-img-l"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-side wp-rounded-img-r"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bl"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bli"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-br"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-side wp-rounded-img-b"><!-- &nbsp; --></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bri"><!-- &nbsp; --></div>
<!-- wp-rounded-img img begin --> '.$img[0].' <!-- wp-rounded-img img end -->
	</div><!-- wp-rounded-img end -->';
	
    $strlen_delta		= strlen($start.$new.$end)-strlen($post);
    $post	= $start.$new.$end;
}

?>