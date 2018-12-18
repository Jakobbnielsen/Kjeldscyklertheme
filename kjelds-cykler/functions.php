<?php
/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Kjelds Cykler
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */

// Load custom stylesheet
function additional_custom_styles() {
  wp_enqueue_style( 'kc-custom-css', get_template_directory_uri() . '/css/kc-style.css' );
}
add_action( 'wp_enqueue_scripts', 'additional_custom_styles' );

// Include admin page
require get_template_directory() . '/inc/function-admin.php';

// Setup Menu navigation
function kc_theme_setup() {
  add_theme_support('menus');

  register_nav_menu('primary', 'Primary Header Navigation');
  register_nav_menu('product-categories', 'Product Categories');
}

add_action('init', 'kc_theme_setup');

function register_my_menu() {
  register_nav_menu('product-categories',__( 'Product Categories' ));
}

add_action( 'init', 'register_my_menu' );

// Static front page
function kc_front_page_template( $template ) {
	return is_home() ? '' : $template;
}

add_filter( 'frontpage_template', 'kc_front_page_template' );

// Active page indicator

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
      $classes[] = 'active ';
  }
  return $classes;
}

// Register sidebars and widgetized areas

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Main Sidebar', 'theme-slug' ),
    'id' => 'product-tagss',
    'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ) );
}

// --------------------------------------------------
// START OF WOOCOMMERCE
// --------------------------------------------------

add_filter( 'woocommerce_is_purchasable', '__return_false');

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

// Add custom suffix to WooCommerce prizes

add_filter( 'woocommerce_get_price_html', 'conditional_price_suffix', 20, 2 );
function conditional_price_suffix( $price, $product ) {
    // HERE define your product categories (can be IDs, slugs or names)
    $product_categories = array('cykler','udstyr');

    if( has_term( $product_categories, 'product_cat', $product->get_id() ) )
        $price .= ' ' . __('<span class="price-suffix">,-</span>');

    return $price;
}

add_theme_support( 'woocommerce' );

// --------------------------------------------------
// END OF WOOCOMMERCE
// --------------------------------------------------

// --------------------------------------------------
// START OF CUSTOMIZATION AREA
// --------------------------------------------------

// Removing Wordpress standard customization sections

function kc_customize_register( $wp_customize ) {
  $wp_customize->remove_section( 'colors');
  $wp_customize->remove_section( 'header_image');
  $wp_customize->remove_section( 'background_image');
  $wp_customize->remove_panel( 'nav_menus');
  $wp_customize->remove_section( 'static_front_page');
  $wp_customize->remove_section( 'custom_css');
}
add_action( 'customize_register', 'kc_customize_register',50 );

// Header section customize options

function kc_header_customize($wp_customize){
  $wp_customize->add_section('kc-header-customize', array(
    'title' => 'Header'
  ));

  $wp_customize->add_setting('kc-header-logo');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-header-logo-control', array(
    'label' => 'Header logo',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-logo',
    'width' => 210,
    'height' => 184
  )));

  $wp_customize->add_setting('kc-header-banner');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-header-banner-control', array(
    'label' => 'Header banner',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-banner',
    'width' => 1336,
    'height' => 83
  )));

  $wp_customize->add_setting('kc-header-menu-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-1-control', array(
    'label' => 'Menupunkt #1 destination',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-1',
    'type' => 'dropdown-pages'
  )));

  $wp_customize->add_setting('kc-header-menu-1-label');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-1-label-control', array(
    'label' => 'Menupunkt #1 tekst',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-1-label',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-header-menu-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-2-control', array(
    'label' => 'Menupunkt #2 destination',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-2',
    'type' => 'dropdown-pages'
  )));

  $wp_customize->add_setting('kc-header-menu-2-label');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-2-label-control', array(
    'label' => 'Menupunkt #2 tekst',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-2-label',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-header-menu-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-3-control', array(
    'label' => 'Menupunkt #3 destination',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-3',
    'type' => 'dropdown-pages'
  )));

  $wp_customize->add_setting('kc-header-menu-3-label');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-3-label-control', array(
    'label' => 'Menupunkt #3 tekst',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-3-label',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-header-menu-4');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-4', array(
    'label' => 'Menupunkt #4 destination',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-4',
    'type' => 'dropdown-pages'
  )));

  $wp_customize->add_setting('kc-header-menu-4-label');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-header-menu-4-label', array(
    'label' => 'Menupunkt #4 tekst',
    'section' => 'kc-header-customize',
    'settings' => 'kc-header-menu-4-label',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-body-bg-top');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-body-bg-top-control', array(
    'label' => 'Hovedbaggrund top med takker',
    'section' => 'kc-header-customize',
    'settings' => 'kc-home-body-bg-top',
    'width' => 2000,
    'height' => 900
  )));

  $wp_customize->add_setting('kc-home-body-bg-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-body-bg-1-control', array(
    'label' => 'Hovedbaggrund 1',
    'section' => 'kc-header-customize',
    'settings' => 'kc-home-body-bg-1',
    'width' => 2000,
    'height' => 1340
  )));

  $wp_customize->add_setting('kc-home-body-bg-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-body-bg-2-control', array(
    'label' => 'Hovedbaggrund 2',
    'section' => 'kc-header-customize',
    'settings' => 'kc-home-body-bg-2',
    'width' => 2000,
    'height' => 1340
  )));

}

add_action('customize_register','kc_header_customize');

// Home customize options

function kc_home_customize($wp_customize){
  $wp_customize->add_section('kc-home-customize', array(
    'title' => 'SIDE - Forside'
  ));

  $wp_customize->add_setting('kc-home-video');

  $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'kc-home-video-control', array(
    'label' => 'Forside baggrundsvideo',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-video',
    'mime_type' => 'video/mp4'
  )));

  $wp_customize->add_setting('kc-home-video-poster');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-video-poster-control', array(
    'label' => 'Forside baggrundsvideo poster',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-video-poster',
    'width' => 1920,
    'height' => 1080
  )));

  $wp_customize->add_setting('kc-home-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-headline-control', array(
    'label' => 'Forside overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-video-btn');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-video-btn-control', array(
    'label' => 'Video knap',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-video-btn',
    'width' => 320,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-video-btn-text');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-video-btn-text-control', array(
    'label' => 'Video knap tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-video-btn-text',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-video-link');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-video-link-control', array(
    'label' => 'Video knap link destination',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-video-link',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-headline');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-spotlight-headline-control', array(
    'label' => 'Cykelspot overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-banner');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-spotlight-banner-control', array(
    'label' => 'Cykelspot banner',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-banner',
    'width' => 504,
    'height' => 158
  )));

  $wp_customize->add_setting('kc-home-spotlight-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-text-control', array(
    'label' => 'Cykelspot tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-text',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-spotlight-bike-1-control', array(
    'label' => 'Cykelspot cykel #1',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-1',
    'width' => 600,
    'height' => 372
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-1-name');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-1-name-control', array(
    'label' => 'Cykelspot cykel #1 navn',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-1-name',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-1-price');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-1-price-control', array(
    'label' => 'Cykelspot cykel #1 pris',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-1-price',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-spotlight-bike-2-control', array(
    'label' => 'Cykelspot cykel #2',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-2',
    'width' => 600,
    'height' => 372
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-2-name');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-2-name-control', array(
    'label' => 'Cykelspot cykel #2 navn',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-2-name',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-2-price');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-2-price-control', array(
    'label' => 'Cykelspot cykel #2 pris',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-2-price',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-3');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-spotlight-bike-3-control', array(
    'label' => 'Cykelspot cykel #3',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-3',
    'width' => 600,
    'height' => 372
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-3-name');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-3-name-control', array(
    'label' => 'Cykelspot cykel #3 navn',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-3-name',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-spotlight-bike-3-price');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-spotlight-bike-3-price-control', array(
    'label' => 'Cykelspot cykel #3 pris',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-spotlight-bike-3-price',
    'type' => 'text'
  )));

  // Home - value section

  $wp_customize->add_setting('kc-home-values-icon-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-values-icon-1-control', array(
    'label' => 'Værdi ikon #1',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-icon-1',
    'width' => 100,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-values-headline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-values-headline-1-control', array(
    'label' => 'Værdi #1 overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-headline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-values-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-values-customize-text-1-control', array(
    'label' => 'Værdi #1 tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-home-values-icon-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-values-icon-2-control', array(
    'label' => 'Værdi ikon #2',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-icon-2',
    'width' => 100,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-values-headline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-values-headline-2-control', array(
    'label' => 'Værdi #2 overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-headline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-values-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-values-customize-text-2-control', array(
    'label' => 'Værdi #2 tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-home-values-icon-3');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-values-icon-3-control', array(
    'label' => 'Værdi ikon #3',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-icon-3',
    'width' => 100,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-values-headline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-values-headline-3-control', array(
    'label' => 'Værdi #3 overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-headline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-values-text-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-values-customize-text-3-control', array(
    'label' => 'Værdi #3 tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-text-3',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-home-values-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-values-bg-control', array(
    'label' => 'Værdi sektion baggrund',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-values-bg',
    'width' => 2300,
    'height' => 1100
  )));

  // Home - personal section

  $wp_customize->add_setting('kc-home-personal-title');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-title-control', array(
    'label' => 'Personlige cykelhandler overskrift',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-title',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-personal-staff-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-personal-staff-img', array(
    'label' => 'Billede af medarbejdere',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-staff-img',
    'width' => 1404,
    'height' => 1000
  )));

  $wp_customize->add_setting('kc-home-personal-headline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-headline-1-control', array(
    'label' => 'Personlig cykelhandler overskrift #1',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-headline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-personal-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-text-1-control', array(
    'label' => 'Personlig cykelhandler tekst #1',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-home-personal-headline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-headline-2-control', array(
    'label' => 'Personlig cykelhandler overskrift #1',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-headline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-personal-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-text-2-control', array(
    'label' => 'Personlig cykelhandler tekst #2',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-home-personal-video-1');

  $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'kc-home-personal-video-1', array(
    'label' => 'Video fra cykelværkstedet #1',
    'section' => 'kc-home-customize',
    'setting' => 'kc-home-personal-video-1',
    'mime_type' => 'video/mp4'
  )));

  $wp_customize->add_setting('kc-home-personal-video-2');

  $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'kc-home-personal-video-2', array(
    'label' => 'Video fra cykelværkstedet #2',
    'section' => 'kc-home-customize',
    'setting' => 'kc-home-personal-video-2',
    'mime_type' => 'video/mp4'
  )));

  $wp_customize->add_setting('kc-home-personal-video-3');

  $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'kc-home-personal-video-3', array(
    'label' => 'Video fra cykelværkstedet #3',
    'section' => 'kc-home-customize',
    'setting' => 'kc-home-personal-video-3',
    'mime_type' => 'video/mp4'
  )));

  $wp_customize->add_setting('kc-home-personal-video-4');

  $wp_customize->add_control( new WP_Customize_Media_Control($wp_customize, 'kc-home-personal-video-4', array(
    'label' => 'Video fra cykelværkstedet #4',
    'section' => 'kc-home-customize',
    'setting' => 'kc-home-personal-video-4',
    'mime_type' => 'video/mp4'
  )));

  $wp_customize->add_setting('kc-home-personal-video-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-personal-video-bg-control', array(
    'label' => 'Videoer baggrundsbillede',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-video-bg',
    'width' => 1920,
    'height' => 603
  )));

  $wp_customize->add_setting('kc-home-personal-some-btn');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-personal-some-btn-control', array(
    'label' => 'Personlige cykelhandler knap',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-some-btn',
    'width' => 320,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-personal-some-btn-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-some-btn-text-control', array(
    'label' => 'Personlige cykelhandler knap tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-some-btn-text',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-personal-some-btn-link-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-some-btn-link-1-control', array(
    'label' => 'Facebook link',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-some-btn-link-1',
    'type' => 'text'
  )));

  // Home - Instagram section

  $wp_customize->add_setting('kc-home-insta-btn');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-home-insta-btn-control', array(
    'label' => 'Instagram knap',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-insta-btn',
    'width' => 320,
    'height' => 100
  )));

  $wp_customize->add_setting('kc-home-insta-btn-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-insta-btn-text-control', array(
    'label' => 'Instagram knap tekst',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-insta-btn-text',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-home-personal-some-btn-link-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-home-personal-some-btn-link-2-control', array(
    'label' => 'Instagram link',
    'section' => 'kc-home-customize',
    'settings' => 'kc-home-personal-some-btn-link-2',
    'type' => 'text'
  )));

}

add_action('customize_register','kc_home_customize');


// --------------------------------------------------
// SERVICE PAGE CUSTOMIZATION OPTIONS
// --------------------------------------------------


function kc_service_customize($wp_customize){
  $wp_customize->add_section('kc-service-customize', array(
    'title' => 'SIDE - Service'
  ));

  $wp_customize->add_setting('kc-service-banner-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-banner-img-control', array(
    'label' => 'Service bannerbillede',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-banner-img',
    'width' => 1920,
    'height' => 220
  )));

  $wp_customize->add_setting('kc-service-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-headline-control', array(
    'label' => 'Service overskrift',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-help-icon-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-help-icon-1-control', array(
    'label' => 'Service hjælp ikon #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-icon-1',
    'width' => 240,
    'height' => 240
  )));

  $wp_customize->add_setting('kc-service-help-headline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-headline-1-control', array(
    'label' => 'Service hjælp overskrift #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-headline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-help-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-text-1-control', array(
    'label' => 'Service hjælp tekst #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-help-icon-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-help-icon-2-control', array(
    'label' => 'Service hjælp ikon #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-icon-2',
    'width' => 240,
    'height' => 240
  )));

  $wp_customize->add_setting('kc-service-help-headline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-headline-2-control', array(
    'label' => 'Service hjælp overskrift #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-headline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-help-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-text-2-control', array(
    'label' => 'Service hjælp tekst #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-help-icon-3');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-help-icon-3-control', array(
    'label' => 'Service hjælp ikon #3',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-icon-3',
    'width' => 240,
    'height' => 240
  )));

  $wp_customize->add_setting('kc-service-help-headline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-headline-3-control', array(
    'label' => 'Service hjælp overskrift #3',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-headline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-help-text-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-help-text-3-control', array(
    'label' => 'Service hjælp tekst #3',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-text-3',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-help-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-help-img-control', array(
    'label' => 'Service hjælp ikon #3',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-help-img',
    'width' => 770,
    'height' => 860
  )));

  // Service - Certified section

  $wp_customize->add_setting('kc-service-certified-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-certified-img-control', array(
    'label' => 'Service certificeret badge',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-img',
    'width' => 900,
    'height' => 700
  )));

  $wp_customize->add_setting('kc-service-certified-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-certified-headline-control', array(
    'label' => 'Service certificeret overskrift',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-certified-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-certified-text-1-control', array(
    'label' => 'Service certificeret tekst #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-certified-headline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-certified-headline-2-control', array(
    'label' => 'Service certificeret mellemoverskrift',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-headline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-certified-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-certified-text-2-control', array(
    'label' => 'Service certificeret tekst #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-certified-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-certified-bg-control', array(
    'label' => 'Service certificeret sektion baggrund',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-certified-bg',
    'width' => 2300,
    'height' => 1100
  )));

  // Service - Conditions section

  $wp_customize->add_setting('kc-service-conditions-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-headline-control', array(
    'label' => 'Service reklamation overskrift',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-conditions-intro-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-intro-text-control', array(
    'label' => 'Service reklamation intro tekst #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-intro-text',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-conditions-icon-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-conditions-icon-1-control', array(
    'label' => 'Service reklamation ikon #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-icon-1',
    'width' => 200,
    'height' => 230
  )));

  $wp_customize->add_setting('kc-service-conditions-subheadline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-subheadline-1-control', array(
    'label' => 'Service reklamation underoverskrift #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-subheadline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-conditions-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-text-1-control', array(
    'label' => 'Service reklamation tekstkasse #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-conditions-icon-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-conditions-icon-2-control', array(
    'label' => 'Service reklamation ikon #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-icon-2',
    'width' => 200,
    'height' => 230
  )));

  $wp_customize->add_setting('kc-service-conditions-subheadline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-subheadline-2-control', array(
    'label' => 'Service reklamation underoverskrift #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-subheadline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-conditions-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-text-2-control', array(
    'label' => 'Service reklamation tekstkasse #2',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-service-conditions-outtro-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-conditions-outtro-text-control', array(
    'label' => 'Service reklamation sluttekst #1',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-conditions-outtro-text',
    'type' => 'textarea'
  )));

  // Service - country section

  $wp_customize->add_setting('kc-service-country-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-country-headline-control', array(
    'label' => 'Service landsdækkende overskrift',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-country-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-service-country-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-service-country-img-control', array(
    'label' => 'Service landsdækkende billede',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-country-img',
    'width' => 445,
    'height' => 511
  )));

  $wp_customize->add_setting('kc-service-country-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-service-country-text-control', array(
    'label' => 'Service landsdækkende tekst',
    'section' => 'kc-service-customize',
    'settings' => 'kc-service-country-text',
    'type' => 'textarea'
  )));

}

add_action('customize_register','kc_service_customize');

// --------------------------------------------------
// ABOUT PAGE CUSTOMIZATION OPTIONS
// --------------------------------------------------

function kc_about_customize($wp_customize){
  $wp_customize->add_section('kc-about-customize', array(
    'title' => 'SIDE - Om os'
  ));

  $wp_customize->add_setting('kc-about-banner-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-banner-img-control', array(
    'label' => 'Om os bannerbillede',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-banner-img',
    'width' => 1920,
    'height' => 220
  )));

  $wp_customize->add_setting('kc-about-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-headline-control', array(
    'label' => 'Om os overskrift',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-history-icon-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-history-icon-1-control', array(
    'label' => 'Om os ikon #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-icon-1',
    'width' => 240,
    'height' => 240
  )));

  $wp_customize->add_setting('kc-about-history-subheadline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-subheadline-1-control', array(
    'label' => 'Om os underoverskrift #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-subheadline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-history-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-text-1-control', array(
    'label' => 'Om os tekst #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-about-history-icon-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-history-icon-2-control', array(
    'label' => 'Om os ikon #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-icon-2',
    'width' => 240,
    'height' => 240
  )));

  $wp_customize->add_setting('kc-about-history-subheadline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-subheadline-2-control', array(
    'label' => 'Om os underoverskrift #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-subheadline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-history-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-text-2-control', array(
    'label' => 'Om os tekst #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-about-history-subheadline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-subheadline-3-control', array(
    'label' => 'Om os box overskrift',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-subheadline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-history-text-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-history-text-3-control', array(
    'label' => 'Om os box tekst',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-history-text-3',
    'type' => 'textarea'
  )));

  // About page - Staff section

  $wp_customize->add_setting('kc-about-staff-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-headline-control', array(
    'label' => 'Medarbejdere overskrift',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-staff-img-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-staff-img-1-control', array(
    'label' => 'Medarbejder billede #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-img-1',
    'width' => 624,
    'height' => 760
  )));

  $wp_customize->add_setting('kc-about-staff-name-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-name-1-control', array(
    'label' => 'Medarbejder navn #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-name-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-staff-info-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-info-1-control', array(
    'label' => 'Medarbejder info #1',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-info-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-about-staff-img-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-staff-img-2-control', array(
    'label' => 'Medarbejder billede #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-img-2',
    'width' => 624,
    'height' => 760
  )));

  $wp_customize->add_setting('kc-about-staff-name-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-name-2-control', array(
    'label' => 'Medarbejder navn #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-name-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-staff-info-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-info-2-control', array(
    'label' => 'Medarbejder info #2',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-info-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-about-staff-img-3');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-staff-img-3-control', array(
    'label' => 'Medarbejder billede #3',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-img-3',
    'width' => 624,
    'height' => 760
  )));

  $wp_customize->add_setting('kc-about-staff-name-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-name-3-control', array(
    'label' => 'Medarbejder navn #3',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-name-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-about-staff-info-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-about-staff-info-3-control', array(
    'label' => 'Medarbejder info #3',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-info-3',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-about-staff-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-about-staff-bg-control', array(
    'label' => 'Medarbejder billede #3',
    'section' => 'kc-about-customize',
    'settings' => 'kc-about-staff-bg',
    'width' => 2800,
    'height' => 1400
  )));

}

add_action('customize_register','kc_about_customize');

// --------------------------------------------------
// PRACTICAL PAGE CUSTOMIZATION OPTIONS
// --------------------------------------------------

function kc_practical_customize($wp_customize){
  $wp_customize->add_section('kc-practical-customize', array(
    'title' => 'SIDE - Praktisk'
  ));

  $wp_customize->add_setting('kc-practical-banner-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-practical-banner-img-control', array(
    'label' => 'Praktisk bannerbillede',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-banner-img',
    'width' => 1920,
    'height' => 220
  )));

  $wp_customize->add_setting('kc-practical-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-headline-control', array(
    'label' => 'Praktisk overskrift',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-subheadline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-subheadline-1-control', array(
    'label' => 'Praktisk underoverskrift #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-subheadline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-text-1-control', array(
    'label' => 'Praktisk tekst #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-subheadline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-subheadline-2-control', array(
    'label' => 'Praktisk underoverskrift #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-subheadline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-text-2-control', array(
    'label' => 'Praktisk tekst #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-subheadline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-subheadline-3-control', array(
    'label' => 'Praktisk underoverskrift #3',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-subheadline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-text-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-text-3-control', array(
    'label' => 'Praktisk tekst #3',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-text-3',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-subheadline-4');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-subheadline-4-control', array(
    'label' => 'Praktisk underoverskrift #4',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-subheadline-4',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-text-4');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-text-4-control', array(
    'label' => 'Praktisk tekst #4',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-text-4',
    'type' => 'textarea'
  )));

  // Practical page - banner section

  $wp_customize->add_setting('kc-practical-redbanner-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-practical-redbanner-bg-control', array(
    'label' => 'Praktisk banner sektion baggrund',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-redbanner-bg',
    'width' => 2300,
    'height' => 1100
  )));

  $wp_customize->add_setting('kc-practical-redbanner-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-practical-redbanner-img-control', array(
    'label' => 'Praktisk banner sektion billede',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-redbanner-img',
    'width' => 900,
    'height' => 700
  )));

  $wp_customize->add_setting('kc-practical-banner-subheadline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-banner-subheadline-1-control', array(
    'label' => 'Praktisk banner sektion underoverskrift #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-banner-subheadline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-banner-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-banner-text-1-control', array(
    'label' => 'Praktisk banner sektion tekst #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-banner-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-banner-subheadline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-banner-subheadline-2-control', array(
    'label' => 'Praktisk banner sektion underoverskrift #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-banner-subheadline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-banner-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-banner-text-2-control', array(
    'label' => 'Praktisk banner sektion tekst #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-banner-text-2',
    'type' => 'textarea'
  )));

  // Practical page - Personal data section

  $wp_customize->add_setting('kc-practical-data-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-headline-control', array(
    'label' => 'Praktisk persondata overskrift',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-data-subheadline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-subheadline-1-control', array(
    'label' => 'Praktisk persondata underoverskrift #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-subheadline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-data-info-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-info-1-control', array(
    'label' => 'Praktisk persondata info #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-info-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-data-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-text-1-control', array(
    'label' => 'Praktisk persondata tekst #1',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-data-subheadline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-subheadline-2-control', array(
    'label' => 'Praktisk persondata underoverskrift #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-subheadline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-data-info-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-info-2-control', array(
    'label' => 'Praktisk persondata info #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-info-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-data-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-text-2-control', array(
    'label' => 'Praktisk persondata tekst #2',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-data-subheadline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-subheadline-3-control', array(
    'label' => 'Praktisk persondata underoverskrift #3',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-subheadline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-data-info-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-info-3-control', array(
    'label' => 'Praktisk persondata info #3',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-info-3',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-practical-data-text-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-data-text-3-control', array(
    'label' => 'Praktisk persondata tekst #3',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-data-text-3',
    'type' => 'textarea'
  )));

  //Practical page - Complaint section

  $wp_customize->add_setting('kc-practical-complaint-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-complaint-headline-control', array(
    'label' => 'Praktisk klage overskrift',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-complaint-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-practical-complaint-text');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-practical-complaint-text-control', array(
    'label' => 'Praktisk klage tekst',
    'section' => 'kc-practical-customize',
    'settings' => 'kc-practical-complaint-text',
    'type' => 'textarea'
  )));

}

add_action('customize_register','kc_practical_customize');


// --------------------------------------------------
// CONTACT PAGE CUSTOMIZATION OPTIONS
// --------------------------------------------------


function kc_contact_customize($wp_customize){
  $wp_customize->add_section('kc-contact-customize', array(
    'title' => 'SIDE - Kontakt'
  ));

  $wp_customize->add_setting('kc-contact-banner-img');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-contact-banner-img-control', array(
    'label' => 'Kontakt bannerbillede',
    'section' => 'kc-contact-customize',
    'settings' => 'kc-contact-banner-img',
    'width' => 1920,
    'height' => 220
  )));

  $wp_customize->add_setting('kc-contact-headline');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-contact-headline-control', array(
    'label' => 'Om os overskrift',
    'section' => 'kc-contact-customize',
    'settings' => 'kc-contact-headline',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-contact-btn');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-contact-btn-control', array(
    'label' => 'Video knap',
    'section' => 'kc-contact-customize',
    'settings' => 'kc-contact-btn',
    'width' => 320,
    'height' => 100
  )));

}

add_action('customize_register','kc_contact_customize');


// --------------------------------------------------
// FOOTER CUSTOMIZATION OPTIONS
// --------------------------------------------------


function kc_footer_customize($wp_customize){
  $wp_customize->add_section('kc-footer-customize', array(
    'title' => 'Footer'
  ));

  $wp_customize->add_setting('kc-footer-headline-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-headline-1-control', array(
    'label' => 'Footer overskrift #1',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-headline-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-footer-text-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-text-1-control', array(
    'label' => 'Footer tekst #1',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-text-1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-footer-headline-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-headline-2-control', array(
    'label' => 'Footer overskrift #2',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-headline-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-footer-text-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-text-2-control', array(
    'label' => 'Footer tekst #2',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-text-2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-footer-headline-3');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-headline-3-control', array(
    'label' => 'Footer overskrift #3',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-headline-3',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-footer-some-1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-footer-some-1-control', array(
    'label' => 'Footer social medie ikon #1',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-some-1',
    'width' => 80,
    'height' => 80
  )));

  $wp_customize->add_setting('kc-footer-some-link-1');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-some-link-1-control', array(
    'label' => 'Footer social medie link #1',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-some-link-1',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-footer-some-2');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-footer-some-2-control', array(
    'label' => 'Footer social medie ikon #2',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-some-2',
    'width' => 80,
    'height' => 80
  )));

  $wp_customize->add_setting('kc-footer-some-link-2');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-some-link-2-control', array(
    'label' => 'Footer social medie link #2',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-some-link-2',
    'type' => 'text'
  )));

  $wp_customize->add_setting('kc-footer-copyright');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'kc-footer-copyright-control', array(
    'label' => 'Footer copyright',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-copyright',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('kc-footer-bg');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'kc-footer-bg-2-control', array(
    'label' => 'Footer social medie ikon #2',
    'section' => 'kc-footer-customize',
    'settings' => 'kc-footer-bg',
    'width' => 1920,
    'height' => 475
  )));
}

add_action('customize_register','kc_footer_customize');
