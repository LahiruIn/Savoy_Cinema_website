<?php include('partials/menu.php'); ?>

<?php

//check wheather id is set or not
if(isset($_GET['id']))
{
    //get all the details
    $id = $_GET['id'];

    //sql query to get the selected movie
    $sql2 = "SELECT * FROM movie_table WHERE id=$id";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual values of selectes movie
    $title = $row2['title'];
    $description = $row2['description'];
    $current_time = $row2['time_tid'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $active = $row2['active'];
}
else{
    //redirect to manage movie
    header('location:'.SITEURL.'admin/manage-movie.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE MOVIES</h1>

        <br><br>

        <form action=""method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?>

                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Time</td>
                <td>
                   <select name="time">

                   <?php
                   //Query to get Active time
                   $sql = "SELECT * FROM theater_time_table WHERE active='Yes'";
                   //Execute the query
                   $res = mysqli_query($conn, $sql);
                   //Count Rows
                   $count = mysqli_num_rows($res);

                   //Check wheather time available or not
                   if($count>0)
                   {
                    //time Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $category_time =$row['time'];
                        $category_theater =$row['theater'];

                        $time_tid = $row['id'];

                        //echo "<option value='$category_id'>$category_title</option>";
                        ?>
                        <option <?php if($current_time==$time_tid){echo "selected";}?> value = "<?php echo $category_time; ?> - <?php echo $category_theater; ?>"><?php echo $category_time; ?>- <?php echo $category_theater; ?></option>
                        <?php
                    }
                   }
                   else
                   {
                    //time not Available
                    echo "<option value='0'>Time Not Available.</option>";
                   }

                   ?>
                    
                   </select>
                </td>
            </tr>
            
            <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>
            <tr>
                <td>Curent Image </td>
                <td>
                    <?php 
                    if($current_image == "")
                    {
                        //Image not available
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else{
                        //Image Available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/movie/<?php echo $current_image; ?>" width="150px">;
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Select New Image </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                   <select name="category">

                   <?php
                   //Query to get Active category
                   $sql = "SELECT * FROM category_table WHERE active='Yes'";
                   //Execute the query
                   $res = mysqli_query($conn, $sql);
                   //Count Rows
                   $count = mysqli_num_rows($res);

                   //Check wheather category available or not
                   if($count>0)
                   {
                    //Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $category_title =$row['title'];
                        $category_id = $row['id'];

                        //echo "<option value='$category_id'>$category_title</option>";
                        ?>
                        <option <?php if($current_category==$category_id){echo "selected";}?> value = "<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                        <?php
                    }
                   }
                   else
                   {
                    //category not Available
                    echo "<option value='0'>Category Not Available.</option>";
                   }

                   ?>
                    
                   </select>
                </td>
            </tr>
            <tr>
                <td>Active</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary" >
                </td>
            </tr>
            
        </table>
        </form>

        <?php

        if(isset($_POST['submit']))
        {
            //echo"button Clicked"

            //1.Get all the details from the form
            $id =$_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $time = $_POST['time'];
            $price = $_POST['price'];
            $current_image = $_POST['curent_image'];
            $category = $_POST['category'];


            $active = $_POST['active'];

            //2.Uploard the image if selcted
            //Check wheather upload button clicked or not
            if(isset($_FILES['image']['name']))
            {
                //upload button clicked
                $image_name = $_FILES['image']['name'];// new image name
                //check weather the file is available or not
                if($image_name!="")
                {
                    //image is available
                    //A. Uploarding new image
                    //rename the image
                    $image_info = explode('.', $image_name);
                          $ext = end($image_info); //get the extension of the image

                    $image_name = "Movie-Name-".rand(000, 999).'.'.$ext;// this will be rename image

                    //get the source path or destination path
                    $src_path = $_FILES['image']['tmp_name']; //source path
                    $dest_path = "../images/movie/".$image_name; //destination path
  
                    //upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check wheather the image is uploaded or not
                    if($upload==false)
                    {
                        //failed to uploard
                        $_SESSION['upload'] = "<div class='error'>Failed to Uploard New Image. </div>";

                        //redirect to manage movie
                        header('location:'.SITEURL.'admin/manage-movie.php');

                        //stop the process
                        die();
                    }

                    //3.Remove the imagr if new image is uploarded and curent image exitsa
                    //B. Remove current image if available
                    if($current_image!="")
                    {
                        //Curent image is availabale
                        //remove the image
                        $remove_path = "../images/movie/".$current_image;

                        $remove = unlink($remove_path);

                        //check  wheather the image is removed or not
                        if($remove==false)
                        {
                            //failed to remove current image
                            $_SESSION['remove-failed'] = "<div class='error'>Faile to Remove Current Image.</div>";

                            //redirect to manage movie
                            header('location:'.SITEURL.'admin/manage-movie.php');

                            //stop process
                            die();
                        }
                    }

                }
                else
                {
                    $image_name= $current_image;//default image when image is not selected

                }
            }
            else{
                $image_name= $current_image;
            }

            

            //4. Update to manage movie with session message

            $sql3 = "UPDATE movie_table SET
            title = '$title',
            description = '$description',
            time_tid = '$time',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',

            active = '$active'
            WHERE id=$id
            ";

            //Execute the SQL query
            $res3 = mysqli_query($conn, $sql3);

            //check wheather the query is execute or not
            if($res3==true)
            {
                //Query execute and movie update
                $_SESSION['update'] = "<div class='success'>Movie Uploard Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-movie.php');
            }
            else{
                //failed movie update
                $_SESSION['update'] = "<div class='error'>Failed to Update Movie.</div>";
                header('location:'.SITEURL.'admin/manage-movie.php');
            }


            
        }
        ?>
   </div>
</div>




<?php include('partials/footer.php'); ?>