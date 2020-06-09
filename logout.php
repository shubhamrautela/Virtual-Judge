<?php
// if the user is logged in

if(isset($_COOKIE['username'])){
setcookie('username','',time()-1);
}
$home='index.php';
header('Location: '.$home);
?>
