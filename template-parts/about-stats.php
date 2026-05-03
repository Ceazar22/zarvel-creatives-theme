<?php
defined('ABSPATH') || exit;
?>

<section class="zc-about-stats">
  <div class="zc-about-stats__container">

    <div class="zc-about-stats__box">

      <div class="zc-about-stat">
        <span class="zc-about-stat__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M9 4l3 2 3-2 4 2.5-2 4-2-1v10H9v-10l-2 1-2-4L9 4z"></path>
          </svg>
        </span>

        <strong>50K+</strong>
        <span>Products Printed</span>
      </div>

      <div class="zc-about-stat">
        <span class="zc-about-stat__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="8"></circle>
            <path d="M8.8 12.2l2.1 2.1 4.5-5"></path>
          </svg>
        </span>

        <strong>20K+</strong>
        <span>Happy Customers</span>
      </div>

      <div class="zc-about-stat">
        <span class="zc-about-stat__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M3 12h18"></path>
            <path d="M12 3c2.5 2.5 3.8 5.5 3.8 9S14.5 18.5 12 21"></path>
            <path d="M12 3c-2.5 2.5-3.8 5.5-3.8 9S9.5 18.5 12 21"></path>
          </svg>
        </span>

        <strong>30+</strong>
        <span>Countries Served</span>
      </div>

      <div class="zc-about-stat">
        <span class="zc-about-stat__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.2 6.4 20.2 7.5 14 3 9.6l6.2-.9L12 3z"></path>
          </svg>
        </span>

        <strong>4.9/5</strong>
        <span>Average Rating</span>
      </div>

    </div>

  </div>
</section>

<style>
.zc-about-stats {
  width: 100%;
  padding: 48px 0 78px;
  background: #ffffff;
}

.zc-about-stats__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-about-stats__box {
  width: 100%;
  min-height: 112px;
  padding: 22px 26px;
  border-radius: 7px;
  background:
    linear-gradient(90deg, rgba(0, 0, 0, 0.96), rgba(0, 0, 0, 0.9)),
    repeating-linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.06) 0,
      rgba(255, 255, 255, 0.06) 1px,
      transparent 1px,
      transparent 9px
    );
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  align-items: center;
  box-shadow: 0 18px 36px rgba(0, 0, 0, 0.12);
}

.zc-about-stat {
  min-height: 72px;
  padding: 0 26px;
  text-align: center;
  border-right: 1px solid rgba(255, 255, 255, 0.12);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.zc-about-stat:last-child {
  border-right: 0;
}

.zc-about-stat__icon {
  width: 27px;
  height: 27px;
  margin-bottom: 8px;
  color: #ff5b1a;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-about-stat__icon svg {
  width: 100%;
  height: 100%;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-about-stat strong {
  margin-bottom: 4px;
  color: #ffffff;
  font-size: 24px;
  line-height: 1;
  font-weight: 950;
}

.zc-about-stat span:not(.zc-about-stat__icon) {
  color: rgba(255, 255, 255, 0.72);
  font-size: 11px;
  line-height: 1.2;
  font-weight: 800;
}

@media screen and (max-width: 900px) {
  .zc-about-stats__box {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    padding: 10px 20px;
  }

  .zc-about-stat {
    padding: 24px 18px;
    border-right: 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
  }

  .zc-about-stat:nth-child(3),
  .zc-about-stat:nth-child(4) {
    border-bottom: 0;
  }
}

@media screen and (max-width: 560px) {
  .zc-about-stats {
    padding: 36px 0 62px;
  }

  .zc-about-stats__container {
    width: min(100% - 30px, 1120px);
  }

  .zc-about-stats__box {
    grid-template-columns: 1fr;
  }

  .zc-about-stat {
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
  }

  .zc-about-stat:nth-child(3) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
  }

  .zc-about-stat:last-child {
    border-bottom: 0;
  }
}
</style>