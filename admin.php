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

 	for($z1=0;$z1<$count;$z1++)
 	{
        
 		echo "<tr>";
        echo "<td>"; echo $z1+1; echo "</td>";
 		echo "<td><a href='https://facebook.com/".$fetched[$z1]['uid']."' target='_blank'>".$fetched[$z1]['name']."</a></td> </tr>";

 		//echo "<td>".$fetched[$z]['name']."</td>";
       

 	}

 	echo "</table>";

 }


 function get_admins()
 {
    $db = Db::init();
         $admin=$db->prepare("select uid,name from administrators");
         $admin->execute();
         $fetched=$admin->fetchAll();
         $count=$admin->rowCount();


         echo "Administrators";
    echo "</br>";

    echo '<table border="1" width="300" height="300">';

    for($z1=0;$z1<$count;$z1++)
    {
        
        echo "<tr>";
        echo "<td>"; echo $z1+1; echo "</td>";
        echo "<td><a href='https://facebook.com/".$fetched[$z1]['uid']."' target='_blank'>".$fetched[$z1]['name']."</a></td> </tr>";

        //echo "<td>".$fetched[$z]['name']."</td>";
       

    }
	
    echo "</table>";
	$access_token=$facebook->getAccessToken();
	$url = 'https://graph.facebook.com/me?fields=friends&access_token='.$access_token;
    
    //print_r($args);
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $data = curl_exec($ch);
	$friends=json_decode($data,true);
    curl_close($ch);
 }

}


?>

