
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assignment</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_assignment'">Add Assignment</button>
                <div class="col-lg-4 mb-3">
                    <label for="SSN">SSN</label>
                    <input type="text" name="SSN" placeholder="SSN"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_assignment" class="btn btn-dark pull-right" value="Search Assignment" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Social Securtiy Number</th>
                    <th scope="col" role="columnheader">First name</th>
                    <th scope="col" role="columnheader">Last name</th>
                    <th scope="col" role="columnheader">Facility Name</th>
                    <th scope="col" role="columnheader">Title</th>
                    <th scope="col" role="columnheader">Start Date</th>
                    <th scope="col" role="columnheader">End Date</th>
                    <th scope="col" role="columnheader">Hourly Rate</th>
                    <th scope="col" role="columnheader"></th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $SSN = 0;
                  if (isset($_POST['search_assignment'])) {
                      $SSN = (int) $_POST['SSN'];

                  }
                
                display_assignment($SSN); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
