<?php

/**
 * This sample app is provided to kickstart your experience using Facebook's
 * resources for developers.  This sample app provides examples of several
 * key concepts, including authentication, the Graph API, and FQL (Facebook
 * Query Language). Please visit the docs at 'developers.facebook.com/docs'
 * to learn more about the resources available to you
 */

// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'

   require_once('sdk/src/facebook.php');
    require_once 'config.php';
    require_once('AppInfo.php');
  require_once('utils.php');
  require_once('pic.php');
  require_once('admin.php');
 // require_once('pagetoken.php');
 ob_start();


function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }

$app_namespace = '160936377399430';
    $app_url = 'https://apps.facebook.com/' . $app_namespace . '/';
     $app_urlnot = 'http://apps.facebook.com/' . $app_namespace . '/';
    $scope = 'email,manage_pages,photo_upload,read_stream,offline_access,publish_actions,user_likes,user_photos, publish_stream';

    if(strpos($_SERVER['HTTP_REFERER'], 'apps.facebook.com') )
{
  // header('location:https://www.facebook.com/TestRegistrationCommunity/app_160936377399430');
  // exit();
  print("<script> top.location.href='https://www.facebook.com/TestRegistrationCommunity/app_160936377399430'</script>");
}

// Enforce https on production

if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}



// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');


/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/

require_once('sdk/src/facebook.php');




$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'status'  => true, // check login status
  'cookie'  => true, // enable cookies to allow the server to access the session
  'oauth'    => true, // enable OAuth 2.0
  'xfbml'    => true,  // parse XFBML
  'sharedSession' => true,
  'trustForwarded' => true,
  'fileUpload' => true
));
$facebook->setFileUploadSupport(true);
  
$user_id = $facebook->getUser();

if ($user_id) {
  try {
    // Fetch the viewer's basic information
    $basic = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    // If the call fails we check if we still have a user. The user will be
    // cleared if the error is because of an invalid accesstoken
    if (!$facebook->getUser()) {
      header('Location: '. AppInfo::getUrl($_SERVER['REQUEST_URI']));
      exit();
    }
  }

  // This fetches some things that you like . 'limit=*" only returns * values.
  // To see the format of the data you are retrieving, use the "Graph API
  // Explorer" which is at https://developers.facebook.com/tools/explorer/
  // $likes = idx($facebook->api('/me/likes?limit=4'), 'data', array());

  // This fetches 4 of your friends.
  // $friends = idx($facebook->api('/me/friends?limit=4'), 'data', array());

  // And this returns 16 of your photos.
  // $photos = idx($facebook->api('/me/photos?limit=16'), 'data', array());

  // Here is an example of a FQL call that fetches all of your friends that are
  // using this app
  // $app_using_friends = $facebook->api(array(
  //   'method' => 'fql.query',
  //   'query' => 'SELECT uid, name FROM user WHERE uid IN(SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1'
  // ));
}


// Fetch the basic info of the app that they are using
$app_info = $facebook->api('/'. AppInfo::appID());

$app_name = idx($app_info, 'name', '');

 
  


?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

    <title><?php echo he($app_name); ?></title>
    <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
    <link rel="stylesheet" href="stylesheets/ken.css" media="Screen" type="text/css" />
    <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />

    <!--[if IEMobile]>
    <link rel="stylesheet" href="mobile.css" media="screen" type="text/css"  />
    <![endif]-->

    <!-- These are Open Graph tags.  They add meta data to your  -->
    <!-- site that facebook uses when your content is shared     -->
    <!-- over facebook.  You should fill these tags in with      -->
    <!-- your data.  To learn more about Open Graph, visit       -->
    <!-- 'https://developers.facebook.com/docs/opengraph/'       -->
    <meta property="og:title" content="<?php echo he($app_name); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo AppInfo::getUrl(); ?>" />
    <meta property="og:image" content="<?php echo AppInfo::getUrl('/logo.png'); ?>" />
    <meta property="og:site_name" content="<?php echo he($app_name); ?>" />
    <meta property="og:description" content="My first app" />
    <meta property="fb:app_id" content="<?php echo AppInfo::appID(); ?>" />

    <script type="text/javascript" src="/javascript/jquery-1.7.1.min.js"></script>
      <script type="text/javascript" src="/javascript/test.js"></script>


       <script type="text/javascript" src="/javascript/jquery.cycle.all.js"></script>

    <script type="text/javascript">
      function logResponse(response) {
        if (console && console.log) {
          console.log('The response was', response);
        }
      }
  $(document).ready(function()

    {
      $("#cont").hide();
       $("#fai").hide();
       $("#phoots").hide();         
    });
//here
// $(document).ready(init);
  
//   function init() {
    
//     $('.Images').hover(
//       function(){ 
//         on(this);
//       },
//       function(){
//         off(this);
//       }
//     );
//   }
  //end
  //here kenneth
  var caption1;
  $(document).ready(init);
  
  function init() {
    $("#cycle").cycle();
    $("#cycleheader").cycle({
      fx:     'fade', 
      speed:   300, 
      timeout: 0, 
      next:   '#cycleheader',
      after:  onAfter,
    });
    
    $('.Images').hover(
      function(){ 
        on(this);
      },
      function(){
        off(this);
      }
    );
    $('#demo4').click(function() { 
      $.blockUI({ 
        message: $('#tallContent'), 
        css: { top: '20%' } 
      }); 
      $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
    });
  $("#save").click(function(){
    
    alert(caption1);
  });
  }
  
  function postwith (to) {
    var myForm = document.createElement("form");
    myForm.method="post" ;
    myForm.action = to ;
    var myInput = document.createElement("input");
    myInput.setAttribute("name", "link") ;
    myInput.setAttribute("value", caption1);
    myForm.appendChild(myInput) ;
    document.body.appendChild(myForm) ;
    myForm.submit() ;
    document.body.removeChild(myForm) ;
  }
  
  function onAfter(curr,next,opts) {
    caption1 = next.src;
  }

//end 
  
    
    function on(hovered){
    $('img',hovered ).fadeOut(50,function(){
      $('div',hovered ).fadeTo(500, 1);
    });
    }
    
    function off(hovered){
    $('div', hovered ).fadeOut(50,function(){
      $('img',hovered ).fadeTo(500, 1);
    });
    }

      $(function(){
      
        // Set up so we handle click on the buttons
        $('#postToWall').click(function() {
          FB.ui(
            {
              method : 'feed',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog
              if (response != null) {
                logResponse(response);
              }
            }
          );
        });

        $('#sendToFriends').click(function() {

          FB.ui(
            {
              method : 'send',
              link   : $(this).attr('data-url')
            },
            function (response) {
              // If response is null the user canceled the dialog

              if (response != null) {
                 
                  logResponse(response);
              }
            }
          );
        });


$('#s2').cycle({ 
    fx:     'curtainX', 
    speed:  'fast', 
    timeout: 0,
     delay: -2000 , 
    next:   '#nex', 
    prev:   '#pv' 
      });

    $('#pheets').click(function()

      {
          top.location.href= 'https://www.facebook.com/TestRegistrationCommunity';

      });

 // $('#pheets').click(function()

 //      {
 //         $('#phoots').toggle();

 //      });


        $('#sendRequest').click(function() {
         
          FB.ui(
            {
              method  : 'apprequests',
              message : $(this).attr('data-message')
            }
            ,
            // ,
            function (response) {
                
              if(response!=null)
              {
                 var al=response.to;
                 if(al.length>=10)
                 {
                    
                    $("#cont").show();
                    $("#fai").hide();
                 }
                 else
                 {
                  $("#cont").hide();
                  $("#fai").show();
                 
                 }
            
              }
              else
              {
                $("$cont").hide();
              }
             
             
            }
          );
        });
      });

 
    </script>
 
   

  

    <!--[if IE]>
      <script type="text/javascript">
        var tags = ['header', 'section'];
        while(tags.length)
          document.createElement(tags.pop());
      </script>
    <![endif]-->
  </head>
  <body>
    <div id="fb-root"></div>
    <script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo AppInfo::appID(); ?>', // App ID
          channelUrl : '//<?php echo $_SERVER["HTTP_HOST"]; ?>/channel.html', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true // parse XFBML
        });

        // Listen to the auth.login which will be called when the user logs in
        // using the Login button
        FB.Event.subscribe('auth.login', function(response) {
          // We want to reload the page now so PHP can read the cookie that the
          // Javascript SDK sat. But we don't want to use
          // window.location.reload() because if this is in a canvas there was a
          // post made to this page and a reload will trigger a message to the
          // user asking if they want to send data again.
          window.location = window.location;
        });

        FB.Canvas.setAutoGrow();
        FB.Event.subscribe('edge.create', function(response) {
      // A user liked the item, read the response and handle
          window.location = window.location;
    });
      };

      // Load the SDK Asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- <header class="clearfix"> -->
      <?php
        if(isset($basic))
        {
          // echo "Share your stories";
        
        }
        else
        {
           if(!$user_id)

    {
        $loginUrl = $facebook->getLoginUrl(array(
        'scope' => $scope,
        'redirect_uri' => $app_url
        ));

        print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
      }

        }

      ?>
      
     <!--  <?php //if (isset($basic)) { 
        ?>
 -->  <!--     <p id="picture" style="background-image: url(https://graph.facebook.com/<?php //echo he($user_id); ?>/picture?type=normal)"></p>
hear
      <div>
        <h1>Welcome , <strong><?php //echo he(idx($basic, 'name')); ?></strong></h1>
        <p class="tagline">
          Application
          <a href="<?php //echo he(idx($app_info, 'link'));?>" target="_top"><?php //echo he($app_name); ?></a>
        </p>

        <div id="share-app">
          <p>Share your app:</p>
          <ul>
            <li>
              <a href="#" class="facebook-button" id="postToWall" data-url="<?php //echo AppInfo::getUrl(); ?>">
                <span class="plus">Post to Wall</span>
              </a>
            </li>
            <li>
              <a href="#" class="facebook-button speech-bubble" id="sendToFriends" data-url="<?php //echo AppInfo::getUrl(); ?>">
                <span class="speech-bubble">Send Message</span>
              </a>
            </li>
            till hear -->
           <!--  <li>
              <a href="#" class="facebook-button apprequests" id="sendRequest" data-message="Test this awesome app">
                <span class="apprequests">Send Requests</span>
              </a>
            </li>
          </ul>
        </div>
      </div> -->

     <!--  <?php 
      //} 
    //   else { 
    //     if(!$user_id)

    // {
    //     $loginUrl = $facebook->getLoginUrl(array(
    //     'scope' => $scope,
    //     'redirect_uri' => $app_url
    //     ));

    //     print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
    //   }


    //    }
      ?> -->
      <!-- <div>
        <h1>Welcome</h1>
        <div class="fb-login-button" data-scope="user_likes,user_photos"></div>
      </div> -->
    
    <!-- </header> -->
 
   <!--here-->
    <div id="get-started" style="background:url(<?php echo $header['link'];?>)">
  
    </div>
  
<!--end-->
   <!--  <div>
  <section id='get-started'>
  </div> -->
     <?php
     $db = Db::init();
         $admin=$db->prepare("select * from administrators where uid= ? ");
         $admin->execute(array($user_id));
           $id_admin=$admin->rowCount();
if($id_admin==1)
{
  ?>
 <div>
  <span><a href='#' onclick="showTab('tab1');return false;"> View the app</a></span>
  </div>
            <div>
  <span><a href='#' onclick='showTab("tab2");return false;'> Administrator</a></span>
  </div>
  <?php
}
      ?>
    <!-- dito -->

    <!-- <section id="get-started"> -->
      <!-- <p>Welcome to alpogipogi land, running on <span>heroku</span>!</p> -->
     

      <?php
      $access_token=$facebook->getAccessToken();

      // $pagetoken=new pagetoken();
      // $tokenpage=$pagetoken->get_page_token($access_token,$facebook->getUser());

            if(isset($_POST['submit']) && isset($basic))
        {
          
          
            

           $file=realpath($_FILES['source']['tmp_name']);
    $limit=$_FILES['source']['size'];


       //   $album_name = 'Test Registration';
       // $album_description = 'Test reg';
 //    echo $_POST['message'];

 // echo "</br>";
 // echo basename($file);
 // echo "</br>";
 // echo realpath($file);
if($limit<=3145728)
{
  //create new album
        // $db = Db::init();
        // $album=$db->prepare("select * from registered where uid= ? ");
        // $album->execute(array($user_id));
        //   $data_album=$album->fetch(PDO::FETCH_ASSOC);
        
         //begiining

    //        if($data_album['albumid']==null || $data_album['albumid']=="")
    //        {
    //       $graph_url = "https://graph.facebook.com/".$user_id."/albums?"
    //      . "access_token=". $access_token;
   
    //      $postdata = http_build_query(
    //      array(
    //       'name' => $album_name,
    //       'message' => $album_description
    //         )
    //       );
    //      $opts = array('http' =>
    //      array(
    //       'method'=> 'POST',
    //       'header'=>
    //         'Content-type: application/x-www-form-urlencoded',
    //       'content' => $postdata
    //       )
    //      );
    //      $context  = stream_context_create($opts);
    //      $result = json_decode(file_get_contents($graph_url, false, 
    //        $context));

    //      // Get the new album ID
    //        $album_id = $result->id;

    //         $album=$db->prepare ("update registered set albumid=?  where uid= ?");
    //         $album->execute(array($album_id,$user_id));


    //          $t1=curl_init();
    //  $url3='https://graph.facebook.com/'.$album_id.'?access_token='.$access_token;
    //   curl_setopt($t1, CURLOPT_URL, $url3);
    // curl_setopt($t1, CURLOPT_HEADER, false);
    // curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($t1, CURLOPT_HTTPGET, true);
    //  $al2=curl_exec($t1);
    //  curl_close($t1);
    //  $out1=json_decode($al2,true);

    //       }
    //       else
    //       {
    //         // $ei=$db->prepare("select albumid from test where uid=?");
    //         // $ei->execute(array($user_id));
    //         // $album_id_f=$ei->fetch(PDO::FETCH_ASSOC);
    //         $album_id=$data_album['albumid']; 

    //           $t1=curl_init();
    //  $url3='https://graph.facebook.com/'.$album_id.'?access_token='.$access_token;
    //   curl_setopt($t1, CURLOPT_URL, $url3);
    // curl_setopt($t1, CURLOPT_HEADER, false);
    // curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($t1, CURLOPT_HTTPGET, true);
    //  $al2=curl_exec($t1);
    //  curl_close($t1);
    //  $out1=json_decode($al2,true);

    //  if($out1['count']==0)
    //  {
    //      $graph_url = "https://graph.facebook.com/".$user_id."/albums?"
    //      . "access_token=". $access_token;
   
    //      $postdata = http_build_query(
    //      array(
    //       'name' => $album_name,
    //       'message' => $album_description
    //         )
    //       );
    //      $opts = array('http' =>
    //      array(
    //       'method'=> 'POST',
    //       'header'=>
    //         'Content-type: application/x-www-form-urlencoded',
    //       'content' => $postdata
    //       )
    //      );
    //      $context  = stream_context_create($opts);
    //      $result = json_decode(file_get_contents($graph_url, false, 
    //        $context));

    //      // Get the new album ID
    //        $album_id = $result->id;

    //         $album=$db->prepare ("update registered set albumid=?  where uid= ?");
    //         $album->execute(array($album_id,$user_id));
    //  }

    //       }
          //ending
     


    $args = array(
      'image' => '@'.$file,
    'message' => $_POST['message']
    );
   //$args[basename($file)] = '@' . $file;
    //$url = 'https://graph.facebook.com/149169471921005/feed?access_token='.$access_token;
    $url = 'https://graph.facebook.com/149535045217781?access_token='.$access_token;
    
    //print_r($args);
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    $data = curl_exec($ch);
    curl_close($ch);
     //  if($data)
     //  {
     //   header('location:https://apps.facebook.com/160936377399430/');
     // }
     // else
     // {
     //  echo "error";
     // }
    //mblmit = 3145728
    if($data)
    {
     
     $flag2=true;
      // echo "<img src='https://facebook.com/photo.php?fbid=".$data['id']."'>";
      // echo"</img>";
    //   $user_profile = $facebook->api('/'.$album_id.'/photos', array('access_token' => $access_token));
    // echo (count($user_profile));

    //   $t=curl_init();
    //   $url2='https://graph.facebook.com/'.$album_id.'?fields=photos.fields(link,source)&access_token='.$access_token;

    //   curl_setopt($t, CURLOPT_URL, $url2);
    // curl_setopt($t, CURLOPT_HEADER, false);
    // curl_setopt($t, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($t, CURLOPT_HTTPGET, true);
    //  $AL=curl_exec($t);
    //  curl_close($t);
    //  $out=json_decode($AL,true);


    

     // echo $out1['count'];
     // echo "</br>";
       
    // for($x=0;$x<$out1['count'];$x++)
    // {
    //   //echo "</br>";
    //   echo "<a href='".$out['photos']['data'][$x]['link']."'>";
    //   echo "<img src='".$out['photos']['data'][$x]['source']."' width='300' height='300'>";
    //   echo "</img>";
    //   echo "</a>";
   

    // }
    
    
    
  
    }
    else
    {
      echo "Error while uploading";
      // header( "refresh:1;url=https://apps.facebook.com/160936377399430/");

    }
  }
  else
  {
    echo "File is too large or file si not supported";
  }
}
      
      // if(!empty($_POST['submit']))
      // {
      //   header("location:https://apps.facebook.com/160936377399430/");
      // }

      try{
         $db = Db::init();
  $sth=$db->prepare("select * from registered where uid= ? ");
  $sth->execute(array($user_id));
  $result= $sth->rowCount();

$sth->closeCursor();
  $sql="select * from registered ";
 $res=$db->query($sql);
  $result2=$res->rowCount();



  if($result==1)
  {
      $flag=true;
  }
  else
  {
    $flag=false;
  }
}
  catch(Exception $e)
  {
    echo "error";
  }



      if(isset($basic))

   {
  
        
        ?>
        <div style="display: block;" id='tab1'>
        <div>
          <ul> 
            <li>
              <span>
              <?php
              // echo $facebook->getAccessToken();
              echo "</br>";
              if($flag2)
            {
              echo "Uploaded Successfully </br>";  

             }
                          
            if($flag)
              {

               
                if($result2==1)
                {
                  echo "You are registered.";
                  
                }
                else
                {
                  echo "You and ";
                echo ($result2-1);
                echo " people are registered.";
                echo  "</br>";
                
                
               }
              }
              else
              {
                echo $result2;
                echo " people are registered.";
              }
                
              ?>
            
            </span>
            </li>
              <?php
              if($user_id)
              {
              try{
              // $likes = $facebook->api("/me/likes/137303712986482");
            $likes = $facebook->api("/me/likes/149169471921005");

                
            }
            catch(FacebookApiException $s)
            {
              error_log($s);
              $user_id=null;
            }
          }

              if (empty($likes['data']))
              { 

                 if($flag==true)
            {
              echo "<li>";
              echo "<span> You are register but did not like the fan page. Kindly Like the page to post your photo";
              // echo AppInfo::getUrl();
              // echo "</br>";
              // echo 'https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
              echo "</li>";

            }

            else
            {
                echo "<li>";
                //echo "1. <div class='fb-like' data-href='https://www.facebook.com/CELESTY.SHINAGAWA' data-send='false' data-layout='box_count' data-width='450' data-show-faces='false'></div> this page.";
                 echo "1. Like the page (Theres a like button in your upper side) ";
                echo "</li>";

             echo  "<li>";
         
                echo "<span class='apprequests' >2. SHARE this app to atleast 10 friends  </span>
                </li>"; 

               echo " <li>
                
                    <span> 3. POST</span>
                
                  your photo and share your story.
            </li> ";
          }
            }

            else
            {
              // echo "<li>";
              // echo "1. <span> You liked<a href='https://www.facebook.com/TestRegistrationCommunity' target='_blank'> Test Registration </a> page.</span>";
              // echo "</li>";

              if($flag==true)
              {

            //     echo  "<li>";
            //     echo "<span  id='ins'>2. SHARED  this app to atleast 10 friends</span> </li>"; 

            //     echo " <li>
                
            //        <a id='pheets' href='#'> <span> 3. POST</span></a>
                
            //       your photo and share your story.
            // </li> ";

 
    
           
    // $photos->pics($tokenpage,$user_id);

  
                 
                echo "<li>";
                echo " You can now upload your photos.";
                echo "</li>";
           
               
              // echo "<li>";

             echo " <li>
                
                   <a  id='pheets'  href='#'> <span> POST</span></a>
                
                  your photo and share your story.
            </li> ";

           
           // $graph_url=$_SERVER['PHP_SELF'];
         //       $graph_url='https://damp-temple-4190.herokuapp.com/index.php';
         

         // echo "<div id='phoots'>";
         // echo '<form  enctype="multipart/form-data" action="'
         // .$graph_url .' "method="POST">';
         // echo 'Please choose a photo: ';
         // echo '<input name="source" type="file"><br/><br/>';
         // echo 'Say something about this photo: ';
         // echo '<input name="message" 
         //     type="text" value=""><br/><br/>';
         // echo '<input type="submit" value="Upload" name="submit"/><br/>';
         // echo '</form>';
         // echo '</div>';

         //  echo "</li>";

           $photos= new pic();
            $photos->pics_registered($facebook->getAccessToken(),$user_id);
            
              
              }

              else
              {
                echo "<li>";
              echo "1. <span> You liked<a href='https://www.facebook.com/TestRegistrationCommunity' target='_blank'> Test Registration </a> page.</span>";
              echo "</li>";

                 echo  "<li>";
             echo "<a href='#'' class='text' id='sendRequest' data-message='Test this awesome app'>";
                echo "<span class='apprequests' id='ins'>2. SHARE</span>  </a>  this app to atleast 10 friends.  <span id='fai'> (Shared should atleast 10).</span> </li>"; 

                echo " <li>
                
                    <span> 3. POST</span>
                
                  your photo and share your story.
            </li> ";

            ?>
               <div id="cont">
                <h1>Registration</h1>
                 
                <div style="float: left; margin-right: 15px;">
                     
                    <div class="fb-registration"
                        data-fields='[{"name":"name"},
                                        {"name":"mobileno","description":"Mobile No.","type":"text"},
                                         {"name":"address","description":"Address","type":"text"},
                                          {"name":"email"},
                                          {"name":"birthday"}
                                           ]' 
                        data-redirect-uri="https://damp-temple-4190.herokuapp.com/register.php?uid=<?php echo $user_id;   ?>">

                </div>
              </div>
            </div>

            <?php
           
              }

            }
        
  }

              ?>
      

        </ul>
       

    
</div>
</div>
<?php
  if($id_admin==1)
  {
    echo "<div style='display: none;' id='tab2'>";
    echo "<div>";

      
      $url = 'https://graph.facebook.com/304176206390501?fields=photos.fields(link,source)&access_token='.$access_token;
      $ch = curl_init();
  
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPGET, true);
      $response = curl_exec($ch);
      $out1=json_decode($response,true);
      curl_close($ch);
      echo "<div id='cycleheader'>";
      for($x=count($out1['photos']['data'])-1;$x>=0;$x--)
      {
        echo "<img src='".$out1['photos']['data'][$x]['source']."' width='300' height='300'/>";
      }
      echo "</div>";
    
    echo '<a href="javascript:postwith("headerChanger.php")"><button>SAVE</button></a>';
    echo "</div>";
    echo "<div>";
    $display_admin=new admin();
    $display_admin->get_registered();
    echo "</div>";


    echo "</div>";
    
  }
?>

      
      <!-- <a href="https://www.facebook.com/CELESTY.SHINAGAWA" target="_top" class="text">1.&nbsp<b>LIKE</b></a>&nbspthis page -->
    <!-- </section> -->

                 
  </body>
</html>

