<?php
/**
 * 使用快速排序的方法对数据进行从小到大排序
 *
 * @param array $arr 待排序数据的存放数组
 * @param int $left 待排序数据的起始下标
 * @param $right 待排序数据的末下标
 */
function quickSort(array &$arr, $left, $right)
{
    $base = $left;
    $last = $right;
    while ($left < $right) {
        while ($arr[$base] <= $arr[$right] && $left < $right) {
            $right--;
        }
        while ($arr[$base] >= $arr[$left] && $left < $right) {
            $left++;
        }
        $temp = $arr [$right];
        $arr [$right] = $arr [$left];
        $arr [$left] = $temp;
    }
    $temp = $arr [$base];
    $arr [$base] = $arr [$left];
    $arr [$left] = $temp;
    if ($left > $base) {
        quickSort($arr, $base, $left - 1);
    }
    if ($last > $left) {
        quickSort($arr, $left + 1, $last);
    }
}

$arr = [12, 45, 7868, -87, 45, 754, 154, 5734, -57, 2345, 24, -5, 73, 26, 2345];
print_r($arr);
echo '<br/>';
quickSort($arr, 0, count($arr) - 1);
print_r($arr);