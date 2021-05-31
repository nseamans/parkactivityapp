<?php
    /* getActivities
     * Returns an array with all avalible activites in the national park registry
     */
    function getActivities(){
        // Returns a list of all events avalible to park goers. 
        function retrieveActivitiesFromAPI() {
            $searchURL = "https://developer.nps.gov/api/v1/activities" . "?limit=50" 
                    . "&api_key=fbJk7RSI3mzkzoiOC2gaOzreTHS9FdqOB2aSlvuj";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $searchURL);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $results = curl_exec($ch);
            curl_close($ch);
            return (array) json_decode($results);
        };

        $allActivities = retrieveActivitiesFromAPI();
        $activitiesName = array();
        $style = " width: 250px; " . " text-align: right !important; " 
            . "margin-top: 1%; margin-left: 1%;" . " border-radius: 0px;";
        for($i = 0; $i <= (count($allActivities["data"]) - 1 ); $i++){
            $info = (array) $allActivities["data"][$i];
            $id = "'".$info["id"]."'";
            $name = "'".$info["name"]."'";
            $display = '<button v-on:click="addInfo('.$id.','.$name.')" ' 
                    . ' class="btn btn-outline-secondary" style="' . $style .'">'
                    . $info["name"] . '</button>';
            echo($display . "<br />");
        }
    };
    getActivities();
?>