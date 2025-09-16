<?php

/**
 * Hero Section Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 * @param array $context The context provided to the block by the post or its parent block.
 */

// Get ACF fields
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$background_image = get_field('hero_background_image');
$button_text = get_field('hero_button_text');
$button_url = get_field('hero_button_url');

// Create a unique ID for this block instance
$block_id = 'hero-section-' . $block['id'];

// Get block classes
$class_name = 'block-hero-section';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

SAMPLE HERO SECTION BLOCK
<!-- <div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if ($background_image): ?>
        <div class="hero-background">
            <img src="<?php echo esc_url($background_image['sizes']['large']); ?>" 
                 alt="<?php echo esc_attr($background_image['alt']); ?>" 
                 class="hero-bg-image">
        </div>
    <?php endif; ?>
    
    <div class="hero-content">
        <div class="hero-inner">
            <?php if ($title): ?>
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            
            <?php if ($subtitle): ?>
                <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
            
            <?php if ($button_text && $button_url): ?>
                <a href="<?php echo esc_url($button_url); ?>" class="hero-button">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ($is_preview && (!$title || !$subtitle)): ?>
        <div class="hero-placeholder">
            <p>Please add a title and subtitle to this hero section.</p>
        </div>
    <?php endif; ?>
</div> -->
