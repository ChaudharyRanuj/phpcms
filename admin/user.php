<?php include "includes/header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <div class="container-fluid">
      <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                    <?php
                    if(isset($_GET['user'])) {
                    echo $_GET['user'] ." User"  ;  
                    }
                    ?>
              </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="user.php?user=View"> <i class="fa fa-file"></i>View Users</a>
                        </li>
                        <li class="active">
                            <a href="user.php?user=Add"> <i class="fa fa-file"></i>Add User</a>
                        </li>
                        <li class="active">
                            <a href="user.php?user=Update"> <i class="fa fa-file"></i>Update User</a>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /#page-wrapper -->

<?php

if(isset($_GET['user'])) {
$user = $_GET['user']; 
switch($user) {

 case 'Update':
 include 'update_user.php';
 break; 

case 'Add':
include 'add_user.php';
break; 

 default:
 include 'view_user.php';

}          

}
 ?>












           </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>