<?php
// 代码生成时间: 2025-08-04 21:02:31
 * It is designed to be easy to understand, maintain, and expand.
# 扩展功能模块
 *
 * @category Sorting
 * @package  Default
 * @author   Your Name <your.email@example.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://www.yourwebsite.com
 */
# 增强安全性

// Import the Yii base classes
# NOTE: 重要实现细节
Yii::import('application.components.*');
# 改进用户体验

class SortingAlgorithm extends CComponent
{
    /**
# 扩展功能模块
     * Perform bubble sort on an array.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
     */
    public function bubbleSort($array)
    {
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            // Last i elements are already in place, no need to check them
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements if they are in wrong order
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
# 改进用户体验
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Perform insertion sort on an array.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
# NOTE: 重要实现细节
     */
    public function insertionSort($array)
    {
# 改进用户体验
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;
# 扩展功能模块

            while ($j >= 0 && $array[$j] > $key) {
# 添加错误处理
                $array[$j + 1] = $array[$j];
                $j--;
# 优化算法效率
            }
# 添加错误处理
            $array[$j + 1] = $key;
        }
        return $array;
    }

    /**
     * Perform quick sort on an array.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
     */
    public function quickSort($array)
    {
# 增强安全性
        if (count($array) < 2) {
            // Arrays with zero or one elements are already sorted
            return $array;
# 扩展功能模块
        }

        $left = $right = array();
        $pivot = array_shift($array); // Remove first element as pivot
# NOTE: 重要实现细节
        foreach ($array as $value) {
            if ($value <= $pivot) {
                $left[] = $value;
            } else {
                $right[] = $value;
            }
        }
        return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
    }
}

// Example usage
$sorter = new SortingAlgorithm();
$unsortedArray = array(4, 2, 3, 1, 5);

try {
    $sortedArray = $sorter->bubbleSort($unsortedArray);
    echo "Bubble Sort: ";
    print_r($sortedArray);

    $sortedArray = $sorter->insertionSort($unsortedArray);
    echo "Insertion Sort: ";
# 扩展功能模块
    print_r($sortedArray);

    $sortedArray = $sorter->quickSort($unsortedArray);
# NOTE: 重要实现细节
    echo "Quick Sort: ";
    print_r($sortedArray);
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo 'Error: ' . $e->getMessage();
}
