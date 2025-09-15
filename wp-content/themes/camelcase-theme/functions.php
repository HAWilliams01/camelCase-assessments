<?php
/**
 * Camelcase Theme functions and definitions
 *
 * @package Camelcase_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function camelcase_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 350,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Register navigation menus.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'camelcase-theme' ),
        'footer'  => esc_html__( 'Footer Menu', 'camelcase-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'camelcase_theme_setup' );

/**
 * Set the content width in pixels.
 */
function camelcase_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'camelcase_content_width', 1200 );
}
add_action( 'after_setup_theme', 'camelcase_content_width', 0 );

/**
 * Register widget area.
 */
function camelcase_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'camelcase-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'camelcase-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area', 'camelcase-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add footer widgets here.', 'camelcase-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'camelcase_widgets_init' );

/**
 * Load Vite integration
 */
require_once get_template_directory() . '/inc/vite.php';

/**
 * Load ACF integration
 */
require_once get_template_directory() . '/inc/acf.php';

/**
 * Enqueue scripts and styles using Vite integration.
 */
function camelcase_scripts() {
    Camelcase_Vite::enqueue_assets();
}
add_action( 'wp_enqueue_scripts', 'camelcase_scripts' );

/**
 * Add Vite HMR support
 */
add_action( 'wp_head', [ 'Camelcase_Vite', 'add_vite_refresh' ] );

/**
 * Custom template tags for this theme.
 */
function camelcase_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );

    printf(
        '<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
        esc_html__( 'Posted on', 'camelcase-theme' ),
        esc_url( get_permalink() ),
        $time_string
    );
}

/**
 * Add custom image sizes.
 */
function camelcase_custom_image_sizes() {
    add_image_size( 'camelcase-featured', 1200, 600, true );
    add_image_size( 'camelcase-thumbnail', 400, 300, true );
}
add_action( 'after_setup_theme', 'camelcase_custom_image_sizes' );