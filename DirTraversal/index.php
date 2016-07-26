<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <title>文件夹遍历</title>
</head>

<body>

<?php
include_once('./DirTraversal.php');
//如果网址中指定path，则使用指定的path
if (isset($_GET['path'])) {
    $path = $_GET['path'];
} else {
    $path = '/mnt/hgfs/virtual/PHP_study';
}
$dt = new DirTraversal($path);
$dt->dirShow();
?>

</body>
</html>

