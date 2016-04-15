<?php

function mail_utf8($email, $subject, $message)
   { 
      $from_user = "=?UTF-8?B?".base64_encode('Managed Solution')."?=";
      $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      $from_email = 'billing@managedsolution.com';
      $headers = "From: $from_user <$from_email>\r\n". 
               "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n"; 

     return mail($to, $subject, $message, $headers); 
   }