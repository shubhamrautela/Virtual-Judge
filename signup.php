<?php

$team_name=$_POST['teamname'];
$member1=$_POST['member1'];
$member2=$_POST['member2'];
$college_name=$_POST['college'];
$password=$_POST['password'];


$db=mysqli_connect("localhost","root","","virtualjudge") or die ("connection error");

$search_query="select team_name from Team_Details where team_name='$team_name'";
$result=mysqli_query($db,$search_query);
if(!$result){
$insert_query="insert into Team_Details(Team_Name,Member_1,Member_2,College,Password) values('$team_name','$member1','$member2','$college_name','$password')";
$result=mysqli_query($db,$insert_query);

if($result){
echo "Thank you! Your team has been registered";
}
else echo "oh o";
}
else echo "team name \"$team_name\" is already registered";


?>