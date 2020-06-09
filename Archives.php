<html>
<head>
<title>Archives</title>




</head>


<body>
<h1>Virtual Judge</h1>
<br>


<a href="index.php" title="About"  id="current" >About</a>
<a href="Archives.php" title="Archives" >Archives</a>
<a href="recent.php" title="Recent" >Recent</a>
<a href="news.php" title="News"  >News</a>

<?php
if(!isset($_COOKIE['username'])){
echo '<a href="signup.php">Sign Up</a>&nbsp';
echo '<a href="login.php">Log In</a>&nbsp';
}
else {
echo '<a href="account.php">Account</a>&nbsp';
echo '<a href="progress.php">Progress</a>&nbsp';
echo '<a href="logout.php">Log Out</a>&nbsp';
}
?>


<a href="admin.php"  accesskey="5">Admin</a>



<table id="problems_table" class="grid" >




<tr><th >ID</th><th>Title</th><th ">Submissions</th><th >Success</th></tr>

<?php
$db=mysqli_connect("localhost","root","","Virtual_Judge");
$query="select * from Problems";
$result=mysqli_query($db,$query);




while($row=mysqli_fetch_array($result)){
echo '<tr><td >'.$row['ID']."</td>";
echo '<td><a href="problem.php?id='.$row['ID'].'">'.$row['Title']."</a></td>";
echo '<td align="center">'.$row['No_Of_Tries']."</td>";
echo '<td align="center">'.$row['No_Of_Successful_Tries']."</td>";
}
echo "</tr>";




?>

</table>
</body>
</html>
