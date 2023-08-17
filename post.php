<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php 
            // Query for Selecting Posts headings
            if (isset($_GET['post_id'])) {
             $post_id =  $_GET['post_id'];  
            $query = "SELECT * FROM posts WHERE post_id='$post_id'";
            $select_all_post_query = mysqli_query( $connection, $query );  
            if(!$select_all_post_query) {
                echo 'Post query was unsuccessful.' ;
            }  else {
                echo 'Post query was Successful.' ;
            }    
            $post_fetch = mysqli_fetch_assoc($select_all_post_query);
            $post_title = $post_fetch['post_title'];
            $post_author = $post_fetch['post_author'];
            $post_date = $post_fetch['post_date'];
            $post_image = $post_fetch['post_image'];
            $post_content = $post_fetch['post_content'];
            $post_tags = $post_fetch['post_tags'];
            
            echo " 
            <!-- Blog Post -->
              <!-- Title -->
                <h1>$post_title</h1>
                <!-- Author -->
                <p class='lead'>
                by <a href='post.php?author_posts=$post_author&post_author_id=$post_id'>$post_author</a>
                </p>
                <hr>
                <!-- Date/Time -->
                <p><span class='glyphicon glyphicon-time'></span> Posted on $post_date</p>
                <hr>
                <!-- Preview Image -->
                <img class='img-responsive' src='images/$post_image' alt='$post_image'>
                <hr>
                <!-- Post Content -->
                <p class='lead'>$post_content</p>
                <p>$post_content</p>
                <hr>
                " ; }  
                
                // QUERY TO SHOW POST AUTHOR WISE
                if (isset($_GET['author_posts'])) {
                    $author_posts =  $_GET['author_posts'];  
                    echo "All Post by : " . $author_posts; 
                   $query_author_posts = "SELECT * FROM posts WHERE post_author LIKE '$author_posts'";
                   $select_all_author_posts_query = mysqli_query( $connection, $query_author_posts );  
                   if(!$select_all_author_posts_query) {
                    echo 'Post query by author was Failed.'; }  
                       
                   $post_fetch = mysqli_fetch_assoc($select_all_author_posts_query);
                   $post_title = $post_fetch['post_title'];
                   $post_author = $post_fetch['post_author'];
                   $post_date = $post_fetch['post_date'];
                   $post_image = $post_fetch['post_image'];
                   $post_content = $post_fetch['post_content'];
                   $post_tags = $post_fetch['post_tags']; 
                   echo " 
                   <!-- Blog Post -->
                     <!-- Title -->
                       <h1>$post_title</h1>
                       <!-- Author -->
                       <p class='lead'>
                       by $post_author
                       </p>
                       <hr>
                       <!-- Date/Time -->
                       <p><span class='glyphicon glyphicon-time'></span> Posted on $post_date</p>
                       <hr>
                       <!-- Preview Image -->
                       <img class='img-responsive' src='images/$post_image' alt='$post_image'>
                       <hr>
                       <!-- Post Content -->
                       <p class='lead'>$post_content</p>
                       <p>$post_content</p>
                       <hr>
                       " ; }  
                         ?>
            <!-- Blog Comments -->
            <?php 
                if (isset($_POST['submit'])) {
                $comment_post_id =  $_GET['post_id'];    
                $comment_title = $_POST['comment_title'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $comment_author = $_SESSION['user_firstname'];
                $comment_date = '17/08/2023';
                $comment_status = 'Unapproved';
                $query_insert_comment = "INSERT INTO comments (comment_post_id, comment_title, comment_email, comment_content, comment_author, comment_date, comment_status) VALUES ('$comment_post_id', '$comment_title', '$comment_email', '$comment_content','$comment_author', '$comment_date', '$comment_status')";    
                $query_comment_conn = mysqli_query($connection, $query_insert_comment);
                if (!$query_comment_conn) {
                   echo "QUERY FAILED: ";
                } else {
                    echo "comment was inserted successfully.";
                }
                }
               

            if ( isset($_SESSION['Subscriber']) || isset($_SESSION['Admin']) )  {
                if (isset($_GET['post_id'])) {
                    $comment_post_id =  $_GET['post_id']; 
                } else if (isset($_GET['post_author_id'])) {
                    $comment_post_id =  $_GET['post_author_id']; 
                }
                 
             echo "<!-- Comments Form -->
             <div class='well'>
                 <h4>Leave a Comment:</h4>
                 <form role='form' action='post.php?post_id=$comment_post_id'  method='post'>
                     <label for='exampleFormControlInput1'>Comment Title</label>
                     <input type='text' name='comment_title' class='form-control' id='exampleFormControlInput1'
                         placeholder='Enter Comment Title' required>
                     <label for='exampleFormControlInput1'>Email </label>
                     <input type='email' name='comment_email' class='form-control' id='exampleFormControlInput1'
                         placeholder='Enter Your Email' required>
                     <label for='exampleFormControlInput1'>Your Comment</label>
                     <div class='form-group'>
                         <textarea name='comment_content' class='form-control' rows='3' required></textarea>
                     </div>
                     <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                 </form>
             </div>
             <hr>";   
            }  else {
              echo "Your are not authorise to add post.";  
            } 
           
           ?>
            <!-- Posted Comments -->
            <?php 
                  if (isset($_GET['post_id'])) {
                  $comment_post_id =  $_GET['post_id']; 
                  $select_comment_query = "SELECT * FROM `comments` WHERE comment_status='Approved' AND comment_post_id=$comment_post_id ORDER BY comment_date DESC";    
                  $select_comment_query_execution = mysqli_query( $connection, $select_comment_query);
                  $row_comment_query_search =  mysqli_num_rows( $select_comment_query_execution);
                  if (!$select_comment_query_execution) {
                    echo "query failed" . mysqli_error();
                     }
                  if ($row_comment_query_search == 0) {
                        echo "<h3>Sorry We din't find any comment.</h3> "; 
                        }  else {
                  while ($comment_fetch = mysqli_fetch_assoc($select_comment_query_execution)) {
                  $comment_title = $comment_fetch['comment_title'];
                  $comment_date = $comment_fetch['comment_date'];
                  $comment_content = $comment_fetch['comment_content'];
                  $comment_author = $comment_fetch['comment_author'];

                  echo " <!-- Comment -->
                  <div class='media'>
                      <a class='pull-left' href='#'>
                          <img class='media-object' src='http://placehold.it/64x64' alt=''>
                      </a>
                      <div class='media-body'>
                          <h4 class='media-heading'>$comment_title
                          <small> by - $comment_author</small> <small> $comment_date</small>
                          </h4>                          
                          $comment_content
                      </div>
                  </div> ";
                        }
                     }  
                    } else if (isset($_GET['post_author_id']))  {
                        $comment_author_post_id =  $_GET['post_author_id']; 
                        $select_comment_query = "SELECT * FROM `comments` WHERE comment_status='Approved' AND comment_post_id= $comment_author_post_id ORDER BY comment_date DESC";    
                        $select_comment_query_author_posts = mysqli_query( $connection, $select_comment_query);
                        $row_comment_query_search =  mysqli_num_rows($select_comment_query_author_posts);
                        if (!$select_comment_query_author_posts) {
                          echo "query failed" . mysqli_error();
                           }
                        if ($row_comment_query_search == 0) {
                              echo "<h3>Sorry We din't find any comment.</h3> "; 
                              }  else {
                        while ($comment_fetch = mysqli_fetch_assoc($select_comment_query_author_posts)) {
                        $comment_title = $comment_fetch['comment_title'];
                        $comment_date = $comment_fetch['comment_date'];
                        $comment_content = $comment_fetch['comment_content'];
                        $comment_author = $comment_fetch['comment_author'];
      
                        echo " <!-- Comment -->
                        <div class='media'>
                            <a class='pull-left' href='#'>
                                <img class='media-object' src='http://placehold.it/64x64' alt=''>
                            </a>
                            <div class='media-body'>
                                <h4 class='media-heading'>$comment_title
                                <small> by - $comment_author</small> <small> $comment_date</small>
                                </h4>                          
                                $comment_content
                            </div>
                        </div> ";
                              }
                           }    






                    }    







                  ?>
                </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>