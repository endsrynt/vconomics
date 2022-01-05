<?php
error_reporting(0);
echo "\e[0;33m[!] Reff: \e[0m";
$reff =trim(fgets(STDIN));

start:
//RANDOM NAME
function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}

    function randomstr($length)
    {
        $str        = "";
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
          $rand = mt_rand(0, $max);
          $str .= $characters[$rand];
      }
      return $str;
  }

  function angkarand($length)
  {
      $str        = "";
      $characters = '1234567890';
      $max        = strlen($characters) - 1;
      for ($i = 0; $i < $length; $i++) {
          $rand = mt_rand(0, $max);
          $str .= $characters[$rand];
      }
      return $str;
  } 

$nama = explode(" ", nama());
$nama1 = strtolower($nama[0]);
$nama2 = strtolower($nama[1]);
$rand = angkarand(5);
$namalengkap = "$nama1$nama2$rand";
$domain = "fheiesit.com";
$email = "$namalengkap@$domain";
//$reff = "NS5L1WRG";

//CREATE EMAIL
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://emailfake.com/check_adres_validation3.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'usr='.$email,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));
$response = curl_exec($curl);
$httpcode1 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$result = json_decode($response);
if($httpcode1 == 400){
  echo  "\e\33[31;1mGagal membuat email $email\n\n";
   }else{
     $httpcode1 == 200;
     echo  "\e\33[32;1mBerhasil membuat email $email\n";
 }

    //GET IP
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://v4.myipstack.com/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $ip = curl_exec($curl);
    
    curl_close($curl);
    echo "\e[0;33m[!]\e[0m IP      : \e[0;32m$ip\e[0m\n";
 
//REGISTER
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://id.vscore.vn/api-v1/accounts/register/4',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"userName":"'.$email.'","password":"Yesbisa123","rePassword":"Yesbisa123","fromReferralId":"'.$reff.'","fullName":"'.$nama1.' '.$nama2.'"}',
  CURLOPT_HTTPHEADER => array(
              'Host: id.vscore.vn',
              'accept: application/json, text/plain, */*',
              'x-ip-address: '.$ip,
              'x-user-agent: Mozilla/5.0 (Linux; Android 7.1.2; SM-G935FD Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/68.0.3440.70 Mobile Safari/537.36',
              'x-location: ',
              'x-via: 3',
              'x-culture-code: EN',
              'content-type: application/json;charset=utf-8',
              'accept-encoding: gzip',
              'user-agent: okhttp/3.12.1'
  ),
));

$response = curl_exec($curl);
$httpcode2 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
echo $response;
if ($httpcode2 == 200) {
  $result1 = json_decode($response);
  if ($result1->success=="true"){
    $token = $result1->data->token;
    $pesan = $result1->messageCode;
    echo  "\e\33[32;1mBerhasil membuat akun $email\n";
    echo "\e[0;33m[!]\e[0m STATUS  : \e[0;32m$pesan\e[0m\n";
    echo "\e[0;33m[!]\e[0m TOKEN   : \e[0;32m$token\e[0m\n";


    echo "\e[0;33m[!]\e[0m OTP     : ";


    for ($i=0; $i < 10; $i++) { 

      //CEK EMAIL
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://emailfake.com/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
                'cookie: surl='.$domain.'/'.$namalengkap
      ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $otp=explode('</p>',explode('<p style="color: #fa7800; font-weight: bold; text-align: center; font-size: 40px">',$response)[1])[0];
    

      if ($otp){
        echo "\e[0;32m$otp\e[0m\n";
        goto input;
        break;
      }else{
        continue;
      }
    };

    input:
    //INPUT OTP
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://id.vscore.vn/api-v1/tokens/verify-otp',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"validateToken":"'.$token.'","otp":"'.$otp.'","otpType":1}',
    CURLOPT_HTTPHEADER => array(
            'User-Agent: okhttp/3.12.1',
            'x-culture-code: EN',
            'x-location: ',
            'Content-Type: application/json',
            
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    if ($result->success=="true"){
      $pesan2 = $result->messageCode;
      echo "\e[0;33m[!]\e[0m STATUS  : \e[0;32m$pesan2\e[0m\n";
      $file = fopen("reff_vco.txt","a");  
      fwrite($file,"".$email); 
      fwrite($file,"\n"); 
      fclose($file);  
      goto start;
    }else{
      echo  "\e\33[31;1mGagal Mendapatkan OTP\n";
      goto start;
    }
  }else{
    echo  "\e\33[31;1mGagal Melakukan registrasi\n";
    goto start;
  }
} else {
  echo  "\e\33[31;1mGagal Melakukan registrasi\n";
  goto start;
}
