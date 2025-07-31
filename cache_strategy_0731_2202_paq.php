<?php
// 代码生成时间: 2025-07-31 22:02:56
class CacheStrategy {

    /**
     * @var Cache Yii2 cache component
     */
    private $__cache;

    /**
     * Constructor.
     * Initializes the cache component.
     */
    public function __construct() {
        $this->__cache = Yii::$app->cache;
    }

    /**
     * Sets a value in cache with a specified key and duration.
     *
     * @param string $key The cache key.
     * @param mixed $value The value to be cached.
     * @param int $duration The number of seconds in which the cache expires.
     * @return bool Returns true if the value is successfully cached, otherwise false.
     */
    public function setCache($key, $value, $duration) {
        try {
            if (!$this->__cache->set($key, $value, $duration)) {
                throw new Exception('Failed to set cache value.');
            }
            return true;
        } catch (Exception $e) {
            // Log the error or handle it as needed
            // Yii::error($e->getMessage(), 'cache');
            return false;
        }
    }

    /**
     * Retrieves a value from cache with a specified key.
     *
     * @param string $key The cache key.
     * @return mixed Returns the cached value if it exists, otherwise null.
     */
    public function getCache($key) {
        try {
            return $this->__cache->get($key);
        } catch (Exception $e) {
            // Log the error or handle it as needed
            // Yii::error($e->getMessage(), 'cache');
            return null;
        }
    }

    /**
     * Deletes a value from cache with a specified key.
     *
     * @param string $key The cache key.
     * @return bool Returns true if the value is successfully deleted, otherwise false.
     */
    public function deleteCache($key) {
        try {
            if (!$this->__cache->delete($key)) {
                throw new Exception('Failed to delete cache value.');
            }
            return true;
        } catch (Exception $e) {
            // Log the error or handle it as needed
            // Yii::error($e->getMessage(), 'cache');
            return false;
        }
    }
}
