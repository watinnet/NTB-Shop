<?php
/*It 's working well
*/
$strAccessToken = "wKVCLroyh6QSNOsYYDVcrdVBCZvDlhapqBprAJi21qMSnbOiDdf9l90156VgQ6bSgBmJ3GPTFf43IVPfKEeePfiGfPsuf5yIizXzQxWotybOgyUNujBWNSipMt2EnP72Z41aX0mLetQ94+mmt7CugAdB04t89/1O/w1cDnyilFU=";
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);

$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
$txtauto=array(
'สวัสดีค่ะ'=>"น้องไบต์ สวัสดีค่ะ",
'สบายดีไหม'=>'หนูสบายดี',
'ทำอะไรอยู่'=>'เรียนกับครูวุ่นค่ะ',
'หนูรักใคร'=>'ป่อค่ะ',
'รักแม่ไหม'=>'รักค่ะ'

);

$arrPostData = array();

		
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
 // $arrPostData['messages'][0]['text'] = $txtauto[$arrJson['events'][0]['message']['text']];
 // $arrPostData['messages'][0]['text'] = $arrJson['events'][0]['message']['text'];
	
	$input=$arrJson['events'][0]['message']['text'];
	
	
	if(isset($txtauto[$input])){
		$arrPostData['messages'][0]['text'] = $txtauto[$input];
	}else {
		 $arrPostData['messages'][0]['text'] = "น้องไบต์ไม่เข้าใจคำถามค่ะ";
	}


 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>