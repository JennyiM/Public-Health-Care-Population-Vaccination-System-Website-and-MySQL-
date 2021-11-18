

    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Province</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
            <button type="button" class="btn btn-dark btn-adduser"onclick="window.location.href='index.php?add_province'">Add province</button>
                <div class="col-lg-4 mb-3">
                    <label for="provinceName">Province Name</label>
                    <input type="text" name="provinceName" placeholder="Province Name"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_province" class="btn btn-dark pull-right" value="Search Province" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Province Name</th>
                    <th scope="col" role="columnheader">Province Start Date</th>
                    <th scope="col" role="columnheader">Vaccine Age Group</th>
                   
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $provinceName = '';
                  if (isset($_POST['search_province'])) {
                     $provinceName = $_POST['provinceName'];

                  }
                
                display_province($provinceName); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
