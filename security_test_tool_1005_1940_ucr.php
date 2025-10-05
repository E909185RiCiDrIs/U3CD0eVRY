<?php
// 代码生成时间: 2025-10-05 19:40:52
// SecurityTestTool.php
// 这是一个安全测试工具，用于基本的安全检查和测试。

require_once 'vendor/autoload.php'; // 引入Composer的autoload文件

use yiiase\Component;
use yii\httpclient\Client;

/**
 * 安全测试工具类
 * 该类提供了一些基本的安全测试功能
 */
class SecurityTestTool extends Component
{
    private $httpClient;

    /**
     * 构造函数
     * 初始化HTTP客户端
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * 检查URL是否安全
     * @param string $url 需要检查的URL
     * @return bool 返回URL是否安全
     */
    public function checkUrlSafety($url)
    {
        try {
            $response = $this->httpClient->createRequest()
                ->setMethod('GET')
                ->setUrl($url)
                ->send();

            if ($response->isOk) {
                // 可以添加更多安全检查逻辑
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // 处理异常
            // 日志记录或其他错误处理
            return false;
        }
    }

    /**
     * 检查输入是否包含潜在的XSS攻击
     * @param string $input 用户输入
     * @return bool 返回输入是否安全
     */
    public function checkForXss($input)
    {
        // 使用正则表达式检查输入是否包含潜在的XSS攻击
        $xssPattern = '/(script|iframe|embed|object|applet)/i';
        if (preg_match($xssPattern, $input)) {
            return false;
        }
        return true;
    }

    // 可以添加更多的安全测试方法
}

// 使用示例
$securityTestTool = new SecurityTestTool();
$url = 'http://example.com';
$input = '<script>alert(1)</script>';

if ($securityTestTool->checkUrlSafety($url)) {
    echo "URL is safe.\
";
} else {
    echo "URL is not safe.\
";
}

if ($securityTestTool->checkForXss($input)) {
    echo "Input is safe.\
";
} else {
    echo "Input contains potential XSS attack.\
";
}
