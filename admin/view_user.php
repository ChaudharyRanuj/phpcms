<!-- form to add category -->
<div class="col-lg-12"                 >
          <!-- /.col-lg-12 -->
                  <div class="col-lg-12 mt ">
                   <table class="table table-bordered table-hover" style="font-size: 12.5px;">
                       <thead>
                              <tr>
                               <th scope="col">S.No.</th>
                               <th scope="col">User ID</th>
                               <th scope="col">Username</th>
                               <th scope="col">Firstname</th>
                               <th scope="col">Lastname</th>
                               <th scope="col">Email</th>
                               <th scope="col">Password</th>
                               <th scope="col">Confirm Password</th>
                               <th scope="col">User Status</th>
                               </tr>
                       </thead>
                       <tbody>
                        <tr>
                           <?php
                            $query_users = "SELECT * FROM users";
                            $select_all_users_query = mysqli_query($connection, $query_users);  
                            $SNO = 0;     
                            while ( $user_fetch = mysqli_fetch_assoc($select_all_users_query)) {
                            $SNO = $SNO + 1;
                            $user_id = $user_fetch['user_id'];
                            $username = $user_fetch['username'];
                            $user_firstname = $user_fetch['user_firstname'];
                            $user_lastname = $user_fetch['user_lastname'];;
                            $user_email = $user_fetch['user_email'];
                            $user_password = $user_fetch['user_password'];
                            $user_confirm_password = $user_fetch['user_confirm_password'];
                            $user_status = $user_fetch['user_status'];    
                             echo "
                               <th scope='row'>{$SNO}</th>
                               <td>{$user_id}</td>
                               <td>{$username }</td>
                               <td>{$user_firstname}</td>
                               <td>{$user_lastname}</td>
                               <td>{$user_email}</td>
                               <td>{$user_password}</td>
                               <td>{$user_confirm_password}</td>
                               <td>{$user_status}</td>
                               <td><a href='user.php?user&Admin=$user_id'>Admin</a></td>
                               <td><a href='user.php?user&Subscriber=$user_id'>Subscriber</a></td>
                               <td><a href='user.php?user&deleteUser=$user_id'>Delete</a></td>
                               <td><a href='user.php?user=Update&UpdateUser=$user_id'>Update</a></td>
                               </tr> ";
                            }
                            
                         //  QUERY TO UPDATE USER STATUS TO ADMIN WHERE USER ID
                           
                           if (isset($_GET['Admin'])) {
                             $user_id = $_GET['Admin'];
                             $user_category_query = "UPDATE `users` SET `user_status` = 'Admin' WHERE `users`.`user_id` = $user_id;";    
                             $user_category_query_execution = mysqli_query( $connection, $user_category_query);
                             if(!$user_category_query_execution) {
                             die('User cannot be changed check your code.'. msqli_error() );   
                             } 
                             header("Location: user.php?user");  
                           }
                          //  QUERY TO UPDATE USER STATUS TO SUBSCRIBER WHERE USER ID
                           if (isset($_GET['Subscriber'])) {
                            $user_id = $_GET['Subscriber'];
                            $user_category_query = "UPDATE `users` SET `user_status` = 'Subscriber' WHERE `users`.`user_id` = $user_id;";    
                             $user_category_query_execution = mysqli_query( $connection, $user_category_query);
                             if(!$user_category_query_execution) {
                             die('User cannot be changed check your code.'. msqli_error() );   
                             } 
                            header("Location: user.php?user");  
                           }

                           //  QUERY TO DELETE USER WHERE USER ID
                         if (isset($_GET['deleteUser']) ) {
                            $user_id = $_GET['deleteUser'];
                            $user_category_query = "DELETE FROM `users` WHERE `user_id` = $user_id";    
                            $user_category_query_execution = mysqli_query( $connection, $user_category_query);
                            if(!$user_category_query_execution) {
                            echo 'Not Able to delete user.';
                            }
                            header("Location: user.php?user");

                         }



                        ?>    
                        </tbody>
                   </table>
               </div>
           </div>
