<?php
/**
 * 使用冒泡排序的方法对数据进行从小到大排序
 * （优化：$exchange 记录是否发生数据交换，若未发生交换，则已排序完成)
 *
 * @param array $arr 待排序数据的存放数组
 * @param int $last 待排序数据的末下标
 * @return array 返回排序好的数组
 */
function bubbleSort(array $arr, $last)
{
    $exchange = false;
    for ($i = 0; $i < $last; $i++) {
        for ($j = 0; $j < $last - $i; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $exchange = true;
            }
        }
        if ($exchange) {
            $exchange = false;
        } else {
            break;
        }
    }
    return $arr;
}

$arr = [1, 8, 6, 3, 5, 7, 15, -1, 5, 7, 111, 999, 58];
print_r($arr);
echo '<br/>';
$arr = bubbleSort($arr, count($arr) - 1);
print_r($arr);