<?php
// 代码生成时间: 2025-09-16 05:09:35
class ApiResponseFormatter {

    /**
     * 格式化成功的响应
     *
     * @param mixed $data 响应数据
     * @param string $message 响应消息
     * @return array 格式化后的响应数组
     */
    public function success($data, $message = "") {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * 格式化错误响应
     *
     * @param string $message 错误消息
     * @param int $code 错误代码
     * @param mixed $data 附加数据，可选
     * @return array 格式化后的错误响应数组
     */
    public function error($message, $code = 400, $data = null) {
        return [
            'status' => 'error',
            'message' => $message,
            'code' => $code,
            'data' => $data
        ];
    }
}

// 使用示例
$formatter = new ApiResponseFormatter();

// 成功响应
$response = $formatter->success(['key' => 'value'], 'Operation successful');
print_r($response);

// 错误响应
$errorResponse = $formatter->error('Something went wrong', 500);
print_r($errorResponse);
