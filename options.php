<?php

//This PHP file is used to append the countries' select list with the options
include "functions.php";

$db= connectDatabase();

$sql = "SELECT country_name,ISO_id FROM Country";

$db->setFetchMode(MDB2_FETCHMODE_ASSOC);

$res = & $db->query($sql);

if(PEAR::isError($res)){
die($res->getMesssage());
}

echo json_encode($res->fetchAll());  

?>

