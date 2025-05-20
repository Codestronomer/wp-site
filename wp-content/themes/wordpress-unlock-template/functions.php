<?php
// Basic theme setup
function unlock_wallet_theme_setup() {
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'unlock_wallet_theme_setup');

// Enqueue styles
function unlock_wallet_theme_scripts() {
  wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'unlock_wallet_theme_scripts');
