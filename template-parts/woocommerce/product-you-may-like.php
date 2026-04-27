<?php
defined('ABSPATH') || exit;

global $product;

if (!is_a($product, 'WC_Product')) {
  $product = wc_get_product(get_the_ID());
}

/**
 * Show up to 5 real WooCommerce products.
 * Since you only have 2 products right now, it will show 2 cards only.
 * No duplicate clone bullshit.
 */
$you_may_like_products = wc_get_products([
  'limit'   => 5,
  'status'  => 'publish',
  'orderby' => 'date',
  'order'   => 'DESC',
]);

$clean_products = [];

foreach ($you_may_like_products as $item_product) {
  if (!$item_product || !$item_product->is_visible()) {
    continue;
  }

  $clean_products[$item_product->get_id()] = $item_product;
}

$you_may_like_products = array_values($clean_products);

if (empty($you_may_like_products)) {
  return;
}
?>

<section class="zc-you-may-like-section">
  <div class="zc-you-may-like-container">

    <div class="zc-you-may-like-head">
      <h2>YOU MAY ALSO LIKE</h2>

      <div class="zc-you-may-like-arrows">
        <button class="zc-you-may-like-btn zc-you-may-like-btn--prev" type="button" aria-label="Previous product">
          ‹
        </button>

        <button class="zc-you-may-like-btn zc-you-may-like-btn--next" type="button" aria-label="Next product">
          ›
        </button>
      </div>
    </div>

    <div class="zc-you-may-like-carousel" data-zc-you-may-like-carousel>
      <div class="zc-you-may-like-viewport">
        <div class="zc-you-may-like-track">

          <?php foreach ($you_may_like_products as $item_product) : ?>
            <?php
            $item_product_id = $item_product->get_id();
            $product_link    = get_permalink($item_product_id);
            ?>

            <div class="zc-you-may-like-slide">
              <article class="zc-you-may-like-card">

                <a href="<?php echo esc_url($product_link); ?>" class="zc-you-may-like-image-wrap">
                  <?php
                  echo $item_product->get_image('woocommerce_thumbnail', [
                    'class' => 'zc-you-may-like-image',
                    'alt'   => esc_attr($item_product->get_name()),
                  ]);
                  ?>
                </a>

                <div class="zc-you-may-like-info">
                  <h3 class="zc-you-may-like-name">
                    <a href="<?php echo esc_url($product_link); ?>">
                      <?php echo esc_html($item_product->get_name()); ?>
                    </a>
                  </h3>

                  <div class="zc-you-may-like-price">
                    <?php echo wp_kses_post($item_product->get_price_html()); ?>
                  </div>

                  <a href="<?php echo esc_url($product_link); ?>" class="zc-you-may-like-view">
                    VIEW PRODUCT
                  </a>
                </div>

              </article>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const carousel = document.querySelector('[data-zc-you-may-like-carousel]');
  if (!carousel) return;

  const section = carousel.closest('.zc-you-may-like-section');
  const viewport = carousel.querySelector('.zc-you-may-like-viewport');
  const track = carousel.querySelector('.zc-you-may-like-track');
  const prevBtn = section ? section.querySelector('.zc-you-may-like-btn--prev') : null;
  const nextBtn = section ? section.querySelector('.zc-you-may-like-btn--next') : null;
  const arrows = section ? section.querySelector('.zc-you-may-like-arrows') : null;

  if (!viewport || !track || !prevBtn || !nextBtn) return;

  const originalSlides = Array.from(track.children);
  const originalCount = originalSlides.length;

  if (!originalCount) return;

  let slides = Array.from(track.children);
  let currentIndex = 0;
  let slideWidth = 0;
  let gap = 16;
  let perView = 5;
  let autoplay = null;
  let isMoving = false;
  let isInfinite = false;

  function getPerView() {
    const width = window.innerWidth;

    if (width <= 480) return 1;
    if (width <= 768) return 2;
    if (width <= 1024) return 3;

    return 5;
  }

  function clearClones() {
    track.querySelectorAll('.is-clone').forEach(function (clone) {
      clone.remove();
    });

    slides = Array.from(track.children);
  }

  function buildClones() {
    clearClones();

    originalSlides.forEach(function (slide) {
      const clone = slide.cloneNode(true);
      clone.classList.add('is-clone');
      track.appendChild(clone);
    });

    originalSlides.slice().reverse().forEach(function (slide) {
      const clone = slide.cloneNode(true);
      clone.classList.add('is-clone');
      track.insertBefore(clone, track.firstChild);
    });

    slides = Array.from(track.children);
    currentIndex = originalCount;
  }

  function setSizes() {
    perView = getPerView();
    gap = window.innerWidth <= 768 ? 14 : 16;

    /**
     * Only infinite carousel if product count is MORE than visible cards.
     * If you only have 2 products, no cloning. No duplicate cards.
     */
    isInfinite = originalCount > perView;

    if (isInfinite) {
      if (!track.querySelector('.is-clone')) {
        buildClones();
      }

      if (arrows) {
        arrows.style.display = 'flex';
      }
    } else {
      clearClones();
      currentIndex = 0;

      if (arrows) {
        arrows.style.display = 'none';
      }
    }

    slides = Array.from(track.children);

    const viewportWidth = viewport.clientWidth;

    /**
     * Important:
     * Keep 5-column sizing on desktop even if there are only 2 products.
     * This prevents one product from stretching like a bedsheet.
     */
    slideWidth = (viewportWidth - gap * (perView - 1)) / perView;

    slides.forEach(function (slide) {
      slide.style.flex = '0 0 ' + slideWidth + 'px';
    });

    track.style.gap = gap + 'px';
    moveToIndex(currentIndex, false);

    if (isInfinite) {
      startAutoplay();
    } else {
      stopAutoplay();
    }
  }

  function moveToIndex(index, animate = true) {
    const offset = index * (slideWidth + gap);

    track.style.transition = animate ? 'transform 0.45s ease' : 'none';
    track.style.transform = 'translateX(-' + offset + 'px)';
  }

  function goNext() {
    if (!isInfinite || isMoving) return;

    isMoving = true;
    currentIndex++;
    moveToIndex(currentIndex, true);
  }

  function goPrev() {
    if (!isInfinite || isMoving) return;

    isMoving = true;
    currentIndex--;
    moveToIndex(currentIndex, true);
  }

  track.addEventListener('transitionend', function () {
    if (!isInfinite) return;

    isMoving = false;

    if (currentIndex >= originalCount * 2) {
      currentIndex = originalCount;
      moveToIndex(currentIndex, false);
    }

    if (currentIndex < originalCount) {
      currentIndex = originalCount * 2 - 1;
      moveToIndex(currentIndex, false);
    }
  });

  function startAutoplay() {
    stopAutoplay();

    if (!isInfinite) return;

    autoplay = setInterval(function () {
      goNext();
    }, 3200);
  }

  function stopAutoplay() {
    if (autoplay) {
      clearInterval(autoplay);
      autoplay = null;
    }
  }

  nextBtn.addEventListener('click', function () {
    goNext();
    startAutoplay();
  });

  prevBtn.addEventListener('click', function () {
    goPrev();
    startAutoplay();
  });

  carousel.addEventListener('mouseenter', stopAutoplay);
  carousel.addEventListener('mouseleave', startAutoplay);

  window.addEventListener('resize', function () {
    setSizes();
  });

  setSizes();
});
</script>

<style>
.zc-you-may-like-section {
  padding: 20px 0 80px;
  background: #ffffff;
  overflow: hidden;
}

.zc-you-may-like-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  padding: 24px;
  border-radius: 14px;
  background: #fbf7f3;
  border: 1px solid #eeeeee;
}

.zc-you-may-like-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 18px;
  margin-bottom: 18px;
}

.zc-you-may-like-head h2 {
  margin: 0;
  color: #111111;
  font-size: 20px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -0.3px;
}

.zc-you-may-like-arrows {
  display: flex;
  align-items: center;
  gap: 8px;
}

.zc-you-may-like-btn {
  width: 26px;
  height: 26px;
  padding: 0;
  border: 1px solid #e2e2e2;
  border-radius: 50%;
  background: #ffffff;
  color: #111111;
  font-size: 0;
  line-height: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: 0.2s ease;
}

.zc-you-may-like-btn:hover {
  background: #ff5b1a;
  border-color: #ff5b1a;
  color: #ffffff;
}

.zc-you-may-like-btn::before {
  content: "";
  width: 7px;
  height: 7px;
  display: block;
  border-top: 2px solid currentColor;
  border-right: 2px solid currentColor;
}

.zc-you-may-like-btn--prev::before {
  transform: rotate(-135deg);
  margin-left: 2px;
}

.zc-you-may-like-btn--next::before {
  transform: rotate(45deg);
  margin-right: 2px;
}

.zc-you-may-like-carousel {
  position: relative;
}

.zc-you-may-like-viewport {
  width: 100%;
  overflow: hidden;
}

.zc-you-may-like-track {
  display: flex;
  align-items: stretch;
  justify-content: flex-start;
  will-change: transform;
}

.zc-you-may-like-slide {
  min-width: 0;
}

.zc-you-may-like-card {
  height: 100%;
  min-height: 245px;
  border-radius: 12px;
  background: #ffffff;
  border: 1px solid #eeeeee;
  overflow: hidden;
  transition: 0.25s ease;
}

.zc-you-may-like-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
}

.zc-you-may-like-image-wrap {
  height: 150px;
  padding: 14px;
  background: #f7f7f7;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
}

.zc-you-may-like-image,
.zc-you-may-like-image-wrap img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
  transition: 0.25s ease;
}

.zc-you-may-like-card:hover .zc-you-may-like-image,
.zc-you-may-like-card:hover .zc-you-may-like-image-wrap img {
  transform: scale(1.04);
}

.zc-you-may-like-info {
  padding: 12px 12px 14px;
}

.zc-you-may-like-name {
  margin: 0 0 7px;
  font-size: 13px;
  line-height: 1.25;
  font-weight: 950;
}

.zc-you-may-like-name a {
  color: #111111;
  text-decoration: none;
}

.zc-you-may-like-name a:hover {
  color: #ff5b1a;
}

.zc-you-may-like-price {
  margin-bottom: 12px;
  color: #ff5b1a;
  font-size: 13px;
  line-height: 1;
  font-weight: 950;
}

.zc-you-may-like-price del {
  color: #999999;
  font-size: 11px;
  font-weight: 700;
  margin-right: 5px;
}

.zc-you-may-like-price ins {
  text-decoration: none;
}

.zc-you-may-like-view {
  min-height: 34px;
  padding: 0 13px;
  border-radius: 5px;
  background: #111111;
  color: #ffffff;
  text-decoration: none;
  font-size: 10px;
  font-weight: 950;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s ease;
}

.zc-you-may-like-view:hover {
  background: #ff5b1a;
  color: #ffffff;
}

@media screen and (max-width: 1024px) {
  .zc-you-may-like-card {
    min-height: 240px;
  }

  .zc-you-may-like-image-wrap {
    height: 145px;
  }
}

@media screen and (max-width: 768px) {
  .zc-you-may-like-section {
    padding: 10px 0 60px;
  }

  .zc-you-may-like-container {
    width: min(100% - 30px, 1280px);
    padding: 20px 16px;
  }

  .zc-you-may-like-head h2 {
    font-size: 18px;
  }

  .zc-you-may-like-image-wrap {
    height: 140px;
  }
}

@media screen and (max-width: 480px) {
  .zc-you-may-like-head {
    align-items: flex-start;
  }

  .zc-you-may-like-card {
    min-height: 250px;
  }

  .zc-you-may-like-image-wrap {
    height: 155px;
  }

  .zc-you-may-like-view {
    width: 100%;
  }
}
</style>