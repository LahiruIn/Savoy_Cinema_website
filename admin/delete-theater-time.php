<?php

//include constants file
include('../config/constants.php');

//Echo "Delete Page"
//Check wheather the id and image_name value is set or not
if(isset($_GET['id']) )
{
    //Get the value and Delete
    //echo "Get value and delete";
    $id = $_GET['id'];
    
    //Delete data from database
    //SQL Query to delete data from databse
    $sql= "DELETE FROM theater_time_table WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check wheather the data is delete from database or not
    if($res==true)
    {
        //set success message and redirect 
        $_SESSION['delete'] = "<div class='success'> Theater and Time Deleted Successfully.</div>";
        //Redirect to manage time
        header('location:'.SITEURL.'admin/manage-theater-time.php');
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'> Failed to Delete Theater and Time.</div>";
        //Redirect to manage time
        header('location:'.SITEURL.'admin/manage-theater-time.php');
    }

}
else
{
    //redirect to manage time page
    header('location:'.SITEURL.'admin/manage-theater-time.php');
}


?>