<?php
/**
 * Created by PhpStorm.
 * User: pengjun
 * Date: 2016/7/25
 * Time: 18:34
 */
class DirTraversal
{
    private $dir;
    private $dirArray = array();
    private $fileArray = array();

    public function __construct($dir)
    {
        $this -> dir = $this->trimDir($dir);
    }

    private function trimDir($dir)
    {
        if(is_dir($dir)) {
            $dir = str_replace('\\','/',$dir);
            return rtrim($dir,'./\\');
        }
    }


    private function readDir()
    {
        $handle = opendir($this -> dir) or die('文件夹打开错误');
        while ($file = readdir($handle)) {
            if ($file !== './' && $file !== '../'){
                $path = $this -> dir.'/'.$file;
                if(is_dir($path)){
                    $this -> dirArray[$file]['path'] = $path;
                    $this -> dirArray[$file]['time'] = $this -> getTime($path);
                    $this -> dirArray[$file]['type'] = 'dir';
                    $this -> dirArray[$file]['size'] = $this -> getDirSize($path);
                } else {
                    $this -> fileArray[$file]['time'] = $this -> getTime($path);
                    $this -> fileArray[$file]['type'] = 'file';
                    $this -> fileArray[$file]['size'] = $this -> getFileSize($path);
                }
            }
        }
        ksort($this -> dirArray);
        ksort($this -> fileArray);
    }

    function getTime($path)
    {
        return date('Y-m-d H:i:s',filectime($path));
    }

    private function getFileSize($path)
    {
        return filesize($path);
    }

    private function getDirSize($path)
    {
        $size = 0;
        $path = $this -> trimDir($path);
        $handle = opendir($path) or die('文件夹打开错误');
        while ($file = readdir($handle)) {
            if ($file !== './' && $file !== '../') {
                $dirfile = $path . '/' . $file;
                if (is_dir($dirfile)) {
                    $size += $this -> getDirSize($dirfile);
                } else {
                    $size += $this -> getFileSize($path);
                }
            }
        }
        return $size;
    }

    public function dirShow() {
        $this -> readDir();
        echo "<table class='table table-striped'>";
        foreach ($this -> dirArray as $name => $property) {
            $dirLink = '<a href = \'./index.php ? path = '
                . $property['path'] .'\'>' . $name . '</a>';
            $time = $property['time'];
            $type = $property['type'];
            $size = $this -> changeUnit($property['size']);
            echo "<tr><td> $dirLink </td><td> $time </td><td> $type </td><td> $size </td></tr>";
        }
        foreach ($this -> fileArray as $name => $property) {
            $time = $property['time'];
            $type = $property['type'];
            $size = $this -> changeUnit($property['size']);
            echo "<tr><td> $name </td><td> $time </td><td> $type </td><td> $size </td></tr>";
        }
        echo '</table>';
    }

    private function changeUnit($size)
    {
        if ($size >= pow(2, 30)) {
            $size = round($size / pow(2,30), 2);
            $unit = ' GB';
        } elseif ($size >= pow(2, 20)) {
            $size = round($size / pow(2,20), 2);
            $unit = ' KB';
        } elseif ($size >= pow(2, 10)) {
            $size = round($size / pow(2,10), 2);
            $unit = ' MB';
        } else {
            $unit = ' Byte';
        }
        return $size.$unit;
    }
}