<?php

/**
 * Skills Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 * @param array $context The context provided to the block by the post or its parent block.
 */

// Get ACF fields
$headline = get_field('headline');
$testimonials = get_field('testimonials');
?>

<div class="block-testimonials container">
    <h2 class="text-center mb-[2.625rem]"><?php echo $headline; ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($testimonials as $testimonial): ?>
            <?php
            set_query_var('testimonial_data', $testimonial);
            get_template_part('template-parts/cards/testimonial');
            ?>
        <?php endforeach; ?>
    </div>
</div>