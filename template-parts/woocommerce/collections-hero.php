<?php
defined('ABSPATH') || exit;

$zc_title = 'COLLECTIONS';
$zc_description = 'Explore our curated collections of custom prints made for every style, mood, and moment.';
?>

<section class="zc-collections-hero">
  <div class="zc-collections-hero__container">

    <nav class="zc-collections-hero__breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span>›</span>
      <strong>Collections</strong>
    </nav>

    <div class="zc-collections-hero__content">
      <div class="zc-collections-hero__left">
        <h1 class="zc-collections-hero__title">
          <?php echo esc_html($zc_title); ?>
        </h1>

        <div class="zc-collections-hero__underline">
          <svg viewBox="0 0 180 18" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M3 12C20 6 33 15 49 10C63 6 78 12 93 8C110 4 121 10 137 7C151 4 163 8 177 5" />
          </svg>
        </div>

        <p class="zc-collections-hero__desc">
          <?php echo esc_html($zc_description); ?>
        </p>

        <div class="zc-collections-hero__features">

          <div class="zc-collections-hero__feature">
            <span class="zc-collections-hero__icon">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 3L19 7V12C19 16.5 16.2 20.2 12 21C7.8 20.2 5 16.5 5 12V7L12 3Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M9.5 12L11.2 13.7L14.8 10.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <span class="zc-collections-hero__feature-text">Premium Quality<br>Prints</span>
          </div>

          <div class="zc-collections-hero__feature zc-collections-hero__feature--border">
            <span class="zc-collections-hero__icon">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 20C16.4 20 20 16.4 20 12C20 7.6 16.4 4 12 4C7.6 4 4 7.6 4 12C4 16.4 7.6 20 12 20Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M8 13C10.2 13 11.5 10.2 12.4 8.3C13 7 13.5 6 14.4 6C15.8 6 16.3 8 16.6 9.5C17 11.2 17.7 13 19 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
            </span>
            <span class="zc-collections-hero__feature-text">Made on Demand<br>Just for you</span>
          </div>

          <div class="zc-collections-hero__feature zc-collections-hero__feature--border">
            <span class="zc-collections-hero__icon">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M3 7H14V14H3V7Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M14 10H18L21 13V14H14V10Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M7 18C8.1 18 9 17.1 9 16C9 14.9 8.1 14 7 14C5.9 14 5 14.9 5 16C5 17.1 5.9 18 7 18Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M17 18C18.1 18 19 17.1 19 16C19 14.9 18.1 14 17 14C15.9 14 15 14.9 15 16C15 17.1 15.9 18 17 18Z" stroke="currentColor" stroke-width="1.8"/>
              </svg>
            </span>
            <span class="zc-collections-hero__feature-text">Fast &amp; Reliable<br>Shipping</span>
          </div>

          <div class="zc-collections-hero__feature zc-collections-hero__feature--border">
            <span class="zc-collections-hero__icon">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3Z" stroke="currentColor" stroke-width="1.8"/>
                <path d="M8 12H16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M12 8V16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
            </span>
            <span class="zc-collections-hero__feature-text">No Minimum<br>Order</span>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<style>
.zc-collections-hero {
  width: 100%;
  padding: 38px 0 40px;
  background: linear-gradient(90deg, #ffffff 0%, #fdf8f5 100%);
  border-top: 1px solid #f0ece8;
  border-bottom: 1px solid #f0ece8;
}

.zc-collections-hero__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-collections-hero__breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 22px;
  font-size: 12px;
  line-height: 1.2;
  font-weight: 700;
  color: #8a8a8a;
}

.zc-collections-hero__breadcrumb a {
  color: #8a8a8a;
  text-decoration: none;
}

.zc-collections-hero__breadcrumb a:hover {
  color: #111111;
}

.zc-collections-hero__breadcrumb strong {
  color: #111111;
  font-weight: 800;
}

.zc-collections-hero__left {
  width: 100%;
  max-width: 760px;
}

.zc-collections-hero__title {
  margin: 0;
  color: #111111;
  font-size: clamp(42px, 7vw, 78px);
  line-height: .92;
  font-weight: 900;
  letter-spacing: -1.8px;
  text-transform: uppercase;
}

.zc-collections-hero__underline {
  width: 160px;
  margin: 12px 0 14px;
}

.zc-collections-hero__underline svg {
  display: block;
  width: 100%;
  height: auto;
}

.zc-collections-hero__underline path {
  fill: none;
  stroke: #ff5b1a;
  stroke-width: 7;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-collections-hero__desc {
  max-width: 500px;
  margin: 0 0 26px;
  color: #444444;
  font-size: 17px;
  line-height: 1.6;
  font-weight: 600;
}

.zc-collections-hero__features {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
  gap: 0;
}

.zc-collections-hero__feature {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 0 22px 0 0;
  min-height: 48px;
}

.zc-collections-hero__feature--border {
  margin-left: 22px;
  padding-left: 22px;
  border-left: 1px solid #e7dfd8;
}

.zc-collections-hero__icon {
  width: 28px;
  height: 28px;
  min-width: 28px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #555555;
}

.zc-collections-hero__icon svg {
  width: 24px;
  height: 24px;
  display: block;
}

.zc-collections-hero__feature-text {
  color: #3b3b3b;
  font-size: 13px;
  line-height: 1.35;
  font-weight: 700;
}

@media screen and (max-width: 768px) {
  .zc-collections-hero {
    padding: 30px 0 34px;
  }

  .zc-collections-hero__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-collections-hero__features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .zc-collections-hero__feature,
  .zc-collections-hero__feature--border {
    margin-left: 0;
    padding: 0;
    border-left: 0;
  }
}

@media screen and (max-width: 480px) {
  .zc-collections-hero__features {
    grid-template-columns: 1fr;
  }

  .zc-collections-hero__title {
    font-size: 38px;
  }
}
</style>