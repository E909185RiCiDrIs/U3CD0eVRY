<?php
// 代码生成时间: 2025-09-06 03:19:32
class UrlValidator {
    /**
     * Validates a URL
     *
     * @param string $url The URL to be validated
     * @return bool Returns true if the URL is valid, false otherwise
     */
    public function validate($url) {
        // Check if the URL is empty
        if (empty($url)) {
            throw new InvalidArgumentException('URL cannot be empty.');
        }

        // Use filter_var to validate the URL format
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            // If the URL is not valid, return false
            return false;
        }

        // Check if the URL is reachable (optional, might be resource-intensive)
        // This check can be removed if not required
        if ($this->isUrlReachable($url)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the URL is reachable
     *
     * @param string $url The URL to check
     * @return bool Returns true if the URL is reachable, false otherwise
     */
    private function isUrlReachable($url) {
        // Use cURL to check if the URL is reachable
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true); // Don't need to get the body, just need to check if it's reachable

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // If the HTTP code is 200 or 301, the URL is reachable
        return ($httpCode === 200 || $httpCode === 301);
    }
}

/**
 * Example usage
 */
try {
    $urlValidator = new UrlValidator();
    $url = 'https://example.com';
    if ($urlValidator->validate($url)) {
        echo 'The URL is valid.';
    } else {
        echo 'The URL is invalid.';
    }
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage();
}
