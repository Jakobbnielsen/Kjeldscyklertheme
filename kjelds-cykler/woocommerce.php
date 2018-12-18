<?php get_header(); ?>
<section class="banner" style="background-image: url(<?php echo wp_get_attachment_url(get_theme_mod('kc-about-banner-img'))?>)">
</section>
<?php
if ( is_product() ){
  //Product page specific styles
  echo "<style>
    #wc-main{
      background: none;
      margin-top: -20px;
    }

    .wc-head{display: none;}

    .entry-title{
      font-family: 'Satisfy', serif;
      font-size: 3rem;
      text-align: center;
      font-weight: bold;
      color: #FFC84D;
      margin-top: -860px;
    }

    .woocommerce-Price-amount{margin-top: 400px;}

    .woocommerce-Tabs-panel h2:nth-child(1){display: none;}

    .woocommerce-product-gallery__image{margin-top: 120px;}


    #sidebar{display: none !important;}

    .entry-summary .price{
      float: right;
      padding-top: 365px;
      margin-right: -10px;
      width: 180px;
      height: 100px;
      background: none;
      border: none;
      font-size: 3.5rem;
      font-family: 'Satisfy', sans-serif;
    }

    .woocommerce-Price-amount{padding-right: -100px;}

    .woocommerce-product-gallery{
      background: #933228;
      border: 4px solid #933228;
      border-bottom: 12px solid #691F17;
      height: 890px;
    }

    .woocommerce-tabs, .entry-summary{
      padding-right: 20px;
      margin-left: -150px;
    }

    .description_tab, .additional_information_tab{display: none}

    #postlist{margin-top: -150px;}

    .woocommerce-product-details__short-description{
      margin: 35px -165px 0 0;
      width: 450px;
      float: right;
      color: #F5DBA0;
      padding-bottom: 10px;
      border-bottom: 2px dotted #FFC84D;
    }

    .tagged_as{display: none;}

    .product_meta{
      font-size: 1rem;
      font-family: 'Rokkitt', serif;
      margin: -105px -30px 0 100px;
      text-align: right;
      background-color: #691F17;
      color: #F5DBA0;
      padding: 10px 0;
    }

    .product_meta .posted_in{
      padding: 30px;
      width: 100%;
      color: #F5DBA0;
    }

    .product_meta .posted_in a{
      color: #FFC84D;
      text-decoration: underline;
    }

    .woocommerce-Tabs-panel{
      margin: 420px 25px 0 0;
      width: 580px;
      float: right;
      min-height: 380px;
    }

    .woocommerce-Tabs-panel h3{
      text-align: left;
      font-size: 2.4rem;
      border-bottom: 1px dotted #FFC84D;
    }

    .woocommerce-Tabs-panel p{line-height: 1.7rem;}

    .woocommerce-Tabs-panel strong{
      color: white;
      font-weight: 900;
      padding-right: 7px;
      text-align: left;
      float: left;
      color: #F5DBA0;
    }

    .related{margin-top: 60px;}

    .related h2:nth-child(1){
      font-size: 4rem;
      margin-top: -20px;
      color: #933228;
      text-shadow: none;
    }

    /* -------------------- TABLET MEDIA QUERY -------------------- */

    @media only screen and (max-width: 1099px){

    .entry-title{margin-top: -1060px;}

    .woocommerce-product-gallery {height: 1100px;}

    .woocommerce-product-details__short-description{
      margin-top: 420px !important;
      float: left;
      text-align: left;
      margin-left: 50px;
    }

    .woocommerce-product-details__short-description p{
      margin-left: 150px;
      width: 450px;
    }

    .entry-summary .price{padding-top: 455px;}

    .woocommerce-Tabs-panel{
      margin-top: 100px;
      margin-left: 120px !important;
    }

    .woocommerce-product-details__short-description p{
      margin-left: 110px;
      width: 80%;
    }

    .related{margin-top: 460px;}

    .woocommerce-Tabs-panel {
      margin: 20px 25px 0 0;
      width: 250px;
      float: right;
      min-height: 380px;
    }

    .related>h2{font-size: 2rem !important;}

    /* -------------------- MOBILE MEDIA QUERY -------------------- */

    @media only screen and (max-width: 735px) {

    .entry-title{
      font-size: 1.3rem;
      width: 100%;
      margin: -1040px 0 0 80px;
    }

    .type-product {margin-top: 100px;}

    .wp-post-image{
      width: 300px;
      height: auto;
    }

    .woocommerce-product-gallery__wrapper{margin-left: -200px;}

    .related{margin-top: 230px;}

    .entry-summary .price {
      padding-top: 400px;
      margin-bottom: 20px;
    }

    .woocommerce-product-details__short-description{
      margin-top: 230px !important;
      max-width: 100% !important;
    }

    .woocommerce-product-details__short-description p{padding: 0;}

  }
  </style>";
  }
?>
<section id="wc-main" style="background: url('<?php echo wp_get_attachment_url(get_theme_mod('kc-home-body-bg-top'))?>') repeat-x;">
  <div class="wc-container">
    <?php if ( is_active_sidebar( 'product-tagss' ) ) : ?>
    	<ul id="sidebar">
        <h3>Kategorier</h3>
    		<?php dynamic_sidebar( 'product-tagss' ); ?>
    	</ul>
    <?php endif; ?>
    <ul id="postlist">
      <?php woocommerce_content(); ?>
    </ul>
  </div>
</section>
<?php get_footer(); ?>
