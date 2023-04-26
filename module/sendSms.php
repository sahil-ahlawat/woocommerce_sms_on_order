<?php

/**
 * sawo_sendSms : Send sms and die silently
 *
 * @param  mixed $data
 * @return void
 */
function sawo_sendSms($data=array())
{
	// for promotional and payment
	$accesskey = 't8LJgGlNqLs3cyy';
	$sid = 'YORK%20FURN';
	$type = 3;
	$mno = $data['send_to'];
	$text=array($data['message']); 
    $text= http_build_query($text);
    $text= substr($text, 2);

	 $url = 'http://51.210.118.154:8080/websmpp/websms?accesskey='.$accesskey.'&sid='.$sid.'&mno='.$mno.'&type='.$type.'&text='.$text; 

	$curl = curl_init(); 
     curl_setopt_array($curl, array(
      CURLOPT_URL =>$url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
    ));

}