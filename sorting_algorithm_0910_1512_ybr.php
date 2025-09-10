<?php
// 代码生成时间: 2025-09-10 15:12:34
class SortingAlgorithm {

    /**
     * Sorts an array using bubble sort algorithm.
# FIXME: 处理边界情况
     *
# NOTE: 重要实现细节
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $array): array {
        if (empty($array)) {
            throw new InvalidArgumentException('Array should not be empty.');
        }
# FIXME: 处理边界情况

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements
# TODO: 优化性能
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
# 改进用户体验
        return $array;
    }

    /**
     * Sorts an array using selection sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function selectionSort(array $array): array {
# NOTE: 重要实现细节
        if (empty($array)) {
            throw new InvalidArgumentException('Array should not be empty.');
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
# 改进用户体验
            // Find the minimum element in the remaining unsorted array
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap the found minimum element with the first element of the unsorted part
# 优化算法效率
            if ($minIndex != $i) {
                $temp = $array[$i];
                $array[$i] = $array[$minIndex];
                $array[$minIndex] = $temp;
            }
        }
        return $array;
    }

    /**
     * Sorts an array using insertion sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function insertionSort(array $array): array {
        if (empty($array)) {
            throw new InvalidArgumentException('Array should not be empty.');
# FIXME: 处理边界情况
        }
# FIXME: 处理边界情况

        foreach ($array as $i => $value) {
            $key = $value;
            // Move elements of array[0..$i-1], that are greater than $key, to one position ahead of their current position
            while ($i > 0 && $array[$i - 1] > $key) {
                $array[$i] = $array[$i - 1];
# TODO: 优化性能
                $i--;
            }
            $array[$i] = $key;
        }
        return $array;
# 增强安全性
    }
}

// Example usage:
# 优化算法效率
try {
    $sortingAlgorithm = new SortingAlgorithm();
    $unsortedArray = [9, 5, 1, 4, 3];
    $sortedArray = $sortingAlgorithm->bubbleSort($unsortedArray);
    echo "Sorted array: " . implode(', ', $sortedArray);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
