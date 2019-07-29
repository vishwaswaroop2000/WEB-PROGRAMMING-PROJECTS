<?php

/*This php file ranks the country based on the raning criteria and also, associates the country with the cyclists
with the ISO_ids as the key. The reason for doing thisin separate files is Simple. Using a single query returns "[]"
when a country havingno cyclist is inputted. Therefore, this file echos out the associative array with the ISO_ids as the key
the cyclists as the values ordered according to the mentioned criteria(Like total,gold,silver,etc).*/
include "functions.php";
$db = connectDatabase();

if(PEAR::isError($db)){
    die($db->getMessage());
}

$CountryList = $_GET['CountryList'];
$Criteria = $_GET['Criteria'];//Recieve the Selected Countries and the Ranking Criteria using AJAX

$CountryListLength = count($CountryList);


function sqlStatements($CountryListLength){
    $CountryList = $_GET['CountryList'];
    $sqlStatement = "";
    for($i=0;$i<$CountryListLength;$i++){
        if($i==0)
            $sqlStatement = "ISO_id = '{$CountryList[0]}'";
        else
            $sqlStatement = $sqlStatement . " OR ISO_id =  '{$CountryList[$i]}' ";
    }
    return $sqlStatement;
}


$sql = "SELECT country_name,ISO_id
        FROM Country WHERE " . sqlStatements($CountryListLength) . " ORDER BY $Criteria DESC";

$db->setFetchMode(MDB2_FETCHMODE_ASSOC);

$resCountriesRanked =& $db->queryAll($sql);


if (PEAR::isError($resCountriesRanked))
    die($resCountriesRanked->getMessage());

$sortedCountryList = [];

for($i=0;$i<count($resCountriesRanked);$i++){
     array_push($sortedCountryList,$resCountriesRanked[$i]['iso_id']);
}

$sql = "SELECT name,ISO_id,sport FROM Cyclist WHERE " . sqlStatements($CountryListLength);

$resCyclists =& $db->queryAll($sql);

if (PEAR::isError($resCyclists))
    die($resCyclists->getMessage());

foreach ($sortedCountryList as $country) {
    $structuredResults[$country] = Array();
}


foreach ($resCyclists as $cyclist) {
    $ISOidOfCyclist = $cyclist['iso_id'];
    array_push($structuredResults[$ISOidOfCyclist], $cyclist);
}

echo json_encode($structuredResults);
?>
