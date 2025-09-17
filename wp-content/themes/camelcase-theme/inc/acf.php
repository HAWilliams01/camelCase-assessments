<?php
/**
 * ACF (Advanced Custom Fields) Integration
 *
 * @package Camelcase_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Initialize ACF integration
 */
function camelcase_acf_init() {
    camelcase_maybe_disable_acf_admin();

    add_action( 'admin_notices', 'camelcase_check_acf_enabled' );
    add_action( 'acf/init', 'camelcase_acf_init_block_types' );

    add_action('init', 'camelcase_acf_init_block_types');
    add_action('wp_loaded', 'camelcase_acf_init_block_types');

    add_filter( 'acf/settings/save_json', 'camelcase_acf_settings_save_json' );
    add_filter( 'acf/settings/load_json', 'camelcase_acf_settings_load_json' );
}
add_action( 'init', 'camelcase_acf_init' );

/**
 * Maybe disable ACF admin for production environments.
 *
 * It's best practice for performance and security.
 *
 * @see https://docs.wpvip.com/technical-references/plugin-incompatibilities/#7-site-and-page-builders
 */
function camelcase_maybe_disable_acf_admin() {
    // Allow ACF admin to be shown on local environment
    if ( defined( 'WP_ENVIRONMENT_TYPE' ) && WP_ENVIRONMENT_TYPE === 'local' ) {
        return;
    }

    add_filter( 'acf/settings/show_admin', '__return_false' );
}

/**
 * Set ACF JSON save path.
 *
 * @param string $path Default save path.
 * @return string Modified save path.
 */
function camelcase_acf_settings_save_json( $path ) {
    $acf_path = get_template_directory() . '/source/acf-json';

    // Create directory if it doesn't exist
    if ( ! file_exists( $acf_path ) ) {
        wp_mkdir_p( $acf_path );
    }

    return $acf_path;
}

/**
 * Set ACF JSON load paths.
 *
 * @param array $paths Array of paths to load ACF JSON from.
 * @return array Modified array of paths.
 */
function camelcase_acf_settings_load_json( $paths ) {
    $acf_path = get_template_directory() . '/source/acf-json';

    // Only add path if directory exists and is readable
    if ( file_exists( $acf_path ) && is_readable( $acf_path ) ) {
        // Remove original path (optional)
        unset( $paths[0] );
        $paths[] = $acf_path;
    }

    return $paths;
}

/**
 * Check for ACF dependency and notify the user if missing.
 */
function camelcase_check_acf_enabled() {
    // Check if ACF is activated
    if ( class_exists( 'acf' ) ) {
        return;
    }

    echo '<div class="notice notice-error"><p>' .
         esc_html__( 'The theme requires Advanced Custom Fields plugin. Please install and activate it.', 'camelcase-theme' ) .
         '</p></div>';
}

/**
 * Register ACF Blocks.
 */
function camelcase_acf_init_block_types() {
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        return;
    }
    
    // Image Slider Block
    acf_register_block_type(array(
        'name'              => 'block_image_slider',
        'title'             => __('Image Slider', 'camelcase-theme'),
        'description'       => __('A custom block to show images in a slider.', 'camelcase-theme'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/image-slider.php',
        'category'          => 'formatting',
        'icon'              => 'format-gallery',
        'keywords'          => array('image', 'slider'),
    ));

    // Skills Block
    acf_register_block_type(array(
        'name'              => 'block_skills',
        'title'             => __('Skills', 'camelcase-theme'),
        'description'       => __('', 'camelcase-theme'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/skills.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array('skills', 'cards'),
    ));
    
    // TV Shows Block
    acf_register_block_type(array(
        'name'              => 'block_tv_shows',
        'title'             => __('TV Shows', 'camelcase-theme'),
        'description'       => __('', 'camelcase-theme'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/tv-shows.php',
        'category'          => 'formatting',
        'icon'              => 'dashicons-tv-alt',
        'keywords'          => array('tv', 'shows'),
    ));
}

/**
 * Register ACF Field Groups for Blocks
 */
// function camelcase_register_block_fields() {
//     if ( ! function_exists( 'acf_add_local_field_group' ) ) {
//         return;
//     }
// }
// add_action( 'acf/init', 'camelcase_register_block_fields' );