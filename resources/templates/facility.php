

    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">facility</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_facility'">Add facility</button>
    
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text" name="facilityID" placeholder="Facility ID"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_facility" class="btn btn-dark pull-right" value="Search Facility" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Facility ID</th>
                    <th scope="col" role="columnheader">Facility name</th>
                    <th scope="col" role="columnheader">Type</th>
                    <th scope="col" role="columnheader">Capacity</th>
                    <th scope="col" role="columnheader">Address</th>
                    <th scope="col" role="columnheader">Phone</th>
                    <th scope="col" role="columnheader">Websites</th>
                    <th scope="col" role="columnheader">ManagerID</th>
                    <th scope="col" role="columnheader">Total Number of Employee</th>
                    <th scope="col" role="columnheader">Total Number of Nurse</th>
                    <th scope="col" role="columnheader">Province</th>
                    <th scope="col" role="columnheader">Open Hours</th>
                    <th scope="col" role="columnheader">Close Hours</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $facilityID = 0;
                  if (isset($_POST['search_facility'])) {
                      $facilityID = (int) $_POST['facilityID'];
                  }
                
                display_facility($facilityID); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
