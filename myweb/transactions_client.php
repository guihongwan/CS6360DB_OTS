<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Hello, Client.
                </h1>
                <h3>My Account </h3>
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
                $query = "SELECT * FROM clients WHERE user_id = '{$_SESSION['user_id']}' ";
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    
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
                ?>   
                  </tbody>   
                </table>
                
                <h3>My Transactions</h3>
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
                    </tr>
                </thead>
                <tbody>
                
                <?php
                //fetch transaction information
                //$query = "SELECT * FROM clients WHERE trader_id = '{$_SESSION['user_id']}' ";
                
                $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,oil_amount,value,commision_oil,commision_cash FROM clients, oil_transaction WHERE 
                clients.user_id = oil_transaction.client_id and 
                clients.user_id = '{$_SESSION['user_id']}' ";
                    
                $total_value = 0;
                    
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    
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
                    
                    
                    echo "<tr>";
                    echo "<td>$transaction_id</td>";
                    echo "<td>$client_firstname</td>";
                    echo "<td>$client_lastname</td>";
                    echo "<td>$oil_amount</td>";
                    echo "<td>$value</td>";
                    echo "<td>$date</td>";
                    echo "<td>$commision_fee</td>";
                    
                }
                ?>   
                </tbody>   
                </table>
                
                <h3>My Payments <a href='transaction_pay.php?client_id=<?php echo $client_id ?>'><font size="3">Pay</font></a></h3> 
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                $query = "SELECT * FROM payment WHERE client_id = '{$_SESSION['user_id']}' ";
                    
                $total_payment = 0;
                    
                $select_payment_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_payment_query)){
                    
                    $transaction_id =$row['transaction_id'];
                    $date =$row['date'];
                    $amount =$row['amount'];
                    $total_payment = $total_payment + $amount;
                            
                    echo "<tr>";
                    echo "<td>$transaction_id</td>";
                    echo "<td>$amount</td>";
                    echo "<td>$date</td>";
                    
                }
                ?>   
                </tbody>   
                </table> 
                <div> The total amount: <?php echo '$'.$total_payment ?></div>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->
 
        <hr>

<?php include "includes/footer.php"; ?>
