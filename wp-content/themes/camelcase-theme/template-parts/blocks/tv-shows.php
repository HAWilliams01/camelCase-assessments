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
        <form method="GET" id="tv-shows-form" class="flex flex-wrap gap-4 items-end" x-data="tvShowsForm('<?php echo esc_js($country); ?>', '<?php echo esc_js($date); ?>')" x-init="selectedCountry = '<?php echo esc_js($country); ?>'; selectedDate = '<?php echo esc_js($date); ?>'">
            <div class="flex flex-col">
                <div
                    x-on:keydown.escape.prevent.stop="closeDate()"
                    x-on:focusin.window="! $refs.datePanel.contains($event.target) && closeDate()"
                    x-id="['date-picker']"
                    class="relative max-w-sm"
                >
                    <!-- Hidden input for form submission -->
                    <input type="hidden" id="date" name="date" x-model="selectedDate">
                    
                    <!-- Date Picker Button -->
                    <button
                        x-ref="dateButton"
                        x-on:click="toggleDate()"
                        :aria-expanded="dateOpen"
                        :aria-controls="$id('date-picker')"
                        type="button"
                        class="relative flex items-center justify-between w-full px-3 py-2 text-left border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-text="formattedDate"></span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-gray-500">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Date Picker Panel -->
                    <div
                        x-ref="datePanel"
                        x-show="dateOpen"
                        x-transition.origin.top.left
                        x-on:click.outside="closeDate()"
                        :id="$id('date-picker')"
                        x-cloak
                        class="absolute left-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                    >
                        <!-- Header -->
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <button
                                type="button"
                                x-on:click="previousMonth()"
                                class="p-1 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            
                            <h3 class="text-lg font-semibold text-gray-900" x-text="monthNames[currentMonth] + ' ' + currentYear"></h3>
                            
                            <button
                                type="button"
                                x-on:click="nextMonth()"
                                class="p-1 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Days of Week -->
                        <div class="grid grid-cols-7 gap-1 p-2">
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Sun</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Mon</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Tue</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Wed</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Thu</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Fri</div>
                            <div class="text-center text-sm font-medium text-gray-500 py-2">Sat</div>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-1 p-2">
                            <template x-for="day in days" :key="day.date">
                                <button
                                    type="button"
                                    x-on:click="selectDate(day.date)"
                                    :class="{
                                        'bg-blue-600 text-white': day.isSelected,
                                        'text-gray-900 hover:bg-gray-100': !day.isSelected && day.isCurrentMonth,
                                        'text-gray-400': !day.isCurrentMonth,
                                        'font-semibold': day.isToday && !day.isSelected
                                    }"
                                    class="w-10 h-10 text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <span x-text="day.day"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="mb-6"><?php echo $headline; ?></h2>
            
             <div class="flex flex-col">
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
                         :aria-expanded="countryOpen"
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