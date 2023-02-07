<?php
ob_start();
session_start();
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>

<?php
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (isset($_POST['username'], $_POST['password'])) {
			
            $username=$_POST['username'];
            $password=md5($_POST['password']);
            $userExists=false;

            $json=file_get_contents('users.json');
            $data=json_decode($json, true);

            foreach ($data as $user){
                if ($user['username'] == $username && $user['password'] == $password){
                    $userExists=true;
                    break;
                }
            }

            if ($userExists){
                session_start();
                $_SESSION['username'] = $username;
                echo "You have logged in successfully. You can go to the dashboard by clicking the button below.";
                echo "<br><br><a href='index.php' style='margin-right:10px;'><button type='button'>Dashboard</button></a>";
                echo "<a href='logout.php'><button type='button'>logout</button></a>";
                
            } else {
                echo "<div class='msg'>The information you have entered is incorrect</div>";
                exit();
            }


		}
		
	}


if (!isset($_SESSION['username'])){
echo "<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method='post'>
        <label for='username'>Username:</label>
        <input type='text' name='username' id='username' required>
        <br>
        <label for='password'>Password:</label>
        <input type='password' name='password' id='password' required>
        <br><br>
        <input class='mb' type='submit' name='submit' value='Login'>
        <a href='signup.php'><button type='button'>sign-up page</button></a> 
        <a href='index.php'><button type='button'>main page</button></a>
    </form>
</body>
</html>";
} else {
   // header("Location: index.php");
}

?>

</body>
</html>

