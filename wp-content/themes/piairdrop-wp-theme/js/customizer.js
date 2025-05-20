/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($) {
    'use strict';

    // Site title and description.
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Hero section
    wp.customize('pi_airdrop_hero_title', function(value) {
        value.bind(function(to) {
            $('.hero-title').html(to);
        });
    });

    wp.customize('pi_airdrop_hero_subtitle', function(value) {
        value.bind(function(to) {
            $('.hero-subtitle').text(to);
        });
    });

    wp.customize('pi_airdrop_cta_button_text', function(value) {
        value.bind(function(to) {
            $('.cta-button').text(to);
        });
    });

    wp.customize('pi_airdrop_cta_button_url', function(value) {
        value.bind(function(to) {
            $('.cta-button').attr('href', to);
        });
    });

    wp.customize('pi_airdrop_learn_more_text', function(value) {
        value.bind(function(to) {
            $('.learn-more-button').text(to);
        });
    });

    wp.customize('pi_airdrop_learn_more_url', function(value) {
        value.bind(function(to) {
            $('.learn-more-button').attr('href', to);
        });
    });

    // Community section
    wp.customize('pi_airdrop_community_title', function(value) {
        value.bind(function(to) {
            $('.community-title').text(to);
        });
    });

    wp.customize('pi_airdrop_community_text', function(value) {
        value.bind(function(to) {
            $('.community-text').text(to);
        });
    });

    wp.customize('pi_airdrop_active_users', function(value) {
        value.bind(function(to) {
            $('.active-users-count').text(to);
        });
    });

    wp.customize('pi_airdrop_daily_discussions', function(value) {
        value.bind(function(to) {
            $('.daily-discussions-count').text(to);
        });
    });

    wp.customize('pi_airdrop_countries', function(value) {
        value.bind(function(to) {
            $('.countries-count').text(to);
        });
    });

    // App download section
    wp.customize('pi_airdrop_play_store_url', function(value) {
        value.bind(function(to) {
            $('.play-store-link').attr('href', to);
        });
    });

    wp.customize('pi_airdrop_app_store_url', function(value) {
        value.bind(function(to) {
            $('.app-store-link').attr('href', to);
        });
    });

    // Subscribe section
    wp.customize('pi_airdrop_subscribe_title', function(value) {
        value.bind(function(to) {
            $('.subscribe-title').text(to);
        });
    });

    wp.customize('pi_airdrop_subscribe_text', function(value) {
        value.bind(function(to) {
            $('.subscribe-text').text(to);
        });
    });

    // Wallet page
    wp.customize('pi_airdrop_wallet_title', function(value) {
        value.bind(function(to) {
            $('.wallet-title').text(to);
        });
    });

})(jQuery);
