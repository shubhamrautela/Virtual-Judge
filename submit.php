<html>
<head>
<title>your code is successfully submitted</title>

</head>
<?php 

$code=nl2br($_POST['thecode']);
if(isset($_POST['language'])) {
    $lang= $_POST['Language'];
}
$lang= $_POST['Language'];
echo "your choosen language is $lang <br><br>$code";
?>
</html>
