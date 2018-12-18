<?php get_header(); ?>
<section class="banner" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-service-banner-img'))?>)">
</section>
<section id="service-principles" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <h1 class="subpage-header"><?php echo get_theme_mod('kc-service-headline')?></h1>
  <div class="service-principles-container">
    <div class="service-principles-list">
      <div class="service-principles-block service-principles-hr">
        <div class="service-principles-top">
          <div class="service-principles-icon">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-help-icon-1'))?>" alt="Drømmebobbel ikon">
          </div>
          <div class="service-principles-headline">
            <h4><?php echo get_theme_mod('kc-service-help-headline-1')?></h4>
          </div>
        </div>
        <div class="service-principles-text">
          <p><?php echo get_theme_mod('kc-service-help-text-1')?></p>
        </div>
      </div>
      <div class="service-principles-block service-principles-hr">
        <div class="service-principles-top">
          <div class="service-principles-icon">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-help-icon-2'))?>" alt="Værktøj ikon">
          </div>
          <div class="service-principles-headline">
            <h4><?php echo get_theme_mod('kc-service-help-headline-2')?></h4>
          </div>
        </div>
        <div class="service-principles-text">
          <p><?php echo get_theme_mod('kc-service-help-text-2')?></p>
        </div>
      </div>
      <div class="service-principles-block">
        <div class="service-principles-top">
          <div class="service-principles-icon">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-help-icon-3'))?>" alt="Forstørrelsesglas ikon">
          </div>
          <div class="service-principles-headline">
            <h4><?php echo get_theme_mod('kc-service-help-headline-3')?></h4>
          </div>
        </div>
        <div class="service-principles-text">
          <p><?php echo get_theme_mod('kc-service-help-text-3')?></p>
        </div>
      </div>
    </div>
    <div class="service-principles-img">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-help-img'))?>" alt="Billeder fra cykelværkstedet">
    </div>
  </div>
</section>
<section id="service-certified" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-service-certified-bg'))?>)">
  <div class="service-certified-container">
    <div class="service-certified-img">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-certified-img'))?>" alt="Din cykelfagmand certificeret cykelhandler badge">
    </div>
    <div class="service-certified-text">
      <h3><?php echo get_theme_mod('kc-service-certified-headline')?></h3>
      <?php echo wpautop(get_theme_mod('kc-service-certified-text-1'))?>
      <h4><?php echo get_theme_mod('kc-service-certified-headline-2')?></h4>
      <?php echo wpautop(get_theme_mod('kc-service-certified-text-2'))?>
    </div>
  </div>
</section>
<section id="service-details">
  <div class="service-details-container">
    <h3><?php echo get_theme_mod('kc-service-conditions-headline')?></h3>
    <p class="service-details-toptext"><?php echo get_theme_mod('kc-service-conditions-intro-text')?></p>
    <div class="service-details-2">
      <div>
        <div class="service-details-icon">
          <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-conditions-icon-1'))?>" alt="Reklamationsret ikon">
        </div>
        <div class="red-box">
          <div class="red-box-content">
            <h4><?php echo get_theme_mod('kc-service-conditions-subheadline-1')?></h4>
            <?php echo wpautop(get_theme_mod('kc-service-conditions-text-1'))?>
          </div>
        </div>
      </div>
      <div>
        <div class="service-details-icon">
          <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-conditions-icon-2'))?>" alt="Stelbrud ikon">
        </div>
        <div class="red-box">
          <div class="red-box-content">
            <h4><?php echo get_theme_mod('kc-service-conditions-subheadline-2')?></h4>
            <?php echo wpautop(get_theme_mod('kc-service-conditions-text-2'))?>
          </div>
        </div>
      </div>
    </div>
    <div class="service-details-3">
      <?php echo wpautop(get_theme_mod('kc-service-conditions-outtro-text'))?>
    </div>
  </div>
</section>
<section id="service-country">
  <h2><?php echo get_theme_mod('kc-service-country-headline')?></h2>
  <div class="service-country-container">
    <div class="service-country-img">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-service-country-img'))?>" alt="Danmarkskort">
    </div>
    <div class="service-country-text">
      <?php echo wpautop(get_theme_mod('kc-service-country-text'))?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
