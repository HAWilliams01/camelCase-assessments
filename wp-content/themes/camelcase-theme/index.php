<?php
/**
 * The main template file
 *
 * @package Camelcase_Theme
 */

get_header(); 
?>

<main id="main" class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) :

            if ( is_home() && ! is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif;

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;
                        ?>

                        <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php
                                printf(
                                    esc_html__( 'Posted on %s by %s', 'camelcase-theme' ),
                                    '<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>',
                                    '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
                                );
                                ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        if ( is_singular() ) :
                            the_content();
                        else :
                            the_excerpt();
                        endif;

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'camelcase-theme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <?php if ( ! is_singular() ) : ?>
                        <footer class="entry-footer">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more">
                                <?php esc_html_e( 'Read More', 'camelcase-theme' ); ?>
                            </a>
                        </footer>
                    <?php endif; ?>
                </article>
                <?php
            endwhile;

            the_posts_navigation();

        else :
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'camelcase-theme' ); ?></h1>
                </header>
                <div class="page-content">
                    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                        <p><?php
                            printf(
                                wp_kses(
                                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'camelcase-theme' ),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url( admin_url( 'post-new.php' ) )
                            );
                        ?></p>
                    <?php else : ?>
                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'camelcase-theme' ); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </section>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();