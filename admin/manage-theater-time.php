<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE THEATER AND TIME</h1>

        <br> <br> 
        
        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-theater-time-found']))
        {
            echo $_SESSION['no-theater-time-found'];
            unset($_SESSION['no-theater-time-found']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        ?>
        <br><br>

                <!-- Button to add time-->
                 <a href="<?php echo SITEURL; ?>admin/add-theater-time.php" class="btn-primary">Add Theater And time</a>
                 <br> <br> <br>

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Time</th>
                        <th>Theater</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                    //Query to get all time from Databse
                    $sql = "SELECT * FROM theater_time_table";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);

                    //Create serial number variable and assign value as 1
                    $sn=1;

                    //check wheather we have data in databse or not
                    if($count>0)
                    {
                        //we have data in database
                        //get the data and display
                        while ($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $time = $row['time'];
                            $theater = $row['theater'];
                            $active = $row['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $time; ?></td>

                                <td><?php echo $theater; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                   <a href="<?php echo SITEURL; ?>admin/update-theater-time.php?id=<?php echo $id; ?>" class="btn-secondary">Update Theater and Time</a>
                                   <a href="<?php echo SITEURL; ?>admin/delete-theater-time.php?id=<?php echo $id; ?>" class="btn-danger">Delete Theater and Time</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else{
                        // we do not have data 
                        //we'll display the message inside table

                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added</div></td>
                        </tr>
                        <?php
                    }

                    ?>

                    
                    
                </table>
                
            </div>
        </div>
    </div>
</div>



<?php include('partials/footer.php'); ?>