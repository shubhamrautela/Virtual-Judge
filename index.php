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

<h3>About Virtual Judge</h3>
<p>Virtual Judge is a local coding competition website which includes programming and mathematical problems.

The motivation for starting Virtual Judge is to provide a platform for inquiring minds to delve into unfamiliar areas and learn new concepts in a fun and challenging way.</p>

<h3>Who are the problems aimed at?</h3>
<p>The intended audience include students for whom the basic curriculum is not feeding their hunger to learn, and also the professionals who want to keep their problem solving skills on the cutting edge.</p>


<h3>Can anyone solve the problems?</h3>
<p>The problems range in difficulty and for many the experience is inductive chain learning. That is, by solving one problem it will expose you to a new concept that allows you to undertake a previously inaccessible problem. So the determined participant will slowly but surely work his/her way through every problem.</p>

<h3>What next?</h3>
<p>In order to track your progress it is necessary to setup an account and have Cookies enabled. If you already have an account then <a href="Login.php">Login</a> otherwise please <a href=signup.php>Sign up</a>.</p>

</body>
</html

					
