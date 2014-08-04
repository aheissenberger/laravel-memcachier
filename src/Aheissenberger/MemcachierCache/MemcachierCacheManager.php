<?php namespace Aheissenberger\MemcachierCache;

use Illuminate\Support\Manager;
use Illuminate\Cache\StoreInterface;
use Illuminate\Cache\Repository;
use Memcached;

class MemcachierCacheManager extends Manager {

	/**
	 * Create an instance of the memcachier cache driver.
	 *
	 * @return MemcachierCache\MemcachierStore
	 */
	protected function createMemcachedDriver()
	{
		$connection = new Memcached();
		if ($this->app['config']['cache.memcached.username']!=null) { // memcachier config exists
			$connection->setOption(Memcached::OPT_BINARY_PROTOCOL, 1);
			$connection->setSaslAuthData($this->app['config']['cache.memcached.username'], $this->app['config']['cache.memcached.password']);
			$connection->addServer($this->app['config']['cache.memcached.servers'], $this->app['config']['cache.memcached.port'],$this->app['config']['cache.memcached.weight']);
		} else { // try to connect to local memcached server
			$connection->addServer($this->app['config']['cache.memcached.host'], $this->app['config']['cache.memcached.port'],$this->app['config']['cache.memcached.weight']);
		}

		$prefix = $this->app['config']['cache.prefix'];

		return $this->repository(new MemcachierStore($connection, $prefix));
	}

	/**
	 * Create a new cache repository with the given implementation.
	 *
	 * @param  \Illuminate\Cache\StoreInterface  $store
	 * @return \Illuminate\Cache\Repository
	 */
	protected function repository(StoreInterface $store)
	{
		return new Repository($store);
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