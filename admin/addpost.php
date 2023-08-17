<!-- form to add category -->
<div class="row">
    <div class="col-lg-12" style="margin-left: 20px">
        <h5>
    </div>
</div>
<div class="col-lg-12">

    </h5>
    <!-- /.col-lg-12 -->

    <div class="col-lg-12 mt ">
        <?php  
                     if (isset($_POST['create_post'])) {
                      $post_title = $_POST['post_title'];
                      $post_author = $_POST['post_author'];
                      $post_category = $_POST['post_category'];
                      $post_status = $_POST['post_status'];
                      $post_image = $_FILES['post_image']['name'];
                      $post_image_tep_location = $_FILES['post_image']['tmp_name'];
                      $post_image_size = $_FILES['post_image']['size'];
                      $post_content = $_POST['post_content'];
                      $post_tags = $_POST['post_tags'];
                      $post_date= $_POST['post_date']; 

                       // move_uploaded_file to ('../images')
                      move_uploaded_file( $post_image_tep_location, "../images/$post_image");
                     
                      // QUERY TO FETCH CATEGORY ID FROM CATEGORY NAME 
                      $select_category_query = "SELECT * FROM categories WHERE cat_title='$post_category'";    
                      $select_category_query_execution = mysqli_query( $connection, $select_category_query);
                      $cat_title_row = mysqli_fetch_assoc($select_category_query_execution);
                      if(!$select_category_query_execution) {
                      echo 'Not Able to get Category id by Category name';
                      }
                      $post_category_id = $cat_title_row['cat_id'];
                                       
                      //  INSERT POST QUERY IN TABLE POSTS
                      $add_post_query =  "INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ('$post_category_id','$post_title','$post_author','$post_date','$post_image','$post_content','$post_tags','$post_status')";  
                      $add_post_query_execution = mysqli_query( $connection, $add_post_query );
                      if ($add_post_query_execution === TRUE) {
                         echo "<div class='alert alert-success' role='alert'>
                         Post added successfully.
                         </div> ";
                         } else {
                         echo "Error: " . "<br>" . $connection->connect_error;
                         }
                         } 
                         ?>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleFormControlSelect1">Post Category</label>
                <select name="post_category" class="form-control" id="exampleFormControlSelect1">
                    <?php 
                                      $select_category_query = "SELECT * FROM categories";    
                                      $select_category_query_execution = mysqli_query( $connection, $select_category_query);
                                      while ($cat_title_row = mysqli_fetch_assoc($select_category_query_execution )) {
                                      $cat_title = $cat_title_row['cat_title'];
                                      $cat_id = $cat_title_row['cat_id'];
                                      echo"<option>$cat_title</option>";
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
            <div class="form-group">
                <label for="exampleFormControlInput1">Post Title</label>
                <input type="text" name="post_title" class="form-control" id="exampleFormControlInput1"
                    placeholder="Enter Post Title" required>
                <small id="emailHelp" class="form-text text-muted"> Date : <?php echo   date('d-m-Y');?>
                </small>

            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Post Author</label>
                <input type="text" name="post_author" class="form-control" id="exampleFormControlInput1"
                    placeholder="Enter Post Author" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Post Tags</label>
                <input type="text" name="post_tags" class="form-control" id="exampleFormControlInput1"
                    placeholder="Enter Post Tags" required>
            </div>
            <div class="form-group">
                <div class="col-lg-12" style="padding:0px;">
                    <label for="exampleFormControlInput1">Post Date</label>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <input type="date" name="post_date" class="form-control" id="exampleFormControlInput1"
                            placeholder="Enter Post Date" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Insert Post Image</label>
                <input type="file" name="post_image" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Post Content</label>
                <textarea id="editor" name='post_content' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            <input type="submit" name="create_post" class="form-control" id="exampleFormControlInput1"
                placeholder="Submit" required>
        </form>

    </div>
    <!-- /.col-lg-6 -->
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
