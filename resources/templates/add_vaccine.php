<?php add_vaccine_type(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?vaccine_type">Vaccine type</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add new vaccine</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Add new vaccine</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">

            <div class="col-lg-4 mb-3">
                    <label for="lotNumber">lot number</label>
                    <input type="text" name="lotNumber" placeholder="lotNumber" aria-describedby="inputGroupPrepend3" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="type">Vaccine type</label>
                    <input type="text"  name="type" placeholder="type"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="suspenedDate">suspened Date</label>
                    <input type="text" name="suspenedDate" placeholder="suspenedDate" aria-describedby="inputGroupPrepend3">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="approvedDate">approved Date</label>
                    <input type="text" name="approvedDate" placeholder="approvedDate" aria-describedby="inputGroupPrepend3" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="status">status</label>
                    <input type="text" name="status" placeholder="status" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_vaccine_type" class="btn btn-dark pull-right" value="Add new vaccine" >
                </div>
            </div>
        </form>
    </div>
</div>