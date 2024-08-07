<?php include('partials-front/menu.php'); ?>

<?php

// Check whether id is passed or not
if(isset($_GET['category_id']))
{
    // Category id is set and get the id
    $category_id = $_GET['category_id'];

    // Get the category title based on category id
    $sql = "SELECT title FROM category_table WHERE id=$category_id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Get the value from database
    $row = mysqli_fetch_assoc($res);

    // Get the title
    $category_title = $row['title'];
}
else
{
    // Category not passed
    // Redirect to home page
    header('location:'.SITEURL);
}

?>

<!-- Movie Search Section Starts Here -->
<section class="movie-search text-center">
    <div class="container">
        <h2>Movies on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<!-- Movie Search Section Ends Here -->

<!-- Movie Menu Section Starts Here -->
<section class="movie-menu">
    <div class="container">
        <h2 class="sub-text">Movies</h2>

        <?php 

        // Create SQL query to get movie based on selected category
        $sql2 = "SELECT * FROM movie_table WHERE category_id=$category_id";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Count the rows
        $count2 = mysqli_num_rows($res2);

        // Check whether movie is available or not
        if($count2 > 0)
        {
            // Movie is available
            while($row2 = mysqli_fetch_assoc($res2))
            {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $time = $row2['time_tid'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];

                ?>

                <div class="movie-menu-box">
                    <div class="movie-menu-img">
                        <?php
                        if($image_name == "")
                        {
                            // Image not available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            // Image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/movie/<?php echo $image_name; ?>" alt="frozen" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="movie-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="movie-price">$<?php echo $price; ?></p>
                        <p class="movie-time"><?php echo $time; ?></p>

                        <p class="movie-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>booking.php?movie_id=<?php echo $id ;?>" class="btn btn-primary">Book Now</a>
                    </div>
                </div>

                <?php
            }
        }
        else
        {
            // Movie not available
            echo "<div class='error'>Movie Not Available.</div>";
        }

        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- Movie Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
