<?php
// 代码生成时间: 2025-08-31 03:13:54
class MemoryUsageAnalyzer {

    /**
     * Analyzes the current memory usage and compares it to the memory limit.
     *
     * @return array
     */
    public function analyzeMemoryUsage() {
        // Get the current memory usage
        $currentMemoryUsage = memory_get_usage(true);

        // Get the memory limit
        $memoryLimit = ini_get('memory_limit');

        // Calculate the percentage of memory used
        $memoryPercentage = 0;
        if ($memoryLimit !== -1) {
            $memoryLimitBytes = $this->convertToBytes($memoryLimit);
            $memoryPercentage = ($currentMemoryUsage / $memoryLimitBytes) * 100;
        }

        // Prepare the result array
        $result = [
            'current_memory_usage' => $currentMemoryUsage,
            'memory_limit' => $memoryLimit,
            'memory_percentage' => $memoryPercentage,
        ];

        return $result;
    }

    /**
     * Converts memory limit string (e.g., '128M') to bytes.
     *
     * @param string $memoryLimitStr
     * @return int
     */
    private function convertToBytes($memoryLimitStr) {
        $suffix = substr($memoryLimitStr, -1);
        $value = substr($memoryLimitStr, 0, -1);

        switch ($suffix) {
            case 'G':
                return $value * 1024 * 1024 * 1024;
            case 'M':
                return $value * 1024 * 1024;
            case 'K':
                return $value * 1024;
            default:
                return $value;
        }
    }

    /**
     * Logs memory usage information if it exceeds a certain threshold.
     *
     * @param array $memoryUsage The memory usage array from analyzeMemoryUsage()
     * @param int $threshold The threshold in bytes
     * @return void
     */
    public function logMemoryUsageIfExceeded(array $memoryUsage, $threshold) {
        if ($memoryUsage['current_memory_usage'] > $threshold) {
            // Log the memory usage
            // Here you can implement your logging system, e.g., Yii's logging component
            \Yii::warning(
                "Memory usage exceeded threshold: {$memoryUsage['current_memory_usage']} bytes",
                'memory_usage_analyzer'
            );
        }
    }
}

// Example usage:
try {
    $memoryAnalyzer = new MemoryUsageAnalyzer();
    $memoryUsage = $memoryAnalyzer->analyzeMemoryUsage();
    $memoryAnalyzer->logMemoryUsageIfExceeded($memoryUsage, 50 * 1024 * 1024); // 50MB threshold

    // Output the memory usage analysis
    echo json_encode($memoryUsage);
} catch (Exception $e) {
    // Handle any exceptions
    \Yii::error($e->getMessage(), 'memory_usage_analyzer');
    echo json_encode(['error' => $e->getMessage()]);
}
