#Tumblr bundle for Laravel

This is a very basic interface for the Tumblr API to enable you to read posts.


##Setup
Install the bundle  

	$ php artisan bundle:install tumblr

Include it in application/bundles.php  

	return array('tumblr');


##Example Usage
In application/routes.php you can add a simple route to read and dump your tumblr posts at /tumblr

	Route::get('tumblr', function()
	{
		Bundle::start('tumblr');

		$posts = Tumblr\Tumblr::init('benedmunds')->skip(0)->take(10)->all();

		var_dump($posts);
	});


##Methods

###init($username)
	/**
     * Init and set the username
     * 
     * @param string username
     * @return object
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds');

###skip($offset)
	/**
     * set the results to skip (offset)
     * 
     * @param integer skip offset
     * @return object
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->skip(0);

###take($limit)
	/**
     * set the results to take (limit)
     * 
     * @param integer take limit
     * @return object
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->skip(0)->limit(10);

###clear()
	/**
     * Reset the skip and take
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->skip(0)->limit(10);
     $tumblr->clear()->all();

###all()
	/**
     * Get all of the posts
     * 
     * @return integer number of posts
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->skip(0)->limit(10)->all();

###count()
	/**
     * Count all of the posts
     * 
     * @return array posts
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->count();

###get($id)
	/**
     * Get a post
     * 
     * @param integer post id
     * @return array post
     */
     $tumblr = Tumblr\Tumblr::init('benedmunds')->get(1);


Bundle created by [Ben Edmunds](http://benedmunds.com).