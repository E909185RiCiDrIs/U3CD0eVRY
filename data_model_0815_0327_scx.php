<?php
// 代码生成时间: 2025-08-15 03:27:25
// 数据模型设计
// 遵循YII框架的数据模型设计标准

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example_table".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $created_at
 */
class ExampleModel extends ActiveRecord
{
    // 数据模型的规则
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
            ['created_at', 'safe'],
        ];
    }

    // 数据模型的场景
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'email', 'created_at'];
        return $scenarios;
    }

    // 创建前的准备
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    // 获取查询对象
    public static function find()
    {
        return new ExampleQuery(get_called_class());
    }
}

/**
 * This is the ActiveQuery class for ExampleModel.
 */
class ExampleQuery extends \$app\db\ActiveQuery
{
    // 可以根据需要添加自定义查询方法
}