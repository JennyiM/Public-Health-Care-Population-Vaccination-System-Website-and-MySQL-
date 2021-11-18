<?php add_infection_type();?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?infection_type">infection type</a></li>
                <li class="breadcrumb-item active" aria-current="page">add infection type</li>
            </ol>
        </nav>
        <!--  infection information-->
        <h4>add infection type in system</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                
                <div class="col-lg-4 mb-3">
                    <label for="virus_type">Virus Type</label>
                    <input type="text"  name="virus_type" placeholder="Virus Type"  required>
                </div>

            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_infection_type" class="btn btn-dark pull-right" value="Add Infection Type In System" >
                </div>
            </div>
        </form>
    </div>
</div>