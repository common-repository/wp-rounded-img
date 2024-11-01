=== wp-rounded-image ===
Contributors: spintheweb
Donate link: http://spintheweb.org
Tags: rounded, images, CSS
Requires at least: 3.0.3
Tested up to: 3.0.3
Stable tag: trunk

WP Rounded Image puts rounded corners around your images.  It does it using HTML/CSS markup only.

== Description ==

WP Rounded Image puts rounded borders around your images.  It does it using HTML/CSS markup only.

When you post, any images contained in your post will receive rounding.  Image will be replaced with markup.

This:
`<img src="thetest.jpg" title="fantastico!" / >`

Becomes this:
`<!-- wp-rounded-img begin -->
	<div class="wp-rounded-img ">
	    <div class="wp-rounded-img-corner wp-rounded-img-tl"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tli"></div>
	    <div class="wp-rounded-img-side wp-rounded-img-t"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tr"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-tri"></div>
	    <div class="wp-rounded-img-side wp-rounded-img-l"></div>
	    <div class="wp-rounded-img-side wp-rounded-img-r"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bl"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bli"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-br"></div>
	    <div class="wp-rounded-img-side wp-rounded-img-b"></div>
	    <div class="wp-rounded-img-corner wp-rounded-img-bri"></div>
<!-- wp-rounded-img img begin --> <img src="thetest.jpg" title="fantastico!" style="border: none 0em;" /> <!-- wp-rounded-img img end -->
	</div><!-- wp-rounded-img end -->`


If the `<img>` has the class "wp-rounded-off", it will not be replaced with the above markup.  You can add the class to the image with the rounded markup, and the rounding markup will be removed.

== Installation ==

1. Unzip the plugin to to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Goto `settings->WP Rounded Image` for plugin settings.

== Frequently Asked Questions ==

To change the color of the border...
	1. open "images/rounded_corners.psd"
	2. fill layer with new color (optional)
	3. resize image (optional)
	4. goto File->Save for Web & Devices...
	5. hit save
	6. make sure "All User Slices" is selected
	7. save to wp-rounded-img directory

To turn rounded corners off by default:
	1. in WordPress, goto Settings->WP Rounded Img
	2. uncheck 'round by default'
	3. hit update

To escape rounding on any image, regardless of other settings:
	1. add the class "wp-rounded-off" to the <img> element
	
	(note: the escape class is defined on the settings page)
	
To round any image, regardless of other settings:
	1. add the class "wp-rounded-on" to the <img> element
	
	(note: the rounded class is defined on the settings page)

== Screenshots ==

== Changelog ==

= 1.0 =
* post images replaced with rounding markup on update
* options menu to configure the plugin and perform operations

== Upgrade Notice ==