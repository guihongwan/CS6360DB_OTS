<?php
    if(isset($_POST['submit'])){
        $maximum = 10;
        $minimum = 5;
        if(strlen($_POST['username'])<$minimum){
            echo "Username has to be longer than ".$minimum;
        } elseif(strlen($_POST['username']) > $maximum){
            echo "Username cannot be longer than ".$maximum;
        }
//        echo $_POST['username'];
//        echo $_POST['password']; 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <!--$_POST-->
   <form action="form.php" method="post">
       <input type="text" name="username" placeholder="Enter Username">
       <input type="password" name="password" placeholder="Enter Password">
       <br>
       <input type="submit" name="submit">
       
   </form>
   <?php
    
    
    
    ?>
    
</body>
</html>