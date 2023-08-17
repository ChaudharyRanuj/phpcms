<?php include "includes/header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
  
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome, <?php 
                        if (isset($_SESSION['username']))  {
                        $login_email = $_SESSION['username'];
                        $query_post_login_email = "SELECT * FROM `users` WHERE user_email LIKE '$login_email'";
                        $query_post_email = mysqli_query($connection, $query_post_login_email);
                        $post_email_assoc = mysqli_fetch_assoc($query_post_email);
                        
                        if(!$query_post_email) {
                        die('QUERY TO NUMBER OF POST FAILED' . mysqli_error());
                         }
                        $firstusername = $post_email_assoc['user_firstname'];
                        $lastusername = $post_email_assoc['user_lastname'];
                        echo "$firstusername $lastusername";
                         }
                        ?>
                    </h1>
                    <h4>
                        <?php 
                                                
                            if ( isset($_SESSION['Admin']) ) {
                            echo "You are Login as: " . $_SESSION['Admin'];    
                            } else if (isset($_SESSION['Subscriber'])) {
                                echo "You are Login as: " . $_SESSION['Subscriber']; 
                            }

                            // QUERY TO FETCH NO OF POSTS IN CMS DATABASE
                            $query_post_number = "SELECT * FROM `posts` WHERE post_id;";
                            $query_post = mysqli_query($connection, $query_post_number);
                            if(!$query_post) {
                            die("QUERY TO NUMBER OF POST FAILED");
                            }
                            $no_of_posts = mysqli_num_rows($query_post); 

                            // QUERY TO FETCH NO OF COMMENTS IN CMS DATABASE
                            $query_comment_number = "SELECT * FROM `comments` WHERE comment_id;";
                            $query_comment = mysqli_query($connection, $query_comment_number);
                            if(!$query_comment) {
                            die("QUERY TO NUMBER OF comment FAILED");
                            }
                            $no_of_comments = mysqli_num_rows($query_comment); 

                            // QUERY TO FETCH NO OF USERS IN CMS DATABASE
                            $query_user_number = "SELECT * FROM `users` WHERE user_id;";
                            $query_user = mysqli_query($connection, $query_user_number);
                            if(!$query_user) {
                            die("QUERY TO NUMBER OF USERS FAILED");
                            }
                            $no_of_users = mysqli_num_rows($query_user); 

                            // QUERY TO FETCH NO OF CATEGORIES IN CMS DATABASE
                            $query_category_number = "SELECT * FROM `categories` WHERE cat_id;";
                            $query_category = mysqli_query($connection, $query_category_number);
                            if(!$query_category) {
                            die("QUERY TO NUMBER OF category FAILED");
                            }
                            $no_of_categories = mysqli_num_rows($query_category); 
                            ?>
                    </h4>
                    <!-- PANNEL TO SHOW NO OF POSTS, COMMENTS, USERS, CATEGORIES -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'> <?php echo  $no_of_posts;?> </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_post.php?post=View">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo  $no_of_comments;?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo  $no_of_users;?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="user.php?user=View">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo  $no_of_categories;?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / PANNEL TO SHOW NO OF POSTS, COMMENTS, USERS, CATEGORIES -->

            <!-- COLUMN CHART DIV -->
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
 <!-- SCRIPT OF GOOGLE COLUMN CHART IN DASHBOARD -->
 <script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Title', 'Count'],
      <?php
            $column_title = ['Posts', 'Comments', 'Users', 'Categories'];
            $title_count = [$no_of_posts, $no_of_comments, $no_of_users, $no_of_categories];
            for ($i=0; $i<4; $i++) {
            echo "['{$column_title[$i]}'" . "," . "'{$title_count[$i]}'],";
             }
        ?>
        ]);
            var options = {
            chart: {
                title: '',
                subtitle: '',
                }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script> 

<!---------------------------------------- FOOTER ------------------------------------------>-
<?php include "includes/footer.php"; ?>