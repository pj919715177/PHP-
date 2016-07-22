<?php
function insertionSort($arr, $end, $start = 0)
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
    return $arr;
}
//二分查找
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
$arr = insertionSort($arr, count($arr) - 1);
print_r($arr);