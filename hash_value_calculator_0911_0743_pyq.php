<?php
// 代码生成时间: 2025-09-11 07:43:35
 * This class provides functionality to calculate hash values of strings using different algorithms.
 *
 * @author Your Name
 * @version 1.0
 */
class HashValueCalculator {

    /**
     * Calculates the hash value of a given string using a specified algorithm.
     *
     * @param string $string The input string to hash.
     * @param string $algorithm The algorithm to use for hashing.
     * @return string The calculated hash value.
     */
    public function calculateHash($string, $algorithm = 'md5') {
        // Check if the input string is valid
        if (!is_string($string)) {
            throw new InvalidArgumentException('Input must be a string.');
        }

        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new InvalidArgumentException("The algorithm '{$algorithm}' is not supported.