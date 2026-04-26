<?php
defined('ABSPATH') || exit;

$zc_fallback_url = home_url('/shop/');

$zc_categories = get_terms([
  'taxonomy'   => 'product_cat',
  'hide_empty' => false,
  'orderby'    => 'name',
  'order'      => 'ASC',
]);

if (is_wp_error($zc_categories) || empty($zc_categories)) {
  return;
}

if (!function_exists('zc_category_get_first_product_image')) {
  function zc_category_get_first_product_image($category) {
    if (!$category || empty($category->term_id)) {
      return '';
    }

    $product_ids = get_posts([
      'post_type'      => 'product',
      'post_status'    => 'publish',
      'posts_per_page' => 1,
      'fields'         => 'ids',
      'tax_query'      => [
        [
          'taxonomy'         => 'product_cat',
          'field'            => 'term_id',
          'terms'            => [$category->term_id],
          'include_children' => true,
        ],
      ],
    ]);

    if (empty($product_ids)) {
      return '';
    }

    $product = wc_get_product($product_ids[0]);

    if (!$product || !$product->get_image_id()) {
      return '';
    }

    return wp_get_attachment_image_url($product->get_image_id(), 'woocommerce_thumbnail');
  }
}

if (!function_exists('zc_category_get_image')) {
  function zc_category_get_image($category) {
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

    if ($thumbnail_id) {
      $image = wp_get_attachment_image_url($thumbnail_id, 'woocommerce_thumbnail');

      if ($image) {
        return $image;
      }
    }

    $first_product_image = zc_category_get_first_product_image($category);

    if ($first_product_image) {
      return $first_product_image;
    }

    return wc_placeholder_img_src('woocommerce_thumbnail');
  }
}
?>

<section class="zc-home-categories">
  <div class="zc-home-categories__container">

    <div class="zc-home-categories__head">
      <h2 class="zc-home-categories__title">SHOP BY CATEGORY</h2>
    </div>

    <div class="zc-category-carousel" data-zc-category-carousel>
      <button class="zc-category-carousel__btn zc-category-carousel__btn--prev" type="button" aria-label="Previous category">
        ‹
      </button>

      <div class="zc-category-carousel__viewport">
        <div class="zc-category-carousel__track">

          <?php foreach ($zc_categories as $zc_category) : ?>
            <?php
            $zc_link = get_term_link($zc_category);

            if (is_wp_error($zc_link)) {
              $zc_link = $zc_fallback_url;
            }

            $zc_image = zc_category_get_image($zc_category);
            ?>

            <div class="zc-category-carousel__slide">
              <a href="<?php echo esc_url($zc_link); ?>" class="zc-category-card">
                <div
                  class="zc-category-card__image"
                  style="background-image: url('<?php echo esc_url($zc_image); ?>');"
                ></div>

                <div class="zc-category-card__bottom">
                  <span class="zc-category-card__name">
                    <?php echo esc_html($zc_category->name); ?>
                  </span>

                  <span class="zc-category-card__arrow">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M8 12h8"></path>
                      <path d="M13 7l5 5-5 5"></path>
                    </svg>
                  </span>
                </div>
              </a>
            </div>
          <?php endforeach; ?>

        </div>
      </div>

      <button class="zc-category-carousel__btn zc-category-carousel__btn--next" type="button" aria-label="Next category">
        ›
      </button>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const carousel = document.querySelector('[data-zc-category-carousel]');
  if (!carousel) return;

  const viewport = carousel.querySelector('.zc-category-carousel__viewport');
  const track = carousel.querySelector('.zc-category-carousel__track');
  const prevBtn = carousel.querySelector('.zc-category-carousel__btn--prev');
  const nextBtn = carousel.querySelector('.zc-category-carousel__btn--next');

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
    }, 2600);
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
.zc-home-categories {
  padding: 70px 0;
  background: #ffffff;
  overflow: hidden;
}

.zc-home-categories__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-home-categories__head {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  margin-bottom: 28px;
}

.zc-home-categories__title {
  margin: 0;
  color: #111111;
  font-size: 38px;
  line-height: 1;
  font-weight: 900;
  text-transform: uppercase;
  text-align: center;
}

.zc-home-categories__view-all {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  color: #ff5b1a;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-home-categories__view-all:hover {
  opacity: 0.75;
}

.zc-category-carousel {
  position: relative;
}

.zc-category-carousel__viewport {
  overflow: hidden;
  width: 100%;
}

.zc-category-carousel__track {
  display: flex;
  align-items: stretch;
  will-change: transform;
}

.zc-category-carousel__slide {
  min-width: 0;
}

.zc-category-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 255px;
  padding: 14px;
  background: #f7f7f7;
  border: 1px solid #ececec;
  border-radius: 14px;
  text-decoration: none;
  transition: 0.25s ease;
  height: 100%;
}

.zc-category-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
}

.zc-category-card__image {
  width: 100%;
  height: 165px;
  border-radius: 12px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}

.zc-category-card__bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding-top: 12px;
}

.zc-category-card__name {
  color: #222222;
  font-size: 16px;
  line-height: 1.2;
  font-weight: 800;
}

.zc-category-card__arrow {
  width: 28px;
  height: 28px;
  min-width: 28px;
  border-radius: 50%;
  border: 1px solid #d9d9d9;
  background: #ffffff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s ease;
}

.zc-category-card:hover .zc-category-card__arrow {
  background: #ff5b1a;
  border-color: #ff5b1a;
}

.zc-category-card__arrow svg {
  width: 15px;
  height: 15px;
  fill: none;
  stroke: #222222;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
  transition: 0.2s ease;
}

.zc-category-card:hover .zc-category-card__arrow svg {
  stroke: #ffffff;
}

.zc-category-carousel__btn {
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

.zc-category-carousel__btn:hover {
  background: #ff5b1a;
  border-color: #ff5b1a;
  color: #ffffff;
}

.zc-category-carousel__btn::before {
  content: "";
  width: 9px;
  height: 9px;
  display: block;
  border-top: 2px solid currentColor;
  border-right: 2px solid currentColor;
}

.zc-category-carousel__btn--prev {
  left: -19px;
}

.zc-category-carousel__btn--prev::before {
  transform: rotate(-135deg);
  margin-left: 3px;
}

.zc-category-carousel__btn--next {
  right: -19px;
}

.zc-category-carousel__btn--next::before {
  transform: rotate(45deg);
  margin-right: 3px;
}

@media screen and (max-width: 1024px) {
  .zc-category-card {
    min-height: 245px;
  }
}

@media screen and (max-width: 768px) {
  .zc-home-categories {
    padding: 50px 0;
  }

  .zc-home-categories__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-home-categories__head {
    flex-direction: column;
    gap: 12px;
    margin-bottom: 22px;
  }

  .zc-home-categories__view-all {
    position: static;
    transform: none;
  }

  .zc-home-categories__title {
    font-size: 28px;
  }

  .zc-category-card {
    min-height: 220px;
    padding: 12px;
  }

  .zc-category-card__image {
    height: 135px;
  }

  .zc-category-card__name {
    font-size: 14px;
  }

  .zc-category-carousel__btn {
    width: 34px;
    height: 34px;
  }

  .zc-category-carousel__btn::before {
    width: 8px;
    height: 8px;
  }

  .zc-category-carousel__btn--prev {
    left: -12px;
  }

  .zc-category-carousel__btn--next {
    right: -12px;
  }
}

@media screen and (max-width: 480px) {
  .zc-category-card {
    min-height: 210px;
  }

  .zc-category-card__image {
    height: 130px;
  }
}
</style>