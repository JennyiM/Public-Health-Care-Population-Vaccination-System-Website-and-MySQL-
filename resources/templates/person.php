

    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">person</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_person_in'">Add person in system</button>
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_person_out'">Add person out system</button>
                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_person" class="btn btn-dark pull-right" value="Search Person" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Person ID</th>
                    <th scope="col" role="columnheader">First name</th>
                    <th scope="col" role="columnheader">Last name</th>
                    <th scope="col" role="columnheader">Date of Birth</th>
                    <th scope="col" role="columnheader">Citizenship</th>
                    <th scope="col" role="columnheader">City</th>
                    <th scope="col" role="columnheader">Province</th>
                    <th scope="col" role="columnheader">Address</th>
                    <th scope="col" role="columnheader">Post Code</th>
                    <th scope="col" role="columnheader">Phone</th>
                    <th scope="col" role="columnheader">Email</th>
                    <th scope="col" role="columnheader"></th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $personID = 0;
                  if (isset($_POST['search_person'])) {
                      $personID = (int) $_POST['personID'];

                  }
                
                display_person($personID); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
