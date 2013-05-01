<?php
include("include.php");
$link=$_POST["link"];
mysql_query("update header set link='$link' WHERE id=1",$con);
echo "<script type='text/javascript'>window.location='https://damp-temple-4190.herokuapp.com/index.php';</script>";
?>