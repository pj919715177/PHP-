<?php

class ReadHugeFile
{
    private $_filePath;
    private $_coroutine;
//    private $_encode;
//    private $_lineLenght = 80;

    public function __construct($filePath, Generator $generator)
    {
        $filePath = $this->formatFilePath($filePath);
        //       $this->getEncode();
        $this->_filePath = $filePath;
        $this->_coroutine = $generator;
    }

    private function formatFilePath($filePath)
    {
        is_file($filePath) or die('文件或路径不合法');
        $filePath = rtrim($filePath, '\\/.');
        $filePath = str_replace('\\', '/', $filePath);
        return $filePath;
    }

//    private function getEncode()
//    {
//        $handle = fopen($this->_filePath, 'r');
//        $string = fgetc($handle);
//        if ($encode = mb_detect_encoding($string)) {
//            $this->_encode = $encode;
//        } else {
//            $this->_encode = 'UTF-8';
//        }
//        fclose($handle);
//    }

    public function getContent()
    {
        $handle = fopen($this->_filePath, 'r');
        while ($line = fgets($handle)) {
            $line = $this->formatContent($line);
            $this->_coroutine->send($line);
        }
        fclose($handle);
    }

    private function formatContent($line)
    {
        $line = '<pre>' . $line . '</pre>';
        return $line;
    }
}