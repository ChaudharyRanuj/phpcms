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
                    if(isset($_GET['post'])) {
                    echo $_GET['post'] ." Posts"  ;  
                    }
                    ?>
              </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="admin_post.php?post=View"> <i class="fa fa-file"></i>View Posts</a>
                        </li>
                        <li class="active">
                            <a href="admin_post.php?post=Add"> <i class="fa fa-file"></i>Add Posts</a>
                        </li>
                    
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->
            <!-- /#page-wrapper -->
            <?php

            if(isset($_GET['post'])) {
            $post = $_GET['post']; 
            switch($post) {
             case'Add':
             include 'addpost.php';
             break; 

             case 'Update':
             include 'update_post.php';
             break; 
             
             default:
             include 'viewpost.php';

            }          

            }
             ?>
    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>