<section class="zc-why-love-section">
  <div class="zc-why-love-container">

    <h2 class="zc-why-love-title">WHY CUSTOMERS LOVE US</h2>

    <div class="zc-why-love-grid">

      <div class="zc-why-love-item">
        <div class="zc-why-love-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z"></path>
            <path d="M9 12l2 2 4-5"></path>
          </svg>
        </div>

        <div class="zc-why-love-content">
          <h3>Premium Print Quality</h3>
          <p>We use top-quality materials and inks.</p>
        </div>
      </div>

      <div class="zc-why-love-item">
        <div class="zc-why-love-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 3v3"></path>
            <path d="M12 18v3"></path>
            <path d="M3 12h3"></path>
            <path d="M18 12h3"></path>
            <path d="M5.6 5.6l2.1 2.1"></path>
            <path d="M16.3 16.3l2.1 2.1"></path>
            <path d="M18.4 5.6l-2.1 2.1"></path>
            <path d="M7.7 16.3l-2.1 2.1"></path>
            <circle cx="12" cy="12" r="4"></circle>
          </svg>
        </div>

        <div class="zc-why-love-content">
          <h3>Made Only When Ordered</h3>
          <p>No overproduction. Eco-friendly and sustainable.</p>
        </div>
      </div>

      <div class="zc-why-love-item">
        <div class="zc-why-love-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 3l8 4v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"></path>
            <path d="M8 12h8"></path>
            <path d="M12 8v8"></path>
          </svg>
        </div>

        <div class="zc-why-love-content">
          <h3>No Minimum Quantity</h3>
          <p>Order 1 or 1000. We’ve got you.</p>
        </div>
      </div>

      <div class="zc-why-love-item">
        <div class="zc-why-love-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 7h11v9H3z"></path>
            <path d="M14 10h4l3 3v3h-7z"></path>
            <circle cx="7" cy="18" r="2"></circle>
            <circle cx="18" cy="18" r="2"></circle>
          </svg>
        </div>

        <div class="zc-why-love-content">
          <h3>Fast & Reliable Production</h3>
          <p>Quick turnaround with careful quality control.</p>
        </div>
      </div>

      <div class="zc-why-love-item">
        <div class="zc-why-love-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M20 12v9H4v-9"></path>
            <path d="M2 7h20v5H2z"></path>
            <path d="M12 7v14"></path>
            <path d="M12 7H8.5A2.5 2.5 0 1 1 11 4.5V7z"></path>
            <path d="M12 7h3.5A2.5 2.5 0 1 0 13 4.5V7z"></path>
          </svg>
        </div>

        <div class="zc-why-love-content">
          <h3>Perfect for Gifts & Brands</h3>
          <p>Great for any occasion, personal or business.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<style>
.zc-why-love-section {
  padding: 20px 0 75px;
  background: #ffffff;
}

.zc-why-love-container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
  padding: 26px 34px 32px;
  border-radius: 14px;
  background:
    radial-gradient(circle at 50% 0%, rgba(255, 91, 26, 0.05), transparent 32%),
    linear-gradient(90deg, #fffaf5 0%, #ffffff 50%, #fff8f2 100%);
  box-shadow: 0 10px 35px rgba(0, 0, 0, 0.04);
}

.zc-why-love-title {
  margin: 0 0 22px;
  color: #111111;
  font-size: 24px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.3px;
}

.zc-why-love-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: 24px;
}

.zc-why-love-item {
  display: grid;
  grid-template-columns: 42px 1fr;
  align-items: flex-start;
  gap: 12px;
}

.zc-why-love-icon {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid #dcdcdc;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #111111;
  flex-shrink: 0;
}

.zc-why-love-icon svg {
  width: 21px;
  height: 21px;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.9;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-why-love-content h3 {
  margin: 0 0 5px;
  color: #111111;
  font-size: 13px;
  line-height: 1.15;
  font-weight: 950;
}

.zc-why-love-content p {
  margin: 0;
  color: #333333;
  font-size: 11px;
  line-height: 1.35;
  font-weight: 600;
}

/* 1024 */
@media screen and (max-width: 1024px) {
  .zc-why-love-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

/* 768 */
@media screen and (max-width: 768px) {
  .zc-why-love-section {
    padding: 15px 0 55px;
  }

  .zc-why-love-container {
    width: min(100% - 30px, 1280px);
    padding: 28px 22px;
  }

  .zc-why-love-title {
    font-size: 22px;
  }

  .zc-why-love-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
  }
}

/* 480 */
@media screen and (max-width: 480px) {
  .zc-why-love-grid {
    grid-template-columns: 1fr;
  }

  .zc-why-love-item {
    grid-template-columns: 38px 1fr;
  }
}
</style>