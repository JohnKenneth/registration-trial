<?php
     
    require_once 'config.php';
	ob_start();
  
 class pic
 {

  function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }

  function pics($access,$u_id)
  {
   

    $t5=curl_init();
      //$url2='https://graph.facebook.com/149535045217781'.'?fields=photos.fields(link,source)&access_token='.$access;
    $url2='https://graph.facebook.com/149169471921005?fields=feed.fields(link,picture,from,created_time)&access_token='.$access;

      curl_setopt($t5, CURLOPT_URL, $url2);
    curl_setopt($t5, CURLOPT_HEADER, false);
    curl_setopt($t5, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t5, CURLOPT_HTTPGET, true);
     $AL=curl_exec($t5);
     curl_close($t5);
     $out=json_decode($AL,true);
     $counter2=count($out['feed']['data']);

     $bilang=0;
     $counter=0;

     echo "<div id='s2' style='position:relative;'>";

echo "<table><tr>";
      for($z=0;$z<$counter2-1;$z++)
     {
      if(!empty($out['feed']['data'][$z]['picture']))
      {
 echo "<td width='265px' height='200px'>";
        echo "<div class='Images'>";
      // echo "<div>";
      echo "<img src='".$out['feed']['data'][$z]['picture']."' width='200px' height='200px'>";
      echo "</img>";
      echo "<div style='display:none;width:200px;height:200px' padding='0'>";
     // echo '<p id="picture" style="background-image: url(https://graph.facebook.com/'. $out['feed']['data'][$z]['id']; .'/picture?type=normal)"></p>';
      //   echo "<img src='".$out1['[picture']['data']['url']."' width='50' height='50'>";
      // echo "</img></br>";
         echo "<a href='".$out['feed']['data'][$z]['link']."' target='_blank'>";
          echo "<span>Source</span></a>";
         echo "</br>";
          echo  "Submitted by: <span>".$out['feed']['data'][$z]['from']['name']."</span>";
          echo "</br>";
          $date=$out['feed']['data'][$z]['created_time'];
          // echo  "Date Submitted:</br>".$out['feed']['data'][$z]['created_time'];
          echo  "Date Submitted: ".self::dates(substr($date, 0,10));
      echo "</div>";
        echo "</div>";
        echo "</td>";
      $counter+=1;
        if($counter==4)
        {
          echo "</tr></table>";
           echo "<table><tr>";
          $counter=0;
        }
        elseif($counter%2==0)
        {
          echo "</tr><tr>";
        }
      }
     }
    echo "</tr></table>";
      echo "</div>";

       echo "<center>";
       echo "</br>";
      echo "<div>";
      echo "<a href='#' id='pv'>Prev</a> &nbsp";
      echo "<a href='#' id='nex'>Next</a>";
      echo "</div>";
      echo "</center>";




 }


 function dates($parameter)
 {
  $date_arr=split("-", $parameter);

  switch ($date_arr[1]) {
    case 1:
      $month='January';
      break;
    case 2:
      $month='February';
      break;
    case 3:
      $month='March';
      break;
    case 4:
      $month='April';
      break;
    case 5:
      $month='May';
      break;
    case 6:
      $month='June';
      break;
    case 7:
      $month='July';
      break;
    case 8:
      $month='August';
      break;
    case 9:
      $month='September';
      break;
    case 10:
      $month='October';
      break;
    case 11:
      $month='November';
      break;
    case 12:
      $month='December';
      break;
    default:
      $month="";
      break;
  }

  return $month."/".$date_arr[2]."/".$date_arr[0];

 }

 function pics_registered($access,$u_id)
 {
  $db = Db::init();
  $sth=$db->prepare("select uid from registered ");
  $sth->execute(array($user_id));
 $register=$sth->fetchall();

$t5=curl_init();
      //$url2='https://graph.facebook.com/149535045217781'.'?fields=photos.fields(link,source)&access_token='.$access;
    $url2='https://graph.facebook.com/149169471921005/feed?fields=link,picture,from,created_time&limit=0&access_token='.$access;

      curl_setopt($t5, CURLOPT_URL, $url2);
    curl_setopt($t5, CURLOPT_HEADER, false);
    curl_setopt($t5, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t5, CURLOPT_HTTPGET, true);
     $AL=curl_exec($t5);
     curl_close($t5);
     $out=json_decode($AL,true);
     $counter2=count($out['feed']['data']);

     $bilang=0;
     $counter=0;

     echo "<div id='s2' style='position:relative;'>";

echo "<table><tr>";
      for($z=0;$z<$counter2;$z++)
     {
      for($alpogi=0;$alpogi<count($register);$alpogi++)
      {
        if($register[$alpogi]['uid']==$out['feed']['data'][$z]['from']['id'])
        {
          $larawan=true;
          break;
        }
        else
        {
          $larawan=false;
        }
      }
      if(!empty($out['feed']['data'][$z]['picture']) && $larawan==true)
      {
 echo "<td width='265px' height='200px' class='ken'>";
        echo "<div class='Images'>";
      // echo "<div>";
      echo "<img src='".$out['feed']['data'][$z]['picture']."' width='200px' height='200px'>";
      echo "</img>";
      echo "<div style='display:none;width:200px;height:200px' padding='0'>";
     // echo '<p id="picture" style="background-image: url(https://graph.facebook.com/'. $out['feed']['data'][$z]['id']; .'/picture?type=normal)"></p>';
      //   echo "<img src='".$out1['[picture']['data']['url']."' width='50' height='50'>";
      // echo "</img></br>";
         echo "<a href='".$out['feed']['data'][$z]['link']."' target='_blank'>";
          echo "<span>Source</span></a>";
         echo "</br>";
          echo  "Submitted by: <span>".$out['feed']['data'][$z]['from']['name']."</span>";
          echo "</br>";
          $date=$out['feed']['data'][$z]['created_time'];
          // echo  "Date Submitted:</br>".$out['feed']['data'][$z]['created_time'];
          echo  "Date Submitted: ".self::dates(substr($date, 0,10));
      echo "</div>";
        echo "</div>";
        echo "</td>";
      $counter+=1;
        if($counter==4)
        {
          echo "</tr></table>";
           echo "<table><tr>";
          $counter=0;
        }
        elseif($counter%2==0)
        {
          echo "</tr><tr>";
        }
      }
     }
    echo "</tr></table>";
      echo "</div>";

       echo "<center>";
       echo "</br>";
      echo "<div>";
      echo "<a href='#' id='pv'>Prev</a> &nbsp";
      echo "<a href='#' id='nex'>Next</a>";
      echo "</div>";
      echo "</center>";



 }



}
    
?>


