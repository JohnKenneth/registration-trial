<?php
class pagetoken
{
	
	function get_page_token($accesstoken,$user)
	{
		$t1=curl_init();
  $url3='https://graph.facebook.com/'.$user.'/accounts?access_token='.$accesstoken;
      curl_setopt($t1, CURLOPT_URL, $url3);
      curl_setopt($t1, CURLOPT_HEADER, false);
      curl_setopt($t1, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($t1, CURLOPT_HTTPGET, true);
     $al2=curl_exec($t1);
     curl_close($t1);
     $out1=json_decode(file_get_contents($al2));

     return $out1;
	}
}

?>