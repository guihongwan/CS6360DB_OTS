<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
       
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <?php include "includes/admin_page_heading.php"; ?>
                
                <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = "";
                        }
                        
                        switch($source){
                            case 'add_client';
                                //include "includes/add_client.php";
                                break;
                            case 'edit_client';
                                //include "includes/edit_client.php";
                                break;
                            default:
                                include "includes/view_all_clients.php";
                                break;
                            
                        }
                ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>
 
