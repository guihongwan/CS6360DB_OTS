<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Oil Balance</th>
            <th>Cash Balance</th>
            <!--<th>Operations</th>-->
        </tr>
    </thead>
    <tbody>
    <?php //Find all users
    $query = "SELECT * FROM clients ";
    $select_all_users = mysqli_query($connection, $query);  
    while($row = mysqli_fetch_assoc($select_all_users)){
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $oil_balance = $row['oil_balance'];
        $cash_balance = $row['cash_balance'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td>$oil_balance</td>";
        echo "<td>$cash_balance</td>";
        
        /*
        echo "<td>";
        if($user_role != 'admin'){
            echo "<a href='users.php?change_to_admin={$user_id}'>Admin</a>";
            echo " . ";
        }
        if($user_role != 'manager'){
            echo "<a href='users.php?change_to_mana={$user_id}'>Manager</a>";
            echo " . ";
        }
        if($user_role != 'trader'){
            echo "<a href='users.php?change_to_trad={$user_id}'>Trader</a>";
            echo " . ";
        }
        
        echo "<a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a>";
        echo " . ";
        
        echo "<a href='users.php?delete={$user_id}'>Delete</a>";
        
        echo "</td>";
        */
    }
        
    if(isset($_GET['change_to_admin'])){
        $the_user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
        $change_to_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
    
    if(isset($_GET['change_to_trad'])){
        $the_user_id = $_GET['change_to_trad'];
        $query = "UPDATE users SET user_role = 'trader' WHERE user_id = $the_user_id ";
        $change_to_subscriber_query = mysqli_query($connection, $query);
        header("Location: users.php");
        
    }
    if(isset($_GET['change_to_mana'])){
        $the_user_id = $_GET['change_to_mana'];
        $query = "UPDATE users SET user_role = 'manager' WHERE user_id = $the_user_id ";
        $change_to_subscriber_query = mysqli_query($connection, $query);
        header("Location: users.php");
        
    }
    
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $the_user_id ";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
        
    ?>

    </tbody>   
</table> 