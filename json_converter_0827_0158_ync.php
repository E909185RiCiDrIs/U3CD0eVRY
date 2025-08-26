<?php
// 代码生成时间: 2025-08-27 01:58:42
class JsonConverter {

    /**
     * 将JSON字符串转换为PHP数组
     *
     * @param string $json JSON字符串
     * @return mixed PHP数组或错误信息
     */
    public function toJson($json) {
        try {
            // 检查是否为空字符串
            if (empty($json)) {
                throw new InvalidArgumentException('JSON字符串不能为空');
            }

            // 将JSON字符串转换为PHP数组
            $data = json_decode($json, true);

            // 检查转换是否成功
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('JSON格式错误: ' . json_last_error_msg());
            }

            return $data;
        } catch (InvalidArgumentException $e) {
            // 错误处理
            return array('error' => $e->getMessage());
        }
    }

    /**
     * 将PHP数组转换为JSON字符串
     *
     * @param array $data PHP数组
     * @return string JSON字符串或错误信息
     */
    public function toArray($data) {
        try {
            // 检查是否是数组
            if (!is_array($data)) {
                throw new InvalidArgumentException('输入必须是数组');
            }

            // 将PHP数组转换为JSON字符串
            $json = json_encode($data);

            // 检查转换是否成功
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('JSON编码错误: ' . json_last_error_msg());
            }

            return $json;
        } catch (InvalidArgumentException $e) {
            // 错误处理
            return array('error' => $e->getMessage());
        }
    }
}

// 示例用法
$converter = new JsonConverter();

// 将JSON字符串转换为PHP数组
$json = "{"name":"John", "age":30}";
$result = $converter->toJson($json);

// 将PHP数组转换为JSON字符串
$data = array('name' => 'John', 'age' => 30);
$jsonResult = $converter->toArray($data);

// 打印结果
echo '<pre>';
print_r($result);
print_r($jsonResult);
echo '</pre>';
