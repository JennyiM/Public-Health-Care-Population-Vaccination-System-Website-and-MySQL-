<?php add_facility(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?person">facility</a></li>
                <li class="breadcrumb-item active" aria-current="page">add facility</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>add person in system</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="facilityName">Facility Name</label>
                    <input type="text" name="facilityName" placeholder="Facility name"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="type">type</label>
                    <input type="text"  name="type" placeholder="type" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="capacity">Capacity</label>
                    <input type="text" name="capacity" placeholder="capacity" aria-describedby="inputGroupPrepend3"  >
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="address">Address</label>
                    <input type="text"  name="address" placeholder="address" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text"  name="phone" placeholder="phone" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="webaddress">WebAddress</label>
                    <input type="text"  name="webAddress" placeholder="webAddress" >
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="managerID">managerID</label>
                    <input type="text"  name="managerID" placeholder="managerID" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="totalNumEmployee">totalNumEmployee</label>
                    <input type="text"  name="totalNumEmployee" placeholder="totalNumEmployee" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="totalNumNurse">totalNumNurse</label>
                    <input type="text"  name="totalNumNurse" placeholder="totalNumNurse">
                </div>
            </div>
           
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="province">province</label>
                    <input type="text"  name="province" placeholder="province" >
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="openHours">Open hours</label>
                    <input type="text"  name="openHours" placeholder="openHours">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="closeHours">Close hours</label>
                    <input type="text"  name="closeHours" placeholder="closeHours" >
                </div>

            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_facility" class="btn btn-dark pull-right" value="Add New Facility" >
                </div>
            </div>
        </form>
    </div>
</div>
