<?php
require_once('config.php');
require_once('lib/db.php');

$link=$_POST["link"];
$limit=$_POST['limit'];
$limitno=$_POST['limitno'];
//mysql_query("update header set link='$link' WHERE id=1",$con);

if(isset($link))
{
	$param="update header set link='$link' WHERE id=1";
	
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
         // echo "<script type='text/javascript'> top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
         // $db=null;
         // $db1 = Db::init();
         // $admin1=$db1->prepare("update header set limit=5 WHERE id=1");
         // $admin1->execute();
 }

 if(isset($limt))    
 {	
 	
 	$param="update header set limit=".$limitno." WHERE id=1";
         
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
// echo "<script type='text/javascript'>  top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
         
 }   
 $db = Db::init();
         $admin=$db->prepare($param);
         $admin->execute();
  echo "<script type='text/javascript'> top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";

?>