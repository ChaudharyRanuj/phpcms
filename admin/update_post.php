
            <!-- form to add category -->
            <div class="row">
  <div class="col-lg-12" style="margin-left: 20px">
  <h5 >
</div>
</div>
            <div class="col-lg-12">
              
            </h5>
                <!-- /.col-lg-12 -->

                <div class="col-lg-12 mt ">
                    <?php  
                     if (isset($_POST['update_post'])) {
                      $post_id = $_POST['post_id'];  
                      $post_title = $_POST['post_title'];
                      $post_author = $_POST['post_author'];
                      $post_status = $_POST['post_status'];
                      $post_image = $_FILES['post_image']['name'];
                      $post_image_tep_location = $_FILES['post_image']['tmp_name'];
                      $post_image_size = $_FILES['post_image']['size'];
                      $post_content = $_POST['post_content'];
                      $post_tags = $_POST['post_tags'];
                      $post_date= $_POST['post_date']; 

                       // move_uploaded_file to ('../images')
                      move_uploaded_file( $post_image_tep_location, "../images/$post_image");
                                                           
                      //  INSERT CATEGORY QUERY IN TABLE CATEGORIES
                      $add_post_query =  "UPDATE `posts` SET `post_title`='$post_title',
                      `post_author`='$post_author',`post_date`='$post_date',`post_image`='$post_image',`post_content`='$post_content',`post_tags`='$post_tags',
                      `post_status`='$post_status' WHERE post_id = '$post_id'";  
                      $add_post_query_execution = mysqli_query( $connection, $add_post_query );
                      if ($add_post_query_execution === TRUE) {
                         echo "<div class='alert alert-success' role='alert'>
                         Post updated successfully.
                       </div> ";
                         } else {
                         echo "Error: " . "<br>" . $connection->connect_error;
                         }
                         } 
                         ?>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">    
                            <label for="exampleFormControlSelect1">Post Id</label>
                            <select name="post_id" id="post_id" class="form-control" id="exampleFormControlSelect1">
                                <?php 
                                      if (isset($_GET['updateCat']))   {

                                        $posts_id = $_GET['updateCat'];
                                        echo "<option>$posts_id</option>";
                                      } else if (isset($_GET['update'])) {

                                      $select_posts_query = "SELECT * FROM posts WHERE post_id";    
                                      $select_posts_query_execution = mysqli_query( $connection, $select_posts_query);
                                      while ($posts_id_row = mysqli_fetch_assoc($select_posts_query_execution)) {
                                      $posts_id = $posts_id_row['post_id'];
                                      echo"<option value='$posts_id' id='postid$posts_id' >$posts_id</option>";
                                      }   
                                    }
                                   ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Post Status</label>
                            <select name="post_status" class="form-control" id="exampleFormControlSelect1">
                            <option>Active</option>                             
                            <option>Inactive</option>                                   
                            </select>
                        </div>
                        <!-- QUERY TO PULL OUT THE DATA INTO FORM WITH GET POST updateCat -->
                        <?php 
                          $post_id_update = $_GET['updateCat'];
                          $select_posts_query_update = "SELECT * FROM posts WHERE post_id = $post_id_update";    
                          $select_posts_query_update_execution = mysqli_query( $connection, $select_posts_query_update );
                          $post_id_update_row = mysqli_fetch_assoc($select_posts_query_update_execution);
                          if (!$select_posts_query_update_execution ){
                            echo "Update Form Data Cannot Not be filled";
                          } 
                          $post_title_update_post = $post_id_update_row['post_title'];
                          $post_author_update_post = $post_id_update_row['post_author'];
                          $post_category_id_update_post = $post_id_update_row['post_category_id'];
                          $post_image_update_post = $post_id_update_row['post_image'];
                          $post_tags_update_post = $post_id_update_row['post_tags'];
                          $post_date_update_post = $post_id_update_row['post_date']; 
                          $post_content_update_post = $post_id_update_row['post_content']; 
                        ?>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Post Title</label>
                            <input type="text" name="post_title" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Post Title" value="<?php echo $post_title_update_post ;?>" required>
                                <small id="emailHelp" class="form-text text-muted"> Date : <?php echo   date('d-m-Y');?>
                                </small>
   
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Post Author</label>
                            <input type="text" name="post_author" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Post Author" value="<?php echo $post_author_update_post ;?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Post Tags</label>
                            <input type="text" name="post_tags" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Post Tags" value="<?php echo $post_tags_update_post ;?>" required>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12" style="padding:0px;">
                                <label for="exampleFormControlInput1">Post Date</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="date" name="post_date" class="form-control"
                                        id="exampleFormControlInput1" value="<?php echo $post_date_update_post;?>" required>
                                </div>
                            </div>
                        </div>
                       <div class="form-group">
                            <label for="exampleFormControlFile1">Old Image</label> <br>
                            <a href='../images/<?php echo $post_image_update_post?>'><img height='30px' width='60px' src='../images/<?php echo $post_image_update_post?>' alt='post image of '></a><br>
                            <label for="exampleFormControlFile1">Insert New Image</label> 
                            <input type="file" name="post_image" class="form-control-file" id="exampleFormControlFile1" required>
                        </div> 
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Post Content</label>
                            <textarea id="editor" name='post_content'  class="form-control" id="exampleFormControlTextarea1" rows="3"   required> <?php echo $post_content_update_post;?> </textarea>
                        </div>
                        <input type="submit" name="update_post" class="form-control"
                                        id="exampleFormControlInput1" value="Update" >
                    </form>
                </div>
                  <!-- CK TEXT EDITOR SCRIPT -->
             <script src="includes/editor/ckeditor.js"></script>
         <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );
        </script>
                <!-- /.col-lg-6 -->
             