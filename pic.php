<?php
     
    require_once 'config.php';
  
 class pic
 {

  function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }

  function pics($access)
  {
      
        $db = Db::init();
        $res=$db->prepare("SELECT albumid from test");
        $res->execute();
        $row=$res->rowCount();
        $result=$res->fetchAll();
        echo "<div id='s2' style='position:relative;'>";
        for($a=0;$a<$row;$a++)
      {
        if($result[$a]['albumid']!=null || $result[$a]['albumid']!="")
        {   
              $t1=curl_init();
     $url3='https://graph.facebook.com/'.$result[$a]['albumid'].'?access_token='.$access;
      curl_setopt($t1, CURLOPT_URL, $url3);
      curl_setopt($t1, CURLOPT_HEADER, false);
      curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t1, CURLOPT_HTTPGET, true);
     $al2=curl_exec($t1);
     curl_close($t1);
     $out1=json_decode($al2,true);

      $t=curl_init();
      $url2='https://graph.facebook.com/'.$result[$a]['albumid'].'?fields=photos.fields(link,source)&access_token='.$access;

      curl_setopt($t, CURLOPT_URL, $url2);
    curl_setopt($t, CURLOPT_HEADER, false);
    curl_setopt($t, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t, CURLOPT_HTTPGET, true);
     $AL=curl_exec($t);
     curl_close($t);
     $out=json_decode($AL,true);

     for($y=$out1['count']-1;$y>=0;$y--)
     {
      
      echo "<img src='".$out['photos']['data'][$y]['source']."' width='300' height='300'>";

      echo "</img>";
      // echo "<a href='".$out['photos']['data'][$y]['link']."'>";
      // echo "Link</a>";

     }
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


