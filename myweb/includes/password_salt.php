<?php
    $query = "SELECT user_randSalt FROM users ";
    $select_randsalt_query = mysqli_query($connection,$query);
    if(!$select_randsalt_query){
        die("Qeury failed.".mysqli_error($connection));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['user_randSalt'];

    if(!isset($salt)){
        $salt = "$2y$10$databasedbluckybin1011";//default
    }
?>