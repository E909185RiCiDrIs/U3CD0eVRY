<?php
// 代码生成时间: 2025-08-24 23:39:04
// 防止SQL注入的程序示例
// 使用Yii框架的数据库访问组件来实现预防SQL注入的功能

// Yii框架需要先安装和配置好
// Yii2框架的数据库组件能够自动处理预处理语句和参数绑定，从而防止SQL注入

class PreventSqlInjectionController extends \web\Controller {
    public function actionIndex() {
        // 假设用户输入的参数
        $username = Yii::\$app->request->get('username');
        $password = Yii::\$app->request->get('password');

        // 错误处理
        if (empty($username) || empty($password)) {
            throw new \Exception('用户名或密码不能为空');
        }

        // 使用Yii框架的Query Builder构建安全的查询
        $query = new \Query;
        $user = $query->from('user')
            ->where(['username' => $username, 'password' => $password])
            ->one(Yii::\$app->db);

        if ($user) {
            return \Json::encode(['status' => 'success', 'message' => '登录成功']);
        } else {
            return \Json::encode(['status' => 'error', 'message' => '用户名或密码错误']);
        }
    }
}
