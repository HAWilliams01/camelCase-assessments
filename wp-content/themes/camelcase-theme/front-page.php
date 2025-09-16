<?php
/**
 * The front page template file
 *
 * @package Camelcase_Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="hero bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-6 py-20 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Welcome to <?php bloginfo( 'name' ); ?>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
                <?php
                $description = get_bloginfo( 'description', 'display' );
                echo $description ? $description : 'A modern WordPress theme built with cutting-edge technology for exceptional performance and design.';
                ?>
            </p>
            <div class="space-x-4">
                <a href="#features" class="btn bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition-colors">
                    Learn More
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-semibold transition-colors">
                    Get Started
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Modern Features</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Built with the latest web technologies for optimal performance and user experience.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div x-data="fadeIn" class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Lightning Fast</h3>
                    <p class="text-gray-600">
                        Powered by Vite for instant hot module replacement and optimized builds.
                    </p>
                </div>

                <div x-data="fadeIn" class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Tailwind CSS</h3>
                    <p class="text-gray-600">
                        Utility-first CSS framework for rapid UI development and consistent design.
                    </p>
                </div>

                <div x-data="fadeIn" class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Responsive</h3>
                    <p class="text-gray-600">
                        Mobile-first design that looks perfect on all devices and screen sizes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest Posts</h2>
                <p class="text-xl text-gray-600">
                    Stay updated with our latest insights and news.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 3,
                    'post_status' => 'publish'
                ));

                foreach( $recent_posts as $post_item ) :
                    $post_id = $post_item['ID'];
                    ?>
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <?php echo get_the_post_thumbnail( $post_id, 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-3">
                                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="text-gray-900 hover:text-blue-600 transition-colors">
                                    <?php echo esc_html( $post_item['post_title'] ); ?>
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?php echo wp_trim_words( $post_item['post_content'], 20 ); ?>
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span><?php echo get_the_date( 'M j, Y', $post_id ); ?></span>
                                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach;
                wp_reset_query(); ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn bg-blue-600 text-white hover:bg-blue-700 px-8 py-3 rounded-lg font-semibold transition-colors">
                    View All Posts
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
                Join thousands of users who trust our modern WordPress theme for their projects.
            </p>
            <div class="space-x-4">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition-colors">
                    Contact Us
                </a>
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-semibold transition-colors">
                    Learn More
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>