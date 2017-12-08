<?php 
date_default_timezone_set('UTC');
?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php include "transactions/functions.php"; ?>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Hello, Trader.
                </h1>
                
                <h3>Clients Information</h3>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Oil Balance</th>
                        <th>Cash Balance</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                //fetch clients information related current trader
                $query = "SELECT * FROM clients WHERE trader_id = '{$_SESSION['user_id']}' ";
                $stmt = $connection->prepare($query);
                $stmt->execute();
                if (!($res = $stmt->get_result())) {
                    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
                }
                while( $row = $res->fetch_assoc() ){
                    $client_id =$row['user_id'];
                    $client_firstname =$row['user_firstname'];
                    $client_lastname =$row['user_lastname'];
                    $client_email = $row['user_email'];
                    $client_oil_balance =$row['oil_balance'];
                    $client_cash_balance =$row['cash_balance'];
                    
                    echo "<tr>";
                    echo "<td>$client_id</td>";
                    echo "<td>$client_firstname</td>";
                    echo "<td>$client_lastname</td>";
                    echo "<td>$client_email</td>";
                    echo "<td>$client_oil_balance</td>";
                    echo "<td>$client_cash_balance</td>";
                    
                    echo "<td>";
                    echo "<a href='transaction_buy.php?client_id={$client_id}'>Buy</a>";
                    echo " . ";
                    
                    if($client_oil_balance > 0){
                        echo "<a href='transaction_sell.php?client_id={$client_id}'>Sell</a>";
                        echo " . ";
                    }

                    echo "</td>";
                    
                }
                $res->close();
                ?>   
                </tbody>   
                </table>
                
                <h3>My Clients' Transactions</h3>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Oil Amount</th>
                        <th>Value</th>
                        <th>Date</th>
                        <th>Commission Fee</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                //fetch transaction information
                //$query = "SELECT * FROM clients WHERE trader_id = '{$_SESSION['user_id']}' ";
                
                $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,oil_amount,value,commision_oil,commision_cash,status FROM clients, oil_transaction WHERE 
                clients.user_id = oil_transaction.client_id and 
                clients.trader_id = '{$_SESSION['user_id']}' ";

                $stmt = $connection->prepare($query);
                $stmt->execute();
                if (!($res = $stmt->get_result())) {
                    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
                }
                while( $row = $res->fetch_assoc() ){
                    
                    $transaction_id =$row['transaction_id'];
                    $client_id =$row['user_id'];
                    $client_firstname =$row['user_firstname'];
                    $client_lastname =$row['user_lastname'];
                    $date =$row['date'];
                    $oil_amount =$row['oil_amount'];
                    $value =$row['value'];
                    $commision_oil =$row['commision_oil'];
                    $commision_cash =$row['commision_cash'];
                    if($commision_oil != NULL){
                        $commision_fee = $commision_oil.' Barrels';
                    } else {
                        $commision_fee = '$'.$commision_cash;
                    }
                    $status=$row['status'];
                    
                    
                    if($status != -1 ){
                        echo "<tr>";
                        echo "<td>$transaction_id</td>";
                        echo "<td>$client_firstname</td>";
                        echo "<td>$client_lastname</td>";
                        echo "<td>$oil_amount</td>";
                        echo "<td>$value</td>";
                        echo "<td>$date</td>";
                        echo "<td>$commision_fee</td>";

                        echo "<td>";
                        ?>
                        <a href='transactions_trader.php?cancel_transaction_id=<?php echo $transaction_id ?>' onclick="return confirm('Are you sure to cancel?')">Cancel</a>


                        <?php
                        echo " . ";


                        echo "</td>";
                    }
                    
                }
                $res->close();
                ?>   
                </tbody>   
                </table>
                
                <h3>My Clients' Payments</h3>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                //fetch transaction information
                //$query = "SELECT * FROM clients WHERE trader_id = '{$_SESSION['user_id']}' ";
                
                $query = "SELECT transaction_id,user_firstname,user_lastname,date,amount,status FROM clients, payment WHERE 
                clients.user_id = payment.client_id and 
                payment.trader_id = '{$_SESSION['user_id']}' ";
                
                $stmt = $connection->prepare($query);
                $stmt->execute();
                if (!($res = $stmt->get_result())) {
                    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
                }
                while( $row = $res->fetch_assoc() ){
                    $transaction_id =$row['transaction_id'];
                    $client_firstname =$row['user_firstname'];
                    $client_lastname =$row['user_lastname'];
                    $date =$row['date'];
                    $amount =$row['amount'];
                    $status = $row['status'];
                    
                    if($status != -1){
                        echo "<tr>";
                        echo "<td>$transaction_id</td>";
                        echo "<td>$client_firstname</td>";
                        echo "<td>$client_lastname</td>";
                        echo "<td>$amount</td>";
                        echo "<td>$date</td>";

                        echo "<td>";
                        ?>
                        <a href='transactions_trader.php?cancel_payment_id=<?php echo $transaction_id ?>' onclick="return confirm('Are you sure to cancel?')">Cancel</a>

                        <?php
                        echo " . ";

                        echo "</td>";
                    }
                    
                }
                $res->close();
                ?>   
                </tbody>   
                </table> 
                
            </div>
            
            <?php
                //cancel    
                if(isset($_GET['cancel_transaction_id'])){
                    $cancel_transaction_id = $_GET['cancel_transaction_id'];
                    //get transaction information
                    $query = "SELECT client_id,oil_amount,value,commision_oil,commision_cash FROM oil_transaction WHERE transaction_id = '{$cancel_transaction_id}' ";

                    $stmt = $connection->prepare($query);
                    $stmt->execute();
                    if (!($res = $stmt->get_result())) {
                        echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
                    }
                    while( $row = $res->fetch_assoc() ){
                        $client_id =$row['client_id'];
                        $oil_amount =$row['oil_amount'];
                        $value =$row['value'];
                        $commision_oil =$row['commision_oil'];
                        $commision_cash =$row['commision_cash'];
                    }
                    $res->close();
                    
                    //update oil balance & cash balance
                    $cash_balance = getCashBalance($client_id);
                    $oil_balance = getOilBalance($client_id);
                    
                    //buy transaction
                    //oil balance will be subtracted.
                    //cash balance will be added.
//                    if($oil_amount>0){
                        $new_oil_balance = $oil_balance - $oil_amount;
                        $new_cash_balance = $cash_balance + $value;
//                    }else{//sell transaction
//                        $new_oil_balance = $oil_balance - $oil_amount;
//                        $new_cash_balance = $cash_balance + $value;
//                    }
                    if($commision_oil != NULL){
                        $new_oil_balance = $new_oil_balance + $commision_oil;
                    }
                    if($commision_cash != NULL){
                        $new_cash_balance = $new_cash_balance + $commision_cash;
                    }
                    
                    updateOilBalance($client_id,$new_oil_balance);
                    updateCashBalance($client_id,$new_cash_balance);
                    
                    //update status
                    $status = -1;//0:submitted, 1:done -1:cancel
                    updateOilTransactionStatus($cancel_transaction_id, $status);
                    
                    //insert logs
                    insertLogs($cancel_transaction_id);
                    
                    header("Location: transactions_trader.php");
                }
                    
                if(isset($_GET['cancel_payment_id'])){
                    $cancel_transaction_id = $_GET['cancel_payment_id'];
                    //update oil transaction
                    $status = -1;//0:submitted, 1:done -1:cancel
                    updatePayTransactionStatus($cancel_transaction_id, $status);
                    
                    //insert logs
                    insertLogs($cancel_transaction_id);
                    
                    header("Location: transactions_trader.php");
                }
            ?>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->
 
        <hr>

<?php include "includes/footer.php"; ?>
