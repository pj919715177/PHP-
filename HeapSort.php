<?php
/**
 * 使用堆排序对数据进行从小到大排序
 *
 * @param array $array 存放数据的数组
 * @param int $last 待排序数据的末下标
 * @param int $first 待排序数据的起始下标
 */
function heapSort(array &$array, $last, $first = 1)
{
    //需要从1开始计算序号
    //计算起始下标与1的差
    $diff = $first - 1;
    while ($last > $first) {
        //末节点的父节点的下标
        $index = floor(($last - $diff) / 2) + $diff;
        while ($index >= $first) {
            branchSort($array, $index, $last, $diff);
            $index--;
        }
        $temp = $array[$first];
        $array[$first] = $array[$last];
        $array[$last] = $temp;
        $last--;
    }
}

/**
 * 对只有两层的二叉树，将大的数提取到父节点
 *
 * @param array $array 存放数据的数组
 * @param int $index 父节点的下标
 * @param int $last 待排序数据的末下标
 * @param int $diff 待排序数据的起始下标与1的差值
 */
function branchSort(array &$array, $index, $last, $diff)
{
    $largest = $index;
    //左、右子树的下标
    $lChild = ($index - $diff) * 2 + $diff;
    $rChild = $lChild + 1;
    if ($array[$lChild] > $array[$largest]) {
        $largest = $lChild;
    }
    //如果存在右子树
    if ($rChild <= $last) {
        if ($array[$rChild] > $array[$largest]) {
            $largest = $rChild;
        }
    }
    //如果不是父节点最大
    if ($largest !== $index) {
        $temp = $array[$index];
        $array[$index] = $array[$largest];
        $array[$largest] = $temp;
    }
}

$arr = [34, 6, 6, 75, 75, 254, 26, 885, 5463, -34, 6456, -435, -4, 525, 5643252];
echo 'before:<br/>';
print_r($arr);
echo '<br/>sorted<br/>';
heapSort($arr, count($arr) - 1, 0);
print_r($arr);
