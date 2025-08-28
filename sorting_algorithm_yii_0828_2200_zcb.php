<?php
// 代码生成时间: 2025-08-28 22:00:52
class SortingAlgorithmController extends CController {

    /**
     * Action to perform sorting.
     * @param array $data The array of numbers to be sorted.
     * @return string Sorted array in JSON format.
     */
    public function actionSort($data = []) {
        if (empty($data)) {
            // Return error if no data is provided.
            throw new CHttpException(400, 'No data provided for sorting.');
        }

        try {
            // Sort the data using Bubble Sort algorithm.
            $sortedData = $this->bubbleSort($data);
            // Return sorted data in JSON format.
            return CJSON::encode(['sortedData' => $sortedData]);
        } catch (Exception $e) {
            // Handle any exceptions that occur during sorting.
            throw new CHttpException(500, 'Error sorting data: ' . $e->getMessage());
        }
    }

    /**
     * Bubble Sort algorithm implementation.
     * @param array $data The array of numbers to be sorted.
     * @return array Sorted array.
     */
    private function bubbleSort($data) {
        $length = count($data);
        for ($i = 0; $i < $length - 1; $i++) {
            for ($j = 0; $j < $length - $i - 1; $j++) {
                if ($data[$j] > $data[$j + 1]) {
                    // Swap elements if they are in the wrong order.
                    $temp = $data[$j];
                    $data[$j] = $data[$j + 1];
                    $data[$j + 1] = $temp;
                }
            }
        }
        return $data;
    }
}
