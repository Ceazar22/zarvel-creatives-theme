<?php
$zc_testimonials = [
  [
    'name' => 'Mark D.',
    'role' => 'Verified Buyer',
    'quote' => 'The print quality is amazing! The shirt looks even better in person.',
    'initial' => 'M',
  ],
  [
    'name' => 'Jessica R.',
    'role' => 'Verified Buyer',
    'quote' => 'Ordered custom mugs for our team and everyone loved them!',
    'initial' => 'J',
  ],
  [
    'name' => 'Daniel S.',
    'role' => 'Verified Buyer',
    'quote' => 'Super easy to customize and fast shipping. Highly recommended!',
    'initial' => 'D',
  ],
  [
    'name' => 'Mitch L.',
    'role' => 'Verified Buyer',
    'quote' => 'This is now my go-to store for custom merch. Great quality every time!',
    'initial' => 'M',
  ],
  [
    'name' => 'Anna P.',
    'role' => 'Verified Buyer',
    'quote' => 'The mockup process was smooth and the final print came out clean.',
    'initial' => 'A',
  ],
];
?>

<section class="zc-testimonials-section">
  <div class="zc-testimonials-container">

    <div class="zc-testimonials-head">
      <h2 class="zc-testimonials-title">REAL PRINTS. REAL PEOPLE.</h2>
    </div>

    <div class="zc-testimonials-carousel" data-zc-testimonials-carousel>
      <button class="zc-testimonials-carousel__btn zc-testimonials-carousel__btn--prev" type="button" aria-label="Previous review">
        ‹
      </button>

      <div class="zc-testimonials-carousel__viewport">
        <div class="zc-testimonials-carousel__track">

          <?php foreach ($zc_testimonials as $zc_testimonial) : ?>
            <div class="zc-testimonials-carousel__slide">
              <article class="zc-testimonial-card">

                <div class="zc-testimonial-avatar">
                  <span><?php echo esc_html($zc_testimonial['initial']); ?></span>
                </div>

                <div class="zc-testimonial-content">
                  <p class="zc-testimonial-quote">
                    “<?php echo esc_html($zc_testimonial['quote']); ?>”
                  </p>

                  <div class="zc-testimonial-bottom">
                    <div class="zc-testimonial-person">
                      <h3><?php echo esc_html($zc_testimonial['name']); ?></h3>
                      <span><?php echo esc_html($zc_testimonial['role']); ?></span>
                    </div>

                    <div class="zc-testimonial-stars" aria-label="5 star rating">
                      ★★★★★
                    </div>
                  </div>
                </div>

              </article>
            </div>
          <?php endforeach; ?>

        </div>
      </div>

      <button class="zc-testimonials-carousel__btn zc-testimonials-carousel__btn--next" type="button" aria-label="Next review">
        ›
      </button>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const carousel = document.querySelector('[data-zc-testimonials-carousel]');
  if (!carousel) return;

  const viewport = carousel.querySelector('.zc-testimonials-carousel__viewport');
  const track = carousel.querySelector('.zc-testimonials-carousel__track');
  const prevBtn = carousel.querySelector('.zc-testimonials-carousel__btn--prev');
  const nextBtn = carousel.querySelector('.zc-testimonials-carousel__btn--next');

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
  let perView = 4;
  let autoplay = null;
  let isMoving = false;

  function getPerView() {
    const width = window.innerWidth;

    if (width <= 480) return 1;
    if (width <= 768) return 2;
    if (width <= 1024) return 3;

    return 4;
  }

  function setSizes() {
    perView = getPerView();
    gap = window.innerWidth <= 768 ? 14 : 18;

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
    }, 3000);
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
.zc-testimonials-section {
  padding: 20px 0 75px;
  background: #ffffff;
  overflow: hidden;
}

.zc-testimonials-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-testimonials-head {
  display: flex;
  justify-content: center;
  margin-bottom: 24px;
}

.zc-testimonials-title {
  margin: 0;
  color: #111111;
  font-size: 30px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.4px;
}

.zc-testimonials-carousel {
  position: relative;
}

.zc-testimonials-carousel__viewport {
  width: 100%;
  overflow: hidden;
}

.zc-testimonials-carousel__track {
  display: flex;
  align-items: stretch;
  will-change: transform;
}

.zc-testimonials-carousel__slide {
  min-width: 0;
}

.zc-testimonial-card {
  height: 100%;
  min-height: 145px;
  display: grid;
  grid-template-columns: 58px 1fr;
  gap: 14px;
  align-items: flex-start;
  padding: 18px 18px 16px;
  border-radius: 12px;
  background:
    radial-gradient(circle at 10% 20%, rgba(255, 91, 26, 0.05), transparent 30%),
    #f8f8f8;
  border: 1px solid #eeeeee;
  transition: 0.25s ease;
}

.zc-testimonial-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 28px rgba(0, 0, 0, 0.08);
}

.zc-testimonial-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
  background:
    radial-gradient(circle at 30% 25%, #ffd9c8 0%, #e0a58b 48%, #9c5f46 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  font-size: 20px;
  font-weight: 950;
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
}

.zc-testimonial-avatar span {
  line-height: 1;
}

.zc-testimonial-content {
  min-width: 0;
}

.zc-testimonial-quote {
  margin: 0 0 14px;
  color: #222222;
  font-size: 14px;
  line-height: 1.35;
  font-weight: 700;
}

.zc-testimonial-bottom {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 14px;
}

.zc-testimonial-person h3 {
  margin: 0 0 3px;
  color: #111111;
  font-size: 13px;
  line-height: 1;
  font-weight: 950;
}

.zc-testimonial-person span {
  display: block;
  color: #777777;
  font-size: 11px;
  line-height: 1;
  font-weight: 700;
}

.zc-testimonial-stars {
  color: #ffb000;
  font-size: 13px;
  line-height: 1;
  letter-spacing: 1px;
  white-space: nowrap;
}

/* Carousel buttons */
.zc-testimonials-carousel__btn {
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

.zc-testimonials-carousel__btn:hover {
  background: #ff5b1a;
  border-color: #ff5b1a;
  color: #ffffff;
}

.zc-testimonials-carousel__btn::before {
  content: "";
  width: 9px;
  height: 9px;
  display: block;
  border-top: 2px solid currentColor;
  border-right: 2px solid currentColor;
}

.zc-testimonials-carousel__btn--prev {
  left: -19px;
}

.zc-testimonials-carousel__btn--prev::before {
  transform: rotate(-135deg);
  margin-left: 3px;
}

.zc-testimonials-carousel__btn--next {
  right: -19px;
}

.zc-testimonials-carousel__btn--next::before {
  transform: rotate(45deg);
  margin-right: 3px;
}

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-testimonial-card {
    min-height: 150px;
  }
}

/* 768 */
@media screen and (max-width: 768px) {
  .zc-testimonials-section {
    padding: 15px 0 55px;
  }

  .zc-testimonials-container {
    width: min(100% - 30px, 1280px);
  }

  .zc-testimonials-title {
    font-size: 26px;
  }

  .zc-testimonial-card {
    min-height: 150px;
    padding: 16px;
  }

  .zc-testimonials-carousel__btn {
    width: 34px;
    height: 34px;
  }

  .zc-testimonials-carousel__btn::before {
    width: 8px;
    height: 8px;
  }

  .zc-testimonials-carousel__btn--prev {
    left: -12px;
  }

  .zc-testimonials-carousel__btn--next {
    right: -12px;
  }
}

/* 480 */
@media screen and (max-width: 480px) {
  .zc-testimonial-card {
    grid-template-columns: 48px 1fr;
    gap: 12px;
  }

  .zc-testimonial-avatar {
    width: 44px;
    height: 44px;
    font-size: 18px;
  }

  .zc-testimonial-bottom {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
}
</style>