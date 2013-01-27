<?php
class QryCrsFrm{

function getClassofDepartment($D1){
	return require('getClassofDepartment.php');
}

function getDepartmentList(){
	return require('getDepartmentList.php');
}

function testLogin($SID,$PASSWD){
	return require('testLogin.php');
}

};


?>
