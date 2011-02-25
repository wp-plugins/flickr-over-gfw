<?php
/*
Plugin Name: Flickr Over GFW
Plugin URI: http://cn.programmingnote.com
Description: This plugin can help you link images from flickr.com. It is helpful for people in China (because of the GFW).
Author: Woody Wang
Version: 0.1
Author URI: http://cn.programmingnote.com/blog/
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

function flickr_over_gfw($content) {	
	$content = preg_replace_callback('@(href|src)=\"(http://[a-z0-9]*?\.static\.flickr\.com/[^\">]+?)\"@i', 'flickr_over_gfw_url_replace', $content);
	return $content;
}

function flickr_over_gfw_url_replace($match) {
	$siteurl = get_option('siteurl');
	$get_image_url = trim($siteurl, '/') . '/wp-content/plugins/flickr-over-gfw';
	$url = urlencode(base64_encode($match[2]));
	return $match[1].'="'.$get_image_url."/get-image.php?url=$url".'"';
}

add_filter('the_content', 'flickr_over_gfw');