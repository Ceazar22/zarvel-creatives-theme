<?php
defined('ABSPATH') || exit;
?>

<section class="zc-about-story">
  <div class="zc-about-story__container">

    <div class="zc-about-story__left">
      <span class="zc-about-story__kicker">Our Story</span>

      <h2 class="zc-about-story__title">
        From An Idea To<br>
        Something You Can Wear.
      </h2>

      <div class="zc-about-story__underline" aria-hidden="true"></div>

      <p class="zc-about-story__text">
        Printly started with a simple idea — custom prints should be personal,
        high-quality, and easy to create. Today, we print thousands of designs
        for customers around the world, and we love what we do.
      </p>
    </div>

    <div class="zc-about-story__right">

      <div class="zc-about-story__point">
        <span class="zc-about-story__check">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="8"></circle>
            <path d="M8.8 12.2l2.1 2.1 4.5-5"></path>
          </svg>
        </span>

        <span>High-quality prints made to last</span>
      </div>

      <div class="zc-about-story__point">
        <span class="zc-about-story__check">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="8"></circle>
            <path d="M8.8 12.2l2.1 2.1 4.5-5"></path>
          </svg>
        </span>

        <span>Modern printing technology</span>
      </div>

      <div class="zc-about-story__point">
        <span class="zc-about-story__check">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="8"></circle>
            <path d="M8.8 12.2l2.1 2.1 4.5-5"></path>
          </svg>
        </span>

        <span>Carefully packed and delivered</span>
      </div>

      <div class="zc-about-story__point">
        <span class="zc-about-story__check">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="8"></circle>
            <path d="M8.8 12.2l2.1 2.1 4.5-5"></path>
          </svg>
        </span>

        <span>Designed for anyone, anywhere</span>
      </div>

    </div>

  </div>
</section>

<style>
.zc-about-story {
  width: 100%;
  padding: 88px 0;
  background:
    radial-gradient(circle at 90% 15%, rgba(255, 91, 26, 0.08), transparent 28%),
    linear-gradient(90deg, #ffffff 0%, #fff8f4 100%);
}

.zc-about-story__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.zc-about-story__left {
  max-width: 560px;
}

.zc-about-story__kicker {
  display: inline-block;
  margin-bottom: 16px;
  color: #ff5b1a;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-about-story__title {
  margin: 0;
  color: #111111;
  font-size: clamp(38px, 4.5vw, 62px);
  line-height: 0.94;
  font-weight: 950;
  letter-spacing: -1.4px;
  text-transform: uppercase;
}

.zc-about-story__underline {
  width: 128px;
  height: 12px;
  margin: 18px 0 24px;
  background: #ff5b1a;
  border-radius: 999px;
  transform: rotate(-4deg);
  clip-path: polygon(
    0 42%,
    10% 28%,
    22% 45%,
    37% 26%,
    50% 38%,
    66% 24%,
    82% 40%,
    100% 25%,
    96% 68%,
    78% 82%,
    62% 64%,
    46% 82%,
    30% 65%,
    15% 82%,
    0 70%
  );
}

.zc-about-story__text {
  max-width: 480px;
  margin: 0;
  color: #222222;
  font-size: 18px;
  line-height: 1.62;
  font-weight: 650;
}

.zc-about-story__right {
  display: grid;
  gap: 24px;
  max-width: 560px;
  justify-self: center;
}

.zc-about-story__point {
  display: flex;
  align-items: center;
  gap: 16px;
  color: #222222;
  font-size: 17px;
  line-height: 1.35;
  font-weight: 800;
}

.zc-about-story__check {
  width: 24px;
  height: 24px;
  min-width: 24px;
  color: #ff5b1a;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-about-story__check svg {
  width: 100%;
  height: 100%;
  fill: none;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

@media screen and (max-width: 900px) {
  .zc-about-story {
    padding: 70px 0;
  }

  .zc-about-story__container {
    grid-template-columns: 1fr;
    gap: 42px;
  }

  .zc-about-story__right {
    justify-self: stretch;
  }
}

@media screen and (max-width: 768px) {
  .zc-about-story__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-about-story__title {
    font-size: 42px;
    letter-spacing: -1px;
  }

  .zc-about-story__text,
  .zc-about-story__point {
    font-size: 15px;
  }
}

@media screen and (max-width: 480px) {
  .zc-about-story {
    padding: 56px 0;
  }

  .zc-about-story__title {
    font-size: 34px;
  }

  .zc-about-story__point {
    align-items: flex-start;
  }
}
</style>