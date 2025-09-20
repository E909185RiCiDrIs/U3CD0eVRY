<?php
// 代码生成时间: 2025-09-21 05:56:26
 * ensuring maintainability and extensibility.
 */

class ConfigManager {

    /**
     * @var string Path to the configuration directory.
     */
    private $configPath;

    /**
     * Constructor for ConfigManager, sets the path to configuration directory.
     *
     * @param string $configPath The path to the config directory.
     */
    public function __construct($configPath) {
        $this->configPath = $configPath;
    }

    /**
     * Load a configuration file.
     *
     * @param string $filename The name of the configuration file to load.
     * @return array|null Returns the configuration data if found, otherwise null.
     * @throws Exception If the file does not exist or cannot be read.
     */
    public function loadConfig($filename) {
        $configFile = $this->configPath . DIRECTORY_SEPARATOR . $filename;
        if (!file_exists($configFile)) {
            throw new Exception("Configuration file not found: {$configFile}");
        }

        return $this->parseConfig(file_get_contents($configFile));
    }

    /**
     * Parse the configuration data from a string.
     *
     * @param string $data The configuration data as a string.
     * @return array The parsed configuration data.
     */
    private function parseConfig($data) {
        if ($data === '') {
            return [];
        }

        // Assume the configuration is in JSON format for simplicity
        $config = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Failed to parse configuration: " . json_last_error_msg());
        }

        return $config;
    }

    /**
     * Save a configuration file.
     *
     * @param string $filename The name of the configuration file to save.
     * @param array $data The configuration data to save.
     * @return bool True on success, otherwise false.
     * @throws Exception If the file cannot be written.
     */
    public function saveConfig($filename, $data) {
        $configFile = $this->configPath . DIRECTORY_SEPARATOR . $filename;
        $configData = json_encode($data);
        if (file_put_contents($configFile, $configData) === false) {
            throw new Exception("Failed to write to configuration file: {$configFile}");
        }

        return true;
    }
}
