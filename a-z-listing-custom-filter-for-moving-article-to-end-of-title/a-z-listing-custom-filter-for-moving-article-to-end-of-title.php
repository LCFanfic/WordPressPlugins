<?php
/*
Plugin Name: A-Z Listing: Custom Filter for moving prefixed article to end of title
Plugin URI: https://github.com/LCFanfic/WordPressPlugins/a-z-listing-custom-filter-for-moving-prefixed-article-to-end-of-title
Description: This plugin extends the "A-Z Listing" plugin to move the prefixed article of a page title to the end of the page title.
Version: 1.0.0
Author: LnC Fanfic Admin Team
Author URI: https://github.com/LCFanfic
License: MIT
*/

function a_z_listing_filter_move_article_to_end_of_title($content)
{
	return preg_replace_callback(
		'/(?:(a|an|the)\s)?(.+)/i', 
		function($match) { return empty($match[1]) ? $match[0] : $match[2] . ', ' . $match[1]; },
		$content);
}

add_filter('a_z_listing_pre_index_item_title', 'a_z_listing_filter_move_article_to_end_of_title');
