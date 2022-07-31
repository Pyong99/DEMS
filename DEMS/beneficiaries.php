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
      <title> My Beneficiaries</title>
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
               <a href="beneficiaries.php" class="active">
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
            <!-- Modal -->
            <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Beneficiary  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="beneficiaries_add.php" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">
                           <div class="form-group">
                              <label> Beneficiary Name: </label>
                              <input type="text" name="beneficiaries_name" class="form-control" placeholder="Enter name" required>
                              <div class="invalid-feedback">
                                 Name field cannot be empty
                              </div>
                           </div>
                           <div class="form-group">
                              <label> IC Number: </label>
                              <input type="text" name="beneficiaries_ic" class="form-control" placeholder="Enter IC number" pattern="[0-9]{12}" required>
                              <div class="invalid-feedback">
                                 IC number must be consist of 12 digit numbers (E.g: 550203019657)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Phone Number: </label>
                              <input type="text" name="beneficiaries_phoneNo" class="form-control" placeholder="Enter phone number" pattern="[0-9]{9,14}" required>
                              <div class="invalid-feedback">
                                 Phone number must contain at least 9 digit numbers (E.g: 0198765432)
                              </div>
                           </div>
                           <!--<div class="form-group">-->
                           <!--    <label> Email: </label>-->
                           <!--    <input type="email" name="beneficiaries_email" class="form-control" placeholder="Enter email address" required>-->
                           <!--</div>-->
                           <div class="form-group">
                              <label> Relationship: </label>
                              <select class="form-control" name="beneficiaries_relationship" placeholder="Select relationship" required>
                                 <option value=""selected="selected">Select relationship</option>
                                 </option>
                                 <option value="Spouse">Spouse</option>
                                 <option value="Children">Children</option>
                                 <option value="Sibling">Sibling</option>
                                 <option value="Others">Others</option>
                              </select>
                              <div class="invalid-feedback">
                                 Relationship field cannot be empty
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
               $sql_delete = "SELECT * FROM beneficiaries WHERE user_id = $id";
               $run_sql_delete = mysqli_query($con, $sql_delete);
               if($run_sql_delete){
                   $row = mysqli_fetch_assoc($run_sql_delete);
                   $beneficiaries_id=$row['beneficiaries_id'];
               }
               ?>
            <?php
               //set user id
               $sql_edit = "SELECT * FROM beneficiaries WHERE beneficiaries_id=$beneficiaries_id";
               $run_sql_edit = mysqli_query($con, $sql_edit);
               if($run_sql_edit){
                   $row_edit = mysqli_fetch_assoc($run_sql_edit);
                   //$executor_id=$row_edit['executor_id'];
               }
               ?>
            <div id="table container" class="container p-3 my-3 bg-white">
               <div>
                     <div class="col"><h2> My Beneficiaries </h2></div>
                     <div class="w-100"></div>
                  
                  <div>
                     <div class="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        Add New
                        </button>
                     </div>
                  </div>
                  <br>
                  
                     <div class="col">
                        <?php
                           require "config.php";
                           
                           //$connection = mysqli_connect("localhost","root","");
                           $query = "SELECT * FROM beneficiaries WHERE user_id='$id'";
                           $query_run = mysqli_query($con, $query);
                           ?>
                        <table id="datatableid" class="table table-bordered table-sm">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">IC No.</th>
                                 <th scope="col">Phone No.</th>
                                 <th scope="col">Relationship</th>
                                 <th scope="col">Actions</th>
                              </tr>
                           </thead>
                           
                           <tbody>
                               <?php
                              if($query_run)
                              {
                                  $i=1;
                                  foreach($query_run as $row)
                                  {
                                      $beneficiaries_id = $row['beneficiaries_id'];
                                     
                              ?>
                              <tr>
                                 <td width="4">
                                    <?php
                                       echo $i;
                                       $i++;
                                       ?>
                                 </td>
                                 <td> <?php echo $row['beneficiaries_name']; ?> </td>
                                 <td> <?php echo $row['beneficiaries_ic']; ?> </td>
                                 <td> <?php echo $row['beneficiaries_phoneNo']; ?> </td>
                                 <!--<td> <?php echo $row['beneficiaries_email']; ?> </td>-->
                                 <td> <?php echo $row['beneficiaries_relationship']; ?> </td>
                                 <td>
                                    <div class="row">
                                        <div class="col-4 offset-1">
                                        <button id="editbutton" type="button" data-toggle="modal" data-target="#editmodal" data-id="<?php echo $row[
                                        "beneficiaries_id"
                                    ]; ?>" class="btn btn-success editbtn"><i class="fa fa-edit" style="font-size:18px"></i> </button>
                                    </div>
                                  
                                    <div class="col-4 offset-1">
                                        <button id="deletebutton" type="button" data-toggle="modal" data-target="#deletemodal" data-id="<?php echo $row[
                                        "beneficiaries_id"
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
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Beneficiary Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="beneficiaries_edit.php?id=<?php echo $row['beneficiaries_id']?>" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">
                           <input type="hidden" name="update_id" id="update_id">
                           <div class="form-group">
                              <label> Beneficiary Name: </label>
                              <input type="text" name="beneficiaries_name" id="beneficiaries_name" class="form-control" value="<?php echo $row_edit['beneficiaries_name'] ?>" placeholder="Enter name" required>
                              <div class="invalid-feedback">
                                 Name field cannot be empty
                              </div>
                           </div>
                           <div class="form-group">
                              <label> IC Number: </label>
                              <input type="text" name="beneficiaries_ic" id="beneficiaries_ic" class="form-control" value="<?php echo $row_edit['beneficiaries_ic'] ?>" placeholder="Enter IC number" pattern="[0-9]{12}" required>
                              <div class="invalid-feedback">
                                 IC number must be consist of 12 digit numbers (E.g: 550203019657)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Phone Number: </label>
                              <input type="text" name="beneficiaries_phoneNo" id="beneficiaries_phoneNo" class="form-control" value="<?php echo $row_edit['beneficiaries_phoneNo'] ?>" placeholder="Enter phone number" pattern="[0-9]{9,14}" required>
                              <div class="invalid-feedback">
                                 Phone number must contain at least 9 digit numbers (E.g: 0198765432)
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Relationship: </label>
                              <select class="form-control" id="beneficiaries_relationship" name="beneficiaries_relationship"  value="<?php $row_edit['beneficiaries_relationship']?>" placeholder="Select relationship" required>
                                 <!--id above is correct-->
                                 <option id="beneficiaries_relationship" value="Spouse"<?php if($row_edit['beneficiaries_relationship'] == 'Spouse') { ?> selected="selected"<?php } ?>>Spouse</option>
                                 <option id="beneficiaries_relationship" value="Children"<?php if($row_edit['beneficiaries_relationship'] == 'Children') { ?> selected="selected"<?php } ?>>Children</option>
                                 <option id="beneficiaries_relationship" value="Sibling"<?php if($row_edit['beneficiaries_relationship'] == 'Sibling') { ?> selected="selected"<?php } ?>>Sibling</option>
                                 <option id="beneficiaries_relationship" value="Others"<?php if($row_edit['beneficiaries_relationship'] == 'Others') { ?> selected="selected"<?php } ?>>Others</option>
                              </select>
                              <div class="invalid-feedback">
                                 Relationship field cannot be empty
                              </div>
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
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Beneficiary </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="beneficiaries_delete.php" method="POST">
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
                        <h5 class="modal-title" id="exampleModalLabel"> View Beneficiary Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="beneficiaries_delete.php" method="POST">
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
                           return $.trim($(this).text());
                       }).get();
               
                       console.log(data);
                       
                       var deleteID = $(this).attr('data-id'); // Get the user id from attr
                       $('#delete_id').val(deleteID); // Assign the user id to hidden field.
                       
                       // var deleteID = "<?php echo $row_edit['beneficiaries_id'] ?>";
                       // $('#delete_id').val(deleteID);
               
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
                       
                       // var edit_beneficiaries_name = document.getElementById('beneficiaries_name').value;
                       // var edit_beneficiaries_ic = document.getElementById('beneficiaries_ic').value;
                       // var edit_beneficiaries_phoneNo = document.getElementById('beneficiaries_phoneNo').value;
                       // var edit_beneficiaries_relationship = document.getElementById('beneficiaries_relationship').value;
                       
                       
                       // $('#update_id').val(edit_beneficiaries_id);
                       // $('#beneficiaries_name').val(edit_beneficiaries_name);
                       // $('#beneficiaries_ic').val(edit_beneficiaries_ic);
                       // $('#beneficiaries_phoneNo').val(edit_beneficiaries_phoneNo);
                       // $('#beneficiaries_relationship').val(edit_beneficiaries_relationship);
                       
               
                       
                       $('#beneficiaries_name').val(data[1]);
                       $('#beneficiaries_ic').val(data[2]);
                       $('#beneficiaries_phoneNo').val(data[3]);
                       <!--$('#beneficiaries_relationship').val(data[4]);-->
                       $('#beneficiaries_relationship option:selected').text(data[4]);
                       
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