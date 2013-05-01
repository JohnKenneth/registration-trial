<?php
require_once('sdk/src/facebook.php');
    require_once 'config.php';
    require_once('AppInfo.php');
  require_once('utils.php');

class admin
{
function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }


 function get_registered()
 {
 	 $db = Db::init();
         $admin=$db->prepare("select * from registered");
         $admin->execute();
         $fetched=$admin->fetch(PDO::FETCH_ASSOC);
         $count=$admin->rowCount();
         echo $count;
 	echo "<span> Registered</span>";

 	echo "<table border='1'>";

 	for($z=0;$z<$count-1;$z++)
 	{
 		echo "<tr>";
 		echo "<td><a href='https://facebook.com/".$fetched['uid']."' target='_blank'>".$fetched['name']."</a></td>";
 		echo "</tr>";
 	}

 	echo "</table>";

 }

}


?>

