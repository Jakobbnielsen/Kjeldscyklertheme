<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kjelds Cykler
 * @since 1.0
 * @version 1.0
 */

get_header();
?>
<video autoplay muted loop id="banner-video" poster="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-video-poster'))?>">
  <source src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-video'))?>" type="video/mp4">
</video>
<section id="banner-content">
  <div class="banner-btn-container">
    <h1><?php echo get_theme_mod('kc-home-headline')?></h1>
    <a href="<?php echo get_theme_mod('kc-home-video-link') ?>" id="banner-btn" class="btn" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-video-btn'))?>)"><?php echo get_theme_mod('kc-home-video-btn-text')?></a>
  </div>
</section>
<section id="spotlight" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <div class="headline-banner">
    <h2><?php echo get_theme_mod('kc-home-spotlight-headline')?></h2>
    <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-spotlight-banner'))?>" alt="Cykelspots banner">
  </div>
  <div class="spotlight-headline">
    <h3><?php echo get_theme_mod('kc-home-spotlight-text')?></h3>
  </div>
  <div class="spotlight-container">
    <div class="spotlight-bike-container">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-spotlight-bike-1'))?>" alt="Cykelspot Cykel #1">
      <div class="spotlight-bike-name">
        <p class="bike-name"><?php echo get_theme_mod('kc-home-spotlight-bike-1-name')?></p>
        <p class="bike-price"><?php echo get_theme_mod('kc-home-spotlight-bike-1-price')?></p>
      </div>
    </div>
    <div class="spotlight-bike-container">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-spotlight-bike-2'))?>" alt="Cykelspot Cykel #2">
      <div class="spotlight-bike-name">
        <p class="bike-name"><?php echo get_theme_mod('kc-home-spotlight-bike-2-name')?></p>
        <p class="bike-price"><?php echo get_theme_mod('kc-home-spotlight-bike-2-price')?></p>
      </div>
    </div>
    <div class="spotlight-bike-container">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-spotlight-bike-3'))?>" alt="Cykelspot Cykel #3">
      <div class="spotlight-bike-name">
        <p class="bike-name"><?php echo get_theme_mod('kc-home-spotlight-bike-3-name')?></p>
        <p class="bike-price"><?php echo get_theme_mod('kc-home-spotlight-bike-3-price')?></p>
      </div>
    </div>
  </div>
</section>
<section id="values" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-values-bg'))?>)">
  <div class="values-container">
    <div>
      <div class="value-icon" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-values-icon-1'))?>)"></div>
      <h4><?php echo get_theme_mod('kc-home-values-headline-1')?></h4>
      <p><?php echo get_theme_mod('kc-home-values-text-1')?></p>
    </div>
    <div>
      <div class="value-icon" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-values-icon-2'))?>)"></div>
      <h4><?php echo get_theme_mod('kc-home-values-headline-2')?></h4>
      <p><?php echo get_theme_mod('kc-home-values-text-2')?></p>
    </div>
    <div>
      <div class="value-icon" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-values-icon-3'))?>)"></div>
      <h4><?php echo get_theme_mod('kc-home-values-headline-3')?></h4>
      <p><?php echo get_theme_mod('kc-home-values-text-3')?></p>
    </div>
  </div>
</section>
<section id="personal">
  <div class="info">
    <div class="info-headline">
      <h2><?php echo get_theme_mod('kc-home-personal-title')?></h2>
    </div>
    <div class="staff-img">
      <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-staff-img'))?>" alt="Kjelds Cykler medarbejdere gruppebillede">
    </div>
    <div class="infotext">
      <hr class="personal-hr">
      <h4><?php echo get_theme_mod('kc-home-personal-headline-1')?></h4>
      <p><?php echo get_theme_mod('kc-home-personal-text-1')?></p>
      <hr class="personal-hr-mid">
      <h4><?php echo get_theme_mod('kc-home-personal-headline-2')?></h4>
      <p><?php echo get_theme_mod('kc-home-personal-text-2')?></p>
      <hr class="personal-hr">
    </div>
  </div>
  <div class="video-container" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-video-bg'))?>)">
    <div class="videos">
      <div class="wrapper">
        <div class="scrolls">
          <video controls>
            <source src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-video-1'))?>" type="video/mp4">
          </video>
          <video controls>
            <source src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-video-2'))?>" type="video/mp4">
          </video>
          <video controls>
            <source src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-video-3'))?>" type="video/mp4">
          </video>
          <video controls>
            <source src="<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-video-4'))?>" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
    <div class="fb-btn">
      <a href="<?php echo get_theme_mod('kc-home-personal-some-btn-link-1')?>" class="btn media-btn" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-personal-some-btn'))?>)" target="_blank"><?php echo get_theme_mod('kc-home-personal-some-btn-text')?></a>
    </div>
  </div>
</section>
<section id="instagram">
  <div class="instagram-container">
    <div class="insta-feed">
      <?php echo do_shortcode('[instagram-feed]'); ?>
    </div>
  </div>
  <div class="insta-btn">
    <div class="banner-btn">
      <a href="<?php echo get_theme_mod('kc-home-personal-some-btn-link-2')?>" class="btn media-btn" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-home-insta-btn'))?>)" target="_blank"><?php echo get_theme_mod('kc-home-insta-btn-text')?></a>
    </div>
  </div>
</section>
<?php get_footer(); ?>
