<?php
// 代码生成时间: 2025-08-02 23:47:56
class MemoryUsageAnalyzer {

    /**
     * Fetches the current memory usage in bytes.
     *
     * @return int The current memory usage in bytes.
     */
    public function getCurrentMemoryUsage() {
        // Check if memory_get_usage function is available
        if (function_exists('memory_get_usage')) {
            return memory_get_usage();
        } else {
            // Handle the error if memory_get_usage is not available
            throw new Exception('memory_get_usage function is not available.');
        }
    }

    /**
     * Fetches the peak memory usage in bytes.
     *
     * @return int The peak memory usage in bytes.
     */
    public function getPeakMemoryUsage() {
        // Check if memory_get_peak_usage function is available
        if (function_exists('memory_get_peak_usage')) {
            return memory_get_peak_usage();
        } else {
            // Handle the error if memory_get_peak_usage is not available
            throw new Exception('memory_get_peak_usage function is not available.');
        }
    }

}

// Usage example
try {
    $analyzer = new MemoryUsageAnalyzer();
    $currentMemory = $analyzer->getCurrentMemoryUsage();
    $peakMemory = $analyzer->getPeakMemoryUsage();

    echo "Current Memory Usage: " . $currentMemory . " bytes
";
    echo "Peak Memory Usage: " . $peakMemory . " bytes
";
} catch (Exception $e) {
    // Handle any exceptions that occur during memory usage analysis
    echo "Error: " . $e->getMessage();
}
