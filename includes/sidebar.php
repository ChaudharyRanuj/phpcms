<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4> Blog Search </h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
        </div>
    <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                      $query = "SELECT * FROM categories";
                      $result = mysqli_query($connection, $query); 
                      if(! $result) {
                        echo "query to fetch category is failed";
                         } 
                    // $query = "SELECT * FROM posts WHERE ";
                    // $result = mysqli_query($connection, $query);   
                            while($row = mysqli_fetch_assoc($result)) {                     
                            $title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo  "<li><a href='post_category_wise.php?post_category_id={$cat_id}'>{$title}</a></li>";
                        } 
                     ?>    
                    
                </ul>
            </div>
            <!-- /.col-lg-12 -->
         
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus
            laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>

</div>
<!-- /.row -->

<hr>