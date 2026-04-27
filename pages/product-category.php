<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="zc-collection-page">

  <?php get_template_part('template-parts/woocommerce/collection-hero'); ?>

  <section class="zc-collection-products">
    <div class="zc-collection-products__container">

      <?php if (woocommerce_product_loop()) : ?>

        <?php do_action('woocommerce_before_shop_loop'); ?>

        <?php woocommerce_product_loop_start(); ?>

          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part('content', 'product'); ?>
          <?php endwhile; ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php do_action('woocommerce_after_shop_loop'); ?>

      <?php else : ?>

        <?php do_action('woocommerce_no_products_found'); ?>

      <?php endif; ?>

    </div>
  </section>

</main>

<?php
get_footer();