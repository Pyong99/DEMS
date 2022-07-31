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
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> My Will Executors </title>
      <link rel="stylesheet" href="css/home.css">
      
      <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <!--Old css for datatable-->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
      <!--New css for datatable-->
      <!--<link rel"stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <style>
         .table{
        width: 75vw;
        /*height: 100vh;*/
    }
    .td
    {
        ...
        white-space:nowrap;
        /*overflow: hidden; */
        /*text-overflow: ellipsis; */
        /*word-wrap: break-word;*/
    }
     @media (min-width: 75vw) {
    .container{
        max-width: 79vw;
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
               <a href="home.php" >
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
               <a href="executor.php" class="active">
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
            <!-- Modal -->
            <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Executor  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="executor_add.php" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">
                           <div class="form-group">
                              <label> Executor Name: </label>
                              <input type="text" name="executor_name" class="form-control" placeholder="Enter name" required>
                              <div class="invalid-feedback">
                                 Name field cannot be empty
                              </div>
                           </div>
                           <div class="form-group">
                              <label> IC Number: </label>
                              <input type="text" name="executor_ic" class="form-control" placeholder="Enter IC number" pattern="[0-9]{12}" required >
                              <div class="invalid-feedback">
                                 IC number must be consist of 12 digit numbers (E.g: 550203019657)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Phone Number: </label>
                              <input type="tel" name="executor_phoneNo" class="form-control" placeholder="Enter phone number" pattern="[0-9]{9,14}" required>
                              <div class="invalid-feedback">
                                 Phone number must contain at least 9 digit numbers (E.g: 0198765432)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Email: </label>
                              <input type="email" name="executor_email" class="form-control" placeholder="Enter email address"   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                              <div class="invalid-feedback">
                                 Email address must contain a single @ (E.g: johndoe@gmail.com)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> State: </label>
                              <select class="form-control" name="executor_state" placeholder="Select state" required>
                                 <option value=""selected="selected">Select state</option>
                                 </option>
                                 <option value="Johor">Johor</option>
                                 <option value="Kedah">Kedah</option>
                                 <option value="Kelantan">Kelantan</option>
                                 <option value="Kuala Lumpur">Kuala Lumpur</option>
                                 <option value="Labuan">Labuan</option>
                                 <option value="Melaka">Melaka</option>
                                 <option value="Negeri">Negeri Sembilan</option>
                                 <option value="Pahang">Pahang</option>
                                 <option value="Penang">Penang</option>
                                 <option value="Perak">Perak</option>
                                 <option value="Perlis">Perlis</option>
                                 <option value="Putrajaya">Putrajaya</option>
                                 <option value="Sabah">Sabah</option>
                                 <option value="Sarawak">Sarawak</option>
                                 <option value="Selangor">Selangor</option>
                                 <option value="Terengganu">Terengganu</option>
                              </select>
                              <div class="invalid-feedback">
                                 State field cannot be empty
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="submit" name="insertdata" class="btn btn-primary">Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <?php
               //set user id
               $sql_delete = "SELECT * FROM executor WHERE user_id = $id";
               $run_sql_delete = mysqli_query($con, $sql_delete);
               if($run_sql_delete){
                   $row = mysqli_fetch_assoc($run_sql_delete);
                   $executor_id=$row['executor_id'];
               }
               ?>
            <?php
               //set user id
               $sql_edit = "SELECT * FROM executor WHERE executor_id=$executor_id";
               $run_sql_edit = mysqli_query($con, $sql_edit);
               if($run_sql_edit){
                   $row_edit = mysqli_fetch_assoc($run_sql_edit);
                   //$executor_id=$row_edit['executor_id'];
               }
               ?>
                           <div id="table container" class="container p-3 my-3 bg-white">

            <div class="col"><h2> My Executor </h2></div>
                <div class="w-100"></div>
                <div class="col"><button type="button" class="btn btn-primary addbtn" data-toggle="modal" data-target="#studentaddmodal">
                Add New
                </button></div>
                <br>
                <div class="col">
                  
                           <table id="datatableid" class="table table-bordered table-sm">
                              <thead>
                                 <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Phone No.</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">State </th>
                                    <th scope="col">Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    require "config.php";
                                    
                                    //$connection = mysqli_connect("localhost","root","");
                                    $query = "SELECT * FROM executor WHERE user_id='$id'";
                                    $query_run = mysqli_query($con, $query);
                                    
                                       if($query_run)
                                       {
                                           $i=1;
                                           foreach($query_run as $row)
                                           {
                                               $executor_id = $row['executor_id'];
                                              
                                       ?>
                                 <tr>
                                    <td width="4">
                                       <?php
                                          echo $i;
                                          $i++;
                                          ?>
                                    </td>
                                    <td> <?php echo $row['executor_name']; ?> </td>
                                    <td> <?php echo $row['executor_ic']; ?> </td>
                                    <td> <?php echo $row['executor_phoneNo']; ?> </td>
                                    <td> <?php echo $row['executor_email']; ?> </td>
                                    <td> <?php echo $row['executor_state']; ?> </td>
                                    <!--<td>-->
                                    <!--   <button type="button" data-toggle="modal" data-target="#viewmodal" data-id="<?php echo $row['executor_id'] ?>" class="btn btn-info viewbtn"> VIEW </button>-->
                                    <!--</td>-->
                                    <td>
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                            <button id="editbutton" type="button" data-toggle="modal" data-target="#editmodal" data-id="<?php echo $row[
                                            "executor_id"
                                        ]; ?>" class="btn btn-success editbtn"><i class="fa fa-edit" style="font-size:18px"></i> </button>
                                        </div>
                                      
                                        <div class="col-4 offset-1">
                                            <button id="deletebutton" type="button" data-toggle="modal" data-target="#deletemodal" data-id="<?php echo $row[
                                            "executor_id"
                                        ]; ?>" class="btn btn-danger deletebtn"><i class="fa fa-trash-o" style="font-size:18px"></i> </button>
                                        </div>
                                        </div>
                                      </td>
                                 </tr>
                                 <?php           
                                    }
                                    }
                                    else 
                                    {
                                    echo "No Record Found";
                                    }
                                    ?>
                              </tbody>
                           </table>
                        
               </div>
            </div>
            </div>
            <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Executor Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="executor_edit.php?id=<?php echo $row['executor_id']?>" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">
                           <input type="hidden" name="update_id" id="update_id">
                           <div class="form-group">
                              <label> Executor Name: </label>
                              <input type="text" name="executor_name" id="executor_name" class="form-control" value="<?php echo $row_edit['executor_name'] ?>" placeholder="Enter name" required>
                              <div class="invalid-feedback">
                                 Name field cannot be empty
                              </div>
                           </div>
                           <div class="form-group">
                              <label> IC Number: </label>
                              <input type="text" name="executor_ic" id="executor_ic" class="form-control" value="<?php echo trim($row_edit['executor_ic']) ?>" placeholder="Enter IC number" pattern="[0-9]{12}" required>
                              <div class="invalid-feedback">
                                 IC number must be consist of 12 digit numbers (E.g: 550203019657)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Phone Number: </label>
                              <input type="text" name="executor_phoneNo" id="executor_phoneNo" class="form-control" value="<?php echo $row_edit['executor_phoneNo'] ?>" placeholder="Enter phone number" pattern="[0-9]{9,14}" required>
                              <div class="invalid-feedback">
                                 Phone number must contain at least 9 digit numbers (E.g: 0198765432)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Email: </label>
                              <input type="text" name="executor_email" id="executor_email" class="form-control" placeholder="Enter email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                              <div class="invalid-feedback">
                                 Email address must contain a single @ (E.g: johndoe@gmail.com)
                              </div>
                           </div>
                           <!--<div class="form-group">-->
                           <!--    <label> State: </label>-->
                           <!--    <input type="text" name="executor_state" id="executor_state" class="form-control" value="<?php echo $row_edit['executor_state'] ?>" placeholder="Enter state" required>-->
                           <!--</div>-->
                           <div class="form-group">
                              <label> State: </label>
                              <select class="form-control" name="executor_state" id="executor_state" value="<?php echo $row_edit['executor_state'] ?>" placeholder="Select state" required>
                                 <option id="executor_state" value="Johor"<?php if($row_edit['executor_state'] == 'Johor') { ?> selected="selected"<?php } ?>>Johor</option>
                                 <option id="executor_state" value="Kedah"<?php if($row_edit['executor_state'] == 'Kedah') { ?> selected="selected"<?php } ?>>Kedah</option>
                                 <option id="executor_state" value="Kelantan"<?php if($row_edit['executor_state'] == 'Kelantan') { ?> selected="selected"<?php } ?>>Kelantan</option>
                                 <option id="executor_state" value="Kuala Lumpur"<?php if($row_edit['executor_state'] == 'Kuala Lumpur') { ?> selected="selected"<?php } ?>>Kuala Lumpur</option>
                                 <option id="executor_state" value="Labuan"<?php if($row_edit['executor_state'] == 'Melaka') { ?> selected="selected"<?php } ?>>Labuan</option>
                                 <option id="executor_state" value="Melaka"<?php if($row_edit['executor_state'] == 'Negeri Sembilan') { ?> selected="selected"<?php } ?>>Melaka</option>
                                 <option id="executor_state" value="Negeri Sembilan"<?php if($row_edit['executor_state'] == 'Pahang') { ?> selected="selected"<?php } ?>>Negeri Sembilan</option>
                                 <option id="executor_state" value="Pahang"<?php if($row_edit['executor_state'] == 'Pahang') { ?> selected="selected"<?php } ?>>Pahang</option>
                                 <option id="executor_state" value="Penang"<?php if($row_edit['executor_state'] == 'Penang') { ?> selected="selected"<?php } ?>>Penang</option>
                                 <option id="executor_state" value="Perak"<?php if($row_edit['executor_state'] == 'Perak') { ?> selected="selected"<?php } ?>>Perak</option>
                                 <option id="executor_state" value="Perlis"<?php if($row_edit['executor_state'] == 'Perlis') { ?> selected="selected"<?php } ?>>Perlis</option>
                                 <option id="executor_state" value="Putrajaya"<?php if($row_edit['executor_state'] == 'Putrajaya') { ?> selected="selected"<?php } ?>>Putrajaya</option>
                                 <option id="executor_state" value="Sabah"<?php if($row_edit['executor_state'] == 'Sabah') { ?> selected="selected"<?php } ?>>Sabah</option>
                                 <option id="executor_state" value="Sarawak"<?php if($row_edit['executor_state'] == 'Sarawak') { ?> selected="selected"<?php } ?>>Sarawak</option>
                                 <option id="executor_state" value="Selangor"<?php if($row_edit['executor_state'] == 'Selangor') { ?> selected="selected"<?php } ?>>Selangor</option>
                                 <option id="executor_state" value="Terengganu"<?php if($row_edit['executor_state'] == 'Terengganu') { ?> selected="selected"<?php } ?>>Terengganu</option>
                                 <!--<option id="executor_state" value="<?php echo $row_edit['executor_state'] ?>" selected="selected"><?php echo $row_edit['executor_state'] ?></option>-->
                                 <!--<option value="Johor">Johor</option>-->
                                 <!--<option value="Kedah">Kedah</option>-->
                                 <!--<option value="Kelantan">Kelantan</option>-->
                                 <!--<option value="Kuala Lumpur">Kuala Lumpur</option>-->
                                 <!--<option value="Labuan">Labuan</option>-->
                                 <!--<option value="Melaka">Melaka</option>-->
                                 <!--<option value="Negeri Sembilan">Negeri Sembilan</option>-->
                                 <!--<option value="Pahang">Pahang</option>-->
                                 <!--<option value="Penang">Penang</option>-->
                                 <!--<option value="Perak">Perak</option>-->
                                 <!--<option value="Perlis">Perlis</option>-->
                                 <!--<option value="Putrajaya">Putrajaya</option>-->
                                 <!--<option value="Sabah">Sabah</option>-->
                                 <!--<option value="Sarawak">Sarawak</option>-->
                                 <!--<option value="Selangor">Selangor</option>-->
                                 <!--<option value="Terengganu">Terengganu</option>-->
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="submit" name="updatedata" class="btn btn-primary">Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Executor </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="executor_delete.php" method="POST">
                        <div class="modal-body">
                           <input type="hidden" name="delete_id" id="delete_id"">
                           <h4> Are you sure you want to delete this data?</h4>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                           <button type="submit" name="deletedata" class="btn btn-primary btn-confirmdelete"> Delete </button>
                           <!--<a data-id="" class="btn btn-danger confirm-delete">Hapus</a>-->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- VIEW POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> View Executor Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="executor_delete.php" method="POST">
                        <div class="modal-body">
                           <input type="text" name="view_id" id="view_id">
                           <!-- <p id="fname"> </p> -->
                           <!-- <h4 id="fname"> <?php echo ''; ?> </h4> -->
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                           <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!--For modal-->
            <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
            <!--For datatable-->
            <!--Old-->
            <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
            <!--New-->
            <!--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>-->
            <!--<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>-->
            <script>
               $(document).ready(function () {
                   $('.viewbtn').on('click', function () {
                       $('#viewmodal').modal('show');
                       $.ajax({ //create an ajax request to display.php
                           type: "GET",
                           url: "display.php",
                           dataType: "html", //expect html to be returned                
                           success: function (response) {
                               $("#responsecontainer").html(response);
                               //alert(response);
                           }
                       });
                   });
               
               });
            </script>
            <script>
               $(document).ready(function () {
               
                   $('#datatableid').DataTable({
                        responsive: true,
                       pageLength : 5,
                       lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                       
                       language: {
                           search: "_INPUT_",
                           searchPlaceholder: "Search Your Data",
                       }
                   });
               
               });
            </script>
            <script>
               <!--Example starter JavaScript for disabling form submissions if there are invalid fields-->
               (function() {
                'use strict';
                window.addEventListener('load', function() {
                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  var forms = document.getElementsByClassName('needs-validation');
                  // Loop over them and prevent submission
                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
                }, false);
               })();
            </script>
            <script>
               $(document).ready(function () {
               
                   $('.deletebtn').on('click', function () {
               
                       $('#deletemodal').modal('show');
               
                       $tr = $(this).closest('tr');
               
                       var data = $tr.children("td").map(function () {
                           return $(this).text();
                       }).get();
               
                       console.log(data);
                       
                       var deleteID = $(this).attr('data-id'); // Get the user id from attr
                       $('#delete_id').val(deleteID); // Assign the user id to hidden field.
                       
                       <!--// var deleteID = "<?php echo $row_edit['executor_id'] ?>";-->
                       <!--// $('#delete_id').val(deleteID);-->
               
                   });
                   
                   $(document).on('submit', '#form-reset-password', function() {});
               });
            </script>
            <script>
               $(document).ready(function () {
               
                   $('.editbtn').on('click', function () {
               
                       $('#editmodal').modal('show');
               
                       $tr = $(this).closest('tr');
               
                       var data = $tr.children("td").map(function () {
                           return $.trim($(this).text());
                       }).get();
               
                       console.log(data);
                       
                       var updateID = $(this).attr('data-id'); // Get the user id from attr
                       $('#update_id').val(updateID); // Assign the user id to hidden field.
                       
                       
                       // var edit_executor_name = $.trim(document.getElementById('executor_name').value);
                       // var edit_executor_ic = $.trim(document.getElementById('executor_ic').value);
                       // var edit_executor_phoneNo = $.trim(document.getElementById('executor_phoneNo').value);
                       // var edit_executor_email = $.trim(document.getElementById('executor_email').value);
                       // var edit_executor_state = $.trim(document.getElementById('executor_state').value);
                       
                       // $('#update_id').val(edit_executor_id);
                       // $('#executor_name').val(edit_executor_name);
                       // $('#executor_ic').val(edit_executor_ic);
                       // $('#executor_phoneNo').val(edit_executor_phoneNo);
                       // $('#executor_email').val(edit_executor_email);
                       // $('#executor_state').val(edit_executor_state);
                       
                       $('#executor_name').val(data[1]);
                       $('#executor_ic').val(data[2]);
                       $('#executor_phoneNo').val(data[3]);
                       $('#executor_email').val(data[4]);
                       $('#executor_state option:selected').text(data[5]);
                   });
               });
            </script>
            <script>
               function confirmationDelete(anchor)
               {
               var conf = confirm('Are you sure want to delete this record?');
               if(conf)
               window.location=anchor.attr("href");
               }
            </script>
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
   </body>
</html>