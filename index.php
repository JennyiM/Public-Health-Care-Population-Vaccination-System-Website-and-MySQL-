<?php require_once("resources/config.php");?>
<?php include(TEMPLATE . "/header.php"); ?>


<?php
              if($_SERVER['REQUEST_URI'] == "/index.php" )  {


                  include(TEMPLATE . "/admin_content.php");

              }
//person              
              if(isset($_GET['person'])){
          
          
                  include(TEMPLATE . "/person.php");
          
          
              }
              
              if(isset($_GET['add_person_in'])){
          
          
                  include(TEMPLATE . "/add_person_in.php");
          
          
              }

              if(isset($_GET['add_person_out'])){
          
          
                include(TEMPLATE . "/add_person_out.php");
        
        
            }
            if(isset($_GET['delete_person'])){
          
          
                include(TEMPLATE . "/delete_person.php");
        
        
            }

              if(isset($_GET['edit_inperson'])){


                  include(TEMPLATE . "/edit_inperson.php");


              }
              if(isset($_GET['edit_outperson'])){


                 include(TEMPLATE . "/edit_outperson.php");


             }

//appointment

               if(isset($_GET['appointment'])){


                include(TEMPLATE . "/appointment.php");


              }


               if(isset($_GET['add_appointment_check'])){


                  include(TEMPLATE . "/add_appointment_check.php");


              }

              if(isset($_GET['add_appointment'])){


                include(TEMPLATE . "/add_appointment.php");


            }


//public worker--------------------------------------------------------------              

               if(isset($_GET['public_worker'])){


                include(TEMPLATE . "/public_worker.php");


              }


               if(isset($_GET['add_public_worker'])){


                  include(TEMPLATE . "/add_public_worker.php");


              }


               if(isset($_GET['edit_public_worker'])){


                  include(TEMPLATE . "/edit_public_worker.php");


              }

              if(isset($_GET['delete_public_worker'])){


                include(TEMPLATE . "/delete_public_worker.php");


            }


//assigned-----------------------------------------------------------

              if(isset($_GET['assigned'])){


                    include(TEMPLATE . "/assigned.php");


              }


               if(isset($_GET['add_assigned'])){


                  include(TEMPLATE . "/add_assigned.php");


              }

              if(isset($_GET['edit_assigned'])){


                    include(TEMPLATE . "/edit_assigned.php");


              }

              if(isset($_GET['delete_assigned'])){


                  include(TEMPLATE . "/delete_assigned.php");

              }


//facility
              
              if(isset($_GET['facility'])){


                include(TEMPLATE . "/facility.php");


            }
            if(isset($_GET['edit_facility'])){


                include(TEMPLATE . "/edit_facility.php");


            }
            if(isset($_GET['add_facility'])){


                include(TEMPLATE . "/add_facility.php");


            }
            if(isset($_GET['delete_facility'])){


                include(TEMPLATE . "/delete_facility.php");


            }

            if(isset($_GET['perform_vaccine'])){


                include(TEMPLATE . "/perform_vaccine.php");


            }
            if(isset($_GET['perform_vaccine_withapm'])){


                include(TEMPLATE . "/perform_vaccine_withapm.php");


            }
            if(isset($_GET['performingform'])){


                include(TEMPLATE . "/performingform.php");


            }

               ?>
<?php include(TEMPLATE . "/footer.php") ?>
