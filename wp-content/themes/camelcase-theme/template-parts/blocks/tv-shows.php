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

// Get current date and country from URL parameters or use defaults
$date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
$country = isset($_GET['country']) ? sanitize_text_field($_GET['country']) : 'US';

// Fetch the 6 most recent TV shows
$shows = $tv_shows_api->getRecentShows(6, $date, $country);
?>

<div class="block-tv-shows">
    <div class="container">
        <form method="GET" id="tv-shows-form" class="flex flex-wrap gap-4 items-end" x-data="tvShowsForm('<?php echo esc_js($country); ?>')" x-init="selectedCountry = '<?php echo esc_js($country); ?>'">
            <div class="flex flex-col">
                <label for="date" class="text-sm font-medium text-gray-700 mb-1">Date</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    value="<?php echo esc_attr($date); ?>"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    onchange="document.getElementById('tv-shows-form').submit()">
            </div>

            <h2 class="mb-6"><?php echo $headline; ?></h2>
            
             <div class="flex flex-col">
                 <label class="text-sm font-medium text-gray-700 mb-1">Country</label>
                 <div
                     x-on:keydown.escape.prevent.stop="close($refs.button)"
                     x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                     x-id="['dropdown-button']"
                     class="relative"
                 >
                     <!-- Hidden input for form submission -->
                     <input type="hidden" id="country" name="country" x-model="selectedCountry">
                     
                     <!-- Button -->
                     <button
                         x-ref="button"
                         x-on:click="toggle()"
                         :aria-expanded="open"
                         :aria-controls="$id('dropdown-button')"
                         type="button"
                         class="relative flex items-center whitespace-nowrap justify-between gap-2 py-2 px-3 rounded-md shadow-sm bg-white hover:bg-gray-50 text-gray-800 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent min-w-[200px]"
                     >
                         <span x-text="selectedCountryName"></span>

                         <!-- Heroicon: micro chevron-down -->
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                             <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                         </svg>
                     </button>

                     <!-- Panel -->
                     <div
                         x-ref="panel"
                         x-show="open"
                         x-transition.origin.top.left
                         x-on:click.outside="close($refs.button)"
                         :id="$id('dropdown-button')"
                         x-cloak
                         class="absolute left-0 min-w-48 rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white p-1.5 outline-none border border-gray-200"
                     >
                         <template x-for="country in countries" :key="country.code">
                             <button
                                 type="button"
                                 x-on:click="selectCountry(country.code)"
                                 :class="selectedCountry === country.code ? 'bg-blue-50 text-blue-600' : 'text-gray-800 hover:bg-gray-50'"
                                 class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                             >
                                 <span x-text="country.name"></span>
                             </button>
                         </template>
                     </div>
                 </div>
             </div>
        </form>
    </div>
    <div class="container">
        <?php if ($shows && !empty($shows)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($shows as $show): ?>
                    <?php
                    // Set up the tv show data for the card
                    set_query_var('tv_show_data', $show);
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
            </div>
        <?php endif; ?>
    </div>
</div>