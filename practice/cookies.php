<?php
//print_r($_COOKIE);

//$name = "somename";
//$value = 200;
//$expiration = time() + (60*60*24*7);//seconds
//setcookie($name,$value,$expiration);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
    //print_r($_COOKIE);
    if(isset($_COOKIE["somename"])){
        $someone = $_COOKIE["somename"];
        
    } else {
        $someone = "";
    }
    echo $someone;
    
?>
    
</body>
</html>