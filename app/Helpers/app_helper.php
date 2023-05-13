<?php
// Checking function already exists or not
if(!function_exists("getClientIpAddress")){
  
    function getClientIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //Checking IP From Shared Internet
        {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //To Check IP is Pass From Proxy
        {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
