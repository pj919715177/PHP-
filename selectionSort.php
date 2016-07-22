<?php
function selectionSort(array $arr, $last, $first = 0)
{
    $count = 0;
    while ($last > $first) {
        $smallest = $first;
        $largest = $first;
        //找出未排序部分最大、最小数的索引
        for ($index = $first + 1; $index <= $last; $index++) {
            $count ++;
            if ($arr[$index] < $arr[$smallest]) {
                $smallest = $index;
            }
            if ($arr[$index] > $arr[$largest]) {
                $largest = $index;
            }
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
    return $arr;
}

$arr = [34, 6, 6, 75, 75, 254, 26, 885, 5463, -34, 6456, -435, -4, 525, 5643252];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
$arr = selectionSort($arr, count($arr) - 1);
print_r($arr);