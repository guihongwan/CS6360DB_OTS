<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Search Results 
                    <small>
                       <?php 
                        if(isset($_POST['search'])) echo $_POST['search']; 
                        ?>
                    </small>
                </h1>
                <?php
                    if( isset($_SESSION['user_role']) && 
                           ($_SESSION['user_role'] == "trader"||$_SESSION['user_role'] == "manager")) {
                        //echo "<br>user_role:".$_SESSION['user_role'];
                        
                        if(isset($_POST['submit'])){
                            $search = $_POST['search'];
                            //echo "<br>search:".$search;
                            $search    = mysqli_real_escape_string($connection,$search);
                            if($search != ""){
                                //echo "<br>search:_".$search."_";
                                //search Name
                                $query = "SELECT user_id FROM clients WHERE ";
                                $query .="user_username LIKE '%$search%' or ";
                                $query .="user_firstname LIKE '%$search%' or ";
                                $query .="user_lastname LIKE '%$search%' or ";
                                $query .="street LIKE '%$search%' or ";
                                $query .="city LIKE '%$search%' ";
                                
                                {
                                    //Transaction
                                    ?>
                                    <h3>Transactions</h3>
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
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $search_query = mysqli_query($connection, $query);
                                                while($row = mysqli_fetch_assoc($search_query)){
                                                    $user_id = $row['user_id'];
                                                    //echo $user_id;
                                                    //manager can search all clients
                                                    if($_SESSION['user_role'] == "manager"){
                                                        $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,oil_amount,value,commision_oil,commision_cash,status FROM clients, oil_transaction WHERE 
                                                        clients.user_id = oil_transaction.client_id and
                                                        clients.user_id = '{$user_id}' 
                                                        ";
                                                    
                                                    } else {
                                                        $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,oil_amount,value,commision_oil,commision_cash,status FROM clients, oil_transaction WHERE 
                                                        clients.user_id = oil_transaction.client_id and 
                                                        clients.trader_id = '{$_SESSION['user_id']}' and 
                                                        clients.user_id = '{$user_id}' 
                                                        ";
                                                        
                                                    }

                                                    $select_all_posts_query = mysqli_query($connection, $query);
                                                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                                                        //echo "<br> innner ".$user_id;
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
                                                        
                                                        echo "<tr>";
                                                        echo "<td>$transaction_id</td>";
                                                        echo "<td>$client_firstname</td>";
                                                        echo "<td>$client_lastname</td>";
                                                        echo "<td>$oil_amount</td>";
                                                        echo "<td>$value</td>";
                                                        echo "<td>$date</td>";
                                                        echo "<td>$commision_fee</td>";
                                                        echo "<td>$status</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                        </tbody>   
                                    </table>
                                    
                                    <h3>Payments</h3>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $search_query = mysqli_query($connection, $query);
                                                while($row = mysqli_fetch_assoc($search_query)){
                                                    $user_id = $row['user_id'];
                                                    //echo $user_id;
                                                    if($_SESSION['user_role'] == "manager"){
                                                        $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,amount,status 
                                                        FROM clients, payment WHERE 
                                                        clients.user_id = payment.client_id and 
                                                        clients.user_id = '{$user_id}' 
                                                        ";
                                                    } else {
                                                        $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,amount,status 
                                                        FROM clients, payment WHERE 
                                                        clients.user_id = payment.client_id and 
                                                        clients.trader_id = '{$_SESSION['user_id']}' and 
                                                        clients.user_id = '{$user_id}' 
                                                        ";
                                                    }

                                                    $select_all_posts_query = mysqli_query($connection, $query);
                                                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                                                        //echo "<br> innner ".$user_id;
                                                        $transaction_id =$row['transaction_id'];
                                                        $client_id =$row['user_id'];
                                                        $client_firstname =$row['user_firstname'];
                                                        $client_lastname =$row['user_lastname'];
                                                        $date =$row['date'];
                                                        $amount =$row['amount'];
                                                        $status=$row['status'];
                                                        
                                                        echo "<tr>";
                                                        echo "<td>$transaction_id</td>";
                                                        echo "<td>$client_firstname</td>";
                                                        echo "<td>$client_lastname</td>";
                                                        echo "<td>$amount</td>";
                                                        echo "<td>$date</td>";
                                                        echo "<td>$status</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                        </tbody>   
                                    </table>
                                    
                                <?php
                                }
                            }
                        }
                    
                    }else {
                        echo "No Results.";
                    }
               ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
