<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE BOOKING</h1>
                
                 <br> <br> <br>

                 <?php

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                 ?>

                <table class="tbl-full">
                    <tr>
                        <th>I.D</th>
                        <th>Movie</th>
                        <th>Price</th>
                        <th>Time & Theater</th>
                        <th>Qty</th>
                        <th>Select Date</th>
                        <th>Total</th>
                        <th>Book Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    <?php 

                    //Get all the book from databse
                    $sql = "SELECT * FROM book_table ORDER BY id DESC";//displaying th later order 1st
                    //Execute query
                    $res = mysqli_query($conn, $sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count>0)
                    {
                        //booking available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the booking details
                            $id = $row['id'];
                            $movie = $row['movie'];
                            $price = $row['price'];
                            $time = $row['time'];
                            $qty= $row['qty'];
                            $selected_date = $row['selected_date'];
                            $total = $row['total'];
                            $book_date = $row['book_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];

                            ?>

                            <tr>
                             <td><?php echo $sn++; ?>.</td>
                             <td><?php echo $movie; ?></td>
                             <td><?php echo $price; ?></td>
                             <td><?php echo $time; ?></td>
                             <td><?php echo $qty; ?></td>
                             <td><?php echo $selected_date; ?></td>
                             <td><?php echo $total; ?></td>
                             <td><?php echo $book_date; ?></td>
                             <td>
                                <?php 
                                if($status=="Book")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="Confirm")
                                {
                                    echo "<label style=='color: orange;'>$status</label>";
                                }
                                elseif($status=="Pending")
                                {
                                    echo "<label style=='color: green;'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style=='color: red;'>$status</label>";
                                }
                             
                                ?>
                             </td>
                             <td><?php echo $customer_name; ?></td>
                             <td><?php echo $customer_contact; ?></td>
                             <td><?php echo $customer_email; ?></td>
                             <td>
                                <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $id; ?>" class="btn-secondary">Booking</a>
                            
                             </td>
                            </tr>


                            <?php


                         }

                    }
                    else{
                        //order not available
                        echo "<tr><td colspan='12' class='error'>Booking are Not Available.</td></tr>";
                    }


                    ?>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>



<?php include('partials/footer.php'); ?>