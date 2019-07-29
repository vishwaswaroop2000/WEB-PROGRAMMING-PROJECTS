<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>BMI Task</title>
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
  background-color:000000;

</style>
</head>
<body>
<?php
  /* The input is recieved here */
	$min_weight = $_REQUEST['min_weight'];
	$max_weight = $_REQUEST['max_weight'];
	$min_height = $_REQUEST['min_height'];
	$max_height = $_REQUEST['max_height'];
	
	/* this php file contains function for BMI calculation */
	include "functions.php";

  /* the calculation is performed only if relevant values are entered */
	if(is_numeric($min_height) and is_numeric($min_weight) and is_numeric($max_height) and is_numeric($max_weight)
    and $min_height!=0 and $max_height!=0){
		
		if($min_weight<=$max_weight and $min_height<=$max_height){
		/*rounds up the inputs so that it includes the closest multiple of 5.*/
			$max_height = $max_height - ($max_height%5); 
			$max_weight = $max_weight - ($max_weight%5);
		
			echo '<table class ="table">';
	        echo '<tc>';
	        echo '<td class = "cell2">'."BMI".'</td>';	
			
			for($j=$min_height;$j<=$max_height;$j+=5)
		    echo '<td class = "cell2">'.$j.'</td>';
			
			echo '</tc>';	
			
			for($i=$min_weight;$i<=$max_weight;$i+=5){
				
				echo '<tr>';
		        echo'<td class = "cell2" >'.$i.'</td>';

		    for($j=$min_height;$j<=$max_height;$j+=5){
				echo '<td class = "cell1">'.calculateBMI($i,$j).'</td>';
			}
				
				echo '</tr>';
				
		    }
		
		    echo '<p>WEIGHT IS GIVEN IN KG ALONG THE X-AXIS</br>';
		    echo 'HEIGHT IS GIVEN IN CM ALONG THE Y-AXIS</p>';
		
	    }
		
	    else	
		    echo "Please make sure that minimum values do not exceed the maximum values";
		
	}
	
	else
	echo "Please enter all the numeric values correctly.";
	
?>
</body>
</html>