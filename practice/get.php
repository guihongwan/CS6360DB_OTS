
<?php
print_r($_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
  <?php
    $id = 10;
    $btn = "CLICK HERE";
    ?>
   <a href="get.php?id=<?php echo $id;?>"><?php echo $btn ;?></a>
    
</body>
</html>