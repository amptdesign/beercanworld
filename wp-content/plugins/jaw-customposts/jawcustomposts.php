<?php
/*
  Plugin Name: JaW Custom Posts
  Plugin URI: http://jawtemplates.com
  Description: Add Custom Post Types for your theme by JaW Templates.
  Version: 1.2.3
  Author: JaW Templates
  Author URI: jawtemplates.com
 * License: GPLv2 or later
 */

define('JAW_CUSTOMPOSTS_DIR', dirname(__FILE__) . "/");
define('JAW_CUSTOMPOSTS_URI', plugins_url('', __FILE__) . "/");

if (!class_exists('jaw_customposts')) {

    class jaw_customposts {

        static private $_instance;
        private $_version = 200;
        private $_name = 'jaw_customposts';
        private $_data = array();
        private $_avaible = array(
            'jaw_faq' => array('label' => 'JaW Faq', 'description' => '', 'rewrite' => 'jaw_faq'),
            'jaw_portfolio' => array('label' => 'JaW Portfolio', 'description' => '', 'rewrite' => 'jaw_portfolio'),
            'jaw_team' => array('label' => 'JaW Team', 'description' => '', 'rewrite' => 'jaw_team'),
            'jaw_testimonial' => array('label' => 'JaW Testimonial', 'description' => '', 'rewrite' => 'jaw_testimonial'),
            'jaw_gallery' => array('label' => 'JaW Gallery', 'description' => '', 'rewrite' => 'jaw_gallery')
            //'jaw_timeline' => array('label' => 'JaW Timeline', 'description' => 'Timeline Maker by JaW Templates')
        );

        public static function getInstance() {
            if (is_null(self::$_instance)) {
                return self::$_instance = new jaw_customposts();
            } else {
                return self::$_instance;
            }
        }

        function __construct() {
            global $jaw_customposts;
            //load_plugin_textdomain($this->_name, false, dirname(plugin_basename(__FILE__)) . '/languages/');

            require_once (JAW_CUSTOMPOSTS_DIR . "jawcustomposts_templater.php");

            jaw_enqueue_phplib('pluginElement', JAW_CUSTOMPOSTS_DIR . 'libs/class_elements.php', '1.1');

            if (isset($_POST[$this->_name]) && is_admin()) {
                $active = array();
                if (isset($_POST['typ'])) {
                    foreach ($_POST['typ'] as $value) {
                        if (isset($_POST['rewrite'][$value]) && $_POST['rewrite'][$value] != '') {
                            $active[$value] = array('rewrite' => $_POST['rewrite'][$value]);
                        } else {
                            $active[$value] = array('rewrite' => $value);
                        }
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

            add_action('admin_enqueue_scripts', array(&$this, 'loadAssets'),10);
            //add themeoptions link to top bar
            add_action('admin_bar_menu', array(&$this, 'jaw_modify_admin_bar'), 101);
        }

        private function _bootloader() {

            if ($this->_data['active']) {
                foreach ($this->_data['active'] as $key => $short) {
                    if (file_exists(dirname(__FILE__) . "/metaboxes/metabox-" . $key . ".php")) {
                        require_once(dirname(__FILE__) . "/metaboxes/metabox-" . $key . ".php");
                    }
                    if (file_exists(dirname(__FILE__) . "/customposts/" . $key . "/" . $key . ".php")) {
                        require_once(dirname(__FILE__) . "/customposts/" . $key . "/" . $key . ".php");
                    } else {
                        echo "<div class='alert alert-warning'>File <strong>" . $key . ".php</strong> is not avalible - <strong>Please check settings of jaw-customposts plugin</strong></div>";
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
                    $out[] = (string) $name;
                }
                return $out;
            }
            return false;
        }

        public function init($plugin, $theme) { // theme run this function
            if ($this->_checkVersion($plugin) && is_admin()) {
                if (get_option($this->_name) === false) {
                    $active = $this->_options($plugin);
                    $this->_store(array_combine($active,$active), $active);
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
                    $_POST[$this->_name] = null;
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
            wp_enqueue_style('custompost-style', JAW_CUSTOMPOSTS_URI . 'assets/css/style.css');

            // wp_enqueue_script('mce-view');  
            wp_enqueue_script('angular', JAW_CUSTOMPOSTS_URI . 'assets/js/lib/angular.min.js', array('jquery'), '1.0.8');
            wp_enqueue_script('ui-bootstrap', JAW_CUSTOMPOSTS_URI . 'assets/js/lib/ui-bootstrap-tpls.min.js', array('jquery', 'angular'), '1.0');
            wp_enqueue_script('jaw_gallerypicker', JAW_CUSTOMPOSTS_URI . 'assets/js/angular.gallerypicker.js', array('jquery', 'angular'), '1.1');
            wp_enqueue_script('simplemediapicker', JAW_CUSTOMPOSTS_URI . 'assets/js/angular.simplemediapicker.js', array('jquery', 'angular'), '1.1');
            wp_enqueue_script('metabox-customosts', JAW_CUSTOMPOSTS_URI . 'assets/js/metabox.js', array('jquery', 'angular', 'jaw_gallerypicker', 'simplemediapicker'));
        }

        public function addPage() {
            $page = add_plugins_page('JaW Custom Posts', 'JaW Custom Posts', 'manage_options', $this->_name, array(&$this, 'doPage'));
        }

        public function doPage() {
            if (!current_user_can('manage_options')) {
                wp_die('You do not have sufficient permissions to access this page.');
            }


            echo '<div id="cp-check" class="wrap">';
            echo '<div id="icon-plugins" class="icon32"><br /></div>
            <h2>JaW Custom Posts</h2>';
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
                <p>This plugin is used exclusively for the JaW Templates Themes. Here you can activate and deactivate post types for this sites.</p>
                <h3>Custom Post Types</h3>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row">Allow</th>
                            <th scope="row">Rewrite</th>
                        </tr>

                        <?php
                        foreach ((array) $this->_avaible as $key => $item) {
                           if (in_array($key, $this->_data['avaible'])) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
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
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if(isset($this->_data['active'][$key]['rewrite'])){
                                                $val = $this->_data['active'][$key]['rewrite'];
                                            }else{
                                                $val = '';
                                            }
                                        ?>
                                        <input type="text" value="<?php echo $val; ?>" id="<?php echo $key . '_rewrite'; ?>" name="rewrite[<?php echo $key; ?>]">
                                    </td>

                                </tr>
                                <?php
                             }
                        }
                        ?>

                    </tbody>

                </table>


                <?php submit_button(null, 'primary', $this->_name); ?>

            </form>

            <?php
            return ob_get_clean();
        }

        function defaultSettings() {
            return $this->_avaible;
        }

        static function storeData($data) {

            update_option(self::$_name, $data);
        }

        function jaw_modify_admin_bar($wp_admin_bar) {
            if (current_user_can('manage_options')) {
                $wp_admin_bar->add_menu(array(
                    'parent' => 'jaw_options',
                    'id' => 'jaw_customposts',
                    'title' => __('JaW Custom Posts', 'jawtemplates'),
                    'href' => admin_url('plugins.php?page=jaw_customposts')
                ));
            }
        }

    }

    global $jaw_customposts_class;
    $jaw_customposts_class = jaw_customposts::getInstance();
}

