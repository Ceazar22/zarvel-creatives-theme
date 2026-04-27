<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-shop-page">
  <?php get_template_part('template-parts/woocommerce/collections-hero'); ?>
  <?php get_template_part('template-parts/woocommerce/collections-grid'); ?>
</main>

<?php
get_footer();