<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php

if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == "manager") {
    header("location: transactions_manager.php");
}

if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == "trader") {
    header("location: transactions_trader.php");
}

if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == "client") {
    header("location: transactions_client.php");
}


?>
  
  
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Transactions !
                </h1>
                
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
