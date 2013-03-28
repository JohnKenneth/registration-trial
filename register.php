<?php
     

     require_once('sdk/src/facebook.php');
    require_once 'config.php';
    require_once('AppInfo.php');
	require_once('utils.php');
     
     $uid=$_GET['uid'];
  
    function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }
     
   $facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'status'  => true, // check login status
  'cookie'  => true, // enable cookies to allow the server to access the session
  'sharedSession' => true,
  'trustForwarded' => true
 
));
     
    

     $request = $facebook->getSignedRequest();
    $user_id=$facebook->getuser();
     // echo  $user_id;
    //   if(!$db)
    //     echo "error";
    //   else
    //     echo "connecter";
    // echo '<pre>';
    // print_r($request);
    // echo '</pre>';

     if($user_id==0 and $uid!=0 or $user_id==$uid)
     {
     if ($request)
    {
        $register = $request['registration'];

         
        try {
                $b_array=explode("/", $register['birthday']);
                $biday=$b_array[2].'/'.$b_array[0].'/'.$b_array[1];
               

                // if(is_numeric($register['mobileno']))
                // {
                //     echo "<script type='text/javascript'>";
                //     echo "alert('invalid mobile no,')";
                //     echo "</script>";
                //     header('location:https://apps.facebook.com/134173260097515/');
                //     exit();
                // }
            $db = Db::init();
                     
                    $sql = "INSERT INTO test 
                                (uid, name, mobno, address, email,bday) 
                            VALUES 
                                (?, ?, ?, ?, ?, ?)";
                     
                    $data = array(
                        $uid,
                        $register['name'],
                        $register['mobileno'],
                        $register['address'],
                        $register['email'],
                      $biday
                    );
                     
                    $sth = $db->prepare($sql);
                    if ($sth->execute($data))
                    {
                        $status = true;
                    }
              
           
        } catch (Exception $e) {
            array_push($errors, 'Database error: ' . $e->getMessage());
        }
    }
    else
    {
        array_push($errors, 'Error with validating Signed request.');
    }
 
    if (true === $status)
    {
        echo "User registered successfully";
        header( "refresh:1;url=https://apps.facebook.com/134173260097515/");
    }
    else
    {
        echo "Errors during registration";

        if (!empty($errors))
        {
            echo '<ul>';
             
            foreach ($errors as $e)
            {
                echo '<li>' . $e . '</li>';
            }
             
            echo '</ul>';
        }
        header( "refresh:1;url=https://apps.facebook.com/134173260097515/");
    }
  }
  else
  {
    header('location:https://apps.facebook.com/134173260097515/');
    exit();

  }

    
    ?>
