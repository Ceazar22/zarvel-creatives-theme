<?php
$zc_products = [
  [
    'badge' => 'BEST SELLER',
    'name' => 'Anti Social Club Tee',
    'price' => '₱699.00',
    'old_price' => '',
    'reviews' => '120',
    'image' => 'hero-tshirt-white.png',
    'slug' => 'anti-social-club-tee',
  ],
  [
    'badge' => 'NEW',
    'name' => 'Better Days Hoodie',
    'price' => '₱1,199.00',
    'old_price' => '',
    'reviews' => '91',
    'image' => 'hero-hoodie.png',
    'slug' => 'better-days-hoodie',
  ],
  [
    'badge' => '',
    'name' => 'Coffee Makes Everything Better Mug',
    'price' => '₱499.00',
    'old_price' => '',
    'reviews' => '76',
    'image' => 'hero-mug.png',
    'slug' => 'coffee-mug',
  ],
  [
    'badge' => '',
    'name' => 'Create Your Own Tee',
    'price' => '₱699.00',
    'old_price' => '',
    'reviews' => '64',
    'image' => 'hero-tshirt-white.png',
    'slug' => 'create-your-own-tee',
  ],
  [
    'badge' => '',
    'name' => 'Minimal Crown Case',
    'price' => '₱499.00',
    'old_price' => '',
    'reviews' => '53',
    'image' => 'hero-tshirt-white.png',
    'slug' => 'minimal-crown-case',
  ],
];

$zc_shop_url = home_url('/shop/');
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
              $zc_image_url = get_template_directory_uri() . '/assets/images/' . $zc_product['image'];
              $zc_product_url = $zc_shop_url;
              $zc_badge_class = '';

              if ($zc_product['badge'] === 'NEW') {
                $zc_badge_class = ' zc-best-badge--new';
              }
            ?>

            <div class="zc-best-carousel__slide">
              <article class="zc-best-card">

                <a href="<?php echo esc_url($zc_product_url); ?>" class="zc-best-image-wrap">
                  <?php if (!empty($zc_product['badge'])) : ?>
                    <span class="zc-best-badge<?php echo esc_attr($zc_badge_class); ?>">
                      <?php echo esc_html($zc_product['badge']); ?>
                    </span>
                  <?php endif; ?>

                  <img
                    src="<?php echo esc_url($zc_image_url); ?>"
                    alt="<?php echo esc_attr($zc_product['name']); ?>"
                    class="zc-best-image"
                  >
                </a>

                <div class="zc-best-info">
                  <h3 class="zc-best-name">
                    <a href="<?php echo esc_url($zc_product_url); ?>">
                      <?php echo esc_html($zc_product['name']); ?>
                    </a>
                  </h3>

                  <div class="zc-best-price-row">
                    <div class="zc-best-price-wrap">
                      <span class="zc-best-price">
                        <?php echo esc_html($zc_product['price']); ?>
                      </span>

                      <?php if (!empty($zc_product['old_price'])) : ?>
                        <span class="zc-best-old-price">
                          <?php echo esc_html($zc_product['old_price']); ?>
                        </span>
                      <?php endif; ?>
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
                    <span class="zc-best-stars">★★★★★</span>
                    <span class="zc-best-review-count">
                      (<?php echo esc_html($zc_product['reviews']); ?>)
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

  let slides = Array.from(track.children);
  let currentIndex = originalCount;
  let slideWidth = 0;
  let gap = 18;
  let perView = 5;
  let autoplay = null;
  let isMoving = false;

  function getPerView() {
    const width = window.innerWidth;

    if (width <= 480) return 1;
    if (width <= 768) return 2;
    if (width <= 1024) return 3;

    return 5;
  }

  function setSizes() {
    perView = getPerView();
    gap = window.innerWidth <= 768 ? 16 : 18;

    const viewportWidth = viewport.clientWidth;
    slideWidth = (viewportWidth - gap * (perView - 1)) / perView;

    slides.forEach(function (slide) {
      slide.style.flex = '0 0 ' + slideWidth + 'px';
    });

    track.style.gap = gap + 'px';
    moveToIndex(currentIndex, false);
  }

  function moveToIndex(index, animate = true) {
    const offset = index * (slideWidth + gap);

    track.style.transition = animate ? 'transform 0.45s ease' : 'none';
    track.style.transform = 'translateX(-' + offset + 'px)';
  }

  function goNext() {
    if (isMoving) return;

    isMoving = true;
    currentIndex++;
    moveToIndex(currentIndex, true);
  }

  function goPrev() {
    if (isMoving) return;

    isMoving = true;
    currentIndex--;
    moveToIndex(currentIndex, true);
  }

  track.addEventListener('transitionend', function () {
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
    slides = Array.from(track.children);
    setSizes();
  });

  setSizes();
  startAutoplay();
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

.zc-best-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
  transition: 0.25s ease;
}

.zc-best-card:hover .zc-best-image {
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

/* Carousel buttons */
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

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-best-image-wrap {
    height: 200px;
  }
}

/* 768 */
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

/* 480 */
@media screen and (max-width: 480px) {
  .zc-best-image-wrap {
    height: 210px;
  }
}
</style>