<html>
  <head>
    <!-- headerinfo contains libraries, frameworks, titles, etc.-->
    <?php require('scripts/headerinfo.php'); ?>
  </head>
  <body>


    <!-- style contains CSS code -->
    <?php require('scripts/style.php'); ?>
    <!-- Nav Menu -->
    <?php require('scripts/navmenu.php'); ?>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    Home
                </li>
            </ol>
        </nav>
    </div>

    <div id="choices">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <h6>Activities Avalible:
            </h6>
            <hr />
            <div class="activity-list">
              <!-- Activities list is loaded here -->
              <?php require('apicall/activities.php'); ?>
            </div>    
          </div>
          <div class="col-lg-8">
            <h6>Activities Selected (Click/touch to deselect):
            </h6>
            <hr />
            <div class="activity-list">
              <div class="btn-activity">
                <!-- Choosen activies displayed here.  -->
                <button v-for="activity in activities" type="button" class="btn btn-outline-secondary m-2"
                        v-bind:value= "activity.id" v-on:click="remove(activity.id)">
                  {{ activity.message }}
                </button>
              </div>
            </div>
          </div>
        </div>
        <form action="results.php" method="post">
          <!-- Note: This input box is utilized to send the information gathered from
               the list of activities handled with vue to pass to php. -->
          <div class=" mt-5"></div>
          <?php require('scripts/states.php'); ?>
          <input type="text" name="activitiesID" v-bind:value= "activitiesList" hidden>
          <input type="submit" class="btn btn-secondary mt-2">                    
        </form>
      </div> 
    </div>

    <!-- Loads vue framework code for the index.php file -->
    <?php require('scripts/vuecode/vueindex.php'); ?>

    <!-- Loads Footer -->
    <?php require('scripts/footer.php'); ?>
    
  </body>
</html>