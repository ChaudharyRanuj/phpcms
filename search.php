<?php include 'includes/header.php'; ?>
    <!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

<?php 
       
        ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class='page-header'>
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
            <?php 
            // Query for Selecting Posts headings
           
            if (isset($_POST["submit"])) {
                $search = $_POST["search"];
                $query_tag_search = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $select_all_post_query = mysqli_query( $connection, $query_tag_search);
                $row_post_query_search =  mysqli_num_rows( $select_all_post_query);
                if ($row_post_query_search == 0) {
                echo " <h3> Sorry We din't find anything, try to search differect tag </h3> "; 
                } 

                while ( $post_fetch = mysqli_fetch_assoc( $select_all_post_query )) {
                 
                    $post_title = $post_fetch['post_title'];
                    $post_author = $post_fetch['post_author'];
                    $post_date = $post_fetch['post_date'];
                    $post_image = $post_fetch['post_image'];
                    $post_content = $post_fetch['post_content'];
                    $post_tags = $post_fetch['post_tags']; 
                    echo "
                         <!-- First Blog Post -->
                        <h2>
                            <a href='#'> $post_title</a>
                        </h2>
                        <p class='lead'>
                            by <a href='index.php'>$post_author</a>
                        </p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on  $post_date </p>
                        <hr>
                        <img class='img-responsive' src='images/$post_image' alt=''>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                        <hr> 
                        ";}
                         } else {
                        $query = "SELECT * FROM posts";
                        $select_all_post_query = mysqli_query( $connection, $query );       
                        while ( $post_fetch = mysqli_fetch_assoc( $select_all_post_query )) {
                        $post_title = $post_fetch['post_title'];
                        $post_author = $post_fetch['post_author'];
                        $post_date = $post_fetch['post_date'];
                        $post_image = $post_fetch['post_image'];
                        $post_content = $post_fetch['post_content'];
                        $post_tags = $post_fetch['post_tags']; 
                        echo "
                             <!-- First Blog Post -->
                            <h2>
                                <a href='#'> $post_title</a>
                            </h2>
                            <p class='lead'>
                                by <a href='index.php'>$post_author</a>
                            </p>
                            <p><span class='glyphicon glyphicon-time'></span> Posted on  $post_date </p>
                            <hr>
                            <img class='img-responsive' src='images/$post_image' alt=''>
                            <hr>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                            <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                            <hr> 
                            ";}
          
                    }
         


          
?>
</div>


                

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        <!-- Footer -->
<?php include 'includes/footer.php'; ?>


