<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
  <h2>math</h2>
   <?php
    echo pow(2,3);//8
    echo "<br>";
    echo rand(1,100);
    echo "<br>";
    echo sqrt(100);//10
    echo "<br>";
    echo ceil(4.6);//5 ceilling
    echo "<br>";
    echo floor(4.6);//4
    ?>
    <h2>string</h2>
    <?php
    $string = "hello, do you like this course?";
    echo strlen($string);
    echo "<br>";
    echo strtoupper($string);
    echo "<br>";
    echo strtolower($string);
    ?>
    <h2>array functions</h2>
    <?php
    $list = array(34,23,35,1,44,45);
    echo max($list);
    echo "<br>";
    echo min($list);
    echo "<br>";
    sort($list);
    print_r($list);
    ?>
</body>
</html>