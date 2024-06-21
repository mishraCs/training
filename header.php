<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   <!-- bootstrap cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="header_nav">
            <nav class="header_element">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="black_green" href="dashboard.php">Dashboard</a>
                    <a class="black_green" href="logout.php">Logout</a>
                    <a class="black_green" href="logout.php">Update Profile</a>
                    <a class="black_green" href="home.php">Home</a>
                <?php else: ?>
                    <a class="black_green" href="register.php">Register</a>
                    <a class="black_green" href="login.php">Login</a>
                <?php endif; ?>
            </nav>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">         <!-- bootstrap cdn -->
        </div>
    </header>
