<?php 
// ----------------------------------- CATEGORY FUNCTIONS -------------------------------


    // FUNCTION TO QUERY TO FETCH CAT ID AND CATEGORY TITLE

    function queryCategory() {
        global $connection;
        $select_category_query = "SELECT * FROM categories";    
        $select_category_query_execution = mysqli_query( $connection, $select_category_query);
        $cat_title_row = mysqli_fetch_assoc($select_category_query_execution);
        $cat_title = $cat_title_row['cat_title'];
        $cat_id = $cat_title_row['cat_id'];
        } 

    // ADD CATEGORY FUNCTION
    function addCategory () {
    global $connection;
    if (isset($_POST['add_cat_title'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title= "" || empty($cat_title)) {
        echo "<div class='alert alert-danger' role='alert'>
        Enter name of Category.</div> ";
        } else {        
       //  INSERT CATEGORY QUERY IN TABLE CATEGORIES
       $cat_title = $_POST['cat_title'];
        //   QUERY TO ADD CATEGORIES
       $add_category_query =  "INSERT INTO `categories` ( `cat_title`) VALUES ('$cat_title')";  
       $add_category_query_execution = mysqli_query( $connection, $add_category_query );
       if ($add_category_query_execution === TRUE) {
           echo "<div class='alert alert-success' role='alert'>
           New category added successfully.         
           </div> ";
            header('Location: admin_categories.php?Categories=View');
           } else {
           echo "Error: " . "<br>" . $connection->connect_error;
           }
           }          
        }      
        }

        // UPDATE CATEGORY FUNCTION
        function UpdateCategory() {
        global $connection;
        if (isset($_POST['update_cat_title'])) {
            $cat_id_update = $_POST['cat_id_update'];
            if ($cat_id_update= "" || empty($cat_id_update)) {
            echo "Enter name of Category";
            } else {  

        //   QUERY TO UPDATE CATEGORIES
        $cat_id_update = $_POST['cat_id_update'];
        $cat_id = $_POST['cat_id'];
        $add_category_query =  "UPDATE `categories` SET `cat_title` = '$cat_id_update' WHERE `categories`.`cat_id` = $cat_id";  
        $add_category_query_execution = mysqli_query( $connection, $add_category_query );
        if ($add_category_query_execution === TRUE) {
            echo "<div class='alert alert-success' role='alert'>
                  New record Updated successfully
                  </div> ";
        header('Location: admin_categories.php?Categories=View');
            } else {
            echo "Error: " . "<br>" . $connection->connect_error;
            }
            }  
            }  
            }

        // DELETE CATEGORY FUNCTION BY SELECT OPTION
                function deleteBySelect() {
                    global $connection;
                if (isset($_POST['delete_cat_title'])) {
                    $cat_id_delete = $_POST['cat_id_delete'];
                    $delete_category_query =  "DELETE FROM `categories` WHERE `cat_id` = $cat_id_delete";  
                    $delete_category_query_execution = mysqli_query( $connection, $delete_category_query );
                    if ($delete_category_query_execution === TRUE) {
                        echo "<div class='alert alert-info' role='alert'>
                        New record deleted successfully
                    </div> ";
                    } else {
                    echo "Error: " . "<br>" . $connection->connect_error;
                    }
                    } 
                }
          
            // DELETE CATEGORY FUNCTION BY CLICK ON LINK
            function deleteByClick() {
                global $connection;

                    if (isset($_GET['deleteCat'])) {
                            $cat_id_delete = $_GET['deleteCat'];
                            $delete_category_query =  "DELETE FROM `categories` WHERE `cat_id` = $cat_id_delete";  
                            $delete_category_query_execution = mysqli_query( $connection, $delete_category_query );
                            if ($delete_category_query_execution === TRUE) {
                                echo "<div class='alert alert-info' role='alert'>
                                New record deleted successfully
                            </div> ";
                            } else {
                            echo "Error: " . "<br>" . $connection->connect_error;
                            }
                            }     
                        } 

            // OPTION TO UPDATE CATEGORY BY ID
            function optionToUpdateById() {
            global $connection;
            $query = "SELECT * FROM categories WHERE cat_id";
                             $select_all_cat_query = mysqli_query( $connection, $query );       
                             while ( $cat_id_fetch = mysqli_fetch_assoc( $select_all_cat_query )) {
                                $cat_id =   $cat_id_fetch['cat_id'];   
                                echo "<option>{$cat_id}</option>";  
                            } 
                         } 

            // OPTION TO DELETE CATEGORY BY ID
            function optionToDeleteById() {
            global $connection;    
            $query = "SELECT * FROM categories WHERE cat_id";
            $select_all_cat_query = mysqli_query( $connection, $query );  
             
            while ( $cat_id_fetch = mysqli_fetch_assoc( $select_all_cat_query )) {
              
               $cat_id =   $cat_id_fetch['cat_id'];   
               echo "<option>{$cat_id}</option>";  
           } 
            }




// ----------------------------------- ADD POSTS FUNCTIONS -------------------------------

 // QUERY TO FETCH POST ID FROM CATEGORY NAME 
 $post_category_query = "SELECT * FROM categories WHERE cat_id='php'";    
 $post_category_query_execution = mysqli_query( $connection, $post_category_query);
 $cat_title_row = mysqli_fetch_assoc($post_category_query_execution);
 if(!$post_category_query_execution) {
 echo 'Not Able to get Category id by Category name';
 } 


















?>