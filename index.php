<?php
session_start();

@$username=$_SESSION['username'];

if (isset($_SESSION['username'])){
    echo "<p style='color:green;'>welcome to the dashboard, $username !</p>";
    echo "<a href='logout.php'><button type='button'>logout</button></a>";
} else {

    echo "<h2>Click on the button below to continue.</h2>";
    echo "<a href='login.php'><button type='button'>login</button></a>";
    echo "<a href='signup.php'><button type='button'>Sign up</button></a>";
}



?>