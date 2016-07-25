<?php
/**
 * 使用插入排序的方法对数组进行从小到大排序
 *
 * @param array $arr 待排序数据的存储数组
 * @param  int $end 待排序数列的末下标
 * @param int $start 待排序数列的起始下标
 */
function insertionSort(array &$arr, $end, $start = 0)
{
    $index = 1;
    while ($end >= $index) {
        $position = dichotomySearch($arr, $index - 1, $start, $arr[$index]);
        $temp = $arr[$index];
        for ($i = $index; $i > $position; $i--) {
            $arr[$i] = $arr[$i - 1];
        }
        $arr[$position] = $temp;
        $index++;
    }
}

/**
 * 使用二分法找出给出数据在数组中的下标值
 *
 * @param array $arr 数据存放的数组
 * @param int $end 已排好序的数据末下标
 * @param int $start 已排好数据的起始下标
 * @param int $basic 待插入数据值
 * @return int 返回待插入数据的插入位置
 */
function dichotomySearch($arr, $end, $start, $basic)
{
    if ($end - $start > 1) {
        $middle = floor(($end + $start) / 2);
        if ($arr[$middle] >= $basic) {
            return dichotomySearch($arr, $middle, $start, $basic);
        } else {
            return dichotomySearch($arr, $end, $middle + 1, $basic);
        }
    } elseif ($basic < $arr[$start]) {
        return $start;
    } elseif ($basic < $arr[$end]) {
        return $end;
    } else {
        return $end + 1;
    }
}

$arr = [34, 6, 6, 75, 75, 254, 26, 885, 5463, -34, 6456, -435, -4, 525, 5643252];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
insertionSort($arr, count($arr) - 1);
print_r($arr);