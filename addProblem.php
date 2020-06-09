<html>
<head>
<title>Add a Problem</title>
</head>

<body>

<?php
require_once('connect_vars.php');
$showform=true;
$error='';
define('UPLOADPATH','./problems/');
echo"running here";

 if(isset($_POST['submit'])){
echo"running here";
$title=$_POST['title'];
$statement=$_POST['statement'];
$input=$_FILES['input']['name'];
$output=$_FILES['output']['name'];
$sampleinput=$_POST['sampleinput'];
$sampleoutput=$_POST['sampleoutput'];

$ext1 = pathinfo($input, PATHINFO_EXTENSION);
$ext2 = pathinfo($output, PATHINFO_EXTENSION);


if(isempty($title) || isempty($statement) || isempty($sampleinput) || isempty($sampleoutput)){

	if($ext1=='txt' && $ext2=='txt'){
		$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query="insert into Problems('Title','Statement','Input','Output','Sample_Input','Sample_Output') values('$title','statement.txt','input.txt','output.txt','sampleinput.txt','sampleoutput.txt')";
		$result=mysqli_query($dbc,$query);
		$data=mysqli_fetch_array($result);
		mysqli_close($dbc);
		$inputpath="/problems/".$data['ID']."/input.txt";
		$outputpath="/problems/".$data['ID']."/output.txt";
		move_uploaded_file($_FILES['input']['tmp_name'], $inputpath);
		move_uploaded_file($_FILES['input']['tmp_name'], $outputpath);
		$file=fopen("/problems/".$data['ID']."sampleinput.txt","w");
		fwrite($file,$sampleinput);
		fclose($file);	

		$file=fopen("/problems/".$data['ID']."sampleout.txt","w");
		fwrite($file,$sampleoutput);
		fclose($file);	
		echo "1 problem add successfully";
		$showform=false;
		header("Location: /admin.php");
	}
	else {
	$error=$error.' please upload a text file';
	$showform=true;
	}
}
else{

$error='please fill all the fields';
$showform=true;
}
}
echo"running here error";
if($showform){
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

<label for="name">Title:</label><input type="Text" name="title">
<br>

<label for="name">Problem Statement:</label><br><textarea name="input" cols="100" rows="4"></textarea><br>
<br>

<label for="name">Input:</label>
<input type="file" name="input"/><br>
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<label for="name">Output:</label>
<input type="file" name="output"/><br>

<label for="name">Sample_Input:</label><br>
</label><textarea name="sampleinput" cols="40" rows="10"></textarea><br>


<label for="name">Sample_Output:</label><br>
</label><textarea name="sampleoutput" cols="40" rows="10"></textarea><br>

<button type="submit" name="submit">Submit</button>
</form>
<?php
}
?>
</body>
</html>
