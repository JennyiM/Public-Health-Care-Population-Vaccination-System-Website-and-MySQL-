<?php require_once("resources/config.php");?>
<?php include(TEMPLATE . "/header.php"); ?>


<?php
              if($_SERVER['REQUEST_URI'] == "/COMP353_Covid19/index.php" )  {


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


               if(isset($_GET['products'])){


                include(TEMPLATE . "/products.php");


              }


               if(isset($_GET['add_product'])){


                  include(TEMPLATE . "/add_product.php");


              }


               if(isset($_GET['edit_product'])){


                  include(TEMPLATE . "/edit_product.php");


              }



              if(isset($_GET['add_user'])){


                    include(TEMPLATE . "/add_user.php");


              }


               if(isset($_GET['edit_user'])){


                  include(TEMPLATE . "/edit_user.php");


              }

              if(isset($_GET['delete_order_id'])){


                    include(TEMPLATE . "/delete_order.php");


              }

              if(isset($_GET['delete_product_id'])){


                  include(TEMPLATE . "/delete_product.php");

              }

              if(isset($_GET['delete_user_id'])){


                  include(TEMPLATE . "/delete_user.php");


              }
              
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