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
    'content'=> 'HIS=1&IDNO=&ITEM=&D0=1012&D1=AC1C&D2=&CLASS_COD=&SECT_COD=&TYP=1&teacher=&crsname=&T3=&WKDAY=&SECT=&nowhis=1&B1=%B6%7D%A9l%ACd%B8%DF',
  )
);
$context = stream_context_create($opts);
if(!isset($D1) )$D1 = "AC1C";
//Read File
$handle = fopen("http://selcrs.nsysu.edu.tw/menu1/dplycourse.asp?D0=1012&D1=$D1&TYP=1&page=0", "r");
$str = stream_get_contents($handle);
//Parse HTML
$doc = new DOMDocument();
$doc->loadHTML($str);
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
		$ans[] = $tmp;

	}
	

}
//var_dump($ans);


return $ans;

?>
