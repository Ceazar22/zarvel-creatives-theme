<?php
defined('ABSPATH') || exit;
?>

<section class="zc-about-trust-bar">
  <div class="zc-about-trust-bar__container">

    <div class="zc-about-trust-item">
      <span class="zc-about-trust-item__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 3l2.1 2.1 3-.3 1.1 2.8 2.6 1.5-.9 2.9.9 2.9-2.6 1.5-1.1 2.8-3-.3L12 21l-2.1-2.1-3 .3-1.1-2.8-2.6-1.5.9-2.9-.9-2.9 2.6-1.5 1.1-2.8 3 .3L12 3z"></path>
          <path d="M9 12l2 2 4-5"></path>
        </svg>
      </span>

      <span class="zc-about-trust-item__text">
        Premium Quality<br>
        Prints
      </span>
    </div>

    <div class="zc-about-trust-item">
      <span class="zc-about-trust-item__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 3l7 4v6c0 4.5-2.8 7.3-7 8-4.2-.7-7-3.5-7-8V7l7-4z"></path>
          <path d="M8.5 12h7"></path>
          <path d="M12 8.5v7"></path>
        </svg>
      </span>

      <span class="zc-about-trust-item__text">
        Made Only<br>
        When Ordered
      </span>
    </div>

    <div class="zc-about-trust-item">
      <span class="zc-about-trust-item__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M3 7h11v9H3z"></path>
          <path d="M14 10h4l3 3v3h-7z"></path>
          <circle cx="7" cy="18" r="2"></circle>
          <circle cx="18" cy="18" r="2"></circle>
        </svg>
      </span>

      <span class="zc-about-trust-item__text">
        Fast & Reliable<br>
        Shipping
      </span>
    </div>

    <div class="zc-about-trust-item">
      <span class="zc-about-trust-item__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 10l7-6 7 6v9H5z"></path>
          <path d="M9 14l2 2 4-5"></path>
        </svg>
      </span>

      <span class="zc-about-trust-item__text">
        No Minimum<br>
        Order
      </span>
    </div>

    <div class="zc-about-trust-item">
      <span class="zc-about-trust-item__icon">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="12" cy="12" r="9"></circle>
          <path d="M8.5 13.5c1.2 1.3 2.4 2 3.5 2s2.3-.7 3.5-2"></path>
          <path d="M9 10h.01"></path>
          <path d="M15 10h.01"></path>
        </svg>
      </span>

      <span class="zc-about-trust-item__text">
        Friendly<br>
        Support
      </span>
    </div>

  </div>
</section>

<style>
.zc-about-trust-bar {
  width: 100%;
  padding: 34px 0;
  background: #ffffff;
  border-top: 1px solid #f0ece8;
  border-bottom: 1px solid #f0ece8;
}

.zc-about-trust-bar__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  align-items: center;
}

.zc-about-trust-item {
  min-height: 58px;
  padding: 0 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  border-right: 1px solid #e6e1dc;
}

.zc-about-trust-item:last-child {
  border-right: 0;
}

.zc-about-trust-item__icon {
  width: 38px;
  height: 38px;
  min-width: 38px;
  color: #111111;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-about-trust-item__icon svg {
  width: 32px;
  height: 32px;
  display: block;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-about-trust-item__text {
  color: #111111;
  font-size: 17px;
  line-height: 1.18;
  font-weight: 900;
}

@media screen and (max-width: 1100px) {
  .zc-about-trust-item {
    padding: 0 20px;
  }

  .zc-about-trust-item__text {
    font-size: 15px;
  }
}

@media screen and (max-width: 900px) {
  .zc-about-trust-bar__container {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .zc-about-trust-item {
    justify-content: flex-start;
    padding: 22px 18px;
    border-right: 0;
    border-bottom: 1px solid #e6e1dc;
  }

  .zc-about-trust-item:nth-child(5) {
    border-bottom: 0;
  }
}

@media screen and (max-width: 560px) {
  .zc-about-trust-bar {
    padding: 20px 0;
  }

  .zc-about-trust-bar__container {
    width: min(100% - 30px, 1280px);
    grid-template-columns: 1fr;
  }

  .zc-about-trust-item {
    border-bottom: 1px solid #e6e1dc;
  }

  .zc-about-trust-item:last-child {
    border-bottom: 0;
  }
}
</style>