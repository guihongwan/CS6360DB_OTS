<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <h2>scope</h2>
    <?php
    $x = 'outside';//global scope
    function covert1(){
        $x = "inside";//local scope
    }
    function covert2(){
        global $x;
        $x ="inside";
        
    }
    echo $x;
    covert1();
    echo "<br>";
    echo $x;
    covert2();
    echo "<br>";
    echo $x;
    
    ?>
    
    <h2>constant</h2>
    <?php
    $number = 10;
    echo $number;
    define('NAME','GHWAN');
    echo "<br>";
    echo NAME;
    //NAME = 10;//ERROR
    
    ?>
</body>
</html>