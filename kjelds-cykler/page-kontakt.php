<?php get_header(); ?>
<section class="banner" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-contact-banner-img'))?>)">
</section>
<section id="contact-main" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <h1 class="subpage-header"><?php echo get_theme_mod('kc-contact-headline')?></h1>
  <div class="contact-main-container">
		<?php echo do_shortcode('[contact-form-7 id="261" title="Kontaktform"]'); ?>
  </div>
</section>
<?php get_footer(); ?>
