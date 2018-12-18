<!DOCTYPE HTML>
<html lang="da" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedste og billigste cykler Odense - Kjelds cykler</title>
    <meta name="description" content="Kom ned til Kjelds cykler, og tag et kig på Odenses de billige cykler. Hos Kjelds sikrer vi god kvalitet.">
    <link href="style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
      body{
        background:
        url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-2'))?>') 0 100% repeat-x,
        url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-1'))?>') 0 80% repeat-x;
        background-repeat: repeat-y;
        overflow-x: hidden;
        background-color: #fbf0da;
      }
      .wpcf7-submit{
				background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-contact-btn'))?>);
				padding-top: 3px;
			}
    </style>
  </head>
  <body>
    <?php $page_title = $wp_query->post->post_title; ?>
    <main>
      <header>
        <div id="menu" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-header-banner'))?>)"></div>
        <nav>
          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
        <div class="logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('kc-header-logo'))?>" alt="Kjelds Cykler Logo">
          </a>
        </div>
      </header>
