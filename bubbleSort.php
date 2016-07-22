<?php
function bubbleSort(array $arr, $last, $first = 0)
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

$arr = [12, 45, 7868, -87, 45, 754, 154, 5734, -57, 2345, 24, -5, 73, 26, 2345];
print_r($arr);
echo '<br/>';
$arr = bubbleSort($arr, count($arr) - 1);
print_r($arr);