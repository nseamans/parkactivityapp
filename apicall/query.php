<?php
   $activitiesData = $_POST["activitiesID"];
   $stateData = $_POST["state"];
   $choosenactivities = explode(',', $activitiesData);
   
   if ($choosenactivities[0] === "") {
   
       echo('<div class="container-fluid">');
       echo("<h3>Nothing is Avalible</h3>");
       echo('</div>');
   
    } else {
       $activityCount = count($choosenactivities) - 1;
       $searchActivities = '';
   
       for ($i = 0; $i <= $activityCount; $i++) {
           if ($i === 0) {
               $searchActivities = $searchActivities . $choosenactivities[$i];
           } else {
               $searchActivities =
                   $searchActivities . "," . $choosenactivities[$i];
           }
       }
   
       /** Info
         * Creates a row for an activity table. 
        **/
       function info($infoArray, $position){
           echo "<tr>" .
               '<th scope="row">' . ($position) . '</th>' .
               "<td>" . 
                   "<form action='parkresults.php'  method='post'>
                       <input type='text' name='parkCode' value='" 
                            . $infoArray["parkCode"] . "' hidden>
                       <input type='submit' class='btn btn-link' value='" 
                           . $infoArray["fullName"] ."'>
                       </input>
                   </form>"
               . "</td>" .
               "<td>" . $infoArray["designation"] . "</td>" .
               "<td>" . $infoArray["states"] . "</td>" .
               "<td> <a href='" . $infoArray["url"] .
               "' class='link-success' target='_blank' rel='noopener noreferrer'>" .
               $infoArray["url"] . "</a></td>" .
               "</tr>";
           return $position + 1;
       };
   
   
       function getParksByActivities($search)
       {
           /** retrieveActivitiesFromAPI
             * Retrieves a list of activities that will later be added to
             * each table for the events requested. 
            **/
           function retrieveActivitiesFromAPI($search)
           {
               $searchURL =
                   $search .
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
   
           $activitieslist = [];
           $allActivities = (array) retrieveActivitiesFromAPI($search)["data"];
           $arraysize = count((array) $allActivities);
   
           /** parks
             * The displayed value of the results from the retrieveActivitiesFromAPI
             * function above converted into a HTML table.
            **/
           function parks($array, $name, $activityNumber) {
               $namecount = 0;
               $nameArray = array();     
   
               for($x = 0; $x <= count((array) $array) - 1; $x++){
                   $nameArray = (array) $array;
                   $infoArray = (array) $nameArray[$x];
                   $stateArray = explode(",", $infoArray["states"]);
                   if(in_array($_POST["state"], $stateArray)){
                      $namecount = $namecount + 1;   
                   }
               }
   
               $arrayLength = count($array);
               echo '<p>  <a class="btn btn-outline-secondary optionExpandbutton" data-bs-toggle="collapse" 
                             href="#collapseExample' . $activityNumber .
                     '"      role="button" aria-expanded="false" aria-controls="collapseExample">' .
                     $name . '</a></p>';
               echo '<div class="collapse" id="collapseExample' . $activityNumber . '">';
               echo "<div class='locations'>";
               echo '<div class="container-fluid">';
   
               if ($namecount !== 0 || $_POST["state"] === 'none'){
                    echo('  <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">State (s) </th>
                                        <th scope="col">URL</th>
                                    </tr>
                                </thead>
                            <tbody> 
                        ');
   
                   $tablePosition = 1;
                   $stateArray = array();
   
                   for ($x = 0; $x <= $arrayLength - 1; $x++) {
                       $infoArray = (array) $array[$x];
                       if($_POST["state"] === "none"){ 
                           $tablePosition = info($infoArray, $tablePosition);
                       } else {
                           $stateArray = explode(",", $infoArray["states"]);
                           if(in_array($_POST["state"], $stateArray)){
                               $tablePosition = info($infoArray, $tablePosition);
                           }
                       }
                   };   
                   echo ('</tbody> </table>');
   
               } else {
                   echo("<h3>Nothing is Avalible</h3>");    
               }
   
               echo ("</div> </div> </div>");
               return $name;
           }
   
           echo '<div class="container-fluid">';
           for ($x = 0; $x <= $arraysize - 1; $x++) {
               $arrayinfo = (array) $allActivities[$x];
               parks((array) $arrayinfo["parks"], $arrayinfo["name"], $x);
           }
           echo ('</div>');
       }
   
       $parkquery =
           'https://developer.nps.gov/api/v1/activities/parks?id=' .
           $searchActivities;
   
       getParksByActivities($parkquery);
    }   
?>