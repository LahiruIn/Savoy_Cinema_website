<?php include('partials-front/menu.php'); ?>

    <!-- movie sEARCH Section Starts Here -->
    <section class="movie-search text-center">
        <div class="container">

        <?php

        //Get the search keybord
        //$search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>
            
            <h2>Movie on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- movie sEARCH Section Ends Here -->



    <!-- movie MEnu Section Starts Here -->
    <section class="Movie-menu">
        <div class="container">
            <h2 class="sub-text">MOVIES..</h2>


            <?php
            
            //SQL query to get movie based on search keybord
            $sql = "SELECT * FROM movie_table WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //check wheather food available of not
            if($count>0)
            {
                //movie available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $time = $row['time_tid'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    ?>

                    <div class="movie-menu-box">
                        <div class="movie-menu-img">

                        <?php
                        //check wheather image name is available or not
                        if($image_name=="")
                        {
                            //Image not Available
                            echo "<div class='error'> Image not Available.</div>";
                        }
                        else{
                            //Image Available
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
            else{
                //movie not available
                echo "<div class='error'>Movie Not Available.</div>";
            }
            ?> 


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Movie Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>