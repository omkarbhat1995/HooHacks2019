<?php
	define ('DB_Name','db1');
	define ('DB_User','root');
	define ('DB_Pass','');
	define ('DB_Host','localhost');
	$link= mysqli_connect(DB_Host,DB_User,'',DB_Name);
	if (!$link){
		die('Coundnt connect'.mysqli_error($link));
	}
	$db_selected=mysqli_select_db($link,DB_Name);
	if (!$db_selected){
		die('Cant use DB'.mysqli_error($link));
	}
	$u=(string)$_POST['username'];
	$p=(string)hash('sha256',$_POST['password']);
	$f=$_POST['fname'];
	$l=$_POST['lname'];
	$e=$_POST['email'];
	$m=$_POST['mobile'];
	$t=$_POST['type'];
	$v=$_POST['value'];
$sql="INSERT INTO users (username,password) VALUES ('$u','$p')";
$sql2="INSERT INTO kyc (username,fname,lname,email,mobile,type,value) VALUES ('$u','$f','$l','$e','$m','$t','$v')";
if (!mysqli_query($link,$sql)){die('Error'.mysqli_error($link));}
if (!mysqli_query($link,$sql2)){die('Error'.mysqli_error($link));}

header("refresh:1;url=login.html");
mysqli_close($link);
?>