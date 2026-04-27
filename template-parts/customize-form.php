<?php
defined('ABSPATH') || exit;
?>

<section class="zc-customize-builder">
  <div class="zc-customize-builder__container">

    <div class="zc-customize-step">
      <h2 class="zc-customize-step__title">
        <span>1.</span> Choose Your Product Type
      </h2>

      <div class="zc-product-type-grid">

        <label class="zc-product-type-card">
          <input type="radio" name="zc_product_type_card" value="T-Shirts" checked>
          <span class="zc-product-type-card__inner">
            <span class="zc-product-type-card__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 4l3 2 3-2 4 2.5-2 4-2-1v10H9v-10l-2 1-2-4L9 4z"></path>
              </svg>
            </span>
            <strong>T-Shirts</strong>
          </span>
        </label>

        <label class="zc-product-type-card">
          <input type="radio" name="zc_product_type_card" value="Hoodies">
          <span class="zc-product-type-card__inner">
            <span class="zc-product-type-card__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8 8V6a4 4 0 0 1 8 0v2"></path>
                <path d="M7 8h10l2 4v8H5v-8l2-4z"></path>
                <path d="M9 13v7"></path>
                <path d="M15 13v7"></path>
              </svg>
            </span>
            <strong>Hoodies</strong>
          </span>
        </label>

        <label class="zc-product-type-card">
          <input type="radio" name="zc_product_type_card" value="Mugs">
          <span class="zc-product-type-card__inner">
            <span class="zc-product-type-card__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 7h11v9a4 4 0 0 1-4 4H9a4 4 0 0 1-4-4V7z"></path>
                <path d="M16 9h2a3 3 0 0 1 0 6h-2"></path>
              </svg>
            </span>
            <strong>Mugs</strong>
          </span>
        </label>

        <label class="zc-product-type-card">
          <input type="radio" name="zc_product_type_card" value="Tote Bags">
          <span class="zc-product-type-card__inner">
            <span class="zc-product-type-card__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 9h12l1 11H5L6 9z"></path>
                <path d="M9 9V7a3 3 0 0 1 6 0v2"></path>
              </svg>
            </span>
            <strong>Tote Bags</strong>
          </span>
        </label>

        <label class="zc-product-type-card">
          <input type="radio" name="zc_product_type_card" value="Phone Cases">
          <span class="zc-product-type-card__inner">
            <span class="zc-product-type-card__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="7" y="3" width="10" height="18" rx="2"></rect>
                <path d="M11 18h2"></path>
              </svg>
            </span>
            <strong>Phone Cases</strong>
          </span>
        </label>

      </div>
    </div>

    <div class="zc-customize-step zc-customize-step--form">
      <h2 class="zc-customize-step__title">
        <span>2.</span> Submit Your Design Request
      </h2>

      <form class="zc-design-request-form" method="post" enctype="multipart/form-data">

        <div class="zc-design-request-form__grid">

          <div class="zc-design-request-form__left">

            <div class="zc-form-field">
              <label for="zc_full_name">Full Name <span>*</span></label>
              <input id="zc_full_name" type="text" name="full_name" placeholder="Enter your full name">
            </div>

            <div class="zc-form-field">
              <label for="zc_email">Email Address <span>*</span></label>
              <input id="zc_email" type="email" name="email" placeholder="Enter your email address">
            </div>

            <div class="zc-form-field">
              <label for="zc_phone">Phone Number Optional</label>
              <input id="zc_phone" type="text" name="phone" placeholder="Enter your phone number">
            </div>

            <div class="zc-form-field">
              <label for="zc_product_type">Product Type <span>*</span></label>
              <select id="zc_product_type" name="product_type">
                <option value="">Select product type</option>
                <option value="T-Shirts" selected>T-Shirts</option>
                <option value="Hoodies">Hoodies</option>
                <option value="Mugs">Mugs</option>
                <option value="Tote Bags">Tote Bags</option>
                <option value="Phone Cases">Phone Cases</option>
              </select>
            </div>

            <div class="zc-form-row">
              <div class="zc-form-field">
                <label for="zc_color">Preferred Color</label>
                <select id="zc_color" name="preferred_color">
                  <option value="">Select color</option>
                  <option value="Black">Black</option>
                  <option value="White">White</option>
                  <option value="Red">Red</option>
                  <option value="Blue">Blue</option>
                  <option value="Gray">Gray</option>
                  <option value="Other">Other</option>
                </select>
              </div>

              <div class="zc-form-field">
                <label for="zc_size">Preferred Size</label>
                <select id="zc_size" name="preferred_size">
                  <option value="">Select size</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="2XL">2XL</option>
                  <option value="3XL">3XL</option>
                  <option value="Not Applicable">Not Applicable</option>
                </select>
              </div>
            </div>

          </div>

          <div class="zc-design-request-form__right">

            <div class="zc-form-field">
              <label for="zc_upload_file">Upload Logo / Artwork <span>*</span></label>

              <label class="zc-upload-box" for="zc_upload_file">
                <input id="zc_upload_file" type="file" name="upload_file" accept=".jpg,.jpeg,.png,.pdf,.ai,.svg">

                <span class="zc-upload-box__icon">
                  <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 16V4"></path>
                    <path d="M7 9l5-5 5 5"></path>
                    <path d="M5 20h14"></path>
                  </svg>
                </span>

                <strong>Drag and drop your file here</strong>
                <em>or</em>
                <span class="zc-upload-box__button">Choose File</span>
                <small id="zcUploadFileName">Supports: PNG, JPG, SVG, AI, PDF. Max 20MB</small>
              </label>
            </div>

            <div class="zc-form-field">
              <label for="zc_design_notes">Design Instructions <span>*</span></label>
              <textarea id="zc_design_notes" name="design_notes" rows="5" placeholder="Tell us about your design idea, placement, colors, text, style, or anything important..."></textarea>
            </div>

            <div class="zc-form-field">
              <label for="zc_deadline">Deadline Optional</label>
              <input id="zc_deadline" type="date" name="deadline">
            </div>

          </div>

        </div>

        <div class="zc-design-request-form__footer">
          <button type="submit" class="zc-design-request-form__submit">
            Send Design Request
          </button>

          <p>
            We respect your privacy. Your information will only be used to process your request.
          </p>
        </div>

      </form>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const productCards = document.querySelectorAll('input[name="zc_product_type_card"]');
  const productSelect = document.querySelector('#zc_product_type');
  const fileInput = document.querySelector('#zc_upload_file');
  const fileName = document.querySelector('#zcUploadFileName');

  productCards.forEach(function (card) {
    card.addEventListener('change', function () {
      if (!productSelect) return;

      productSelect.value = card.value;
    });
  });

  if (productSelect) {
    productSelect.addEventListener('change', function () {
      productCards.forEach(function (card) {
        card.checked = card.value === productSelect.value;
      });
    });
  }

  if (fileInput && fileName) {
    fileInput.addEventListener('change', function () {
      if (fileInput.files && fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
      } else {
        fileName.textContent = 'Supports: PNG, JPG, SVG, AI, PDF. Max 20MB';
      }
    });
  }
});
</script>

<style>
.zc-customize-builder {
  padding: 42px 0 90px;
  background: #ffffff;
}

.zc-customize-builder__container {
  width: min(100% - 40px, 1120px);
  margin: 0 auto;
}

.zc-customize-step {
  margin-bottom: 30px;
}

.zc-customize-step__title {
  margin: 0 0 18px;
  color: #111111;
  font-size: 15px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.2px;
}

.zc-customize-step__title span {
  color: #111111;
}

.zc-product-type-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: 14px;
}

.zc-product-type-card {
  cursor: pointer;
}

.zc-product-type-card input {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

.zc-product-type-card__inner {
  min-height: 126px;
  padding: 18px 12px;
  border: 1px solid #e8e8e8;
  border-radius: 10px;
  background: #ffffff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 13px;
  transition: 0.2s ease;
}

.zc-product-type-card__icon {
  width: 42px;
  height: 42px;
  color: #111111;
  display: flex;
  align-items: center;
  justify-content: center;
}

.zc-product-type-card__icon svg {
  width: 100%;
  height: 100%;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.7;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-product-type-card strong {
  color: #111111;
  font-size: 13px;
  line-height: 1;
  font-weight: 900;
  text-align: center;
}

.zc-product-type-card input:checked + .zc-product-type-card__inner,
.zc-product-type-card__inner:hover {
  border-color: #ff5b1a;
  background: #fff6f1;
  box-shadow: 0 12px 28px rgba(255, 91, 26, 0.08);
}

.zc-customize-step--form {
  margin-bottom: 0;
}

.zc-design-request-form {
  padding: 26px;
  border: 1px solid #e9e9e9;
  border-radius: 12px;
  background: #ffffff;
}

.zc-design-request-form__grid {
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  gap: 26px;
}

.zc-form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.zc-form-field {
  margin-bottom: 16px;
}

.zc-form-field label {
  display: block;
  margin-bottom: 7px;
  color: #111111;
  font-size: 11px;
  line-height: 1;
  font-weight: 950;
}

.zc-form-field label span {
  color: #ff5b1a;
}

.zc-form-field input,
.zc-form-field select,
.zc-form-field textarea {
  width: 100%;
  border: 1px solid #dddddd;
  border-radius: 7px;
  background: #ffffff;
  color: #111111;
  font-size: 13px;
  line-height: 1.2;
  font-weight: 650;
  outline: none;
  transition: 0.2s ease;
}

.zc-form-field input,
.zc-form-field select {
  height: 42px;
  padding: 0 12px;
}

.zc-form-field textarea {
  padding: 12px;
  resize: vertical;
}

.zc-form-field input:focus,
.zc-form-field select:focus,
.zc-form-field textarea:focus {
  border-color: #ff5b1a;
  box-shadow: 0 0 0 3px rgba(255, 91, 26, 0.08);
}

.zc-upload-box {
  min-height: 178px;
  padding: 22px;
  border: 1px dashed #cccccc;
  border-radius: 10px;
  background: #fbfbfb;
  cursor: pointer;
  display: flex !important;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  transition: 0.2s ease;
}

.zc-upload-box:hover {
  border-color: #ff5b1a;
  background: #fff6f1;
}

.zc-upload-box input {
  display: none;
}

.zc-upload-box__icon {
  width: 36px;
  height: 36px;
  margin-bottom: 8px;
  color: #111111;
}

.zc-upload-box__icon svg {
  width: 100%;
  height: 100%;
  fill: none;
  stroke: currentColor;
  stroke-width: 1.8;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.zc-upload-box strong {
  color: #111111;
  font-size: 13px;
  line-height: 1.3;
  font-weight: 850;
}

.zc-upload-box em {
  margin: 5px 0;
  color: #777777;
  font-size: 12px;
  font-style: normal;
  font-weight: 700;
}

.zc-upload-box__button {
  min-height: 34px;
  padding: 0 16px;
  border-radius: 6px;
  background: #111111;
  color: #ffffff;
  font-size: 11px;
  font-weight: 950;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.zc-upload-box small {
  margin-top: 10px;
  color: #777777;
  font-size: 11px;
  line-height: 1.35;
  font-weight: 650;
}

.zc-design-request-form__footer {
  margin-top: 6px;
  text-align: center;
}

.zc-design-request-form__submit {
  width: min(100%, 360px);
  min-height: 44px;
  border: 0;
  border-radius: 6px;
  background: #ff5b1a;
  color: #ffffff;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
  cursor: pointer;
  transition: 0.2s ease;
}

.zc-design-request-form__submit:hover {
  background: #111111;
}

.zc-design-request-form__footer p {
  margin: 12px 0 0;
  color: #777777;
  font-size: 11px;
  line-height: 1.4;
  font-weight: 650;
}

@media screen and (max-width: 1024px) {
  .zc-product-type-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }

  .zc-design-request-form__grid {
    grid-template-columns: 1fr;
    gap: 4px;
  }
}

@media screen and (max-width: 768px) {
  .zc-customize-builder {
    padding: 34px 0 70px;
  }

  .zc-customize-builder__container {
    width: min(100% - 30px, 1120px);
  }

  .zc-product-type-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .zc-design-request-form {
    padding: 20px 16px;
  }

  .zc-form-row {
    grid-template-columns: 1fr;
    gap: 0;
  }
}

@media screen and (max-width: 480px) {
  .zc-product-type-grid {
    grid-template-columns: 1fr;
  }

  .zc-product-type-card__inner {
    min-height: 110px;
  }
}
</style>