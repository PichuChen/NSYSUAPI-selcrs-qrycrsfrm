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
    'method'=>"GET",
    'header' =>  "Cookie: $cookie" ,
  )
);
$context = stream_context_create($opts);
//Read File
$handle = fopen("http://selcrs.nsysu.edu.tw/menu4/query/slt_result.asp?admit=0", "rb",false,$context);
$str = stream_get_contents($handle);
//Parse HTML
$str = str_replace('<table cellspacing=0 cellpadding=2  border=1 bordercolor=#C0C0C0 width="100%" bgcolor=#CCFFCC ></table>','</table>',$str);
$doc = new DOMDocument();
@$doc->loadHTML($str);
$selectList = $doc->getElementsByTagName('table');
$courseList =  $selectList->item(0)->getElementsByTagName('tr'); // name = D0
$itemLength = array();

$skip = 2;
$ans = array();
for($i = 2;$i < $courseList->length - 1 ;++$i){
	$thisCourse = $courseList->item($i);
	if($thisCourse->getElementsByTagName('td')->item(0)->nodeValue == '選上'){
		$ans[] = $thisCourse->getElementsByTagName('td')->item(2)->nodeValue;
	}	
}
//echo json_encode($ans);
return $ans;
exit;
$ans = array();
for($i=0;$i<$itemLength;$i += 20){
	for($j = 0;$j<20;++$j){
		//$ans[] = $depList->item(3 + $j)->nodeValue;
		$tmp = array();
		$classItem = $couseList->item(1 + $j);
		print_r($classItem->nodeValue);
	//	foreach($classItem as $item){
	//		$tmp[] = $item->nodeValue;
	//	}
		$ans[] = $tmp;

	}
	

}
//var_dump($ans);


return $ans;

?>
