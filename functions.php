<?php
	
	// Add RSS links to <head> section
	add_theme_support('automatic-feed-links');

	// Add featured image thumbnails
	add_theme_support('post-thumbnails');
	
	// Load jQuery
	if ( !is_admin() ) {
		add_action('wp_enqueue_scripts', 'islyAddJQuery');
	}

	function islyAddJQuery() {
		wp_enqueue_script('jquery');
	}

	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

	add_shortcode('divider', 'shortcodeInsertDivider');
	function shortcodeInsertDivider() {
		return '<div class="isly-divider"><div class="isly-divider-ball left-ball"></div><div class="isly-divider-ball right-ball"></div></div>';
	}

?>