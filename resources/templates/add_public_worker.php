<?php add_public_worker(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?public_worker">public worker</a></li>
                <li class="breadcrumb-item active" aria-current="page">public worker information</li>
            </ol>
        </nav>
        <!--  public worker information-->
        <h4>add public worker</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="SSN">Social Security Number</label>
                    <input type="text" name="SSN" placeholder="SSN"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="SSN">Title</label>
                    <input type="text"  name="title" placeholder="Title"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="personID">PersonID</label>
                    <input type="text" name="personID" placeholder="personID" required>
                </div>
            </div>
            
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_public_worker" class="btn btn-dark pull-right" value="Add Public Worker" >
                </div>
            </div>
        </form>
    </div>
</div>
