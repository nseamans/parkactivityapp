<div class="container-fluid">
<div class="row">
   <div class="col-lg-12">
      <?php  
         echo('<h3> '.$parkInfo["fullName"].' </h3>');
         ?>
   </div>
</div>
<h5> Position: <?php echo($parkInfo['latLong']); ?> </h5>
<hr>
<div class="container-fluid">
<div class="row">
   <div class="col">
      <h5> Contact: </h5>
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <?php 
                  $contacts = (array) $parkInfo['contacts'];
                  $phonenumbers = (array) $contacts['phoneNumbers'];
                  echo('<h6>Phone Numbers</h6>');
                  for ($x = 0; $x <= count($phonenumbers) - 1; $x++) {
                    $phoneinfo = (array) $phonenumbers[$x];
                    $formatNum = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", 
                                "$1-$2-$3", $phoneinfo['phoneNumber']);
                    echo('<p>'. $phoneinfo['type']  .': '. $formatNum .'</p>');
                  }  
                  ?> 
            </div>
            <div class="col-lg-8">
               <?php 
                  $contacts = (array) $parkInfo['contacts'];
                  $emailaddress = (array) $contacts['emailAddresses'][0];
                  echo('<h6>Email Address: </h6>');
                  if($emailaddress['emailAddress'] === '0@0'){
                    echo("None");
                  } else echo($emailaddress['emailAddress']);
                  ?>
            </div>
         </div>
      </div>
   </div>
   <div class="col">
      <h5> Activities Avalible: </h5>
      <div class="parkactiviteslist">
         <?php 
            $activities = (array) $parkInfo['activities'];
            for ($x = 0; $x <= count($activities) - 1; $x++) {
              $activity = (array)$activities[$x];
              echo('<p class="m-1">'.($x + 1).': '.$activity['name'].'</p>');
            }      
            ?> 
      </div>
   </div>
</div>

<h4> Description </h4>
<p> <?php echo($parkInfo['description']); ?> </p>

<?php 
    // $activities = (array) $parkInfo;
    // print_r($activities);
?>