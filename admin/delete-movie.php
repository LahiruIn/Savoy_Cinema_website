<?php 
// Including constant file
include('../config/constants.php');

// Ensure session is started
session_start();

// Check if 'id' and 'image_name' are set
if(isset($_GET['id']) && isset($_GET['image_name'])) 
{
    // Process to delete
    echo "Process to Delete";

    // 1. Get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove the image if available
    if($image_name != "")
    {
        // Image is available and needs to be removed from the folder
        $path = "../images/movie/" . $image_name;

        // Remove image file from the folder
        if(file_exists($path))
        {
            $remove = unlink($path);

            // Check whether the image is removed or not
            if($remove == false)
            {
                // Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                header('location:'.SITEURL.'admin/manage-movie.php');
                exit(); // Stop the process
            }
        }
    }

    // 3. Delete movie from the database
    $sql = "DELETE FROM movie_table WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed or not and set the session message accordingly
    if($res == true)
    {
        // Movie deleted
        $_SESSION['delete'] = "<div class='success'>Movie Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-movie.php');
    }
    else
    {
        // Failed to delete movie
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Movie.</div>";
        header('location:'.SITEURL.'admin/manage-movie.php');
    }
    exit(); // Stop the process after redirection
}
else
{
    // Unauthorized access
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-movie.php');
    exit(); // Stop the process after redirection
}
?>
