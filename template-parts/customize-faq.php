<?php
defined('ABSPATH') || exit;
?>

<section class="zc-customize-faq">
  <div class="zc-customize-faq__container">

    <h2 class="zc-customize-faq__title">
      <span>4.</span> Questions? We’ve Got Answers
    </h2>

    <div class="zc-customize-faq__grid">

      <div class="zc-customize-faq__column">

        <details class="zc-customize-faq__item">
          <summary>
            <span>Can I upload my own logo or design?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            Yes. You can upload your logo, artwork, or design file using the form above. We accept JPG, PNG, and PDF files.
          </div>
        </details>

        <details class="zc-customize-faq__item">
          <summary>
            <span>Do I see the design before printing?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            Yes. We will review your request and send a digital proof or mockup before anything goes to print.
          </div>
        </details>

        <details class="zc-customize-faq__item">
          <summary>
            <span>Can I order one piece only?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            Yes. You can order one custom item. No minimum order is required.
          </div>
        </details>

      </div>

      <div class="zc-customize-faq__column">

        <details class="zc-customize-faq__item">
          <summary>
            <span>How long does production take?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            Production usually starts after the design is approved. Timing may vary depending on the product and order details.
          </div>
        </details>

        <details class="zc-customize-faq__item">
          <summary>
            <span>What file types do you accept?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            For now, we accept JPG, PNG, and PDF files. If you have another file type, mention it in the design instructions.
          </div>
        </details>

        <details class="zc-customize-faq__item">
          <summary>
            <span>Can I request revisions to the mockup?</span>
            <em>+</em>
          </summary>

          <div class="zc-customize-faq__answer">
            Yes. Small revisions are okay. Major redesigns may require an additional design fee depending on the request.
          </div>
        </details>

      </div>

    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const faqItems = document.querySelectorAll('.zc-customize-faq__item');

  faqItems.forEach(function (item) {
    item.addEventListener('toggle', function () {
      if (!item.open) return;

      faqItems.forEach(function (otherItem) {
        if (otherItem !== item) {
          otherItem.removeAttribute('open');
        }
      });
    });
  });
});
</script>

<style>
.zc-customize-faq {
  padding: 20px 0 90px;
  background: #ffffff;
}

.zc-customize-faq__container {
  width: min(100% - 40px, 1120px);
  margin: 0 auto;
}

.zc-customize-faq__title {
  margin: 0 0 22px;
  color: #111111;
  font-size: 17px;
  line-height: 1;
  font-weight: 950;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: -0.2px;
}

.zc-customize-faq__title span {
  color: #111111;
}

.zc-customize-faq__grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
}

.zc-customize-faq__column {
  display: grid;
  gap: 10px;
}

.zc-customize-faq__item {
  border: 1px solid #e7e7e7;
  border-radius: 8px;
  background: #ffffff;
  overflow: hidden;
  transition: 0.2s ease;
}

.zc-customize-faq__item[open] {
  border-color: #ff5b1a;
  background: #fff8f4;
  box-shadow: 0 12px 28px rgba(255, 91, 26, 0.08);
}

.zc-customize-faq__item summary {
  min-height: 46px;
  padding: 0 16px;
  color: #111111;
  font-size: 13px;
  line-height: 1.25;
  font-weight: 900;
  cursor: pointer;
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
}

.zc-customize-faq__item summary::-webkit-details-marker {
  display: none;
}

.zc-customize-faq__item summary em {
  width: 22px;
  height: 22px;
  min-width: 22px;
  border-radius: 50%;
  color: #111111;
  font-size: 16px;
  line-height: 1;
  font-style: normal;
  font-weight: 900;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s ease;
}

.zc-customize-faq__item[open] summary em {
  transform: rotate(45deg);
  color: #ff5b1a;
}

.zc-customize-faq__answer {
  padding: 0 16px 16px;
  color: #555555;
  font-size: 13px;
  line-height: 1.55;
  font-weight: 650;
}

@media screen and (max-width: 768px) {
  .zc-customize-faq {
    padding: 10px 0 70px;
  }

  .zc-customize-faq__container {
    width: min(100% - 30px, 1120px);
  }

  .zc-customize-faq__grid {
    grid-template-columns: 1fr;
  }

  .zc-customize-faq__title {
    font-size: 15px;
  }
}
</style>