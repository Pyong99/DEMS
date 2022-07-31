<?php
require_once "controllerUserData.php";
require_once "controllerUserData.php"; ?>

<?php 
   $email = $_SESSION['email'];
   $password = $_SESSION['password'];
   if($email != false && $password != false){
       $sql = "SELECT * FROM usertable WHERE email = '$email'";
       $run_Sql = mysqli_query($con, $sql);
       if($run_Sql){
           $fetch_info = mysqli_fetch_assoc($run_Sql);
           $status = $fetch_info['status'];
           $code = $fetch_info['code'];
           $id=$fetch_info['id'];
           $_SESSION['id'] =$fetch_info['id'];
           if($status == "verified"){
               if($code != 0){
                   header('Location: reset-code.php');
               }
           }else{
               header('Location: user-otp.php');
           }
       }
   }else{
       header('Location: login-user.php');
   }
   ?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> My Profile </title>
      <link rel="stylesheet" href="css/home.css">
      
      <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
      <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css	">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js	"></script>
      <style>
         body {
         height: 100%;
         overflow-y: hidden;
         background: #1373ab;
         }
         .container {
         height:82vh;
         width:77vw;
         } 
         .form-control:focus {
         box-shadow: none;
         border-color: #1373ab;
         }
         .profile-button {
         background: #1373ab;
         box-shadow: none;
         border: none
         }
         .profile-button:hover {
         background: #4493c2;
         }
         .profile-button:focus {
         background: #4493c2;
         box-shadow: none
         }
         .profile-button:active {
         background: #4493c2;
         box-shadow: none
         }
         .back:hover {
         color: #4493c2;
         cursor: pointer
         }
         .labels {
         font-size: 11px
         }
         .add-experience:hover {
         background: #4493c2;
         color: #fff;
         cursor: pointer;
         border: solid 1px #4493c2;
         }
         #btnUpdate{
             margin-left:30px;
         }
      </style>
   </head>
   <body>
      <div class="sidebar">
         <div class="logo-details">
            <i class='bx bx-cube' ></i>
            <span class="logo_name">DEMS</span>
         </div>
         <ul class="nav-links">
            <li>
               <a href="home.php">
               <i class='bx bx-home'></i>
               <span class="links_name">Home</span>
               </a>
            </li>
            <li>
               <a href="profile.php" class="active">
               <i class='bx bxs-user'></i>
               <span class="links_name">Profile</span>
               </a>
            </li>
            <li>
               <a href="digital_asset.php">
               <i class='bx bx-dollar-circle'></i>
               <span class="links_name">Digital Asset</span>
               </a>
            </li>
            <li>
               <a href="beneficiaries.php">
               <i class='bx bx-male-female'></i>
               <span class="links_name">Beneficiaries</span>
               </a>
            </li>
            <li>
               <a href="executor.php">
               <i class='bx bxs-contact' ></i>
               <span class="links_name">Executor</span>
               </a>
            </li>
            <li>
               <a href="will.php">
               <i class='bx bx-receipt'></i>
               <span class="links_name">Will</span>
               </a>
            </li>
            <li class="log_out">
               <a href="logout-user.php">
               <i class='bx bx-log-out'></i>
               <span class="links_name">Log out</span>
               </a>
            </li>
         </ul>
      </div>
      <section class="home-section">
         <nav>
            <div class="sidebar-button">
               <i class='bx bx-menu sidebarBtn'></i>
               <span class="dashboard">Home</span>
            </div>
           
            <div class="profile-details">
               <!--<img src="images/profile.jpg" alt="">-->
               <span class="admin_name"><?php echo $fetch_info['name'] ?></span>
               <i class='bx bx-chevron-down' ></i>
            </div>
         </nav>
         <div class="home-content">
            <div >
               <div class="container rounded bg-white">
                  <div class="row">
                     <!--Profile pic-->
                     <div class="col-md-3 border-right" style="display: flex; align-items: center;">
                        <div class="d-flex flex-column justify-content-center align-items-center p-3 py-5" style="align-items: center; text-align: center; ">
                           <div class="align-self-center"><span class="font-weight-bold"><?php echo $fetch_info['name'] ?></span></div>
                           <div class="align-self-center"><span class="text-black-50"><?php echo $fetch_info['email'] ?></span></div>
                        </div>
                     </div>
                     <div class="col-md-6 ">
                        <div class="p-3 py-3">
                           <div class="d-flex justify-content-between align-items-center">
                               <h4 class="text-right">My Profile</h4>
                              <!--<a  id=linkEdit name=linkEdit>Edit Profile</a>-->
                           </div>
                           <form action="profile_update.php?id=<?php echo $id; ?>" method="POST">
                              <div class="row mt-2">
                                 <div class="col-md-12"><label class="labels">Fullname</label>
                                 <input type="text" id=fullname name=fullname class="form-control" placeholder="<?php echo $fetch_info['name'] ?>" value="<?php echo $fetch_info['name'] ?>" ></div>
                              </div>
                              <div class="row mt-2">
                                 <div class="col-md-12"><label class="labels">IC Number</label>
                                 <input type="text" id=user_ic name=user_ic class="form-control" placeholder="<?php echo $fetch_info['user_ic'] ?>" value="<?php echo $fetch_info['user_ic'] ?>" ></div>
                              </div>
                              <div class="row mt-2">
                                 <div class="col-md-12"><label class="labels">Phone Number</label>
                                 <input type="text" id=user_phoneNo name=user_phoneNo class="form-control" placeholder="<?php echo $fetch_info['user_phoneNo'] ?>" value="<?php echo $fetch_info['user_phoneNo'] ?>" ></div>
                              </div>
                              <div class="row mt-2">
                                 <div class="col-md-12"><label class="labels">Address</label>
                                 <input type="text" id=user_address name=user_address class="form-control" placeholder="<?php echo $fetch_info['user_address'] ?>" value="<?php echo $fetch_info['user_address'] ?>" </div>
                              </div>
                              
                              <div class="row mt-4">
                                 
                                 <button class="btn btn-primary profile-button" id=btnUpdate name="submit" type="submit">
                                        Update Profile
                                </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
         </div>
      </section>
      <script>
         let sidebar = document.querySelector(".sidebar");
         let sidebarBtn = document.querySelector(".sidebarBtn");
         sidebarBtn.onclick = function() {
         sidebar.classList.toggle("active");
         if(sidebar.classList.contains("active")){
         sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
         }else
         sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
         }
      </script>
      <script>
         $(document).ready(function(){
             $('#linkEdit').click(function(){
                 // $("input[name='fullname']").removeAttr( "readonly" ); 
                 // $("input[name='user_ic']").removeAttr( "readonly" ); 
                 // $("input[name='user_phoneNo']").removeAttr( "readonly" ); 
                 // $("input[name='user_address']").removeAttr( "readonly" ); 
             });
             
             $('.btnEdit').on('click', function () {
                 var prev = $(this).prev('input'),
                 ro   = prev.prop('readonly');
                 prev.prop('readonly', !ro).focus();
                 $(this).val(ro ? 'Save' : 'Edit');
             });
         });
      </script>
   </body>
</html>