<?php
defined('ABSPATH') || exit;
?>

<section class="zc-contact-hero">
  <div class="zc-contact-hero__container">

    <nav class="zc-contact-hero__breadcrumbs" aria-label="Breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span class="zc-contact-hero__crumb-sep">›</span>
      <span aria-current="page">Contact</span>
    </nav>

    <span class="zc-contact-hero__eyebrow">We’d love to hear from you.</span>

    <h1 class="zc-contact-hero__title">Get in Touch</h1>

    <p class="zc-contact-hero__text">
      Have a question or need help? We’re here for you. Whether it’s a custom order,
      design help, bulk order, shipping question, or general support, our team will get
      back to you as soon as possible.
    </p>

  </div>
</section>

<style>
.zc-contact-hero {
  width: 100%;
  padding: 70px 0 78px;
  background: linear-gradient(90deg, #ffffff 0%, #fff8f5 100%);
  border-bottom: 1px solid #f1ece8;
  overflow: hidden;
}

.zc-contact-hero__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-contact-hero__breadcrumbs {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 26px;
  font-size: 12px;
  line-height: 1;
  font-weight: 700;
  color: #6c6c6c;
}

.zc-contact-hero__breadcrumbs a {
  color: #6c6c6c;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-contact-hero__breadcrumbs a:hover {
  color: #ff5b1a;
}

.zc-contact-hero__crumb-sep {
  color: #8f8f8f;
}

.zc-contact-hero__eyebrow {
  display: inline-block;
  margin-bottom: 14px;
  color: #ff5b1a;
  font-size: 12px;
  line-height: 1;
  font-weight: 900;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

.zc-contact-hero__title {
  margin: 0 0 18px;
  color: #111111;
  font-size: clamp(46px, 8vw, 88px);
  line-height: 0.92;
  font-weight: 900;
  text-transform: uppercase;
  letter-spacing: -1.5px;
  max-width: 720px;
}

.zc-contact-hero__text {
  max-width: 700px;
  margin: 0;
  color: #4f4f4f;
  font-size: 16px;
  line-height: 1.75;
  font-weight: 500;
}

@media screen and (max-width: 768px) {
  .zc-contact-hero {
    padding: 52px 0 58px;
  }

  .zc-contact-hero__container {
    width: min(100% - 30px, 1180px);
  }

  .zc-contact-hero__breadcrumbs {
    margin-bottom: 20px;
    gap: 8px;
    font-size: 11px;
    flex-wrap: wrap;
  }

  .zc-contact-hero__eyebrow {
    margin-bottom: 12px;
    font-size: 11px;
  }

  .zc-contact-hero__title {
    margin-bottom: 14px;
    font-size: clamp(38px, 13vw, 64px);
    letter-spacing: -1px;
  }

  .zc-contact-hero__text {
    font-size: 14px;
    line-height: 1.7;
  }
}

@media screen and (max-width: 480px) {
  .zc-contact-hero {
    padding: 44px 0 50px;
  }

  .zc-contact-hero__title {
    font-size: 42px;
  }

  .zc-contact-hero__text {
    font-size: 13.5px;
  }
}
</style>