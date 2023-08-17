<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>
<!-- Page Content -->
<div class="container">
 <?php
// QUERY TO CHECK LOGIN DETAILS AND START THE SESSION
if (isset($_POST['login'])) {
 $user_email_login =  $_POST['user_email'];
 $user_password_login = $_POST['user_password'];
 $user_email_login =  mysqli_real_escape_string( $connection, $user_email_login );
 $user_password_login = mysqli_real_escape_string( $connection, $user_password_login );
 
 $user_login_query = "SELECT * FROM users WHERE user_email='$user_email_login' AND user_password='$user_password_login' ";
 $user_login_query_fetch = mysqli_query($connection,  $user_login_query);
 $user_login_row = mysqli_fetch_assoc($user_login_query_fetch);

 $user_email =  $user_login_row['user_email'];
 $user_password =  $user_login_row['user_password'];
 $user_firstname =  $user_login_row['user_firstname'];
 $user_lastname =  $user_login_row['user_lastname'];
 $user_status =  $user_login_row['user_status'];

 // CHECK PASSWORD DETAILS FROM DATABASE
 if ( $user_email_login == $user_email &&  $user_password_login == $user_password) {

 $_SESSION['username'] = $user_email_login;
 $_SESSION['user_firstname'] = $user_firstname;
 $_SESSION['user_lastname'] = $user_lastname;
 $_SESSION['user_email_login'] = $user_email_login;

if ($user_status == 'Admin') {

$_SESSION['Admin'] = $user_status;
header( "Location: admin/" );

} else if ($user_status == 'Subscriber') {
$_SESSION['Subscriber'] = $user_status;
header( "Location: admin/" );
}

} else {

$login_failed = "Login failed. Username or Password don't match";
$_SESSION["failed"] = $login_failed ;

}
}

?>
    <div class="row">
        <!-- Blog Entries Column -->
        <?php
        if (isset($_GET['not_authorised'])) {
            echo "<div class='alert alert-danger' role='alert'>
            You are logout from admin login again.   
          </div>";
            }  
            ?>

        <div class="col-md-8">
            <?php   if (isset($_GET['regstration_complete'])) {
            echo "<div class='alert alert-success' role='alert'>;
              Registration successfull. Now you can login to your account.    
          </div> ";
            }  
         
      ?>
           <div class="col-md-6" style="background-color:#CDE990; color: #125B50; padding:20px; border-radius: 10px;">
                <div id="emailHelp">
                </div>
                <h3>SUBSCRIBER LOGIN</h3>
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <button
                        style="background-color:#125B50; color: white; margin:10px; width: 100px; font-weight: bold;"
                        type="submit" name="login" class="btn btn-info">Submit</button>
                </form>

                <div id="emailHelp">
                </div>
                <h3>ADMIN LOGIN</h3>
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <button
                        style="background-color:#125B50; color: white; margin:10px; width: 100px; font-weight: bold;"
                        type="submit" name="login" class="btn btn-info">Submit</button>
                </form>
            </div>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>