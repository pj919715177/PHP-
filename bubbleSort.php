<?php
function bubbleSort(array $arr)
{
    $size = count($arr);
    for ($i = 0; $i < $size - 1; $i++) {
        for ($j = $i + 1; $j < $size; $j++) {
            if ($arr[$i] > $arr[$j]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}

$arr = [34, 6, 6, 75, 75, 254, 26, 885, 5463, -34, 6456, -435, -4, 525, 5643252];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
$arr = bubbleSort($arr);
print_r($arr);