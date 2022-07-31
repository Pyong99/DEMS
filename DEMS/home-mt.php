<?php
include_once 'config.php';
require_once "controllerUserData.php";
    $dt = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
    $date_time = $dt->format('d/m/Y');
$date_will = date("d/m/Y"); //Returns IST
?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false)
{
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql)
    {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $court_name = $fetch_info['name'];
        $code = $fetch_info['code'];
        $id = $fetch_info['id'];
        $_SESSION['id'] = $fetch_info['id'];
        if ($status == "verified")
        {
            if ($code != 0)
            {
                header('Location: reset-code.php');
            }
        }
        else
        {
            header('Location: user-otp.php');
        }
    }
}
else
{
    header('Location: login-user.php');
}
?>
<?php
               //set submit id
               $sql_reply = "SELECT * FROM submit WHERE email_received='$court_name'";
               $run_sql_reply = mysqli_query($con, $sql_reply);
               if($run_sql_reply){
                   $row = mysqli_fetch_assoc($run_sql_reply);
               }
               ?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>DEMS Homepage</title>
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
          #sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
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
               <a href="home-mt.php" >
               <i class='bx bx-home'></i>
               <span class="links_name">Home</span>
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
            
                        <div class="container">
               <div class="container p-3 my-3 bg-white">
                  <div>
                     <h2> Will Approval </h2>
                  </div>
                  <div>
                     <div>
                        <?php
                           require "config.php";
                           
                           //$connection = mysqli_connect("localhost","root","");
                           $query = "SELECT * FROM submit WHERE email_received='$court_name'";
                           $query_run = mysqli_query($con, $query);
                           ?>
                        <table id="datatableid" class="table table-bordered table-sm">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">From</th>
                                
                                 <th scope="col">Date Sent</th>
                                 <th scope="col">File Sent</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Reply</th>
                                 <th scope="col">Notes</th>
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
                                      $submit_id = $row['submit_id'];
                                     
                              ?>
                              <tr>
                                 <td width="4">
                                    <?php
                                       echo $i;
                                       $i++;
                                       ?>
                                 </td>
                                 <td> <?php echo $row['email_sent']; ?> </td>
                                 
                                 <td> <?php echo $row['date_sent']; ?> </td>
                                 <td> <a href='<?php echo $row['file_sent']; ?>'>View</a></td>
                                 <td> <?php if ($row['status']=="Approved"){ ?>
                                 <p style="color:green">Approved</p></td>
                                 <?php } else if($row['status']=="Rejected"){?>
                                     <p style="color:green">Approved</p></td>
                                 <?php } else{?><p style="color:darkblue">In Progress</p></td><?php }; ?>
                                 <td> <?php if(file_exists($row['file_received'])){?>
                                 <a href='<?php echo $row['file_received']; ?>'>View</a>
                                 <?php }; ?></td>
                                 <td> <?php echo $row['notes']; ?> </td>
                                 <td><?php if($row['status']=="In Progress"){?>
                                 <button type="button" data-toggle="modal" data-target="#editmodal" data-id="" class="btn btn-success editbtn"> REPLY </button></td>
                                 <?php }?>
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
            </div>
                    
            <!-- Modal -->
            <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Signature  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     
                        <div class="modal-body">
                           	<!-- Content -->
                           	<!--<form action="" method="POST" id="signature_submit" name="signature_submit" enctype="multipart/form-data">-->
                           	<div class="container">
                           	    <div class="row">
                           	        <div class="col-md-12">
                           	            <canvas id="sig-canvas" width="430" height="160">
                           	                Error
                           	            </canvas>
                           	        </div>
		                        </div>
		                        <div class="row">
                        			<div class="col-md-12">
                        				<!--<button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>-->
                        				<button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                        			</div>
		                        </div>
		                        <br/>
		                        <form action="signature_add.php" method="post" >
		                             <input type="hidden" name="input1" id="input1" >
    		                        <div class="row">
                            			<div class="col-md-12">
                            				<textarea id="sig-dataUrl" name="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                            			</div>
                            		</div>
                            		<div class="col-md-12">
                        				<button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                        				<!--<button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>-->
                        			</div>
                            	</form>
                        		<br/>
                        		

                        	</div>
                        	<!--</form>-->
	
                        <!--<div class="modal-footer">-->
                        <!--   <input type="hidden" id='image' name="image" value="">-->
                        <!--   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>-->
                        <!--   <button type="submit" name="insertdata" class="btn btn-primary ">Save</button>-->
                        <!--</div>-->
                     
                  </div>
               </div>
            </div>
         </div>
            <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Reply Will Approval </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="will_reply.php?id=<?php echo $row['submit_id']?>" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                           <input type="hidden" name="update_id" id="update_id">
                           <div class="form-group">
                              <label> Status: </label>
                              <select class="form-control" name="status" id="status" required>
                                 <option value=""disabled selected="selected">Select status</option>
                                 </option>
                                 <option value="Approved">Approved</option>
                                 <option value="Rejected">Rejected</option>
                                  </select>
                           </div>
                           <div class="form-group">
                              <label> File: </label>
                              <input type="file" id="file_received" name="file_received" size="20" onChange="getImage(event);" />
                           </div>
                           <?php 
                          if (strlen($submit[0]->file_received) > 0) {
                          ?>
                          <img src="<?php $submit[0]->file_received; ?>" alt="image preview" />
                          <?php
                          }
                          ?>
                           <div class="form-group">
                              <label> Notes: </label>
                              <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter notes"></textarea>
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
      </section>
      <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
            <!--For datatable-->
            <!--Old-->
            <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
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
                   });
               });
            </script>
      <script>
          (function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.innerHTML = "Data URL for your signature will go here!";
    sigImage.setAttribute("src", "");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.innerHTML = dataUrl;
    sigImage.setAttribute("src", dataUrl);
    
    //dunno ady
    document.getElementById("input1").value=canvas.toDataURL();
    
    //submit form
    document.getElementsByName('form_name').submit();
    
  }, false);

})();
      </script>
   </body>
</html>
