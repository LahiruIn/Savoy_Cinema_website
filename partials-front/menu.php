<?php include('config/constants.php');
include('user/login-check.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savoy Cinama</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo_img.png" alt="Savoy Logo" class="logo-shep">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>about.php">About</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>movies.php">Movies</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL; ?>contact.php">Contact Us</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL; ?>user/logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->