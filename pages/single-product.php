<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-single-product-page">
  <?php get_template_part('template-parts/woocommerce/gallery-product'); ?>
  <?php get_template_part('template-parts/home-how-it-works'); ?>
  <?php get_template_part('template-parts/woocommerce/product-info-reviews'); ?>
  <?php get_template_part('template-parts/woocommerce/product-you-may-like'); ?>
</main>

<?php
get_footer();