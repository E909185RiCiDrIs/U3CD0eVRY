<?php
// 代码生成时间: 2025-08-20 18:13:22
class ApiResponseFormatter
{
    private $data;
    private $message;
    private $status;
    private $code;

    /**
     * ApiResponseFormatter constructor.
     * @param array $data 响应数据
     * @param string $message 响应消息
     * @param int $status 响应状态码
     * @param int $code 响应自定义代码
     */
    public function __construct($data = [], $message = 'success', $status = 200, $code = 0)
    {
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
        $this->code = $code;
    }

    /**
     * 设置响应数据
     * @param array $data 响应数据
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * 获取响应数据
     * @return array 响应数据
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 设置响应消息
     * @param string $message 响应消息
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * 获取响应消息
     * @return string 响应消息
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 设置响应状态码
     * @param int $status 响应状态码
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * 获取响应状态码
     * @return int 响应状态码
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 设置响应自定义代码
     * @param int $code 响应自定义代码
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * 获取响应自定义代码
     * @return int 响应自定义代码
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 格式化响应数据
     * @return array 格式化后的响应数据
     */
    public function formatResponse()
    {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code
        ];

        return $response;
    }
}

// 使用示例
$responseFormatter = new ApiResponseFormatter(['key' => 'value'], '操作成功', 200, 10000);
$formattedResponse = $responseFormatter->formatResponse();
header('Content-Type: application/json');
echo json_encode($formattedResponse);
