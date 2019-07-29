<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Details Task</title>
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: bisque;
}
body,td,th {
	color: brown; 
}
</style>
</head>
<body>
<?php

$date_1 = $_REQUEST['date_1'];
$date_2 = $_REQUEST['date_2'];


list($y1, $m1, $d1) = explode("/", date("Y/m/d", strtotime($date_1)));
list($y2, $m2, $d2) = explode("/", date("Y/m/d", strtotime($date_2)));

if(checkdate($d1,$m1,$y1) and checkdate($d2,$m2,$y2)){

    //formatting the date to the task requirements
	$date_1 = str_replace("/","-",$date_1);
	$date_1 = date("Y-m-d", strtotime($date_1) );
	$date_2 = str_replace("/","-",$date_2);
	$date_2 = date("Y-m-d", strtotime($date_2));
	
	require_once 'MDB2.php';
	include "username_and_password_file.php";

	//connecting to the the database
	$host = "localhost";
	$dbName = "coa123cdb";
    $dsn = "mysql://$username:$password@$host/$dbName"; 
    $db =& MDB2::connect($dsn); 

	if(PEAR::isError($db)){
		die($db->getMessage());
	}

	$table_cyclist = "Cyclist";
	$table_country = "Country";
	
	$db->setFetchMode(MDB2_FETCHMODE_ASSOC);
	
	$sql = "SELECT t2.name,t1.country_name,t1.gdp,t1.population
            FROM Country as t1 JOIN Cyclist as t2
            ON t1.ISO_id=t2.ISO_id
            WHERE t2.dob BETWEEN '$date_1' AND '$date_2' ";
    $res = & $db->query($sql); // result of the query.
	
	if(PEAR::isError($res)){
		die($res->getMessage());
    }

	if(json_encode($db->queryAll($sql))=='[]'){
        $sql = "SELECT t2.name,t1.country_name,t1.gdp,t1.population
            FROM Country as t1 JOIN Cyclist as t2
            ON t1.ISO_id=t2.ISO_id
            WHERE t2.dob BETWEEN '$date_2' AND '$date_1' ";
        $res = & $db->query($sql); // result of the query.

        if(PEAR::isError($res)){
            die($res->getMessage());
        }

    }


echo '<div align = left>';
echo '</hr>';
echo json_encode($db->queryAll($sql));//result of the query in json format
echo '</div>';
}

?>
</body>
</html>