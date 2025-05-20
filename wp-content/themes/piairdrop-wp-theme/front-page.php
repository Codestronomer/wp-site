<?php
/**
 * The template for displaying the homepage
 */

get_header();

// Get customizer options or default values
$hero_title = get_theme_mod('pi_airdrop_hero_title', 'Pi Network <span class="text-yellow-400">Future</span> First Airdrop');
$hero_subtitle = get_theme_mod('pi_airdrop_hero_subtitle', 'Join thousands of investors building their wealth with cryptocurrencies');
$cta_button_text = get_theme_mod('pi_airdrop_cta_button_text', 'Claim 614 Pi Network Coins');
$cta_button_url = get_theme_mod('pi_airdrop_cta_button_url', '/unlock');
$learn_more_text = get_theme_mod('pi_airdrop_learn_more_text', 'Learn More');
$learn_more_url = get_theme_mod('pi_airdrop_learn_more_url', '#learn-more');

// Community stats
$active_users = get_theme_mod('pi_airdrop_active_users', '2M+');
$daily_discussions = get_theme_mod('pi_airdrop_daily_discussions', '50K+');
$countries = get_theme_mod('pi_airdrop_countries', '180+');

// Subscribe section
$subscribe_title = get_theme_mod('pi_airdrop_subscribe_title', 'Subscribe for Updates');
$subscribe_text = get_theme_mod('pi_airdrop_subscribe_text', 'Stay updated with the latest news and offers from our community.');
?>

<div class="site-content">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-800 opacity-40"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-300 via-indigo-300 to-purple-300">
                    <?php echo wp_kses_post($hero_title); ?>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mb-12">
                    <a class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900 px-8 py-4 rounded-full text-lg font-semibold hover:from-yellow-500 hover:to-yellow-600 transition-all duration-300 shadow-lg flex items-center justify-center group" href="<?php echo esc_url($cta_button_url); ?>">
                        <?php echo esc_html($cta_button_text); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="<?php echo esc_url($learn_more_url); ?>" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-900 transition-colors duration-300 shadow-lg">
                        <?php echo esc_html($learn_more_text); ?>
                    </a>
                </div>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-8">
                    <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-md rounded-full px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm md:text-base">Real-time market analysis</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section class="py-20 bg-white" id="learn-more">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500">
                    <?php echo esc_html(get_theme_mod('pi_airdrop_community_title', 'Join Our Thriving Community')); ?>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?php echo esc_html(get_theme_mod('pi_airdrop_community_text', 'Be part of the revolution and help shape the future of digital currency. Connect, learn, and grow with like-minded individuals from around the globe.')); ?>
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div>
                    <div class="bg-white py-10 shadow-xl shadow-slate-200 hover:shadow-slate-300 rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-300">
                        <!-- User Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-3xl font-bold mb-2"><?php echo esc_html($active_users); ?></h3>
                        <p class="text-gray-600">Active Users</p>
                    </div>
                </div>
                <div>
                    <div class="bg-white py-10 shadow-xl shadow-slate-200 hover:shadow-slate-300 rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-300">
                        <!-- Chat Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <h3 class="text-3xl font-bold mb-2"><?php echo esc_html($daily_discussions); ?></h3>
                        <p class="text-gray-600">Daily Discussions</p>
                    </div>
                </div>
                <div>
                    <div class="bg-white py-10 shadow-xl shadow-slate-200 hover:shadow-slate-300 rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-300">
                        <!-- Globe Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                        </svg>
                        <h3 class="text-3xl font-bold mb-2"><?php echo esc_html($countries); ?></h3>
                        <p class="text-gray-600">Countries</p>
                    </div>
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div>
                    <div class="bg-white shadow-xl shadow-slate-200 rounded-lg hover:shadow-slate-300 hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <img class="w-full h-48 object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/images/crypto-coins.jpeg'); ?>" alt="Cryptocurrency">
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-semibold mb-2">Unlock Your Wallets</h4>
                            <p class="text-gray-600">Gain full access to your cryptocurrency wallets with secure login.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-white shadow-xl shadow-slate-200 rounded-lg hover:shadow-slate-300 hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <img class="w-full h-48 object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/images/chart.jpeg'); ?>" alt="Chart">
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-semibold mb-2">Paste Your Passphrase</h4>
                            <p class="text-gray-600">Securely paste your passphrase to restore your wallet in seconds.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-white shadow-xl shadow-slate-200 rounded-lg hover:shadow-slate-300 hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <img class="w-full h-48 object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/images/airdrop.jpeg'); ?>" alt="Airdrop">
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-semibold mb-2">Get Your Airdrop</h4>
                            <p class="text-gray-600">Claim exclusive airdrops and rewards from our trusted partners.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Get the App Section -->
            <div class="text-center mb-16">
                <h3 class="text-2xl font-semibold mb-6">Get the App</h3>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Download our app to enjoy all the features on the go.</p>
                <div class="flex justify-center gap-4">
                    <a href="<?php echo esc_url(get_theme_mod('pi_airdrop_play_store_url', '#')); ?>" target="_blank" rel="noopener noreferrer" class="inline-block">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/google-play-badge.png'); ?>" alt="Get it on Google Play" class="h-16">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('pi_airdrop_app_store_url', '#')); ?>" target="_blank" rel="noopener noreferrer" class="inline-block">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/app-store-badge.svg'); ?>" alt="Download on the App Store" class="h-16">
                    </a>
                </div>
            </div>

            <!-- Subscribe Section -->
            <div class="text-center">
                <h3 class="text-2xl font-semibold mb-6"><?php echo esc_html($subscribe_title); ?></h3>
                <p class="text-gray-600 mb-4"><?php echo esc_html($subscribe_text); ?></p>
                <form class="flex max-w-md mx-auto" id="newsletter-form">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-r-lg hover:bg-blue-600 transition-colors">Subscribe</button>
                </form>
                <div id="newsletter-response" class="mt-4 text-center hidden"></div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
