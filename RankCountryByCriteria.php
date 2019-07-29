<?php
//This php file is used to get the sorted countries ranked according to the input criteria
include "functions.php";
$db = connectDatabase();
if (PEAR::isError($db)) {
    die($db->getMessage());
}
$CountryList = $_GET['CountryList'];
$Criteria = $_GET['Criteria'];

$CountryListLength = count($CountryList);

function sqlStatements($CountryListLength)
{
    $CountryList = $_GET['CountryList'];
    $sqlStatement = "";
    for ($i = 0; $i < $CountryListLength; $i++) {
        if ($i == 0)
            $sqlStatement = "ISO_id = '{$CountryList[0]}'";
        else
            $sqlStatement = $sqlStatement . " OR ISO_id =  '{$CountryList[$i]}' ";
    }
    return $sqlStatement;
}


$sql = "SELECT country_name,ISO_id,gdp,population,total,gold,bronze,silver
        FROM Country WHERE " . sqlStatements($CountryListLength) . " ORDER BY $Criteria DESC";

$db->setFetchMode(MDB2_FETCHMODE_ASSOC);

$resCountriesRanked =& $db->queryAll($sql);

if (PEAR::isError($resCountriesRanked))
    die($resCountriesRanked->getMessage());

echo json_encode($resCountriesRanked); //echo's out the json format of the ranked Countries
?>