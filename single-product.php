<?php
defined('ABSPATH') || exit;

get_header();

global $product;

if (!is_a($product, 'WC_Product')) {
  $product = wc_get_product(get_the_ID());
}

if (!$product) {
  get_footer();
  return;
}

wp_enqueue_script('wc-add-to-cart-variation');

/**
 * Main image only.
 * Do NOT show all gallery images because Printful/WooCommerce can add
 * every variant color/mockup into the gallery.
 */
$main_image_id = $product->get_image_id();

$image_ids = array_filter([$main_image_id]);

$main_image_url = $main_image_id
  ? wp_get_attachment_image_url($main_image_id, 'large')
  : wc_placeholder_img_src('woocommerce_single');

$main_image_alt = $main_image_id
  ? get_post_meta($main_image_id, '_wp_attachment_image_alt', true)
  : $product->get_name();

$average_rating = $product->get_average_rating();
$review_count   = $product->get_review_count();

$button_text_filter = function () {
  return 'SEND DESIGN REQUEST';
};
?>

<main class="zc-single-product-page">

  <section class="zc-product-section">
    <div class="zc-product-container">

      <div class="zc-product-breadcrumb">
        <?php
        woocommerce_breadcrumb([
          'delimiter'   => '<span>/</span>',
          'wrap_before' => '<nav class="woocommerce-breadcrumb">',
          'wrap_after'  => '</nav>',
          'before'      => '',
          'after'       => '',
          'home'        => 'Home',
        ]);
        ?>
      </div>

      <div class="zc-product-layout">

        <!-- LEFT GALLERY -->
        <div class="zc-product-gallery">

          <div class="zc-product-thumbs">
            <?php if (!empty($image_ids)) : ?>
              <?php foreach ($image_ids as $index => $image_id) : ?>
                <?php
                $thumb_url = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
                $large_url = wp_get_attachment_image_url($image_id, 'large');
                $alt_text  = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                ?>

                <button
                  class="zc-product-thumb <?php echo $index === 0 ? 'is-active' : ''; ?>"
                  type="button"
                  data-large="<?php echo esc_url($large_url); ?>"
                  data-alt="<?php echo esc_attr($alt_text ?: $product->get_name()); ?>"
                >
                  <img
                    src="<?php echo esc_url($thumb_url); ?>"
                    alt="<?php echo esc_attr($alt_text ?: $product->get_name()); ?>"
                  >
                </button>
              <?php endforeach; ?>
            <?php else : ?>
              <button
                class="zc-product-thumb is-active"
                type="button"
                data-large="<?php echo esc_url(wc_placeholder_img_src('woocommerce_single')); ?>"
                data-alt="<?php echo esc_attr($product->get_name()); ?>"
              >
                <img
                  src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                  alt="<?php echo esc_attr($product->get_name()); ?>"
                >
              </button>
            <?php endif; ?>
          </div>

          <div class="zc-product-main-image-wrap">
            <button class="zc-product-wishlist" type="button" aria-label="Add to wishlist">
              <svg viewBox="0 0 24 24">
                <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
              </svg>
            </button>

            <img
              id="zcMainProductImage"
              class="zc-product-main-image"
              src="<?php echo esc_url($main_image_url); ?>"
              alt="<?php echo esc_attr($main_image_alt ?: $product->get_name()); ?>"
            >

            <button class="zc-product-zoom" type="button" aria-label="Zoom image">
              <svg viewBox="0 0 24 24">
                <path d="M21 21l-4.35-4.35"></path>
                <circle cx="11" cy="11" r="7"></circle>
                <path d="M11 8v6"></path>
                <path d="M8 11h6"></path>
              </svg>
            </button>
          </div>

        </div>

        <!-- RIGHT SUMMARY -->
        <div class="zc-product-summary">

          <h1 class="zc-product-title">
            <?php echo esc_html($product->get_name()); ?>
          </h1>

          <div class="zc-product-rating-row">
            <div class="zc-product-stars">
              <?php
              if ($average_rating > 0) {
                echo wp_kses_post(wc_get_rating_html($average_rating, $review_count));
              } else {
                echo '<span class="zc-empty-stars">★★★★★</span>';
              }
              ?>
            </div>

            <a href="#reviews" class="zc-product-review-link">
              (<?php echo esc_html($review_count); ?> review<?php echo $review_count == 1 ? '' : 's'; ?>)
            </a>
          </div>

          <div class="zc-product-price">
            <?php echo wp_kses_post($product->get_price_html()); ?>
          </div>

          <div class="zc-product-short-desc">
            <?php
            if ($product->get_short_description()) {
              echo wp_kses_post(wpautop($product->get_short_description()));
            } else {
              echo '<p>Send us your logo or idea and we’ll handle the design for you. You’ll get a digital proof before we print.</p>';
            }
            ?>
          </div>

          <div class="zc-product-benefits">
            <div class="zc-product-benefit">
              <svg viewBox="0 0 24 24">
                <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z"></path>
                <path d="M9 12l2 2 4-5"></path>
              </svg>
              <span>Premium<br>Print Quality</span>
            </div>

            <div class="zc-product-benefit">
              <svg viewBox="0 0 24 24">
                <rect x="4" y="5" width="16" height="14" rx="2"></rect>
                <path d="M8 14l3-3 3 3 2-2 4 4"></path>
                <circle cx="9" cy="9" r="1"></circle>
              </svg>
              <span>Free Mockup<br>By Email</span>
            </div>

            <div class="zc-product-benefit">
              <svg viewBox="0 0 24 24">
                <path d="M3 7h11v9H3z"></path>
                <path d="M14 10h4l3 3v3h-7z"></path>
                <circle cx="7" cy="18" r="2"></circle>
                <circle cx="18" cy="18" r="2"></circle>
              </svg>
              <span>Fast<br>Production</span>
            </div>

            <div class="zc-product-benefit">
              <svg viewBox="0 0 24 24">
                <path d="M12 3l8 4v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"></path>
                <path d="M8 12h8"></path>
              </svg>
              <span>No Minimum<br>Order</span>
            </div>
          </div>

          <div class="zc-product-form-area">
            <?php
            add_filter('woocommerce_product_single_add_to_cart_text', $button_text_filter);
            woocommerce_template_single_add_to_cart();
            remove_filter('woocommerce_product_single_add_to_cart_text', $button_text_filter);
            ?>

            <a href="<?php echo esc_url(home_url('/product-category/t-shirts')); ?>" class="zc-shop-blank-btn">
              SHOP BLANK SHIRTS
            </a>
          </div>

          <div class="zc-product-trust-row">
            <span>100% Satisfaction Guarantee</span>
            <span>Secure Checkout</span>
            <span>Trusted by 10,000+ Customers</span>
          </div>

        </div>

      </div>

    </div>
  </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const mainImage = document.querySelector('#zcMainProductImage');
  const thumbs = document.querySelectorAll('.zc-product-thumb[data-large]');

  function updateMainImage(src, alt) {
    if (!mainImage || !src) return;

    mainImage.classList.add('is-changing');

    setTimeout(function () {
      mainImage.src = src;
      mainImage.alt = alt || '';
      mainImage.classList.remove('is-changing');
    }, 120);
  }

  if (mainImage && thumbs.length) {
    thumbs.forEach(function (thumb) {
      thumb.addEventListener('click', function () {
        const large = thumb.getAttribute('data-large');
        const alt = thumb.getAttribute('data-alt') || '';

        if (!large) return;

        updateMainImage(large, alt);

        thumbs.forEach(function (item) {
          item.classList.remove('is-active');
        });

        thumb.classList.add('is-active');
      });
    });
  }

  const variationSelects = document.querySelectorAll('.variations select');

  variationSelects.forEach(function (select) {
    if (select.dataset.zcButtonsReady === 'true') return;

    const wrapper = document.createElement('div');
    wrapper.className = 'zc-variation-buttons';

    const labelText = select.closest('tr')?.querySelector('label')?.textContent || '';
    const isColor = labelText.toLowerCase().includes('color') || select.name.toLowerCase().includes('color');

    Array.from(select.options).forEach(function (option) {
      if (!option.value) return;

      const button = document.createElement('button');
      button.type = 'button';
      button.className = isColor ? 'zc-variation-btn zc-variation-btn--color' : 'zc-variation-btn';
      button.dataset.value = option.value;

      if (isColor) {
        const dot = document.createElement('span');
        dot.className = 'zc-color-swatch';
        dot.style.background = getColorValue(option.textContent);
        button.appendChild(dot);
        button.setAttribute('aria-label', option.textContent);
      } else {
        button.textContent = option.textContent;
      }

      button.addEventListener('click', function () {
        select.value = option.value;
        select.dispatchEvent(new Event('change', { bubbles: true }));

        wrapper.querySelectorAll('.zc-variation-btn').forEach(function (btn) {
          btn.classList.remove('is-active');
        });

        button.classList.add('is-active');

        if (isColor) {
          updateImageFromSelectedColor(select.name, option.value);
        }
      });

      wrapper.appendChild(button);
    });

    select.insertAdjacentElement('afterend', wrapper);
    select.style.display = 'none';
    select.dataset.zcButtonsReady = 'true';

    function syncActiveButton() {
      const currentValue = select.value;

      wrapper.querySelectorAll('.zc-variation-btn').forEach(function (button) {
        button.classList.toggle('is-active', button.dataset.value === currentValue);
      });
    }

    select.addEventListener('change', syncActiveButton);
    syncActiveButton();
  });

  /**
   * WooCommerce normally changes the image after a complete variation is selected.
   * This changes the image earlier when color is selected, if variation data exists.
   */
  function updateImageFromSelectedColor(attributeName, attributeValue) {
    if (!window.jQuery || !mainImage) return;

    jQuery(function ($) {
      const form = $('.variations_form');

      if (!form.length) return;

      const variations = form.data('product_variations');

      if (!Array.isArray(variations)) return;

      const matchedVariation = variations.find(function (variation) {
        if (!variation || !variation.attributes) return false;

        return variation.attributes[attributeName] === attributeValue;
      });

      if (
        matchedVariation &&
        matchedVariation.image &&
        matchedVariation.image.full_src
      ) {
        updateMainImage(
          matchedVariation.image.full_src,
          matchedVariation.image.alt || ''
        );
      }
    });
  }

  /**
   * When WooCommerce finds the final selected variation,
   * use the official variation image.
   */
  if (window.jQuery) {
    jQuery(function ($) {
      const defaultImage = '<?php echo esc_url($main_image_url); ?>';
      const defaultAlt = '<?php echo esc_js($main_image_alt ?: $product->get_name()); ?>';

      $('.variations_form').on('found_variation', function (event, variation) {
        if (!variation || !variation.image || !variation.image.full_src) return;

        updateMainImage(
          variation.image.full_src,
          variation.image.alt || ''
        );
      });

      $('.variations_form').on('reset_data', function () {
        updateMainImage(defaultImage, defaultAlt);
      });
    });
  }

  function getColorValue(colorName) {
    const key = colorName.toLowerCase().trim();

    const map = {
      black: '#111111',
      white: '#ffffff',
      red: '#c92828',
      blue: '#4f7fa8',
      navy: '#111d35',
      gray: '#b8b8b8',
      grey: '#b8b8b8',
      beige: '#d6c0a2',
      brown: '#8b5a35',
      orange: '#ff5b1a',
      mustard: '#d69b22',
      pink: '#f3a9c4',
      green: '#5f8f60',
      purple: '#7d5ba6',
      yellow: '#f2c94c'
    };

    return map[key] || '#d9d9d9';
  }
});
</script>

<style>
.zc-single-product-page {
  background: #ffffff;
}

.zc-product-section {
  padding: 24px 0 80px;
}

.zc-product-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-product-breadcrumb {
  margin-bottom: 18px;
}

.zc-product-breadcrumb .woocommerce-breadcrumb {
  margin: 0;
  color: #777777;
  font-size: 12px;
  font-weight: 600;
}

.zc-product-breadcrumb .woocommerce-breadcrumb a {
  color: #777777;
  text-decoration: none;
}

.zc-product-breadcrumb .woocommerce-breadcrumb a:hover {
  color: #ff5b1a;
}

.zc-product-breadcrumb .woocommerce-breadcrumb span {
  margin: 0 7px;
  color: #aaaaaa;
}

.zc-product-layout {
  display: grid;
  grid-template-columns: 52% 48%;
  gap: 54px;
  align-items: start;
}

/* Gallery */
.zc-product-gallery {
  display: grid;
  grid-template-columns: 88px 1fr;
  gap: 18px;
  align-items: start;
}

.zc-product-thumbs {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.zc-product-thumb {
  width: 88px;
  height: 108px;
  padding: 6px;
  border-radius: 10px;
  border: 2px solid transparent;
  background: #f7f7f7;
  cursor: pointer;
  transition: 0.2s ease;
}

.zc-product-thumb.is-active {
  border-color: #ff5b1a;
}

.zc-product-thumb img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
}

.zc-product-main-image-wrap {
  position: relative;
  min-height: 620px;
  border-radius: 14px;
  background: linear-gradient(135deg, #faf7f2 0%, #f7f7f7 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.zc-product-main-image {
  width: 92%;
  max-height: 580px;
  object-fit: contain;
  display: block;
  transition: opacity 0.2s ease, transform 0.2s ease;
}

.zc-product-main-image.is-changing {
  opacity: 0;
  transform: scale(0.98);
}

.zc-product-wishlist,
.zc-product-zoom {
  position: absolute;
  z-index: 3;
  width: 38px;
  height: 38px;
  padding: 0;
  border: 0;
  border-radius: 50%;
  background: #ffffff;
  color: #111111;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
  transition: 0.2s ease;
}

.zc-product-wishlist {
  top: 18px;
  right: 18px;
}

.zc-product-zoom {
  right: 18px;
  bottom: 18px;
}

.zc-product-wishlist:hover,
.zc-product-zoom:hover {
  background: #ff5b1a;
  color: #ffffff;
}

.zc-product-wishlist svg,
.zc-product-zoom svg {
  width: 19px;
  height: 19px;
  fill: none;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

/* Summary */
.zc-product-summary {
  padding-top: 6px;
}

.zc-product-title {
  margin: 0 0 12px;
  color: #111111;
  font-size: clamp(36px, 4vw, 58px);
  line-height: 0.92;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -1.5px;
}

.zc-product-rating-row {
  display: flex;
  align-items: center;
  gap: 9px;
  margin-bottom: 8px;
}

.zc-product-stars .star-rating {
  float: none;
  margin: 0;
  font-size: 13px;
  width: 5.4em;
  color: #ffb000;
}

.zc-empty-stars {
  color: #ffb000;
  font-size: 13px;
  letter-spacing: 1px;
}

.zc-product-review-link {
  color: #555555;
  font-size: 13px;
  font-weight: 700;
  text-decoration: none;
}

.zc-product-review-link:hover {
  color: #ff5b1a;
}

.zc-product-price {
  margin-bottom: 12px;
  color: #ff5b1a;
  font-size: 26px;
  line-height: 1;
  font-weight: 950;
}

.zc-product-price del {
  color: #999999;
  font-size: 17px;
  font-weight: 700;
  margin-right: 8px;
}

.zc-product-price ins {
  text-decoration: none;
}

.zc-product-short-desc {
  max-width: 590px;
  margin-bottom: 18px;
}

.zc-product-short-desc p {
  margin: 0;
  color: #333333;
  font-size: 15px;
  line-height: 1.5;
  font-weight: 600;
}

.zc-product-benefits {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 12px;
  margin: 20px 0 24px;
}

.zc-product-benefit {
  min-height: 76px;
  padding: 12px 10px;
  border-radius: 12px;
  background: #fafafa;
  border: 1px solid #eeeeee;
  text-align: center;
}

.zc-product-benefit svg {
  width: 23px;
  height: 23px;
  margin-bottom: 7px;
  fill: none;
  stroke: #111111;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-product-benefit span {
  display: block;
  color: #111111;
  font-size: 11px;
  line-height: 1.2;
  font-weight: 850;
}

/* Woo Form */
.zc-product-form-area {
  margin-top: 18px;
}

.zc-product-form-area form.cart {
  margin: 0;
}

.zc-product-form-area table.variations {
  width: 100%;
  margin: 0 0 18px;
  border: 0;
}

.zc-product-form-area table.variations tr {
  display: block;
  margin-bottom: 16px;
}

.zc-product-form-area table.variations th,
.zc-product-form-area table.variations td {
  display: block;
  padding: 0;
  border: 0;
  background: transparent;
  text-align: left;
}

.zc-product-form-area table.variations label {
  display: inline-flex;
  margin-bottom: 9px;
  color: #111111;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-product-form-area .reset_variations {
  display: inline-block;
  margin-top: 8px;
  color: #777777;
  font-size: 12px;
  font-weight: 700;
}

.zc-variation-buttons {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 9px;
}

.zc-variation-btn {
  min-width: 46px;
  height: 36px;
  padding: 0 15px;
  border: 1px solid #dddddd;
  border-radius: 8px;
  background: #ffffff;
  color: #111111;
  font-size: 12px;
  font-weight: 850;
  cursor: pointer;
  transition: 0.2s ease;
}

.zc-variation-btn:hover,
.zc-variation-btn.is-active {
  border-color: #ff5b1a;
  color: #ff5b1a;
  background: #fff4ed;
}

.zc-variation-btn--color {
  width: 34px;
  min-width: 34px;
  height: 34px;
  padding: 0;
  border-radius: 50%;
  background: #ffffff;
}

.zc-color-swatch {
  width: 22px;
  height: 22px;
  display: block;
  border-radius: 50%;
  border: 1px solid #dddddd;
  margin: 0 auto;
}

.zc-variation-btn--color.is-active {
  box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #111111;
  border-color: transparent;
  background: #ffffff;
}

.zc-product-form-area .single_variation_wrap {
  margin-top: 8px;
}

.zc-product-form-area .woocommerce-variation {
  margin-bottom: 12px;
}

.zc-product-form-area .woocommerce-variation-price {
  color: #ff5b1a;
  font-size: 18px;
  font-weight: 950;
}

.zc-product-form-area .woocommerce-variation-add-to-cart,
.zc-product-form-area form.cart:not(.variations_form) {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.zc-product-form-area .quantity {
  display: inline-flex;
  align-items: center;
  height: 44px;
  border: 1px solid #dddddd;
  border-radius: 8px;
  overflow: hidden;
  background: #ffffff;
}

.zc-product-form-area .quantity input.qty {
  width: 72px;
  height: 44px;
  border: 0;
  outline: 0;
  text-align: center;
  color: #111111;
  font-size: 14px;
  font-weight: 850;
}

.zc-product-form-area .single_add_to_cart_button {
  min-height: 48px;
  padding: 0 28px !important;
  border-radius: 8px !important;
  background: #ff5b1a !important;
  color: #ffffff !important;
  border: 0 !important;
  font-size: 12px !important;
  font-weight: 950 !important;
  text-transform: uppercase;
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: 0.2s ease;
}

.zc-product-form-area .single_add_to_cart_button:hover {
  background: #111111 !important;
}

.zc-shop-blank-btn {
  min-height: 48px;
  margin-top: 12px;
  padding: 0 28px;
  border-radius: 8px;
  background: #111111;
  color: #ffffff;
  text-decoration: none;
  font-size: 12px;
  font-weight: 950;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s ease;
}

.zc-shop-blank-btn:hover {
  background: #ff5b1a;
  color: #ffffff;
}

.zc-product-trust-row {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 18px;
  margin-top: 22px;
  color: #555555;
  font-size: 12px;
  font-weight: 750;
}

.zc-product-trust-row span {
  position: relative;
  padding-left: 18px;
}

.zc-product-trust-row span::before {
  content: "✓";
  position: absolute;
  left: 0;
  top: 0;
  color: #111111;
  font-weight: 950;
}

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-product-layout {
    grid-template-columns: 1fr;
    gap: 38px;
  }

  .zc-product-main-image-wrap {
    min-height: 560px;
  }

  .zc-product-benefits {
    grid-template-columns: repeat(4, minmax(0, 1fr));
  }
}

/* 768 */
@media screen and (max-width: 768px) {
  .zc-product-section {
    padding: 18px 0 60px;
  }

  .zc-product-container {
    width: min(100% - 30px, 1280px);
  }

  .zc-product-gallery {
    grid-template-columns: 1fr;
  }

  .zc-product-thumbs {
    order: 2;
    flex-direction: row;
    overflow-x: auto;
    padding-bottom: 6px;
  }

  .zc-product-thumb {
    min-width: 78px;
    width: 78px;
    height: 92px;
  }

  .zc-product-main-image-wrap {
    min-height: 430px;
  }

  .zc-product-title {
    font-size: 38px;
  }

  .zc-product-benefits {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .zc-product-form-area .woocommerce-variation-add-to-cart,
  .zc-product-form-area form.cart:not(.variations_form) {
    align-items: stretch;
  }

  .zc-product-form-area .single_add_to_cart_button,
  .zc-shop-blank-btn {
    width: 100%;
  }
}

/* 480 */
@media screen and (max-width: 480px) {
  .zc-product-main-image-wrap {
    min-height: 360px;
  }

  .zc-product-title {
    font-size: 32px;
  }

  .zc-product-benefits {
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }

  .zc-product-benefit {
    min-height: 70px;
  }

  .zc-product-trust-row {
    flex-direction: column;
    align-items: flex-start;
    gap: 9px;
  }
}
</style>

<?php
get_footer();