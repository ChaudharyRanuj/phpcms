<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8"> 
         <div class="col-md-6"  style="background-color:#CDE990; color: #125B50; padding:20px; border-radius: 10px;" >  
        <?php  
            if (isset($_POST['sign_up'])) {
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
            $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
            $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
            $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
            $user_confirm_password = mysqli_real_escape_string($connection, $_POST['user_confirm_password']);
            $user_status = "Subscriber"; 
            $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
            $age =  mysqli_real_escape_string($connection, $_POST['age']);  
            // QUERY TO CHECK IF USER IS ALREADY REGISTERED
            $check_registered_email = "SELECT * FROM users WHERE user_email='$user_email'" ;
            $check_email_query = mysqli_query( $connection, $check_registered_email );
            $check_email_query_row = mysqli_num_rows($check_email_query);
            if ($check_email_query_row>=1) {
            echo "<h5 style='color: #125B50;  padding:10px; font-size: 16px; font-weight: bold;' >Email Already Registered.</h5>";
             } else {
            //  INSERT CATEGORY QUERY IN TABLE CATEGORIES
            $add_user_query = "INSERT INTO `users` (`user_id`, `username`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_confirm_password`, `user_status`) VALUES (NULL, '$username', '$user_firstname', '$user_lastname', '$user_email', '$user_password', '$user_confirm_password', '$user_status')";  
            $add_user_query_execution = mysqli_query($connection, $add_user_query);
            if (!$add_user_query_execution) {
              echo "query failed";
                } 
                header("Location: login.php?regstration_complete");
                } 
              }
            ?>
       
   <form method="post" action="signup.php" > 
<h3>SIGN UP FORM</h3>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> First Name</label>
    <input type="text" name="user_firstname" class="form-control" id="exampleInputPassword1" required>
  </div>  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> Last Name</label>
    <input type="text" name="user_lastname" class="form-control" id="exampleInputPassword1" required>
  </div>  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputPassword1" required>
  </div>  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" name="user_confirm_password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1"  required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button style="background-color:#125B50; color: white; margin:10px; width: 100px; font-weight: bold;" type="submit" name="sign_up" class="btn btn-primary">Submit</button>
</form>  
</div> 
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>



<!----------------------------------------- ADMIN USER LOGIN ----------------------------------------------------->
<!----------------------------------------- SUBSCRIBER LOGIN ----------------------------------------------------->