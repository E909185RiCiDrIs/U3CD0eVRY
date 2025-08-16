<?php
// 代码生成时间: 2025-08-16 19:35:32
// Inventory Management System using PHP and Yii Framework

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// Create a new instance of the application
$config = require(__DIR__ . '/../config/web.php');
$application = new yii\web\Application($config);
$application->run();

// Inventory Model
class Inventory extends 
yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'inventory';
    }

    // Add a new item to the inventory
    public function addItem($itemName, $quantity, $price)
    {
        if (empty($itemName) || empty($quantity) || empty($price)) {
            throw new 
yiiase\InvalidArgumentException('Item name, quantity, and price are required.');
        }

        $this->item_name = $itemName;
        $this->quantity = $quantity;
        $this->price = $price;

        return $this->save();
    }

    // Update an existing item in the inventory
    public function updateItem($itemId, $quantity, $price)
    {
        if (empty($itemId) || empty($quantity) || empty($price)) {
            throw new 
yiiase\InvalidArgumentException('Item ID, quantity, and price are required.');
        }

        $this->id = $itemId;
        $this->quantity = $quantity;
        $this->price = $price;

        return $this->save();
    }

    // Delete an item from the inventory
    public function deleteItem($itemId)
    {
        if (empty($itemId)) {
            throw new 
yiiase\InvalidArgumentException('Item ID is required.');
        }

        return static::deleteAll(['id' => $itemId]);
    }
}
