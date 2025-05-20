<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased bg-white text-gray-900'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <?php if (is_page_template('page-unlock.php')) : ?>
        <section class="bg-[#66237d] h-16 w-full flex flex-row items-center justify-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/wallet-icon.png'); ?>" alt="Wallet" class="w-6 h-6 mr-2">
            <h3 class="mx-4 text-white text-lg">Wallet</h3>
        </section>
    <?php endif; ?>
