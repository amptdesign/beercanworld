
</div><!-- End Main row -->



<div id="header">
<div class="row-fullwidth">
<div class="fullwidth-block row header-small-content header-small-center-content ">
        <div class="col-lg-4 header-widget-area">
        <article id="text-29" class="widget widget_text">           
        <div class="textwidget"><?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'template-footer-menu')); ?></div>
        </article>
        </div>

        <div class="col-lg-4 header-logo footer-logo">
        <h1><a href="http://localhost:20073" title="Beercan World"><img class="template-logo" src="http://localhost:20073/wp-content/themes/goodstore/images/logo/logo.png" alt="Beercan World"></a></h1><br>
        <div class="footer-logo-text">
        <span class="dashicons dashicons-phone"></span> &nbsp;877.291.0926<br>
        <span class="dashicons dashicons-email-alt"></span> &nbsp;<a href="mailto:bill@beercanworld.com">bill@beercanworld.com</a><br>
        
        </div>
        </div>
        <div class="col-lg-4 header-widget-area">
        <article id="text-28" class="widget widget_text">
        <div class="textwidget"><br><br><b>Don’t trust just anyone</b> with your potentially valuable beer cans! <br><br>
        <b>Bill has 37 years of experience</b> collecting, appraising and appreciating beer cans!<br><br>
        “<b>Call me first</b> and I guarantee you will not be disappointed!” - Bill 
        </div>
        </article>        
        </div>
</div>                     
</div>
</div>

<div class="row-fullwidth">
<div class="fullwidth-block row footer-new">
<p class="footer-text">Beer Can World © 2016 &nbsp; -- &nbsp; Designed by <u><a href="http://www.amptdesign.com">Ampt Design</a></u>.</div>
</div>
</div>

<!-- <footer id="footer" class="" role="contentinfo"><p class="footer-text">Designed by <a href="http://www.amptdesign.com">Ampt Design</a>.</footer>  -->


</div><!-- End the template box -->

</div><!-- Container End -->

<?php echo jwStyle::generate_background_banner_link(); ?>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
     chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7]>
        <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
        <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<?php if (jwOpt::is(jwOpt::get_option('google_analytics')) || jwOpt::is(jwOpt::get_option('custom_js'))) { ?>
    <script type="text/javascript">
    <?php echo jwOpt::get_option('custom_js'); ?>
    </script>
    <?php echo jwOpt::get_option('google_analytics'); ?>
<?php } ?>

<script type="text/javascript" charset="utf-8">
    var site_url = "<?php echo get_site_url(); ?>";
    var rtl = "<?php echo jwOpt::get_option('site_rtl', '0'); ?>";
<?php if (jwOpt::get_option('totop_show_mobile', '0') == '1') { ?>
        var wWidth = 10000;
<?php } else { ?>
        var wWidth = jQuery(window).width();
<?php } ?>

    jQuery(document).ready(function() {
        //  open pinterrest in new tab
        jQuery(".social_button").find('a').attr('target', '_blank');
        //COOKIES for modal   
<?php if (is_front_page() && jwOpt::get_option('woo_modal', '0') == '1') { ?>
            var cookie_add = '';
            <?php if( jwOpt::get_option('woo_modal_page_id', '0') != ''){ ?>
            var cookie_modal = jQuery.cookie("jaw_modal") + cookie_add;
                if (cookie_modal != <?php echo jwOpt::get_option('woo_modal_page_id', '0') ?>) {
                    jQuery.cookie("jaw_modal", <?php echo jwOpt::get_option('woo_modal_page_id', '0') ?>, {expires: 7});
                    setTimeout(function() {
                        jQuery('#jaw_modal').modal('show');
                    }, 500);
                }
            <?php } ?>
<?php } ?>

    });
    
    <?php if (jwOpt::get_option('fbcomments_appid', '') != '') { ?>
    /*facebook share (min)*/
    !function(a, b, c) {
        var d, e = a.getElementsByTagName(b)[0];
        a.getElementById(c) || (d = a.createElement(b), d.id = c, d.src = "//connect.facebook.net/<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>/all.js", e.parentNode.insertBefore(d, e))
    }(document, "script", "facebook-jssdk");
    <?php } ?>
</script> 


<?php //SHARE JS ***************************************************************    ?>
<?php if (is_single()) { ?>
    <script type="text/javascript" charset="utf-8">
        /* twitter share (min)*/
        !function(a, b, c) {
            var d, e = a.getElementsByTagName(b)[0];
            a.getElementById(c) || (d = a.createElement(b), d.id = c, d.src = "//platform.twitter.com/widgets.js", e.parentNode.insertBefore(d, e))
        }(document, "script", "twitter-wjs");
        /*google+ share (min)*/
        window.___gcfg = {lang: "<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>"}, function() {
            var a = document.createElement("script");
            a.type = "text/javascript", a.async = !0, a.src = "https://apis.google.com/js/plusone.js";
            var b = document.getElementsByTagName("script")[0];
            b.parentNode.insertBefore(a, b)
        }();
    </script> 
    <!-- Linkedin share -->
    <!--<script src="//platform.linkedin.com/in.js" type="text/javascript" async></script>-->
    <!--Vine share-->
    <!--<script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>-->
<?php } ?>

</div>

<?php wp_footer(); ?>
</body>
</html>