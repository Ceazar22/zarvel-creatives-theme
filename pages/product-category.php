<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-collection-page">
  <?php get_template_part('template-parts/woocommerce/collection-hero'); ?>
  <?php get_template_part('template-parts/woocommerce/collection-products'); ?>
  <?php get_template_part('template-parts/woocommerce/collections-cta-banner'); ?>
</main>

<?php
get_footer();