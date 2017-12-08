<?php 
date_default_timezone_set('UTC');
?>

<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php include "transactions/functions.php"; ?>

<?php
  if(isset($_GET['client_id'])){
     $client_id = $_GET['client_id'];

    //commission rate
    $commission_rate = getCommissionRate($client_id);
    //echo $commission_rate;
      
    $oil_balance = getOilBalance($client_id);
  }
  if(isset($_GET['oil_id'])){
     $oil_id = $_GET['oil_id'];
      
     //oil price
     $oil_price = getOilPrice($oil_id); 
     //echo $oil_price;
  }

?>
  
<?php
  if(isset($_POST['submit'])){
      //echo $client_id;
      //echo $oil_id;
      $date = date("Y.m.d");
      //echo $commission_rate;
      //echo $oil_price;
      
      $oil_amount = $_POST['oil_amount'];
      $commission_type = $_POST['commission_type'];
      
      //for security
      $oil_amount    = mysqli_real_escape_string($connection,$oil_amount);
      $commission_type    = mysqli_real_escape_string($connection,$commission_type);
      
      $oil_amount = (-1)*$oil_amount;
      $value = $oil_amount*42*$oil_price;
      
      if($commission_type == 'oil'){
          $commission_oil = -$oil_amount*$commission_rate*0.01;
      } else {
          $commission_cash = -$value*$commission_rate*0.01;
      }
      
      //update oil balance
      $new_oil_balance = $oil_balance+$oil_amount;
      if(isset($commission_oil)){
          $new_oil_balance = $new_oil_balance - $commission_oil;
          if($new_oil_balance < 0 ){
              die("Fail to issue the transaction. You don't have enough oil to pay for the commission fee!!!");
          }
      }
      updateOilBalance($client_id,$new_oil_balance);
      
      //update cash balance
      $cash_balance = getCashBalance($client_id);
      $new_cash_balance = $cash_balance-$value;
      if(isset($commission_cash)){
          $new_cash_balance = $new_cash_balance - $commission_cash;
          updateCashBalance($client_id,$new_cash_balance);
      }
      
      //issue transaction
      if(isset($commission_oil)){
          $query = "INSERT INTO oil_transaction(client_id,oil_id,date,oil_amount,value,commision_oil,commision_rate,oil_price) ";
//          $query .= "VALUES('{$client_id}','{$oil_id}','{$date}','{$oil_amount}','{$value}','{$commission_oil}','{$commission_rate}','{$oil_price}') ";
          
          $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?) ";

          //i - integer  d - double s - string  b - BLOB
          $stmt = $connection->prepare($query);
          $stmt->bind_param("iisddsdd", $client_id, $oil_id, $date, $oil_amount, $value, $commission_oil, $commission_rate, $oil_price);
          
          
      } else {
          $query = "INSERT INTO oil_transaction(client_id,oil_id,date,oil_amount,value,commision_cash,commision_rate,oil_price) ";
//          $query .= "VALUES('{$client_id}','{$oil_id}','{$date}','{$oil_amount}','{$value}','{$commission_cash}','{$commission_rate}','{$oil_price}') ";
          $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?) ";

          //i - integer  d - double s - string  b - BLOB
          $stmt = $connection->prepare($query);
          $stmt->bind_param("iisddsdd", $client_id, $oil_id, $date, $oil_amount, $value, $commission_cash, $commission_rate, $oil_price);
      }
        
      $stmt->execute();
      $stmt->close();
      
      header("Location:transaction_success.php");
      
  }
?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                
                <!-- Oil type options -->
                <?php 
                    if(!isset($oil_id)){
                        include "transactions/oil_information_form_sell.php"; 
                    } else {
                        //show the information chosen
                        include "transactions/oil_information_chosen.php"; 

                    
                ?>
                <div class="col-md-8">
                    <div class="form-group">

                        <form oninput="
                          oil_cost.value='Oil Value : $'+String(parseInt(oil_amount.value)*parseInt(42)*parseFloat(<?php echo $oil_price; ?>)); 
                          oil_fee.value=String(parseInt(oil_amount.value)*parseFloat(<?php echo 0.01*$commission_rate; ?>))+' Barrels';
                          cash_fee.value='$'+String(parseInt(oil_amount.value)*parseInt(42)*parseFloat(<?php echo $oil_price; ?>)*parseFloat(<?php echo 0.01*$commission_rate; ?>));
                          "
                          action="" method="post">
                           
                            <label for="oil_amount">Amount ( Barrel ) : 1 Barrel = 42 Gallons , Maximum: <?php echo $oil_balance ?> Gallons</label><br>
                            <input type="number" min="0.0" max="<?php echo $oil_balance;?>" class="form-control" name="oil_amount" placeholder="Enter the amount you want to sell">
                            <output name="oil_cost">Oil Value : $0</output>
                            
                            <label for="commission_type">Commission Fee Type : </label><br>
                            <input type="radio" name="commission_type" value="oil" checked="checked"> Oil<br>
                            <output name="oil_fee">0.0 Barrels</output>
                            
                            <input type="radio" name="commission_type" value="cash"> Cash<br>
                            <output name="cash_fee">$0.0</output>
                            
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                            </div>
                            
                        </form>

                    </div>
                   
               </div>
               <?php } ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->
 
        <hr>

<?php include "includes/footer.php"; ?>
