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
if(!isset($D0) )$D0 = "1021";
if(!isset($D1) )$D1 = "AC1C";

//Set Option
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
    'content'=> 'HIS=2&IDNO=&ITEM=&D0='.$D0.'&D1=' .$D1 . '&D2=&CLASS_COD=&SECT_COD=&TYP=1&teacher=&crsname=&T3=&WKDAY=&SECT=&nowhis=1&B1=%B6%7D%A9l%ACd%B8%DF',
  )
);

$context = stream_context_create($opts);
//Read File
//Old Uri = http://selcrs.nsysu.edu.tw/menu1/dplycourse.asp?D0=1012&D1=$D1&TYP=1&page=0
$queryUri = 'http://selcrs.nsysu.edu.tw/menu1/dplycourse.asp';
$handle = fopen($queryUri, "r",false,$context);
$str = stream_get_contents($handle);
if(strstr($str,"-19")){
	return array();
}

//echo $str;
//Parse HTML
$doc = new DOMDocument();
@$doc->loadHTML($str);
$selectList = $doc->getElementsByTagName('table');
$depList =  $selectList->item(0)->getElementsByTagName('tr'); // name = D0
$itemLength = array();
preg_match('/共 (\d+) 筆/',$depList->item(24)->nodeValue,$itemLength);
$itemLength = $itemLength[1];

$ans = array();
for($i=0;$i<$itemLength;$i += 20){
	for($j = 0;$j<20;++$j){
		//$ans[] = $depList->item(3 + $j)->nodeValue;
		$tmp = array();
		$classItem = $depList->item(3 + $j)->getElementsByTagName('td');
		
		foreach($classItem as $item){
			$tmp[] = $item->nodeValue;
		}
		

		
		$ans[] = formatHIS2($tmp);

	}
	

}
//var_dump($ans);


return $ans;
function formatHIS2($tmp){

	$tmp2 = array() ;
	$tmp2['year'] = $tmp[0];
	$tmp2['semester'] = $tmp[1];
	$tmp2['department'] = $tmp[2];
	$tmp2['coursecode'] = $tmp[3];
	$tmp2['grade'] = $tmp[4];
	$tmp2['class'] = $tmp[5];
	$tmp2['subject'] = $tmp[6];
	$tmp2['credit'] = $tmp[7];
	$tmp2['FS'] = $tmp[8];
	$tmp2['RS'] = $tmp[9];
	$tmp2['CN'] = $tmp[10];
	$tmp2['teacher'] = explode(',',$tmp[11]);
	$tmp2['location'] = $tmp[12];
	$tmp2['time'] = array(
			'mon' => $tmp[13],
			'tue' => $tmp[14],
			'wed' => $tmp[15],
			'thu' => $tmp[16],
			'fri' => $tmp[17],
			'sat' => $tmp[18],
			'sun' => $tmp[19],
			);
	$tmp2['ps'] = $tmp[20];
	return $tmp2;
}
?>
