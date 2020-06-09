<?php
$username='admin';
$password='root';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER']!=$username || $_SERVER['PHP_AUTH_PW']!=$password){

header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="admin"');
exit('<h1>Virtual Judge</h1><br> Sorry, you must enter a valid username and password to access this page');

}
?>


<html>
<head><title>Remove user</title></head>
<body>

<?php 
if(isset($_GET['username'])){
$user=$_GET['username'];

$db=mysqli_connect("localhost","root","","Virtual_Judge") or die ("connection failed");
$query='select * from User_details where Username="'.$user.'"';
$result=mysqli_query($db,$query);

$row= mysqli_fetch_array($result);

if($row==false)
echo "query failed";

echo '<img src="./images/'.$row['Profile_Picture'].'" height="100" width="100"/><br>';


echo 'Nickname: '.$row['Nickname'].'<br>';
echo 'College Name: '.$row['College_Name'].'<br>';
echo 'Username: '.$row['Username'].'<br>';
echo 'Password: '.$row['Password'].'<br>';
echo 'Score: '.$row['Score'].'<br>';
echo 'Level: '.$row['Level'].'<br>';
echo 'Joined_On: '.$row['Joined_On'].'<br>';
echo '<form action="removeuser.php" method="POST">';
echo '<br><br><b><label>Are you sure you want to remove this user</label></b>';
echo '<input type="radio" name="confirm" value="Yes" />Yes';
echo '<input type="radio" name="confirm" value="No" checked="checked" />No';
echo '<input type="submit" name="submit" value="submit"/>';
echo '<input type="hidden" name="Username" value="'.$row['Username'].'"/>';
echo '<input type="hidden" name="Directory" value="'.$row['Directory'].'"/>';
echo '<input type="hidden" name="Profile_Picture" value="'.$row['Profile_Picture'].'"/>';

mysqli_close($db);


}

else if(isset($_POST['submit'])){
	if($_POST['confirm']=='Yes'){

	$username=$_POST['Username'];



	
	unlink('./images/'.$_POST['Profile_Picture']);
	$directory=$_POST['Directory'];
	rmdir("./submissions/".$directory);
	
	




$dbc=mysqli_connect("localhost","root","","Virtual_Judge") or die("connection failed");
$query="DELETE FROM User_details WHERE Username='$username' LIMIT 1";
$result=mysqli_query($dbc,$query);

mysqli_close($dbc);

if($result!=false)echo '<p>The user '.$username.' was successfully removed. <br>You will be redirected to admin page in 5 seconds.</p>';
	header('Refresh: 5; url=admin.php');


}
else {
echo "The user was not removed";
}
echo '<p><a href="admin.php"> &lt;&lt; Back to admin page</a></p>';
}	

?>


</body>
</html>
