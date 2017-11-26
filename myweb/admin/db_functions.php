
<?php
function insert_category(){
    global $connection;
    if(isset($_POST['add'])){
       $cat_title = $_POST['cat_title'];
       if($cat_title == "" || empty($cat_title)){
           echo "This field should not be empty.";

       } else {
           $query = "INSERT INTO categories(cat_title) ";
           $query .= "VALUE('$cat_title')";

           $create_cat = mysqli_query($connection, $query);
           if(!$create_cat){
               die("Fail to insert.".mysqli_error($connection));
           }
       }               
    }
}

function find_all_categories(){
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_all_categories_query = mysqli_query($connection, $query);  
    while($row = mysqli_fetch_assoc($select_all_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td>
            <a href='categories.php?delete={$cat_id}'>Delete</a>
             . 
            <a href='categories.php?update={$cat_id}'>Update</a>
            </td>"; 
        echo "</tr>";
    }
}

function delete_category(){
     global $connection;
     if(isset($_GET['delete'])){
         $cat_id_delete = $_GET['delete'];
         $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete} ";
         $delete_query = mysqli_query($connection, $query);
         if(!$delete_query){
             die("Fail to delete." . mysqli_error($connection));
         } else {
             header("Location: categories.php");
         }
     }
}
?>