<?php
// 代码生成时间: 2025-09-09 09:28:32
// xss_protection.php
/**
 * 这是一个使用PHP和YII框架实现的简单XSS攻击防护程序。
 * 程序提供了一个函数来清理输入，防止XSS攻击。
 *
 * @author 你的姓名
 * @version 1.0
 * @date 2023-04-21
 */

class XssProtection {

    /**
     * 清理输入以防止XSS攻击。
     *
     * @param string $input 用户输入
     * @return string 清理后的输入
     */
    public function sanitizeInput($input) {
        // 检查输入是否为空
        if (empty($input)) {
            return '';
        }

        // 使用htmlspecialchars函数转义特殊字符
        // ENT_QUOTES将双引号和单引号都转义，为HTML属性提供额外的安全
        $cleanInput = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        // 返回清理后的输入
        return $cleanInput;
    }

    /**
     * 演示如何使用sanitizeInput函数。
     */
    public function demo() {
        try {
            $userInput = $_GET['user_input'] ?? '';
            $cleanInput = $this->sanitizeInput($userInput);
            echo "清洁后的输入: " . $cleanInput;
        } catch (Exception $e) {
            // 错误处理
            echo "发生错误: " . $e->getMessage();
        }
    }
}

// 实例化XssProtection类并调用演示函数
$xssProtection = new XssProtection();
$xssProtection->demo();