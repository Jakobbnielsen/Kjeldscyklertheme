<?php get_header(); ?>
<section class="banner" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-practical-banner-img'))?>)">
</section>
<section id="practical-info-1" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <h1 class="subpage-header"><?php echo get_theme_mod('kc-practical-headline')?></h1>
  <div class="practical-info-1-container">
    <div class="practical-info-block">
      <div class="practical-info-top">
        <div class="practical-info-headline">
          <h3><?php echo get_theme_mod('kc-practical-subheadline-1')?></h3>
        </div>
      </div>
      <div class="practical-info-text">
        <?php echo wpautop(get_theme_mod('kc-practical-text-1'))?>
      </div>
    </div>
    <div class="practical-info-block">
      <div class="practical-info-top">
        <div class="practical-info-headline">
          <h3><?php echo get_theme_mod('kc-practical-subheadline-2')?></h3>
        </div>
      </div>
      <div class="practical-info-text">
        <?php echo wpautop(get_theme_mod('kc-practical-text-2'))?>
      </div>
    </div>
    <div class="practical-info-block">
      <div class="practical-info-top">
        <div class="practical-info-headline">
          <h3><?php echo get_theme_mod('kc-practical-subheadline-3')?></h3>
        </div>
      </div>
      <div class="practical-info-text">
        <?php echo wpautop(get_theme_mod('kc-practical-text-3'))?>
      </div>
    </div>
    <div class="practical-info-block">
      <div class="practical-info-top">
        <div class="practical-info-headline">
          <h3><?php echo get_theme_mod('kc-practical-subheadline-4')?></h3>
        </div>
      </div>
      <div class="practical-info-text">
        <?php echo wpautop(get_theme_mod('kc-practical-text-4'))?>
      </div>
    </div>
  </div>
</section>
<section id="about-info" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-practical-redbanner-bg'))?>)">
  <div class="about-info-container">
    <div class="about-info-img">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-practical-redbanner-img'))?>" alt="Leverings ikon">
    </div>
    <div class="about-info-text">
      <h3><?php echo get_theme_mod('kc-practical-banner-subheadline-1')?></h3>
      <p><?php echo get_theme_mod('kc-practical-banner-text-1')?></p>
      <h3><?php echo get_theme_mod('kc-practical-banner-subheadline-2')?></h3>
      <p><?php echo get_theme_mod('kc-practical-banner-text-2')?></p>
    </div>
  </div>
</section>
<section id="about-info-2">
  <div class="about-info-2-container">
    <h3><?php echo get_theme_mod('kc-practical-data-headline')?></h3>
    <div class="personal-data">
      <div class="personal-data-1">
        <p class="personal-data-intro"><?php echo get_theme_mod('kc-practical-data-subheadline-1')?></p>
        <div class="personal-data-info">
          <?php echo wpautop(get_theme_mod('kc-practical-data-info-1'))?>
        </div>
        <?php echo wpautop(get_theme_mod('kc-practical-data-text-1'))?>
      </div>
      <div class="personal-data-1">
        <p class="personal-data-intro"><?php echo get_theme_mod('kc-practical-data-subheadline-2')?></p>
        <div class="personal-data-info">
          <?php echo wpautop(get_theme_mod('kc-practical-data-info-2'))?>
        </div>
        <?php echo wpautop(get_theme_mod('kc-practical-data-text-2'))?>
        <p class="personal-data-intro"><?php echo get_theme_mod('kc-practical-data-subheadline-3')?></p>
        <div class="personal-data-info">
          <?php echo wpautop(get_theme_mod('kc-practical-data-info-3'))?>
        </div>
        <?php echo wpautop(get_theme_mod('kc-practical-data-text-3'))?>
      </div>
      <div class="complaint">
        <h3><?php echo get_theme_mod('kc-practical-complaint-headline')?></h3>
        <?php echo wpautop(get_theme_mod('kc-practical-complaint-text'))?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
