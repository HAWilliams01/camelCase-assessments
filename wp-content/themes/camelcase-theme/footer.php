<?php
/**
 * The template for displaying the footer
 *
 * @package Camelcase_Theme
 */
?>

    </div><?php // #content - opened in header.php ?>

    <footer id="colophon" class="site-footer bg-gray-800 text-white">
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <div class="footer-widgets py-12 bg-gray-900">
                <div class="container mx-auto px-6">
                    <div class="grid md:grid-cols-3 gap-8">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( has_nav_menu( 'footer' ) ) : ?>
            <div class="footer-navigation border-t border-gray-700 py-8">
                <div class="container mx-auto px-6">
                    <nav class="flex justify-center">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'menu_class'     => 'flex flex-wrap justify-center space-x-8'
                        ) );
                        ?>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info border-t border-gray-700 py-6">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-400">
                    <p class="mb-4 md:mb-0">
                        &copy; <?php echo date( 'Y' ); ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white hover:text-blue-400 transition-colors">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                        <span class="mx-2">•</span>
                        All rights reserved.
                    </p>
                    <p>
                        <?php
                        printf(
                            esc_html__( 'Powered by %s', 'camelcase-theme' ),
                            '<a href="https://wordpress.org/" class="text-white hover:text-blue-400 transition-colors">WordPress</a>'
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</div><?php // #page ?>

<?php wp_footer(); ?>

</body>
</html>