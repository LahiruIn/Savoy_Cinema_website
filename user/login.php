<html>
    <head>
        <title>Login-SAVOY</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>

    <div class="user-login-container">
        <img class="bg-image">
        <div class="content">
            <h2>Login</h2>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>

            <form action="" method="POST">
                <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
                <input type="text" id="password" name="password" placeholder="Enter Your Password" required>
                <button type="submit" name="submit" value="Login">Login</button>
            </form>
            
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    </body>
</html>

<?php

include('../config/constants.php');

//Check weather the submit button is clicked or not
if(isset($_POST['submit']))
{
    //Process for Login
    //1.Get the Data from Login Form
    //$username = $_POST['username'];
    //$password = md5($_POST['password']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //2.SQL to check weather the user with username and password exists or not
    $sql= "SELECT * FROM register_table WHERE username = '$username' AND password = '$password'";


    //3.Execute the query
    $res = mysqli_query($conn, $sql);

    //4.count rows to check wheather the user exisits or not
    $count=mysqli_num_rows($res);

    if($count==1){
        //user available and login success
        $_SESSION['login'] = "<div class='success'> Login successfully.</div>";
        $_SESSION['users'] = $username; //to check wheather the user is logged in or not logout will unset
        //redirect to home page /dashbord
        header('location:'.SITEURL.'index.php');
    }
    else
    {
        //User not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //redirect to home page /dashbord
        header('location:'.SITEURL.'index.php');
    }


}
?>