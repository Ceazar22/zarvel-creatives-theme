<?php
defined('ABSPATH') || exit;

$zc_term = get_queried_object();

$zc_current_cat_id = 0;
$zc_current_cat_slug = '';

if ($zc_term && !is_wp_error($zc_term) && !empty($zc_term->term_id)) {
  $zc_current_cat_id = (int) $zc_term->term_id;
  $zc_current_cat_slug = $zc_term->slug;
}

$zc_paged = max(1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page'));

$zc_sort = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : 'featured';
$zc_selected_colors = isset($_GET['color']) ? array_map('sanitize_title', (array) $_GET['color']) : [];
$zc_selected_styles = isset($_GET['style']) ? array_map('sanitize_title', (array) $_GET['style']) : [];
$zc_min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : '';
$zc_max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : '';

$zc_posts_per_page = 12;

$zc_tax_query = [
  'relation' => 'AND',
];

if ($zc_current_cat_id) {
  $zc_tax_query[] = [
    'taxonomy'         => 'product_cat',
    'field'            => 'term_id',
    'terms'            => [$zc_current_cat_id],
    'include_children' => true,
  ];
}

if (!empty($zc_selected_colors) && taxonomy_exists('pa_color')) {
  $zc_tax_query[] = [
    'taxonomy' => 'pa_color',
    'field'    => 'slug',
    'terms'    => $zc_selected_colors,
    'operator' => 'IN',
  ];
}

if (!empty($zc_selected_styles) && taxonomy_exists('pa_style')) {
  $zc_tax_query[] = [
    'taxonomy' => 'pa_style',
    'field'    => 'slug',
    'terms'    => $zc_selected_styles,
    'operator' => 'IN',
  ];
}

$zc_meta_query = [];

if ($zc_min_price !== '' || $zc_max_price !== '') {
  $zc_price_query = [
    'key'     => '_price',
    'type'    => 'NUMERIC',
  ];

  if ($zc_min_price !== '' && $zc_max_price !== '') {
    $zc_price_query['value'] = [$zc_min_price, $zc_max_price];
    $zc_price_query['compare'] = 'BETWEEN';
  } elseif ($zc_min_price !== '') {
    $zc_price_query['value'] = $zc_min_price;
    $zc_price_query['compare'] = '>=';
  } elseif ($zc_max_price !== '') {
    $zc_price_query['value'] = $zc_max_price;
    $zc_price_query['compare'] = '<=';
  }

  $zc_meta_query[] = $zc_price_query;
}

$zc_query_args = [
  'post_type'      => 'product',
  'post_status'    => 'publish',
  'posts_per_page' => $zc_posts_per_page,
  'paged'          => $zc_paged,
  'tax_query'      => $zc_tax_query,
  'meta_query'     => $zc_meta_query,
];

switch ($zc_sort) {
  case 'price-low':
    $zc_query_args['meta_key'] = '_price';
    $zc_query_args['orderby'] = 'meta_value_num';
    $zc_query_args['order'] = 'ASC';
    break;

  case 'price-high':
    $zc_query_args['meta_key'] = '_price';
    $zc_query_args['orderby'] = 'meta_value_num';
    $zc_query_args['order'] = 'DESC';
    break;

  case 'newest':
    $zc_query_args['orderby'] = 'date';
    $zc_query_args['order'] = 'DESC';
    break;

  case 'name':
    $zc_query_args['orderby'] = 'title';
    $zc_query_args['order'] = 'ASC';
    break;

  case 'featured':
  default:
    $zc_query_args['orderby'] = [
      'menu_order' => 'ASC',
      'date'       => 'DESC',
    ];
    break;
}

$zc_products_query = new WP_Query($zc_query_args);

$zc_categories = get_terms([
  'taxonomy'   => 'product_cat',
  'hide_empty' => false,
  'orderby'    => 'name',
  'order'      => 'ASC',
]);

if (is_wp_error($zc_categories)) {
  $zc_categories = [];
}

$zc_color_terms = [];

if (taxonomy_exists('pa_color')) {
  $zc_color_terms = get_terms([
    'taxonomy'   => 'pa_color',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
  ]);

  if (is_wp_error($zc_color_terms)) {
    $zc_color_terms = [];
  }
}

$zc_style_terms = [];

if (taxonomy_exists('pa_style')) {
  $zc_style_terms = get_terms([
    'taxonomy'   => 'pa_style',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
  ]);

  if (is_wp_error($zc_style_terms)) {
    $zc_style_terms = [];
  }
}

if (!function_exists('zc_collection_color_hex')) {
  function zc_collection_color_hex($name) {
    $key = strtolower(trim((string) $name));

    $map = [
      'black' => '#111111',
      'white' => '#ffffff',
      'red' => '#c92828',
      'blue' => '#4f7fa8',
      'navy' => '#111d35',
      'gray' => '#b8b8b8',
      'grey' => '#b8b8b8',
      'sport grey' => '#b8b8b8',
      'sport gray' => '#b8b8b8',
      'ash' => '#d8d8d8',
      'beige' => '#d6c0a2',
      'brown' => '#8b5a35',
      'orange' => '#ff5b1a',
      'mustard' => '#d69b22',
      'yellow' => '#f2c94c',
      'pink' => '#f3a9c4',
      'light pink' => '#f6c6d8',
      'dusty pink' => '#d99aaa',
      'green' => '#5f8f60',
      'purple' => '#7d5ba6',
    ];

    if (isset($map[$key])) {
      return $map[$key];
    }

    if (strpos($key, 'black') !== false) return '#111111';
    if (strpos($key, 'white') !== false) return '#ffffff';
    if (strpos($key, 'pink') !== false) return '#f3a9c4';
    if (strpos($key, 'grey') !== false || strpos($key, 'gray') !== false) return '#b8b8b8';
    if (strpos($key, 'red') !== false) return '#c92828';
    if (strpos($key, 'blue') !== false) return '#4f7fa8';
    if (strpos($key, 'green') !== false) return '#5f8f60';
    if (strpos($key, 'yellow') !== false) return '#f2c94c';
    if (strpos($key, 'orange') !== false) return '#ff5b1a';

    return '#d9d9d9';
  }
}

if (!function_exists('zc_collection_product_color_terms')) {
  function zc_collection_product_color_terms($product_id) {
    if (!taxonomy_exists('pa_color')) {
      return [];
    }

    $terms = get_the_terms($product_id, 'pa_color');

    if (!$terms || is_wp_error($terms)) {
      return [];
    }

    return $terms;
  }
}

$zc_current_url = get_term_link($zc_term);

if (is_wp_error($zc_current_url)) {
  $zc_current_url = home_url('/shop/');
}
?>

<section class="zc-collection-listing">
  <div class="zc-collection-listing__container">

    <aside class="zc-collection-sidebar">

      <form method="get" class="zc-collection-filter-form">

        <div class="zc-filter-group">
          <h3>Categories</h3>

          <ul class="zc-filter-category-list">
            <li>
              <a href="<?php echo esc_url(home_url('/shop/')); ?>">
                All Collections
              </a>
            </li>

            <?php foreach ($zc_categories as $zc_category) : ?>
              <?php
              if (empty($zc_category->slug) || $zc_category->slug === 'uncategorized') {
                continue;
              }

              $zc_cat_link = get_term_link($zc_category);

              if (is_wp_error($zc_cat_link)) {
                continue;
              }
              ?>

              <li>
                <a
                  href="<?php echo esc_url($zc_cat_link); ?>"
                  class="<?php echo $zc_current_cat_id === (int) $zc_category->term_id ? 'is-active' : ''; ?>"
                >
                  <?php echo esc_html($zc_category->name); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <?php if (!empty($zc_color_terms)) : ?>
          <div class="zc-filter-group">
            <h3>Filter By Color</h3>

            <div class="zc-filter-colors">
              <?php foreach ($zc_color_terms as $zc_color) : ?>
                <?php
                $zc_checked = in_array($zc_color->slug, $zc_selected_colors, true);
                $zc_hex = zc_collection_color_hex($zc_color->name);
                ?>

                <label class="zc-filter-color" title="<?php echo esc_attr($zc_color->name); ?>">
                  <input
                    type="checkbox"
                    name="color[]"
                    value="<?php echo esc_attr($zc_color->slug); ?>"
                    <?php checked($zc_checked); ?>
                  >

                  <span
                    class="zc-filter-color__dot"
                    style="background-color: <?php echo esc_attr($zc_hex); ?>;"
                  ></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($zc_style_terms)) : ?>
          <div class="zc-filter-group">
            <h3>Style</h3>

            <div class="zc-filter-checkboxes">
              <?php foreach ($zc_style_terms as $zc_style) : ?>
                <label class="zc-filter-checkbox">
                  <input
                    type="checkbox"
                    name="style[]"
                    value="<?php echo esc_attr($zc_style->slug); ?>"
                    <?php checked(in_array($zc_style->slug, $zc_selected_styles, true)); ?>
                  >

                  <span><?php echo esc_html($zc_style->name); ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="zc-filter-group">
          <h3>Price</h3>

          <div class="zc-filter-price">
            <input
              type="number"
              name="min_price"
              placeholder="Min"
              value="<?php echo $zc_min_price !== '' ? esc_attr($zc_min_price) : ''; ?>"
            >

            <span>-</span>

            <input
              type="number"
              name="max_price"
              placeholder="Max"
              value="<?php echo $zc_max_price !== '' ? esc_attr($zc_max_price) : ''; ?>"
            >
          </div>
        </div>

        <button type="submit" class="zc-filter-submit">
          Apply Filters
        </button>

        <a href="<?php echo esc_url($zc_current_url); ?>" class="zc-filter-reset">
          Clear Filters
        </a>

      </form>

    </aside>

    <div class="zc-collection-main">

      <div class="zc-collection-toolbar">
        <p class="zc-collection-count">
          Showing <?php echo esc_html($zc_products_query->found_posts); ?> product<?php echo $zc_products_query->found_posts === 1 ? '' : 's'; ?>
        </p>

        <form method="get" class="zc-collection-sort-form">
          <?php foreach ($zc_selected_colors as $color_slug) : ?>
            <input type="hidden" name="color[]" value="<?php echo esc_attr($color_slug); ?>">
          <?php endforeach; ?>

          <?php foreach ($zc_selected_styles as $style_slug) : ?>
            <input type="hidden" name="style[]" value="<?php echo esc_attr($style_slug); ?>">
          <?php endforeach; ?>

          <?php if ($zc_min_price !== '') : ?>
            <input type="hidden" name="min_price" value="<?php echo esc_attr($zc_min_price); ?>">
          <?php endif; ?>

          <?php if ($zc_max_price !== '') : ?>
            <input type="hidden" name="max_price" value="<?php echo esc_attr($zc_max_price); ?>">
          <?php endif; ?>

          <select name="sort" onchange="this.form.submit()">
            <option value="featured" <?php selected($zc_sort, 'featured'); ?>>Sort by Featured</option>
            <option value="newest" <?php selected($zc_sort, 'newest'); ?>>Newest</option>
            <option value="price-low" <?php selected($zc_sort, 'price-low'); ?>>Price: Low to High</option>
            <option value="price-high" <?php selected($zc_sort, 'price-high'); ?>>Price: High to Low</option>
            <option value="name" <?php selected($zc_sort, 'name'); ?>>Name A-Z</option>
          </select>
        </form>
      </div>

      <?php if ($zc_products_query->have_posts()) : ?>
        <div class="zc-collection-grid">

          <?php while ($zc_products_query->have_posts()) : ?>
            <?php
            $zc_products_query->the_post();

            $zc_product = wc_get_product(get_the_ID());

            if (!$zc_product || !$zc_product->is_visible()) {
              continue;
            }

            $zc_product_id = $zc_product->get_id();
            $zc_product_url = get_permalink($zc_product_id);
            $zc_product_name = $zc_product->get_name();
            $zc_colors = zc_collection_product_color_terms($zc_product_id);

            $zc_badge = '';
            $zc_badge_class = '';

            if ($zc_product->is_on_sale()) {
              $zc_badge = 'BEST SELLER';
            } elseif ($zc_product->is_featured()) {
              $zc_badge = 'NEW';
              $zc_badge_class = ' zc-product-card-badge--new';
            }
            ?>

            <article class="zc-collection-product-card">

              <a href="<?php echo esc_url($zc_product_url); ?>" class="zc-collection-product-card__image-wrap">
                <?php if ($zc_badge) : ?>
                  <span class="zc-product-card-badge<?php echo esc_attr($zc_badge_class); ?>">
                    <?php echo esc_html($zc_badge); ?>
                  </span>
                <?php endif; ?>

                <?php
                echo $zc_product->get_image('woocommerce_thumbnail', [
                  'class' => 'zc-collection-product-card__image',
                  'alt'   => esc_attr($zc_product_name),
                ]);
                ?>
              </a>

              <div class="zc-collection-product-card__info">
                <h3 class="zc-collection-product-card__title">
                  <a href="<?php echo esc_url($zc_product_url); ?>">
                    <?php echo esc_html($zc_product_name); ?>
                  </a>
                </h3>

                <div class="zc-collection-product-card__price">
                  <?php echo wp_kses_post($zc_product->get_price_html()); ?>
                </div>

                <?php if (!empty($zc_colors)) : ?>
                  <div class="zc-collection-product-card__colors">
                    <?php foreach (array_slice($zc_colors, 0, 5) as $zc_color) : ?>
                      <span
                        class="zc-product-color-dot"
                        title="<?php echo esc_attr($zc_color->name); ?>"
                        style="background-color: <?php echo esc_attr(zc_collection_color_hex($zc_color->name)); ?>;"
                      ></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

            </article>

          <?php endwhile; ?>
        </div>

        <?php
        $zc_total_pages = (int) $zc_products_query->max_num_pages;

        if ($zc_total_pages > 1) :
          $zc_current_query = $_GET;
          unset($zc_current_query['paged']);
          ?>

          <nav class="zc-collection-pagination">
            <?php
            echo paginate_links([
              'base'      => esc_url_raw(add_query_arg('paged', '%#%', $zc_current_url)),
              'format'    => '',
              'current'   => $zc_paged,
              'total'     => $zc_total_pages,
              'prev_text' => '‹',
              'next_text' => '›',
              'add_args'  => $zc_current_query,
            ]);
            ?>
          </nav>
        <?php endif; ?>

      <?php else : ?>

        <div class="zc-collection-empty">
          <h2>No products found</h2>
          <p>Try clearing the filters or checking another category.</p>
        </div>

      <?php endif; ?>

      <?php wp_reset_postdata(); ?>

    </div>

  </div>
</section>

<style>
.zc-collection-listing {
  padding: 40px 0 90px;
  background: #ffffff;
}

.zc-collection-listing__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 220px 1fr;
  gap: 30px;
  align-items: start;
}

.zc-collection-sidebar {
  position: sticky;
  top: 120px;
}

.zc-collection-filter-form {
  width: 100%;
}

.zc-filter-group {
  padding-bottom: 22px;
  margin-bottom: 22px;
  border-bottom: 1px solid #eeeeee;
}

.zc-filter-group h3 {
  margin: 0 0 13px;
  color: #111111;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-filter-category-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.zc-filter-category-list li {
  margin-bottom: 9px;
}

.zc-filter-category-list a {
  color: #333333;
  font-size: 13px;
  line-height: 1.2;
  font-weight: 700;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-filter-category-list a:hover,
.zc-filter-category-list a.is-active {
  color: #ff5b1a;
}

.zc-filter-colors {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 11px;
}

.zc-filter-color {
  position: relative;
  display: inline-flex;
  cursor: pointer;
}

.zc-filter-color input {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

.zc-filter-color__dot {
  width: 22px;
  height: 22px;
  border-radius: 50%;
  border: 1px solid #d7d7d7;
  display: block;
  transition: 0.2s ease;
}

.zc-filter-color input:checked + .zc-filter-color__dot {
  box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #111111;
}

.zc-filter-checkboxes {
  display: grid;
  gap: 10px;
}

.zc-filter-checkbox {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #333333;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
}

.zc-filter-checkbox input {
  width: 14px;
  height: 14px;
  accent-color: #ff5b1a;
}

.zc-filter-price {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  gap: 8px;
  align-items: center;
}

.zc-filter-price input {
  width: 100%;
  height: 34px;
  padding: 0 9px;
  border: 1px solid #dddddd;
  border-radius: 7px;
  color: #111111;
  font-size: 12px;
  font-weight: 750;
  outline: none;
}

.zc-filter-submit,
.zc-filter-reset {
  width: 100%;
  min-height: 40px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 950;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-filter-submit {
  border: 0;
  background: #ff5b1a;
  color: #ffffff;
  cursor: pointer;
}

.zc-filter-reset {
  margin-top: 10px;
  background: #111111;
  color: #ffffff;
  text-decoration: none;
}

.zc-collection-main {
  min-width: 0;
}

.zc-collection-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 18px;
  margin-bottom: 22px;
}

.zc-collection-count {
  margin: 0;
  color: #555555;
  font-size: 13px;
  font-weight: 800;
}

.zc-collection-sort-form select {
  height: 38px;
  min-width: 170px;
  padding: 0 36px 0 13px;
  border: 1px solid #dddddd;
  border-radius: 8px;
  background: #ffffff;
  color: #111111;
  font-size: 12px;
  font-weight: 850;
  outline: none;
}

.zc-collection-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 22px;
}

.zc-collection-product-card {
  min-width: 0;
}

.zc-collection-product-card__image-wrap {
  position: relative;
  height: 235px;
  padding: 16px;
  border-radius: 12px;
  background: #f7f7f7;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.zc-collection-product-card__image,
.zc-collection-product-card__image-wrap img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
  transition: 0.25s ease;
}

.zc-collection-product-card:hover .zc-collection-product-card__image,
.zc-collection-product-card:hover .zc-collection-product-card__image-wrap img {
  transform: scale(1.04);
}

.zc-product-card-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  z-index: 2;
  background: #ff5b1a;
  color: #ffffff;
  font-size: 10px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
  padding: 7px 9px;
  border-radius: 6px;
}

.zc-product-card-badge--new {
  background: #111111;
}

.zc-collection-product-card__info {
  padding: 11px 2px 0;
}

.zc-collection-product-card__title {
  margin: 0 0 7px;
  font-size: 14px;
  line-height: 1.25;
  font-weight: 950;
}

.zc-collection-product-card__title a {
  color: #111111;
  text-decoration: none;
}

.zc-collection-product-card__title a:hover {
  color: #ff5b1a;
}

.zc-collection-product-card__price {
  color: #ff5b1a;
  font-size: 13px;
  line-height: 1;
  font-weight: 950;
}

.zc-collection-product-card__price del {
  color: #999999;
  font-size: 12px;
  font-weight: 700;
  margin-right: 5px;
}

.zc-collection-product-card__price ins {
  color: #ff5b1a;
  text-decoration: none;
}

.zc-collection-product-card__colors {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 9px;
}

.zc-product-color-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  display: inline-block;
  border: 1px solid #d9d9d9;
}

.zc-collection-pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 7px;
  margin-top: 42px;
}

.zc-collection-pagination .page-numbers {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #ffffff;
  color: #111111;
  border: 1px solid #eeeeee;
  font-size: 12px;
  font-weight: 900;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-collection-pagination .page-numbers.current,
.zc-collection-pagination .page-numbers:hover {
  background: #111111;
  color: #ffffff;
}

.zc-collection-empty {
  padding: 70px 30px;
  border-radius: 14px;
  background: #fbf7f3;
  text-align: center;
}

.zc-collection-empty h2 {
  margin: 0 0 8px;
  font-size: 28px;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-collection-empty p {
  margin: 0;
  color: #555555;
  font-size: 14px;
  font-weight: 700;
}

@media screen and (max-width: 1024px) {
  .zc-collection-listing__container {
    grid-template-columns: 190px 1fr;
    gap: 24px;
  }

  .zc-collection-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }

  .zc-collection-product-card__image-wrap {
    height: 210px;
  }
}

@media screen and (max-width: 768px) {
  .zc-collection-listing {
    padding: 30px 0 70px;
  }

  .zc-collection-listing__container {
    width: min(100% - 30px, 1280px);
    grid-template-columns: 1fr;
  }

  .zc-collection-sidebar {
    position: static;
    padding: 18px;
    border-radius: 14px;
    background: #fbf7f3;
    border: 1px solid #eeeeee;
  }

  .zc-collection-toolbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .zc-collection-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
  }

  .zc-collection-product-card__image-wrap {
    height: 190px;
  }
}

@media screen and (max-width: 480px) {
  .zc-collection-grid {
    grid-template-columns: 1fr;
  }

  .zc-collection-product-card__image-wrap {
    height: 230px;
  }

  .zc-collection-sort-form,
  .zc-collection-sort-form select {
    width: 100%;
  }
}
</style>