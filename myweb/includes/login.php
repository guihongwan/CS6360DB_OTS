<?php include "db.php"?>
<?php session_start(); ?>

<?php

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        //for security
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
        $query_login = mysqli_query($connection, $query);
        
        if($query_login){
            if($row = mysqli_fetch_assoc($query_login)){
                $db_id =$row['user_id'];
                $db_username =$row['user_username'];
                $db_password =$row['user_password'];
                $db_firstname =$row['user_firstname'];
                $db_lastname =$row['user_lastname'];
                $db_role =$row['user_role'];
            }
        }else{
            die("Query failed.".mysqli_error($connection));
        }

        $password = crypt($password, $db_password);
        
        if( isset($db_username) && ($username === $db_username) && ($password === $db_password)){
                
                $_SESSION['user_username'] = $db_username;
                $_SESSION['user_firstname'] = $db_firstname;
                $_SESSION['user_lastname'] = $db_lastname;
                $_SESSION['user_role'] = $db_role;
                
                header("Location:../admin");
                
        } else {    
            echo "log in failed.";
            header("Location:../index.php");
        }
        
    }
?>