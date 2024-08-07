<?php include('partials/menu.php'); ?>
             
        <!--Main Content section start-->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>

                <br><br>
                <?php
                if(isset($_SESSION['login']))
                {
                   echo $_SESSION['login'];
                   unset($_SESSION['login']);
                }

                ?>
                <br><br>

                <div class="col-4 text-center">
                    <?php
                    //Sql Query
                    $sql = "SELECT * FROM category_table";

                    //Executed query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                    //Sql Query
                    $sql2 = "SELECT * FROM movie_table";

                    //Executed query
                    $res2 = mysqli_query($conn, $sql2);

                    //count rows
                    $count2 = mysqli_num_rows($res2);

                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Movies
                </div>

                <div class="col-4 text-center">
                    <?php
                    //Sql Query
                    $sql3 = "SELECT * FROM book_table";

                    //Executed query
                    $res3 = mysqli_query($conn, $sql3);

                    //count rows
                    $count3 = mysqli_num_rows($res3);

                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Total Bookings
                </div>

                <div class="col-4 text-center">
                    <?php
                    //create sql query to get total remove genarated
                    //arangement functiom in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM book_table WHERE status='Confirm'";

                    //execute the query
                    $res4 = mysqli_query($conn, $sql4);

                    //get the value 
                    $row4 = mysqli_fetch_assoc($res4);

                    //get the total revenue
                    $total_revenue = $row4['Total'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--Main Content section end-->
                
            </div>
        </div>
        <!--Main Content section end-->

<?php include('partials/footer.php'); ?>