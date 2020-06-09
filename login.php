
<?php 
// The php file to store all the connection variables and their values
require_once('connect_vars.php');

$error='';


//if the user isnt logged in, try to log them in
if(!isset($_COOKIE['username'])){
if(isset($_POST['submit'])){


//connect to the database
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//store the user-entered data

$username=mysqli_real_escape_string($dbc,trim($_POST['username']));
$password=mysqli_real_escape_string($dbc,trim($_POST['password']));

	if(!empty($username) && !empty($password)){

	//Look up the username and password in the database;
		$query="SELECT username from User_details WHERE Username='$username' AND Password=SHA('$password')";
		$data=mysqli_query($dbc,$query);

		if(mysqli_num_rows($data)==1){

			$row=mysqli_fetch_array($data);
			setcookie('username',$row['username']);
			$home_url='index.php';
			header('Location: '.$home_url);
		}			
		else {
		$error='Sorry, you must enter a valid username and password to log in.';
		
		}
		
	}
	else {
	$error='Sorry,you must enter your username and password to log in.';
	}
}

}

?>
<html>
<head>
<title>Log In</title>
</head>

<body>
<?php
if(empty($_COOKIE['username'])){
	echo '<p class="error">'.$error.'</p>';

?>	
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
<fieldset>
<legend>Log In!</legend>
<label>Username</label>
<input type="Text" name="username" id="username" onFocus="usernameOnFocus();" value="<? if(!empty($username)) echo $username?>" OnFocusOut="usernameOnFocusOut();">
<label id="usererr"></label>

<br>
<label>Password</label>
<input type="password" id="password" name="password" onFocus="passwordOnFocus();" OnFocusOut="passwordOnFocusOut();>
<label id="passerr"></label>
<br>
<button type="submit" id="submit" name="submit" onclick="validate();">Log in</button>
<button type="submit" formaction="signup.html"">Sign Up</button>
</fieldset>
</form></table>
<script src="./JS/login.js"></script>
<?php 
}else {
echo '<p class="login">You are logged in as '.$_COOKIE['username'].'.</p';

}	
?>
</body>
</html>
