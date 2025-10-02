<?php
// 代码生成时间: 2025-10-03 02:16:55
class MicroserviceCommunicationMiddleware
{
    // 微服务的基础URL
    private $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * 发送请求到微服务
     *
     * @param string $servicePath 微服务的具体路径
     * @param array $data 要发送的数据
     * @param string $method 请求方法（GET, POST等）
     * @return mixed 微服务的响应
     */
    public function sendRequest($servicePath, $data = [], $method = 'GET')
    {
        try {
            $url = $this->baseUrl . $servicePath;
            $curl = curl_init($url);

            if ($method == 'POST') {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } elseif ($method == 'GET') {
                $url .= '?' . http_build_query($data);
            }

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);

            $response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($status != 200) {
                throw new Exception('Service responded with status ' . $status);
            }

            return json_decode($response, true);

        } catch (Exception $e) {
            // 错误处理
            // 可以根据需要记录错误日志
            return ['error' => $e->getMessage()];
        }
    }
}

// 用法示例
// $middleware = new MicroserviceCommunicationMiddleware('https://example.com/api/');
// $response = $middleware->sendRequest('users', ['name' => 'John Doe'], 'POST');
// print_r($response);
