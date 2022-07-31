<?php 
   include_once 'config.php';
   require_once "controllerUserData.php"; 
   ?>
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
<html lang="en" dir="ltr">
   <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> DEMS Homepage </title>
      
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/home.css">
      
   </head>
   <body>
      <div class="sidebar">
         <div class="logo-details">
            <i class='bx bx-cube' ></i>
            <span class="logo_name">DEMS</span>
         </div>
         <ul class="nav-links">
            <li>
               <a href="home.php" class="active">
               <i class='bx bx-home'></i>
               <span class="links_name">Home</span>
               </a>
            </li>
            <li>
               <a href="profile.php">
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
            <div class="overview-boxes">
               <div class="box">
                   <a href="digital_asset.php" style="text-decoration:none; color:black;">
                  <div class="right-side">
                     
                     <i class='bx bx-dollar-circle'></i>
                     <div class="box-topic">Digital Asset</div>
                  </div>
               </div>
               <div class="box">
                    <a href="beneficiaries.php" style="text-decoration:none; color:black;">
                  <div class="left-side">
                     <i class='bx bxs-user'></i>
                     <div class="box-topic">Beneficiaries </div>
                  </div>
               </div>
            </div>
            <div class=overview-boxes>
               <div class="box">
                   <a href="executor.php" style="text-decoration:none; color:black;">
                  <div class="left-side">
                     <i class='bx bxs-contact' ></i>
                     <div class="box-topic">Executor </div>
                  </div>
               </div>
               <div class="box">
                   <a href="will.php" style="text-decoration:none; color:black;">
                  <div class="right-side">
                     <i class='bx bx-receipt'></i>
                     <div class="box-topic">Will</div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
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
   </body>
</html>