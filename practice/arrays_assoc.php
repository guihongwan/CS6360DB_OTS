<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <?php
    
    //normal array
    $number = array(45,'hello');
    
    print_r($number);
    echo "<br>";
    
    //associative array
    $names = array("first_name"=>"guihong", "last_name"=>"wan");
    print_r($names); 
    echo "<br>";
    echo $names[first_name]." ". $names[last_name];
    
    ?>
    
</body>
</html>