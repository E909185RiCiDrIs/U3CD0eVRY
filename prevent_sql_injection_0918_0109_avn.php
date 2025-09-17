<?php
// 代码生成时间: 2025-09-18 01:09:25
// 防止SQL注入的YII框架示例程序
// 程序展示了如何使用Yii框架的ActiveRecord组件来防止SQL注入

defined('YII_DEBUG') or define('YII_DEBUG', true);
# TODO: 优化性能
defined('YII_ENV') or define('YII_ENV', 'dev');
# TODO: 优化性能
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

// 配置数据库连接
$config = [
    'id' => 'basic',
# FIXME: 处理边界情况
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=testdb',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];

$app = new yii\web\Application($config);
$app->run();

// 使用ActiveRecord防止SQL注入的示例类
class User extends \yii\db\ActiveRecord
{
# TODO: 优化性能
    // ActiveRecord模型与数据库表名称
# 改进用户体验
    public static function tableName()
    {
        return 'users';
    }

    // 插入数据的示例方法
    public static function createUser($username, $email)
    {
        try {
            // 创建一个新用户
# 添加错误处理
            $user = new User();
            $user->username = $username;
# 扩展功能模块
            $user->email = $email;
            // 保存到数据库
            if (!$user->save()) {
                throw new Exception('Failed to save user');
            }
        } catch (Exception $e) {
            // 错误处理
            Yii::error($e->getMessage());
            return false;
        }
        return true;
    }
}

// 使用Yii的Query Builder防止SQL注入的示例函数
function findUserByEmail($email)
{
    try {
        // 使用Query Builder获取用户信息，防止SQL注入
        $query = (new \yii\db\Query())
            ->from('users')
            ->where(['email' => $email])
            ->one();
        return $query;
    } catch (Exception $e) {
        // 错误处理
        Yii::error($e->getMessage());
        return null;
# NOTE: 重要实现细节
    }
}

// 代码结束