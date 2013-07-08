<?php namespace Aheissenberger\MemcachierCache;

use Illuminate\Support\Manager;
use Memcached;
use Config;

class MemcachierCacheManager extends Manager {

	/**
	 * Create an instance of the memcachier cache driver.
	 *
	 * @return MemcachierCache\MemcachierStore
	 */
	protected function createMemcachierDriver()
	{
		$connection = new Memcached();
		$connection->setOption(Memcached::OPT_BINARY_PROTOCOL, 1);
		$connection->setSaslData(Config::get('memcachier::username'), Config::get('memcachier::password'));
		$connection->addServer(Config::get('memcachier::servers'), 11211);

		$prefix = $Config::get('memcachier::prefix');

		return $this->repository(new MemcachierStore($connection, $prefix));
	}

	/**
	 * Get the default cache driver name.
	 *
	 * @return string
	 */
	protected function getDefaultDriver()
	{
		return $this->app['config']['cache.driver'];
	}
}