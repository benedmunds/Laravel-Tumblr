<?php
/**
 * Laravel Tumblr Bundle
 *
 * @category  Bundle
 * @package   Laravel
 * @author    Ben Edmunds <http://benedmunds.com>
 * @copyright 2012 Ben Edmunds
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @version   Release: 1.0
 * @link      https://github.com/benedmunds/Laravel-Tumblr
 */

namespace Tumblr;

class Tumblr {
	
    public $username;
    protected $skip = NULL;
    protected $take = NULL;

    function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Init and set the username
     * 
     * @param string username
     * @return object
     */
    public static function init($username)
    {
        return new static($username);
    }

    /**
     * set the results to skip (offset)
     * 
     * @param integer skip offset
     * @return object
     */
    public function skip($skip)
    {
        $this->skip = $skip;
        
        return $this;
    }

    /**
     * set the results to take (limit)
     * 
     * @param integer take limit
     * @return object
     */
    public function take($take)
    {
        $this->take = $take;
        
        return $this;
    }

    /**
     * clear the skip and take
     * 
     */
    public function clear()
    {
        $this->skip = NULL;
        $this->take = NULL;
        
        return $this;
    }

    /**
     * Get all of the posts
     * 
     * @return array posts
     */
    function all()
    {
    	$url = 'http://'. $this->username .'.tumblr.com/api/read/json';

        if (isset($this->skip) && isset($this->take))
        {
            $url .= '?start=' . $this->skip . '&num=' . $this->take;
        }

        $result =  $this->_get_data($url);
    	
    	return (isset($result->posts)) ? $result->posts : array();
    }

    /**
     * Count all of the posts
     * 
     * @return integer number of posts
     */
    function count()
    {
        $url = 'http://'. $this->username .'.tumblr.com/api/read/json';

        $result = $this->_get_data($url);

        return (isset($result->posts_total)) ? $result->posts_total : 0;
    }
	
    /**
     * Get a post
     * 
     * @param integer post id
     * @return array post
     */
    function get($id)
    {
        $url = 'http://'. $this->username .'.tumblr.com/api/read/json?id='. $id;

        $result =  $this->_get_data($url);

	   return $result->posts[0];
    }
    
    /**
     * Retrieve data from API
     * 
     * @param string api url
     * @return array api response
     */
    protected function _get_data($url)
    {
        if(function_exists("curl_version"))
        {
            $c = curl_init($url);
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
	
            $return = curl_exec($c);

    	    //clean up data
    	    $return = str_replace('var tumblr_api_read = ','',$return);
    	    $return = str_replace(';','',$return);
    	    $return = str_replace('-','_',$return);

    	    return json_decode($return);
        }
    }

}