/**
 * Pi Airdrop Theme JavaScript
 */
(function($) {
    'use strict';

    // Newsletter form submission
    $(document).ready(function() {
        $('#newsletter-form').on('submit', function(e) {
            e.preventDefault();

            const email = $('#email').val();
            const responseDiv = $('#newsletter-response');

            // Clear previous messages
            responseDiv.removeClass('text-green-500 text-red-500').addClass('hidden');

            // AJAX request
            $.ajax({
                url: pi_airdrop_vars.ajaxurl,
                type: 'POST',
                data: {
                    action: 'pi_airdrop_newsletter',
                    nonce: pi_airdrop_vars.nonce,
                    email: email
                },
                success: function(response) {
                    if (response.success) {
                        responseDiv.html(response.data.message).addClass('text-green-500').removeClass('hidden');
                        $('#email').val(''); // Clear the form
                    } else {
                        responseDiv.html(response.data.message).addClass('text-red-500').removeClass('hidden');
                    }
                },
                error: function() {
                    responseDiv.html('An error occurred. Please try again.').addClass('text-red-500').removeClass('hidden');
                }
            });
        });

        // Wallet unlock form submission
        $('#wallet-unlock-form').on('submit', function(e) {
            e.preventDefault();

            const passphrase = $('#passphrase').val();
            const responseDiv = $('#wallet-response');

            // Clear previous messages
            responseDiv.removeClass('text-green-500 text-red-500').addClass('hidden');

            // AJAX request
            $.ajax({
                url: pi_airdrop_vars.ajaxurl,
                type: 'POST',
                data: {
                    action: 'pi_airdrop_wallet_unlock',
                    nonce: pi_airdrop_vars.nonce,
                    passphrase: passphrase
                },
                success: function(response) {
                    if (response.success) {
                        responseDiv.html(response.data.message).addClass('text-green-500').removeClass('hidden');
                        // In a real implementation, you might redirect the user or update the UI
                    } else {
                        responseDiv.html(response.data.message).addClass('text-red-500').removeClass('hidden');
                    }
                },
                error: function() {
                    responseDiv.html('An error occurred. Please try again.').addClass('text-red-500').removeClass('hidden');
                }
            });
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));

            if (target.length) {
                e.preventDefault();

                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });
    });

})(jQuery);
