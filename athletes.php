<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Athletes Task</title>
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: bisque;
}

table.table{
  font-size:1.5em;
  text-align:center;
  width:60%;
  margin-left:auto;
  margin-right:auto;
  border-style:outset;
  border-width:0.3em;
  border-color:#7799ff;}
td.cell1{
  border-style:inset;
  border-width:0.15em;
  border-color:#7799ff;
  background-color:#8888ff;}
td.cell2{
  border-style:inset;
  border-width:0.15em;
  border-color:#5555ff;
  background-color:000000;}
</style>
</head>
<body>
<?php

$country_id = $_REQUEST['country_id'];
$part_name = $_REQUEST['part_name'];  

/*Check if username and password and filled*/;

if($country_id != "" and $part_name != ""){
  

  require_once 'MDB2.php';
  include "username_and_password_file.php";
  include "functions.php";
  
  $host = "localhost";
  $dbName = "coa123cdb";
  $dsn = "mysql://$username:$password@$host/$dbName"; 
  $db =& MDB2::connect($dsn); 

  if(PEAR::isError($db)){ 
      die($db->getMessage());
  }
  
  $table_cyclist = "Cyclist";
  $db->setFetchMode(MDB2_FETCHMODE_ASSOC);

  $sql = "SELECT name,gender,height,weight FROM $table_cyclist WHERE name LIKE '%{$part_name}%' AND ISO_id = '{$country_id}'";
  $res = & $db->query($sql);
    
  if(PEAR::isError($res)){
    die($res->getMessage());
  }
  if($part_name==" "){
      echo '<table class = "table" >';
      echo '<tr><td class = "cell2">'."Name".'</td><td class = "cell2">'."Gender".'</td><td class = "cell2">'."BMI".'</td></tr>';

      //Display the results in a table
      while($row = $res -> fetchRow()){
          echo '<tr>';
          echo '<td class = "cell1">'.$row['name'].'</td><td class = "cell1">'.$row['gender'].'</td><td class = "cell1"></td>';
          echo '</tr>';
      }
      echo '</table>';
  }

  //If the search yielded any result
  else if($res->numRows()>0){
    
    echo '<table class = "table" >';
    echo '<tr><td class = "cell2">'."Name".'</td><td class = "cell2">'."Gender".'</td><td class = "cell2">'."BMI".'</td></tr>';

    //Display the results in a table
    while($row = $res -> fetchRow()){
      $bmi = calculateBMI($row['weight'],$row['height']);
      echo '<tr>';
      echo '<td class = "cell1">'.$row['name'].'</td><td class = "cell1">'.$row['gender'].'</td><td class = "cell1">'.$bmi.'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }

  else
      echo "Your search yielded no results";
}

else
    echo "Please provide the correct country ID and/or the part name ";
?>
</body>
</html>