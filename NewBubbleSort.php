<?php
/**
 * 使用冒泡排序的方法对数据进行从小到大排序
 *  （优化：$index 记录每次循环的最后一次交换的下一下标，
 *  并赋值给$change缩小排序范围)
 *
 * @param array $arr 待排序数据的存放数组
 * @param int $last 待排序数据的末下标
 */
function bubbleSort(array &$arr, $last)
{
    $index = $last;
    while ($index != 0) {
        $change = $index;
        $index = 0;
        for ($j = 0; $j < $change; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $index = $j + 1;
            }
        }
    }
}

$arr = [1, 8, 6, 3, 5, 7, 15, -1, 5, 7, 111, 999, 58];
print_r($arr);
echo '<br/>';
bubbleSort($arr, count($arr) - 1);
print_r($arr);
