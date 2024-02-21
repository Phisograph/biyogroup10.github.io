<?php

include 'config.php';

session_start();
if(!isset($_SESSION['admin_name'])){
    header('location:index.php');
 } 

?>

<!DOCTYPE html>
<link rel="stylesheet" href ="index.css"> 
<script src="index.js"></script>
<html>
<head>
    <title>View Page</title>
</head>
<body>
    <div class="container">
        <div class="message-container">
            <h3>Hello,<span>Admin!</span></h3>
            <p>You are now viewing an admin page.</p>
            <p>As an admin, you may explore the widgets below with their <b>fully-fledged capacity</b> and log out once you're done. </p>
            <a href="index.html" class="logout-btn" >Log Out</a>
        </div>
    </div>
</body>
</html>