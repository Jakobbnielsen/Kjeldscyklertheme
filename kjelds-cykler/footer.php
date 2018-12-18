    <footer style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-footer-bg'))?>');">
      <div class="footer-logo">
        <a href="<?php echo home_url(); ?>"><img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-header-logo'))?>" alt="Kjelds Cykler Footer Logo"></a>
      </div>
      <div class="footer-container">
        <div>
          <h4><?php echo get_theme_mod('kc-footer-headline-1')?></h4>
          <?php echo wpautop(get_theme_mod('kc-footer-text-1'))?>
        </div>
        <div class="footer-open">
          <h4><?php echo get_theme_mod('kc-footer-headline-2')?></h4>
          <?php echo wpautop(get_theme_mod('kc-footer-text-2'))?>
        </div>
        <div>
          <h4><?php echo get_theme_mod('kc-footer-headline-3')?></h4>
          <div class="some-btn">
            <a href="<?php echo get_theme_mod('kc-footer-some-link-1')?>" target="_blank"><img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-footer-some-1'))?>" alt="Facebook knap"></a>
            <a href="<?php echo get_theme_mod('kc-footer-some-link-2')?>" target="_blank"><img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-footer-some-2'))?>" alt="Instagram knap"></a>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <?php echo wpautop(get_theme_mod('kc-footer-copyright'))?>
      </div>
    </footer>
    <?php wp_footer(); ?>
    </main>
  </body>
</html>
