<?php
/*
   Copyright 2013 Pichu, NSYSU-CDPA

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

$SID = urlencode($SID);
$PASSWD = urlencode($PASSWD);

//Set Option
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
//		'Cookie: ASPSESSIONIDCCRCQQDD=ECMFONIBGBMAMKKHJFOGEEFE' ,
    'content'=> "stuid=$SID&SPassword=$PASSWD",
    'ignore_errors' => true,
  )
);

$ctx = stream_context_create($opts);
//Read File
$handle = fopen("http://selcrs.nsysu.edu.tw/menu4/Studcheck.asp", "rb",false,$ctx);
//$handle = fopen("http://selcrs.nsysu.edu.tw/scoreqry/sco_query.asp?action=1&SID=B983040003&PASSWD=193068",'r');
$str = stream_get_contents($handle);
$str=iconv("big5","UTF-8",$str); 
if(strstr($str,'資料錯誤')){
	return false;
}else{
	$meta = stream_get_meta_data($handle);
	$tmp = array();
	preg_match('/^(Set-Cookie: )(.*); path/',$meta['wrapper_data'][6],$tmp);
	if(isset($this)){
		$this->cookie = $tmp[2];
	}
	return $tmp;
}

?>
