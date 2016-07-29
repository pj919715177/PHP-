<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>读取大文件</title>
</head>
<body>

<?php

include_once './ReadHugeFile.php';

function gen()
{
    while (true) {
        echo yield;
    }
}

$filePath = './test.txt';
$gen = gen();
$read = new ReadHugeFile($filePath, $gen);
$read->getContent();
?>

</body>

</html>