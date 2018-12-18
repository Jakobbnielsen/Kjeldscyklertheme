<?php

/*

@package kjelds-cykler

  ====================
  ADMIN PAGE
  ====================
*/

function kc_add_admin_page(){
  //Generate Kjelds Cykler Admin Page
  add_menu_page( 'Kjelds Cykler Theme Options', 'Kjelds Cykler', 'manage_options', 'kjelds_cykler', 'kc_theme_create_page', get_template_directory_uri() . '/media/kjelds-cykler-icon.png', 110 );

  //Generate Kjelds Cykler Admin Sub Pages
  add_submenu_page( 'kjelds_cykler', 'Kjelds Cykler Theme Options', 'Settings', 'manage_options', 'kjelds_cykler', 'kc_theme_create_page' );

}

add_action( 'admin_menu', 'kc_add_admin_page' );

function kc_theme_create_page(){
  require_once( get_template_directory() . '/inc/templates/kjelds-cykler-admin.php' );
}
