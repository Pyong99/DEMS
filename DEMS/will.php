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
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> My Will </title>
      <link rel="stylesheet" href="css/home.css">
      
      
      <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
      <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
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
.button1 {background-color: #4CAF50;} /* Green */
.button2 {background-color: #008CBA;} /* Blue */
.btn-danger a {
  color: white;
}
      </style>
      <script type="text/javascript">
var citiesByState = {
// Odisha: ["Bhubaneswar","Puri","Cuttack"],
// Maharashtra: ["Mumbai","Pune","Nagpur"],
// Kerala: ["kochi","Kanpur"]
Johor: ["Mahkamah Tinggi Johor Bahru","Mahkamah Tinggi Muar"],
Kedah: ["Mahkamah Tinggi Alor Star","Mahkamah Tinggi Sungai Petani"],
Kelantan: ["Mahkamah Tinggi Kota Bharu"],
Kuala_Lumpur: ["Mahkamah Tinggi Kuala Lumpur"],
Labuan: ["Mahkamah Tinggi Labuan"],
Melaka: ["Mahkamah Tinggi Melaka"],
Negeri_Sembilan: ["Mahkamah Tinggi Seremban"],
Pahang: ["Mahkamah Tinggi Kuantan","Mahkamah Tinggi Temerloh"],
Penang: ["Mahkamah Tinggi Pulau Pinang"],
Perak: ["Mahkamah Tinggi Ipoh","Mahkamah Tinggi Taiping"],
Perlis: ["Mahkamah Tinggi Kangar"],
Sabah: ["Mahkamah Tinggi Kota Kinabalu","Mahkamah Tinggi Sandakan","Mahkamah Tinggi Tawau"],
Sarawak: ["Mahkamah Tinggi Kuching","Mahkamah Tinggi Sibu","Mahkamah Tinggi Miri","Mahkamah Tinggi Sri Aman","Mahkamah Tinggi Bintulu","Mahkamah Tinggi Limbang"],
Selangor: ["Mahkamah Tinggi Shah Alam","Mahkamah Tinggi Klang"],
Terengganu: ["Mahkamah Tinggi Terengganu"]
}
function makeSubmenu(value) {
if(value.length==0) document.getElementById("citySelect").innerHTML = "<option></option>";
else {
var citiesOptions = "";
for(cityId in citiesByState[value]) {
citiesOptions+="<option>"+citiesByState[value][cityId]+"</option>";
}
document.getElementById("citySelect").innerHTML = citiesOptions;
}
}
function displaySelected() { var country = document.getElementById("countrySelect").value;
var city = document.getElementById("citySelect").value;
// alert(country+"\n"+city);
return city;
}
function resetSelection() {
document.getElementById("countrySelect").selectedIndex = 0;
document.getElementById("citySelect").selectedIndex = 0;
}
</script>
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
               <a href="executor.php">
               <i class='bx bxs-contact' ></i>
               <span class="links_name">Executor</span>
               </a>
            </li>
            <li>
               <a href="will.php" class="active">
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
            
                        <div class="container">
               <div id="table container" class="container p-3 my-3 bg-white">
                   <button type="button" class="btn btn-danger"><a href="generate_pdf.php?id=<?php echo $id; ?>">
                        Generate Will
                </a>
            </button>
            
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#studentaddmodal">
                        Sign document
                        </button>
                        <div class="container">
  <div class="row">
    
      </br>
   
  </div>
</div>
                  <div >
                     <h2> Will Approval </h2>
                  </div>
                  <div >
                     <div >
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitaddmodal">
                        Add Submission
                        </button>
                     </div>
                     <br>
                  </div>
                  <div >
                     <div >
                        <?php
                           require "config.php";
                           
                           //$connection = mysqli_connect("localhost","root","");
                           $query = "SELECT * FROM submit WHERE user_id='$id'";
                           $query_run = mysqli_query($con, $query);
                           ?>
                        <table id="datatableid" class="table table-bordered table-sm">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">From</th>
                                 <th scope="col">To</th>
                                 <th scope="col">Date Sent</th>
                                 <th scope="col">File Sent</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Reply</th>
                                 <th scope="col">Notes</th>
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
                                 <td> <?php echo $row['email_received']; ?> </td>
                                 <td> <?php echo $row['date_sent']; ?> </td>
                                 
                                 <td> 
                                        <a href='<?php echo $row['file_sent']; ?>'>View</a>  
                                 </td>
                                 
                                 <td> <?php if ($row['status']=="Approved"){ ?>
                                 <p style="color:green">Approved</p></td>
                                 <?php } else if($row['status']=="Rejected"){?>
                                     <p style="color:green">Approved</p></td>
                                 <?php } else{?><p style="color:darkblue">In Progress</p></td><?php }; ?>
                                 <td> <?php if(file_exists($row['file_received'])){?>
                                 <a href='<?php echo $row['file_received']; ?>'>View 
                                 <?php }; ?></td>
                                 <td> <?php echo $row['notes']; ?> </td>
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
                            				<textarea hidden id="sig-dataUrl" name="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
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
         
         <!-- Modal -->
            <div class="modal fade" id="submitaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Submission  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="submit_add.php" name="submit_file" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="form-group">
                              <label> From: </label>
                              <input type="text" name="email_sent" class="form-control" placeholder=<?php echo $fetch_info['email'] ?> value=<?php echo $fetch_info['email'] ?> readonly>
                              <input type="hidden" name="user_id" value=<?php echo $fetch_info['id'] ?>>
                           </div>
                           <div class="form-group">
                              <label> To: </label>
                              <!--<select class="form-control" name="email_received" placeholder="Select court" required>-->
                                 <!--<option value=""selected="selected">Select court</option>-->
                                 <!--</option>-->
                                 <!--<option value="Mahkamah Tinggi Johor">Mahkamah Tinggi Johor</option>-->
                                 <!--<option value="Children">Mahkamah Tinggi Johor</option>-->
                                 <!--<option value="Sibling">Mahkamah Tinggi Johor</option>-->
                                 <!--<option value="Others">Mahkamah Tinggi Johor</option>-->
                                 
                              <!--</select>-->
                              <select class="form-control" id="countrySelect"  onchange="makeSubmenu(this.value)">
                                <option value="" disabled selected>Select State</option>
                                 <option value="Johor">Johor</option>
                                 <option value="Kedah">Kedah</option>
                                 <option value="Kelantan">Kelantan</option>
                                 <option value="Kuala_Lumpur">Kuala Lumpur</option>
                                 <option value="Labuan">Labuan</option>
                                 <option value="Melaka">Melaka</option>
                                 <option value="Negeri_Sembilan">Negeri Sembilan</option>
                                 <option value="Pahang">Pahang</option>
                                 <option value="Penang">Penang</option>
                                 <option value="Perak">Perak</option>
                                 <option value="Perlis">Perlis</option>
                                 <option value="Sabah">Sabah</option>
                                 <option value="Sarawak">Sarawak</option>
                                 <option value="Selangor">Selangor</option>
                                 <option value="Terengganu">Terengganu</option>
                                </select>
                                
                                <div class="row">
    
      </br>
   
  </div>
                                
                                <select class="form-control" name="citySelect" id="citySelect" size="1" >
                                <option  disabled selected>Select Court</option>
                                <option value=""></option>
                                </select>
                              <div class="invalid-feedback">
                                 This field cannot be empty
                              </div>
                           </div>
                           <div class="form-group">
                              <label> Date: </label>
                              <input type="text" name="date_sent" class="form-control" placeholder=<?php echo $date_time ?> value=<?php echo $date_time ?> readonly>
                           </div>
                           <div class="form-group">
                            <!--<label> File: </label>-->
                            <label for='file_sent'>Select A File To Upload:</label>
                            <input type="file" id="file_sent" name="file_sent" size="20" onChange="getImage(event);" />
                          </div>
                          <?php 
                          if (strlen($submit[0]->file_sent) > 0) {
                          ?>
                          <img src="<?php $submit[0]->file_sent; ?>" alt="image preview" />
                          <?php
                          }
                          ?>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="submit" name="insertdata" class="btn btn-primary">Submit</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
      </section>
      <!--For modal-->
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
