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
$skills = get_field('skills');
?>

<div class="block-skills container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($skills as $skill): ?>
            <?php 
            // Set up the skill data for the card template
            set_query_var('skill_data', $skill);
            get_template_part('template-parts/cards/skill');
            ?>
        <?php endforeach; ?>
    </div>
</div>