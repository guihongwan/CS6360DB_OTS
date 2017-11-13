<!DOCTYPE html>
<html>
<head>
	<title>PHP test</title>
</head>

<body>
    Hi <?php echo htmlspecialchars($_POST['name']);?>.</br>
    You are <?php echo (int)$_POST['age']; ?> years old.</br>
    You are studying at <?php echo htmlspecialchars($_POST['university']); ?>.</br>

    <!-- SIGN UP :write DB-->
    
    <!-- SIGN IN :read DB; match; update UI-->


</body>
</html>