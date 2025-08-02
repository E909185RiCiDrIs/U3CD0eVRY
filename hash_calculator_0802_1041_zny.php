<?php
// 代码生成时间: 2025-08-02 10:41:48
class HashCalculator {

    /**
     * Calculate hash value for a given string using specified algorithm.
     *
     * @param string $input The input string to hash.
     * @param string $algorithm The hash algorithm to use.
     * @return string The calculated hash value.
     * @throws Exception If the specified algorithm is not supported.
     */
    public function calculateHash($input, $algorithm = 'sha256') {
        // Check if the algorithm is supported
        $supportedAlgorithms = hash_algos();
        if (!in_array($algorithm, $supportedAlgorithms)) {
            throw new Exception("Unsupported hash algorithm: {$algorithm}");
        }

        // Calculate and return the hash value
        return hash($algorithm, $input);
    }
}

// Example usage:
try {
    $hashCalculator = new HashCalculator();
    $inputString = 'Hello, World!';
    $algorithm = 'sha256';
    $hashValue = $hashCalculator->calculateHash($inputString, $algorithm);
    echo "The {$algorithm} hash of '{$inputString}' is: {$hashValue}";
} catch (Exception $e) {
    // Handle any exceptions that occur
    echo "Error: " . $e->getMessage();
}
