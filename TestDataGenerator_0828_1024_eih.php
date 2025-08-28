<?php
// 代码生成时间: 2025-08-28 10:24:26
class TestDataGenerator {

    /**
     * 生成随机字符串
     *
     * @param int $length 字符串的长度
     * @return string 随机生成的字符串
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * 生成测试用户数据
     *
     * @param int $count 用户数量
     * @return array 包含测试用户数据的数组
     */
    public function generateUsers($count = 10) {
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = [
                'username' => $this->generateRandomString(8),
                'email' => $this->generateRandomString(8) . '@example.com',
                'password' => $this->generateRandomString(12)
            ];
        }
        return $users;
    }

    /**
     * 生成测试产品数据
     *
     * @param int $count 产品数量
     * @return array 包含测试产品数据的数组
     */
    public function generateProducts($count = 10) {
        $products = [];
        for ($i = 0; $i < $count; $i++) {
            $products[] = [
                'name' => $this->generateRandomString(10),
                'price' => rand(10, 1000),
                'description' => $this->generateRandomString(30)
            ];
        }
        return $products;
    }

    /**
     * 生成测试订单数据
     *
     * @param int $count 订单数量
     * @return array 包含测试订单数据的数组
     */
    public function generateOrders($count = 10) {
        $orders = [];
        for ($i = 0; $i < $count; $i++) {
            $orders[] = [
                'user_id' => rand(1, 10),
                'product_id' => rand(1, 10),
                'quantity' => rand(1, 5),
                'total_price' => rand(10, 500)
            ];
        }
        return $orders;
    }
}
