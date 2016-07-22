<?php
function insertSort($arr, $end, $star = 0)
{
    $index = 1;
    while ($end >= $index) {
        $position = dichotomySearch($arr, $end - 1, $star, $arr[$end]); 
        $temp = $arr[$position];
        $arr[$position] = $arr[$index];
        for ($i = $position + 1; $i < $index; $i ++) {
            $arr[$i] = $arr[$i+1];
        }
        $arr[$index] = $temp;
        $index ++;
    }
    return $arr;
}

function dichotomySearch($arr, $end, $star, $basic)
{

}