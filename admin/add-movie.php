<?php 
// Include your menu and database connection files
include('partials/menu.php');
?>

<!-- HTML Form for adding food -->
<div class="main-content">
    <div class="wrapper">
        <h1>ADD MOVIES</h1>
        <br><br>

        <?php

// Check if session variables are set for displaying messages
if(isset($_SESSION['upload'])) {
    echo $_SESSION['upload']; // Display upload message if set
    unset($_SESSION['upload']); // Remove upload message from session
}

if(isset($_SESSION['add'])) {
    echo $_SESSION['add']; // Display add message if set
    unset($_SESSION['add']); // Remove add message from session
}

?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Movie Title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Movie Description"></textarea></td>
                </tr>
                <tr>
    <td>Time:</td>
    <td>
        <select name="time">
            <?php 
            // Create PHP code to display times from the database
            $sql = "SELECT * FROM theater_time_table WHERE active='Yes'";
            // Executing query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether we have times or not 
            
            $count = mysqli_num_rows($res);

            // If count is greater than zero, we have times, else we don't have times
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the details of times
                    $id = $row['id'];
                    $time = $row['time'];
                    $theater = $row['theater'];
                    
                    ?>
                    <option value="<?php echo $time . ' - ' . $theater; ?>"><?php echo $time . ' - ' . $theater; ?></option>
                    <?php
                }
            } 
            else 
            {
                // We do not have times
                ?>
                <option value="0">No Time Found</option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                            //Create PHP code to display category from databse
                            $sql = "SELECT * FROM category_table WHERE active='Yes'";
                            //executing query
                            $res = mysqli_query($conn, $sql);
                            //Count row to check wheather we have categorys or not 
                            
                            $count = mysqli_num_rows($res);

                            //if count is greaterthan zero, we havr categorys else we dont have categories
                            if($count> 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>";
                                    <?php
                                }
                            } 
                            else 
                            {
                                //We do not have category
                                ?>
                                <option value="0">No Category Found</option>
                               <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Movie" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Handle form submission for adding movie
        if(isset($_POST['submit'])) 
        {
            // Get the data from  form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $time = $_POST['time'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            //Check wheather radio button from featured and active are checked or not

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else{
                $active = "No"; //Setting Default Vlue
            }

            //2. Upload the image if selected

            //check wheather the select image is clicked or not and uploard the image only if the image selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of selected images
                $image_name = $_FILES['image']['name'];

                //Check wheather the image is selected or not uplord image only if selected
                if($image_name!="")
                {
                    //Image is selected
                    //A.rename imsgr
                    //get the extension of selected image(jpg,jpx)
                    $ext = end(explode('.',$image_name));

                    //create new name for image
                    $image_name = "Movie-Name-".rand(000,999).".".$ext;//New image name may be


                    //B.Uplord Image
                    //get the src path and desyination path
                    //Source path is the current location of the image 
                    $src=$_FILES['image']['tmp_name'];

                    //destination path for the image uplord
                    $dst = "../images/movie/".$image_name;

                    //Finally uploard movie image
                    $upload = move_uploaded_file($src, $dst);

                    //check wheather image uploard of not
                    if($upload==false)
                    {
                        //Failed to uploard the image
                        //Redirect to add movie withe error message
                        $_SESSION['$upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        header('location:'.SITEURL.'admin/add-movie.php');
                        //stop the process
                        die();
                    }
                }
            }
            else{
                $image_name = ""; // Setting default value as blank
            }

            //3. Insert into database

            //Create a sql querry to save  or add food
            //for numeric.............
            $sql2 = "INSERT INTO movie_table SET
            title = '$title',
            description = '$description',

            time_tid = '$time',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',

            active = '$active'
            
            ";
            
            //Execute the qurey
            $res2 = mysqli_query($conn,$sql2);

            //4.Redirect with Message to manage movie data
            //check wheather data inserted or not 

            if($res2 == true)
            {
                //Data inserted Successfully
                $_SESSION['add'] = "<div class='success'>Movie Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-movie.php');
            }
            else{
                //Failed to inser Data
                $_SESSION['add'] = "<div class='success'>Failed to Add Movie.</div>";
                header('location:'.SITEURL.'admin/manage-movie.php');
            }

            
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
