
<h3>Oil Information</h3>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Price</th>
        <th>Operations</th>
    </tr>
</thead>
<tbody>
    <?php
    //fetch clients information related current trader
    $query = "SELECT * FROM oil_information ";
    $select_all_posts_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_posts_query)){
        $oil_id =$row['oil_id'];
        $oil_type =$row['oil_type'];
        $oil_price =$row['oil_price'];

        echo "<tr>";
        echo "<td>$oil_id</td>";
        echo "<td>$oil_type</td>";
        echo "<td>$oil_price</td>";
        
        echo "<td>";
        echo "<a href='transaction_sell.php?client_id={$client_id}&oil_id={$oil_id}'>Sell</a>";
        echo " . ";

        echo "</td>";

    }
    ?>   
    </tbody>   
</table> 