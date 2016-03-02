/*
 *  For wordpress <=3.8 (tinemce 3+)
 * 
 */
(function() {
    

    var thm;
    tinymce.create('tinymce.plugins.jaw_shortcodes', {
        init: function(ed, url) {
            thm = url;
            ed.addCommand("jaw_shortcodes", function(a, params)
            {
                var code = params.identifier;

                // load thickbox
                tb_show("Insert JaW Shortcode", url + "/editor.php?code=" + code + "&width=" + 640 + "&height=" + 440);

                var id_list = 1;
                jQuery('#TB_window').find('.add-list').live('click', function() {

                    jQuery(this).parent().find('.list-li').last().after('<div class="list-li" >'
                            + '<input id="list" class="of-input" type="text" value="" name="' + jQuery(this).attr('id') + '-' + (id_list++) + '">'
                            + '</div>');
                });



            });

        },
        createControl: function(n, cm) {
            switch (n) {
                case 'jaw_shortcodes':
                    var c = cm.createMenuButton('jaw_shortcodes', {
                        title: 'Insert Shortcode',
                        image: thm + '/assets/img/shortcodes-icon.gif',
                        icons: false
                    });
                    
                    c.onRenderMenu.add(function(c, m) {
                        var sub;
                        
                        if(jawelement.jaw_section != null) {
                            
                            /* START COLUMNS **************************************/
                            sub = m.addMenu({
                                title: 'Columns'
                            });

                           sub.add({
                                title: '1/2',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="6"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });



                            sub.add({
                                title: '1/3',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="4"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });



                            sub.add({
                                title: '2/3',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="8"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });



                            sub.add({
                                title: '1/4',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="3"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });



                            sub.add({
                                title: '3/4',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="9"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });

                            sub.add({
                                title: '1/6',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="2"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });


                            sub.add({
                                title: '5/6',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[jaw_section size="10"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                                }
                            });
                            /* END COLUMNS ****************************************/
                        }
                        
                        if(jawelement.jaw_divider != null || jawelement.jaw_image != null || jawelement.jaw_list != null || jawelement.jaw_button != null) {
                            
                            /* START Content *************************************/
                            sub = m.addMenu({
                                title: 'Content'
                            });
                        }
                        if(jawelement.jaw_button != null) {
                            sub.add({
                                title: '<i class="icon-radio-checked"></i> Button',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'button'
                                    })
                                }
                            });}
                        if(jawelement.jaw_divider != null) {
                            sub.add({
                                title: '<i class="icon-minus"></i> Divider',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'divider'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_image != null) {
                            sub.add({
                                title: '<i class="icon-image"></i> Image',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'image'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_list != null) {
                            sub.add({
                                title: '<i class="icon-list2"></i> List',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'list'
                                    })
                                }
                            });
                        }

                            /* END Content ***************************************/
                        
                        if(jawelement.jaw_y_video != null || jawelement.jaw_v_video != null || jawelement.jaw_social_icons != null) {
                            
                            /* START Social & Media *************************************/
                        sub = m.addMenu({
                            title: 'Social & Media'
                        });
                        }
                        
                        if(jawelement.jaw_social_icons != null) {
                        sub.add({
                            title: '<i class="icon-facebook4"></i> Social icons',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'social_icons'
                                })
                            }
                        });
                        }
                        
                        if(jawelement.jaw_v_video != null) {
                        sub.add({
                            title: '<i class="icon-vimeo3"></i> Vimeo video',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'v_video'
                                })
                            }
                        });
                        }
                        
                        if(jawelement.jaw_y_video != null) {
                        sub.add({
                            title: '<i class="icon-youtube"></i> YouTube video',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'y_video'
                                })
                            }
                        });
                        }
                        
                        /* END Social & Media ***************************************/
                        
                        if(jawelement.jaw_quote != null || jawelement.jaw_accordion != null || jawelement.jaw_cta != null || jawelement.jaw_panel_box != null || jawelement.jaw_message != null || jawelement.jaw_tabs != null) {
                        
                            /* START text content *************************************/
                            sub = m.addMenu({
                                title: 'Text content'
                            });
                        }
                        
                        if(jawelement.jaw_quote != null) {
                            sub.add({
                                title: '<i class="icon-quotes-left"></i> BlockQuote',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'quote'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_accordion != null) {
                            sub.add({
                                title: '<i class="icon-stack-list"></i> Accordion',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'accordion'
                                    })
                                }
                            });
                        }

                        if(jawelement.jaw_cta != null) {

                            sub.add({
                                title: '<i class="icon-newspaper"></i> Call to action',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'cta'
                                    })
                                }
                            });
                        }

                        if(jawelement.jaw_cta != null) {
                            sub.add({
                                title: '<i class="icon-font"></i> Google Fonts',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'googlefonts'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_h != null) {
                            
                            /* START text content *************************************/
                            sub = m.addMenu({
                                title: 'Headlines'
                            });
                            sub.add({
                            title: 'h1',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h1]' + tinymce.activeEditor.selection.getContent() + '[/h1]');
                            }
                        });

                        sub.add({
                            title: 'h2',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h2]' + tinymce.activeEditor.selection.getContent() + '[/h2]');
                            }
                        });

                        sub.add({
                            title: 'h3',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h3]' + tinymce.activeEditor.selection.getContent() + '[/h3]');
                            }
                        });

                        sub.add({
                            title: 'h4',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h4]' + tinymce.activeEditor.selection.getContent() + '[/h4]');
                            }
                        });

                        sub.add({
                            title: 'h5',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h5]' + tinymce.activeEditor.selection.getContent() + '[/h5]');
                            }
                        });

                        sub.add({
                            title: 'h6',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h6]' + tinymce.activeEditor.selection.getContent() + '[/h6]');
                            }
                        });                        
                        }
                        
                        if(jawelement.jaw_panel_box != null) {
                        sub.add({
                            title: '<i class="icon-info"></i> Info box',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'panel_box'
                                })
                            }
                        });
                    }
                    if(jawelement.jaw_message != null) {
                        sub.add({
                            title: '<i class="icon-pen"></i> Message text',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'message'
                                })
                            }
                        });
                    }
                    if(jawelement.jaw_tabs != null) {

                        sub.add({
                            title: '<i class="icon-insert-template"></i> Tabs',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'tabs'
                                })
                            }
                        });
                    }

                        /* END text content ***************************************/
                        
                        if(jawelement.jaw_contact != null || jawelement.jaw_gallery != null || jawelement.jaw_google_map != null || jawelement.jaw_icon != null || jawelement.jaw_countdown != null || jawelement.jaw_iframe != null || jawelement.jaw_qrcode != null || jawelement.jaw_pricing_table != null || jawelement.jaw_one_progressbar != null) {
    
                            /* FEATURES *******************************************/
                            sub = m.addMenu({
                                title: 'Features'
                            });
                        }
                        
                        if(jawelement.jaw_contact != null) {
                            sub.add({
                                title: '<i class="icon-phone"></i> Contact',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'contact'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_countdown != null) {
                            sub.add({
                                title: '<i class="icon-clock"></i> Countdown',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'countdown'
                                    })
                                }
                            });
                            }

                        if(jawelement.jaw_gallery != null) {
                            sub.add({
                                title: '<i class="icon-images2"></i> Gallery',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'gallery'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_google_map != null) {
                            sub.add({
                                title: '<i class="icon-map"></i> Google Map',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'google_map'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_icon != null) {
                            sub.add({
                                title: '<i class="icon-IcoMoon"></i> Icon',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'icon'
                                    })
                                }
                            });
                            }
                            
                        if(jawelement.jaw_iframe != null) {
                            sub.add({
                                title: '<i class="icon-file3"></i> Iframe',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'iframe'
                                    })
                                }
                            });
                        }
                        if(jawelement.jaw_qrcode != null) {
                            sub.add({
                                title: '<i class="icon-qrcode"></i> QR code',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'qrcode'
                                    })
                                }
                            });
                        }
                        
                        /*if(jawelement.jaw_pricing_table != null) {
                            
                             sub.add({
                             title: '<i class="icon-coin"></i> Pricing table',
                             onclick: function() {
                             tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                             title: title,
                             identifier: 'pricing_table'
                             })
                             }
                             });
                         }*/
                        if(jawelement.jaw_one_progressbar != null) {
                            sub.add({
                                title: '<i class="icon-bars2"></i> Progress bar',
                                onclick: function() {
                                    tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                        title: title,
                                        identifier: 'one_progressbar'
                                    })
                                }
                            });
                            }
                            /* END FEATURES ***************************************/

                            if(jawelement.jaw_faq != null || jawelement.jaw_portfolio != null || jawelement.jaw_team != null || jawelement.jaw_testimonial != null) {
                        /* START POST TYPES **********************************************/
                        sub = m.addMenu({
                            title: 'Post types'
                        });
                        }
                        
                        if(jawelement.jaw_faq != null) {
                        sub.add({
                            title: '<i class="icon-question"></i> FAQ',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'faq'
                                })
                            }
                        });
                    }
                    if(jawelement.jaw_portfolio != null) {
                        sub.add({
                            title: '<i class="icon-notebook"></i> Portfolio',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'portfolio'
                                })
                            }
                        });
                        }
                        if(jawelement.jaw_team != null) {
                        sub.add({
                            title: '<i class="icon-users4"></i> Team',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'team'
                                })
                            }
                        });
                    }
                    if(jawelement.jaw_testimonial != null) {
                        sub.add({
                            title: '<i class="icon-bubble6"></i> Testimonial',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial'
                                })
                            }
                        });
                        }
                        /* END POST TYPES ******************************************/

                    if(jawelement.jaw_blog_carousel != null || jawelement.jaw_blog_carousel_vertical != null || jawelement.jaw_testimonial_carousel != null || jawelement.jaw_testimonial_carousel_vertical != null) {
                        
                        /* START carousel **********************************************/
                        sub = m.addMenu({
                            title: 'Carousels'
                        });
                    }
                        
                    if(jawelement.jaw_blog_carousel != null) {
                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Blog carousel',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blog_carousel'
                                })
                            }
                        });
                    }
                    
                    if(jawelement.jaw_blog_carousel_vertical != null) {
                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Blog carousel vertical',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blog_carousel_vertical'
                                })
                            }
                        });
                    }
                    
                    if(jawelement.jaw_testimonial_carousel != null) {
                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Testimonial carousel',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial_carousel'
                                })
                            }
                        });
                    }
                    
                    if(jawelement.jaw_testimonial_carousel_vertical != null) {
                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Testimonial carousel vertical',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial_carousel_vertical'
                                })
                            }
                        });
                        }
                        /* END carousel ******************************************/

                    if(jawelement.jaw_slider != null) {
                        /* START Sliders **********************************************/
                        sub = m.addMenu({
                            title: 'Sliders'
                        });
                        sub.add({
                            title: '<i class="icon-notebook"></i> J&W slider',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'slider'
                                })
                            }
                        });

                        /* END Sliders ******************************************/
                    }
                    });

                    // Return the new menu button instance
                    return c;
            }

            return null;
        },
        getInfo: function() {
            return {
                longname: 'JaW Shortcodes',
                author: 'JaW Templates',
                authorurl: 'http://themeforest.net/user/jawtemplates/',
                infourl: 'http://www.jawtemplates.com/',
                version: "1.0"
            }
        }
    });
    tinymce.PluginManager.add('jaw_shortcodes', tinymce.plugins.jaw_shortcodes);
})();


// adding markers
var element_list = 1;

jQuery('#TB_window').find('#markers').live('click',function() {

    jQuery(this).parent().find('.list-li').last().after(
            '<div id=jaw_shortcode_inputs-'+element_list+' class="list-li" >'
            + '<input id="list" class="of-input" type="text" value="" name="markers['+element_list+'][latitude]">'
            + '</div>'
            + '<div class="list-li" >'
            + '<input id="list" class="of-input" type="text" value="" name="markers['+element_list+'][longitude]">'
            + '</div>'
            + '<div class="list-li" >'
            + '<textarea class="of-input" name="markers['+element_list+'][description_marker]" cols="22" rows="1"></textarea>'
            + '</div>'
            + '<div class="list-li" >'
            + '<select class="of-input" name="markers['+element_list+'][descriptionopened]"><option id="1" value="1" selected="selected">On</option><option id="0" value="0">Off</option></select>'
            + '</div>');

    element_list++;
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

