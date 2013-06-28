# [Memcachier](http://memcachier.com/) Cache Driver for [Laravel 4](http://laravel.com/)

This is a replacement for the builtin CacheServiceProvider with support for Memcachier a managed hosted Memcache.


## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `aheissenberger/laravel-memcachier`

	"require": {
	    "laravel/framework": "4.0.*",
	    "aheissenberger/laravel-memcachier": "dev-master"
	}

Next, update Composer from Terminal

	$ composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and replace `Illuminate\Cache\CacheServiceProvider` with:

	'Aheissenberger\Foundation\FoundationServiceProvider',

Install the configuration files:

	$ php artisan config:publish aheissenberger/laravel-memcachier


## Configuration

Open `app/config/cache.php` and find the `driver` key and change to `memcachier`.

Add your authentification details and servers to:

	app/config/packages/aheissenberger/laravel-memcachier

## ToDo

