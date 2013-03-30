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

function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
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

$app_namespace = '160936377399430';
    $app_url = 'https://apps.facebook.com/' . $app_namespace . '/';
    $scope = 'email,offline_access,publish_actions,user_likes,user_photos, publish_stream';


$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'status'  => true, // check login status
  'cookie'  => true, // enable cookies to allow the server to access the session
  'oauth'    => true, // enable OAuth 2.0
  'xfbml'    => true,  // parse XFBML
  'sharedSession' => true,
  'trustForwarded' => true
));
  
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
  $likes = idx($facebook->api('/me/likes?limit=4'), 'data', array());

  // This fetches 4 of your friends.
  $friends = idx($facebook->api('/me/friends?limit=4'), 'data', array());

  // And this returns 16 of your photos.
  $photos = idx($facebook->api('/me/photos?limit=16'), 'data', array());

  // Here is an example of a FQL call that fetches all of your friends that are
  // using this app
  $app_using_friends = $facebook->api(array(
    'method' => 'fql.query',
    'query' => 'SELECT uid, name FROM user WHERE uid IN(SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1'
  ));
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

    $('#pheets').click(function()

      {
          $("#phoots").toggle();

      });


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
             
              // logResponse(response);
              
              

          //     // If response is null the user canceled the dialog
                  
          //     if (response != null) {
          //   var user_ids = document.getElementsByName('checkableitems[]');
          //     for(i=0;i<user_ids.length;i++)
          //     {
          //       if(user_ids[i].checked==true)
          //       {
          //         al+=1;
          //       }
          //     }

              
          //     alert("send");
          // }
          // else
          // {
          //   alert("cancel");
          // }
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

    <header class="clearfix">
      <?php if (isset($basic)) { ?>
      <p id="picture" style="background-image: url(https://graph.facebook.com/<?php echo he($user_id); ?>/picture?type=normal)"></p>

      <div>
        <h1>Welcome , <strong><?php echo he(idx($basic, 'name')); ?></strong></h1>
        <p class="tagline">
          This is your app
          <a href="<?php echo he(idx($app_info, 'link'));?>" target="_top"><?php echo he($app_name); ?></a>
        </p>

        <div id="share-app">
          <p>Share your app:</p>
          <ul>
            <li>
              <a href="#" class="facebook-button" id="postToWall" data-url="<?php echo AppInfo::getUrl(); ?>">
                <span class="plus">Post to Wall</span>
              </a>
            </li>
            <li>
              <a href="#" class="facebook-button speech-bubble" id="sendToFriends" data-url="<?php echo AppInfo::getUrl(); ?>">
                <span class="speech-bubble">Send Message</span>
              </a>
            </li>
           <!--  <li>
              <a href="#" class="facebook-button apprequests" id="sendRequest" data-message="Test this awesome app">
                <span class="apprequests">Send Requests</span>
              </a>
            </li> -->
          </ul>
        </div>
      </div>

      <?php } 
      else { 
        if(!$user_id)

    {
        $loginUrl = $facebook->getLoginUrl(array(
        'scope' => $scope,
        'redirect_uri' => $app_url,
        ));

        print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
      }


        ?>
      <!-- <div>
        <h1>Welcome</h1>
        <div class="fb-login-button" data-scope="user_likes,user_photos"></div>
      </div> -->
      <?php } ?>
    </header>

    <!-- dito -->

    <!-- <section id="get-started"> -->
      <!-- <p>Welcome to alpogipogi land, running on <span>heroku</span>!</p> -->
      <?php
      

      try{
         $db = Db::init();
  $sth=$db->prepare("select * from test where uid= ? ");
  $sth->execute(array($user_id));
  $result= $sth->rowCount();

$sth->closeCursor();
  $sql="select * from test ";
 $res=$db->query($sql);
  $result2=$res->rowCount();

  if($result==1)
  {
      $flag=true;
  }
  else
  {
    $flag=false;
  }}
  catch(Exception $e)
  {
    echo "error";
  }

      if(isset($basic))

      {
        ?>
        <div>
          <ul> 
            <li>
              <span>
              <?php
              // echo $facebook->getAccessToken();
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
              $likes = $facebook->api("/me/likes/137303712986482");
            }
            catch(FacebookApiException $s)
            {
              error_log($s);
              $user_id=null;
            }
          }

              if (empty($likes['data']))
              { 
                echo "<li>";
                echo "1. <div class='fb-like' data-href='https://www.facebook.com/CELESTY.SHINAGAWA' data-send='false' data-layout='box_count' data-width='450' data-show-faces='false'></div> this page.";
                echo "</li>";

             echo  "<li>";
         
                echo "<span class='apprequests' >2. SHARE this app to atleast 10 friends  </span>
                </li>"; 

               echo " <li>
                
                    <span> 3. POST</span>
                
                  your photo and share your story.
            </li> ";
            }
            else
            {
              echo "<li>";
              echo "1. <span> You liked<a href='https://www.facebook.com/CELESTY.SHINAGAWA'> CELESTY SHINAGAWA</a> page.</span>";
              echo "</li>";

              if($flag==true)
              {

                echo  "<li>";
                echo "<span  id='ins'>2. SHARED  this app to atleast 10 friends</span> </li>"; 

                echo " <li>
                
                   <a id='pheets' href='#'> <span> 3. POST</span></a>
                
                  your photo and share your story.
            </li> ";
            echo "<li>";
            $access_token=$facebook->getAccessToken();
            $graph_url= "https://graph.facebook.com/me/photos?"
                 . "access_token=" .$access_token;

         

         echo "<div id='phoots'>";
         echo '<form enctype="multipart/form-data" action="'
         .$graph_url .' "method="POST">';
         echo 'Please choose a photo: ';
         echo '<input name="source" type="file"><br/><br/>';
         echo 'Say something about this photo: ';
         echo '<input name="message" 
             type="text" value=""><br/><br/>';
         echo '<input type="submit" value="Upload"/><br/>';
         echo '</form>';
         echo '</div>';

          echo "</li>";
          
              
              }
              else
              {
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
                        data-redirect-uri="http://damp-temple-4190.herokuapp.com/register.php?uid=<?php echo $user_id;   ?>">
                </div>
              </div>
            </div>

            <?php
           
              }

            }
              ?>
              <!-- <a href="https://www.facebook.com/plugins/like.php?api_key=134173260097515&locale=en_US&sdk=joey&channel_url=https%3A%2F%2Fs-static.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D19%23cb%3Df7401f0b4%26origin%3Dhttps%253A%252F%252Fyoung-hamlet-1498.herokuapp.com%252Ff2bc99367c%26domain%3Dyoung-hamlet-1498.herokuapp.com%26relation%3Dparent.parent&href=https%3A%2F%2Fwww.facebook.com%2FCELESTY.SHINAGAWA&node_type=link&width=450&layout=box_count&colorscheme=light&show_faces=false&send=false&extended_social_context=false#"> Like </a> this page -->
            
           <!--  <li>
             <a href="#" class="text" id="sendRequest" data-message="Test this awesome app">
                <span class="apprequests" id="ins">2. SHARE</span> 
              </a>
            this app to atleast 10 friends
            </li> -->
           

        </ul>
       
        <?php
       // try {
   // $likes = $facebook->api("/me/likes/137303712986482");
   // { echo "I like!"; 
      }?>
     


    
</div>
      <?php  ?>
      <!-- <a href="https://www.facebook.com/CELESTY.SHINAGAWA" target="_top" class="text">1.&nbsp<b>LIKE</b></a>&nbspthis page -->
    <!-- </section> -->

                 
  </body>
</html>

