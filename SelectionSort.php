<?php
/**
 * 使用选择排序的方法，对数据进行从小到大排序
 *  （优化：每一次循环找出未排序数据的最大最小值，
 *          并放在相应的位置）
 *
 * @param array $arr 待排序数据的存放数组
 * @param $last 待排序数据的末下标
 * @param int $first 待排序数据的起始下标
 * @return array 返回排序后的数组
 */
function selectionSort(array $arr, $last, $first = 0)
{
    $count = 0;
    while ($last > $first) {
        $smallest = $first;
        $largest = $first;
        //找出未排序部分最大、最小数的索引
        for ($index = $first + 1; $index <= $last; $index++) {
            $count++;
            if ($arr[$index] < $arr[$smallest]) {
                $smallest = $index;
            }
            if ($arr[$index] > $arr[$largest]) {
                $largest = $index;
            }
            $count++;
        }

        //将混乱部分最大最小数放在两边
        $temp = $arr[$smallest];
        $arr[$smallest] = $arr[$first];
        $arr[$first] = $temp;
        //如果最大数被换走了，需要改变最大数的下标
        if ($largest == $first) {
            $largest = $smallest;
        }
        $temp = $arr[$largest];
        $arr[$largest] = $arr[$last];
        $arr[$last] = $temp;
        //缩小范围
        $first++;
        $last--;
    }
    echo $count;
    return $arr;
}

$arr = [1, 8, 6, 3, 5, 7, 15, -1, 5, 7, 111, 999, 58];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
$arr = selectionSort($arr, count($arr) - 1);
print_r($arr);