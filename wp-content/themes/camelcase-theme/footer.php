<?php
/**
 * The template for displaying the footer
 *
 * @package Camelcase_Theme
 */

$footer_content = get_field('footer_content', 'option');
?>

    </div><?php // #content - opened in header.php ?>

    <footer id="colophon" class="site-footer container bg-white flex flex-col lg:flex-row gap-12 lg:gap-[8.875rem]">
        <div class="footer-content lg:basis-[50%]">
            <?php echo $footer_content; ?>
        </div>

        <div class="footer-newsletter lg:basis-[50%]">
            <form action="" method="post" class="flex flex-col">
                <label class="mb-3">
                    <input class="px-6 py-4 bg-gray-100 w-full focus:outline-none focus:ring-2 focus:ring-primary-500" type="text" name="name" placeholder="Name" required>
                </label>
                <label>
                    <input class="px-6 py-4 bg-gray-100 w-full focus:outline-none focus:ring-2 focus:ring-primary-500" type="email" name="email" placeholder="Email" required>
                </label>
                <div>
                    <button type="submit" class="btn mt-6">Submit</button>
                </div>
            </form>
        </div>
    
        <!-- <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <div class="footer-widgets py-12 bg-gray-900">
                <div class="container mx-auto px-6">
                    <div class="grid md:grid-cols-3 gap-8">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?> -->

        <!-- <?php if ( has_nav_menu( 'footer' ) ) : ?>
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
        <?php endif; ?> -->

        <!-- <div class="site-info border-t border-gray-700 py-6">
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
        </div> -->
    </footer>

</div><?php // #page ?>

<?php wp_footer(); ?>

</body>
</html>