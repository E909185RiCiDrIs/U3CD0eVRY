<?php
// 代码生成时间: 2025-08-17 21:58:09
class SystemPerformanceMonitor
{
    private $config;
    private $logger;

    /**
     * Constructor
     * @param array $config Configuration array
     * @param Logger $logger Yii logger instance
     */
    public function __construct($config, $logger)
    {
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Get system performance metrics
     * @return array System performance metrics
     */
    public function getMetrics()
    {
        try {
            $metrics = [];

            // Memory usage
            $memoryUsage = $this->getMemoryUsage();
            $metrics['memory_usage'] = $memoryUsage;

            // CPU load
            $cpuLoad = $this->getCpuLoad();
            $metrics['cpu_load'] = $cpuLoad;

            // Disk usage
            $diskUsage = $this->getDiskUsage();
            $metrics['disk_usage'] = $diskUsage;

            // Network usage
            $networkUsage = $this->getNetworkUsage();
            $metrics['network_usage'] = $networkUsage;

            return $metrics;

        } catch (Exception $e) {
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            throw $e;
        }
    }

    /**
     * Get memory usage
     * @return float Memory usage percentage
     */
    private function getMemoryUsage()
    {
        return round(memory_get_usage() / 1024 / 1024, 2);
    }

    /**
     * Get CPU load
     * @return float CPU load percentage
     */
    private function getCpuLoad()
    {
        // Platform-specific implementation required
        // For Linux: use sys_getloadavg()
        // For Windows: use GetSystemTimes()

        // Example for Linux
        $load1 = sys_getloadavg()[0];
        return round($load1, 2);
    }

    /**
     * Get disk usage
     * @return float Disk usage percentage
     */
    private function getDiskUsage()
    {
        $diskTotal = disk_total_space($this->config['disk_path']);
        $diskFree = disk_free_space($this->config['disk_path']);
        $diskUsage = ($diskTotal - $diskFree) / $diskTotal * 100;
        return round($diskUsage, 2);
    }

    /**
     * Get network usage
     * @return float Network usage percentage
     */
    private function getNetworkUsage()
    {
        // Platform-specific implementation required
        // For Linux: use /proc/net/dev
        // For Windows: use GetIfTable()

        // Example for Linux
        $file = fopen('/proc/net/dev', 'r');
        $lines = fgets($file);
        while (!preg_match('/face/', $lines)) {
            $lines = fgets($file);
        }
        $values = preg_split('/\s+/', $lines);
        $rxBytes = $values[0];
        $txBytes = $values[8];
        $totalBytes = $rxBytes + $txBytes;
        $networkUsage = $totalBytes / 1024 / 1024 * 100;
        return round($networkUsage, 2);
    }
}
