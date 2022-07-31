<?php
include_once "config.php";
require_once "controllerUserData.php";
?>
<?php
$email = $_SESSION["email"];
$password = $_SESSION["password"];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info["status"];
        $code = $fetch_info["code"];
        $id = $fetch_info["id"];
        $_SESSION["id"] = $fetch_info["id"];
        if ($status == "verified") {
            if ($code != 0) {
                header("Location: reset-code.php");
            }
        } else {
            header("Location: user-otp.php");
        }
    }
} else {
    header("Location: login-user.php");
}
?>
<?php
if (isset($_GET["page"]) && $_GET["page"] != "") {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$total_records_per_page = 3;
$offset = ($page - 1) * $total_records_per_page;
$previous_page = $page - 1;
$next_page = $page + 1;
$adjacents = "2";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> My Digital Assets </title>
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
      .hide {
      width: 0;
      height: 0;
      opacity: 0;
      }
      
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
      #editbutton , #deletebutton {
      display:inline-block;
      margin: 0 auto;
      }
      @media (min-width: 75vw) {
    .container{
        max-width: 79vw;
    }
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
          <a href="digital_asset.php" class="active">
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
          <a href="executor.php" >
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
          <span class="admin_name"><?php echo $fetch_info["name"]; ?></span>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Digital Asset  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="digital_asset_add.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                  <div class="form-group">
                    <label> Asset Name: </label>
                    <input type="text" name="digital_asset_name" class="form-control" placeholder="Enter name" required>
                    <div class="invalid-feedback">
                      Name field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Category: </label>
                    <select class="form-control" id="digital_asset_category" name="digital_asset_category" placeholder="Select category" required>
                      <option value=""selected="selected">Select category</option>
                      <option value="Email Account">Email Account</option>
                      <option value="E-Wallet">E-Wallet</option>
                      <option value="Online Banking">Online Banking</option>
                      <option value="Cryptocurrency">Cryptocurrency</option>
                      <option value="Social Media Account">Social Media Account</option>
                      <option value="Subscription Account">Subscription Account</option>
                      <option value="Others">Others</option>
                    </select>
                    <div class="invalid-feedback">
                      Category field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Username: </label>
                    <input type="text" name="digital_asset_username" class="form-control" placeholder="Enter username" required>
                    <div class="invalid-feedback">
                      Username field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Email: </label>
                    <input type="email" name="digital_asset_email" class="form-control" placeholder="Enter email address" required>
                    <div class="invalid-feedback">
                      Email address must contain a single @ (E.g: johndoe@gmail.com)
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Password: </label>
                    <input type="password" name="digital_asset_password" class="form-control" placeholder="Enter password" required>
                    <div class="invalid-feedback">
                      Password field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Beneficiary: </label>
                    <select class="form-control" name="digital_asset_beneficiary" placeholder="Select beneficiary" required>
                      <!--<option value=""selected="selected">Select beneficiary</option>-->
                      <!--<option value="Beneficiary 1">Beneficiary 1</option>-->
                      <!--<option value="Beneficiary 2">Beneficiary 2</option>-->
                      <option value="">Select beneficiary</option>
                      <?php
                      require "config.php";
                      $result_count = mysqli_query(
                          $con,
                          "SELECT COUNT(*) As total_records FROM `beneficiaries` WHERE user_id = $id"
                      );
                      $total_records = mysqli_fetch_array($result_count);
                      $total_records = $total_records["total_records"];
                      $total_no_of_pages = ceil(
                          $total_records / $total_records_per_page
                      );

                      $second_last = $total_no_of_pages - 1;
                      // total pages minus 1
                      $sql_bene = "SELECT * FROM beneficiaries WHERE user_id = $id LIMIT $offset, $total_records_per_page";
                      $result_bene = mysqli_query($con, $sql_bene);
                      while ($row_bene = mysqli_fetch_array($result_bene)) {
                          // here it adds a name with a key that matches the option-value
                          $names[$row_bene["beneficiaries_name"]] =
                              $row_bene["beneficiaries_name"]; ?>
                      <option value = "<?php echo $row_bene[
                          "beneficiaries_name"
                      ]; ?>" >
                        <?php echo $row_bene["beneficiaries_name"]; ?>
                      </option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="invalid-feedback">
                      Beneficiary field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Notes: </label>
                    <textarea class="form-control" name="digital_asset_notes" rows="3" placeholder="Enter notes"></textarea>
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
        <?php //set user id


        $sql_delete = "SELECT * FROM digital_asset WHERE user_id = $id";
        $run_sql_delete = mysqli_query($con, $sql_delete);
        if ($run_sql_delete) {
            $row = mysqli_fetch_assoc($run_sql_delete);
            $digital_asset_id = $row["digital_asset_id"];
        }
        ?>
        <?php //set user id


        $sql_edit = "SELECT * FROM digital_asset WHERE digital_asset_id=$digital_asset_id";
        $run_sql_edit = mysqli_query($con, $sql_edit);
        if ($run_sql_edit) {
            $row_edit = mysqli_fetch_assoc($run_sql_edit); //$digital_asset_id=$row_edit['digital_asset_id'];
        }
        ?>
        <div>
          
            <div id="table container" class="container p-3 my-3 bg-white">
                <div>
                <div class="col"><h2> My Digital Asset </h2></div>
                <div class="w-100"></div>
                <div class="col"><button type="button" class="btn btn-primary addbtn" data-toggle="modal" data-target="#studentaddmodal">
                Add New
                </button></div>
                <br>
                <div class="col">
                <?php
                require "config.php";
                //$connection = mysqli_connect("localhost","root","");
                $query = "SELECT * FROM digital_asset WHERE user_id='$id'";
                $query_run = mysqli_query($con, $query);
                ?>
                <table id="datatableid" class="table table-bordered table-sm" style="font-size:90%">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Category</th>
                      <th scope="col">Username</th>
                      <th scope="col">Email</th>
                      <th scope="col">Password</th>
                      <th scope="col">Beneficiary</th>
                      <th scope="col">Notes</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                      <?php if ($query_run) {
                      $i = 1;
                      foreach ($query_run as $row) {
                          $digital_asset_id = $row["digital_asset_id"]; ?>
                    <tr>
                      <td width="4">
                        <?php
                        echo $i;
                        $i++;
                        ?>
                      </td>
                      
                      <td> <?php echo $row["digital_asset_name"]; ?> </td>
                      <td> <?php echo $row["digital_asset_category"]; ?> </td>
                      <td> <?php echo $row["digital_asset_username"]; ?> </td>
                      <td> <?php echo $row["digital_asset_email"]; ?> </td>
                      <td> ******<script>"*".repeat(<?php echo strlen($row["digital_asset_password"]); ?>) </script></td>
                      <td> <?php echo $row[
                          "digital_asset_beneficiary"
                      ]; ?> </td>
                      <td> <?php echo $row["digital_asset_notes"]; ?> </td>

                      <td>
                        <div class="row">
                            <div class="col-4 offset-1">
                            <button id="editbutton" type="button" data-toggle="modal" data-target="#editmodal" data-id="<?php echo $row[
                            "digital_asset_id"
                        ]; ?>" class="btn btn-success editbtn"><i class="fa fa-edit" style="font-size:18px"></i> </button>
                        </div>
                      
                        <div class="col-4 offset-1">
                            <button id="deletebutton" type="button" data-toggle="modal" data-target="#deletemodal" data-id="<?php echo $row[
                            "digital_asset_id"
                        ]; ?>" class="btn btn-danger deletebtn"><i class="fa fa-trash-o" style="font-size:18px"></i> </button>
                        </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                      }
                  } else {
                      echo "No Record Found";
                  } ?>
                  </tbody>
                  
                </table>
                
              </div>
    
  </div>
              
            </div>
            <div class="card">
              
            </div>
          
        </div>
        <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Digital Asset Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="digital_asset_edit.php?id=<?php echo $row[
                  "digital_asset_id"
              ]; ?>" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                  <input type="hidden" name="update_id" id="update_id">
                  <div class="form-group">
                    <label> Asset Name: </label>
                    <input type="text" name="digital_asset_name" id="digital_asset_name" class="form-control" value="<?php echo $row_edit[
                        "digital_asset_name"
                    ]; ?>" placeholder="Enter name" required>
                    <div class="invalid-feedback">
                      Name field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Category: </label>
                    <select class="form-control" name="digital_asset_category" id="digital_asset_category" value="<?php echo $row_edit["digital_asset_category"]; ?>" placeholder="Select category" required>
                      
                      <!--<option value="Email Account">Email Account</option>-->
                      <!--<option value="E-Wallet">E-Wallet</option>-->
                      <!--<option value="Online Banking">Online Banking</option>-->
                      <!--<option value="">Online Banking</option>-->
                      <!--<option value="Cryptocurrency">Cryptocurrency</option>-->
                      <!--<option value="Subscription Account">Subscription Account</option>-->
                      <!--<option value="Others">Others</option>-->
                      <option id="digital_asset_category" value="Email Account"<?php if ($row_edit["digital_asset_category"] == "Email Account") { ?> selected="selected"<?php } ?>>Email Account</option>
                      <option id="digital_asset_category" value="E-Wallet"<?php if ($row_edit["digital_asset_category"] == "E-Wallet") { ?> selected="selected"<?php } ?>>E-Wallet</option>
                      <option id="digital_asset_category" value="Online Banking"<?php if ($row_edit["digital_asset_category"] =="Online Banking"
                      ) { ?> selected="selected"<?php } ?>>Online Banking</option>
                      <option id="digital_asset_category" value="Cryptocurrency"<?php if (
                          $row_edit["digital_asset_category"] ==
                          "Cryptocurrency"
                      ) { ?> selected="selected"<?php } ?>>Cryptocurrency</option>
                      <option id="digital_asset_category" value="Social Media Account"<?php if (
                          $row_edit["digital_asset_category"] ==
                          "Social Media Account"
                      ) { ?> selected="selected"<?php } ?>>Social Media Account</option>
                      <option id="digital_asset_category" value="Subscription Account"<?php if (
                          $row_edit["digital_asset_category"] ==
                          "Subscription Account"
                      ) { ?> selected="selected"<?php } ?>>Subscription Account</option>
                      <option id="digital_asset_category" value="Others"<?php if (
                          $row_edit["digital_asset_category"] == "Others"
                      ) { ?> selected="selected"<?php } ?>>Others</option>
                      
                    </select>
                    <div class="invalid-feedback">
                      Category field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Username: </label>
                    <input type="text" name="digital_asset_username" id="digital_asset_username" class="form-control" value="<?php echo $row_edit[
                        "digital_asset_username"
                    ]; ?>" placeholder="Enter username" required>
                    <div class="invalid-feedback">
                      Username field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Email: </label>
                    <input type="email" name="digital_asset_email" id="digital_asset_email" class="form-control" value="<?php echo $row_edit[
                        "digital_asset_email"
                    ]; ?>" placeholder="Enter email address" required>
                    <div class="invalid-feedback">
                      Email address must contain a single @ (E.g: johndoe@gmail.com)
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Password: </label>
                    <input type="password" name="digital_asset_password" id="digital_asset_password" class="form-control" value="<?php echo $row_edit[
                        "digital_asset_password"
                    ]; ?>" placeholder="Enter password" required>
                    <div class="invalid-feedback">
                      Password field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Beneficiary: </label>
                    <select class="form-control" id="digital_asset_beneficiary" name="digital_asset_beneficiary" placeholder="Select beneficiary" required>
                      <!--<option value=""selected="selected">Select beneficiary</option>-->
                      <!--<option value="Beneficiary 1">Beneficiary 1</option>-->
                      <!--<option value="Beneficiary 2">Beneficiary 2</option>-->
                      <?php
                      require "config.php";
                      $sql_bene = "SELECT * FROM beneficiaries WHERE user_id = $id";
                      $result_bene = mysqli_query($con, $sql_bene);
                      while ($row_bene = mysqli_fetch_array($result_bene)) {
                          // here it adds a name with a key that matches the option-value
                          $names[$row_bene["beneficiaries_name"]] =
                              $row_bene["beneficiaries_name"]; ?>
                      <option selected="selected"  value = "<?php echo $row_bene[
                          "beneficiaries_name"
                      ]; ?>" >
                        <?php echo $row_bene["beneficiaries_name"]; ?> 
                      </option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="invalid-feedback">
                      Beneficiary field cannot be empty
                    </div>
                  </div>
                  <div class="form-group">
                    <label> Notes: </label>
                    <textarea class="form-control" name="digital_asset_notes" id="digital_asset_notes" class="form-control" value="<?php echo $row_edit[
                        "digital_asset_notes"
                    ]; ?>" rows="3" placeholder="Enter notes"></textarea>
                  </div>
                  <!--<div class="form-group">-->
                  <!--    <label> State: </label>-->
                  <!--    <input type="text" name="digital_asset_state" id="digital_asset_state" class="form-control" value="<?php echo $row_edit[
                      "digital_asset_state"
                  ]; ?>" placeholder="Enter state" required>-->
                  <!--</div>-->
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
                <h5 class="modal-title" id="exampleModalLabel"> Delete digital asset </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="digital_asset_delete.php" method="POST">
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
                <h5 class="modal-title" id="exampleModalLabel"> View digital_asset Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="digital_asset_delete.php" method="POST">
                <div class="modal-body">
                  <input type="text" name="view_id" id="view_id">
                  <!-- <p id="fname"> </p> -->
                  <!-- <h4 id="fname"> <?php echo ""; ?> </h4> -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                  <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                </div>
              </form>
            </div>
          </div>
        </div>
        <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
            <!--For datatable-->
            <!--Old-->
            <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script>
          $(document).ready(function() {
          $('.addbtn').on('click', function (){
          var pageSelector = document.getElementById('digital_asset_category');
          var customInput = document.getElementById('customInput');
          
          pageSelector.addEventListener('change', function(){
          if(this.value == "Others") {
          customInput.classList.remove('hide');
          } else {
          customInput.classList.add('hide');
          }
          })
          });
        </script>
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
              
              $.extend(true, $.fn.dataTable.defaults, {
                ordering: true,
                searching:true,
                select: true,
                
            } );
              
          
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
                  
                  // var deleteID = "<?php echo $row_edit[
                      "digital_asset_id"
                  ]; ?>";
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
                  
                  
                  // var edit_digital_asset_name = document.getElementById('digital_asset_name').value;
                  // var edit_digital_asset_ic = document.getElementById('digital_asset_ic').value;
                  // var edit_digital_asset_phoneNo = document.getElementById('digital_asset_phoneNo').value;
                  // var edit_digital_asset_email = document.getElementById('digital_asset_email').value;
                  // var edit_digital_asset_state = document.getElementById('digital_asset_state').value;
                  
                  // $('#update_id').val(edit_digital_asset_id);
                  // $('#digital_asset_name').val(edit_digital_asset_name);
                  // $('#digital_asset_ic').val(edit_digital_asset_ic);
                  // $('#digital_asset_phoneNo').val(edit_digital_asset_phoneNo);
                  // $('#digital_asset_email').val(edit_digital_asset_email);
                  // $('#digital_asset_state').val(edit_digital_asset_state);
                  
                  
                  
                  $('#digital_asset_name').val(data[1]);
                  $('#digital_asset_ic').val(data[2]);
                  $('#digital_asset_phoneNo').val(data[3]);
                  $('#digital_asset_email').val(data[4]);
                  $('#digital_asset_state').val(data[5]);
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
        <!-- then it populates the array with json_encode() to be used in the event-listener (both below) -->
        <script type="text/javascript">
          var names = <?php echo json_encode($names); ?>;
          
          document.getElementById("beneficiaries_name").addEventListener(
               'change',
               function() { 
                  document.getElementById("out-text").value = names[this.selectedIndex]; 
               },
               false
            );
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