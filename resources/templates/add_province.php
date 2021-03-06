<?php add_province();?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?province">province</a></li>
                <li class="breadcrumb-item active" aria-current="page">add province</li>
            </ol>
        </nav>
        <!--  province information-->
        <h4>add province in system</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="provinceName">Province name</label>
                    <input type="text" name="provinceName" placeholder="province Name"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="provStartDate">Province Start Date</label>
                    <input type="text"  name="provStartDate" placeholder="Province Start Date"  required>
                </div>

                <div class="col-lg-4 mb-3">
                    <label for="vacAgeGroup">Vaccination Age Group</label>
                    <input type="text"  name="vacAgeGroup" placeholder="Vaccination Age Group"  required>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_province" class="btn btn-dark pull-right" value="Add Province In System" >
                </div>
            </div>
        </form>
    </div>
</div>
