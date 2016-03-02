<?php

/**
 * jwSocial_widget
 * 
 * 
 */
class social_vars {

    public $followers = '';
    public $display_name = '';
    public $url = '';
    public $img_url = '';
    public $error = null;

}

class jaw_social_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'widget_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Social'),
        1 => array('id' => 'g_username',
            'description' => 'Google+ page ID',
            'type' => 'text',
            'default' => ''),
        2 => array('id' => 'tw_username',
            'description' => 'Twitter username',
            'type' => 'text',
            'default' => ''),
        3 => array('id' => 'fb_username',
            'description' => 'Facebook page ID',
            'type' => 'text',
            'default' => ''),
        4 => array('id' => 'i_username',
            'description' => 'Instagram user ID (<a href="http://jelled.com/instagram/lookup-user-id" target="_blank">Get it</a>)', 
            'type' => 'text',
            'default' => ''),
        6 => array('id' => 'youtube_username',
            'description' => 'YouTube channel ID (<a href="https://www.youtube.com/account_advanced" target="_blank">Get it</a>)',
            'type' => 'text',
            'default' => ''),
        7 => array('id' => 'vimeo_username',
            'description' => 'Vimeo chanel name',
            'type' => 'text',
            'default' => ''),
        8 => array('id' => 'tumblr_username',
            'description' => 'Tumblr blogname',
            'type' => 'text',
            'default' => ''),
        9 => array('id' => 'rss_link',
            'description' => 'RSS link',
            'type' => 'text',
            'default' => ''),
        10 => array('id' => 'cache_time',
            'description' => 'Cache time [minutes] (Use less than 60 minutes)',
            'type' => 'text',
            'default' => '30'),
        11 => array('id' => 'animated',
            'description' => 'Animated',
            'type' => 'select',
            'values' => array(
                array('name' => 'On', 'value' => '1'),
                array('name' => 'Off', 'value' => '0')
            ),
            'default' => '1',
        ),
        12 => array('id' => 'show_errors',
            'description' => 'Show Errors (debug mode)',
            'type' => 'select',
            'values' => array(
                array('name' => 'On', 'value' => '1'),
                array('name' => 'Off', 'value' => '0')
            ),
            'default' => '1',
        ),
            /*  10 => array('id' => 'target',
              'description' => 'Target',
              'type' => 'select',
              'values' => array(
              array('name' => '_self', 'value' => '_self'),
              array('name' => '_blank', 'value' => '_blank')
              ),
              'default' => '_blank',
              ), */
    );

    function jaw_social_widget() {
        $options = array('classname' => 'jaw_social_widget', 'description' => "Theme-based icon links with information about followers.");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('jaw_social_widget', 'J&W - Social Widget', $options, $controls);
    }

    function widget($args, $instance) {
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_social_widget', 'widgets');
    }

    /*
     *  Práce s wp_opt
     */

    public function _getOption($namespace, $name) {
        return get_option($namespace . '_' . $name);
    }

    public function _setOption($namespace, $name, $value) {
        update_option($namespace . '_' . $name, $value);
    }

    /*
     * ************************** Google plus pages **************************
     */

    public function google_followers_counter($username) {

        $api_key = "AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U";
        $google_vars = new social_vars();
        $reponse = wp_remote_retrieve_body(wp_remote_request('https://www.googleapis.com/plus/v1/people/' . $username . '?key=' . $api_key . '&alt=json ', array('method' => 'GET')));


        if ($reponse instanceof WP_Error) {
            $google_vars->error = 'Error: Please check user ID';
            return $google_vars;
        }

        $data = json_decode($reponse);

        if (isset($data->error)) {
            $google_vars->error = 'Error: ' . $data->error->message;
            return $google_vars;
        }

        if ($data === null)
            return null;


        if (isset($data->plusOneCount)) {
            $google_vars->followers = $data->plusOneCount;
            $google_vars->display_name = $data->displayName;
            $google_vars->url = $data->url;
            $google_vars->img_url = $data->image->url;
            return $google_vars;
        } else {
            return null;
        }
    }

    /*
     * ************************* Tumblr **************************
     */

    public function tumblr_followers_counter($username) {
        require_once JAW_WIDGETS_DIR . '/OAuth/OAuth.php';
        require_once JAW_WIDGETS_DIR . '/OAuth/tumblr.php';


        $client = new TumblrClient(jwOpt::get_option('t_api_key', ''), jwOpt::get_option('t_api_secret', ''));
        $client->setToken(jwOpt::get_option('t_api_key', ''), jwOpt::get_option('t_api_secret', ''));

        $tumblr_vars = new social_vars();

        $blogInfo = $client->getBlogInfo($username);
  
        if (isset($blogInfo->blog->likes)) {
            $tumblr_vars->followers = $blogInfo->blog->likes;
        }
        if (isset($blogInfo->blog->url)) {
            $tumblr_vars->url = $blogInfo->blog->url;
        }
        if (isset($blogInfo->blog->title)) {
            $tumblr_vars->display_name = $blogInfo->blog->title;
        }
        $tumblr_vars->img_url = '';
        if ($tumblr_vars->followers != '') {
            return $tumblr_vars;
        } else {
            return null;
        }
    }

    /*
     * ************************* Twitter **************************
     */

    public function twitter_followers_counter($username) {

        require_once JAW_WIDGETS_DIR . '/OAuth/OAuth.php';
        require_once JAW_WIDGETS_DIR . '/OAuth/twitteroauth.php';

        //$username = fOpt::Get('twitter', 'username');
        $username_hash = base64_encode($username);
        $namespace = 'twt_' . $username_hash;

        $twitter_feed = $this->_getOption($namespace, 'rss_feed');
        if ($twitter_feed != null)
            $twitter_feed = unserialize($twitter_feed);


        $connection = new TwitterOAuth(jwOpt::get_option('tw_consumer_id', ''), jwOpt::get_option('tw_consumer_secret', ''), jwOpt::get_option('tw_access_id', ''), jwOpt::get_option('tw_access_secret', ''));
        $search_feed3 = "https://api.twitter.com/1.1/users/lookup.json?screen_name=" . $username;
        $reponse = $connection->get($search_feed3);



        $tw_vars = new social_vars();

        if ($reponse instanceof WP_Error) {
            $tw_vars->error = 'Error: Please check user ID';
            return $tw_vars;
        }

        if (isset($reponse->errors)) {
            switch ($reponse->errors[0]->code) {
                case 32: $tw_vars->error = 'Please check setting Twitter API in Theme Options -> Advanced?';
                    break;
                case 34: $tw_vars->error = 'Your user name is probably wrong<br>Please check it';
                    break;
                case 88: $tw_vars->error = 'Rate limit exceeded, please check "Actualize every X minutes" item in Twitter J&W Widget. Recommended value is 60.';
                    break;
                case 215: $tw_vars->error = 'Don`t you have set Twitter API in Theme Options -> Advanced?';
                    break;
                default: $tw_vars->error = 'Error: ' . $reponse->errors[0]->message;
                    break;
            }
            $tw_vars->display_name = "";
            $tw_vars->url = "https://twitter.com/";
            $tw_vars->img_url = '';
            return $tw_vars;
        }

        if (isset($reponse)) {
            $tw_vars->followers = strval($reponse[0]->followers_count);
            $tw_vars->display_name = "@" . strval($reponse[0]->screen_name);
            $tw_vars->url = "https://twitter.com/" . strval($reponse[0]->screen_name);
            $tw_vars->img_url = strval($reponse[0]->profile_image_url_https);
            return ( $tw_vars );
        } else {
            return null;
        }
    }

    /*
     * ************************** Facebook pages **************************
     */

    public function facebook_followers_counter($username) {

        $fb_vars = new social_vars();
        $reponse = wp_remote_retrieve_body(wp_remote_request('https://graph.facebook.com/'.$username.'?fields=id,name,link,likes,cover&access_token='.jwOpt::get_option('fb_token', ''), array('method' => 'GET')));
        if ($reponse instanceof WP_Error) {
            $fb_vars->error = 'Error: Please check user ID';
            return $fb_vars;
        }

        $data = json_decode($reponse);

        if (isset($data->error)) {
            $fb_vars->error = 'Error: ' . $data->error->message;
            return $fb_vars;
        }

        if ($data === null)
            return null;

        $fb_vars->followers = $data->likes;
        $fb_vars->display_name = $data->name;
        $fb_vars->url = $data->link;
        $fb_vars->img_url = isset($data->cover) ? $data->cover->source : '';
        return $fb_vars;
    }

    /*
     * ************************** Instagram  **************************
     */

    public function instagram_followers_counter($username) {

        $i_vars = new social_vars();
        if (jwOpt::get_option('instagram_token', '') != '') {
            $reponse_follow = wp_remote_retrieve_body(wp_remote_request('https://api.instagram.com/v1/users/' . $username . '/followed-by?access_token=' . jwOpt::get_option('instagram_token', ''), array('method' => 'GET')));
            $reponse_info = wp_remote_retrieve_body(wp_remote_request('https://api.instagram.com/v1/users/' . $username . '/?access_token=' . jwOpt::get_option('instagram_token', ''), array('method' => 'GET')));

            if ($reponse_follow instanceof WP_Error) {
                $i_vars->error = 'Error: Please check API keys and user ID';
                return $i_vars;
            }

            if ($reponse_info instanceof WP_Error) {
                $i_vars->error = 'Error: Please check API keys and user ID';
                return $i_vars;
            }   
            
            $data_follow = json_decode($reponse_follow);
            $data_info = json_decode($reponse_info);

            if (isset($data_follow->error)) {
                $i_vars->error = 'Error: ' . $data_follow->error->message;
                return $i_vars;
            }

            if ($data_follow === null) {
                $i_vars->error = 'Error: Please check API keys and user ID';
                return $i_vars;
            }


            if (isset($data_info->data->counts->followed_by)) {
                $i_vars->followers = $data_info->data->counts->followed_by;
            } else {
                $i_vars->followers = 'Please set Instagram API in Theme Options -> Advanced';
            }
        } else {
            $i_vars->followers = 'Please set Instagram API in Theme Options -> Advanced';
        }

        if (isset($data_info->data)) {
            $i_vars->display_name = $data_info->data->username;
            $i_vars->url = 'http://instagram.com/' . $data_info->data->username;
            $i_vars->img_url = $data_info->data->profile_picture;
        }


        return $i_vars;
    }

    /*
     * ************************** youtube **************************
     */

    public function youtube_followers_counter($username) {
        $youtube_token = jwOpt::get_option('youtube_token', '');
        $yt_vars = new social_vars();
        if(!isset($youtube_token['access_token']))
        {
            $yt_vars->error = 'Error: Please check your settings of Youtube API in Theme Options';
            return $yt_vars;
        }
        $reponse = wp_remote_retrieve_body(wp_remote_request('https://www.googleapis.com/youtube/v3/channels?part=statistics,snippet&id='.$username.'&access_token='.$youtube_token['access_token'], array('method' => 'GET')));
        $data = json_decode($reponse);
        if(isset($data->error) || $data === null){
                    //pokud vyprsela platnost tokenu tak vytvorim novej
                $post = array(
                    'method' => 'POST',
                    'body' => array('grant_type' => "refresh_token",
                        'client_id' => jwOpt::get_option('y_client_id', ''),
                        'client_secret' => jwOpt::get_option('y_client_secret', ''),
                        'redirect_uri' => SITE_URL . "/wp-admin/themes.php?page=optionsframework",
                        'refresh_token' => $youtube_token['refresh_token']
                    )
                );
                $reponse = wp_remote_retrieve_body(wp_remote_request('https://accounts.google.com/o/oauth2/token', $post));
                $token_info = json_decode($reponse);
                if (isset($token_info->access_token)) {
                    $youtube_token['access_token'] = $token_info->access_token;
                }
                jwOpt::update_one_option('youtube_token',$youtube_token);
                if(isset($token_info->error)){
                    $yt_vars->error = $token_info->error . '<br>';
                }
                if(isset($token_info->error_description)){
                    $yt_vars->error = $token_info->error_description . '<br>';
                }
                $reponse = wp_remote_retrieve_body(wp_remote_request('https://www.googleapis.com/youtube/v3/channels?part=statistics,snippet&id='.$username.'&access_token='.$youtube_token['access_token'], array('method' => 'GET')));
                $data = json_decode($reponse);
        }
        
        if ($data === null) {
            $yt_vars->error = 'Error: Please check user ID';
            return $yt_vars;
        }
        if(!isset($data->items[0])){
            $yt_vars->error = 'Error: Please check user ID';
            return $yt_vars;
        }
        $yt_vars->followers = $data->items[0]->statistics->subscriberCount;
        $yt_vars->display_name = $data->items[0]->snippet->title;
        $yt_vars->url = "https://www.youtube.com/channel/".$username;
        $yt_vars->img_url =  $data->items[0]->snippet->thumbnails->medium->url;
        return $yt_vars;
    }

    /*
     * ************************** Vimeo **************************
     */

    public function vimeo_followers_counter($username) {

        $reponse = wp_remote_retrieve_body(wp_remote_request('http://vimeo.com/api/v2/channel/' . $username . '/info.json', array('method' => 'GET')));
        $v_vars = new social_vars();
        if ($reponse instanceof WP_Error) {
            $v_vars->error .= 'Error: Please check user ID';
            return $v_vars;
        }

        $data = json_decode($reponse);

        if ($data === null) {
            $v_vars->error = 'Error: Please check user ID';
            return $v_vars;
        }


        $v_vars->followers = $data->total_subscribers;
        $v_vars->display_name = $data->creator_display_name;
        $v_vars->url = $data->url;
        $v_vars->img_url = $data->logo;
        return $v_vars;
    }

}
