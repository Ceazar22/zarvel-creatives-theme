<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="zc-header">

  <!-- Top Black Bar -->
  <div class="zc-topbar">
    <div class="zc-container zc-topbar__inner">

      <div class="zc-topbar__left">
        <span>✪ High Quality Prints</span>
        <span>◎ Made on Demand</span>
        <span>◉ Fast & Reliable Shipping</span>
      </div>

      <div class="zc-topbar__right">
        <span>Need help?</span>
        <a href="mailto:support@printly.com">support@printly.com</a>
        <a href="tel:+639123456789">+63 912 345 6789</a>
      </div>

    </div>
  </div>

  <!-- Main Header -->
  <div class="zc-main-header">
    <div class="zc-container zc-main-header__inner">

      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="zc-logo">
        <span class="zc-logo__main">PRINTLY</span>
        <span class="zc-logo__sub">CUSTOM. YOUR WAY.</span>
      </a>

      <!-- Mobile Toggle -->
      <button class="zc-mobile-toggle" type="button" aria-label="Open menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <!-- Navigation -->
      <nav class="zc-nav">

        <div class="zc-nav-item zc-has-dropdown">
          <a href="<?php echo esc_url(home_url('/shop')); ?>" class="zc-nav-link">
            SHOP
            <svg class="zc-chevron" viewBox="0 0 24 24" width="13" height="13">
              <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>

          <div class="zc-dropdown">
            <a href="<?php echo esc_url(home_url('/product-category/t-shirts')); ?>">T-Shirts</a>
            <a href="<?php echo esc_url(home_url('/product-category/hoodies')); ?>">Hoodies</a>
            <a href="<?php echo esc_url(home_url('/product-category/mugs')); ?>">Mugs</a>
            <a href="<?php echo esc_url(home_url('/product-category/tote-bags')); ?>">Tote Bags</a>
            <a href="<?php echo esc_url(home_url('/shop')); ?>">All Products</a>
          </div>
        </div>

        <a href="<?php echo esc_url(home_url('/customize')); ?>" class="zc-nav-link">CUSTOMIZE</a>
        <a href="<?php echo esc_url(home_url('/about-us')); ?>" class="zc-nav-link">ABOUT</a>
        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="zc-nav-link">CONTACT</a>

      </nav>

      <!-- Right Icons -->
      <div class="zc-header-actions">

        <a href="<?php echo esc_url(home_url('/?s=')); ?>" class="zc-icon-link" aria-label="Search">
          <svg viewBox="0 0 24 24" width="22" height="22">
            <path d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </a>

        <a href="<?php echo esc_url(home_url('/my-account')); ?>" class="zc-icon-link" aria-label="Account">
          <svg viewBox="0 0 24 24" width="22" height="22">
            <path d="M20 21a8 8 0 0 0-16 0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <circle cx="12" cy="7" r="4" fill="none" stroke="currentColor" stroke-width="2"/>
          </svg>
        </a>

        <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart')); ?>" class="zc-cart-link" aria-label="Cart">
          <svg viewBox="0 0 24 24" width="23" height="23">
            <path d="M6 6h15l-2 9H8L6 6z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            <path d="M6 6 5 2H2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <circle cx="9" cy="21" r="1"/>
            <circle cx="18" cy="21" r="1"/>
          </svg>

          <span class="zc-cart-count">
            <?php
              if (function_exists('WC') && WC()->cart) {
                echo esc_html(WC()->cart->get_cart_contents_count());
              } else {
                echo '0';
              }
            ?>
          </span>
        </a>

        <a href="<?php echo esc_url(home_url('/customize')); ?>" class="zc-customize-btn">
          START CUSTOMIZING
        </a>

      </div>

    </div>
  </div>

</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.zc-mobile-toggle');
  const nav = document.querySelector('.zc-nav');
  const actions = document.querySelector('.zc-header-actions');

  if (!toggle || !nav || !actions) return;

  toggle.addEventListener('click', function () {
    toggle.classList.toggle('is-active');
    nav.classList.toggle('is-open');
    actions.classList.toggle('is-open');
  });
});
</script>

<style>
/* ================================
   Zarvel / Printly Header
================================ */

* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

/* Sticky Header */
.zc-header {
  position: sticky;
  top: 0;
  z-index: 99999;
  background: #ffffff;
}

/* Fix sticky header when logged into WordPress */
body.admin-bar .zc-header {
  top: 32px;
}

@media screen and (max-width: 782px) {
  body.admin-bar .zc-header {
    top: 46px;
  }
}

.zc-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

/* Top Bar */
.zc-topbar {
  background: #050505;
  color: #ffffff;
  font-size: 12px;
  line-height: 1;
}

.zc-topbar__inner {
  min-height: 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}

.zc-topbar__left,
.zc-topbar__right {
  display: flex;
  align-items: center;
  gap: 34px;
}

.zc-topbar a {
  color: #ffffff;
  text-decoration: none;
}

.zc-topbar a:hover {
  color: #ff6a21;
}

/* Main Header */
.zc-main-header {
  background: #ffffff;
  border-bottom: 1px solid #eeeeee;
}

.zc-main-header__inner {
  min-height: 76px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
}

/* Logo */
.zc-logo {
  color: #111111;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  line-height: 1;
  flex-shrink: 0;
}

.zc-logo__main {
  font-size: 28px;
  font-weight: 900;
  letter-spacing: -1.5px;
}

.zc-logo__sub {
  margin-top: 6px;
  font-size: 8px;
  font-weight: 800;
  letter-spacing: 1.3px;
}

/* Navigation */
.zc-nav {
  display: flex;
  align-items: center;
  gap: 36px;
}

.zc-nav-link {
  color: #111111;
  text-decoration: none;
  font-size: 13px;
  font-weight: 800;
  letter-spacing: 0.2px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  line-height: 1;
}

.zc-nav-link:hover {
  color: #ff6a21;
}

.zc-chevron {
  display: block;
  margin-top: 1px;
  transition: transform 0.2s ease;
}

/* Dropdown */
.zc-nav-item {
  position: relative;
}

.zc-dropdown {
  position: absolute;
  top: calc(100% + 18px);
  left: 0;
  width: 200px;
  background: #ffffff;
  border: 1px solid #eeeeee;
  box-shadow: 0 18px 45px rgba(0, 0, 0, 0.14);
  border-radius: 12px;
  padding: 10px;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transform: translateY(14px) scale(0.98);
  transform-origin: top left;
  transition:
    opacity 0.22s ease,
    visibility 0.22s ease,
    transform 0.22s ease;
  z-index: 999999;
}

.zc-dropdown::before {
  content: "";
  position: absolute;
  top: -22px;
  left: 0;
  width: 100%;
  height: 22px;
}

.zc-dropdown a {
  display: block;
  color: #111111;
  text-decoration: none;
  font-size: 13px;
  font-weight: 700;
  padding: 12px 14px;
  border-radius: 8px;
  opacity: 0;
  transform: translateY(6px);
  transition:
    opacity 0.2s ease,
    transform 0.2s ease,
    background 0.2s ease,
    color 0.2s ease,
    padding-left 0.2s ease;
}

.zc-dropdown a:hover {
  background: #fff0e8;
  color: #ff6a21;
  padding-left: 18px;
}

.zc-has-dropdown:hover .zc-dropdown,
.zc-has-dropdown:focus-within .zc-dropdown {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
  transform: translateY(0) scale(1);
}

.zc-has-dropdown:hover .zc-dropdown a,
.zc-has-dropdown:focus-within .zc-dropdown a {
  opacity: 1;
  transform: translateY(0);
}

.zc-has-dropdown:hover .zc-dropdown a:nth-child(1) {
  transition-delay: 0.04s;
}

.zc-has-dropdown:hover .zc-dropdown a:nth-child(2) {
  transition-delay: 0.07s;
}

.zc-has-dropdown:hover .zc-dropdown a:nth-child(3) {
  transition-delay: 0.1s;
}

.zc-has-dropdown:hover .zc-dropdown a:nth-child(4) {
  transition-delay: 0.13s;
}

.zc-has-dropdown:hover .zc-dropdown a:nth-child(5) {
  transition-delay: 0.16s;
}

.zc-has-dropdown:hover .zc-chevron,
.zc-has-dropdown:focus-within .zc-chevron {
  transform: rotate(180deg);
}

/* Right Actions */
.zc-header-actions {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-shrink: 0;
}

.zc-icon-link,
.zc-cart-link {
  color: #111111;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.zc-icon-link:hover,
.zc-cart-link:hover {
  color: #ff6a21;
}

.zc-cart-count {
  position: absolute;
  top: -9px;
  right: -10px;
  min-width: 17px;
  height: 17px;
  padding: 0 5px;
  border-radius: 999px;
  background: #ff6a21;
  color: #ffffff;
  font-size: 10px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-customize-btn {
  background: #ff6a21;
  color: #ffffff;
  text-decoration: none;
  border-radius: 6px;
  padding: 16px 28px;
  font-size: 12px;
  font-weight: 900;
  letter-spacing: 0.2px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s ease;
  white-space: nowrap;
}

.zc-customize-btn:hover {
  background: #e95713;
  color: #ffffff;
}

/* Mobile Button */
.zc-mobile-toggle {
  display: none;
  width: 34px;
  height: 28px;
  padding: 0;
  background: transparent;
  border: 0;
  cursor: pointer;
}

.zc-mobile-toggle span {
  display: block;
  width: 100%;
  height: 3px;
  background: #111111;
  margin: 6px 0;
  border-radius: 999px;
  transition: 0.2s ease;
}

/* Hide START CUSTOMIZING from 769px to 1024px */
@media screen and (min-width: 769px) and (max-width: 1024px) {
  .zc-customize-btn {
    display: none;
  }

  .zc-nav {
    gap: 26px;
  }

  .zc-header-actions {
    gap: 16px;
  }

  .zc-main-header__inner {
    gap: 24px;
  }
}

/* Hamburger starts at 768px */
@media screen and (max-width: 768px) {
  .zc-container {
    width: min(100% - 30px, 1280px);
  }

  .zc-topbar__inner {
    min-height: auto;
    padding: 10px 0;
    flex-direction: column;
    gap: 8px;
    text-align: center;
  }

  .zc-topbar__left,
  .zc-topbar__right {
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
  }

  .zc-main-header__inner {
    min-height: 68px;
    gap: 15px;
    flex-wrap: wrap;
  }

  .zc-logo__main {
    font-size: 24px;
  }

  .zc-mobile-toggle {
    display: block;
    margin-left: auto;
  }

  .zc-nav,
  .zc-header-actions {
    display: none;
    width: 100%;
  }

  .zc-nav.is-open {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
    padding: 18px 0 5px;
    border-top: 1px solid #eeeeee;
  }

  .zc-nav.is-open .zc-nav-link {
    width: 100%;
    padding: 14px 0;
    justify-content: space-between;
  }

  .zc-nav-item {
    width: 100%;
  }

  .zc-dropdown {
    position: static;
    width: 100%;
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: none;
    box-shadow: none;
    border: 0;
    border-radius: 0;
    padding: 0 0 8px 14px;
    display: block;
  }

  .zc-dropdown::before {
    display: none;
  }

  .zc-dropdown a {
    opacity: 1;
    transform: none;
    padding: 10px 0;
    font-size: 13px;
  }

  .zc-dropdown a:hover {
    padding-left: 0;
  }

  .zc-header-actions.is-open {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    padding: 10px 0 20px;
  }

  .zc-customize-btn {
    width: 100%;
    padding: 15px 20px;
  }

  .zc-mobile-toggle.is-active span:nth-child(1) {
    transform: translateY(9px) rotate(45deg);
  }

  .zc-mobile-toggle.is-active span:nth-child(2) {
    opacity: 0;
  }

  .zc-mobile-toggle.is-active span:nth-child(3) {
    transform: translateY(-9px) rotate(-45deg);
  }
}
</style>