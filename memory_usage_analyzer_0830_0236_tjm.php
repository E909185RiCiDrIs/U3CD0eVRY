<?php
// 代码生成时间: 2025-08-30 02:36:54
class MemoryUsageAnalyzer {

    /**
     * Get the current memory usage in bytes.
     *
     * @return int The current memory usage.
     */
    public function getCurrentMemoryUsage() {
        $memoryUsage = memory_get_usage();
        return $memoryUsage;
    }

    /**
     * Get the peak memory usage in bytes.
     *
     * @return int The peak memory usage.
     */
    public function getPeakMemoryUsage() {
        $memoryUsage = memory_get_peak_usage();
        return $memoryUsage;
    }

    /**
     * Display memory usage in a human-readable format.
     *
     * @param int $memoryUsage The memory usage in bytes.
     * @return string The memory usage in a human-readable format.
     */
    public function formatMemoryUsage($memoryUsage) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $memoryUsage = (double)$memoryUsage;

        // Find the appropriate unit
        for ($i = 0; $memoryUsage >= 1024 && $i < count($units) - 1; $i++) {
            $memoryUsage /= 1024;
        }

        return round($memoryUsage, 2) . ' ' . $units[$i];
    }

    /**
     * Display the current memory usage in a human-readable format.
     *
     * @return string The current memory usage in a human-readable format.
     */
    public function displayCurrentMemoryUsage() {
        $currentMemoryUsage = $this->getCurrentMemoryUsage();
        return $this->formatMemoryUsage($currentMemoryUsage);
    }

    /**
     * Display the peak memory usage in a human-readable format.
     *
     * @return string The peak memory usage in a human-readable format.
     */
    public function displayPeakMemoryUsage() {
        $peakMemoryUsage = $this->getPeakMemoryUsage();
        return $this->formatMemoryUsage($peakMemoryUsage);
    }

}

// Example usage:
try {
    $memoryAnalyzer = new MemoryUsageAnalyzer();
    echo "Current Memory Usage: " . $memoryAnalyzer->displayCurrentMemoryUsage() . "
";
    echo "Peak Memory Usage: " . $memoryAnalyzer->displayPeakMemoryUsage() . "
";
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo "An error occurred: " . $e->getMessage();
}
