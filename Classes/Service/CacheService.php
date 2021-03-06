<?php

/**
 * Cache Service.
 */

declare(strict_types = 1);

namespace SFC\Staticfilecache\Service;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException;
use TYPO3\CMS\Core\Cache\Frontend\VariableFrontend;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Cache Service.
 */
class CacheService extends AbstractService
{
    /**
     * Get the StaticFileCache.
     *
     * @throws NoSuchCacheException
     *
     * @return VariableFrontend
     */
    public function get(): VariableFrontend
    {
        return $this->getManager()->getCache('staticfilecache');
    }

    /**
     * Get the cache manager.
     *
     * @return CacheManager
     */
    public function getManager(): CacheManager
    {
        $objectManager = new ObjectManager();

        return $objectManager->get(CacheManager::class);
    }

    /**
     * Clear cache by page ID.
     *
     * @param int $pageId
     *
     * @throws NoSuchCacheException
     */
    public function clearByPageId(int $pageId)
    {
        $cache = $this->get();
        $cacheEntries = \array_keys($cache->getByTag('pageId_' . $pageId));
        foreach ($cacheEntries as $cacheEntry) {
            $cache->remove($cacheEntry);
        }
    }
}
