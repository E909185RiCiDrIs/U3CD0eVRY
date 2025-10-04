<?php
// 代码生成时间: 2025-10-05 02:34:26
// Ensure that Yii framework is initialized properly
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use yiiase\Model;
use yii\validators\Validator;
use yii\validators\RequiredValidator;
use yii\validators\EmailValidator;
use yii\validators\StringValidator;

class FormValidator extends Model
{
    /**
     * @var string Email field
     */
    public $email;
    
    /**
     * @var string Name field
     */
    public $name;
    
    /**
     * @var string Message field
     */
    public $message;
    
    /**
     * @var array Rules for validation
     */
    public function rules()
    {
        return [
            // Email is required and must be a valid email address
            ['email', RequiredValidator::class, 'message' => 'Email cannot be blank.'],
            ['email', EmailValidator::class, 'message' => 'Invalid email address.'],
            
            // Name is required and must be a string with a maximum length of 128 characters
            ['name', RequiredValidator::class, 'message' => 'Name cannot be blank.'],
            ['name', StringValidator::class, 'max' => 128, 'tooLong' => 'Name must be no more than 128 characters.'],
            
            // Message is required and must be a string with a maximum length of 255 characters
            ['message', RequiredValidator::class, 'message' => 'Message cannot be blank.'],
            ['message', StringValidator::class, 'max', 255, 'tooLong' => 'Message must be no more than 255 characters.'],
        ];
    }

    /**
     * Validate form data
     *
     * @param array $data The data to be validated
     * @return bool Whether the data is valid
     */
    public function validateData($data)
    {
        $this->attributes = $data;
        if ($this->validate()) {
            return true;
        } else {
            // Handle errors
            $errors = $this->getFirstErrors();
            foreach ($errors as $error) {
                echo "Error: " . $error . "\
";
            }
            return false;
        }
    }
}

// Example usage:
/*
$validator = new FormValidator();
if ($validator->validateData(['email' => 'example@example.com', 'name' => 'John Doe', 'message' => 'Hello World'])) {
    echo "Validation passed.";
} else {
    echo "Validation failed.";
}
*/