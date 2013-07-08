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
	protected function createMemcachierDriver()
	{
		$connection = new Memcached();
		$connection->setOption(Memcached::OPT_BINARY_PROTOCOL, 1);
		$connection->setSaslData($this->app['config']['cache.memcachier.username'], $this->app['config']['cache.memcachier.password']);
		$connection->addServer($this->app['config']['cache.memcachier.servers'], 11211);

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