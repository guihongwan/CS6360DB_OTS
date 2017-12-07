<?php include "db.php";?>
<?php

function createRow(){
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //for security
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    //for password security
    $hassFormat = "$2y$10$";
    $salt = "guihongwan20130609meng";//length 22
    $hashF_and_salt = $hassFormat.$salt;
    $password = crypt($password,$hashF_and_salt);
    
    $query = "INSERT INTO users(username,password) ";
    $query .= "VALUES ('$username','$password')";
    
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Create failed. <br>'. mysqli_error($connection));
    }
}

function updateTable(){
    global $connection;
    $username_new = $_POST['username_new'];//new name
    $password_new = $_POST['password_new'];
    $username = $_POST['username'];
    
    //print_r($_POST);
    
    $query = "UPDATE users SET ";
    $query .= "username = '$username_new', ";
    $query .= "password = '$password_new' ";
    $query .= "WHERE username = '$username' ";
    
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("update failed. <br>" . mysqli_error($connection));
    }
}

function deleteRow(){
    global $connection;
    $username = $_POST['username'];
    
    $query = "DELETE FROM users ";
    $query .= "WHERE username = '$username' ";
    
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Delete failed. <br>" . mysqli_error($connection));
    }
}

function showAllData(){
    global $connection;
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query failed.');
    }
    
    while($row = mysqli_fetch_assoc($result)){//mysqli_fetch_row
        if($row[username]){
             print_r($row);
         }
    }   
}

function showAllUsers(){
    global $connection;
    $query = "SELECT * FROM users";
    
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query failed.');
    }

    while($row = mysqli_fetch_assoc($result)){
        $username = $row['username'];
        if($username){
            echo "<option value='$username'>$username</option>";
        }
    }
}

?>

