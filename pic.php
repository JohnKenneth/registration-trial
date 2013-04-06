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

      echo "</img></br>";

      echo "<div style='display:none;width:200px;height:200px' padding='0'>";
     // echo '<p id="picture" style="background-image: url(https://graph.facebook.com/'. $out['feed']['data'][$z]['id']; .'/picture?type=normal)"></p>';
      //   echo "<img src='".$out1['[picture']['data']['url']."' width='50' height='50'>";
      // echo "</img></br>";
         echo "<a href='".$out['feed']['data'][$z]['link']."' target='_blank'>";
          echo "<span>Source</span></a>";
         echo "</br>";
          echo  $out['feed']['data'][$z]['from']['name'];
          echo "</br>";
           echo  $out['feed']['data'][$z]['created_time'];
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
      echo "<div>";
      echo "<a href='#' id='pv'>Prev</a> &nbsp";
      echo "<a href='#' id='nex'>Next</a>";
      echo "</div>";
      echo "</center>";

 }

}
    
?>


