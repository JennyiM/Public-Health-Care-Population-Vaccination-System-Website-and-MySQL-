<?php add_person_in(); ?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?person">person</a></li>
                <li class="breadcrumb-item active" aria-current="page">person information</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>add person in system</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="firstname">First name</label>
                    <input type="text" name="firstname" placeholder="First name"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="lastname">Last name</label>
                    <input type="text"  name="lastname" placeholder="Last name"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="birthDate">Date of Birth</label>
                    <input type="text" name="birthDate" placeholder="birthDate" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="citizenship">Citizenship</label>
                    <input type="text"  name="citizenship" placeholder="Citizenship" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="city">City</label>
                    <input type="text"  name="city" placeholder="city" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="province">Province</label>
                    <input type="text"  name="province" placeholder="Province" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="address">Address</label>
                    <input type="text"  name="address" placeholder="address" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="postcode">Post Code</label>
                    <input type="text"  name="postcode" placeholder="Postcode" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text"  name="phone" placeholder="Phone" required>
                </div>
            </div>
           
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="email">Email</label>
                    <input type="text"  name="email" placeholder="Email" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="medicalCardNum">Medical Card Number</label>
                    <input type="text"  name="medicalCardNum" placeholder="Medical Card Number" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="mCardIssueDate">Medical Card Issue Date</label>
                    <input type="text"  name="mCardIssueDate" placeholder="Medical Card Issue Date" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="mCardEndDate">Medical Card End Date</label>
                    <input type="text"  name="mCardEndDate" placeholder="Medical Card End Date" required>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Delete</a>
                      <input type="submit" name="add_person_in" class="btn btn-dark pull-right" value="Add Person In System" >
                </div>
            </div>
        </form>
    </div>
</div>
