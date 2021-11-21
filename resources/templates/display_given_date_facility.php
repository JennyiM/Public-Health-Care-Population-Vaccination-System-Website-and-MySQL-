
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">DisplayResult</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <!--<button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_appointment_check'"></button>
-->
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text" name="facilityID" placeholder="facilityID"  required>
                    <label for="date">Search Date</label>
                    <input type="text" name="date" placeholder="date"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_date_facility" class="btn btn-dark pull-right" value="Search date Facility" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
        <h4>Worker Schedule</h4>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">First Name</th>
                    <th scope="col" role="columnheader">Last Name</th>
                    <th scope="col" role="columnheader">Title</th>
                    <th scope="col" role="columnheader">Start Time</th>
                    <th scope="col" role="columnheader">End Time</th>
                    <th scope="col" role="columnheader">Start Date</th>
                    <th scope="col" role="columnheader">End Date</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $facilityID = 0;
                $date = "";
                  if (isset($_POST['search_date_facility'])) {
                      $facilityID = (int) $_POST['facilityID'];
                      $date = $_POST['date'];
                  }
                
                  display_given_date_facility($facilityID,$date); 
                
                
                ?>
              
                </tbody>
            </table>
            <h4>Appointment</h4>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">First Name</th>
                    <th scope="col" role="columnheader">Last Name</th>
                    <th scope="col" role="columnheader">Date</th>
                    <th scope="col" role="columnheader">Timeslot</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $facilityID = 0;
                $date = "";
                  if (isset($_POST['search_date_facility'])) {
                      $facilityID = (int) $_POST['facilityID'];
                      $date = $_POST['date'];
                  }
                
                  display_given_date_facility_appointment($facilityID,$date); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
