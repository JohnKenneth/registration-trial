<?php
require_once('config.php');
require_once('lib/db.php');

$add=$_POST["add"];
$name=$_POST["name"];
$link=$_POST["link"];
$limit=$_POST["limit"];
//mysql_query("update header set link='$link' WHERE id=1",$con);

 if(!isset($_POST["link"]))
 {
	echo "hi";
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
         // echo "<script type='text/javascript'> top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
         // $db=null;
         // $db1 = Db::init();
         // $admin1=$db1->prepare("update header set limit=5 WHERE id=1");
         // $admin1->execute();
 }
 else
 {
	$param="update header set link='$link' WHERE id=1";
 }
 echo "hello";
 if(!isset($_POST["limit"]))    
 {	
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
// echo "<script type='text/javascript'>  top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
         
 }  
 else
 {
  echo "hello";
	$param="update header set limit=$limit WHERE id=1";
 } 
 if(!isset($_POST["add"]))    
 {	
 	
 	
         
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
// echo "<script type='text/javascript'>  top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
         
 }  
 else
 {
  echo "hello1";
	$param="insert into administrators VALUES(null,'$add','$name')";
 }
 $db = Db::init();
         $admin=$db->prepare($param);
         $admin->execute();

echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";

?>