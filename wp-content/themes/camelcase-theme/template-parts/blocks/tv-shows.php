<?php

/**
 * TV Shows Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 * @param array $context The context provided to the block by the post or its parent block.
 */

$headline = get_field('tv_shows_headline');

// Include the TV Shows API service
require_once get_template_directory() . '/inc/tv-shows-api.php';

// Get the TV shows API instance
$tv_shows_api = getTVShows();

// Fetch the 6 most recent TV shows
$shows = $tv_shows_api->getRecentShows(6, $date, $country);
?>

<div class="block-tv-shows">
    <div class="container">
        filter bar here
        <h2><?php echo $headline; ?></h2>
    </div>
    <div class="container">
        <?php if ($shows && !empty($shows)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($shows as $show): ?>
                    <?php
                    // Set up the tv show data for the card                    set_query_var('tv_show_data', $show);
                    get_template_part('template-parts/cards/tv-show');
                    ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No TV Shows Available</h3>
                <p class="text-gray-600">Unable to load today's TV shows. Please try again later.</p>
            </div>
        <?php endif; ?>
    </div>
</div>