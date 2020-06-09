<html>
<head>
<title>Sign Up</title>
</head>


<body>

<?php 

define('UPLOADPATH','images/');
$showform=false;
if(isset($_POST['submit'])){

$nickname=trim($_POST['nickname']);
$collegename=trim($_POST['collegename']);
$username=trim($_POST['username']);
$password=trim($_POST['password']);
$profilepic=trim($_FILES['profilepic']['name']);

$error="Please fill all the fields.";
$filevalid=false;


if(empty($username) || empty($password) || empty($nickname) || empty($collegename)){
echo "Please fill all the fields";
$showform=true;
}


if(($_FILES['profilepic']['size']<=1000000 && $_FILES['profilepic']['size']>0) && ($_FILES['profilepic']['type']=="image/jpeg" || $_FILES['profilepic']['type']=="image/png") ){

$filevalid=true;

}
else {
echo "please select a proper image file with size less than 1Mb";
$showform=true;
}




if(!empty($username) && !empty($password) && !empty($nickname) && !empty($collegename) && !empty($profilepic)) {

$target=time().$profilepic;

if(move_uploaded_file($_FILES['profilepic']['tmp_name'],UPLOADPATH.$target)){
$directory=time()."";



	$db=mysqli_connect("localhost","root","","Virtual_Judge") or die ("connection error");

	$search_query="select Username from User_details where username='$username'";



	$result=mysqli_query($db,$search_query);

	if(!mysqli_fetch_array($result)){
	$insert_query="insert into User_details(Nickname,College_Name,Profile_Picture,Username,Password,Joined_On,Directory) ". "values('$nickname','$collegename','$target','$username',SHA('$password'),NOW(),'$directory')";

//	print($insert_query);
	$result=mysqli_query($db,$insert_query) or die("error");

	if($result){
	mkdir("./submissions/".$directory,0777);
	echo "Thank you! Your username has been registered";
	}
	else echo "oh o";
	}
	else {
	echo "username \"$username\" is already registered";
	$showform=true;
	}

	}
}}
else $showform=true;





if($showform){
?>




<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">


<fieldset>
<legend>Sign Up!</legend>

<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>

<label for="name">Nickname:</label>
<input type="text" id="nickname" name="nickname" value="<?php if(!empty($nickname)) echo $nickname;?>"/>

<br/>


<label for="name">College Name:</label>
<input type="text" id="collegename" name="collegename" value="<?php if(!empty($collegename)) echo $collegename;?>"/>

<br/>

<label for="name">Username:</label>
<input type="text" id="username" name="username" value="<?php if(!empty($username)) echo $username;?>"/>

<br/>

<label for="name">Password:</label>
<input type="password" id="password" name="password" value=""/>

<br/>

<label for="name">Profile Picture:</label>
<input type="file" id="profilepic" name="profilepic"/>

<hr/>

<input type="submit" value="Sign Up" name="submit"/>

<?php
}

?>
</fieldset>
</body>
</html>

