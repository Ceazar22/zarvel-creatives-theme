<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-single-product-page">

  <?php get_template_part('template-parts/woocommerce/sections/gallery-product'); ?>

  <?php get_template_part('template-parts/sections/home-how-it-works'); ?>

  <?php get_template_part('template-parts/woocommerce/sections/product-info-reviews'); ?>

  <?php get_template_part('template-parts/woocommerce/sections/product-you-may-like'); ?>

</main>

<?php
get_footer();