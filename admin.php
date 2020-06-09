<?php

$username='admin';
$password='root';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER']!=$username || $_SERVER['PHP_AUTH_PW']!=$password){

header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="admin"');
exit('<h1>Virtual Judge</h1><br> Sorry, you must enter a valid username and password to access this page');

}


	echo '<h2> Admin area</h2>';
	echo '<a href="admin.php?show=users">Users</a> ';
	echo '<a href="admin.php?show=problems">Problems</a> ';
	echo '<a href="addProblem.php">Add a problem</a> ';
	echo '<a href="admin.php?show=create_a_competition">Create a competition</a> ';



if(isset($_GET['show'])){

$option=$_GET['show'];

	if($option=="users"){
	$db=mysqli_connect("localhost","root","","Virtual_Judge");
	$query="Select * from User_details";
	$result=mysqli_query($db,$query);
	echo '<br><br><table cellspacing="10"><tr><th>Nickname</th><th>College_Name</th><th>Username'.'</th><th>Score</th><th>Level</th><th>Joined_On</th><th>Directory</th></tr>';

	if($result==false)
	{
	echo "Connection to the database cannot be made";
	}


	while($row=mysqli_fetch_array($result)){

		echo "<tr><td>".$row['Nickname']."</td>";
		echo "<td>".$row['College_Name']."</td>";
		echo "<td>".$row['Username']."</td>";
		echo "<td>".$row['Score']."</td>";
		echo "<td>".$row['Level']."</td>";
		echo "<td>".$row['Joined_On']."</td>";
		echo "<td>".$row['Directory']."</td>";
		echo '<td><a href="removeuser.php?username='.$row['Username'].'">remove</a></td></tr>';
	}

	echo '</table>';
	mysqli_close($db);
	}
	else if($option=="problems"){
	
	$db=mysqli_connect("localhost","root","","Virtual_Judge");
	$query="Select * from Problems";
	$result=mysqli_query($db,$query);
	echo '<br><br><table cellspacing="20"><tr><th>ID</th><th>Title</th><th>Added On</th><th>No of Tries</th><th>No of Successful Tries</th></tr>';

	if($result==false)
	{
	echo "Connection to the database cannot be made";
	}
	while($row=mysqli_fetch_array($result)){

		echo "<tr><td>".$row['ID']."</td>";
		echo '<td align="center">'.$row['Title']."</td>";
		echo "<td>".$row['Added_On']."</td>";
		echo '<td align="center">'.$row['No_Of_Tries']."</td>";
		echo '<td align="center">'.$row['No_Of_Successful_Tries']."</td>";
		echo '<td><a href="remove.php">remove</a></td></tr>';
	}

	echo '</table>';
	mysqli_close($db);
}



}

?>
<html>
<head><title>hello</title></head>

<body>

</body>


</html>
