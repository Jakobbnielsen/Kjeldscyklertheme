<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php bloginfo('title'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/style.css">
  </head>
  <body>
      <?php wp_nav_menu( $args ); ?>
      <?php while ( have_posts() ) : the_post(); ?>
          <h1> <?php the_title(); ?></h1>
          <article class="author">Skrevet af <?php the_author(); ?> on <?php the_date(); ?></article>
          <?php the_content(); ?>
      <?php endwhile; ?>
      <?php get_footer(); ?>
  </body>
</html>
