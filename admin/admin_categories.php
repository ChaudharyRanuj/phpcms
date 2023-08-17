<?php include "includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                    </h1>
                    <ol class="breadcrumb">
                            <li class="active">
                            <a href="admin_categories.php?Categories=View"> <i class="fa fa-file"></i>View Categories</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->
            <div class="col-lg-6 mt "> 
            <form class="form-select" action="admin_categories.php" method="post" aria-label=".form-select-lg example">
            <label for="exampleFormControlInput1" class="form-label">Select Options</label>
            <select  name="deleteCategory"    style=" width: 100%; height: 30px;" class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="Delete" >Delete</option>
             </select> <br><br>
            <button type="submit" value="Submit"  name="deleteCategory" class="btn btn-primary">Delete</button>

            <br><br>
            </select>
                   <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><input id="selectAllBoxes" type="checkbox" name="checkboxArray[]" value=""></th>
                            <th scope="col">S.No.</th>
                            <th scope="col">Category ID</th>
                            <th scope="col">Category Title</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $select_category_query = "SELECT * FROM categories";    
                    $select_category_query_execution = mysqli_query( $connection, $select_category_query);
                    // VARIABLE FOR NUMBER OF CATEGORIES
                    $SNO = 0;
                    while ($cat_title_row = $blog_category = mysqli_fetch_assoc($select_category_query_execution )) {
                        $SNO = $SNO + 1;  
                        $cat_title = $cat_title_row['cat_title'];
                        $cat_id = $cat_title_row['cat_id'];
                    echo    "<tr>
                            <th><input  class='checkBoxes'  type='checkbox' name='checkboxArray[]' value='$cat_id'></th>
                            <th scope='row'>{$SNO}</th>
                            <td>{$cat_id}</td>
                            <td>{$cat_title}</td>
                            </tr>";
                            }
                    ?>
                </tbody>
                </table>
                </form>
            </div>

           <!-- form to add category -->
            <div class="col-lg-4">
                <?php   
                    //  ADD CATEGORY 
                    addCategory ();

                    //  UPDATE CATEGORY 
                    UpdateCategory (); 
 
                 //  DELETE CATEGORY BY SELECT OPTION
                     deleteBySelect();
                    
                    //  DELETE CATEGORY BY CLICK ON LINK
                    deleteByClick();        
                 ?>

                <form action="admin_categories.php" method="post">
                    <div class="form-group">
                        <!-- ADD CATEGORY -->
                        <label for="exampleInputEmail1">Add Category</label>
                        <input type="text" name="cat_title" class="form-control" id="add_categories"
                            aria-describedby="emailHelp" placeholder="Add Category">
                        <small id="emailHelp" class="form-text text-muted">Message that category is added</small>
                    </div>
                    <input type="submit" name="add_cat_title" value="Add" />
                    <!-- UPDATE CATEGORY -->
                    <div class="form-group mt">
                        <label for="exampleInputEmail1">Update By Category Id</label>
                        <input type="text" name="cat_id_update" class="form-control" id="add_categories"
                            aria-describedby="emailHelp" placeholder="Add Category">
                           <select class="form-control" name="cat_id" id="exampleFormControlSelect1">
                            <!-- FETCHING CATEGORY ID TO UPDATE THE CATEGORY -->
                            <?php optionToUpdateById(); ?>
                        </select>
                        <small id="emailHelp" class="form-text text-muted">Message that category is updated</small>
                    </div>
                    <input type="submit" name="update_cat_title" value="Update" />
                    <!-- DELETE CATEGORY -->
                    <div class="form-group mt">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Delete By Category Id</label>
                            <select class="form-control" name="cat_id_delete" id="exampleFormControlSelect1">
                                <!-- FETCHING CATEGORY ID TO DELETE THE CATEGORY -->
                                <?php optionToDeleteById();?>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">Message that category is deleted.</small>
                        </div>
                        <input type="submit" name="delete_cat_title" value="Delete" />
                    </div>
                </form>

            </div>
            <!-- /.col-lg-12 -->           
        </div>
        <!-- /.col-lg-6 -->
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<!-- SCRIPT TO SELECT ALL CHECK BOXES -->

<script>

    $(document).ready(function() {
        $("h1").css("color","red");  
    });
      


     </script>   

<?php include "includes/footer.php"; ?>