
            <!-- form to add category -->
            <div class="row">
  <div class="col-lg-12" style="margin-left: 20px">
  <h5 >
</div>
</div>
            <div class="col-lg-12">
            <?php 
            
            if (isset($_POST['add_user'])) {
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_confirm_password = $_POST['user_confirm_password'];
            $user_status = $_POST['user_status']; 

            // QUERY TO UPDATE VALUE OF USER BY USER ID 
            $update_user_query =  "UPDATE `users` SET `user_id`='$user_id',`username`='$username',`user_firstname`='$user_firstname',`user_lastname`='$user_firstname',`user_email`='$user_email',`user_password`='$user_password',`user_confirm_password`='$user_confirm_password',`user_status`='$user_status' WHERE user_id = '$user_id'";  
            $update_user_query_ftech = mysqli_query($connection,   $update_user_query ) ;    
            if (!$update_user_query_ftech) {
            die("Update User was not successfull" . mysqli_error());
            }  else {
            echo "Updation of User with User Id :" . $user_id  . " was successfull.";
            }  
            }  
            ?>


              
            </h5>
                <!-- /.col-lg-12 -->

                <div class="col-lg-12 mt">
                    <?php  
                    // QUERY TO UPDATE USER DETAILS BY USER ID IN USERS TABLE
                     if (isset($_POST['add_user'])) {
                        $username = $_POST['username'];
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];
                        $user_confirm_password = $_POST['user_confirm_password'];
                        $user_status = $_POST['user_status']; 
                            
                      //  INSERT CATEGORY QUERY IN TABLE CATEGORIES
                      $add_user_query = "INSERT INTO `users` (`user_id`, `username`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_confirm_password`, `user_status`) VALUES (NULL, '$username', '$user_firstname', '$user_lastname', '$user_email', '$user_password', '$user_confirm_password', '$user_status')";  
                      $add_user_query_execution = mysqli_query($connection, $add_user_query);
                      if (!$add_user_query_execution) {
                        echo "query failed";
                         } else {
                            echo "<div class='alert alert-success' role='alert'>
                            User added successfully.    
                          </div> ";
                        
                         }
                         } 
                         ?>

                    <form action="user.php?user=Update" method="post" >
                    <div class="form-group">
                            <label for="exampleFormControlSelect1">Update Post Id</label>
                            <select name="user_id" class="form-control" id="exampleFormControlSelect1" <?php if((isset($_GET['UpdateUser']))) {echo "readonly";}?>> 
                         
                         <?php if ( isset($_GET['UpdateUser']) )  {

                            // QYERT TO FETCH USER ID FROM VIEW POST

                             $update_user_id = $_GET['UpdateUser'];
                             echo "<option>$update_user_id</option>";
 
                                } else if ( !isset($_GET['UpdateUser']) ) {

                            // QUERY TO FETCH FROM USERS TABLE       

                                $user_id_query = "SELECT * FROM users";
                                $user_id_query_ftech = mysqli_query($connection, $user_id_query);
                                while ( $row = mysqli_fetch_assoc($user_id_query_ftech)) {
                                $user_id_pulled =  $row['user_id'];
                                echo "<option>$user_id_pulled </option>";
                                }; }
                        ?>
                          </select> 
                        </div>
                         <div class="form-group">
                            <label for="exampleFormControlSelect1">User Role</label>
                            <select name="user_status" class="form-control" id="exampleFormControlSelect1">
                                     <option>Admin</option>
                                    <option>Subscriber</option>
                          </select> 
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Username" required>
                           
                           </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Firstname</label>
                            <input type="text" name="user_firstname" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Lastname</label>
                            <input type="text" name="user_lastname" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="text" name="user_email" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Email" required>
                        </div>                      
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label>
                            <input type="text" name="user_password" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Password" required>
                        </div>  
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Confirm Password</label>
                            <input type="text" name="user_confirm_password" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Confirm Password" required>
                        </div>     
                        <input type="submit" name="add_user" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Submit" >
                    </form>
                </div>
                <!-- /.col-lg-6 -->
             