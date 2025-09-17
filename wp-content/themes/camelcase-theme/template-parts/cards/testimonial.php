<?php

/**
 * Testimonial Card Template
 *
 * @param WP_Post $testimonial_data The testimonial post object passed from the parent block.
 */

$testimonial = get_query_var('testimonial_data');

// Get ACF fields from the testimonial post
$quote = get_field('quote', $testimonial->ID);
$headshot = get_field('headshot', $testimonial->ID);
$attribution = get_field('attribution', $testimonial->ID);
$member_since = get_field('member_since', $testimonial->ID);
$star_rating = get_field('star_rating', $testimonial->ID);
?>

<div class="bg-gray-100 flex flex-col items-center justify-center px-[2.625rem] py-[2.625rem]">
    <blockquote class="mb-[4.25rem] text-lg">
        <h4><?php echo esc_html($quote); ?></h4>
    </blockquote>
    <div class="w-full flex gap-4">
        <?php if ($headshot): ?>
            <div><img src="<?php echo esc_url($headshot['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($headshot['alt']); ?>"></div>
        <?php endif; ?>
        <div>

            <div class="flex gap-1.5 mb-2.5">
                <?php for ($i = 0; $i < $star_rating; $i++): ?>
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.76989 2.49716C10.1367 1.75392 11.1965 1.75392 11.5634 2.49716L13.3729 6.16365C13.5185 6.45879 13.8001 6.66336 14.1258 6.71069L18.172 7.29864C18.9922 7.41782 19.3198 8.4258 18.7262 9.00433L15.7984 11.8583C15.5627 12.088 15.4551 12.419 15.5108 12.7434L16.202 16.7733C16.3421 17.5902 15.4846 18.2132 14.751 17.8275L11.132 15.9248C10.8406 15.7717 10.4926 15.7717 10.2013 15.9248L6.58225 17.8275C5.84862 18.2132 4.99119 17.5902 5.1313 16.7733L5.82247 12.7434C5.87811 12.419 5.77056 12.088 5.53487 11.8583L2.60701 9.00433C2.01349 8.4258 2.341 7.41782 3.16122 7.29864L7.20743 6.71069C7.53314 6.66336 7.81471 6.45879 7.96037 6.16365L9.76989 2.49716Z" fill="#2D2D2D" />
                </svg>
                <?php endfor; ?>
                <?php for ($i = 0; $i < 5 - $star_rating; $i++): ?>
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.76989 2.49716C10.1367 1.75392 11.1965 1.75392 11.5634 2.49716L13.3729 6.16365C13.5185 6.45879 13.8001 6.66336 14.1258 6.71069L18.172 7.29864C18.9922 7.41782 19.3198 8.4258 18.7262 9.00433L15.7984 11.8583C15.5627 12.088 15.4551 12.419 15.5108 12.7434L16.202 16.7733C16.3421 17.5902 15.4846 18.2132 14.751 17.8275L11.132 15.9248C10.8406 15.7717 10.4926 15.7717 10.2013 15.9248L6.58225 17.8275C5.84862 18.2132 4.99119 17.5902 5.1313 16.7733L5.82247 12.7434C5.87811 12.419 5.77056 12.088 5.53487 11.8583L2.60701 9.00433C2.01349 8.4258 2.341 7.41782 3.16122 7.29864L7.20743 6.71069C7.53314 6.66336 7.81471 6.45879 7.96037 6.16365L9.76989 2.49716Z" fill="lightgray" />
                    </svg>
                <?php endfor; ?>
            </div>
            <h4><?php echo esc_html($attribution); ?></h4>
            <p class="text-[1.0625rem]">Member since <?php echo esc_html($member_since); ?></p>
        </div>
    </div>
</div>