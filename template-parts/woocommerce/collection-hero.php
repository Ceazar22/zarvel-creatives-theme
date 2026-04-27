<?php
defined('ABSPATH') || exit;

$zc_term = get_queried_object();

$zc_title = 'Collection';
$zc_description = 'Top off your look with our custom printed products. Made on demand, made for you.';

if ($zc_term && !is_wp_error($zc_term) && !empty($zc_term->name)) {
  $zc_title = $zc_term->name;
}

if ($zc_term && !is_wp_error($zc_term) && !empty($zc_term->description)) {
  $zc_description = $zc_term->description;
}

$zc_shop_url = home_url('/shop/');
?>

<section class="zc-collection-hero">
  <div class="zc-collection-hero__container">

    <nav class="zc-collection-hero__breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span>/</span>
      <a href="<?php echo esc_url($zc_shop_url); ?>">Collections</a>
      <span>/</span>
      <strong><?php echo esc_html($zc_title); ?></strong>
    </nav>

    <div class="zc-collection-hero__content">

      <div class="zc-collection-hero__text">
        <h1 class="zc-collection-hero__title">
          <?php echo esc_html($zc_title); ?>
        </h1>

        <div class="zc-collection-hero__underline"></div>

        <p class="zc-collection-hero__description">
          <?php echo esc_html($zc_description); ?>
        </p>

        <div class="zc-collection-hero__benefits">

          <div class="zc-collection-benefit">
            <span class="zc-collection-benefit__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z"></path>
                <path d="M9 12l2 2 4-5"></path>
              </svg>
            </span>
            <span class="zc-collection-benefit__text">
              Premium Quality<br>Prints
            </span>
          </div>

          <div class="zc-collection-benefit">
            <span class="zc-collection-benefit__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3l8 4v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"></path>
                <path d="M8 12h8"></path>
              </svg>
            </span>
            <span class="zc-collection-benefit__text">
              Made on Demand<br>Just for You
            </span>
          </div>

          <div class="zc-collection-benefit">
            <span class="zc-collection-benefit__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 7h11v9H3z"></path>
                <path d="M14 10h4l3 3v3h-7z"></path>
                <circle cx="7" cy="18" r="2"></circle>
                <circle cx="18" cy="18" r="2"></circle>
              </svg>
            </span>
            <span class="zc-collection-benefit__text">
              Fast & Reliable<br>Shipping
            </span>
          </div>

          <div class="zc-collection-benefit">
            <span class="zc-collection-benefit__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
                <circle cx="12" cy="12" r="9"></circle>
              </svg>
            </span>
            <span class="zc-collection-benefit__text">
              No Minimum<br>Order
            </span>
          </div>

        </div>
      </div>

    </div>

  </div>
</section>

<style>
.zc-collection-hero {
  padding: 26px 0 36px;
  background: #ffffff;
}

.zc-collection-hero__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  padding: 24px 30px 34px;
  border-radius: 16px;
  background:
    radial-gradient(circle at 95% 20%, rgba(255, 91, 26, 0.08), transparent 28%),
    linear-gradient(135deg, #ffffff 0%, #fbf7f3 100%);
  border: 1px solid #eeeeee;
}

.zc-collection-hero__breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 30px;
  color: #777777;
  font-size: 12px;
  line-height: 1;
  font-weight: 700;
}

.zc-collection-hero__breadcrumb a {
  color: #777777;
  text-decoration: none;
}

.zc-collection-hero__breadcrumb a:hover {
  color: #ff5b1a;
}

.zc-collection-hero__breadcrumb span {
  color: #b0b0b0;
}

.zc-collection-hero__breadcrumb strong {
  color: #111111;
  font-weight: 800;
}

.zc-collection-hero__content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.zc-collection-hero__text {
  max-width: 620px;
}

.zc-collection-hero__title {
  margin: 0;
  color: #111111;
  font-size: clamp(48px, 6vw, 86px);
  line-height: 0.88;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -2px;
}

.zc-collection-hero__underline {
  width: 150px;
  height: 14px;
  margin: 14px 0 18px;
  background: #ff5b1a;
  border-radius: 999px;
  transform: rotate(-3deg);
  clip-path: polygon(0 35%, 10% 20%, 23% 40%, 36% 20%, 50% 35%, 65% 18%, 80% 38%, 100% 22%, 96% 68%, 80% 82%, 66% 62%, 48% 82%, 35% 66%, 19% 84%, 7% 62%, 0 76%);
}

.zc-collection-hero__description {
  max-width: 460px;
  margin: 0 0 34px;
  color: #222222;
  font-size: 15px;
  line-height: 1.55;
  font-weight: 650;
}

.zc-collection-hero__benefits {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, auto));
  gap: 28px;
  align-items: center;
}

.zc-collection-benefit {
  display: flex;
  align-items: center;
  gap: 10px;
}

.zc-collection-benefit__icon {
  width: 34px;
  height: 34px;
  min-width: 34px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid #eeeeee;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-collection-benefit__icon svg {
  width: 18px;
  height: 18px;
  fill: none;
  stroke: #111111;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-collection-benefit__text {
  color: #222222;
  font-size: 12px;
  line-height: 1.2;
  font-weight: 850;
}

.zc-collection-products {
  padding: 10px 0 80px;
  background: #ffffff;
}

.zc-collection-products__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

@media screen and (max-width: 1024px) {
  .zc-collection-hero__benefits {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
  }
}

@media screen and (max-width: 768px) {
  .zc-collection-hero {
    padding: 18px 0 28px;
  }

  .zc-collection-hero__container {
    width: min(100% - 30px, 1280px);
    padding: 22px 18px 28px;
  }

  .zc-collection-hero__breadcrumb {
    flex-wrap: wrap;
    margin-bottom: 24px;
  }

  .zc-collection-hero__title {
    font-size: 46px;
    letter-spacing: -1px;
  }

  .zc-collection-hero__description {
    font-size: 14px;
  }

  .zc-collection-hero__benefits {
    grid-template-columns: 1fr 1fr;
  }

  .zc-collection-products__container {
    width: min(100% - 30px, 1280px);
  }
}

@media screen and (max-width: 480px) {
  .zc-collection-hero__title {
    font-size: 38px;
  }

  .zc-collection-hero__benefits {
    grid-template-columns: 1fr;
  }
}
</style>