                   <form action="" method="post">
                      <div class="form-group">
                          <label for="cat_title">Update Category</label>
                   <?php
                    if(isset($_GET['update'])){
                         $cat_id_update = $_GET['update'];
                         $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_update} ";
                         $update_query = mysqli_query($connection, $query);
                         if(!$update_query){
                             die("Fail to query." . mysqli_error($connection));
                         } else {
                             $row = mysqli_fetch_assoc($update_query);
                             $cat_id = $row['cat_id'];
                             $cat_title = $row['cat_title'];
                             ?>
                             <input value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control" name="cat_title" >
                         <?php
                         }
                     }
                    ?>
                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" name="edit" value="Update Category">
                      </div>
                      
                   <?php //update
                   if(isset($_POST['edit'])){
                       $cat_title = $_POST['cat_title'];
                       if($cat_title == "" || empty($cat_title)){
                           echo "This field should not be empty.";
                           
                       } else {
                           $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id_update}";
                           
                           $create_cat = mysqli_query($connection, $query);
                           if(!$create_cat){
                               die("Fail to update.".mysqli_error($connection));
                           }
                       }
                       
                   }
                   ?>
                      
                       
                   </form>