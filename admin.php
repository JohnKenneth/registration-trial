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

 	echo '<table border="1" width="300" height="300">
		 <tr><th>name</th><th>Address</th><th>Mobile Number</th><th>Email Address</th>
	';
	
 	for($z1=0;$z1<$count;$z1++)
 	{
        
 		echo "<tr>";
        echo "<td>"; echo $z1+1; echo "</td>";
 		echo "<td><a href='https://facebook.com/".$fetched[$z1]['uid']."' target='_blank'>".$fetched[$z1]['name']."</a></td>
			 <td>a".$fetched[$z1]['address']."</td>
			 <td>".$fetched[$z1]['mobno']."</td>
			 <td>".$fetched[$z1]['email']."</td>
		</tr>";

 		//echo "<td>".$fetched[$z]['name']."</td>";
       

 	}

 	echo "</table>";

 }


 function get_admins()
 {
    $db = Db::init();
         $admin=$db->prepare("select uid,name from administrators order by name asc");
         $admin->execute();
         $fetched=$admin->fetchAll();
         $count=$admin->rowCount();


         echo "Administrators";
    echo "</br>";

    echo '<table border="1" width="280">';

    for($z1=0;$z1<$count;$z1++)
    {
        
        echo "<tr>";
        echo "<td>"; echo $z1+1; echo "</td>";
        echo "<td><a href='https://facebook.com/".$fetched[$z1]['uid']."' target='_blank'>".$fetched[$z1]['name']."</a>";
		?>
			  <td><a href="javascript:deleteAdmin('headerChanger.php','<?php echo $fetched[$z1]['uid']; ?>')">DELETE</a></td>
			  </tr>
		<?php
        //echo "<td>".$fetched[$z]['name']."</td>";
       

    }
    echo "</table>";
	
 }

}


?>

