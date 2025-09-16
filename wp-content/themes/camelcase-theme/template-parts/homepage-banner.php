<?php

/**
 * Homepage Banner
 *
 * @package Camelcase_Theme
 */

$banner_text = get_field('banner_text');
$banner_image = get_field('banner_image');
$banner_cta = get_field('banner_cta');
?>

<section class="homepage-banner container">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-center gap-[2.625rem] md:gap-[4.25rem]">
        <div>
            <?php if ($banner_text): ?>
                <div class="flex flex-col gap-4"><?php echo $banner_text; ?></div>
            <?php endif; ?>
            <?php if ($banner_cta && is_array($banner_cta)): ?>
                <a class="btn mt-12" href="<?php echo esc_url($banner_cta['url']); ?>">
                    <?php echo esc_html($banner_cta['title']); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($banner_image && is_array($banner_image)): ?>
            <div class="md:max-w-[30rem]">
                <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_image['alt']); ?>">
            </div>
        <?php endif; ?>
    </div>
</section>