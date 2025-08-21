<?php
// 代码生成时间: 2025-08-21 23:41:08
 * It handles errors and provides a simple interface for web scraping.
 */
class WebContentCrawler {

    /**
     * @var string The URL of the webpage to fetch.
     */
    private $url;

    /**
     * Constructor for WebContentCrawler
     *
     * @param string $url The URL to fetch.
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * Fetches the content of the webpage.
     *
     * @return string HTML content of the webpage or an error message.
     */
    public function fetchContent() {
        try {
            // Initialize a cURL session
            $ch = curl_init($this->url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for simplicity
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            // Execute cURL session and get the content
            $content = curl_exec($ch);

            // Check for errors
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            // Close the cURL session
            curl_close($ch);

            return $content;

        } catch (Exception $e) {
            // Handle errors and return an error message
            return "Error fetching content: " . $e->getMessage();
        }
    }

    /**
     * Sets the URL to fetch.
     *
     * @param string $url The new URL.
     */
    public function setUrl($url) {
        $this->url = $url;
    }

}

// Example usage of the WebContentCrawler class
try {
    $crawler = new WebContentCrawler("http://example.com");
    $content = $crawler->fetchContent();
    echo $content;
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
