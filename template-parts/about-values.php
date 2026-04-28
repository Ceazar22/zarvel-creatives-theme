<?php
defined('ABSPATH') || exit;
?>

<section class="zc-about-values">
  <div class="zc-about-values__container">

    <div class="zc-about-values__head">
      <span class="zc-about-values__kicker">What We Stand For</span>

      <h2 class="zc-about-values__title">
        Quality. Creativity. Care.
      </h2>
    </div>

    <div class="zc-about-values__grid">

      <article class="zc-about-value-card">
        <span class="zc-about-value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 3l2.1 2.1 3-.3 1.1 2.8 2.6 1.5-.9 2.9.9 2.9-2.6 1.5-1.1 2.8-3-.3L12 21l-2.1-2.1-3 .3-1.1-2.8-2.6-1.5.9-2.9-.9-2.9 2.6-1.5 1.1-2.8 3 .3L12 3z"></path>
            <path d="M9 12l2 2 4-5"></path>
          </svg>
        </span>

        <h3>Premium Quality</h3>

        <p>
          We use top-quality materials and printing technology.
        </p>
      </article>

      <article class="zc-about-value-card">
        <span class="zc-about-value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M9 18l-5-5 5-5"></path>
            <path d="M15 6l5 5-5 5"></path>
            <path d="M14 10H9a3 3 0 0 0 0 6h2"></path>
          </svg>
        </span>

        <h3>Made on Demand</h3>

        <p>
          We print only when you order, less waste, just purpose.
        </p>
      </article>

      <article class="zc-about-value-card">
        <span class="zc-about-value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 3l7 4v6c0 4.5-2.8 7.3-7 8-4.2-.7-7-3.5-7-8V7l7-4z"></path>
            <path d="M9 12l2 2 4-5"></path>
          </svg>
        </span>

        <h3>Designed for You</h3>

        <p>
          Your ideas deserve to look amazing. We make it happen.
        </p>
      </article>

      <article class="zc-about-value-card">
        <span class="zc-about-value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 7h11v9H3z"></path>
            <path d="M14 10h4l3 3v3h-7z"></path>
            <circle cx="7" cy="18" r="2"></circle>
            <circle cx="18" cy="18" r="2"></circle>
          </svg>
        </span>

        <h3>Fast & Reliable</h3>

        <p>
          From production to delivery, we move quick and careful.
        </p>
      </article>

      <article class="zc-about-value-card">
        <span class="zc-about-value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M8.5 13.5c1.2 1.3 2.4 2 3.5 2s2.3-.7 3.5-2"></path>
            <path d="M9 10h.01"></path>
            <path d="M15 10h.01"></path>
          </svg>
        </span>

        <h3>Customer First</h3>

        <p>
          Your satisfaction is our priority. We’re here for you.
        </p>
      </article>

    </div>

  </div>
</section>

<style>
.zc-about-values {
  width: 100%;
  padding: 78px 0 88px;
  background:
    radial-gradient(circle at 12% 20%, rgba(255, 91, 26, 0.06), transparent 28%),
    linear-gradient(90deg, #ffffff 0%, #fff8f4 100%);
  border-top: 1px solid #f0ece8;
  border-bottom: 1px solid #f0ece8;
}

.zc-about-values__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-about-values__head {
  margin-bottom: 34px;
  text-align: center;
}

.zc-about-values__kicker {
  display: inline-block;
  margin-bottom: 6px;
  color: #ff5b1a;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-about-values__title {
  margin: 0;
  color: #111111;
  font-size: clamp(30px, 3.3vw, 46px);
  line-height: 0.95;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -0.9px;
}

.zc-about-values__grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  align-items: stretch;
}

.zc-about-value-card {
  min-height: 170px;
  padding: 26px 24px;
  text-align: center;
  border-right: 1px solid #e6e1dc;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.zc-about-value-card:last-child {
  border-right: 0;
}

.zc-about-value-card__icon {
  width: 42px;
  height: 42px;
  margin-bottom: 18px;
  border-radius: 50%;
  color: #111111;
  background: #ffffff;
  border: 1px solid #eeeeee;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-about-value-card__icon svg {
  width: 24px;
  height: 24px;
  display: block;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-about-value-card h3 {
  margin: 0 0 9px;
  color: #111111;
  font-size: 15px;
  line-height: 1.15;
  font-weight: 950;
}

.zc-about-value-card p {
  max-width: 180px;
  margin: 0 auto;
  color: #555555;
  font-size: 12px;
  line-height: 1.45;
  font-weight: 650;
}

@media screen and (max-width: 1100px) {
  .zc-about-values__grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 0;
  }

  .zc-about-value-card {
    border-right: 0;
    border-bottom: 1px solid #e6e1dc;
  }

  .zc-about-value-card:nth-child(4),
  .zc-about-value-card:nth-child(5) {
    border-bottom: 0;
  }
}

@media screen and (max-width: 768px) {
  .zc-about-values {
    padding: 62px 0 70px;
  }

  .zc-about-values__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-about-values__grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .zc-about-value-card:nth-child(4) {
    border-bottom: 1px solid #e6e1dc;
  }

  .zc-about-value-card:nth-child(5) {
    grid-column: 1 / -1;
  }
}

@media screen and (max-width: 520px) {
  .zc-about-values__grid {
    grid-template-columns: 1fr;
  }

  .zc-about-value-card {
    border-bottom: 1px solid #e6e1dc;
  }

  .zc-about-value-card:nth-child(5) {
    border-bottom: 0;
  }
}
</style>