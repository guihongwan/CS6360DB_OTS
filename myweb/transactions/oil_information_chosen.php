
<?php
$query = "SELECT * FROM oil_information where oil_id = $oil_id";

$stmt = $connection->prepare($query);
$stmt->execute();
if (!($res = $stmt->get_result())) {
    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
}
while( $row = $res->fetch_assoc() ){
    
    $oil_id =$row['oil_id'];
    $oil_type =$row['oil_type'];
    $oil_price =$row['oil_price'];
    
    echo "<h3 class='page-header' style='color: blue; font-weight: bold;'>";
        echo $oil_type;
    
        echo "<small>";
        echo " $$oil_price per Gallon";//1 Barrel = 42 Gallons
        echo "</small>";
    
    echo "</h3>";
}
$res->close();
?> 
