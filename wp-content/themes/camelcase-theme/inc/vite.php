<?php
/**
 * Vite integration for WordPress theme
 *
 * @package Camelcase_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if we're in development mode
if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
    $response = wp_remote_get( 'http://localhost:3000', [
        'timeout' => 1,
        'sslverify' => false,
    ] );

    if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
        define( 'IS_VITE_DEVELOPMENT', true );
    }
}

if ( ! defined( 'IS_VITE_DEVELOPMENT' ) ) {
    define( 'IS_VITE_DEVELOPMENT', false );
}

/**
 * Class for handling Vite integration
 */
class Camelcase_Vite {
    /**
     * Vite server URL
     */
    const VITE_SERVER = 'http://localhost:3000';

    /**
     * Check if Vite dev server is running
     */
    public static function is_dev_server_running() {
        return IS_VITE_DEVELOPMENT;
    }

    /**
     * Get manifest data
     */
    public static function get_manifest() {
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

        if ( ! file_exists( $manifest_path ) ) {
            return false;
        }

        $manifest_content = file_get_contents( $manifest_path );
        return json_decode( $manifest_content, true );
    }

    /**
     * Enqueue Vite assets
     */
    public static function enqueue_assets() {
        if ( IS_VITE_DEVELOPMENT ) {
            // Development mode - insert HMR into head for live reload
            add_action('wp_head', function() {
                echo '<script type="module" crossorigin src="' . self::VITE_SERVER . '/assets/js/main.js"></script>';
            });

        } else {
            // Production mode - use built files
            $manifest = self::get_manifest();

            if ( $manifest ) {
                // Get first key from manifest for main entry
                $manifest_keys = array_keys($manifest);

                if (isset($manifest_keys[0])) {
                    // Enqueue CSS files
                    foreach (@$manifest[$manifest_keys[0]]['css'] as $css_file) {
                        wp_enqueue_style('camelcase-theme-style', get_template_directory_uri() . '/dist/' . $css_file);
                    }

                    // Enqueue main JS file
                    if (isset($manifest['assets/js/main.js'])) {
                        wp_enqueue_script(
                            'camelcase-theme-main',
                            get_template_directory_uri() . '/dist/' . $manifest['assets/js/main.js']['file'],
                            [],
                            filemtime( get_template_directory() . '/dist/' . $manifest['assets/js/main.js']['file'] ),
                            true
                        );
                    }
                }
            } else {
                // Fallback to original style.css if no build exists
                wp_enqueue_style( 'camelcase-style', get_stylesheet_uri(), [], '1.0.0' );
            }
        }

        // Enqueue comment reply script
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Add type="module" to script tags
     */
    public static function add_module_type( $tag, $handle, $src ) {
        if ( in_array( $handle, [ 'vite-client', 'camelcase-theme-main' ] ) ) {
            return '<script type="module" src="' . esc_url( $src ) . '"></script>';
        }
        return $tag;
    }

    /**
     * Add Vite refresh script for HMR
     */
    public static function add_vite_refresh() {
        if ( self::is_dev_server_running() ) {
            echo '<script type="module">
                import RefreshRuntime from "' . self::VITE_SERVER . '/@react-refresh"
                RefreshRuntime.injectIntoGlobalHook(window)
                window.$RefreshReg$ = () => {}
                window.$RefreshSig$ = () => (type) => type
                window.__vite_plugin_react_preamble_installed__ = true
            </script>';
        }
    }
}