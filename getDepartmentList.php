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

//Read File
$handle = fopen("http://selcrs.nsysu.edu.tw/menu1/qrycourse.asp", "r");
$str = stream_get_contents($handle);
//Parse HTML
$doc = new DOMDocument();
$doc->loadHTML($str);
$selectList = $doc->getElementsByTagName('select');
$depList =  $selectList->item(1)->getElementsByTagName('option'); // name = D0

//output
$ans = [];
foreach($depList as $item){
	$ans[] = $item->nodeValue;
}

return $ans;

?>
