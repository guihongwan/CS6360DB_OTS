<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        $names = array('ghwan','Lucky BB');
        $maximum = 10;
        $minimum = 5;
        if(strlen($_POST['username'])<$minimum){
            echo "Username has to be longer than ".$minimum;
        } elseif(strlen($_POST['username']) > $maximum){
            echo "Username cannot be longer than ".$maximum;
        }
        echo '<br>';
        if(in_array($_POST['username'],$names)){
            echo 'Welcome '.$_POST['username'];
        
        }else{
            echo 'Sorry, You are not allowed.';
        }
        
//        echo $_POST['username'];
//        echo $_POST['password']; 
    }
    
?>
</body>
</html>