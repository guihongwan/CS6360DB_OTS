
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php include "transactions/functions.php"; ?>

<?php
  if(isset($_GET['client_id'])){
     $client_id = $_GET['client_id'];
     $trader_id = getTraderId($client_id);
  } 
?>
  
<?php
  if(isset($_POST['submit'])){
      $date = date("Y.m.d");
      
      $pay_amount = $_POST['pay_amount'];
      $cash_balance = getCashBalance($client_id);
      
      //update cash balance
      $new_cash_balance = $cash_balance + $pay_amount;
      $query = "UPDATE clients SET ";
      $query .="cash_balance = '$new_cash_balance' ";
      $query .= "WHERE user_id = $client_id ";

      $update_cash_balance = mysqli_query($connection, $query);
      if(!$update_cash_balance){
            die('Failed to edit user.'.mysqli_error($connection));
      }
      
      //issue payment
      $query = "INSERT INTO payment(client_id,date,amount,trader_id)";
      $query .= "VALUES('{$client_id}','{$date}','{$pay_amount}','{$trader_id}') ";
      
      $issue_transaction = mysqli_query($connection, $query);
      if(!$issue_transaction){
          die('Issue payment fail.'.mysqli_error($connection));
      } else {
          header("Location:transaction_success.php");
      }
      
  }
?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-8">
               
                <div class="col-md-6">
                    <div class="form-group">

                        <form
                          action="" method="post">
                           
                            <label for="amount">Amount ( Dollars ) : </label><br>
                            <input type="number" min=0 class="form-control" name="pay_amount" placeholder="Enter the amount you want to pay">
                            
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                            </div>
                            
                        </form>

                    </div>
                   
               </div>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->
 
        <hr>

<?php include "includes/footer.php"; ?>
