<?php get_header(); ?>
<section class="banner" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-about-banner-img'))?>)">
</section>
<section id="about-history" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <h1 class="subpage-header"><?php echo get_theme_mod('kc-about-headline')?></h1>
  <div class="about-info">
    <div class="about-values">
      <div class="about-values-img">
        <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-about-history-icon-1'))?>" alt="Historie ikon #1">
      </div>
      <div class="about-values-text">
        <h4><?php echo get_theme_mod('kc-about-history-subheadline-1')?></h4>
        <p><?php echo get_theme_mod('kc-about-history-text-1')?></p>
      </div>
      <div class="about-values-margin"></div>
      <div class="about-values-img">
        <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-about-history-icon-2'))?>" alt="Historie ikon #2">
      </div>
      <div class="about-values-text">
        <h4><?php echo get_theme_mod('kc-about-history-subheadline-2')?></h4>
        <p><?php echo get_theme_mod('kc-about-history-text-2')?></p>
      </div>
    </div>
    <div class="red-box">
      <div class="red-box-content">
        <h4><?php echo get_theme_mod('kc-about-history-subheadline-3')?></h4>
        <?php echo wpautop(get_theme_mod('kc-about-history-text-3'))?>
      </div>
    </div>
  </div>
</section>
<section id="about-staff" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-about-staff-bg'))?>') no-repeat;">
  <h2><?php echo get_theme_mod('kc-about-staff-headline')?></h2>
  <div class="about-staff-container">
    <div class="about-staff-block">
      <div class="about-staff-img">
        <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-about-staff-img-1'))?>" alt="Billede af medarbejder hos Kjelds Cykler">
      </div>
      <div>
        <h4><?php echo get_theme_mod('kc-about-staff-name-1')?></h4>
        <?php echo wpautop(get_theme_mod('kc-about-staff-info-1'))?>
      </div>
    </div>
    <div class="about-staff-block">
      <div class="about-staff-img">
        <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-about-staff-img-2'))?>" alt="Billede af medarbejder hos Kjelds Cykler">
      </div>
      <div>
        <h4><?php echo get_theme_mod('kc-about-staff-name-2')?></h4>
        <?php echo wpautop(get_theme_mod('kc-about-staff-info-2'))?>
      </div>
    </div>
    <div class="about-staff-block">
      <div class="about-staff-img">
        <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-about-staff-img-3'))?>" alt="Billede af medarbejder hos Kjelds Cykler">
      </div>
      <div>
        <h4><?php echo get_theme_mod('kc-about-staff-name-3')?></h4>
        <?php echo wpautop(get_theme_mod('kc-about-staff-info-3'))?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
