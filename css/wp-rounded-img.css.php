<?php
header("Content-type: text/css");
require('../config.php');

$dir	= "";
switch ( $wprnd_size ) {
    case WPRND_SMALL:
	$dir	= "small/";
	$wprnd_dimensions	= "8px";
	break;
    case WPRND_MED:
	$dir	= "medium/";
	$wprnd_dimensions	= "16px";
	break;
    case WPRND_LARGE:
	$dir	= "large/";
	$wprnd_dimensions	= "32px";
	break;
}

?>

.wp-rounded-img {
display: inline-block;
    background-color: #000;
    position: relative;
    border: none !important; padding: 0em; margin: 0em;
    margin-bottom: 1em;
    font-size: <?php echo $wprnd_dimensions; ?>
}
.wp-rounded-img-corner {
    width: 1em;
    height: 1em;
    position: absolute;
    z-index: 4;
}
.wp-rounded-img-side {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 4;
}

.wp-rounded-img-tl {
    background-image: url('../images/<?php echo $dir; ?>tl.png');
    top: -1em; left: -1em;
}
.wp-rounded-img-tli {
    background-image: url('../images/<?php echo $dir; ?>tli.png');
    background-position: top left;
    background-repeat: no-repeat;
    top: 0em; left: 0em;
}
.wp-rounded-img-t {
    background-image: url('../images/<?php echo $dir; ?>x.png');
    background-position: top;
    top: -1em;
    background-repeat: repeat-x;
}
.wp-rounded-img-tr {
    background-image: url('../images/<?php echo $dir; ?>tr.png');
    background-position: top right;
    top: -1em; right: -1em;
}
.wp-rounded-img-tri {
    background-image: url('../images/<?php echo $dir; ?>tri.png');
    background-position: top right;
    background-repeat: no-repeat;
    top: 0em; right: 0em;
}
.wp-rounded-img-l {
    background-image: url('../images/<?php echo $dir; ?>y.png');
    background-position: left;
    left: -1em;
    background-repeat: repeat-y;
}
.wp-rounded-img-r {
    background-image: url('../images/<?php echo $dir; ?>y.png');
    background-position: right;
    right: -1em;
    background-repeat: repeat-y;
}
.wp-rounded-img-bl {
    background-image: url('../images/<?php echo $dir; ?>bl.png');
    background-position: bottom left;
    bottom: -1em; left: -1em;
}
.wp-rounded-img-bli {
    background-image: url('../images/<?php echo $dir; ?>bli.png');
    background-position: bottom left;
    background-repeat: no-repeat;
    bottom: 0em; left: 0em;
}
.wp-rounded-img-b {
    background-image: url('../images/<?php echo $dir; ?>x.png');
    background-position: bottom;
    bottom: -1em;
    background-repeat: repeat-x;
}
.wp-rounded-img-br {
    background-image: url('../images/<?php echo $dir; ?>br.png');
    background-position: bottom right;
    bottom: -1em; right: -1em;
}
.wp-rounded-img-bri {
    background-image: url('../images/<?php echo $dir; ?>bri.png');
    background-position: bottom right;
    background-repeat: no-repeat;
    bottom: 0em; right: 0em;
}

/* small */

.<?php echo WPRND_SMALL; ?> .wp-rounded-img-tl {
    background-image: url('../images/small/tl.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-tli {
    background-image: url('../images/small/tli.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-t {
    background-image: url('../images/small/x.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-tr {
    background-image: url('../images/small/tr.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-tri {
    background-image: url('../images/small/tri.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-l {
    background-image: url('../images/small/y.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-r {
    background-image: url('../images/small/y.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-bl {
    background-image: url('../images/small/bl.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-bli {
    background-image: url('../images/small/bli.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-b {
    background-image: url('../images/small/x.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-br {
    background-image: url('../images/small/br.png');
}
.<?php echo WPRND_SMALL; ?> .wp-rounded-img-bri {
    background-image: url('../images/small/bri.png');
}

/* wp-admin */
#<?php echo $wprnd_page_slug; ?> td {
    padding-right: 2em;
    padding-bottom: 0.25em;
}