<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>
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
            if (isset($_GET['post_category_id'])) {
            $post_category_id = $_GET['post_category_id'];
            $query = "SELECT * FROM posts WHERE post_category_id=$post_category_id";
            $select_all_post_query = mysqli_query( $connection, $query );
            $post_category_wise_row = mysqli_num_rows($select_all_post_query);
            if ($post_category_wise_row == 0)    {
             echo "Sorry, we din't find any posts.";
            }  else { 
            while ( $post_fetch = mysqli_fetch_assoc( $select_all_post_query )) {
            $post_title = $post_fetch['post_title'];
            $post_author = $post_fetch['post_author'];
            $post_date = $post_fetch['post_date'];
            $post_image = $post_fetch['post_image'];
            $post_content = $post_fetch['post_content'];
            $post_tags = $post_fetch['post_tags'];
            $post_id = $post_fetch['post_id'];
             
            echo "<!-- First Blog Post -->
                <h2>
                    <a href='post.php?post_id=$post_id'> $post_title</a>
                </h2>
                <p class='lead'>
                    by <a href='post.php?author_posts=$post_author&post_author_id=$post_id'>$post_author</a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on  $post_date </p>
                <hr>
                <a href='post.php?post_id=$post_id'>
                <img class='img-responsive' height='200px' src='images/$post_image' alt=''>
                </a>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <a class='btn btn-primary' href='post.php?post_id=$post_id'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                <hr> 
                ";
                }
            }  
            }
?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>