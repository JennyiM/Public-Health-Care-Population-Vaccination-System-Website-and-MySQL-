<?php add_appointment(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?appointment">Appointment</a></li>
                <li class="breadcrumb-item active" aria-current="page">appointment information</li>
            </ol>
        </nav>
        <!--  appointment information-->
        <h4>add appointment</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text"  name="facilityI" placeholder="Facility ID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="text" name="date" placeholder="Date" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="timeslot">Timeslot</label>
                    <input type="text"  name="timeslot" placeholder="Timeslot" required>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_appointment" class="btn btn-dark pull-right" value="Add Appointment" >
                </div>
            </div>
        </form>
    </div>
</div>
