<?php
/*
Plugin Name: Enable Page Excerpts
Plugin URI: https://github.com/LCFanfic/WordPressPlugins/enable-page-excerpts
Description: This plugin enables the excerpt feature for pages.
Version: 1.0.0
Author: LnC Fanfic Admin Team
Author URI: https://github.com/LCFanfic
License: MIT
*/

add_post_type_support( 'page', 'excerpt' );
