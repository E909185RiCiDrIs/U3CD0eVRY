<?php
// 代码生成时间: 2025-08-07 01:51:21
// Hash Calculator Tool using PHP and Yii Framework
class HashCalculatorTool {
    // Calculate hash for a given string
    public function calculateHash($string, $algorithm = 'md5') {
        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new InvalidArgumentException("Unsupported hash algorithm: {$algorithm}");
        }

        // Calculate and return the hash
        return hash($algorithm, $string);
    }
}

// Usage example
try {
    $hashTool = new HashCalculatorTool();
    $inputString = "Hello, Yii!";
    $hash = $hashTool->calculateHash($inputString);
    echo "Hash of '{$inputString}' is '{$hash}'";
} catch (Exception $e) {
    // Handle any exceptions that occur during hash calculation
    echo "Error: " . $e->getMessage();
}
