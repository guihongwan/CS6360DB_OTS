<div class="col-md-4">

                <!-- Search Well -->
                <div class="well">
                    <h4>Search</h4>
                    <form action="search_clients.php" method="post">
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

                <!-- Side Widget Well -->
                <?php include "widgets.php"?>
        
</div>