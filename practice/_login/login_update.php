<?php include "db.php";?>
<?php include "db_functions.php";?>
<?php updateTable(); ?>
<?php include "includes/header.php" ?>

   <div class="container">
       <div class="col-sm-6">
          <h1 class="text-center">Update</h1>
           <form action="login_update.php" method="post">
               <div class="form-group">
                   <label for="username_new">Username</label>
                   <input type="text" name="username_new" class="form-control">
               </div>
               <div class="form-group">
                   <label for="password_new">Password</label>
                   <input type="text" name="password_new" class="form-control">
               </div>
               <div class="form-group">
                  <select name="username">
                  <?php
                      showAllUsers();
                  ?>
                  </select> 
               </div>
               <input class="btn btn-primary" type="submit" name="submit" value="update">
           </form>
       </div>
   </div>
<?php include "includes/footer.php" ?>
