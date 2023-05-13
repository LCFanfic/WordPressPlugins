<?php
/*
Plugin Name: A-Z Listing: Custom Filter for removing prefixed article from title
Plugin URI: https://github.com/LCFanfic/WordPressPlugins/a-z-listing-custom-filter-for-removing-prefixed-article-from-title
Description: This plugin extends the "A-Z Listing" plugin to move the prefixed article of a page title to the end of the page title.
Version: 1.0.0
Author: LnC Fanfic Admin Team
Author URI: https://github.com/LCFanfic
License: MIT
*/

function a_z_listing_filter_remove_prefixed_article_from_title($content)
{
	return htmlentities(
		preg_replace_callback(
			'/(?:[^0-9a-z])*(?:(a|an|the)\s)?(?:[^0-9a-z])*(.+)/i', 
			function($match) { return $match[2]; },
			html_entity_decode($content)));
}

add_filter('a_z_listing_pre_index_item_title', 'a_z_listing_filter_remove_prefixed_article_from_title');
