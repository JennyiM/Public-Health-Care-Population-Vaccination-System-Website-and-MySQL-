

    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Age Group</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_age_group'">Add age in age group</button>
                <div class="col-lg-4 mb-3">
                    <label for="groupID">group ID</label>
                    <input type="text" name="groupID" placeholder="group ID"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_group" class="btn btn-dark pull-right" value="Search age" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Group ID</th>
                    <th scope="col" role="columnheader">Start Date</th>
                    <th scope="col" role="columnheader">End Date</th>
                    <th scope="col" role="columnheader">Age</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $groupID = 0;
                  if (isset($_POST['search_group'])) {
                      $groupID = (int) $_POST['groupID'];

                  }
                
                display_ageGroup($groupID); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
