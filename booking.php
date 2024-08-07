<?php include('partials-front/menu.php'); ?>

<?php

// Check whether movie ID is set or not
if (isset($_GET['movie_id'])) {
    // Get the movie ID of the selected movie
    $movie_id = $_GET['movie_id'];

    // Get the details of the selected movie
    $sql = "SELECT * FROM movie_table WHERE id=$movie_id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Count the rows
    $count = mysqli_num_rows($res);

    // Check whether the data is available or not
    if ($count == 1) {
        // We have data
        // Get the data from database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $time = $row['time_tid'];
        $image_name = $row['image_name'];
    } else {
        // Movie not available
        // Redirect to home page
        header('location:'.SITEURL);
    }

} else {
    // Redirect to homepage
    header('location:'.SITEURL);
}

?>

<!-- Movie SEARCH Section Starts Here -->
<section class="movie-book">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your Booking.</h2>

        <form action="" method="POST" class="book">
            <fieldset>
                <legend>Selected Movie</legend>

                <div class="movie-menu-img">
                    <?php
                    // Check whether the image is available or not
                    if ($image_name == "") {
                        // Image not available
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                        // Image available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/movie/<?php echo $image_name; ?>" alt="frozen" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="movie-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="movie" value="<?php echo $title; ?>">

                    <p class="movie-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <p class="movie-price"><?php echo $time; ?></p>
                    <input type="hidden" name="time" value="<?php echo $time; ?>">

                    <div class="book-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                    <div class="book-label">Select Date</div>
                    <input type="date" name="selected_date" class="input-responsive" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Customer Details</legend>
                <div class="book-label">Full Name</div>
                <input type="text" name="full-name" placeholder="K.M. Silva" class="input-responsive" required>

                <div class="book-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="0751231123" class="input-responsive" required>

                <div class="book-label">Email</div>
                <input type="email" name="email" placeholder="silva@gmail.com" class="input-responsive" required>

                <input type="submit" name="submit" value="Confirm booking" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // Check whether submit button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $movie = $_POST['movie'];
            $price = $_POST['price'];
            $time = $_POST['time'];
            $qty = $_POST['qty'];
            $selected_date = $_POST['selected_date'];

            $total = $price * $qty; // Total = price x qty
            $book_date = date("Y-m-d h:i:sa"); // Booking date
            $status = "Book"; // Confirm, Pending, Cancel
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];

            // Save the booking in database
            // SQL query to save the data
            $sql2 = "INSERT INTO book_table SET
                movie = '$movie',
                price = $price,
                time = '$time',
                qty = $qty,
                selected_date = '$selected_date',
                total = $total,
                book_date = '$book_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email'";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether query executed successfully or not
            if ($res2 == true) {
                // Query executed and order saved
                $_SESSION['book'] = "<div class='success text-center'>Movie Booking Successfully.</div>";
                header('location:'.SITEURL);
            } else {
                $_SESSION['book'] = "<div class='error text-center'>Failed to Booking Movie.</div>";
                header('location:'.SITEURL);
            }
        }
        ?>
    </div>
</section>
<!-- Movie SEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
