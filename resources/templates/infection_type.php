<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Infection Type</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_infection_type'">Add infection type</button>
                <div class="col-lg-4 mb-3">
                    <label for="infection_type">Infection Type</label>
                    <input type="text" name="typeID" placeholder="Infection Type"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_infection_type" class="btn btn-dark pull-right" value="Search Infection Type" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Type ID</th>
                    <th scope="col" role="columnheader">Virus Type</th>
                   
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $typeID = -1;
                  if (isset($_POST['search_infection_type'])) {
                     $typeID = (int)$_POST['typeID'];

                  }
                
                display_infection_type($typeID); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>