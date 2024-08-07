<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE THEATER AND TIME</h1>
        <br> <br> 

        <?php

        //check wheather the id is set or not
        if(isset($_GET['id']))
        {
            //Get the ID and all other details
            //echo "Getting the data";
            $id =$_GET['id'];
            //Create SQL Query  to get all other details
            $sql = "SELECT * FROM theater_time_table WHERE id=$id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check wheather the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $time = $row ['time'];
                $theater = $row['theater'];
                $active = $row['active'];

            }
            else{
                //redirect to manage time with session message
                $_SESSION['no-theater-time-found'] = "<div class='error'>Theater And Time not Found.</div>";
                header('location:'.SITEURL.'admin/manage-theater-time.php');
            }


        }
        else
        {
            //redirect to manage time
            header('location:'.SITEURL.'admin/manage-theater-time.php');
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                
                <tr>
                    <td>Time  : </td>
                    <td>
                        <input <?php if($time=="08.00a.m"){echo "checked";} ?> type="radio" name="time" value="08.00a.m"> 08.00 A.M
                        <input <?php if($time=="10.00a.m"){echo "checked";} ?> type="radio" name="time" value="10.00a.m"> 10.00 A.M<br>
                        <input <?php if($time=="12.00p.m"){echo "checked";} ?> type="radio" name="time" value="12.00p.m"> 12.00 P.M
                        <input <?php if($time=="02.00p.m"){echo "checked";} ?> type="radio" name="time" value="02.00p.m"> 02.00 P.M<br>
                        <input <?php if($time=="04.00p.m"){echo "checked";} ?> type="radio" name="time" value="04.00p.m"> 04.00 P.M
                        <input <?php if($time=="06.00p.m"){echo "checked";} ?> type="radio" name="time" value="06.00p.m"> 06.00 P.M<br>
                        <input <?php if($time=="09.00p.m"){echo "checked";} ?> type="radio" name="time" value="09.00p.m"> 09.00 P.M
                    </td>
                </tr>
                <tr>
                    <td>Theater :</td>
                    <td>
                        <input type="text" name="theater" value="<?php echo $theater; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Theater and Time" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if(isset($_POST['submit']))
        {
            //echo "Clicked";
            //1. Get all the values from our Form
            $id = $_POST['id'];
            $time = $_POST['time'];

            $theater = $_POST['theater'];
            $active = $_POST['active'];

            
            //3.Update the Databse
            $sql2 = "UPDATE theater_time_table SET
            time = '$time',

            theater = '$theater',
            active = '$active'
            WHERE id=$id
            ";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //4.Redirect to Manage time with message 
            //Check whether executed or not
            if($res2==true)
            {
                //time Update
                $_SESSION['update'] = "<div class='success'>Theater and Time Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-theater-time.php');
            }
            else{
                //Failed to update time
                $_SESSION['update'] = "<div class='error'>Failed to Update Theater and Time.</div>";
                header('location:'.SITEURL.'admin/manage-theater-time.php');
            }


        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>