<?php
defined('ABSPATH') || exit;
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
        <h1 class="zc-collections-hero__title">COLLECTIONS</h1>

        <div class="zc-collections-hero__underline" aria-hidden="true">
          <svg viewBox="0 0 180 18" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 12C20 6 33 15 49 10C63 6 78 12 93 8C110 4 121 10 137 7C151 4 163 8 177 5" />
          </svg>
        </div>

        <p class="zc-collections-hero__desc">
          Explore our curated collections of custom prints made for every style, mood, and moment.
        </p>

      </div>
    </div>

  </div>
</section>

<style>
.zc-collections-hero {
  width: 100%;
  padding: 42px 0 44px;
  background: linear-gradient(90deg, #ffffff 0%, #fdf7f4 100%);
  border-top: 1px solid #efebe7;
  border-bottom: 1px solid #efebe7;
}

.zc-collections-hero__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-collections-hero__breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 24px;
  font-size: 12px;
  line-height: 1.2;
  font-weight: 700;
  color: #8e8e8e;
}

.zc-collections-hero__breadcrumb a {
  color: #8e8e8e;
  text-decoration: none;
}

.zc-collections-hero__breadcrumb a:hover {
  color: #111111;
}

.zc-collections-hero__breadcrumb strong {
  color: #111111;
  font-weight: 800;
}

.zc-collections-hero__content {
  display: block;
}

.zc-collections-hero__left {
  width: 100%;
  max-width: 760px;
}

.zc-collections-hero__title {
  margin: 0;
  color: #111111;
  font-size: clamp(44px, 6vw, 78px);
  line-height: 0.92;
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
  margin: 0 0 28px;
  color: #444444;
  font-size: 17px;
  line-height: 1.65;
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
  min-height: 48px;
  padding-right: 24px;
}

.zc-collections-hero__feature--border {
  margin-left: 24px;
  padding-left: 24px;
  border-left: 1px solid #e8ddd5;
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

@media screen and (max-width: 1024px) {
  .zc-collections-hero__features {
    gap: 18px 0;
  }

  .zc-collections-hero__feature,
  .zc-collections-hero__feature--border {
    margin-left: 0;
    padding-left: 0;
    border-left: 0;
    width: 50%;
    padding-right: 16px;
  }
}

@media screen and (max-width: 768px) {
  .zc-collections-hero {
    padding: 34px 0 36px;
  }

  .zc-collections-hero__container {
    width: min(100% - 30px, 1280px);
  }

  .zc-collections-hero__breadcrumb {
    margin-bottom: 18px;
  }

  .zc-collections-hero__title {
    font-size: 44px;
  }

  .zc-collections-hero__underline {
    width: 130px;
  }

  .zc-collections-hero__desc {
    font-size: 15px;
    margin-bottom: 24px;
  }

  .zc-collections-hero__features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .zc-collections-hero__feature,
  .zc-collections-hero__feature--border {
    width: 100%;
    padding-right: 0;
  }
}

@media screen and (max-width: 480px) {
  .zc-collections-hero__title {
    font-size: 38px;
  }

  .zc-collections-hero__features {
    grid-template-columns: 1fr;
  }
}
</style>