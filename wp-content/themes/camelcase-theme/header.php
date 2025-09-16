<?php
/**
 * The header for our theme
 *
 * @package Camelcase_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> x-data="smoothScroll">
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen bg-gray-50">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'camelcase-theme' ); ?></a>

    <header id="masthead" class="site-header bg-white shadow-sm sticky top-0 z-50" x-data="mobileMenu">
        <div class="container mx-auto ">
            <div class="flex items-center justify-between">
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                        ?>
                        <h1 class="site-title text-2xl font-bold text-gray-900">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="hover:text-blue-600 transition-colors">
                                <?php bloginfo( 'name' ); ?>
                            </a>
                        </h1>
                        <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) :
                            ?>
                            <p class="site-description text-sm text-gray-600 mt-1"><?php echo $description; ?></p>
                        <?php endif;
                    endif;
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation hidden md:block">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'menu_class'     => 'flex space-x-8 items-center'
                    ) );
                    ?>
                </nav>

                <!-- Mobile menu button -->
                <button @click="toggle()" :aria-expanded="open" class="hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <nav x-show="open" x-transition class="md:hidden mt-4 pb-4 border-t border-gray-200">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'menu_class'     => 'space-y-2 pt-4'
                ) );
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="site-content"><?php // This div is closed in footer.php ?>