<?php
    /** parkInfo
      * Gets information based on a given park code. 
     **/
    function parkInfo(){
       $parkquery = 'https://developer.nps.gov/api/v1/parks?parkCode=' 
                . $_POST["parkCode"];
       $searchURL =
               $parkquery .
               "?limit=50" .
               "&api_key=fbJk7RSI3mzkzoiOC2gaOzreTHS9FdqOB2aSlvuj";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $searchURL);
       curl_setopt($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       $results = curl_exec($ch);
       curl_close($ch);
       return (array) json_decode($results);
    }

    if(empty((array) parkInfo()["data"])){
        echo(' <div class="container-fluid">
                <h3>There are no results for this location.</h3>
                </div> ');
    } else {
        $parkInfo = (array) parkInfo()["data"][0];
        require('scripts/parkresults/parkresults.php');
    }
?>