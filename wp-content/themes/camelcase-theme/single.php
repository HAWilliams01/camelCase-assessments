<?php
/**
 * The template for displaying all single posts
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
                <header class="entry-header mb-8">
                    <?php the_title( '<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-epilogue leading-tight">', '</h1>' ); ?>

                    <div class="entry-meta flex flex-wrap items-center gap-4 text-sm text-gray-600 font-epilogue mb-8">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?php camelcase_posted_on(); ?>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="byline">
                                <?php
                                printf(
                                    esc_html__( 'by %s', 'camelcase-theme' ),
                                    '<span class="author vcard"><a class="url fn n font-medium text-blue-600 hover:text-blue-700 transition-colors" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
                                );
                                ?>
                            </span>
                        </div>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail mb-8 rounded-2xl overflow-hidden shadow-lg">
                            <?php the_post_thumbnail( 'camelcase-featured', array( 'class' => 'w-full h-64 md:h-96 object-cover' ) ); ?>
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

                <footer class="entry-footer mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-wrap items-center gap-6 text-sm font-epilogue">
                        <?php
                        $categories_list = get_the_category_list( '</span><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">' );
                        if ( $categories_list ) {
                            printf(
                                '<div class="flex items-center"><span class="text-gray-600 mr-2">%s</span><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">%s</span></div>',
                                esc_html__( 'Categories:', 'camelcase-theme' ),
                                $categories_list
                            );
                        }

                        $tags_list = get_the_tag_list( '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-2">', '</span><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-2">', '</span>' );
                        if ( $tags_list ) {
                            printf( '<div class="flex items-center flex-wrap"><span class="text-gray-600 mr-2">%s</span>%s</div>', esc_html__( 'Tags:', 'camelcase-theme' ), $tags_list );
                        }
                        ?>
                    </div>
                </footer>
            </article>

            <nav class="post-navigation mt-16 pt-8 border-t border-gray-200">
                <?php
                // Post navigation
                the_post_navigation( array(
                    'prev_text' => '<div class="nav-previous bg-gray-50 hover:bg-gray-100 transition-colors p-6 rounded-lg"><span class="text-sm text-gray-600 block mb-2">' . esc_html__( 'Previous Post', 'camelcase-theme' ) . '</span><span class="text-lg font-semibold text-gray-900 font-epilogue">%title</span></div>',
                    'next_text' => '<div class="nav-next bg-gray-50 hover:bg-gray-100 transition-colors p-6 rounded-lg text-right"><span class="text-sm text-gray-600 block mb-2">' . esc_html__( 'Next Post', 'camelcase-theme' ) . '</span><span class="text-lg font-semibold text-gray-900 font-epilogue">%title</span></div>',
                ) );
                ?>
            </nav>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                echo '<div class="comments-area mt-16 pt-8 border-t border-gray-200">';
                comments_template();
                echo '</div>';
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();