<?php
require_once('sdk/src/facebook.php');
    require_once 'config.php';
    require_once('AppInfo.php');
  require_once('utils.php');
?>
<?
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
         $fetched=$admin->fetchAll();
         $count=$admin->rowCount();
         echo "</br>";
         
 	echo "Registered";
 	echo "</br>";

 	$kenneth=0;
	$net=10;
	echo "<div id='regpagination' style='width:700px !important;'>";
 	for($z2=0;$z2<=($count/$net);$z2++)
 	{
		echo '<table border="1" width="700px" height="300">
			<tr><th>No.</th><th>Name</th><th>Address</th><th>Mobile Number</th><th>Email Address</th><th>Birthday</th>
		';
		//$x = ($kenneth == ($count/$net)) ? ($count%$net): $net;
        for($z1=0;$z1<$net;$z1++)
		{
			$an=($net*$kenneth)+$z1;
			echo "<tr>";
			echo "<td>"; echo $an+1; echo "</td>";
			echo "<td width='200px'><a href='https://facebook.com/".$fetched[$an]['uid']."' target='_blank'>".$fetched[$an]['name']."</a></td>
				<td width='140px'>".$fetched[$an]['address']."</td>
				<td>".$fetched[$an]['mobno']."</td>
				<td>".$fetched[$an]['email']."</td>
				<td width='140px'>".$fetched[$an]['bday']."</td>
			</tr>";
		}
 		//echo "<td>".$fetched[$z]['name']."</td>";
		$kenneth++;
		echo "</table>";

 	}

 	echo "</div>";
	
    echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<a href='#' id='rpv'>Prev</a> &nbsp;&nbsp;&nbsp;";
    echo "<a href='#' id='rnex'>Next</a>";
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

