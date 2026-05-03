<?php
defined('ABSPATH') || exit;
?>

<section class="zc-about-team">
  <div class="zc-about-team__container">

    <div class="zc-about-team__head">
      <span class="zc-about-team__kicker">The Team Behind Printly</span>

      <h2 class="zc-about-team__title">
        Real People. Real Passion.
      </h2>
    </div>

    <div class="zc-about-team__grid">

      <article class="zc-about-team-card">
        <div class="zc-about-team-card__image">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bryan.png'); ?>" alt="Bryan">
        </div>

        <h3>Bryan T.</h3>
        <span>Co-Founder & Web Dev</span>

        <p>
          Loves design, coffee, and turning ideas into reality.
        </p>

        <div class="zc-about-team-card__socials">
          <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer">f</a>
          <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer">◎</a>
          <a href="https://www.linkedin.com/in/bryan-ceazar-tabanas-0a8b83232/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">in</a>
        </div>
      </article>

      <article class="zc-about-team-card">
        <div class="zc-about-team-card__image">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/joyce.png'); ?>" alt="Joyce">
        </div>

        <h3>Joyce T,</h3>
        <span>Operations Lead</span>

        <p>
          Makes sure everything runs smooth and on time.
        </p>

        <div class="zc-about-team-card__socials">
          <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer">f</a>
          <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer">◎</a>
          <a href="https://www.linkedin.com/in/joyce-reyvel-tenorio/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">in</a>
        </div>
      </article>

      <article class="zc-about-team-card">
        <div class="zc-about-team-card__image">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gideon.png'); ?>" alt="Gideon">
        </div>

        <h3>Gideon S.</h3>
        <span>Production Head</span>

        <p>
          Quality control champion. Keeps every print perfect.
        </p>

        <div class="zc-about-team-card__socials">
          <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer">f</a>
          <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer">◎</a>
          <a href="https://www.linkedin.com/in/gideonsilva/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">in</a>
        </div>
      </article>

      <article class="zc-about-team-card">
        <div class="zc-about-team-card__image">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/carl.png'); ?>" alt="Carl">
        </div>

        <h3>Carl G.</h3>
        <span>Customer Support</span>

        <p>
          Here to help and make your experience amazing.
        </p>

        <div class="zc-about-team-card__socials">
          <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer">f</a>
          <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer">◎</a>
          <a href="https://www.linkedin.com/in/carl-hason-gerale/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">in</a>
        </div>
      </article>

    </div>

  </div>
</section>

<style>
.zc-about-team {
  width: 100%;
  padding: 82px 0 92px;
  background: #ffffff;
}

.zc-about-team__container {
  width: min(100% - 40px, 1280px);
  margin: 0 auto;
}

.zc-about-team__head {
  margin-bottom: 30px;
  text-align: center;
}

.zc-about-team__kicker {
  display: inline-block;
  margin-bottom: 6px;
  color: #ff5b1a;
  font-size: 12px;
  line-height: 1;
  font-weight: 950;
  text-transform: uppercase;
}

.zc-about-team__title {
  margin: 0;
  color: #111111;
  font-size: clamp(28px, 3vw, 42px);
  line-height: 0.95;
  font-weight: 950;
  text-transform: uppercase;
  letter-spacing: -0.8px;
}

.zc-about-team__grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 24px;
}

.zc-about-team-card {
  padding: 32px 22px 24px;
  border-radius: 10px;
  background: #fbf7f3;
  border: 1px solid #eeeeee;
  text-align: center;
  transition: 0.25s ease;
}

.zc-about-team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 18px 32px rgba(0, 0, 0, 0.08);
}

.zc-about-team-card__image {
  width: 96px;
  height: 96px;
  margin: 0 auto 18px;
  border-radius: 50%;
  overflow: hidden;
  background: #eeeeee;
}

.zc-about-team-card__image img {
  width: 100%;
  height: 100%; 
  display: block;
}

.zc-about-team-card h3 {
  margin: 0 0 6px;
  color: #111111;
  font-size: 17px;
  line-height: 1;
  font-weight: 950;
}

.zc-about-team-card > span {
  display: block;
  margin-bottom: 16px;
  color: #555555;
  font-size: 12px;
  line-height: 1.2;
  font-weight: 800;
}

.zc-about-team-card p {
  min-height: 48px;
  margin: 0 0 18px;
  color: #333333;
  font-size: 13px;
  line-height: 1.45;
  font-weight: 650;
}

.zc-about-team-card__socials {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 18px;
}

.zc-about-team-card__socials a {
  color: #111111;
  font-size: 15px;
  line-height: 1;
  font-weight: 900;
  text-decoration: none;
  transition: 0.2s ease;
}

.zc-about-team-card__socials a:hover {
  color: #ff5b1a;
}

@media screen and (max-width: 1024px) {
  .zc-about-team__grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media screen and (max-width: 768px) {
  .zc-about-team {
    padding: 64px 0 74px;
  }

  .zc-about-team__container {
    width: min(100% - 30px, 1120px);
  }
}

@media screen and (max-width: 520px) {
  .zc-about-team__grid {
    grid-template-columns: 1fr;
  }

  .zc-about-team-card p {
    min-height: auto;
  }
}
</style>