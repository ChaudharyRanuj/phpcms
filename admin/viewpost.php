            <!-- form to add category -->
            <div class="col-lg-12">
                <!-- /.col-lg-12 -->
                    <div class="col-lg-12 mt ">
  <!-- FETCH DETAILS FROM SELECT OPTION AND CHECKBOX BY POST METHOD-->
  <?php
                    if (isset($_POST['checkBoxesArray'])) {
                    foreach ($_POST['checkBoxesArray'] as $checkBoxesArray)  {
                    $select_option = $_POST['select_option'];
                    echo "post id is : ". $_POST['select_option'];

                    switch ($select_option) {

                    // QUERY TO UPDATE POST STATUS TO ACTIVE
                    case 'Active' :
                    $update_post_id = $checkBoxesArray;
                    echo "post status is : " .$select_option;
                    $update_post_category_query = "UPDATE `posts` SET `post_status`='$select_option' WHERE post_id = '$update_post_id'";    
                    $update_post_category_query_execution = mysqli_query( $connection,  $update_post_category_query);
                    if(!$update_post_category_query_execution) {
                    echo 'Not Able to update post.';
                    } else {
                        echo 'query to update post.';
                    }
                    header("Location: admin_post.php?post=View");
                    break; 

                    // QUERY TO UPDATE POST STATUS TO INACTIVE
                    case 'Inactive' :
                    echo "post status is : " .$select_option;
                    $update_post_id = $checkBoxesArray;
                    $select_option = $_POST['select_option'];
                    $update_post_category_query = "UPDATE `posts` SET `post_status`='$select_option' WHERE post_id = '$update_post_id'";    
                    $update_post_category_query_execution = mysqli_query( $connection,  $update_post_category_query);
                    if(!$update_post_category_query_execution) {
                    echo 'Not Able to update post.';
                    } 
                    header("Location: admin_post.php?post=View");
                    break; 

                    // QUERY TO DELETE POST BY POST ID
                    case 'Delete':
                    echo "post status is : " .$select_option;
                    $delete_post_id = $checkBoxesArray;
                    $post_category_query = "DELETE FROM `posts` WHERE `post_id` = $delete_post_id";    
                    $post_category_query_execution = mysqli_query( $connection, $post_category_query);
                    if(!$post_category_query_execution) {
                    echo 'Not Able to delete post.';
                    }
                    header("Location: admin_post.php?post=View");
                    break; 

                    // QUERY TO CLONE POST ROWS TO GET POSTS
                    case 'Clone':
                      
                    $insert_post_id = $checkBoxesArray; 
                    $query = "SELECT * FROM posts WHERE post_id = $insert_post_id";
                    $select_all_post_query = mysqli_query( $connection, $query );  
                    $post_fetch = mysqli_fetch_assoc( $select_all_post_query );
                    $post_id = $post_fetch['post_id'];
                    $post_title = $post_fetch['post_title'];
                    $post_author = $post_fetch['post_author'];
                    $post_category_id = $post_fetch['post_category_id'];
                    $post_status = $post_fetch['post_status'];
                    $post_image = $post_fetch['post_image'];
                    $post_tags = $post_fetch['post_tags'];
                    $post_date= $post_fetch['post_date']; 
                    $post_content= $post_fetch['post_content']; 

                    //  INSERT POST QUERY IN TABLE TO CLONE THE POSTS
                    $add_post_query =  "INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ('$post_category_id','$post_title','$post_author','$post_date','$post_image','$post_content','$post_tags','$post_status')";  
                    $add_post_query_execution = mysqli_query( $connection, $add_post_query );
                    if ($add_post_query_execution === TRUE) {
                        echo "<div class='alert alert-success' role='alert'>
                        Post added successfully.
                        </div> ";
                        } else {
                        echo "Error: " . "<br>" . $connection->connect_error;
                        }        
                    break; 
                    default:
                    echo "post status null" ;
                    break; 
                      }
                     }
                    }
                    ?>
                    <form action="admin_post.php?post=View" method='post'>
                  
                        <select name='select_option' style=" height : 35px; width: 250px;" name="" id="">
                            <option value="" Selected>Select Option</option>
                            <option value="Delete">Delete</option>
                            <option value="Active">Publish</option>
                            <option value="Inactive">Unpublish</option>
                            <option value="Clone">Clone</option>
                        </select>
                        <button type="submit" value="submit" name="apply" class="btn btn-primary">Apply</button>
                        <br>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="selectAllBoxes" id="selectAllBoxes">
                                    </th>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Comments Count</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Publish</th>
                                    <th scope="col">Unpublish</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                        // QUERYT TO SELECT POSTS TO GET POSTS TITLES
                         $query = "SELECT * FROM posts";
                         $select_all_post_query = mysqli_query( $connection, $query );  
                         $SNO = 0;     
                         while ( $post_fetch = mysqli_fetch_assoc( $select_all_post_query )) {
                         $SNO = $SNO + 1;
                         $post_id = $post_fetch['post_id'];
                         $post_title = $post_fetch['post_title'];
                         $post_author = $post_fetch['post_author'];
                         $post_category_id = $post_fetch['post_category_id'];
                         $post_status = $post_fetch['post_status'];
                         $post_image = $post_fetch['post_image'];
                         $post_tags = $post_fetch['post_tags'];
                         $post_date= $post_fetch['post_date']; 

                          // QUERY TO FETCH NO OF COMMENTS IN CMS DATABASE
                          $query_comment_postwise = "SELECT * FROM `comments` WHERE comment_post_id=$post_id;";
                          $query_comment_post = mysqli_query($connection, $query_comment_postwise);
                          if(!$query_comment_post ) {
                          die("QUERY TO NUMBER OF comment FAILED");
                          }
                          $no_of_comments_postwise = mysqli_num_rows($query_comment_post); 
                        
                          echo "
                            <th scope='row'><input type='checkbox' class='checkBoxes' name='checkBoxesArray[]' value='$post_id' ></th>
                                <th scope='row'>{$SNO}</th>
                                <td>{$post_id}</td>
                                <td>{$post_title }</td>
                                <td>{$post_author}</td>
                                <td>{$post_category_id}</td><td>";
                                 if ($post_status == "Active") {
                                    echo "<span class='badge alert-success'>$post_status</span>";
                                   } else if ($post_status == "Inactive") {
                                    echo "<span class='badge alert-danger'>$post_status</span>";
                                   }  
                            echo "</td><td><a href='../images/$post_image'><img height='30px' width='60px' src='../images/$post_image' alt='post image of '></a></td>
                                    <td>{$post_tags}</td>
                                    <td>{$no_of_comments_postwise}</td>
                                    <td>{$post_date}</td>
                                    <td><a href='admin_post.php?post=View&deleteCat=$post_id'>Delete</a></td>
                                    <td><a href='admin_post.php?updateCat=$post_id&post=Update&edit=Update'>Edit</a></td>
                                    <td><a href='admin_post.php?post=View&updatePost=Active&updatePostId=$post_id'>Publish</a></td>
                                    <td><a href='admin_post.php?post=View&updatePost=Inactive&updatePostId=$post_id'>Unpublish</a></td>
                                    </tr> " ;
                                    }
                        
                            //  QUERY TO DELETE POST FROM POST ID
                            if (isset($_GET['deleteCat']) ) {
                                $post_id = $_GET['deleteCat'];
                                $post_category_query = "DELETE FROM `posts` WHERE `post_id` = $post_id";    
                                $post_category_query_execution = mysqli_query( $connection, $post_category_query);
                                if(!$post_category_query_execution) {
                                echo 'Not Able to delete post.';
                                }
                                header("Location: admin_post.php?post=View");
                             }
                              
                            //  QUERY TO UPDATE POST FROM POST ID
                            if (isset($_GET['updatePost']) ) {
                                $get_post_status = $_GET['updatePost'];
                                $update_post_id = $_GET['updatePostId'];
                                $update_post_category_query = "UPDATE `posts` SET `post_status`='$get_post_status' WHERE post_id = '$update_post_id'";    
                                $update_post_category_query_execution = mysqli_query( $connection,  $update_post_category_query);
                                if(!$update_post_category_query_execution) {
                                echo 'Not Able to update post.';
                                }
                                header("Location: admin_post.php?post=View");
                              }
                              ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <!-- /.col-lg-6 -->
            
            <!-- SCRIPT TO SELECT AND UNSELECT THE CHECK BOXES -->
            <script>
            $('#selectAllBoxes').click(function(event) {
              if (this.checked) {
                $('.checkBoxes').each(function(event){
                 this.checked = true;   
                }) ;
              }  else {
                $('.checkBoxes').each(function(event){
                 this.checked = false;   
                }) ;
              }          
             });  
            </script>