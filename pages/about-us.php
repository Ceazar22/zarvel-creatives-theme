<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-about-page">
  <?php get_template_part('template-parts/about-hero'); ?>
  <?php get_template_part('template-parts/about-trust-bar'); ?>
  <?php get_template_part('template-parts/about-story'); ?>
  <?php get_template_part('template-parts/about-team'); ?>
  <?php get_template_part('template-parts/about-stats'); ?>
</main>

<?php
get_footer();