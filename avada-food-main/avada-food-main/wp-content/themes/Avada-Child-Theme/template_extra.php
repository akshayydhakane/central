<?php

//Template Name: Extra

function base64_url_encode($input)

{return strtr(base64_encode($input), '+/=', '-_,');}



function base64_url_decode($input)

{

return base64_decode(strtr($input, '-_,', '+/='));

}
$url = 'https://stackoverflow.com/questions/1374753/passing-base64-encoded-strings-in-url?id=12';
//echo $encode = base64_url_encode($url);
echo "<br><br>";
//echo $decode = base64_url_decode($encode);

echo "<br><br>";
 $encode = urlencode("https://geeksforgeeks.org/?id=22") . "\n";

echo urldecode($encode) . "\n";

echo "<br><br>";
  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    echo $url;  
   

?>