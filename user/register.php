<html>
    <head>
        <title>Register-SAVOY</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>



    <div class="user-register-container">
        <img class="bg-image">
        <div class="content">
            <h2>Register</h2>

        <?php
        if(isset($_SESSION['add'])) //Checking whether the session is set of net
        {
            echo $_SESSION['add']; // Dissplay the sesstion message if set
            unset($_SESSION['add']); //Remove session Message
        }
        ?>

            <form action="" method="POST">
                <input type="text" id="fullname" name="full_name" placeholder="Enter Your Full Name" required>  
                <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
                <input type="text" id="email" name="email" placeholder="Enter Your Email" required>
                <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                <button type="submit" name="submit" value="Add Customer">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>


    </body>
</html>

<?php
include('../config/constants.php');
//Prosess the value from Form and Save it in Database

//check weather the submit button is is clicked or not

if(isset($_POST['submit'])){
    // Button clicked
    //echo "Button Clicked";

    // 1.Get data from Form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);//password Encryption with MD5

    // 2.SQL Query to save the data into database

    $sql = "INSERT INTO register_table SET
    full_name= '$full_name',
    email= '$email',
    username= '$username',
    password= '$password'
    ";

   
    // 3. Executing Query and saving data into Database
    $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    // 4. Check weather the(Query is Executed) date is inserted or not and display appropriate message

    if($res==TRUE){
        // Data Inserted
        //echo "Data Inserted";
        //Create a Session variable to display message
        $_SESSION['add'] = "Register Successfully";

        //Redirect Page to manage admin
        header("location:".SITEURL.'user/login.php');
    }
    else{
        // Failed to Inserted Data
        //echo "Failed to Inser Data";
        //Create a Session variable to display message
        $_SESSION['add'] = "Failed to Register";

        //Redirect Page to add admin
        header("location:".SITEURL.'register.php');
    }

}