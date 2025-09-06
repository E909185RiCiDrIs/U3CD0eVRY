<?php
// 代码生成时间: 2025-09-06 08:24:54
 * This tool provides a simple interface to calculate hash values for strings.
 * It can be easily extended to support more algorithms and more complex operations.
 */
class HashCalculator {

    // Supported hash algorithms
    private $supportedAlgorithms = ['md5', 'sha256', 'sha512'];

    /**
     * Calculate hash for a given string using a specified algorithm.
     * 
     * @param string $string The string to calculate the hash for.
     * @param string $algorithm The hash algorithm to use.
     * @return string The resulting hash value or error message.
     */
    public function calculateHash($string, $algorithm = 'sha256') {
        // Check if the algorithm is supported
        if (!in_array($algorithm, $this->supportedAlgorithms)) {
            return 'Error: Unsupported algorithm.';
        }

        // Calculate the hash
        $hash = hash($algorithm, $string);

        // Return the hash value
        return $hash;
    }

}

// Example usage:
$hashCalculator = new HashCalculator();
$inputString = 'Hello, world!';
$algorithm = 'sha256';

try {
    $hashValue = $hashCalculator->calculateHash($inputString, $algorithm);
    echo "The hash value for '{$inputString}' using {$algorithm} is: {$hashValue}";
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo 'An error occurred: ' . $e->getMessage();
}
