<?php

/**
 * sawo_sendSms : Send sms and die silently
 *
 * @param  mixed $data
 * @return void
 */
function sawo_sendSms($data=array())
{

  $countries = ["SA"=>"966", "AE"=>"971", "KW"=>"965", "BH"=>"973", "QA"=>"974", "OM"=>"968", "IN"=>"91"];
	$countrycode = "";
  if(isset($countries[$data["country"]])){
    $countrycode = $countries[$data["country"]];
  }
  
  // for promotional and payment
	$accesskey = 't8LJgGlNqLs3cyy';
	$sid = 'YORK%20FURN';
	$type = 3;
	$mno = $countrycode.$data['send_to'];
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

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
//     ///
//     $accesskey = 't8LJgGlNqLs3cyy';
// 	$sid = 'YORK%20FURN';
// 	$type = 3;
// 	$mno = '919873572298';
// 	$text=array('Thank you! Your order ( 891756 ) is confirmed and expected to be delivered by with in 2 days'); 
//     $text= http_build_query($text);
//     $text= substr($text, 2);

// 	 $url = 'http://51.210.118.154:8080/websmpp/websms?accesskey='.$accesskey.'&sid='.$sid.'&mno='.$mno.'&type='.$type.'&text='.$text; 
// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => $url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
// ));

// $response = curl_exec($curl);

// curl_close($curl);

}