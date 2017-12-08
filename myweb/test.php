<?php include "includes/db.php"; ?>
               
<?php
$query = "SELECT * FROM posts ";
$stmt = $connection->prepare($query);
$stmt->execute();
if (!($res = $stmt->get_result())) {
    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
}
for ($row_no = ($res->num_rows - 1); $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    var_dump($res->fetch_assoc());
}

$res->close();                

?>