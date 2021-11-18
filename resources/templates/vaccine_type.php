

    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vaccine Type</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_vaccine'">Add New Vaccin information</button>
                <div class="col-lg-4 mb-3">
                    <label for="lotNumber">lot number</label>
                    <input type="text" name="lotNumber" placeholder="lot Number"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_vaccine" class="btn btn-dark pull-right" value="Search vaccine" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">lot number</th>
                    <th scope="col" role="columnheader">vaccin type</th>
                    <th scope="col" role="columnheader">suspended date</th>
                    <th scope="col" role="columnheader">approved date</th>
                    <th scope="col" role="columnheader">status</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $lotNumber="";
                  if (isset($_POST['search_vaccine'])) {
                      $lotNumber = $_POST['lotNumber'];

                  }
                
                display_vaccintype($lotNumber); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
