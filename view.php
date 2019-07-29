<html>
<head>
    <title>Task 4</title>
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type ="text/javascript"></script>
    <script src="myJSCode.js"></script>
    <link rel="stylesheet" type="text/css" href="cssfiles.css">
</head>
<body>
<div><h1> TASK 4 </h1></div>
<div><h2> WEB PRGROGRAMMING </h2></div>
<div><h3> view.php </h3></div>
<div id = "Main_div">
    <select name = "ISO_1" id = "ISO_1"></select>
    <select name = "ISO_2" id = "ISO_2"></select>
    <select name = "ISO_3" id = "ISO_3"></select>
    <select name = "ISO_4" id = "ISO_4"></select>
    Rank By<select name = "RankingCriteria" id = "RankingCriteria">
        <option value = "Total" id = "Total">Total Medals</option>
        <option value = "Gold" id = "Gold">Gold Medals</option>
        <option value = "Silver" id = "Silver">Silver Medals</option>
        <option value = "Bronze" id ="Bronze">Bronze Medals</option>
        <option value = "Medals_per_GDP" id = "Medals_per_GDP">(Total) Medals per GDP</option>
        <option value = "Medals_per_Population" id = "Medals_per_population">(Total) Medals per Population</option>
        <option value = "GDP_per_Medals" id = "GDP_per_Medals">GDP per Medals (Total)</option>
        <option value = "Population_per_Medals" id = "Population_per_Medals">Population per Medals (Total)</option>
    </select>
    <button name = "CompareButton" id = "CompareButton" onclick = "getCountries()">Compare</button>
</div>
</br></br></br></br></br></br>
<div id="Rank1Div">
    <img src="Photo1.png" alt="photo" border=3 height=100 width=100>
    <table id = "Rank1Country"></table>
</div>
<div id="Rank2Div">
    <img src="Photo2.png" alt="photo" border=3 height=100 width=100>
    <table id = "Rank2Country"></table>
</div>
<div id = "Rank3Div">
    <img src="Photo3.png" alt="photo" border=3 height=100 width=100>
    <table id = "Rank3Country"></table>
</div>
<div id ="Rank4Div">
    <img src="Photo4.png" alt="photo" border=3 height=100 width=100>
    <table id = "Rank4Country"></table>
</div>

</body>
</html>