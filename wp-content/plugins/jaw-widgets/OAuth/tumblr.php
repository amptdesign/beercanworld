<?php

/**
 * A request handler for Tumblr authentication
 * and requests
 */
class RequestHandler {

    private $consumer;
    private $token;
    private $signatureMethod;
    private $baseUrl;
    private $version;
    public $http_code;

    /* Set timeout default. */
    public $timeout = 30;
    /* Set connect timeout. */
    public $connecttimeout = 30;
    /* Verify SSL Cert. */
    public $ssl_verifypeer = FALSE;
    /* Respons format. */
    public $format = 'json';
    /* Decode returned json data. */
    public $decode_json = TRUE;
    /* Contains the last HTTP headers returned. */
    public $http_info;
    /* Set the useragnet. */
    public $useragent = 'TwitterOAuth v0.2.0-beta2';

    /**
     * Instantiate a new RequestHandler
     */
    public function __construct() {
        $this->baseUrl = 'https://api.tumblr.com/';
        $this->version = '0.1.2';

        $this->signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();
    }

    /**
     * Set the consumer for this request handler
     *
     * @param string $key    the consumer key
     * @param string $secret the consumer secret
     */
    public function setConsumer($key, $secret) {
        $this->consumer = new OAuthConsumer($key, $secret);
    }

    /**
     * Set the token for this request handler
     *
     * @param string $token  the oauth token
     * @param string $secret the oauth secret
     */
    public function setToken($token, $secret) {
        $this->token = new OAuthConsumer($token, $secret);
    }

    /**
     * Set the base url for this request handler.
     *
     * @param string $url The base url (e.g. https://api.tumblr.com)
     */
    public function setBaseUrl($url) {
        // Ensure we have a trailing slash since it is expected in {@link request}.
        if (substr($url, -1) !== '/') {
            $url .= '/';
        }

        $this->baseUrl = $url;
    }

    /**
     * Make a request with this request handler
     *
     * @param string $method  one of GET, POST
     * @param string $path    the path to hit
     * @param array  $options the array of params
     *
     * @return \stdClass response object
     */
    public function request($method, $path, $options) {
        // Ensure we have options
        $options = $options ? : array();

        // Take off the data param, we'll add it back after signing
        $file = isset($options['data']) ? $options['data'] : false;
        unset($options['data']);

        // Get the oauth signature to put in the request header
        $url = $this->baseUrl . $path;
        $oauth = OAuthRequest::from_consumer_and_token(
                        $this->consumer, $this->token, $method, $url, $options
        );
        $oauth->sign_request($this->signatureMethod, $this->consumer, $this->token);
        $authHeader = $oauth->to_header();
        $pieces = explode(' ', $authHeader, 2);
        $authString = $pieces[1];

        if ($method === 'GET') {
            // GET requests get the params in the query string
            return $this->http($oauth->to_url(), 'GET');
        } else {
            return $this->http($oauth->get_normalized_http_url(), $method, $oauth->to_postdata());
        }

        $request->setHeader('User-Agent', 'tumblr.php/' . $this->version);

        // Guzzle throws errors, but we collapse them and just grab the
        // response, since we deal with this at the \Tumblr\Client level
        try {
            $response = $request->send();
        } catch (Exception $e) {
            $response = $request->getResponse();
        }

        // Construct the object that the Client expects to see, and return it
        $obj = new \stdClass;
        $obj->status = $response->getStatusCode();
        $obj->body = $response->getBody();
        $obj->headers = $response->getHeaders()->toArray();

        return $obj;
    }

    /**
     * Make an HTTP request
     *
     * @return API results
     */
    function http($url, $method, $postfields = NULL) {
        $this->http_info = array();
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, FALSE);

        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($postfields)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                }
                break;
            case 'DELETE':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($postfields)) {
                    $url = "{$url}?{$postfields}";
                }
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;
        curl_close($ci);
        return $response;
    }

    /**
     * Get the header info to store.
     */
    function getHeader($ch, $header) {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }
        return strlen($header);
    }

}

class RequestException extends \Exception
{

    /**
     * @param \stdClass $response
     */
    public function __construct($response)
    {
        $error = json_decode($response->body);

        $errstr = 'Unknown Error';
        if (isset($error->meta)) {
            $errstr = $error->meta->msg;
            if (isset($error->response->errors)) {
                $errstr .= ' ('.$error->response->errors[0].')';
            }
        } elseif (isset($error->response->errors)) {
            $errstr = $error->response->errors[0];
        }

        $this->statusCode = $response->status;
        $this->message = $errstr;
        parent::__construct($this->message, $this->statusCode);
    }

    public function __toString()
    {
        return __CLASS__ . ": [$this->statusCode]: $this->message\n";
    }

}

/**
 * A client to access the Tumblr API
 */
class TumblrClient {

    private $apiKey;

    /**
     * Create a new Client
     *
     * @param string $consumerKey    the consumer key
     * @param string $consumerSecret the consumer secret
     * @param string $token          oauth token
     * @param string $secret         oauth token secret
     */
    public function __construct($consumerKey, $consumerSecret = null, $token = null, $secret = null) {
        $this->requestHandler = new RequestHandler();
        $this->setConsumer($consumerKey, $consumerSecret);

        if ($token && $secret) {
            $this->setToken($token, $secret);
        }
    }

    /**
     * Set the consumer for this client
     *
     * @param string $consumerKey    the consumer key
     * @param string $consumerSecret the consumer secret
     */
    public function setConsumer($consumerKey, $consumerSecret) {
        $this->apiKey = $consumerKey;
        $this->requestHandler->setConsumer($consumerKey, $consumerSecret);
    }

    /**
     * Set the token for this client
     *
     * @param string $token  the oauth token
     * @param string $secret the oauth secret
     */
    public function setToken($token, $secret) {
        $this->requestHandler->setToken($token, $secret);
    }

    /**
     * Retrieve RequestHandler instance
     *
     * @return RequestHandler
     */
    public function getRequestHandler() {
        return $this->requestHandler;
    }

    /**
     * Get info on the authenticating user
     *
     * @return array the response array
     */
    public function getUserInfo() {
        return $this->getRequest('v2/user/info', null, false);
    }

    /**
     * Get user dashboard for the authenticating user
     *
     * @param  array $options the options for the call
     * @return array the response array
     */
    public function getDashboardPosts($options = null) {
        return $this->getRequest('v2/user/dashboard', $options, false);
    }

    /**
     * Get followings for the authenticating user
     *
     * @param  array $options the options for the call
     * @return array the response array
     */
    public function getFollowedBlogs($options = null) {
        return $this->getRequest('v2/user/following', $options, false);
    }

    /**
     * Get likes for the authenticating user
     *
     * @param  array $options the options for the call
     * @return array the response array
     */
    public function getLikedPosts($options = null) {
        return $this->getRequest('v2/user/likes', $options, false);
    }

    /**
     * Follow a blog
     *
     * @param  string $blogName the name of the blog to follow
     * @return array  the response array
     */
    public function follow($blogName) {
        $options = array('url' => $this->blogUrl($blogName));

        return $this->postRequest('v2/user/follow', $options, false);
    }

    /**
     * Unfollow a blog
     *
     * @param  string $blogName the name of the blog to follow
     * @return array  the response array
     */
    public function unfollow($blogName) {
        $options = array('url' => $this->blogUrl($blogName));

        return $this->postRequest('v2/user/unfollow', $options, false);
    }

    /**
     * Like a post
     *
     * @param int    $postId    the id of the post
     * @param string $reblogKey the reblog_key of the post
     *
     * @return array the response array
     */
    public function like($postId, $reblogKey) {
        $options = array('id' => $postId, 'reblog_key' => $reblogKey);

        return $this->postRequest('v2/user/like', $options, false);
    }

    /**
     * Unlike a post
     *
     * @param int    $postId    the id of the post
     * @param string $reblogKey the reblog_key of the post
     *
     * @return array the response array
     */
    public function unlike($postId, $reblogKey) {
        $options = array('id' => $postId, 'reblog_key' => $reblogKey);

        return $this->postRequest('v2/user/unlike', $options, false);
    }

    /**
     * Delete a post
     *
     * @param string $blogName  the name of the blog the post is on
     * @param int    $postId    the id of the post
     * @param string $reblogKey the reblog_key of the post
     *
     * @return array the response array
     */
    public function deletePost($blogName, $postId, $reblogKey) {
        $options = array('id' => $postId, 'reblog_key' => $reblogKey);
        $path = $this->blogPath($blogName, '/post/delete');

        return $this->postRequest($path, $options, false);
    }

    /**
     * Reblog a post
     *
     * @param string $blogName  the name of the blog
     * @param int    $postId    the id of the post
     * @param string $reblogKey the reblog key of the post
     * @param array  $options   the options for the call
     *
     * @return array the response array
     */
    public function reblogPost($blogName, $postId, $reblogKey, $options = null) {
        $params = array('id' => $postId, 'reblog_key' => $reblogKey);
        $params = array_merge($options ? : array(), $params);
        $path = $this->blogPath($blogName, '/post/reblog');

        return $this->postRequest($path, $params, false);
    }

    /**
     * Edit a post
     *
     * @param string $blogName the name of the blog
     * @param int    $postId   the id of the post to edit
     * @param array  $data     the data to save
     *
     * @return array the response array
     */
    public function editPost($blogName, $postId, $data) {
        $data['id'] = $postId;
        $path = $this->blogPath($blogName, '/post/edit');

        return $this->postRequest($path, $data, false);
    }

    /**
     * Create a post
     *
     * @param string $blogName the name of the blog
     * @param array  $data     the data to save
     *
     * @return array the response array
     */
    public function createPost($blogName, $data) {
        $path = $this->blogPath($blogName, '/post');

        return $this->postRequest($path, $data, false);
    }

    /**
     * Get tagged posts
     *
     * @param string $tag     the tag to look up
     * @param array  $options the options for the call
     *
     * @return array the response array
     */
    public function getTaggedPosts($tag, $options = null) {
        if (!$options) {
            $options = array();
        }
        $options['tag'] = $tag;

        return $this->getRequest('v2/tagged', $options, true);
    }

    /**
     * Get information about a given blog
     *
     * @param  string $blogName the name of the blog to look up
     * @return array  the response array
     */
    public function getBlogInfo($blogName) {
        $path = $this->blogPath($blogName, '/info');

        return $this->getRequest($path, null, true);
    }

    /**
     * Get blog avatar URL
     *
     * @param string $blogName the nae of the blog to look up
     * @param int    $size     the size to retrieve
     *
     * @return string the avatar url
     */
    public function getBlogAvatar($blogName, $size = null) {
        $path = $this->blogPath($blogName, '/avatar');
        if ($size) {
            $path .= "/$size";
        }

        return $this->getRedirect($path, null, true);
    }

    /**
     * Get blog likes for a given blog
     *
     * @param string $blogName the name of the blog to look up
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getBlogLikes($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/likes');

        return $this->getRequest($path, $options, true);
    }

    /**
     * Get blog followers for a given blog
     *
     * @param string $blogName the name of the blog to look up
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getBlogFollowers($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/followers');

        return $this->getRequest($path, $options, false);
    }

    /**
     * Get posts for a given blog
     *
     * @param string $blogName the name of the blog
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getBlogPosts($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/posts');
        if ($options && isset($options['type'])) {
            $path .= '/' . $options['type'];
            unset($options['type']);
        }

        return $this->getRequest($path, $options, true);
    }

    /**
     * Get queue posts for a given blog
     *
     * @param string $blogName the name of the blog
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getQueuedPosts($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/posts/queue');

        return $this->getRequest($path, $options, false);
    }

    /**
     * Get draft posts for a given blog
     *
     * @param string $blogName the name of the blog
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getDraftPosts($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/posts/draft');

        return $this->getRequest($path, $options, false);
    }

    /**
     * Get submission posts for a given blog
     *
     * @param string $blogName the name of the blog
     * @param array  $options  the options for the call
     *
     * @return array the response array
     */
    public function getSubmissionPosts($blogName, $options = null) {
        $path = $this->blogPath($blogName, '/posts/submission');

        return $this->getRequest($path, $options, false);
    }

    /**
     * Make a GET request to the given endpoint and return the response
     *
     * @param string $path      the path to call on
     * @param array  $options   the options to call with
     * @param bool   $addApiKey whether or not to add the api key
     *
     * @return array the response object (parsed)
     */
    private function getRequest($path, $options, $addApiKey) {
        $response = $this->makeRequest('GET', $path, $options, $addApiKey);

        return $this->parseResponse($response);
    }

    /**
     * Make a POST request to the given endpoint and return the response
     *
     * @param string $path      the path to call on
     * @param array  $options   the options to call with
     * @param bool   $addApiKey whether or not to add the api key
     *
     * @return array the response object (parsed)
     */
    private function postRequest($path, $options, $addApiKey) {
        if (isset($options['source']) && is_array($options['source'])) {
            $sources = $options['source'];
            unset($options['source']);
            foreach ($sources as $i => $source) {
                $options["source[$i]"] = $source;
            }
        }

        $response = $this->makeRequest('POST', $path, $options, $addApiKey);
        return $this->parseResponse($response);
    }

    /**
     * Parse a response and return an appropriate result
     *
     * @param  \stdClass $response the response from the server
     *
     * @throws RequestException
     * @return array  the response data
     */
    private function parseResponse($response) {
        $response = json_decode($response);
        if ($response->meta->status < 400) {
            return $response->response;
        } elseif (isset($response->meta->msg)) {
            echo 'Error: ' . $response->meta->msg;
        } else {
            echo 'Error';
        }
    }

    /**
     * Make a GET request to the given endpoint and return the response
     *
     * @param string $path      the path to call on
     * @param array  $options   the options to call with
     * @param bool   $addApiKey whether or not to add the api key
     *
     * @return string url redirected to (or null)
     */
    private function getRedirect($path, $options, $addApiKey) {
        $response = $this->makeRequest('GET', $path, $options, $addApiKey);
        if ($response->status === 301) {
            return $response->headers['Location'][0];
        }

        return null;
    }

    /**
     * Make a request to the given endpoint and return the response
     *
     * @param string $method    the method to call: GET, POST
     * @param string $path      the path to call on
     * @param array  $options   the options to call with
     * @param bool   $addApiKey whether or not to add the api key
     *
     * @return \stdClass the response object (not parsed)
     */
    private function makeRequest($method, $path, $options, $addApiKey) {
        if ($addApiKey) {
            $options = array_merge(
                    array('api_key' => $this->apiKey), $options ? : array()
            );
        }

        return $this->requestHandler->request($method, $path, $options);
    }

    /**
     * Expand the given blogName into a base path for the blog
     *
     * @param string $blogName the name of the blog
     * @param string $ext      the url extension
     *
     * @return string the blog base path
     */
    private function blogPath($blogName, $ext) {
        $blogUrl = $this->blogUrl($blogName);

        return "v2/blog/$blogUrl$ext";
    }

    /**
     * Get the URL of a blog by name or URL
     *
     * @param  string $blogName the name of the blog
     * @return string the blog URL
     */
    private function blogUrl($blogName) {
        if (strpos($blogName, '.') === false) {
            return "$blogName.tumblr.com";
        }

        return $blogName;
    }

}
