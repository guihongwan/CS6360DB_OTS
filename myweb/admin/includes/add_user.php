<?php
if(isset($_POST['create_user'])){
    $user_firstname    = $_POST['user_firstname'];
    $user_lastname     = $_POST['user_lastname'];
    $user_role         = $_POST['user_role'];
    $username          = $_POST['username'];
    $user_email        = $_POST['user_email'];
    $user_password     = $_POST['user_password'];
    
    //for security
    $user_firstname    = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname    = mysqli_real_escape_string($connection,$user_lastname);
    $user_role    = mysqli_real_escape_string($connection,$user_role);
    $username    = mysqli_real_escape_string($connection,$username);
    $user_email    = mysqli_real_escape_string($connection,$user_email);
    $user_password    = mysqli_real_escape_string($connection,$user_password);
    
    //get salt
    include "../includes/password_salt.php";
    $user_password = crypt($user_password, $salt);
    
    
    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,user_username,user_email,user_password)";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";
    $create_user_query = mysqli_query($connection, $query);
    if(!$create_user_query){
        die('Failed to create user.'.mysqli_error($connection));
    }
    
}

?>
    
<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

       <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>
     
     
      <div class="form-group">
       
       <select name="user_role" id="">
          <option value="trader">Select Options</option>
          <option value="admin">Admin</option>
          <option value="manager">Manager</option>
          <option value="trader">Trader</option>
       </select>
       
      </div>
      
<!--
      <div class="form-group">
         <label for="user_image">User Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="username">
      </div>
      
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
      </div>


</form>