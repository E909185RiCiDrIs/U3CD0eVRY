<?php
// 代码生成时间: 2025-09-07 20:44:56
class SortingAlgorithmYii extends \yii\base\Model
{

    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    /**
     * 排序数组
     *
     * @param array $array 输入数组
     * @param string $order 排序顺序（asc|desc）
     * @return array
     */
    public function sortArray($array, $order = self::SORT_ASC)
    {
        // 错误处理：检查输入是否为数组
        if (!is_array($array)) {
            throw new \yii\base\InvalidArgumentException('Input must be an array.');
        }

        // 根据排序顺序进行排序
        if ($order === self::SORT_ASC) {
            sort($array);
        } elseif ($order === self::SORT_DESC) {
            rsort($array);
        } else {
            throw new \yii\base\InvalidArgumentException('Invalid sort order specified.');
        }

        return $array;
    }

    /**
     * 插入排序算法实现
     *
     * @param array $array 输入数组
     * @return array
     */
    public function insertionSort($array)
    {
        foreach ($array as $key => $value) {
            for ($i = $key - 1; $i >= 0 && $array[$i] > $value; $i--) {
                $array[$i + 1] = $array[$i];
            }
            $array[$i + 1] = $value;
        }

        return $array;
    }

    /**
     * 快速排序算法实现
     *
     * @param array $array 输入数组
     * @param int $low 低界限
     * @param int $high 高界限
     * @return array
     */
    public function quickSort($array, $low = 0, $high = null)
    {
        if ($high === null) {
            $high = count($array) - 1;
        }

        if ($low < $high) {
            $pi = $this->partition($array, $low, $high);

            $this->quickSort($array, $low, $pi - 1); // Before pi
            $this->quickSort($array, $pi + 1, $high); // After pi
        }

        return $array;
    }

    /**
     * 快速排序算法的分区函数
     *
     * @param array $array 输入数组
     * @param int $low 低界限
     * @param int $high 高界限
     * @return int
     */
    private function partition(&$array, $low, $high)
    {
        $pivot = $array[$high];
        $i = ($low - 1);

        for ($j = $low; $j <= $high - 1; $j++) {
            if ($array[$j] < $pivot) {
                $i++;
                $t = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $t;
            }
        }

        $t = $array[$i + 1];
        $array[$i + 1] = $array[$high];
        $array[$high] = $t;

        return $i + 1;
    }
}
