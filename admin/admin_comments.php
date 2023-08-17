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
                        View Comments
                    </h1>

                </div>
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->
            <!-- /#page-wrapper -->


            <!-- form to add category -->
            <div class="col-lg-12">

                <!-- /.col-lg-12 -->

                <div class="col-lg-12 mt ">
                    <table class="table table-bordered table-hover">
                        <thead>

                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date</th>
                                <th scope="col">User Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Approve</th>
                                <th scope="col">Unapprove</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                            $query_comment = "SELECT * FROM comments";
                            $select_all_comment_query = mysqli_query($connection, $query_comment);  
                            $SNO = 0;     
                            while ( $comment_fetch = mysqli_fetch_assoc($select_all_comment_query)) {
                            $SNO = $SNO + 1;
                            $comment_id = $comment_fetch['comment_id'];
                            $comment_title = $comment_fetch['comment_title'];
                            $comment_author = $comment_fetch['comment_author'];
                            $comment_email = $comment_fetch['comment_email'];
                            $comment_status = $comment_fetch['comment_status'];;
                            $comment_content = $comment_fetch['comment_content'];
                            $comment_date= $comment_fetch['comment_date']; 
                             echo "
                               <th scope='row'>{$SNO}</th>
                               <td>{$comment_id}</td>
                               <td>{$comment_title }</td>
                               <td>{$comment_author}</td>
                               <td>{$comment_email}</td>
                               <td>{$comment_date}</td>
                               <td>{$comment_content}</td>
                               <td>{$comment_status}</td>
                               <td><a href='admin_comments.php?Approve=$comment_id'>Approve</a></td>
                               <td><a href='admin_comments.php?Unapprove=$comment_id'>Unapprove</a></td>
                               <td><a href='admin_comments.php?deleteCat=$comment_id'>Delete</a></td>
                               </tr> "  ;
                            }
                            
                           //  QUERY TO DELETE comment FROM comment ID
                        
                         if (isset($_GET['deleteCat']) ) {
                            $comment_id = $_GET['deleteCat'];
                            $post_category_query = "DELETE FROM `comments` WHERE `comment_id` = $comment_id";    
                            $post_category_query_execution = mysqli_query( $connection, $post_category_query);
                            if(!$post_category_query_execution) {
                            echo 'Not Able to delete post.';
                            }
                            header("Location: admin_comments.php");
                             }

                         //  QUERY TO APPROVE comment FROM GET REQUEST
  
                           if (isset($_GET['Approve'])) {
                            $comment_id = $_GET['Approve'];
                              $comment_category_query = "UPDATE `comments` SET `comment_status` = 'Approved' WHERE `comments`.`comment_id` = $comment_id;";    
                             $comment_category_query_execution = mysqli_query( $connection, $comment_category_query);
                             if(!$comment_category_query_execution) {
                             die('query not successful'. msqli_error() );   
                             } 
                             header("Location: admin_comments.php");  
                           }

                         //  QUERY TO UNAPPROVE comment FROM GET REQUEST

                           if (isset($_GET['Unapprove'])) {
                            $comment_id = $_GET['Unapprove'];
                            $comment_category_query = "UPDATE `comments` SET `comment_status` = 'Unapproved' WHERE `comments`.`comment_id` = $comment_id;";    
                             $comment_category_query_execution = mysqli_query( $connection, $comment_category_query);
                             if(!$comment_category_query_execution) {
                             die('query not successful'. msqli_error() );   
                             } 
                            header("Location: admin_comments.php");  
                           }
                         ?>

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <!-- /#wrapper -->
        <?php include "includes/footer.php"; ?>