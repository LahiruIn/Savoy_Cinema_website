<?php include('partials-front/menu.php'); ?>

    <!-- movie sEARCH Section Starts Here -->
    <section class="movie-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>movie-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Movie.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- movie sEARCH Section Ends Here -->



    <!-- movie MEnu Section Starts Here -->
    <section class="movie-menu">
        <div class="container">
            <h2 class="sub-text">MOVIES..</h2>

            <?php
            //display movies that are active
            $sql = "SELECT * FROM movie_table WHERE active='Yes'";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count Rows
            $count = mysqli_num_rows($res);

            //Check wheather the movie are available or not
            if($count>0)
            {
                //movie Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $time = $row['time_tid'];
                    $description = $row['description'];
                    
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                    ?>

                    <div class="movie-menu-box">
                         <div class="movie-menu-img">

                        <?php
                        //Check weather image available or not
                        if($image_name=="")
                        {
                            //Image not Avaialable
                            echo "<div class='error'> Image not Available. </div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/movie/<?php echo  $image_name; ?>" alt="frozen" class="img-responsive img-curve">
                            <?php
                        }

                        ?>

                         </div>

                         <div class="movie-menu-desc">
                             <h4><?php echo $title; ?></h4>
                             <p class="movie-price"><?php echo $price; ?></p>
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

            }

            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- movie Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>