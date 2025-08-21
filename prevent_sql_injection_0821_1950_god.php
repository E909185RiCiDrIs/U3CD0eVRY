<?php
// 代码生成时间: 2025-08-21 19:50:45
// 防止SQL注入的Yii框架示例
// 使用Yii框架的ActiveRecord来防止SQL注入

class PreventSqlInjectionController extends \yii\web\Controller {

    // 显示数据页面
    public function actionIndex() {
        try {
            // 使用Yii的数据库查询构造器
            $query = new \yii\db\Query();
            // 准备SQL查询，防止SQL注入
            $query->select(["name", "email"])
                  ->from("users")
                  ->where(["status" => 1]);
            // 执行查询
            $users = \Yii::$app->db->createCommand($query)->queryAll();
            // 返回查询结果
            return json_encode($users);
        } catch (\yii\db\Exception $e) {
            // 错误处理
            return json_encode(["error" => $e->getMessage()]);
        }
    }
}
