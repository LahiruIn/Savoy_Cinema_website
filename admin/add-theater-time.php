<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>ADD THEATER AND TIME</h1>
        <br><br>

        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }


        ?>
        <br><br>

        <!-- Add time From Starts-->

        <form action="" method="POst" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiime  : </td>
                    <td>
                        <input type="radio" name="time" value="08.00a.m">08.00 A.M
                        <input type="radio" name="time" value="10.00a.m">10.00 A.M<br>
                        <input type="radio" name="time" value="12.00p.m">12.00 P.M
                        <input type="radio" name="time" value="02.00p.m">02.00 P.M<br>
                        <input type="radio" name="time" value="04.00p.m">04.00 P.M
                        <input type="radio" name="time" value="06.00p.m">06.00 P.M<br>
                        <input type="radio" name="time" value="09.00p.m">09.00 P.M
                    </td>
                </tr>
                <tr>
                    <td>Theater : </td>
                    <td>
                        <input type="text" name="theater" placeholder="Time">
                    </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Theater and Time" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add time From Ends-->

        <?php

        //Check wheather the submit button is Clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";

            //1.Get the value from time Form

            //For Radio input,we need to check wheather the button is selected or not
            if(isset($_POST['time']))
            {
                //Get the value from Form
                $time = $_POST['time'];
            }
            else
            {
                //set the Default value 
                $time = "No";
            }

            $theater = $_POST['theater'];

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            

            //2. Create SQL Query to Insert time in Databse
            $sql = "INSERT INTO theater_time_table SET
            time ='$time',
            theater = '$theater',
            active = '$active'
            ";

            //3. Execute the Query and Sve in databse
            $res = mysqli_query($conn, $sql);

            //4. Check wheather the query  executed or not and data added or not

            if($res==true)
            {
               //Query Executed and time Added
               $_SESSION['add'] = "<div class='success'>Theater and Time Added Successfully.</div>";
               //Readirect to Manage time Page
               header('location:'.SITEURL.'admin/manage-theater-time.php');
            }
            
            else{
               //Failed to Add time
               $_SESSION['add'] = "<div class='error'>Failed to Add Theater and Time.</div>";
               //Readirect to Manage time Page
               header('location:'.SITEURL.'admin/add-theater-time.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>