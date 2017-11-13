<!DOCTYPE html>
<html>
<head>
	<title>Google</title>
</head>

<body>
    <?php
        echo "<p>Hi, I'm ghwan</p>";
        if( strpos($_SERVER['HTTP_USER_AGENT'],'Macintosh') !== FALSE){
            echo 'You are using Macintosh.';
        }
    ?>

    <?php
        if( strpos($_SERVER['HTTP_USER_AGENT'],'Macintosh') !== FALSE){
    ?>
    <h3>strpos() must have returned non-false</h3>
    <p>You are using mac.</p>
    <?php
        } else {
    ?>
    <h3>strpos() must have returned false</h3>
    <p>what computer do you use?</p>
    <?php
        }
    ?>

    <form action = "action.php" method="post">
        <p> Your name: <input type="text" name="name"/> </p>
        <p> Your age: <input type="text" name="age" /></p>
        <p> Your university: <input type="text" name="university" /></p>
        <p><input type="submit"/></p>
    </form>

    <form action = "signup.php" method="post">
        <p><input type="submit" value="signup"/></p>
    </form>

    

    <?php
    /*    $conn = mysqli_connect("localhost","root","wgh");
        if(!$conn){
            die('Could not connect:'.mysql_error());
        } else {
            echo 'Connected successfully';
            //mysqli_close($conn);
        }
        if(mysql_query("CREATE DATABASE foo")) {
            echo "Database foo created";
        } else {
            echo mysql_error();
        }
    */
        
        $mysqli = new mysqli("localhost","root","wgh","DBPROJECT");
        if($mysqli->connect_errno){
            printf("Connect failed:%s\n",$mysqli->error);
            exit();
        }else{
            echo "Connected successfully.</br>";
        }

        //if($mysqli->query("CREATE DATABASE DBPROJECT") === TRUE){
        //    echo("Datbase DBPROJECT created.</br>");
        //}

        if($mysqli->query("CREATE TABLE users (
                            id varchar(16) binary NOT NULL default '',
                            Password varchar(16) NOT NULL default '',
                            Name varchar(64) default NULL,
                            email varchar(64) default NULL,
                            PRIMARY KEY (id)
                            )") === TRUE){
            echo("TABLE users created.</br>");
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

        add_user($mysqli, "ghwan",'123','guihongwan','guihongwan@gmail.com');

        if ($result = $mysqli->query("SELECT * FROM users")) {
                printf("Select returned %d rows.</br>", $result->num_rows);

                while($obj = $result->fetch_object()){ 
                    echo($obj->id); echo("</br>");
                    echo($obj->Password); echo("</br>");
                    echo($obj->Name); echo("</br>");
                    echo($obj->email); echo("</br>");
                } 

                $result->close();
        }
        $mysqli->close();

        //echo(phpinfo());
    ?>
    
</body>
</html>