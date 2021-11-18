<?php add_age_group(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?age_group">Age Group</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add age in age group</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Add Age Group</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                
                <div class="col-lg-4 mb-3">
                    <label for="startDate">Start Date</label>
                    <input type="text"  name="startDate" placeholder="start Date"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="endDate">End Date</label>
                    <input type="text" name="endDate" placeholder="endDate" aria-describedby="inputGroupPrepend3" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="age">age</label>
                    <input type="text" name="age" placeholder="age" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="add_age_group" class="btn btn-dark pull-right" value="Add age in age group" >
                </div>
            </div>
        </form>
    </div>
</div>
