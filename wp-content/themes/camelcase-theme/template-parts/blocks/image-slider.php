<?php

/**
 * Image Gallery Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 * @param array $context The context provided to the block by the post or its parent block.
 */

// Get ACF fields
$images = get_field('slider_images');

// Create a unique ID for this block instance
$block_id = 'image-slider-' . $block['id'];
?>

<div id="<?php echo esc_attr($block_id); ?>" class="block-image-slider">
    IMAGE SLIDER BLOCK
    <?php if ($images): ?>
        <div class="gallery-container">
            <?php foreach ($images as $image): ?>
                <div class="gallery-item">
                    <div class="gallery-image">
                        <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>"
                            loading="lazy">
                    </div>
                    <?php if ($show_captions && !empty($image['caption'])): ?>
                        <div class="gallery-caption">
                            <?php echo esc_html($image['caption']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <?php if ($is_preview): ?>
            <div class="gallery-placeholder">
                <p>No images selected. Please add images to this gallery block.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>