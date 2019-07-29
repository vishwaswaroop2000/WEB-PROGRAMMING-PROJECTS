<?php
function calculateBMI($weight,$height){//this function calculates BMI for tasks 1 - 2
	    $height_in_cm = $height/100;
		$bmi = round($weight/($height_in_cm*$height_in_cm),3);
		return $bmi;
}

function connectDatabase(){ //this functiion is called when connecting to the database

  require_once 'MDB2.php';
  include "username_and_password_file.php";
  
  $host = "localhost";
  $dbName = "coa123cdb";
  $dsn = "mysql://$username:$password@$host/$dbName"; 
  $db =& MDB2::connect($dsn);

  return $db;

}

?>