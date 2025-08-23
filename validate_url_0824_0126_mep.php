<?php
// 代码生成时间: 2025-08-24 01:26:12
class ValidateUrl {

    /**
     * Validate the URL format.
     *
     * @param string $url
     * @return bool
     */
    public function validateUrlFormat($url) {
        // Use filter_var function to validate the URL format.
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Check if the URL is accessible.
     *
     * @param string $url
     * @return bool
     */
    public function isUrlAccessible($url) {
        // Set a timeout limit for the request.
        $timeout = 5;
        // Get the headers to check if the URL is accessible without downloading the content.
        $isAccessible = @get_headers($url, 1, $timeout);
        return !empty($isAccessible);
    }

    /**
     * Validate the URL and check if it is accessible.
     *
     * @param string $url
     * @return array
     */
    public function validate($url) {
        try {
            // Check if the URL format is valid.
            if (!$this->validateUrlFormat($url)) {
                return ['status' => 'error', 'message' => 'Invalid URL format.'];
            }

            // Check if the URL is accessible.
            if (!$this->isUrlAccessible($url)) {
                return ['status' => 'error', 'message' => 'URL is not accessible.'];
            }

            // Return success message if URL is valid and accessible.
            return ['status' => 'success', 'message' => 'URL is valid and accessible.'];
        } catch (Exception $e) {
            // Handle any exceptions that may occur.
            return ['status' => 'error', 'message' => 'Error validating URL: ' . $e->getMessage()];
        }
    }

    // Example usage.
    public static function run() {
        $validator = new ValidateUrl();
        $url = 'https://example.com';
        $result = $validator->validate($url);
        echo json_encode($result);
    }
}

// Validate a URL.
ValidateUrl::run();