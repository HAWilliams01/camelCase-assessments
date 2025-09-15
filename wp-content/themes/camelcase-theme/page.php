<?php
/**
 * The template for displaying all pages
 *
 * @package Camelcase_Theme
 */

get_header(); ?>

<main id="main" class="site-content bg-white min-h-screen">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white'); ?>>
                <header class="entry-header mb-8 text-center">
                    <?php the_title( '<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 font-epilogue">', '</h1>' ); ?>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail mb-8 rounded-2xl overflow-hidden shadow-lg">
                            <?php the_post_thumbnail( 'camelcase-featured', array( 'class' => 'w-full h-64 md:h-80 object-cover' ) ); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content prose prose-lg prose-gray max-w-none font-epilogue">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links flex items-center space-x-4 mt-8 pt-8 border-t border-gray-200"><span class="text-sm font-medium text-gray-700">' . esc_html__( 'Pages:', 'camelcase-theme' ) . '</span>',
                        'after'  => '</div>',
                        'link_before' => '<span class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 transition-colors">',
                        'link_after' => '</span>',
                    ) );
                    ?>
                </div>

                <?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer mt-12 pt-8 border-t border-gray-200">
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    __( 'Edit <span class="screen-reader-text">%s</span>', 'camelcase-theme' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post( get_the_title() )
                            ),
                            '<span class="edit-link inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-gray-900 transition-colors">',
                            '</span>'
                        );
                        ?>
                    </footer>
                <?php endif; ?>
            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                echo '<div class="mt-12">';
                comments_template();
                echo '</div>';
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();