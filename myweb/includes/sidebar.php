<div class="col-md-4">

                <!-- Search Well -->
                <div class="well">
                    <h4>Search</h4>
                    <form action="search.php" method="post">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                      </div><!-- /.input-group -->
                    </form><!--search form-->
                </div>

               <!-- log in Well -->
                <div class="well">
                    <h4>Log in</h4>
                    <form action="includes/login.php" method="post">
                      <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                      </div><!-- /.username-group -->
                      <div class="input-group">
                        <input name="password" type="text" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                           <button class="btn btn-primary" name="login" type="submit">Submit</button>
                        </span>
                      </div><!-- /.password-group -->
                    </form><!--search form-->
                </div>
                
                
                <!-- Blog Categories Well -->
                <?php
                    
                    $query = "SELECT * FROM categories LIMIT 3";
                    $select_all_categories_sidebar = mysqli_query($connection, $query);
                ?>    
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               <?php
                               while($row = mysqli_fetch_assoc($select_all_categories_sidebar)){
                                 $cat_title = $row['cat_title'];
                                 echo "<li><a href='#'>$cat_title</a></li>";
                               }
                                 ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widgets.php"?>
        
            </div>