<?php include('partials-front/menu.php'); ?>

    <!-- movie sEARCH Section Starts Here -->
    <section class="movie-search text-center">
        <h1 class="banner-topic">SAVOY</h1>
        <h6 class="banner-sub-topic">| CINAMA |</h6>
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>movie-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Movie.." required>
                <input type="submit" name="submit" value="Search" class="btn-search">
            </form>

        </div>
    </section>
    <!-- Movie sEARCH Section Ends Here -->

    <?php


    if(isset($_SESSION['book']))
    {
        echo $_SESSION['book'];
        unset($_SESSION['book']);
    }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="sub-text">OUR SPECIALS<h2>

            <?php
            //Create SQL query to display categories from databse
            $sql = "SELECT * FROM category_table WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //Count rows to check wheather the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>
                    <a href="<?php echo SITEURL; ?>category-movies.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php

                        //check wheather Image is available or not
                        if($image_name=="")
                        {
                            //Display Message
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="catoon" class="img-responsive img-curve">

                            <?php
                        }

                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //Categories not available
                echo "<div class='error'>Category not Added.</div>";
            }

            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->




    <!-- movie MEnu Section Starts Here -->
    <section class="movie-menu">
        <div class="container">
            <h2 class="sub-text"> MOVIES</h2>

            <?php
            //display movies that are active
            $sql2 = "SELECT * FROM movie_table WHERE active='Yes'LIMIT 6";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count Rows
            $count2 = mysqli_num_rows($res2);

            //Check wheather the movie are available or not
            if($count>0)
            {
                //movie Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $time = $row['time_tid'];
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

                             <a href="<?php echo SITEURL; ?>booking.php?movie_id=<?php echo $id ;?>" class="btn btn-primary">Booking Now</a>
                         </div>
                    </div>

                    <?php
                }
            }
            else{
                //Movie Not Available
                echo "<div class='error'>Movie Not Available.</div>";

            }

            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Movie Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
