<html>
<head>
<title>Virtual Judge</title>
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


<?php
require_once('connect_vars.php');
$problemid=$_GET['id'];
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query="Select * from Problems where ID='$problemid'";

$result=mysqli_query($dbc,$query);
$data=mysqli_fetch_array($result);

$fp = fopen("problems/".$data['ID'].'/'.$data['Statement'], "r");

//Output lines until EOF is reached
$statement=nl2br(fread($fp,filesize('problems/'.$data['ID'].'/'.$data['Statement'])));
fclose($fp);

$fp=fopen("problems/".$data['ID'].'/'.$data['Sample_Input'],"r");
$sampleinput=nl2br(fread($fp,filesize('problems/'.$data['ID'].'/'.$data['Sample_Input'])));
fclose($fp);


$fp=fopen("problems/".$data['ID'].'/'.$data['Sample_Input'],"r");
$sampleoutput=nl2br(fread($fp,filesize('problems/'.$data['ID'].'/'.$data['Sample_Output'])));
fclose($fp);


echo '<h3>'.$data['Title'].'</h3>';
echo '<b>Problem: </b>'.$data['ID'].'<br>';
echo '<b>Added on: </b>'.$data['Added_On'].'<br>';
echo '<p>'.$statement.'</p>';
echo '<h5>Input</h5>';
echo '<p>'.$sampleinput.'</p>';
echo '<h5>Output</h5>';
echo '<p>'.$sampleoutput.'</p>';
if(isset($_COOKIE['username']))
echo '<a href="solve.php?id='.$problemid.'">Solve</a>';


?>

<body>
</html>
