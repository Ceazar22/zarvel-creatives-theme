<section class="zc-how-section">
  <div class="zc-how-container">

    <h2 class="zc-how-title">HOW IT WORKS</h2>

    <div class="zc-how-steps">

      <!-- Step 1 -->
      <div class="zc-how-step">
        <div class="zc-how-icon-wrap">
          <span class="zc-how-number">1</span>

          <div class="zc-how-icon">
            <svg viewBox="0 0 64 64" aria-hidden="true">
              <path d="M20 18l8-5h8l8 5 8 5-6 10-6-3v22H24V30l-6 3-6-10 8-5z"/>
              <path d="M28 13c1 3 3 5 4 5s3-2 4-5"/>
            </svg>
          </div>
        </div>

        <div class="zc-how-content">
          <h3>Send Us Your Logo</h3>
          <p>
            Upload or send your logo, artwork, or idea. We’ll help prepare it for printing.
          </p>
        </div>
      </div>

      <div class="zc-how-arrow" aria-hidden="true">
        <svg viewBox="0 0 120 40">
          <path d="M5 28C35 2 78 2 108 24"/>
          <path d="M101 14l10 11-15 3"/>
        </svg>
      </div>

      <!-- Step 2 -->
      <div class="zc-how-step">
        <div class="zc-how-icon-wrap">
          <span class="zc-how-number">2</span>

          <div class="zc-how-icon">
            <svg viewBox="0 0 64 64" aria-hidden="true">
              <rect x="13" y="14" width="38" height="36" rx="4"/>
              <path d="M20 42l10-11 8 8 5-6 8 9"/>
              <circle cx="25" cy="25" r="4"/>
            </svg>
          </div>
        </div>

        <div class="zc-how-content">
          <h3>We Create the Mockup</h3>
          <p>
            Our team places your design on the product and sends a preview before production.
          </p>
        </div>
      </div>

      <div class="zc-how-arrow" aria-hidden="true">
        <svg viewBox="0 0 120 40">
          <path d="M5 28C35 2 78 2 108 24"/>
          <path d="M101 14l10 11-15 3"/>
        </svg>
      </div>

      <!-- Step 3 -->
      <div class="zc-how-step">
        <div class="zc-how-icon-wrap">
          <span class="zc-how-number">3</span>

          <div class="zc-how-icon">
            <svg viewBox="0 0 64 64" aria-hidden="true">
              <path d="M16 24l16-8 16 8-16 8-16-8z"/>
              <path d="M16 24v18l16 8 16-8V24"/>
              <path d="M32 32v18"/>
              <path d="M24 20l16 8"/>
            </svg>
          </div>
        </div>

        <div class="zc-how-content">
          <h3>We Print & Ship</h3>
          <p>
            Once approved, we print your order and ship it straight to your doorstep.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<style>
.zc-how-section {
  padding: 35px 0 70px;
  background: #ffffff;
}

.zc-how-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  padding: 26px 55px 30px;
  border-radius: 16px;
  background:
    radial-gradient(circle at 10% 20%, rgba(255, 91, 26, 0.07), transparent 28%),
    linear-gradient(90deg, #fffaf5 0%, #ffffff 48%, #fff7f1 100%);
  box-shadow: 0 10px 35px rgba(0, 0, 0, 0.04);
}

.zc-how-title {
  margin: 0 0 22px;
  color: #111111;
  font-size: 34px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.5px;
}

.zc-how-steps {
  display: grid;
  grid-template-columns: 1fr 110px 1fr 110px 1fr;
  align-items: center;
  gap: 18px;
}

.zc-how-step {
  display: grid;
  grid-template-columns: 82px 1fr;
  align-items: center;
  gap: 18px;
}

.zc-how-icon-wrap {
  position: relative;
  width: 82px;
  height: 82px;
}

.zc-how-number {
  position: absolute;
  top: -4px;
  left: -4px;
  z-index: 2;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: #050505;
  color: #ffffff;
  font-size: 14px;
  line-height: 1;
  font-weight: 900;
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-how-icon {
  width: 82px;
  height: 82px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-how-icon svg {
  width: 48px;
  height: 48px;
  fill: none;
  stroke: #111111;
  stroke-width: 2.3;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-how-content h3 {
  margin: 0 0 8px;
  color: #111111;
  font-size: 18px;
  line-height: 1.15;
  font-weight: 900;
}

.zc-how-content p {
  margin: 0;
  max-width: 260px;
  color: #333333;
  font-size: 14px;
  line-height: 1.45;
  font-weight: 500;
}

.zc-how-arrow {
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-how-arrow svg {
  width: 108px;
  height: 42px;
  fill: none;
  stroke: #111111;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-how-arrow path:first-child {
  stroke-dasharray: 4 6;
}

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-how-container {
    padding: 32px 28px;
  }

  .zc-how-steps {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .zc-how-step {
    max-width: 520px;
    width: 100%;
    margin: 0 auto;
  }

  .zc-how-arrow {
    transform: rotate(90deg);
    height: 40px;
  }
}

/* 768 */
@media screen and (max-width: 768px) {
  .zc-how-section {
    padding: 30px 0 55px;
  }

  .zc-how-container {
    width: min(100% - 30px, 1280px);
    padding: 28px 22px;
  }

  .zc-how-title {
    font-size: 28px;
  }

  .zc-how-step {
    grid-template-columns: 68px 1fr;
    gap: 16px;
  }

  .zc-how-icon-wrap,
  .zc-how-icon {
    width: 68px;
    height: 68px;
  }

  .zc-how-icon svg {
    width: 40px;
    height: 40px;
  }

  .zc-how-number {
    width: 26px;
    height: 26px;
    font-size: 12px;
  }

  .zc-how-content h3 {
    font-size: 16px;
  }

  .zc-how-content p {
    font-size: 13px;
  }
}

/* 480 */
@media screen and (max-width: 480px) {
  .zc-how-step {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .zc-how-icon-wrap {
    margin: 0 auto;
  }

  .zc-how-content p {
    margin: 0 auto;
  }
}
</style>