# [Memcachier](http://memcachier.com/) Cache Driver for [Laravel 4](http://laravel.com/)

This is a replacement for the builtin CacheServiceProvider with support for Memcachier a managed hosted Memcache.
As it replaces Memcached you can also use this driver to support sessions.


## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `aheissenberger/laravel-memcachier`

	"require": {
	    "laravel/framework": "4.0.*",
	    "aheissenberger/laravel-memcachier": "dev-master"
	}

Next, update Composer from Terminal

	$ composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and replace `Illuminate\Cache\CacheServiceProvider` with:

	'Aheissenberger\MemcachierCache\CacheServiceProvider',


## Configuration

Open `app/config/cache.php` and find the `driver` key and change to `memcached`.

Replace the existing `memcached` configuration with this lines with authentification details and server:

		'memcached' => array(
			'username' => 'un', 'password' => 'pw', 'servers' => '1.1.1.1.1'
		),

If the driver cannot find `cache.memcached.username` it will try to load `cache.memcached[0]['host']` and connects to this server.
You can use this to simulate memcachier with your local memcached server.

