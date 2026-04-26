<?php get_header(); ?>

<main style="padding: 80px 40px;">
  <h1 style="font-size: 50px; color: red;">
    SINGLE PRODUCT TEMPLATE IS WORKING
  </h1>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <h2><?php the_title(); ?></h2>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>