<html>
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>

<?php
	$showForm= true;
	
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$json=file_get_contents('users.json');
	$data=json_decode($json, true);
	$userExists=false;
	$emailExists=false;
	
	#form validation and register
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){ 

	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$email=$_POST['email'];
	
	
	foreach ($data as $item){
		if ($item['username'] === $username){
			$userExists=true;
			break;
		}
	}
	
	#username validation
	if (empty($username))
    {echo "<div class='msg'>فیلد نام کاربری خالی است</div>";
	exit;}
	
	if ($username=="admin" or $username=="administrator" or $username=="root"){echo "<div class='msg'>این نام کاربری مجاز نیست</div>";
	exit;}
	
	if($userExists){ 
		echo "<div class='msg'>نام کاربری تکراری می باشد</div>";
	exit;} 
	#/username validation
	
	
	#password validation
  	if (empty($_POST['password']))
    {echo "<div class='msg'>فیلد رمز عبور خالی است</div>";
	exit;}
	
	  if (strlen($_POST['password'])<6 or strlen($_POST['password'])>12)
    {echo "<div class='msg'>تعداد کاراکترهای رمز عبور باید بین 6 تا 12 کاراکتر باشد</div>";
	exit;}
	
	if($_POST['password'] != $_POST['password2'] ){
	echo "<div class='msg'>مقادیر فیلد های رمز عبور یکسان نیست</div>";
	exit;}
	#/password validation
	
	
	#email validation
	if (empty($email))
    {echo "<div class='msg'>فیلد ایمیل خالی است</div>";
	exit;}
	
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
	{echo "<div class='msg'>ایمیل نامعتبر است. لطفا ایمیل خود را به طور صحیح وارد نمایید.</div>";
	exit;}

	foreach ($data as $item){
		if ($item['email'] === $email){
			$emailExists=true;
			break;
		}
	}
	if($emailExists){ 
		echo "<div class='msg'>ایمیل تکراری می باشد</div>"; 
	exit;} 
 	#/email validation

	
	
	#register
	if(!$userExists){
		$data[] = array ('username' => $username, 'password' => $password, 'email' => $email);
		$newData = json_encode($data);
		file_put_contents('users.json', $newData);
		echo "<div class='msg'><p>ثبت نام با موفقیت انجام شد. هم اکنون میتوانید وارد ناحیه کاربری خود شوید.</p>
		<a href='login.php'><button type='button'>login</button></a></div>";
		$showForm = false;
	}
	#/register
	
}
#/form validation and register


}

	
if ($showForm) {

echo "
<form method='post'>
    <label for='username'>Username:</label>
    <input type='text' name='username' id='username' required>
    <br>
    <label for='password'>Password:</label>
    <input type='password' name='password' id='password' required>
    <br>
	<label for='password2'>Confirm Password:</label>
    <input type='password' name='password2' id='password2' required>
    <br>
    <label for='email'>Email:</label>
    <input type='email' name='email' id='email' required>
    <br><br>
    <input class='mb' type='submit' name='submit' value='Sign Up'>
    <a href='login.php'><button type='button'>Login page</button></a>
    <a href='index.php'><button type='button'>main page</button></a>
</form>
";

}

?>
</body>
</html>

