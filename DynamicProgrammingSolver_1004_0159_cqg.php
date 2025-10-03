<?php
// 代码生成时间: 2025-10-04 01:59:22
 * It is designed to be easily understandable and maintainable.
 */
class DynamicProgrammingSolver
{
    // Method to solve the Fibonacci sequence problem
    public function solveFibonacci($n)
    {
        // Error handling for invalid input
        if (!is_int($n) || $n < 0) {
            throw new InvalidArgumentException('Input must be a non-negative integer.');
        }

        $table = array_fill(0, $n + 1, 0);
        $table[0] = 0;
        $table[1] = 1;

        // Dynamic programming approach to calculate Fibonacci numbers
        for ($i = 2; $i <= $n; $i++) {
            $table[$i] = $table[$i - 1] + $table[$i - 2];
        }

        return $table[$n];
    }

    // Method to solve the 0/1 Knapsack problem
    public function solveKnapsack($weights, $values, $capacity)
    {
        // Error handling for invalid input
        if (empty($weights) || empty($values) || !is_int($capacity) || $capacity < 0) {
            throw new InvalidArgumentException('Invalid input for weights, values, or capacity.');
        }

        $n = count($weights);
        $table = array_fill(0, $n + 1, array_fill(0, $capacity + 1, 0));

        // Dynamic programming approach to calculate the maximum value
        for ($i = 1; $i <= $n; $i++) {
            for ($w = 1; $w <= $capacity; $w++) {
                if ($weights[$i - 1] <= $w) {
                    $table[$i][$w] = max($table[$i - 1][$w], $values[$i - 1] + $table[$i - 1][$w - $weights[$i - 1]]);
                } else {
                    $table[$i][$w] = $table[$i - 1][$w];
                }
            }
        }

        return $table[$n][$capacity];
    }
}
