<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   <h2> If Statement</h2>
    <?php
    
    if(3 > 10){
        
        echo 'three is less than ten.';
        
    } elseif (3 == 10){
        
        echo 'equal';
    
    } else {
        
        echo 'it is bigger than ten.';
    }
    
    ?>
    
    <h2>Comparison operations</h2>
    <pre>
    equal ==
    identical ===
    compare > < >= <= <>
    not equal !=
    not identical !==
    </pre>
    <h2>logical operations</h2>
    <pre>
    and &&
    or ||
    not !
    </pre>
    
    <?php
    if(4 == 4){
        echo '1: it is  true.';
        
    }
    if(4 >= 4){
        echo '2: it is  true.';
        
    }
    if(4 == '4'){
        echo '3: it is  true.';
        
    }
    if(4 === '4'){
        echo '4: it is  true.';
        
    }
    ?>
    
    <h2>Switch</h2>
    <?php
    
    $number = 11;
    switch($number){
        case 4:
            echo "it's 4.";
            break;
        case 10:
            echo "it's 10.";
            break;
        default:
            echo "it's in default";
    }
    ?>
    <h2>Loop</h2>
    <?php
    $counter = 0;
     while($counter < 10){
         echo 'hello student counter:'.$counter."<br>";
         $counter++;
         
     }
    
    for($counter = 0; $counter < 10;$counter++){
        echo 'for loop'."<br>";
        
    }
    
    $names = array("guihongwan","binbai");
    foreach($names as $name){
        echo $name."<br>";
    }
     
    ?>
</body>
</html>