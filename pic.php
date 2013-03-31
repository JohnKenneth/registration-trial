<?php

 require_once('sdk/src/facebook.php');
  require_once('AppInfo.php');
  require_once('utils.php');

    
     $facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'status'  => true, // check login status
  'cookie'  => true, // enable cookies to allow the server to access the session
  'sharedSession' => true,
  'trustForwarded' => true
 
));
     

     $access_token=$facebook->getAccessToken();
    
    $user=$facebook->getUser();


    
      // $graph_url= "https://graph.facebook.com/".$user."/photos?"
      //    . "access_token=" .$access_token."&callback=foo";
      //   echo "al ".$_REQUEST['foo'];
       //Obtain the access_token with publish_stream permission 
       // if(empty($code)){ 
       //    $dialog_url= "http://www.facebook.com/dialog/oauth?"
       //     . "client_id=" .  $facebook->getAppId();
       //     . "&redirect_uri=" . urlencode( $post_login_url)
       //     .  "&scope=publish_stream";
       //    echo("<script>top.location.href='" . $dialog_url 
       //    . "'</script>");
       //   }
       //  else {
     //      $token_url="https://graph.facebook.com/oauth/access_token?"
     //       . "client_id=" . $facebook->getAppId();
		   // . "&redirect_uri=" . urlencode( $post_login_url)
     //       . "&client_secret=" . $facebook->getAppSecret();
     //       . "&code=" . $code;
     //      $response = file_get_contents($token_url);
     //      $params = null;
     //      parse_str($response, $params);
     //      $access_token = $params['access_token'];

     //     // Show photo upload form to user and post to the Graph URL
     //     $graph_url= "https://graph.facebook.com/me/photos?"
     //     . "access_token=" .$access_token;

     //     echo '<html><body>';
     //     echo '<form enctype="multipart/form-data" action="'
     //     .$graph_url .' "method="POST">';
     //     echo 'Please choose a photo: ';
     //     echo '<input name="source" type="file"><br/><br/>';
     //     echo 'Say something about this photo: ';
     //     echo '<input name="message" 
     //         type="text" value=""><br/><br/>';
     //     echo '<input type="submit" value="Upload"/><br/>';
     //     echo '</form>';
     //     echo '</body></html>';
      // }
    $file=$_FILES['source']['tmp_name'];
 //    echo $_POST['message'];

 // echo "</br>";
 // echo basename($file);
 // echo "</br>";
 // echo realpath($file);

    $args = array(
      'source' => '@'.$file,
    'message' => $_POST['message']
    );
   //$args[basename($file)] = '@' . $file;
    $url = 'https://graph.facebook.com/'.$user.'/photos?access_token='.$access_token;
    //print_r($args);
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    $data = curl_exec($ch);
     //  if($data)
     //  {
     //   header('location:https://apps.facebook.com/160936377399430/');
     // }
     // else
     // {
     //  echo "error";
     // }
    print_r(json_decode($data,true));
    
?>


