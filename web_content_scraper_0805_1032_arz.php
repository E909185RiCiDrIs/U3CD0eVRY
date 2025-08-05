<?php
// 代码生成时间: 2025-08-05 10:32:56
// WebContentScraper.php
// 抓取网页内容的工具类

class WebContentScraper {

    // 抓取网页内容的方法
    public function fetchContent($url) {
        // 检查URL是否有效
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL provided.');
        }

        // 初始化cURL会话
        $ch = curl_init($url);

        // 设置cURL选项
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        // 执行cURL会话
        $html = curl_exec($ch);

        // 检查是否有cURL错误发生
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        // 关闭cURL会话
        curl_close($ch);

        // 返回抓取的网页内容
        return $html;
    }

}

// 使用示例
try {
    $scraper = new WebContentScraper();
    $url = 'http://example.com';
    $content = $scraper->fetchContent($url);
    echo 'Content of the page: ' . $content;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
