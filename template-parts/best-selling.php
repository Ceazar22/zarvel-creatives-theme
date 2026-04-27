<?php
defined('ABSPATH') || exit;

$zc_shop_url = home_url('/shop/');

$zc_products = wc_get_products([
  'limit'   => -1,
  'status'  => 'publish',
  'orderby' => 'date',
  'order'   => 'DESC',
]);

if (empty($zc_products)) {
  return;
}
?>

<section class="zc-best-section">
  <div class="zc-best-container">

    <div class="zc-best-head">
      <h2 class="zc-best-title">BEST SELLING PRINTS</h2>

      <a href="<?php echo esc_url($zc_shop_url); ?>" class="zc-best-view-all">
        View all
      </a>
    </div>

    <div class="zc-best-carousel" data-zc-best-carousel>
      <button class="zc-best-carousel__btn zc-best-carousel__btn--prev" type="button" aria-label="Previous product">
        ‹
      </button>

      <div class="zc-best-carousel__viewport">
        <div class="zc-best-carousel__track">

          <?php foreach ($zc_products as $zc_product) : ?>
            <?php
            if (!$zc_product || !$zc_product->is_visible()) {
              continue;
            }

            $zc_product_id   = $zc_product->get_id();
            $zc_product_url  = get_permalink($zc_product_id);
            $zc_product_name = $zc_product->get_name();
            $zc_review_count = $zc_product->get_review_count();
            $zc_rating       = (float) $zc_product->get_average_rating();

            $zc_badge = '';
            $zc_badge_class = '';

            if ($zc_product->is_on_sale()) {
              $zc_badge = 'SALE';
            } elseif ($zc_product->is_featured()) {
              $zc_badge = 'BEST SELLER';
            } else {
              $published_date = get_post_time('U', true, $zc_product_id);
              $days_old = (time() - $published_date) / DAY_IN_SECONDS;

              if ($days_old <= 14) {
                $zc_badge = 'NEW';
                $zc_badge_class = ' zc-best-badge--new';
              }
            }

            if ($zc_badge === 'SALE') {
              $zc_badge_class = ' zc-best-badge--sale';
            }
            ?>

            <div class="zc-best-carousel__slide">
              <article class="zc-best-card">

                <a href="<?php echo esc_url($zc_product_url); ?>" class="zc-best-image-wrap">
                  <?php if (!empty($zc_badge)) : ?>
                    <span class="zc-best-badge<?php echo esc_attr($zc_badge_class); ?>">
                      <?php echo esc_html($zc_badge); ?>
                    </span>
                  <?php endif; ?>

                  <?php
                  echo $zc_product->get_image('woocommerce_thumbnail', [
                    'class' => 'zc-best-image',
                    'alt'   => esc_attr($zc_product_name),
                  ]);
                  ?>
                </a>

                <div class="zc-best-info">
                  <h3 class="zc-best-name">
                    <a href="<?php echo esc_url($zc_product_url); ?>">
                      <?php echo esc_html($zc_product_name); ?>
                    </a>
                  </h3>

                  <div class="zc-best-price-row">
                    <div class="zc-best-price-wrap">
                      <?php echo wp_kses_post($zc_product->get_price_html()); ?>
                    </div>

                    <a href="<?php echo esc_url($zc_product_url); ?>" class="zc-best-cart" aria-label="View product">
                      <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6h15l-2 9H8L6 6z"></path>
                        <path d="M6 6 5 2H2"></path>
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="18" cy="21" r="1"></circle>
                      </svg>
                    </a>
                  </div>

                  <div class="zc-best-rating">
                    <span class="zc-best-stars">
                      <?php
                      if ($zc_rating > 0) {
                        for ($i = 1; $i <= 5; $i++) {
                          echo $i <= round($zc_rating) ? '★' : '☆';
                        }
                      } else {
                        echo '★★★★★';
                      }
                      ?>
                    </span>

                    <span class="zc-best-review-count">
                      (<?php echo esc_html($zc_review_count); ?>)
                    </span>
                  </div>
                </div>

              </article>
            </div>
          <?php endforeach; ?>

        </div>
      </div>

      <button class="zc-best-carousel__btn zc-best-carousel__btn--next" type="button" aria-label="Next product">
        ›
      </button>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const carousel = document.querySelector('[data-zc-best-carousel]');
  if (!carousel) return;

  const viewport = carousel.querySelector('.zc-best-carousel__viewport');
  const track = carousel.querySelector('.zc-best-carousel__track');
  const prevBtn = carousel.querySelector('.zc-best-carousel__btn--prev');
  const nextBtn = carousel.querySelector('.zc-best-carousel__btn--next');

  if (!viewport || !track || !prevBtn || !nextBtn) return;

  const originalSlides = Array.from(track.children);
  const originalCount = originalSlides.length;

  if (!originalCount) return;

  let slides = Array.from(track.children);
  let currentIndex = 0;
  let slideWidth = 0;
  let gap = 18;
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
    gap = window.innerWidth <= 768 ? 16 : 18;

    isInfinite = originalCount > perView;

    if (isInfinite) {
      if (!track.querySelector('.is-clone')) {
        buildClones();
      }

      prevBtn.style.display = 'flex';
      nextBtn.style.display = 'flex';
    } else {
      clearClones();
      currentIndex = 0;

      prevBtn.style.display = 'none';
      nextBtn.style.display = 'none';
    }

    slides = Array.from(track.children);

    const viewportWidth = viewport.clientWidth;

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
    }, 2800);
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
.zc-best-section {
  padding: 20px 0 75px;
  background: #ffffff;
  overflow: hidden;
}

.zc-best-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-best-head {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 26px;
}

.zc-best-title {
  margin: 0;
  color: #111111;
  font-size: 34px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.5px;
}

.zc-best-view-all {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  color: #ff5b1a;
  font-size: 14px;
  font-weight: 900;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-best-view-all:hover {
  opacity: 0.75;
}

.zc-best-carousel {
  position: relative;
}

.zc-best-carousel__viewport {
  width: 100%;
  overflow: hidden;
}

.zc-best-carousel__track {
  display: flex;
  align-items: stretch;
  will-change: transform;
}

.zc-best-carousel__slide {
  min-width: 0;
}

.zc-best-card {
  position: relative;
  overflow: hidden;
  border-radius: 14px;
  background: #ffffff;
  transition: 0.25s ease;
  height: 100%;
}

.zc-best-card:hover {
  transform: translateY(-4px);
}

.zc-best-image-wrap {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 210px;
  padding: 16px;
  border-radius: 14px;
  background: #f7f7f7;
  text-decoration: none;
  overflow: hidden;
}

.zc-best-image,
.zc-best-image-wrap img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
  transition: 0.25s ease;
}

.zc-best-card:hover .zc-best-image,
.zc-best-card:hover .zc-best-image-wrap img {
  transform: scale(1.04);
}

.zc-best-badge {
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
  letter-spacing: 0.2px;
  padding: 7px 9px;
  border-radius: 6px;
}

.zc-best-badge--new {
  background: #111111;
}

.zc-best-badge--sale {
  background: #ff5b1a;
}

.zc-best-info {
  padding: 12px 2px 0;
}

.zc-best-name {
  margin: 0 0 7px;
  font-size: 14px;
  line-height: 1.25;
  font-weight: 900;
}

.zc-best-name a {
  color: #222222;
  text-decoration: none;
}

.zc-best-name a:hover {
  color: #ff5b1a;
}

.zc-best-price-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.zc-best-price-wrap {
  display: flex;
  align-items: center;
  gap: 7px;
  flex-wrap: wrap;
  color: #ff5b1a;
  font-size: 14px;
  line-height: 1;
  font-weight: 950;
}

.zc-best-price-wrap del {
  color: #999999;
  font-size: 12px;
  font-weight: 700;
  text-decoration: line-through;
}

.zc-best-price-wrap ins {
  color: #ff5b1a;
  text-decoration: none;
}

.zc-best-price {
  color: #ff5b1a;
  font-size: 14px;
  line-height: 1;
  font-weight: 950;
}

.zc-best-old-price {
  color: #999999;
  font-size: 12px;
  font-weight: 700;
  text-decoration: line-through;
}

.zc-best-cart {
  width: 34px;
  height: 34px;
  min-width: 34px;
  border-radius: 8px;
  background: #ff5b1a;
  color: #ffffff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-best-cart:hover {
  background: #111111;
}

.zc-best-cart svg {
  width: 18px;
  height: 18px;
  fill: none;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-best-rating {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-top: 7px;
}

.zc-best-stars {
  color: #ffb000;
  font-size: 12px;
  letter-spacing: 1px;
  line-height: 1;
}

.zc-best-review-count {
  color: #777777;
  font-size: 12px;
  font-weight: 700;
}

.zc-best-carousel__btn {
  position: absolute;
  top: 50%;
  z-index: 5;
  width: 38px;
  height: 38px;
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
  transform: translateY(-50%);
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
  transition: 0.2s ease;
}

.zc-best-carousel__btn:hover {
  background: #ff5b1a;
  border-color: #ff5b1a;
  color: #ffffff;
}

.zc-best-carousel__btn::before {
  content: "";
  width: 9px;
  height: 9px;
  display: block;
  border-top: 2px solid currentColor;
  border-right: 2px solid currentColor;
}

.zc-best-carousel__btn--prev {
  left: -19px;
}

.zc-best-carousel__btn--prev::before {
  transform: rotate(-135deg);
  margin-left: 3px;
}

.zc-best-carousel__btn--next {
  right: -19px;
}

.zc-best-carousel__btn--next::before {
  transform: rotate(45deg);
  margin-right: 3px;
}

@media screen and (max-width: 1024px) {
  .zc-best-image-wrap {
    height: 200px;
  }
}

@media screen and (max-width: 768px) {
  .zc-best-section {
    padding: 15px 0 55px;
  }

  .zc-best-container {
    width: min(100% - 30px, 1280px);
  }

  .zc-best-head {
    flex-direction: column;
    gap: 12px;
    margin-bottom: 22px;
  }

  .zc-best-view-all {
    position: static;
    transform: none;
  }

  .zc-best-title {
    font-size: 28px;
  }

  .zc-best-image-wrap {
    height: 180px;
  }

  .zc-best-carousel__btn {
    width: 34px;
    height: 34px;
  }

  .zc-best-carousel__btn::before {
    width: 8px;
    height: 8px;
  }

  .zc-best-carousel__btn--prev {
    left: -12px;
  }

  .zc-best-carousel__btn--next {
    right: -12px;
  }
}

@media screen and (max-width: 480px) {
  .zc-best-image-wrap {
    height: 210px;
  }
}
</style>