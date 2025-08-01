<?php
// 代码生成时间: 2025-08-01 23:54:19
class MathToolkit extends \yii\base\Component
{
    
    public function add($a, $b)
    {
        // Validate input before adding
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \yii\base\InvalidParamException('Both parameters must be numeric.');
        }
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        // Validate input before subtracting
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \yii\base\InvalidParamException('Both parameters must be numeric.');
        }
        return $a - $b;
    }

    public function multiply($a, $b)
    {
        // Validate input before multiplying
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \yii\base\InvalidParamException('Both parameters must be numeric.');
        }
        return $a * $b;
    }

    public function divide($a, $b)
    {
        // Validate input before dividing and handle division by zero
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \yii\base\InvalidParamException('Both parameters must be numeric.');
        }
        if ($b == 0) {
            throw new \yii\base\InvalidArgumentException('Division by zero is not allowed.');
        }
        return $a / $b;
    }

    // Additional mathematical functions can be added here
    
}

// Usage example
try {
    $mathToolkit = new MathToolkit();
    echo 'Addition: ' . $mathToolkit->add(10, 5) . "\
";
    echo 'Subtraction: ' . $mathToolkit->subtract(10, 5) . "\
";
    echo 'Multiplication: ' . $mathToolkit->multiply(10, 5) . "\
";
    echo 'Division: ' . $mathToolkit->divide(10, 5) . "\
";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
