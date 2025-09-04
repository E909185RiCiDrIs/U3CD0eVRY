<?php
// 代码生成时间: 2025-09-04 19:03:15
 * This class is designed to handle the creation, maintenance and retrieval of database connections.
 * It ensures that connections are reused efficiently, reducing the overhead of frequent connection establishment.
 */
class DatabasePoolManager {
    /**
     * @var array Pool of database connections.
     */
    private $pool = [];

    /**
     * @var array Configuration for the database connections.
     */
    private $config = [];

    /**
     * Constructor for the DatabasePoolManager.
     * @param array $config Database configuration array.
     */
    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * Get a database connection from the pool.
     * If no connection is available, a new one will be created.
     * @return PDO Database connection instance.
     */
    public function getConnection() {
        if (empty($this->pool)) {
            // No connection in the pool, create a new one.
            $connection = $this->createConnection();
            array_push($this->pool, $connection);
            return $connection;
        } else {
            // Reuse the last connection in the pool.
            $connection = array_pop($this->pool);
            return $connection;
        }
    }

    /**
     * Release a database connection back to the pool.
     * @param PDO $connection Database connection instance to release.
     */
    public function releaseConnection($connection) {
        if ($connection instanceof PDO) {
            array_push($this->pool, $connection);
        } else {
            throw new InvalidArgumentException('Invalid connection type. Expected PDO instance.');
        }
    }

    /**
     * Create a new database connection.
     * @return PDO Database connection instance.
     */
    private function createConnection() {
        try {
            $dsn = $this->config['dsn'];
            $username = $this->config['username'];
            $password = $this->config['password'];
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            return new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new Exception('Database connection error: ' . $e->getMessage());
        }
    }
}
