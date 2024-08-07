<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE BOOKING</h1>

        <br><br>

        <?php
        // Check whether id is set or not
        if (isset($_GET['id'])) {
            // Get the booking detail
            $id = $_GET['id'];

            // Get all other details based on this id
            // SQL query to get the booking details
            $sql = "SELECT * FROM book_table WHERE id=$id";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Details available
                $row = mysqli_fetch_assoc($res);

                $movie = $row['movie'];
                $price = $row['price'];
                $time = $row['time'];
                $qty = $row['qty'];
                $selected_date = $row['selected_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
            } else {
                // Details not available
                // Redirect to manage book page
                header('location:' . SITEURL . 'admin/manage-booking.php');
            }
        } else {
            // Redirect to manage book page
            header('location:' . SITEURL . 'admin/manage-booking.php');
        }
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td>Movie Name</td>
                    <td><b><?php echo $movie; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$ <?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td> <?php echo $time; ?></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Select Date</td>
                    <td>
                        <input type="date" name="selected_date" value="<?php echo $selected_date; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Book") 
                            {
                                echo "selected";
                            } 
                            ?> value="Confirm">Confirm</option>
                            
                            <option <?php if ($status == "Pending") 
                            {
                                echo "selected";
                            } 
                            ?> value="Pending">Pending</option>
                            
                            <option <?php if ($status == "Cancelled") 
                            {
                                echo "selected";
                            } 
                            ?> value="Cancelled">Cancelled</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Booking" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        // Check whether update button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the values from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $selected_date = $_POST['selected_date'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];

            // Update the value
            $sql2 = "UPDATE book_table SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email'
                WHERE id=$id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether update or not
            // Add redirect to manage booking with message
            if ($res2 == true) {
                // Update
                $_SESSION['update'] = "<div class='success'>Booking Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-booking.php');
            } else {
                // Failed update
                $_SESSION['update'] = "<div class='error'>Failed to Update Booking.</div>";
                header('location:' . SITEURL . 'admin/manage-booking.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
