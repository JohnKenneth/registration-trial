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
         $admin=$db->prepare("select uid,name from registered");
         $admin->execute();
         $fetched=$admin->fetchAll();
         $count=$admin->rowCount();
         echo "</br>";
         
 	echo "Registered";
 	echo "</br>";

 	echo '<table border="1" width="300" height="300">';

 	for($z=0;$z<$count;$z++)
 	{
 		echo "<tr>";
 		echo "<td><a href='https://facebook.com/".$fetched[$z]['uid']."' target='_blank'>".$fetched[$z]['name']."</a></td>";

 		//echo "<td>".$fetched[$z]['name']."</td>";
        if($z%2==0)
        {
 		echo "</tr>";
    }
    elseif ($z-1==$count) {
        echo "</tr>";
    }

 	}

 	echo "</table>";

 }

}


?>

