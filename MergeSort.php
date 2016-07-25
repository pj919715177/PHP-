<?php
/**
 * 用归并排序的方法对数据进行从小到大排序
 *
 * @param array $array 待排序数据的存放数组
 * @param int $last 待排序数据在数组中的末下标
 * @param int $first 待排序数据在数组中的起始下标
 * @return array 返回排序后的数组
 */
function mergeSort(array $array, $last, $first = 0)
{
    $middle = floor(($first + $last) / 2);
    if ($last - $first > 3) {
        $array = mergeSort($array, $last, $middle + 1);
        //   print_r($array);
        $array = mergeSort($array, $middle, $first);
    } else {
        $array = mSort($array, $last, $middle + 1);
        $array = mSort($array, $middle, $first);
    }
    $temp = array();
    $index1 = $first;
    $index2 = $middle + 1;
    while ($index1 <= $middle && $index2 <= $last) {
        if ($array[$index1] < $array[$index2]) {
            $temp[] = $array[$index1];
            $index1++;
        } else {
            $temp[] = $array[$index2];
            $index2++;
        }
    }
    if ($index1 > $middle) {
        while ($index2 <= $last) {
            $temp[] = $array[$index2];
            $index2++;
        }
    } else {
        while ($index1 <= $middle) {
            $temp[] = $array[$index1];
            $index1++;
        }
    }
    for ($index1 = 0, $index2 = $first; $index1 < count($temp); $index1++, $index2++) {
        $array[$index2] = $temp[$index1];
    }
    return $array;
}

/**
 * 对指定范围内（一个或两个数）的数进行从小到大排序
 *
 * @param array $array 数据存放的数组
 * @param int $last 指定数据范围的末下标
 * @param int $first 指定数据范围的起始下标
 * @return array 返回排序后的数组
 */

function mSort(array $array, $last, $first)
{
    if ($last === $first) {
        return $array;
    } else {
        if ($array[$first] > $array[$last]) {
            $temp = $array[$first];
            $array[$first] = $array[$last];
            $array[$last] = $temp;
        }
        return $array;
    }
}

$arr = [34, 6, 6, 75, 75, 254, 26, 885, 5463, -34, 6456, -435, -4, 525, 5643252];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
$arr = mergeSort($arr, count($arr) - 1);
print_r($arr);