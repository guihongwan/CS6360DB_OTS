<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    function init(){
        say_hello();
        $bill = 32.4;
        $feepercent = 0.20;
        echo " Do you know how much you need to pay for the bill ".$bill." with fee percent of ".$feepercent."? <br>";
        echo calculate($bill,$feepercent);
    }
    function say_hello(){
        echo "Hello,BB!<br>";
    }
    function calculate($num1, $num2){
        $total =  $num1+$num1*$num2;
        return $total;
    }
    
    //call funtion
    init();
    ?>
</body>
</html>