<?php include "db.php"?>
<?php session_start(); ?>

<?php

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //for security
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        
        //first query clients
        $query = "SELECT * FROM clients WHERE user_username = '{$username}' ";
        $query_login = mysqli_query($connection, $query);
        
        if($query_login){
            if($row = mysqli_fetch_assoc($query_login)){
                $db_id =$row['user_id'];
                $db_username =$row['user_username'];
                $db_password =$row['user_password'];
                $db_firstname =$row['user_firstname'];
                $db_lastname =$row['user_lastname'];
                $db_role =$row['user_role'];
                $oil_balance =$row['oil_balance'];
                $cash_balance =$row['cash_balance'];
                
                $password = crypt($password, $db_password);
            }
        }else{
            die("Query failed.".mysqli_error($connection));
        }
        
        if( isset($db_username) && ($username === $db_username) &&
              isset($db_username) && ($password === $db_password) ){
                
                $_SESSION['user_id'] = $db_id;
                $_SESSION['user_username'] = $db_username;
                $_SESSION['user_firstname'] = $db_firstname;
                $_SESSION['user_lastname'] = $db_lastname;
                $_SESSION['user_role'] = $db_role;
                $_SESSION['oil_balance'] = $oil_balance;
                $_SESSION['cash_balance'] = $cash_balance;
            

                header("Location:../transactions.php");
                
        } else {    
            //if there is no such clients, query uers
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
                    
                    $password = crypt($password, $db_password);
                }
            }else{
                die("Query failed.".mysqli_error($connection));
            }
            
            if( isset($db_username) && ($username === $db_username) &&
                  isset($db_password) && ($password === $db_password) ){

                    $_SESSION['user_id'] = $db_id;
                    $_SESSION['user_username'] = $db_username;
                    $_SESSION['user_firstname'] = $db_firstname;
                    $_SESSION['user_lastname'] = $db_lastname;
                    $_SESSION['user_role'] = $db_role;
                    //admin
                    if($db_role == "admin"){
                        header("Location:../admin");
                    }else{
                        header("Location:../transactions.php");
                    }

            } else {    
                echo "log in failed.";
                header("Location:../index.php");
            }
            
        }
        
    }
?>