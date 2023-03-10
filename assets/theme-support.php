<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package WordPress
 * @subpackage classiera
 * @since classiera 2.0
 */

if ( ! function_exists( 'classiera_theme_support' ) ) :
function classiera_theme_support() {
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );
	// Set Custom Size for ads images
	add_image_size( 'classiera-100', 100, 100, true );
	add_image_size( 'classiera-370', 370, 250, true );	
	// Add wp_bootstrap_navwalker
	require get_template_directory() . '/assets/menu.php';
	require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';	
	// Add Colors
	require get_template_directory() . '/inc/colors.php';
	
	//Sets up the content width value based on the theme's design.
	if( ! isset( $content_width )){
		$content_width = 1200;
	}
	if ( version_compare( $GLOBALS['wp_version'], '4.3-alpha', '<' ) ){
		require get_template_directory() . '/inc/back-compat.php';
	}	
	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', classiera_fonts_url()));
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	// Disable Disqus commehts on woocommerce product //
	if (function_exists('disqus_override_tabs')) {
		add_filter( 'woocommerce_product_tabs', 'disqus_override_tabs', 98);
	}
	
	// Custom admin scripts
    add_action('admin_enqueue_scripts', 'classiera_admin_scripts' );
	
	// Load scripts and styles
    add_action( 'wp_enqueue_scripts', 'classiera_scripts_styles' );
	
	// Save custom posts
    add_action('save_post', 'classiera_save_post_meta', 1, 2); // save the custom fields
	
	// Category new fields (the form)
    add_filter('category_add_form_fields', 'classiera_my_category_fields');
    add_filter('category_edit_form_fields', 'classiera_my_category_fields');

    // Update category fields
    add_action( 'edited_category', 'classiera_update_my_category_fields', 10, 2 );  
    add_action( 'create_category', 'classiera_update_my_category_fields', 10, 2 );
    add_action( 'edit_category', 'classiera_update_my_category_fields', 10, 2 );

    //Include the TGM_Plugin_Activation class.    
	require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
    add_action( 'tgmpa_register', 'classiera_register_required_plugins' );  

    // Track views
    add_action( 'wp_head', 'classiera_track_post_views');

    // Theme page titles
	add_filter( 'wp_title', 'classiera_wp_title', 10, 2 );


    // classiera sidebars spot
    add_action( 'widgets_init', 'classiera_widgets_init' );

    // classiera body class
    add_filter( 'body_class', 'classiera_body_class' );

    // classiera content width
    add_action( 'template_redirect', 'classiera_content_width' );

    // classiera customize register
    add_action( 'customize_register', 'classiera_customize_register' );

    // classiera customize preview
    add_action( 'customize_preview_init', 'classiera_customize_preview_js' );
	
	//Woo Commerce
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'classiera_theme_support' );
endif;
?>