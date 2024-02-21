<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_ID']);
    $email_id = mysqli_real_escape_string($conn, $_POST['email_ID']);
    $password = md5($_POST['password']);
    $user_level = md5($_POST['user_level']);

    $select = " SELECT * FROM user_form WHERE email_ID = '$email_id' && password = '$password'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'user already exists.';
    }else {
        $insert = "INSERT INTO user_form(name, email, password, user_level) VALUES ('$user_id', '$email_id', '$password', '$user_level')";
        mysqli_query($conn, $insert);
        header('location:index.php');
    }

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);
  
        if($row['user_level'] == 'admin'){
  
           $_SESSION['admin_name'] = $row['name'];
           header('location:Admin Page.html');
  
        }elseif($row['user_level'] == 'user'){
  
           $_SESSION['user_name'] = $row['name'];
           header('location:User Page.html');
  
        }
       
     }else{
        $error[] = 'incorrect email or password!';
     }

};

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
        <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">' .$error.'</span?';
                }
            };
        ?>
        <div class="form-container" id="form-container">
            <div class="button-box">
                <div id="btn"> </div>
                    <button type="button" class="toggle-btn" id="loginButton" onclick="login()">Log In</button>
                    <button type="button" class="toggle-btn" id="registerButton" onclick="register()">Register</button>
            </div>
            <form id="login" class="input-group">
                <input type="text" class="input-field" required placeholder="User ID" required>
                <input type="text" class="input-field" required placeholder="Enter Password" required>
                <div class="check-box">
                    <span>Please input your log in details above.</span>
                </div>
                <button type="submit" class="submit-btn">Log In</button>
            </form>
            <div class="longer">
            <form id="register" class="input-group" >
                <input type="text" class="input-field" name="user_ID" required placeholder="User ID" required>
                <input type="text" class="input-field" name="email_ID" required placeholder="Email ID" required>
                <input type="text" class="input-field" name="password" required placeholder="Enter Password" required>
                <select name="user_level" class="select-group">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="check-box">
                    <span>By registering, you agree to the terms & conditions.</span>
                </div>
                <button type="submit" class="submit-btn" name="submit">Register</button>
            </form>
            </div>
        </div>
    </div>
    <div id="box"></div>
    <script> 
    var x = document.getElementById("login")
    var y = document.getElementById("register")
    var z = document.getElementById("btn")
    
    function register() {
        x.style.left = "-400px"
        y.style.left = "50px"
        z.style.left = "115px"
    }

    function login() {
        x.style.left = "50px"
        y.style.left = "450px"
        z.style.left = "0px"
    }
    
    </script>

</body>
</html>