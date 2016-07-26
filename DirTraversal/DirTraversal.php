<?php

/**
 * 文件夹遍历
 *
 * 计算并显示指定路径内的文件和文件夹名称、最近修改时间、类型、大小
 *
 * @property string $dir 文件夹的有效路径
 * @property int $last 判断是否有上级目录，1表示有，0表示没有
 * @property array $dirArray 存储指定路径内的所有文件夹的名称和属性
 * @property array $fileArray 存储指定路径内的所有文件的名称和属性
 *
 * @package DirTraversal.DirTraversal.php
 */
class DirTraversal
{
    private $dir;
    private $last;
    private $dirArray = array();
    private $fileArray = array();

    public function __construct($dir)
    {
        $this->dir = $this->trimDir($dir);
        $this->setLastDir();
    }

    //对指定路径处理使之统一格式
    private function trimDir($dir)
    {
        if (is_dir($dir)) {
            $dir = str_replace('\\', '/', $dir);
            return rtrim($dir, './\\');
        }
    }

    //将上一级目录的信息存入目录文件夹
    private function setLastDir()
    {
        $position = strrpos($this->dir, '/');
        if ($position > 0) {
            $this->last = 1;
            $path = substr($this->dir, 0, $position);
            $this->dirArray['../']['path'] = $path;
            $this->dirArray['../']['time'] = $this->getTime($this->dir);
            $this->dirArray['../']['type'] = 'dir';
            $this->dirArray['../']['size'] = $this->getDirSize($this->dir);
        } else {
            $this->last = 0;
        }
    }

    //遍历文件夹并存储相应的信息
    private function readDir()
    {
        $handle = opendir($this->dir) or die('文件夹打开错误');
        while ($file = readdir($handle)) {
            if ($file !== '.' && $file !== '..') {
                $path = $this->dir . '/' . $file;
                if (is_dir($path)) {
                    $this->dirArray[$file]['path'] = $path;
                    $this->dirArray[$file]['time'] = $this->getTime($path);
                    $this->dirArray[$file]['type'] = 'dir';
                    $this->dirArray[$file]['size'] = $this->getDirSize($path);
                } else {
                    $this->fileArray[$file]['time'] = $this->getTime($path);
                    $this->fileArray[$file]['type'] = 'file';
                    $this->fileArray[$file]['size'] = $this->getFileSize($path);
                }
            }
        }
        ksort($this->dirArray);
        ksort($this->fileArray);
    }

    //获得文件或文件夹的修改时间
    function getTime($path)
    {
        return date('Y-m-d H:i:s', filectime($path));
    }

    //获得文件的大小
    private function getFileSize($path)
    {
        return filesize($path);
    }

    //获得文件夹的大小
    private function getDirSize($path)
    {
        $size = 0;
        $path = $this->trimDir($path);
        $handle = opendir($path) or die($path);
        while ($file = readdir($handle)) {
            if ($file !== '.' && $file !== '..') {
                $dirfile = $path . '/' . $file;
                if (is_dir($dirfile)) {
                    $size += $this->getDirSize($dirfile);
                } else {
                    $size += $this->getFileSize($path);
                }
            }
        }
        return $size;
    }

    //显示指定路径的文件和文件夹的信息
    public function dirShow()
    {
        $this->readDir();
        echo '<center><h3>' . $this->dir . ' 目录下的文件和文件夹</h3></center>';
        echo "<table class='table table-striped table-condensed table-hover table-bordered'>";
        echo '<tr><td>名称</td><td>修改日期</td><td>类型</td><td>大小</td></tr>';
        foreach ($this->dirArray as $name => $property) {
            $dirLink = '<a href = \'http://www.pjycf.com/PHP_study/DirTraversal/index.php?path='
                . $property['path'] . '\'>' . $name . '</a>';
            $time = $property['time'];
            $type = $property['type'];
            $size = $this->changeUnit($property['size']);
            echo "<tr><td> $dirLink </td><td> $time </td><td> $type </td><td> $size </td></tr>";
        }
        foreach ($this->fileArray as $name => $property) {
            $time = $property['time'];
            $type = $property['type'];
            $size = $this->changeUnit($property['size']);
            echo "<tr><td> $name </td><td> $time </td><td> $type </td><td> $size </td></tr>";
        }
        echo '</table>';
        echo $this->dir . '文件夹下共有<b> ' . (count($this->dirArray) - $this->last) . ' </b>个文件夹， 和 <b>' .
            count($this->fileArray) . '</b> 个文件。';
    }

    //将大小数值转换成合适的单位
    private function changeUnit($size)
    {
        if ($size >= pow(2, 30)) {
            $size = round($size / pow(2, 30), 2);
            $unit = ' GB';
        } elseif ($size >= pow(2, 20)) {
            $size = round($size / pow(2, 20), 2);
            $unit = ' KB';
        } elseif ($size >= pow(2, 10)) {
            $size = round($size / pow(2, 10), 2);
            $unit = ' MB';
        } else {
            $unit = ' Byte';
        }
        return $size . $unit;
    }
}