<?php
require_once('config.php');
require_once('lib/db.php');

$link=$_POST["link"];
//mysql_query("update header set link='$link' WHERE id=1",$con);


$db = Db::init();
         $admin=$db->prepare("update header set link='$link' WHERE id=1");
         $admin->execute();
         //echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
         echo "<script type='text/javascript'> top.location.href= 'https://www.facebook.com/TestRegistrationCommunity/app_160936377399430';</script>";
        

?>