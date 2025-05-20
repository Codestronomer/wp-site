<?php
/**
 * Pi Airdrop Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pi_airdrop_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'pi_airdrop_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'pi_airdrop_customize_partial_blogdescription',
            )
        );
    }

    // Hero Section
    $wp_customize->add_section('pi_airdrop_hero', array(
        'title'    => __('Hero Section', 'pi-airdrop'),
        'priority' => 30,
    ));

    // Hero Title
    $wp_customize->add_setting('pi_airdrop_hero_title', array(
        'default'           => 'Pi Network <span class="text-yellow-400">Future</span> First Airdrop',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_hero_title', array(
        'label'   => __('Hero Title', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'textarea',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('pi_airdrop_hero_subtitle', array(
        'default'           => 'Join thousands of investors building their wealth with cryptocurrencies',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'text',
    ));

    // CTA Button Text
    $wp_customize->add_setting('pi_airdrop_cta_button_text', array(
        'default'           => 'Claim 614 Pi Network Coins',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_cta_button_text', array(
        'label'   => __('CTA Button Text', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'text',
    ));

    // CTA Button URL
    $wp_customize->add_setting('pi_airdrop_cta_button_url', array(
        'default'           => '/unlock',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_cta_button_url', array(
        'label'   => __('CTA Button URL', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'url',
    ));

    // Learn More Text
    $wp_customize->add_setting('pi_airdrop_learn_more_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_learn_more_text', array(
        'label'   => __('Learn More Text', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'text',
    ));

    // Learn More URL
    $wp_customize->add_setting('pi_airdrop_learn_more_url', array(
        'default'           => '#learn-more',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_learn_more_url', array(
        'label'   => __('Learn More URL', 'pi-airdrop'),
        'section' => 'pi_airdrop_hero',
        'type'    => 'url',
    ));

    // Community Section
    $wp_customize->add_section('pi_airdrop_community', array(
        'title'    => __('Community Section', 'pi-airdrop'),
        'priority' => 40,
    ));

    // Community Title
    $wp_customize->add_setting('pi_airdrop_community_title', array(
        'default'           => 'Join Our Thriving Community',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_community_title', array(
        'label'   => __('Community Section Title', 'pi-airdrop'),
        'section' => 'pi_airdrop_community',
        'type'    => 'text',
    ));

    // Community Text
    $wp_customize->add_setting('pi_airdrop_community_text', array(
        'default'           => 'Be part of the revolution and help shape the future of digital currency. Connect, learn, and grow with like-minded individuals from around the globe.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_community_text', array(
        'label'   => __('Community Section Text', 'pi-airdrop'),
        'section' => 'pi_airdrop_community',
        'type'    => 'textarea',
    ));

    // Active Users
    $wp_customize->add_setting('pi_airdrop_active_users', array(
        'default'           => '2M+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_active_users', array(
        'label'   => __('Active Users Count', 'pi-airdrop'),
        'section' => 'pi_airdrop_community',
        'type'    => 'text',
    ));

    // Daily Discussions
    $wp_customize->add_setting('pi_airdrop_daily_discussions', array(
        'default'           => '50K+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_daily_discussions', array(
        'label'   => __('Daily Discussions Count', 'pi-airdrop'),
        'section' => 'pi_airdrop_community',
        'type'    => 'text',
    ));

    // Countries
    $wp_customize->add_setting('pi_airdrop_countries', array(
        'default'           => '180+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_countries', array(
        'label'   => __('Countries Count', 'pi-airdrop'),
        'section' => 'pi_airdrop_community',
        'type'    => 'text',
    ));

    // App Download Section
    $wp_customize->add_section('pi_airdrop_app', array(
        'title'    => __('App Download Section', 'pi-airdrop'),
        'priority' => 50,
    ));

    // Play Store URL
    $wp_customize->add_setting('pi_airdrop_play_store_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_play_store_url', array(
        'label'   => __('Google Play Store URL', 'pi-airdrop'),
        'section' => 'pi_airdrop_app',
        'type'    => 'url',
    ));

    // App Store URL
    $wp_customize->add_setting('pi_airdrop_app_store_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_app_store_url', array(
        'label'   => __('Apple App Store URL', 'pi-airdrop'),
        'section' => 'pi_airdrop_app',
        'type'    => 'url',
    ));

    // Subscribe Section
    $wp_customize->add_section('pi_airdrop_subscribe', array(
        'title'    => __('Subscribe Section', 'pi-airdrop'),
        'priority' => 60,
    ));

    // Subscribe Title
    $wp_customize->add_setting('pi_airdrop_subscribe_title', array(
        'default'           => 'Subscribe for Updates',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_subscribe_title', array(
        'label'   => __('Subscribe Section Title', 'pi-airdrop'),
        'section' => 'pi_airdrop_subscribe',
        'type'    => 'text',
    ));

    // Subscribe Text
    $wp_customize->add_setting('pi_airdrop_subscribe_text', array(
        'default'           => 'Stay updated with the latest news and offers from our community.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_subscribe_text', array(
        'label'   => __('Subscribe Section Text', 'pi-airdrop'),
        'section' => 'pi_airdrop_subscribe',
        'type'    => 'textarea',
    ));

    // Wallet Page
    $wp_customize->add_section('pi_airdrop_wallet', array(
        'title'    => __('Wallet Page', 'pi-airdrop'),
        'priority' => 70,
    ));

    // Wallet Title
    $wp_customize->add_setting('pi_airdrop_wallet_title', array(
        'default'           => 'Unlock Pi Wallet',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('pi_airdrop_wallet_title', array(
        'label'   => __('Wallet Page Title', 'pi-airdrop'),
        'section' => 'pi_airdrop_wallet',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'pi_airdrop_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pi_airdrop_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pi_airdrop_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pi_airdrop_customize_preview_js() {
    wp_enqueue_script('pi-airdrop-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), PI_AIRDROP_VERSION, true);
}
add_action('customize_preview_init', 'pi_airdrop_customize_preview_js');
