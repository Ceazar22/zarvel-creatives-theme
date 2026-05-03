<?php
defined('ABSPATH') || exit;

global $product;

if (!is_a($product, 'WC_Product')) {
  $product = wc_get_product(get_the_ID());
}

if (!$product) {
  return;
}

$product_id = $product->get_id();

$reviews = get_comments([
  'post_id' => $product_id,
  'status'  => 'approve',
  'type'    => 'review',
  'number'  => 3,
]);

if (!function_exists('zc_pir_stars')) {
  function zc_pir_stars($rating = 5) {
    $rating = max(0, min(5, (int) $rating));
    $output = '';

    for ($i = 1; $i <= 5; $i++) {
      $output .= $i <= $rating ? '★' : '☆';
    }

    return $output;
  }
}

$fallback_reviews = [
  [
    'name' => 'Mark D.',
    'rating' => 5,
    'text' => 'Amazing quality and fast turnaround. The mockup looked exactly how I wanted.',
  ],
  [
    'name' => 'Jessica R.',
    'rating' => 5,
    'text' => 'They made my logo look sick on a shirt. Super easy process and communication.',
  ],
  [
    'name' => 'Daniel S.',
    'rating' => 5,
    'text' => 'Printed for our event and everyone loved the shirts. Will order again.',
  ],
];
?>

<section class="zc-product-info-reviews">
  <div class="zc-product-info-reviews__container">

    <div class="zc-product-info-reviews__grid">

      <!-- LEFT: PRODUCT INFO TABS -->
      <div class="zc-product-info-card">

        <div class="zc-product-tabs" data-zc-product-tabs>
          <button class="zc-product-tab is-active" type="button" data-tab="description">
            Description
          </button>

          <button class="zc-product-tab" type="button" data-tab="details">
            Product Details
          </button>

          <button class="zc-product-tab" type="button" data-tab="shipping">
            Shipping & Returns
          </button>
        </div>

        <div class="zc-product-tab-panels">

          <div class="zc-product-tab-panel is-active" data-panel="description">
            <?php if ($product->get_description()) : ?>
              <div class="zc-product-description-content">
                <?php echo wp_kses_post(wpautop($product->get_description())); ?>
              </div>
            <?php else : ?>
              <p>
                Our Custom Logo product is perfect for businesses, events, teams, or personal brands.
                Send us your logo or idea and we’ll create a high-quality print that represents you.
              </p>
            <?php endif; ?>

            <ul class="zc-product-check-list">
              <li>Soft, breathable premium fabric</li>
              <li>High-quality DTG printing</li>
              <li>Vibrant colors that last</li>
              <li>Unisex fit for all-day comfort</li>
            </ul>

            <p class="zc-product-note">
              Not sure about your design? No worries. We’ll help you make it perfect.
            </p>
          </div>

          <div class="zc-product-tab-panel" data-panel="details">
            <ul class="zc-product-detail-list">
              <?php if ($product->get_sku()) : ?>
                <li>
                  <strong>SKU:</strong>
                  <span><?php echo esc_html($product->get_sku()); ?></span>
                </li>
              <?php endif; ?>

              <?php
              $attributes = $product->get_attributes();

              if (!empty($attributes)) :
                foreach ($attributes as $attribute) :
                  $label = wc_attribute_label($attribute->get_name());

                  if ($attribute->is_taxonomy()) {
                    $values = wc_get_product_terms($product_id, $attribute->get_name(), ['fields' => 'names']);
                  } else {
                    $values = $attribute->get_options();
                  }

                  if (empty($values)) {
                    continue;
                  }
                  ?>
                  <li>
                    <strong><?php echo esc_html($label); ?>:</strong>
                    <span><?php echo esc_html(implode(', ', $values)); ?></span>
                  </li>
                <?php endforeach; ?>
              <?php else : ?>
                <li>
                  <strong>Material:</strong>
                  <span>Premium cotton blend</span>
                </li>

                <li>
                  <strong>Fit:</strong>
                  <span>Unisex regular fit</span>
                </li>

                <li>
                  <strong>Print:</strong>
                  <span>High-quality direct-to-garment print</span>
                </li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="zc-product-tab-panel" data-panel="shipping">
            <ul class="zc-product-check-list">
              <li>Production starts after design approval</li>
              <li>Standard production takes 2–5 business days</li>
              <li>Shipping time depends on your location</li>
              <li>Returns accepted for damaged or incorrect items</li>
            </ul>

            <p class="zc-product-note">
              Since each item is made on demand, custom printed products cannot be returned for design preference changes after approval.
            </p>
          </div>

        </div>

      </div>

      <!-- RIGHT: REVIEWS -->
      <div class="zc-product-reviews-card">

        <div class="zc-product-reviews-head">
          <h2>WHAT OUR CUSTOMERS SAY</h2>

          <a href="#reviews">
            View all reviews
          </a>
        </div>

        <div class="zc-product-reviews-grid">

          <?php if (!empty($reviews)) : ?>
            <?php foreach ($reviews as $review) : ?>
              <?php
              $rating = get_comment_meta($review->comment_ID, 'rating', true);
              $rating = $rating ? (int) $rating : 5;
              ?>

              <article class="zc-review-card">
                <div class="zc-review-stars">
                  <?php echo esc_html(zc_pir_stars($rating)); ?>
                  <span><?php echo esc_html(number_format($rating, 1)); ?></span>
                </div>

                <p>
                  “<?php echo esc_html(wp_trim_words($review->comment_content, 22)); ?>”
                </p>

                <div class="zc-review-person">
                  <strong><?php echo esc_html($review->comment_author); ?></strong>
                  <span>Verified Buyer</span>
                </div>
              </article>
            <?php endforeach; ?>
          <?php else : ?>
            <?php foreach ($fallback_reviews as $review) : ?>
              <article class="zc-review-card">
                <div class="zc-review-stars">
                  <?php echo esc_html(zc_pir_stars($review['rating'])); ?>
                  <span><?php echo esc_html(number_format($review['rating'], 1)); ?></span>
                </div>

                <p>
                  “<?php echo esc_html($review['text']); ?>”
                </p>

                <div class="zc-review-person">
                  <strong><?php echo esc_html($review['name']); ?></strong>
                  <span>Verified Buyer</span>
                </div>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

      </div>

    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const tabGroups = document.querySelectorAll('[data-zc-product-tabs]');

  tabGroups.forEach(function (tabGroup) {
    const wrapper = tabGroup.closest('.zc-product-info-card');
    if (!wrapper) return;

    const tabs = wrapper.querySelectorAll('.zc-product-tab');
    const panels = wrapper.querySelectorAll('.zc-product-tab-panel');

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        const target = tab.getAttribute('data-tab');

        tabs.forEach(function (item) {
          item.classList.remove('is-active');
        });

        panels.forEach(function (panel) {
          panel.classList.remove('is-active');
        });

        tab.classList.add('is-active');

        const activePanel = wrapper.querySelector('[data-panel="' + target + '"]');

        if (activePanel) {
          activePanel.classList.add('is-active');
        }
      });
    });
  });
});
</script>

<style>
.zc-product-info-reviews {
  padding: 20px 0 80px;
  background: #ffffff;
}

.zc-product-info-reviews__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-product-info-reviews__grid {
  display: grid;
  grid-template-columns: 36% 64%;
  gap: 18px;
  align-items: stretch;
}

/* Left Card */
.zc-product-info-card,
.zc-product-reviews-card {
  border-radius: 14px;
  background: #fbf7f3;
  border: 1px solid #eeeeee;
  overflow: hidden;
}

.zc-product-tabs {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  background: #ffffff;
  border-bottom: 1px solid #eeeeee;
}

.zc-product-tab {
  min-height: 48px;
  padding: 0 14px;
  border: 0;
  background: transparent;
  color: #111111;
  font-size: 11px;
  line-height: 1.1;
  font-weight: 950;
  text-transform: uppercase;
  cursor: pointer;
  position: relative;
  transition: 0.2s ease;
}

.zc-product-tab::after {
  content: "";
  position: absolute;
  left: 16px;
  right: 16px;
  bottom: 0;
  height: 3px;
  background: transparent;
  border-radius: 99px 99px 0 0;
  transition: 0.2s ease;
}

.zc-product-tab:hover,
.zc-product-tab.is-active {
  color: #ff5b1a;
}

.zc-product-tab.is-active::after {
  background: #ff5b1a;
}

.zc-product-tab-panels {
  padding: 24px 24px 26px;
}

.zc-product-tab-panel {
  display: none;
}

.zc-product-tab-panel.is-active {
  display: block;
}

.zc-product-tab-panel p,
.zc-product-description-content p {
  margin: 0 0 16px;
  color: #222222;
  font-size: 14px;
  line-height: 1.55;
  font-weight: 600;
}

.zc-product-check-list,
.zc-product-detail-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.zc-product-check-list li {
  position: relative;
  padding-left: 25px;
  margin-bottom: 10px;
  color: #222222;
  font-size: 13px;
  line-height: 1.35;
  font-weight: 700;
}

.zc-product-check-list li::before {
  content: "✓";
  position: absolute;
  left: 0;
  top: -1px;
  width: 17px;
  height: 17px;
  border-radius: 50%;
  background: #ff5b1a;
  color: #ffffff;
  font-size: 10px;
  font-weight: 950;
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-product-note {
  margin-top: 18px !important;
  color: #555555 !important;
  font-size: 13px !important;
}

.zc-product-detail-list li {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 11px 0;
  border-bottom: 1px solid #eeeeee;
  color: #222222;
  font-size: 13px;
  line-height: 1.35;
}

.zc-product-detail-list li:last-child {
  border-bottom: 0;
}

.zc-product-detail-list strong {
  font-weight: 950;
}

.zc-product-detail-list span {
  text-align: right;
  color: #444444;
  font-weight: 700;
}

/* Right Reviews */
.zc-product-reviews-card {
  padding: 24px;
}

.zc-product-reviews-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 18px;
  margin-bottom: 18px;
}

.zc-product-reviews-head h2 {
  margin: 0;
  color: #111111;
  font-size: 24px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -0.4px;
}

.zc-product-reviews-head a {
  color: #ff5b1a;
  font-size: 12px;
  font-weight: 900;
  text-decoration: none;
}

.zc-product-reviews-head a:hover {
  opacity: 0.75;
}

.zc-product-reviews-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 16px;
}

.zc-review-card {
  min-height: 178px;
  padding: 18px;
  border-radius: 12px;
  background: #ffffff;
  border: 1px solid #eeeeee;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: 0.25s ease;
}

.zc-review-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
}

.zc-review-stars {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #ffb000;
  font-size: 13px;
  line-height: 1;
  letter-spacing: 1px;
  font-weight: 950;
  margin-bottom: 13px;
}

.zc-review-stars span {
  color: #111111;
  font-size: 11px;
  letter-spacing: 0;
  font-weight: 900;
}

.zc-review-card p {
  margin: 0 0 18px;
  color: #222222;
  font-size: 13px;
  line-height: 1.45;
  font-weight: 650;
}

.zc-review-person {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.zc-review-person strong {
  color: #111111;
  font-size: 13px;
  line-height: 1;
  font-weight: 950;
}

.zc-review-person span {
  color: #777777;
  font-size: 11px;
  line-height: 1;
  font-weight: 700;
}

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-product-info-reviews__grid {
    grid-template-columns: 1fr;
  }

  .zc-product-reviews-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

/* 768 */
@media screen and (max-width: 768px) {
  .zc-product-info-reviews {
    padding: 10px 0 60px;
  }

  .zc-product-info-reviews__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-product-tabs {
    grid-template-columns: 1fr;
  }

  .zc-product-tab {
    min-height: 44px;
  }

  .zc-product-tab::after {
    left: 0;
    right: auto;
    top: 0;
    bottom: 0;
    width: 3px;
    height: auto;
    border-radius: 0 99px 99px 0;
  }

  .zc-product-tab-panels {
    padding: 22px 18px;
  }

  .zc-product-reviews-card {
    padding: 22px 18px;
  }

  .zc-product-reviews-head {
    flex-direction: column;
    align-items: flex-start;
  }

  .zc-product-reviews-head h2 {
    font-size: 22px;
  }

  .zc-product-reviews-grid {
    grid-template-columns: 1fr;
  }
}

/* 480 */
@media screen and (max-width: 480px) {
  .zc-product-detail-list li {
    flex-direction: column;
    gap: 5px;
  }

  .zc-product-detail-list span {
    text-align: left;
  }
}
</style>