<?php

/*
  Plugin Name: JaW Menu for GoodStore theme
  Plugin URI: http://jawtemplates.com
  Description: Ultimate menu plugin by JaW Templates
  Version: 1.4.2
  Author: JaW Templates
  Author URI: http://jawtemplates.com

 *  */

define('JAWMENU_VERSION', '1.3.1');
define('JAWMENU_OPTIONS', 'jaw-menu-options');
define('JAWMENU_MENU_LOCATION', 'jaw-menu-location');
define('JAWMENU_ITEM_OPTIONS', 'jaw-menu-item-options');
define('JAWMENU_DIR', dirname( plugin_basename( __FILE__ ) ));

require_once( 'menu/JawMenu.class.php' );

$jawMenu = new JawMenu();


add_action('plugins_loaded', 'jaw_menu_language');

function jaw_menu_language() {
    load_plugin_textdomain('jawtemplates',false,  JAWMENU_DIR . '/languages');
}