<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Hi, Manager.
                </h1>
                
                
                <form action="" method="post">
                    <div class="col-md-4">
                    <label for="start_date">Start Date : </label><br>
                    <input type="date" class="form-control" name="start_date">
                    </div>   
                    <div class="col-md-4">
                    <label for="end_date">End Date : </label><br>
                    <input type="date" class="form-control" name="end_date">
                    </div> 
                    <div class="form-group">
                        <label for="Submit"> </label><br>
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    </div>
                            
                </form>
                
                
                
                <?php
                        
                if(isset($_POST['submit']) && isset($_POST['start_date']) && isset($_POST['end_date'])){
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
                    if($start_date > $end_date){
                        echo "The start time should be earlier than the end time!!";
                    } else {
                        
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
                            $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,oil_amount,value,commision_oil,commision_cash,status FROM clients, oil_transaction WHERE 
                            clients.user_id = oil_transaction.client_id and
                            oil_transaction.date >= '{$start_date}' and 
                            oil_transaction.date <= '{$end_date}'
                            ";
                        
                            $stmt = $connection->prepare($query);
                            $stmt->execute();
                            if (!($res = $stmt->get_result())) {
                                echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
                            }

                            
                            while( $row = $res->fetch_assoc() ){
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
                            $res->close();
                                
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
                                
                            $query = "SELECT transaction_id,user_id,user_firstname,user_lastname,date,amount,status 
                            FROM clients, payment WHERE 
                            clients.user_id = payment.client_id and 
                            payment.date >= '{$start_date}' and 
                            payment.date <= '{$end_date}'
                            ";
                                    

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
                        ?>
                        </tbody>   
                    </table>
                                    
                  <?php
                  }//end start time and end time
                }//end submit
               ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/transactions_sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
