<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    if(!empty($username) && !empty($user_firstname) && !empty($user_lastname) 
          && !empty($user_email) && !empty($user_password) ){
        
        $query = "SELECT user_randSalt FROM users ";
        $select_randsalt_query = mysqli_query($connection,$query);
        if(!$select_randsalt_query){
            die("Qeury failed.".mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($select_randsalt_query)){
            $salt = $row['user_randSalt'];
        }
        if(!isset($salt)){
            $salt = "$2y$10$databasedbluckybin1011";//default
        }
        
        $user_password = crypt($user_password, $salt);
        
        $query = "INSERT INTO users(user_firstname,user_lastname,user_role,user_username,user_email,user_password)";
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','subscriber','{$username}','{$user_email}','{$user_password}') ";
        $create_user_query = mysqli_query($connection, $query);
        if(!$create_user_query){
            die('Failed to create user.'.mysqli_error($connection));
        }
        
        $message = "* Your Registration has been submitted.";
        
    } else {
        $message = "* Fields should not be empty.";
    }
} else {
    $message = "";
}

?>
   
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                   <h6><?php echo $message ;?></h6>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
