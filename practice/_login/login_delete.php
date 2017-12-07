<?php include "db.php";?>
<?php include "db_functions.php";?>
<?php deleteRow(); ?>
<?php include "includes/header.php" ?>
   <div class="container">
       
       <div class="col-sm-6">
          <h1 class="text-center">Delete</h1>
           <form action="login_delete.php" method="post">
               <div class="form-group">
                  <select name="username">
                  <?php
                      showAllUsers();//in option
                  ?> 
                  </select> 
               </div>
               <input class="btn btn-primary" type="submit" name="submit" value="DELETE">
           </form>
       </div>
   </div>
<?php include "includes/footer.php" ?>
