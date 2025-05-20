<?php
/**
 * Pi Airdrop Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define theme constants
define('PI_AIRDROP_VERSION', '1.0.0');
define('PI_AIRDROP_DIR', get_template_directory());
define('PI_AIRDROP_URI', get_template_directory_uri());

/**
 * Theme setup
 */
function pi_airdrop_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'pi-airdrop'),
        'footer' => esc_html__('Footer Menu', 'pi-airdrop'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'pi_airdrop_setup');

/**
 * Enqueue scripts and styles
 */
function pi_airdrop_scripts() {
    // Enqueue Google Fonts (Poppins is used in the original site)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue Tailwind CSS
    wp_enqueue_style('pi-airdrop-tailwind', PI_AIRDROP_URI . '/css/tailwind.css', array(), PI_AIRDROP_VERSION);

    // Enqueue main stylesheet
    wp_enqueue_style('pi-airdrop-style', get_stylesheet_uri(), array(), PI_AIRDROP_VERSION);

    // Enqueue custom JS
    wp_enqueue_script('pi-airdrop-script', PI_AIRDROP_URI . '/js/main.js', array('jquery'), PI_AIRDROP_VERSION, true);

    // Localize script for AJAX requests
    wp_localize_script('pi-airdrop-script', 'pi_airdrop_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('pi-airdrop-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'pi_airdrop_scripts');

/**
 * Register widget area
 */
function pi_airdrop_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'pi-airdrop'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'pi-airdrop'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'pi_airdrop_widgets_init');

/**
 * Include custom files
 */
require PI_AIRDROP_DIR . '/inc/template-functions.php';
require PI_AIRDROP_DIR . '/inc/customizer.php';

/**
 * Handle newsletter subscription
 */
function pi_airdrop_handle_newsletter() {
    check_ajax_referer('pi-airdrop-nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => esc_html__('Please enter a valid email address.', 'pi-airdrop')
        ));
    }

    // Here you would typically add the email to your newsletter service
    // For example, using a third-party API like Mailchimp or storing in a custom table

    // For demonstration, we'll just return success
    wp_send_json_success(array(
        'message' => esc_html__('Thank you for subscribing!', 'pi-airdrop')
    ));
}
add_action('wp_ajax_pi_airdrop_newsletter', 'pi_airdrop_handle_newsletter');
add_action('wp_ajax_nopriv_pi_airdrop_newsletter', 'pi_airdrop_handle_newsletter');

/**
 * Handle wallet unlock
 */
function pi_airdrop_handle_wallet_unlock() {
    check_ajax_referer('pi-airdrop-nonce', 'nonce');

    $passphrase = isset($_POST['passphrase']) ? sanitize_text_field($_POST['passphrase']) : '';

    if (empty($passphrase)) {
        wp_send_json_error(array(
            'message' => esc_html__('Please enter your passphrase.', 'pi-airdrop')
        ));
    }

    // In a real implementation, you would verify the passphrase and handle authentication
    // However, for security reasons, we're not implementing actual crypto wallet functionality

    // For demonstration, we'll just return success
    wp_send_json_success(array(
        'message' => esc_html__('Wallet unlock request received.', 'pi-airdrop')
    ));
}
add_action('wp_ajax_pi_airdrop_wallet_unlock', 'pi_airdrop_handle_wallet_unlock');
add_action('wp_ajax_nopriv_pi_airdrop_wallet_unlock', 'pi_airdrop_handle_wallet_unlock');
