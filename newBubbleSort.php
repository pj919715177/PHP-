<?php
function bubbleSort(array $arr, $last)
{
    $count =0;
    $index = $last;
    while ($index != 0) {
        $change = $index;
        $index = 0;
        for ($j = 0; $j < $change; $j++) {
            $count ++;
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $index = $j + 1;
            }
        }
    }
    return $arr;
}

$arr = [1, 8, 6, 3, 5, 7, 15,-1, 5, 7, 111, 999, 58];
print_r($arr);
echo '<br/>';
$arr = bubbleSort($arr, count($arr) - 1);
print_r($arr);