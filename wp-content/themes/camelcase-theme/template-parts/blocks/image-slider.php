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
?>

<div class="block-image-slider splide relative py-[7rem]">
    <div class="absolute top-0 left-0 bg-gradient-to-r from-white from-60% to-transparent w-20 h-full z-10"></div>
    <div class="absolute top-0 left-auto right-0 bg-gradient-to-l from-white from-60% to-transparent w-20 h-full z-10"></div>
    <div class="splide__track">
        <div class="splide__list">
            <?php foreach ($images as $image): ?>
                <div class="splide__slide">
                    <div class="flex bg-white">
                        <img src="<?php echo esc_url($image['sizes']['medium']); ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>"
                            loading="lazy">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>