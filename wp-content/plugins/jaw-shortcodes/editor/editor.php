<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];
//Access WordPress
require_once( $path_to_wp . '/wp-load.php' );

//pokud chci prepsat nastavovaci formular tak jej musim unistit do sablony
if (isset($jaw_sc_builder_options[$_GET['code']])) {

    echo '<div id="jaw_shortcodes" class="editor-content from-theme"  ng-controller="shotcodeEditorCrtl">';
    echo simpleElements::elements_render($jaw_sc_builder_options[$_GET['code']]);
    echo '</div>';
    echo '<script>';
    echo 'jQuery(document).ready(function() {
                    angular.bootstrap(jQuery("#jaw_shortcodes"), ["shotcode_editor"]); 
                });';
    echo '</script>';

    echo '<div class="controll-bar">';
    echo '<button type="button" class="button button-primary button-large editor-insert" onclick="insert_shortcode(\'' . $_GET['code'] . '\')">Insert</button>';
    echo '</div>';
} else {
    echo 'Sorry but dilagog for "' . $_GET['code'] . '" not exist.';
}
?>
