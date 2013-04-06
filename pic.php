<?php
     
    require_once 'config.php';
  
 class pic
 {

  function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }

  function pics($access,$u_id)
  {
   
   //         $db = Db::init();
//         $uayd=$db->prepare("SELECT * from registered where uid=?");
//         $uayd->execute(array($u_id));
//         $resu=$uayd->fetch( PDO::FETCH_ASSOC);


//         $res=$db->prepare("SELECT albumid from registered");
//         $res->execute();
//         $row=$res->rowCount();
//         $result=$res->fetchAll();
//          echo "<div id='s2' style='position:relative;'>";

      
//         if($resu['albumid']!=null && $resu['albumid']!="")
//         {
//            $t2=curl_init();
//      $url4='https://graph.facebook.com/'.$resu['albumid'].'?access_token='.$access;
//       curl_setopt($t2, CURLOPT_URL, $url4);
//       curl_setopt($t2, CURLOPT_HEADER, false);
//       curl_setopt($t2, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($t2, CURLOPT_HTTPGET, true);
//      $al3=curl_exec($t2);
//      curl_close($t2);
//      $out2=json_decode($al3,true);

//       $t5=curl_init();
//       $url2='https://graph.facebook.com/'.$resu['albumid'].'?fields=photos.fields(link,source)&access_token='.$access;

//       curl_setopt($t5, CURLOPT_URL, $url2);
//     curl_setopt($t5, CURLOPT_HEADER, false);
//     curl_setopt($t5, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($t5, CURLOPT_HTTPGET, true);
//      $AL=curl_exec($t5);
//      curl_close($t5);
//      $out_user=json_decode($AL,true);


//      for($y=$out2['count']-1;$y>=0;$y--)
//      {
//       echo "<div>";
//       echo "<img src='".$out_user['photos']['data'][$y]['source']."' width='300' height='300'>";

//       echo "</img></br>";

//       echo "<a href='".$out_user['photos']['data'][$y]['link']."' target='_blank'>";
//       echo "Link</a>";
// echo "</div>";
//      }

//         }






//         for($a=0;$a<$row;$a++)
//       {
       
//         if(($result[$a]['albumid']!=null  || $result[$a]['albumid']!="") && $result[$a]['albumid']!=$resu['albumid'])
//         {   
//           // echo "</br>";
//           //  echo $result[$a]['albumid']."</br>";
//               $t1=curl_init();
//      $url3='https://graph.facebook.com/'.$result[$a]['albumid'].'?access_token='.$access;
//       curl_setopt($t1, CURLOPT_URL, $url3);
//       curl_setopt($t1, CURLOPT_HEADER, false);
//       curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($t1, CURLOPT_HTTPGET, true);
//      $al2=curl_exec($t1);
//      curl_close($t1);
//      $out1=json_decode($al2,true);

//       $t=curl_init();
//       $url2='https://graph.facebook.com/'.$result[$a]['albumid'].'?fields=photos.fields(link,source)&access_token='.$access;

//       curl_setopt($t, CURLOPT_URL, $url2);
//     curl_setopt($t, CURLOPT_HEADER, false);
//     curl_setopt($t, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($t, CURLOPT_HTTPGET, true);
//      $AL2=curl_exec($t);
//     curl_close($t);
//      $out=json_decode($AL2,true);

//      if($out1['error'])
//      {
//         continue;
//      }

//      for($z=$out1['count']-1;$z>=0;$z--)
//      {
//       echo "<div>";
//       echo "<img src='".$out['photos']['data'][$z]['source']."' width='300' height='300'>";

//       echo "</img></br>";

//       echo "<a href='".$out['photos']['data'][$z]['link']."' target='_blank'>";
//       echo "Link</a>";
// echo "</div>";
//      }
//         }
//       }

//        echo "</div>";
//       echo "<div>";
//       echo "<a href='#' id='pv'>Prev</a> &nbsp";
//       echo "<a href='#' id='nex'>Next</a>";
//       echo "</div>";
//   }
// $t1=curl_init();
//  //$url3='https://graph.facebook.com/149535045217781'.'?access_token='.$access;
//   $url3='https://graph.facebook.com/149169471921005?fields=feed.fields(picture)'.'&access_token='.$access;
//       curl_setopt($t1, CURLOPT_URL, $url3);
//       curl_setopt($t1, CURLOPT_HEADER, false);
//       curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($t1, CURLOPT_HTTPGET, true);
//      $al2=curl_exec($t1);
//      curl_close($t1);
//      $out1=json_decode($al2,true);

//      echo (count($out1['feed']['data']));



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
     $counter=count($out['feed']['data']);

     $bilang=0;

     echo "<div id='s2' style='position:relative;'>";

      for($z=0;$z<$counter;$z++)
     {
      if(!empty($out['feed']['data'][$z]['picture']))
      {


$t1=curl_init();
 // $url3='https://graph.facebook.com/149535045217781'.'?access_token='.$access;
  $url3='https://graph.facebook.com/'.$out['feed']['data'][$z]['from']['id'].'?fields=picture&access_token='.$access;
      curl_setopt($t1, CURLOPT_URL, $url3);
      curl_setopt($t1, CURLOPT_HEADER, false);
      curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t1, CURLOPT_HTTPGET, true);
     $al2=curl_exec($t1);
     curl_close($t1);
     $out1=json_decode($al2,true);


      $bilang++;
      if($bilang==1)
      {
        echo "<div>";
      }

        echo "<span class='Images'>";
      // echo "<div>";
      echo "<img src='".$out['feed']['data'][$z]['picture']."' width='300' height='300'>";

      echo "</img></br>";

      echo "<span style='display:none;width:580px;height:400px' padding='0'>";
        echo "<img src='".$out1['[picture']['data']['url']."' width='50' height='50'>";
      echo "</img></br>";
         echo "<a href='".$out['feed']['data'][$z]['link']."' target='_blank'>";
      echo "Link</a>";
      echo "</br>";
      echo  $out['feed']['data'][$z]['from']['name'];
      echo "</br>";
      echo  $out['feed']['data'][$z]['created_time'];
        echo "</span>";

        echo "</span>";
        
        if($bilang==3)
        {
          echo "</div>";
          $bilang=0;
        }

      
// echo "</div>";
}


     }
     echo "</div>";
 echo "<div>";
      echo "<a href='#' id='pv'>Prev</a> &nbsp";
      echo "<a href='#' id='nex'>Next</a>";
      echo "</div>";

 }

}
    
?>


