
<?php
function getOilPrice($oil_id){
    global $connection;
    $query = "SELECT oil_price FROM oil_information WHERE oil_id = $oil_id";
    
    $stmt = $connection->prepare($query);
    $stmt->execute();
    if (!($res = $stmt->get_result())) {
        echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    while( $row = $res->fetch_assoc() ){
        $oil_price =$row['oil_price'];
        //echo "oil_pric:".$oil_price;    
    }
    $res->close();
    return $oil_price;
}

function getCommissionRate($client_id){
    global $connection;
    $query = "SELECT commission_rate FROM classification, clients ";
    $query .=  "WHERE clients.user_id = $client_id and classification.level_name = clients.level_name ";

    $stmt = $connection->prepare($query);
    $stmt->execute();
    if (!($res = $stmt->get_result())) {
        echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    while( $row = $res->fetch_assoc() ){
        
        $commission_rate =$row['commission_rate'];
        //echo "commission_rate:".$commission_rate;
        
    }
    
    $res->close();
    return $commission_rate;
}

function getOilBalance($client_id){
    global $connection;
    $query = "SELECT oil_balance FROM clients WHERE user_id = '{$client_id}' ";
    $select_oil_balance_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_oil_balance_query)){
        $oil_balance = $row['oil_balance'];
          //echo "oil_balance:".$oil_balance;
    }
    return $oil_balance;
}

function getCashBalance($client_id){
    global $connection;
    $query = "SELECT cash_balance FROM clients WHERE user_id = '{$client_id}' ";
    $select_cash_balance_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_cash_balance_query)){
        $cash_balance = $row['cash_balance'];
          //echo "cash_balance:".$cash_balance;
    }
    return $cash_balance;
}

function updateOilBalance($client_id,$new_oil_balance){
     global $connection;
     $query = "UPDATE clients SET ";
     $query .="oil_balance = '$new_oil_balance' ";
     $query .= "WHERE user_id = $client_id ";
    
     $update_oil_balance = mysqli_query($connection, $query);
     if(!$update_oil_balance){
            die('Failed to edit user.'.mysqli_error($connection));
      }
}

function updateCashBalance($client_id,$new_cash_balance){
     global $connection;
     $query = "UPDATE clients SET ";
     $query .="cash_balance = '$new_cash_balance' ";
     $query .= "WHERE user_id = $client_id ";
    
     $update_cash_balance = mysqli_query($connection, $query);
     if(!$update_cash_balance){
            die('Failed to edit user.'.mysqli_error($connection));
      }
}

function upgradeClientLevel($client_id){
     global $connection;
     $query = "UPDATE clients SET ";
     $query .="level_name = 'Gold' ";
     $query .= "WHERE user_id = $client_id ";
    
     $update_level = mysqli_query($connection, $query);
     if(!$update_level){
            die('Failed to edit user.'.mysqli_error($connection));
      }
}

function getTraderId($client_id){
    global $connection;
    $query = "SELECT trader_id FROM clients WHERE user_id = '{$client_id}' ";
    $get_trader_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_trader_query)){
        $trader_id = $row['trader_id'];
    }
    return $trader_id;
}
function updateOilTransactionStatus($transaction_id, $status){
    global $connection;
    $query = "UPDATE oil_transaction SET ";
    $query .="status = '$status' ";
    $query .= "WHERE transaction_id = $transaction_id ";
    $edit_status_query = mysqli_query($connection, $query);
    if(!$edit_status_query){
        die('Failed to update status.'.mysqli_error($connection));
    }
}

function updatePayTransactionStatus($transaction_id, $status){
    global $connection;
    $query = "UPDATE payment SET ";
    $query .="status = '$status' ";
    $query .= "WHERE transaction_id = $transaction_id ";
    $edit_status_query = mysqli_query($connection, $query);
    if(!$edit_status_query){
        die('Failed to update status.'.mysqli_error($connection));
    }
}



function insertLogs($transaction_id){
    global $connection;
    
    $trader_id = $_SESSION['user_id'];
    $date = date("Y.m.d");
    
    $query = "INSERT INTO logs(transaction_id,trader_id,date)";
    $query .= "VALUES('{$transaction_id}','{$trader_id}','{$date}') ";
      
    $insertLogs = mysqli_query($connection, $query);
    if(!$insertLogs){
        die('Insert Logs fail.'.mysqli_error($connection));
    }
}

?>   
