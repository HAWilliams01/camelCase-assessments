<?php
/**
 * The front page template file
 *
 * @package Camelcase_Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <?php get_template_part( 'template-parts/homepage-banner' ); ?>
    
    <!-- Page Content from Editor -->
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <section class="page-content">
                <?php the_content(); ?>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>