<?php

/**
 * TV Show Card Template
 *
 * @param array $show_data The TV show data passed from the parent block.
 */

// Get the show data passed from the parent block
$show = get_query_var('tv_show_data');

if (!$show) {
    return;
}
?>

<div class="bg-white">
    <?php if ($show['image']): ?>
        <div class="mb-6">
            <img 
                src="<?php echo esc_url($show['image']); ?>" 
                alt="<?php echo esc_attr($show['name']); ?>"
                class="w-full h-[24.625rem] object-contain"
                loading="lazy"
            >
        </div>
    <?php endif; ?>

    <div>
        <h4><?php echo esc_html($show['name']); ?></h4>

        <?php if (!empty($show['genres'])): ?>
            <div class="flex flex-wrap gap-1">
                <?php foreach (array_slice($show['genres'], 0, 3) as $genre): ?>
                    <span class="text-[1.0625rem]">
                        <?php echo esc_html($genre); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
