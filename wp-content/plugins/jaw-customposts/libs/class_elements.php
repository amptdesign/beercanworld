<?php

/**
 * Library of HTML elements. Use only in admin area
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwPluginsElements')) {

    class jwPluginsElements {

        private static $_instance = null;
        private static $_search_title = '';

        public static function getInstance() {
            if (self::$_instance == null) {
                self::$_instance = new jwElements();
            }


            return self::$_instance;
        }

        /*
         * Render element for taxonomies (Category option)
         * @param $value array
         * @param $data mixed
         * $param layout mixed (add or edit)
         */

        public static function render_metatax($value, $data = null, $layout = 'default') {

            $defaults = array();
            $menu = '';
            $output = '';



            $val = '';

            if (isset($value['type']) && !in_array($value['type'], array('headingstart', 'headingend'))) {
                $class = '';
                if (isset($value['class'])) {
                    $class = $value['class'];
                }
//hide items in checkbox group
                $fold = '';

                if (is_array($value) && array_key_exists("fold", $value)) {
                    if (isset($data[$value['fold']])) {
                        $fold = "f_" . $value['fold'] . " ";
                    } else {
                        $fold = "f_" . $value['fold'] . " temphide ";
                    }
                }


//only show header if 'name' value exists
                if (isset($value['label'])) {
                    switch ($layout) {
                        case 'edit':
                            $output .= '<tr class="form-field ' . $class . '">';
                            $output .= '<th scope="row" valign="top"><label for="' . $value['id'] . '">' . $value['label'] . '</label></th>' . "\n";
                            $output .= '<td>';
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";
                            break;
                        default:
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . ' form-field">' . "\n";

                            $output .= '<h4 class="heading">' . $value['label'] . '</h4>' . "\n";
                            break;
                    }
                }

                if (isset($value['space']) && $value['space'])
                    $output .= '<div class="space">&nbsp;</div>';

                $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
            }
            $c = "element_" . $value['type'];
            if (method_exists(get_class(), $c)) {
                $output .= jwElements::$c($value, $data);
            } else {
                $output .= 'Element not found in class_elements.php';
            }


//description of each option
            if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend") {

                if (!isset($value['desc'])) {
                    $explain_value = '';
                } else {
                    $explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
                }

                $output .= '</div><!-- end controls -->' . $explain_value . "\n";

                $output .= '<div class="clear"></div>
                </div><!-- end options -->
                </div><!-- end section jw_option -->' . "\n";

                if ($layout == 'edit') {
                    $output .= '</div></td></tr>';
                }
            }






            return $output;
        }

        public static function element_headingstart($value, $data = null) {

            $output = '';
            $jquery_click_hook = str_replace(' ', '', strtolower($value['name']));
            $jquery_click_hook = "of-option-" . $jquery_click_hook;

            $output .= '<div class="group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";

            return $output;
        }

        public static function element_headingend($value, $data = null) {
            return '</div>' . "\n";
        }

        public static function element_sectionstart($value, $data = null) {
            $output = '';
            $output .= '<div class="section sub_all" ><h3>' . $value['name'] . '</h3>';
            $output .= '<div class="section sub" >';
            return $output;
        }

        public static function element_sectionend($value, $data = null) {
            return '</div></div>';
        }

        public static function element_text($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $evalue = str_replace('"', '&quot;', str_replace('\'', '&quot;', ((string) $evalue)));
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            $t_value = (string) $evalue;

            $class = '';
            if (isset($value['mod'])) {
                $class .= $value['mod'];
            }
            if (isset($value['class'])) {
                $class .= ' ' . $value['class'];
            }
            if (isset($value['maxlength'])) {
                $maxlength = 'maxlength=' . $value['maxlength'];
            } else {
                $maxlength = '';
            }
            if (!isset($value['type'])) {
                $value['type'] = 'text';
            }

            $output .= '<input class="of-input ' . $class . '" name="' . $value['id'] . '"  ' . $maxlength . ' id="' . self::convert($value['id']) . '" type="' . $value['type'] . '" value="' . $t_value . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"/>';
            return $output;
        }

        public static function element_select($value, $data = null, $type = 'default') {

            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $value['std'] . '\');';
            } else {
                $evalue = '';
            }
            if (!isset($value['mod'])) {
                $mini = '';
            } else {
                $mini = $value['mod'];
            }
            if (!isset($value['options'])) {
                $value['options'] = '';
            }
            $output .= '<div class="select_wrapper ' . $mini . '">';
            $angular = '';
            if (isset($value['builder']) && $value['builder'] == 'true') {
                $angular .= 'ng-model="edit[\'' . $value['id'] . '\']" ng-init="options[\'' . $value['id'] . '\'] = ' . str_replace('"', "'", json_encode($value['options'])) . '; ' . $a_default . '"';
            }
            $output .= '<select class="classic-select" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '"  ' . $angular . '>';
            if (isset($value['options']) && count($value['options']) > 0)
                foreach ((array) $value['options'] as $select_ID => $option) {
                    $output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($evalue, $select_ID, false) . ' >' . $option . '</option>';
                }
            $output .= '</select></div>';
            return $output;
        }

        public static function element_textarea($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';

            $cols = '20';
            $rows = '4';
            $class = '';

            if (isset($value['cols'])) {
                $cols = $value['cols'];
            }
            if (isset($value['rows'])) {
                $rows = $value['rows'];
            }

            if (isset($value['style'])) {
                $class = $value['style'];
            }


            $ta_value = stripslashes($evalue);
            $output .= '<textarea class="of-input wp-editor-area ' . $class . '" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" cols="' . $cols . '" rows="' . $rows . '" ng-init="' . $a_default . '" ng-model="edit[\'' . $value['id'] . '\']" value="{{edit[\'' . $value['id'] . '\']}}">' . $ta_value . '</textarea>';
            return $output;
        }

        public static function element_list($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $t_value = '';
            $t_value = stripslashes((string) $evalue);

            if (isset($value['mod'])) {
                $mod = $value['mod'];
            } else {
                $mod = 'text';
            }
            $j = json_decode($evalue);
            $json = json_encode($j, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); // osentreni ' v textu 

            $output .= '<input type="hidden" ng-init="init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $json)) . '\'));" name="' . $value['id'] . '" value="{{edit.' . $value['id'] . '}}"  ng-model="edit.' . $value['id'] . '" />';
            $output .= '<div class="list-li ' . $mod . '" ng-repeat="(ied, ed) in edit.' . $value['id'] . ' track by ied ">';
            if ($mod == 'text') {
                $output .= '<input class="of-input" id="' . self::convert($value['id']) . '" type="text" value="' . $t_value . '"  ng-model="ed[\'' . $value['id'] . '\']" />';
            } else {
                $output .= '<textarea class="of-input" id="' . self::convert($value['id']) . '" type="text"   ng-model="ed[\'' . $value['id'] . '\']" >' . $t_value . '</textarea>';
            }
            $output .= '<button type="button" class="list_delete_button button-primary builder red jaw" ng-click="del_edit(\'' . $value['id'] . '\',ied)" ><i class="jaw-icon-white jaw-icon-remove"></i></button>';
            $output .= '</div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="jaw-icon-white jaw-icon-plus"></i></a>';
            return $output;
        }

        public static function element_simple_media_picker($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';
            $_id = strip_tags(strtolower($value['id']));
            if (!isset($value['mod'])) {
                $value['mod'] = '';
            }
            $multiple = '';
            if (isset($value['multiple']) && $value['multiple']) {
                $multiple = 'multiple="' . $value['multiple'] . '"';
            }

            $output .= '<span ng-init="' . $a_default . '" ></span>';
            $output .= '<div simplemediapicker ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '" ' . $multiple . ' mod="' . $value['mod'] . '"></div>';


            return $output;
        }

        public static function element_media_picker($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';
            $_id = strip_tags(strtolower($value['id']));
            if (!isset($value['mod']))
                $value['mod'] = '';

            $output .= '<span ng-init="' . $a_default . '" ></span>';
            $output .= '<div gallerypicker ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '"></div>';

            return $output;
        }

        public static function element_color($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            if (isset($value['format'])) {
                $format = $value['format'];
            } else {
                $format = 'hex';
            }
            $output .= '<div class="input-append color" data-color="rgb(0, 0, 0)"  ng-init="' . $a_default . '" >';
            $output .= '<input type="text" colorpicker="' . $format . '" ng-model="edit[\'' . $value['id'] . '\']" value="{{edit[\'' . $value['id'] . '\']}}"  name="' . $value['id'] . '"/>';
            $output .= '<span class="add-on"><i ng-style="{\'background-color\':\'{{edit[\'' . $value['id'] . '\']}}\'}"></i></span>';
            $output .= '</div>';
            return $output;
        }

        public static function element_layout($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $i = 0;

            $select_value = $evalue;
            if (isset($value['extend']) && !empty($value['extend'])) {
                $rel = ' rel="' . $value['extend'] . '"';
                $page = 'page_layout ';
            } else {
                $rel = '';
                $page = '';
            }
            foreach ($value['options'] as $key => $option) {
                $i++;

                $check = '';
                $checked = '';
                $selected = '';
                if (NULL != checked($evalue, $key, false)) {
                    $checked = checked($evalue, $key, false);
                    $selected = 'of-radio-img-selected';
                    $check = 'check';
                }



                $output .= '<div class="jw-option-layout radio-layout ' . $selected . '">';
                $output .= '<label val="' . $key . '" ' . $rel . '  for="' . $value['id'] . '-' . $key . '-sidebar">';
                $output .= '<img alt="page-option-sidebar-template" src="' . $option . '" />';
                $output .= '</label>';
                $output .= '<input autocomplete="off" type="radio" ' . $checked . ' id="' . $value['id'] . '-' . $key . '-sidebar" value="' . $key . '" name="' . $value['id'] . '"> ';
                $output .= '</div>';
            }
            return $output;
        }

        public static function convert($id) {
            $id = str_replace('[', '-', $id);
            $id = str_replace(']', '', $id);

            return $id;
        }

    }

}
