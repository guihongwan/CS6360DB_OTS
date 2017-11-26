<?php
 if(isset($_GET['edit_user'])){
     $user_id = $_GET['edit_user'];
     $query = "SELECT * FROM users WHERE user_id = $user_id ";
     $select_user = mysqli_query($connection, $query);  
    while($row = mysqli_fetch_assoc($select_user)){
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
 }
?>
      
<?php
if(isset($_POST['edit_user'])){
    $user_firstname    = $_POST['user_firstname'];
    $user_lastname     = $_POST['user_lastname'];
    $user_role         = $_POST['user_role'];
    $username          = $_POST['username'];
    $user_email        = $_POST['user_email'];
    $user_password     = $_POST['user_password'];
    
    //$query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id_update}";
    
    $query = "UPDATE users SET ";
    $query .="user_firstname = '$user_firstname', ";
    $query .="user_lastname = '$user_lastname', ";
    $query .="user_role = '$user_role', ";
    $query .="user_username = '$username', ";
    $query .="user_email = '$user_email', ";
    $query .="user_password = '$user_password' ";
    $query .= "WHERE user_id = $user_id ";
    
    $edit_user_query = mysqli_query($connection, $query);
    if(!$edit_user_query){
        die('Failed to edit user.'.mysqli_error($connection));
    }
    
}

?>
       
<form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
      </div>

       <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>" >
      </div>
     
     
      <div class="form-group">
       
       <select name="user_role" id="">
          <option value="subscriber"><?php echo $user_role; ?></option>
          <?php 
              if($user_role == 'admin'){
                  echo "<option value='subscriber'>Subscriber</option>";
              } else {
                  echo "<option value='admin'>Admin</option>";
              } 
           ?>
          
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
          <input type="text" class="form-control" name="username" value="<?php echo $user_username; ?>" >
      </div>
      
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" >
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>" >
      </div>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
      </div>


</form>