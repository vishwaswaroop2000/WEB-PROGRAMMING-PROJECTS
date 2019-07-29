function rankCountryAndCyclist(CountryList,Criteria){
    $.getJSON("RankCountryByCriteria.php", {
        CountryList: CountryList,
        Criteria: Criteria
    }, function (rankedCountries) {
        //this function uses ajax to get the json_encoded values of the country ranked according  to the criteria
        for (let i = 0; i < rankedCountries.length; i++) {
            $("#Rank" + (i + 1) + "Country").append("<tr><td> Rank " + (i + 1) + "</td><td>"
                + rankedCountries[i].country_name + "</td></tr>");
            $("#Rank" + (i + 1) + "Country").append("<tr><td>Bronze :" + rankedCountries[i].bronze + "</td><td>Silver: "
                + rankedCountries[i].silver + "</td></tr>");
            $("#Rank" + (i + 1) + "Country").append("<tr><td>Gold: " + rankedCountries[i].gold + "</t><td>Total: "
                + rankedCountries[i].total + "</td></tr>");
            $("#Rank" + (i + 1) + "Country").append("<tr><td>GDP: "
                + rankedCountries[i].gdp + "</td><td>Population: " + rankedCountries[i].population + "</td></tr>");
        }
        ;
       
    });
    $.getJSON("RankByCriteria.php", {CountryList: CountryList, Criteria: Criteria}, function (rankedCyclists) {
        //this function uses ajax to get the json_encoded values of the cyclists associated to the country ranked
        // according to the criteria
        for (let i = 0; i < (Object.keys(rankedCyclists).length); i++) {
            let Objkeys = (Object.keys(rankedCyclists));
            if (rankedCyclists[Objkeys[i]].length == 0) {
                $("#Rank"+(i+1)+"Country").append("None");
            }

            else {
                $("#Rank"+(i+1)+"Country").append("<tr><td colspan= '2'>Cyclists:</td></tr>");
                for (let j = 0; j < rankedCyclists[Objkeys[i]].length; j++) {
                    $("#Rank"+(i+1)+"Country").append('<tr><td colspan = "2" class="CyclistObjects" title= Event:'
                        +rankedCyclists[Objkeys[i]][j].sport+'>'+rankedCyclists[Objkeys[i]][j].name+'</td></tr>');
                }
            }
        }
    });
}

function array_is_unique(CountryList){//this function checks if theres any ISO_id that has been repeatedly selected.
    for (let i = 0; i < CountryList.length; i++) {
        for (let j = i+1; j < CountryList.length; j++) {
            if(CountryList[i]==CountryList[j]) {
                return false;
            }
        }
    }
    return true;
}

function getCountries(){
    var CountryList = [];
    for (let i = 1; i < 5; i++) {
        var Country  = $('#ISO_'+i).val();
        if(Country!="")
            CountryList.push(Country);
    }
    for (let i = 1; i <= 4; i++) {
        $("#Rank"+i+"Div").hide();
        $("#Rank"+i+"Country").empty();
    }
    if(array_is_unique(CountryList)) {
        for (let i = 1; i < CountryList.length + 1; i++) {
            $("#Rank" + i + "Div").show();
        }
        if (CountryList.length > 1) { //Atleast 2 countries should be entered to compare
            //and both of them must be unique.
            //List of Ranking Criteria
            if ($("#RankingCriteria").val() == "Total") {
                rankCountryAndCyclist(CountryList, "total");
            } else if ($("#RankingCriteria").val() == "Gold") {
                rankCountryAndCyclist(CountryList, "gold");
            } else if ($("#RankingCriteria").val() == "Silver") {
                rankCountryAndCyclist(CountryList, "Silver");
            } else if ($("#RankingCriteria").val() == "Bronze") {
                rankCountryAndCyclist(CountryList, "Bronze");
            } else if ($("#RankingCriteria").val() == "Medals_per_GDP") {
                rankCountryAndCyclist(CountryList, "total/gdp");
            } else if ($("#RankingCriteria").val() == "Medals_per_population") {
                rankCountryAndCyclist(CountryList, "total/population");
            } else if ($("#RankingCriteria").val() == "GDP_per_Medals") {
                rankCountryAndCyclist(CountryList, "gdp/total");
            } else {
                rankCountryAndCyclist(CountryList, "population/total");
            }

        } else
            alert("Please enter atleast two fields");
    }
    else
        alert("Please enter unique ISO-ids");
}


$(document).ready(function(){
    //This function is used to load the options of the select lists.When the page is loaded, this function appends the
    //options to the select list using ajax
    $.getJSON("options.php", function (options) {
        for (let i = 1; i < 5; i++) {
            $('#ISO_' + i).append('<option value = "">Select Country</option>');
            $.each(options, function (key, value) {
                var option = $("<option value=" + value.iso_id + ">"+value.iso_id
                    +" - "+ value.country_name + "</option>");
                $('#ISO_' + i).append(option);
            });
        }
    });
});
    

