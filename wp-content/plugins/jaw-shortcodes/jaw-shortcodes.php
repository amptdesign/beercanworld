<?php
/*
  Plugin Name: JaW Shortcodes
  Plugin URI: http://jawtemplates.com
  Description: Package of shortcodes by JaW Templates
  Version: 1.5.6
  Author: JaW Templates
  Author URI: http://jawtemplates.com
 */

if (!class_exists('jaw_shortcodes')) {
    define('JAW_SHORTCODES_DIR', dirname(__FILE__) . "/");
    define('JAW_SHORTCODES_URI', plugins_url('', __FILE__) . "/");

    class jaw_shortcodes {

        private $_version = 200;   // plugin version
        private $_name = 'jaw_shortcodes';       // plugin ID for store option in DB
        private $_data = array();     // data from DB    
        static private $_instance;
        private $_avaible = array(
            'jaw_accordion_item' => array('label' => 'Accordion item', 'description' => ''),
            'jaw_accordion' => array('label' => 'Accordion', 'description' => ''),
            'jaw_author' => array('label' => 'Author', 'description' => ''),
            'jaw_authors' => array('label' => 'List of Authors', 'description' => 'Works only with Auhtor shortcode'),
            'jaw_banner' => array('label' => 'Custom banner', 'description' => ''),
            'jaw_bing_map' => array('label' => 'Bing map', 'description' => ''),
            'jaw_blog_big' => array('label' => 'Blog big', 'description' => ''),
            'jaw_blog_carousel_vertical' => array('label' => 'Blog carousel vertical', 'description' => ''),
            'jaw_blog_carousel' => array('label' => 'Blog carousel', 'description' => ''),
            'jaw_blog' => array('label' => 'Blog', 'description' => 'Classical blog'),
            'jaw_breadcrumbs' => array('label' => 'Breadcrumbs', 'description' => ''),
            'jaw_button' => array('label' => 'Button', 'description' => ''),
            'jaw_chart_item' => array('label' => 'Chart item', 'description' => ''),
            'jaw_circle_chart' => array('label' => 'Circle chart', 'description' => ''),
            'jaw_clear' => array('label' => 'Clear (divider)', 'description' => ''),
            'jaw_columns' => array('label' => 'Columns', 'description' => ''),
            'jaw_comments' => array('label' => 'Comments', 'description' => ''),
            'jaw_contact' => array('label' => 'Contact', 'description' => ''),
            'jaw_container' => array('label' => 'Container', 'description' => ''),
            'jaw_countdown' => array('label' => 'Countdown', 'description' => ''),
            'jaw_cta' => array('label' => 'CTA', 'description' => ''),
            'jaw_custom_code' => array('label' => 'Custom code', 'description' => ''),
            'jaw_custom_text' => array('label' => 'Custom Text', 'description' => ''),
            'jaw_divider' => array('label' => 'Divider', 'description' => ''),
            'jaw_faq' => array('label' => 'FAQ', 'description' => ''),
            'jaw_gallery' => array('label' => 'Gallery', 'description' => ''),
            'jaw_google_map_marker' => array('label' => 'Google map marker', 'description' => 'Works only with Google Map shortcode'),
            'jaw_google_map' => array('label' => 'Google map', 'description' => ''),
            'jaw_googlefonts' => array('label' => 'Google Fonts', 'description' => ''),
            'jaw_grid' => array('label' => 'Grid', 'description' => ''),
            'jaw_h' => array('label' => 'Columns (h)', 'description' => ''),
            'jaw_html_carousel_one' => array('label' => 'Custom HTML Carousel One Item', 'description' => ''),
            'jaw_html_carousel' => array('label' => 'Custom HTML Carousel', 'description' => ''),
            'jaw_icon' => array('label' => 'Icon', 'description' => ''),
            'jaw_iframe' => array('label' => 'Iframe', 'description' => ''),
            'jaw_image' => array('label' => 'Image', 'description' => ''),
            'jaw_interested_content' => array('label' => 'Interested Content', 'description' => ''),
            'jaw_list_item' => array('label' => 'List item', 'description' => ''),
            'jaw_list' => array('label' => 'List', 'description' => ''),
            'jaw_login' => array('label' => 'Login', 'description' => ''),
            'jaw_media_gallery' => array('label' => 'Media Gallery', 'description' => ''),
            //'jaw_media_gallery_single' => array('label' => 'Media Gallery Single Photo', 'description' => ''),
            'jaw_menu' => array('label' => 'Menu', 'description' => ''),
            'jaw_message' => array('label' => 'Message', 'description' => ''),
            'jaw_one_progressbar' => array('label' => 'One Progressbar', 'description' => ''),
            'jaw_page' => array('label' => 'Page', 'description' => ''),
            'jaw_panel_box' => array('label' => 'Panel box', 'description' => ''),
            'jaw_paralax_text' => array('label' => 'Paralax text', 'description' => ''),
            'jaw_paralax_video' => array('label' => 'Paralax Video', 'description' => ''),
            'jaw_portfolio' => array('label' => 'Portfolio', 'description' => ''),
            'jaw_progressbar' => array('label' => 'Progressbar', 'description' => ''),
            'jaw_qrcode' => array('label' => 'QRcode', 'description' => ''),
            'jaw_quote' => array('label' => 'BlockQuote', 'description' => ''),
            'jaw_row' => array('label' => 'Row', 'description' => ''),
            'jaw_search' => array('label' => 'Search', 'description' => ''),
            'jaw_section' => array('label' => 'Section', 'description' => ''),
            'jaw_sidebar' => array('label' => 'Sidebar', 'description' => ''),
            'jaw_slider' => array('label' => 'Slider', 'description' => ''),
            'jaw_slider_1' => array('label' => 'Slider 1 GDAYNEWS', 'description' => ''),
            'jaw_slider_2' => array('label' => 'Slider 2 GDAYNEWS', 'description' => ''),
            'jaw_slider_3' => array('label' => 'Slider 3 GDAYNEWS', 'description' => ''),
            'jaw_slider_4' => array('label' => 'Slider 4 GDAYNEWS', 'description' => ''),
            'jaw_slider_5' => array('label' => 'Slider 5 GDAYNEWS', 'description' => ''),
            'jaw_social_icons' => array('label' => 'Social icons', 'description' => ''),
            'jaw_submit_message' => array('label' => 'Submit message', 'description' => ''),
            'jaw_tabs_content' => array('label' => 'Tabs Content', 'description' => ''),
            'jaw_tabs_contents' => array('label' => 'Tabs Contents', 'description' => ''),
            'jaw_tabs_title' => array('label' => 'Tabs Title', 'description' => ''),
            'jaw_tabs_titles' => array('label' => 'Tabs Titles', 'description' => ''),
            'jaw_tabs' => array('label' => 'Tabs', 'description' => ''),
            'jaw_team' => array('label' => 'Team', 'description' => ''),
            'jaw_testimonial_carousel_vertical' => array('label' => 'Testimonial carousel vertical', 'description' => ''),
            'jaw_testimonial_carousel' => array('label' => 'Testimonial carousel', 'description' => ''),
            'jaw_testimonial' => array('label' => 'Testimonial', 'description' => ''),
            'jaw_ticker' => array('label' => 'Ticker', 'description' => 'Ticker for Breaking News'),
            'jaw_title' => array('label' => 'Title', 'description' => ''),
            'jaw_typography' => array('label' => 'Typography', 'description' => ''),
            'jaw_v_video' => array('label' => 'Vimeo video', 'description' => ''),
            'jaw_woo_carousel_small' => array('label' => 'Small Woocommerce Products carousel', 'description' => ''),
            'jaw_woo_carousel_vertical_small' => array('label' => 'Small Woocommerce Products carousel vertical', 'description' => ''),
            'jaw_woo_carousel_vertical' => array('label' => 'Woocommerce Products carousel vertical', 'description' => ''),
            'jaw_woo_carousel' => array('label' => 'Woocommerce Products carousel', 'description' => ''),
            'jaw_y_video' => array('label' => 'Youtube video', 'description' => ''),
                //'jaw_youtube_feeds' => array('label' => 'Youtube feeds', 'description' => '')
        );

        public static function getInstance() {
            if (is_null(self::$_instance)) {
                return self::$_instance = new jaw_shortcodes();
            } else {
                return self::$_instance;
            }
        }

        function __construct() {

            require_once (JAW_SHORTCODES_DIR . "jaw-shortcode_templater.php");
            require_once (JAW_SHORTCODES_DIR . "jaw-shortcode-utils.php");

            require_once (JAW_SHORTCODES_DIR . "editor/simple_elements.php");
            require_once (JAW_SHORTCODES_DIR . "editor/simple_shortcodes.php");

            if (is_admin()) {
                add_action('init', array('jaw_shortcodes', 'jaw_shortcodes_button'));
                add_action('wp_ajax_jaw_shortcodes_ajax', array(&$this, 'jaw_shortcodes_ajax'));

                add_action('admin_enqueue_scripts', array(&$this, 'loadAssets'),10);

                add_action('after_setup_theme', array(&$this, 'loadDialogs'));
                add_action('wp_ajax_jaw_sc_editor_dialog', array(&$this, 'jaw_sc_editor_dialog'));
            }
            add_action('after_setup_theme', array(&$this, 'support'));

//add themeoptions link to top bar
            add_action('admin_bar_menu', array(&$this, 'jaw_modify_admin_bar'), 101);

            if (isset($_POST[$this->_name]) && is_admin()) {
                $active = array();
                if (isset($_POST['typ'])) {
                    foreach ($_POST['typ'] as $value) {
                        $active[$value] = $value;
                    }
                }
                $this->_store($active);
            }

            $this->_data = get_option($this->_name);

            if (!isset($this->_data['active'])) {
                $this->_data['active'] = $this->_avaible;
            }
            if (!isset($this->_data['avaible'])) {
                $this->_data['avaible'] = array_keys($this->_avaible);
            }
            $this->_registerPluginPage();
            if ($this->_data !== false) { // Plugin is initialized.
                $this->_bootloader();
            }
        }

        public function loadDialogs() {

//load editor dialogs
            global $jaw_sc_builder_options;
            $jaw_sc_builder_options = array();
            foreach ($this->_data['active'] as $key => $active) {
                if (is_array($active)) {
                    $active = $key;
                }
                $active = substr($active, 4);
                //pokud chci prepsat nastavovaci formular tak jej musim unistit do sablony
                if ( file_exists(get_template_directory() . '/framework/plugins/jaw-shortcodes/editor/dialogs/' . $active . '.php')) {
                    include_once(get_template_directory() . '/framework/plugins/jaw-shortcodes/editor/dialogs/' . $active . '.php');
                } else if (file_exists(dirname(__FILE__) . '/editor/dialogs/' . $active . '.php')) {
                    include_once('editor/dialogs/' . $active . '.php');
                }
            }
        }

        public function jaw_sc_editor_dialog() {
            global $jaw_sc_builder_options;
            if (isset($_GET['code']) && isset($jaw_sc_builder_options[$_GET['code']])) {
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
            die();
        }

        public function support() {
            add_image_size('slider-size', 488, 455, true);
        }

        private function _bootloader() {
            global $jaw_shortcodes;

            $jaw_shortcodes = array();

            if ($this->_data['active']) {
                foreach ($this->_data['active'] as $key => $short) {
                    if (file_exists(JAW_SHORTCODES_DIR . "shortcodes/" . $key . ".php")) {
                        require_once(JAW_SHORTCODES_DIR . "shortcodes/" . $key . ".php");
                        $jaw_shortcodes[$key] = new $key();
                    } else {
                        echo "<div class='alert alert-warning'>File <strong>" . $key . ".php</strong> is not avalible - <strong>Please check settings of jw-shortcodes plugin</strong></div>";
                    }
                }
            }
        }

        public function getData() {
            return $this->_data;
        }

        private function _store($active, $avaible = null) {
            $theme = wp_get_theme();
            $atts['theme'] = $theme->get('Name');
            $atts['version'] = $theme->get('Version');
            $atts['active'] = $active;
            $atts['plugin'] = $this->_version;
            if (!is_null($avaible)) {
                $atts['avaible'] = $avaible;
            } else { // nacteme dostupne pluginy z DB z predchozi inicializace
                $this->_data = get_option($this->_name);
                $atts['avaible'] = $this->_data['avaible'];
            }
            update_option($this->_name, $atts);
        }

        /**
         * 
         * @param type $plugin
         * @param type $theme
         * @param type $themecheck
         * @return boolean
         */
        private function _checkVersion($plugin) {
            $attrs = $plugin->attributes();
            if ((int) (string) $attrs->vmin <= $this->_version && (int) (string) $attrs->vmax >= $this->_version) {
                return true;  //  Version of plugin is correct
            } else {
                return false; // dont match
            }
        }

        private function _options(SimpleXMLElement $plugin) {
            if ($plugin->children()) {
                $out = null;
                foreach ($plugin->children() as $name => $option) {

                    if (in_array($name, array_keys($this->_avaible))) {
                        $out[(string) $name] = (string) $name;
                    }
                }
                return $out;
            }
            return false;
        }

        public function init($plugin, $theme) { // theme run this function
            if ($this->_checkVersion($plugin)) {
                $data = get_option($this->_name);

                if (!isset($data['active'])) {
                    $active = $this->_options($plugin);
                    $this->_store($active, array_keys($active));
                } else { // updatovalo se neco
                    $avaible = $this->_options($plugin);
                    $this->_store($this->_data['active'], $avaible);
                }
                if (isset($_POST[$this->_name]) && is_admin()) {
// kvuli aktualiyaci udelame redirect, abz se zmenz provedly/zobrazily ihned

                    if (!empty($_SERVER['QUERY_STRING'])) {
                        $query_string = $_SERVER['QUERY_STRING'];
                    } else {
                        $query_string = 'page=' . $this->_name;
                    }

                    wp_redirect(admin_url('plugins.php?' . $query_string));
                }
                return true;
            } else {
                return false;
            }
        }

        private function _registerPluginPage() {
            add_action('admin_menu', array(&$this, 'addPage'));
        }

        public function loadAssets() {

            wp_enqueue_style('editor-style', JAW_SHORTCODES_URI . 'editor/assets/style.css', null, null, 'screen');

            wp_register_script('jaw-elements', JAW_SHORTCODES_URI . 'editor/assets/elements.js', array('jquery'), false, true);

            wp_localize_script('jaw-elements', 'jawelement', $this->_data['active']);

            wp_enqueue_script('jaw-elements');

            wp_register_script('angular', JAW_SHORTCODES_URI . 'editor/assets/lib/angular.min.js', array('jquery'), false, true);
            wp_enqueue_script('angular');

            wp_register_script('angular-bootstrap', JAW_SHORTCODES_URI . 'editor/assets/lib/ui-bootstrap-tpls.min.js', array('jquery'), false, true);
            wp_enqueue_script('angular-bootstrap');

            wp_register_script('gallerypicker', JAW_SHORTCODES_URI . 'editor/assets/angular.gallerypicker.js', array('jquery'), false, true);
            wp_enqueue_script('gallerypicker');

            wp_enqueue_script('shortcode_editor', JAW_SHORTCODES_URI . 'editor/assets/shortcode_editor.js', array('jquery'), '1.0', true);
        }

        public function addPage() {
            $page = add_plugins_page('JaW Shortcodes', 'JaW Shortcodes', 'manage_options', $this->_name, array(&$this, 'doPage'));
        }

        public function doPage() {
            if (!current_user_can('manage_options')) {
                wp_die('You do not have sufficient permissions to access this page.');
            }


            echo '<div id="cp-check" class="wrap">';
            echo '<div id="icon-plugins" class="icon32"><br /></div>
            <h2>JaW Shortcodes</h2>';
            echo '<div class="jawcustomposts">';
            echo $this->_form();
            echo '</div>';
            echo '</div>';
        }

        private function _form() {

            ob_start();
            ?>

            <form action="plugins.php?page=<?php echo $this->_name; ?>" method="post">
                <input id="_wpnonce" type="hidden" value="<?php echo wp_create_nonce($this->_name); ?>" name="_wpnonce">
                <p>Turn on and off shorcodes </p>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row">J&W shortcodes:</th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span>Active this shortcodes:</span></legend>
                                    <?php
                                    foreach ((array) $this->_avaible as $key => $item) {
                                        if (in_array($key, $this->_data['avaible'])) {
                                            $checked = in_array($key, array_keys($this->_data['active'])) ? 'checked="checked"' : '';
                                            ?>
                                            <label for="<?php echo $key; ?>">
                                                <input type="checkbox" value="<?php echo $key; ?>" <?php echo $checked ?> id="<?php echo $key; ?>" name="typ[]">
                                                <?php echo esc_attr($this->_avaible[$key]['label']); ?></label>
                                            <?php if ($this->_avaible[$key]['description']) { ?>
                                                <br>
                                                <small><em>(<?php echo esc_attr($this->_avaible[$key]['description']); ?>)</em></small>
                                            <?php } ?>
                                            <br>
                                            <?php
                                        }
                                    }
                                    ?>

                                </fieldset>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <?php submit_button(null, 'primary', $this->_name); ?>
            </form>


            <?php
            return ob_get_clean();
        }

        public static function jaw_shortcodes_button() {
            if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                return;
            }

            if (get_user_option('rich_editing') == 'true') {
                add_filter('mce_external_plugins', array('jaw_shortcodes', 'add_jawshortcodes'));
                add_filter('mce_buttons', array('jaw_shortcodes', 'register_button'));
            }
        }

        public static function register_button($buttons) {
//array_push($buttons, "|", "jaw_shortcodes");
            $buttons[] = "jaw_shortcodes";
// print_r($buttons);die(0);
            return $buttons;
        }

        public static function add_jawshortcodes($parray) {
            global $wp_version;
            if ($wp_version <= 3.8) {
                if (defined('THEME_FRAMEWORK_DIR') && defined('THEMEURI') && file_exists(THEME_FRAMEWORK_DIR . '/plugins/jaw-shortcodes/' . 'editor/editor_old.min.js')) {
                    $parray['jaw_shortcodes'] = THEMEURI . '/framework/plugins/jaw-shortcodes/' . 'editor/editor_old.min.js';
                } else {
                    $parray['jaw_shortcodes'] = JAW_SHORTCODES_URI . 'editor/editor_old.min.js';
                }
            } else { //wp 3.9+
               if (defined('THEME_FRAMEWORK_DIR') && defined('THEMEURI') && file_exists(THEME_FRAMEWORK_DIR . '/plugins/jaw-shortcodes/' . 'editor/editor_new.min.js')) {
                   $parray['jaw_shortcodes'] = THEMEURI . '/framework/plugins/jaw-shortcodes/' . 'editor/editor_new.min.js';
               } else {
                    $parray['jaw_shortcodes'] = JAW_SHORTCODES_URI . 'editor/editor_new.min.js';
               }
            }

            return $parray;
        }

        public function jaw_shortcodes_ajax() {

            if (isset($_POST['type'])) {
                $type = $_POST['type'];
            } else {
                $type = 'default';
            }
            if (isset($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $data = null;
            }
            $shortcode_function = 'shortcode_' . $type;
            $shortcode = '';
            if (method_exists('jwSimpleShort', $shortcode_function)) {
                $shortcode .= jwSimpleShort::$shortcode_function($data);
            } else {
                $shortcode .= jwSimpleShort::shortcode_default('jaw_' . $type, $data);
            }

            echo ($shortcode);
            die();
        }

        function jaw_modify_admin_bar($wp_admin_bar) {
            if (current_user_can('manage_options')) {
                $wp_admin_bar->add_menu(array(
                    'parent' => 'jaw_options',
                    'id' => 'jaw_shortcodes',
                    'title' => __('JaW Shortcodes', 'jawtemplates'),
                    'href' => admin_url('plugins.php?page=jaw_shortcodes')
                ));
            }
        }

    }

    $scds = jaw_shortcodes::getInstance();
} else {
    die('ERROR: It looks like you have more then one instance of JaW Shordcodes plugin installed. Please remove additional instances for this plugin to work again.');
}