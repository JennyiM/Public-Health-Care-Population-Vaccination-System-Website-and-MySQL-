<?php add_assigned(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?assigned">assigned</a></li>
                <li class="breadcrumb-item active" aria-current="page">assigned information</li>
            </ol>
        </nav>
        <!--  assigned information-->
        <h4>add assigned</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="SSN">Social Security Number</label>
                    <input type="text" name="SSN" placeholder="SSN"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="employee_ID">employee_ID</label>
                    <input type="text"  name="employee_ID" placeholder="employee_ID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="startDate">startDate</label>
                    <input type="text" name="startDate" placeholder="startDate" required>
                </div>
            </div>
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="endDate">endDate</label>
                    <input type="text" name="endDate" placeholder="endDate"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">facilityID</label>
                    <input type="text"  name="facilityID" placeholder="facilityID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="hourly_rate">hourly_rate</label>
                    <input type="text" name="hourly_rate" placeholder="hourly_rate" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="startTime">Start Hour</label>
                    <input type="text" name="startTime" placeholder="startTime"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="endTime">End Hour</label>
                    <input type="text"  name="endTime" placeholder="endTime"  required>
                </div>
            </div>
            
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_assigned" class="btn btn-dark pull-right" value="Add assigned" >
                </div>
            </div>
        </form>
    </div>
</div>
