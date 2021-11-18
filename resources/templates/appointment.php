
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">appointment</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_appointment_check'">Add appointment</button>
                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="person ID"  required>
                    <label for="doseNumber">Dose Number</label>
                    <input type="text" name="doseNumber" placeholder="Dose Number"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_appointment" class="btn btn-dark pull-right" value="Search Appointment" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Person ID</th>
                    <th scope="col" role="columnheader">Facility ID</th>
                    <th scope="col" role="columnheader">Date</th>
                    <th scope="col" role="columnheader">Dose Number</th>
                    <th scope="col" role="columnheader">Time Slot</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $personID = 0;
                $doseNumber = "";
                  if (isset($_POST['search_appointment'])) {
                      $personID = (int) $_POST['personID'];
                      $doseNumber = $_POST['doseNumber'];
                  }
                
                 display_appointment($personID,$doseNumber); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
