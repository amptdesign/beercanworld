
/*
 *  For wordpress >=3.9 (tinemce 4+)
 * 
 */


// main manu storing
var jaw_menu = [];




/////////////////////////////////////////////////////////////////////////////////
// start submenu

var jaw_content_submenu = [];

if (jawelement.jaw_button != null) {

    jaw_content_submenu.push(
            {text: 'Button',
                icon: ' jaw-icon jaw-icon-radio-checked icon-radio-checked',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'button'
                    })
                }}
    );
}

if (jawelement.jaw_divider != null) {

    jaw_content_submenu.push(
            {text: 'Divider',
                icon: ' jaw-icon jaw-icon jaw-icon-minus icon-minus',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'divider'
                    })
                }}
    );
}

if (jawelement.jaw_image != null) {

    jaw_content_submenu.push(
            {text: 'Image',
                icon: ' jaw-icon jaw-icon-image icon-image',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'image'
                    })
                }}
    );
}

if (jawelement.jaw_list != null) {

    jaw_content_submenu.push(
            {text: 'List',
                icon: ' jaw-icon jaw-icon-list2 icon-list2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'list'
                    })
                }}
    );
}

if (jawelement.jaw_author != null) {

    jaw_content_submenu.push(
            {text: 'About author',
                icon: ' jaw-icon jaw-icon-user4 icon-user4',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'author'
                    })
                }});
}

if (jawelement.jaw_blog != null) {

    jaw_content_submenu.push(
            {text: 'Blog',
                icon: ' jaw-icon jaw-icon-newspaper icon-newspaper',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'blog'
                    })
                }});
}

if (jawelement.jaw_title != null) {

    jaw_content_submenu.push(
            {text: 'Title',
                icon: ' jaw-icon jaw-icon-type icon-type',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'title'
                    })
                }});
}


var jaw_soc_submenu = [];

if (jawelement.jaw_social_icons != null) {

    jaw_soc_submenu.push(
            {text: 'Social icons',
                icon: ' jaw-icon jaw-icon-facebook4 icon-facebook4',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'social_icons'
                    })
                }}
    );
}

if (jawelement.jaw_v_video != null) {

    jaw_soc_submenu.push(
            {text: 'Vimeo video',
                icon: ' jaw-icon jaw-icon-vimeo3 icon-vimeo3',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'v_video'
                    })
                }}
    );
}

if (jawelement.jaw_y_video != null) {

    jaw_soc_submenu.push(
            {text: 'YouTube video',
                icon: ' jaw-icon jaw-icon-youtube icon-youtube',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'y_video'
                    })
                }}
    );
}


var jaw_feat_submenu = [];

if (jawelement.jaw_contact != null) {

    jaw_feat_submenu.push(
            {text: 'Contact',
                icon: ' jaw-icon jaw-icon-phone icon-phone',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'contact'
                    })
                }});
}

if (jawelement.jaw_gallery != null) {

    jaw_feat_submenu.push(
            {text: 'Gallery',
                icon: ' jaw-icon jaw-icon-images2 icon-images2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'gallery'
                    })
                }});
}

if (jawelement.jaw_media_gallery != null) {

    jaw_feat_submenu.push(
            {text: 'Media Gallery',
                icon: ' jaw-icon jaw-icon-images2 icon-images2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'media_gallery'
                    })
                }});
}

if (jawelement.jaw_media_gallery_single != null) {

    jaw_feat_submenu.push(
            {text: 'Media Gallery Single',
                icon: ' jaw-icon jaw-icon-images2 icon-images2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'media_gallery_single'
                    })
                }});
}

if (jawelement.jaw_google_map != null) {

    jaw_feat_submenu.push(
            {text: 'Google Map',
                icon: ' jaw-icon jaw-icon-map icon-map',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'google_map'
                    })
                }});
}

if (jawelement.jaw_icon != null) {

    jaw_feat_submenu.push(
            {text: 'Icon',
                icon: ' jaw-icon jaw-icon-IcoMoon icon-IcoMoon',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'icon'
                    })
                }});
}

if (jawelement.jaw_bing_map != null) {

    jaw_feat_submenu.push(
            {text: 'Bing Map',
                icon: ' jaw-icon jaw-icon-map2 icon-map2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'bing_map'
                    })
                }});
}

if (jawelement.jaw_countdown != null) {

    jaw_feat_submenu.push(
            {text: 'Countdown',
                icon: ' jaw-icon jaw-icon-clock icon-clock',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'countdown'
                    })
                }});
}

if (jawelement.jaw_iframe != null) {

    jaw_feat_submenu.push(
            {text: 'Iframe',
                icon: ' jaw-icon jaw-icon-file3 icon-file3',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'iframe'
                    })
                }});
}

if (jawelement.jaw_qrcode != null) {

    jaw_feat_submenu.push(
            {text: 'QR code',
                icon: ' jaw-icon jaw-icon-qrcode icon-qrcode',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'qrcode'
                    })
                }});
}

if (jawelement.jaw_one_progressbar != null) {

    jaw_feat_submenu.push(
            {text: 'Progress bar',
                icon: ' jaw-icon jaw-icon-bars2 icon-bars2',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'one_progressbar'
                    })
                }});
}

/*
 if(jawelement.jaw_pricing_table != null ) {
 
 jaw_feat_submenu.push(
 
 {text: 'Pricing table',
 icon: ' jaw-icon jaw-icon-coin icon-coin',
 onclick: function() {
 tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
 title: title,
 identifier: 'pricing_table'
 })
 }});
 }*/

var jaw_txtcont_submenu = [];

if (jawelement.jaw_accordion != null) {

    jaw_txtcont_submenu.push(
            {text: 'Accordion',
                icon: ' jaw-icon jaw-icon-stack-list icon-stack-list',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'accordion'
                    })
                }}
    );
}

if (jawelement.jaw_quote != null) {

    jaw_txtcont_submenu.push(
            {text: 'BlockQuote',
                icon: ' jaw-icon jaw-icon-quotes-left icon-quotes-left',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'quote'
                    })
                }}
    );
}

if (jawelement.jaw_cta != null) {

    jaw_txtcont_submenu.push(
            {text: 'Call to action',
                icon: ' jaw-icon jaw-icon-newspaper icon-newspaper',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'cta'
                    })
                }}
    );
}

if (jawelement.jaw_googlefonts != null) {

    jaw_txtcont_submenu.push(
            {text: 'Google Fonts',
                icon: ' jaw-icon jaw-icon-font icon-font',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'googlefonts'
                    })
                }}
    );
}

if (jawelement.jaw_panel_box != null) {

    jaw_txtcont_submenu.push(
            {text: 'Info box',
                icon: ' jaw-icon jaw-icon-info icon-info',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'panel_box'
                    })
                }}
    );
}

if (jawelement.jaw_message != null) {

    jaw_txtcont_submenu.push(
            {text: 'Message text',
                icon: ' jaw-icon jaw-icon-pen icon-pen',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'message'
                    })
                }}
    );
}

if (jawelement.jaw_tabs != null) {

    jaw_txtcont_submenu.push(
            {text: 'Tabs',
                icon: ' jaw-icon jaw-icon-insert-template icon-insert-template',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'tabs'
                    })
                }}
    );
}

var jaw_post_sub = [];

if (jawelement.jaw_faq != null) {

    jaw_post_sub.push(
            {text: 'FAQ',
                icon: ' jaw-icon jaw-icon-question icon-question',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'faq'
                    })
                }}
    );
}

if (jawelement.jaw_portfolio != null) {

    jaw_post_sub.push(
            {text: 'Portfolio',
                icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'portfolio'
                    })
                }}
    );
}

if (jawelement.jaw_team != null) {

    jaw_post_sub.push(
            {text: 'Team',
                icon: ' jaw-icon jaw-icon-users4 icon-users4',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'team'
                    })
                }}
    );
}

if (jawelement.jaw_testimonial != null) {

    jaw_post_sub.push(
            {text: 'Testimonial',
                icon: ' jaw-icon jaw-icon-bubble6 icon-bubble6',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'testimonial'
                    })
                }}
    );
}


var jaw_car_sub = [];

if (jawelement.jaw_blog_carousel != null) {

    jaw_car_sub.push(
            {text: 'Blog carousel',
                icon: ' jaw-icon jaw-icon-stack-picture icon-stack-picture',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'blog_carousel'
                    })
                }}
    );
}

if (jawelement.jaw_blog_carousel_vertical != null) {

    jaw_car_sub.push(
            {text: 'Blog carousel vertical',
                icon: ' jaw-icon jaw-icon-stack-picture icon-stack-picture',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'blog_carousel_vertical'
                    })
                }}
    );
}

if (jawelement.jaw_testimonial_carousel != null) {

    jaw_car_sub.push(
            {text: 'Testimonial carousel',
                icon: ' jaw-icon jaw-icon-stack-picture icon-stack-picture',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'testimonial_carousel'
                    })
                }}
    );
}

if (jawelement.jaw_testimonial_carousel_vertical != null) {

    jaw_car_sub.push(
            {text: 'Testimonial carousel vertical',
                icon: ' jaw-icon jaw-icon-stack-picture icon-stack-picture',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                        title: title,
                        identifier: 'testimonial_carousel_vertical'
                    })
                }}
    );
}
// end of submenu
/////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////
// main menu

// COLUMNS
if (jawelement.jaw_section != null) {

    jaw_menu.push(
            {
                text: 'Columns',
                menu: [
                    {text: 'Row',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_row]' + tinymce.activeEditor.selection.getContent() + '[/jaw_row]');
                        }},
                    {text: '1/1',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="12"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }},
                    {text: '1/2',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="6"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }},
                    {text: '1/3',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="4"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '2/3',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="8"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '1/4',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="3"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '3/4',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="9"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '1/6',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="2"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '5/6',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="10"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                ]
            });
}

// CONTENT
if (jawelement.jaw_divider != null || jawelement.jaw_image != null || jawelement.jaw_list != null || jawelement.jaw_button != null) {

    jaw_menu.push({
        text: 'Content',
        menu: jaw_content_submenu
    });
}

// HEADERS
if (jawelement.jaw_h != null) {

    jaw_menu.push(
            {
                text: 'Headlines',
                icon: '',
                menu: [
                    {text: 'H1',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h1]' + tinymce.activeEditor.selection.getContent() + '[/h1]');
                        }},
                    {text: 'H2',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h2]' + tinymce.activeEditor.selection.getContent() + '[/h2]');
                        }},
                    {text: 'H3',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h3]' + tinymce.activeEditor.selection.getContent() + '[/h3]');
                        }},
                    {text: 'H4',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h4]' + tinymce.activeEditor.selection.getContent() + '[/h4]');
                        }},
                    {text: 'H5',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h5]' + tinymce.activeEditor.selection.getContent() + '[/h5]');
                        }},
                    {text: 'H6',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[h6]' + tinymce.activeEditor.selection.getContent() + '[/h6]');
                        }},
                ]
            }
    );
}

// SOCIALS
if (jawelement.jaw_y_video != null || jawelement.jaw_v_video != null || jawelement.jaw_social_icons != null) {

    jaw_menu.push(
            {
                text: 'Social & Media',
                menu: jaw_soc_submenu
            }

    );
}

// TEXT CONTENT
if (jawelement.jaw_quote != null || jawelement.jaw_tabs != null || jawelement.jaw_message != null || jawelement.jaw_panel_box != null || jawelement.jaw_googlefonts != null || jawelement.jaw_cta != null || jawelement.jaw_accordion != null) {

    jaw_menu.push(
            {
                text: 'Text content',
                menu: jaw_txtcont_submenu
            }
    );
}

// FEATURES
if (jawelement.jaw_contact != null || jawelement.jaw_gallery != null || jawelement.jaw_google_map != null || jawelement.jaw_icon != null || jawelement.jaw_comments != null || jawelement.jaw_countdown != null || jawelement.jaw_iframe != null || jawelement.jaw_qrcode != null || jawelement.jaw_one_progressbar != null) {

    jaw_menu.push(
            {
                text: 'Features',
                menu: jaw_feat_submenu}
    );
}

// POST TYPES
if (jawelement.jaw_faq != null || jawelement.jaw_portfolio != null || jawelement.jaw_team != null || jawelement.jaw_testimonial != null) {

    jaw_menu.push(
            {
                text: 'Post types',
                menu: jaw_post_sub}
    );
}

// CAROUSEL
if (jawelement.jaw_blog_carousel != null || jawelement.jaw_blog_carousel_vertical != null || jawelement.jaw_testimonial_carousel != null || jawelement.jaw_testimonial_carousel_vertical != null) {

    jaw_menu.push(
            {
                text: 'Carousels',
                menu: jaw_car_sub}
    );
}

// SLIDERS
if (jawelement.jaw_slider != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'J&W Slider',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider'
                            })
                        }}
                ]}
    );
}
if (jawelement.jaw_slider_1 != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'Special Slider',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider_1'
                            })
                        }}
                ]}
    );
}
if (jawelement.jaw_slider_2 != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'Stripe Slider',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider_2'
                            })
                        }}
                ]}
    );
}
if (jawelement.jaw_slider_3 != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'Titles Slider',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider_3'
                            })
                        }}
                ]}
    );
}
if (jawelement.jaw_slider_4 != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'Fullwidth Stripe Slider',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider_4'
                            })
                        }}
                ]}
    );
}
if (jawelement.jaw_slider_5 != null) {

    jaw_menu.push(
            {
                text: 'Sliders',
                menu: [
                    {text: 'J&W Grid',
                        icon: ' jaw-icon jaw-icon-notebook icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider_grid'
                            })
                        }}
                ]}
    );
}

/////////////////////////////////////////////////////////////////////////////////
// end of main menu



tinymce.PluginManager.add('jaw_shortcodes', function(editor, url) {
    // Add a button that opens a window


    editor.addButton('jaw_shortcodes', {
        title: 'Insert Shortcode',
        icon: 'jawshortcodeicon',
        type: 'menubutton',
        menu: jaw_menu
    });

    editor.addCommand("jaw_shortcodes", function(a, params)
    {



        // load thickbox
        tb_show("Insert JaW Shortcode", ajaxurl + '?action=jaw_sc_editor_dialog&code=' + params.identifier);


        var id_list = 1;

        jQuery('#TB_window').find('.add-list').live('click', function() {

            jQuery(this).parent().find('.list-li').last().after('<div class="list-li" >'
                    + '<input id="list" class="of-input" type="text" value="" name="' + jQuery(this).attr('id') + '-' + (id_list++) + '">'
                    + '</div>');
        });


        // adding markers
        var element_list = 1;

        jQuery('#TB_window').find('.add-marker').live('click', function() {

            jQuery(this).parent().find('.list-li').last().after(
                    '<div id=jaw_shortcode_inputs-' + element_list + ' class="list-li" >'
                    + '<input id="list" class="of-input" type="text" value="" name="markers[' + element_list + '][latitude]">'
                    + '</div>'
                    + '<div class="list-li" >'
                    + '<input id="list" class="of-input" type="text" value="" name="markers[' + element_list + '][longitude]">'
                    + '</div>'
                    + '<div class="list-li" >'
                    + '<textarea class="of-input" name="markers[' + element_list + '][description_marker]" cols="22" rows="1"></textarea>'
                    + '</div>'
                    + '<div class="list-li" >'
                    + '<select class="of-input" name="markers[' + element_list + '][descriptionopened]"><option id="1" value="1" selected="selected">On</option><option id="0" value="0">Off</option></select>'
                    + '</div>');

            element_list++;
        });





    });
});

var insert_shortcode = function(type) {
    var data = new Object();
    jQuery('#jaw_shortcodes input, #jaw_shortcodes select , #jaw_shortcodes textarea').each(function() {
        data[jQuery(this).attr('name').toString()] = jQuery(this).val();
    });
    jQuery.post(
            ajaxurl,
            {
                'action': 'jaw_shortcodes_ajax',
                'data': data,
                'type': type
            },
    function(response) {

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + response);
        tb_remove();
    }
    );
};
