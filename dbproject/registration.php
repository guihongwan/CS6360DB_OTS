<!DOCTYPE html>
<html>
<head>
    <title>Rgistered!</title>
</head>

<body>
    <h1>Hello, <?php echo(htmlspecialchars($_POST['id']))?></h1>
    <h1>You are a <?php echo(htmlspecialchars($_POST['password']))?></h1>
    <h1>You are from <?php echo(htmlspecialchars($_POST['name']))?></h1>
    <h1>You are from <?php echo(htmlspecialchars($_POST['email']))?></h1>
    
    <?php
    $mysqli = new mysqli("localhost","root","wgh","DBPROJECT");
        if($mysqli->connect_errno){
            printf("Connect failed:%s\n",$mysqli->error);
            exit();
        }else{
            echo "Connected successfully.</br>";
        }

        
        function add_user($mysqli,$id, $pass, $name, $email){
            if($mysqli->query(
                            "INSERT INTO users values
                              ('$id', ENCRYPT('$pass'),'$name','$email')
                            "
                            ) === TRUE){
                echo("Add user successfully.</br>");
            }
        }

        add_user($mysqli, $_POST['id'],$_POST['password'],$_POST['name'],$_POST['email']);

        $mysqli->close();
    ?>
</body>
</html>
</>