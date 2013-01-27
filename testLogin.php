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

//Set Option
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'content'=> "SID=$SID&PASSWD=$PASSWD&ACTION=0&INTYPE=1",
  )
);
$ctx = stream_context_create($opts);
//Read File
$handle = fopen("http://selcrs.nsysu.edu.tw/scoreqry/sco_query.asp", "r",false,$ctx);
$str = stream_get_contents($handle);
$str=iconv("big5","UTF-8",$str); 
if(!strcmp($str,' 資料錯誤請重新輸入 ')){
	return false;
}else{
	return true;
}




?>
