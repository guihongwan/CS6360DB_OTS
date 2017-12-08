<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = $_POST['password'];
    $user_street = $_POST['street'];
    $user_city = $_POST['city'];
    $user_state = $_POST['state'];
    $user_zipcode = $_POST['zipcode'];
    
    //for security
    $username = mysqli_real_escape_string($connection, $username);
    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_phone = mysqli_real_escape_string($connection, $user_phone);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    $user_street = mysqli_real_escape_string($connection, $user_street);
    $user_city = mysqli_real_escape_string($connection, $user_city);
    $user_state = mysqli_real_escape_string($connection, $user_state);
    $user_zipcode = mysqli_real_escape_string($connection, $user_zipcode);
    
    if(!empty($username) && !empty($user_firstname) && !empty($user_lastname) 
          && !empty($user_email) && !empty($user_phone) && !empty($user_password) 
          && !empty($user_street) && !empty($user_city) && !empty($user_state) && !empty($user_zipcode)){
        
        include "includes/password_salt.php";
        
        $user_password = crypt($user_password, $salt);
              
        $query = "INSERT INTO clients(user_firstname,user_lastname,user_username,user_email,user_phone,user_password,street,city,state,zipcode) ";
        $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
        
        //i - integer  d - double s - string  b - BLOB
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssssssss", $user_firstname, $user_lastname, $username, $user_email, $user_phone, $user_password, $user_street, $user_city, $user_state, $user_zipcode);
        
        $stmt->execute();
        $stmt->close();
        
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
                            <label for="phone" class="sr-only">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="street" class="sr-only">Street</label>
                            <input type="text" name="street" id="street" class="form-control" placeholder="Street">
                        </div>
                        <div class="form-group">
                            <label for="city" class="sr-only">City</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="state" class="sr-only">State</label>
                            <input type="text" name="state" id="state" class="form-control" placeholder="State">
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="sr-only">Zipcode</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode">
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
