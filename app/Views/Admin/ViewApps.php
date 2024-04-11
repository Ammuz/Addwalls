
<!DOCTYPE html>
<html lang="en">


<!-- tabs23:58-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title><?=(isset($pageTitle))? $pageTitle:'document' ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/font-awesome.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/style.css')?>">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
      <?php if (session()->has('user_type') && session('user_type') === 'admin'): ?>
            <!-- Admin Sidebar -->
            <?php echo view('Admin/sidebar'); ?>
        <?php else: ?>
            <!-- Other User Sidebar -->
            <?php echo view('Admin/c_menu'); ?>
        <?php endif; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="card-title">DETAILS</h4>
                            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-toggle="tab">Applicant Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-toggle="tab">Documents submitted</a></li>
                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4" data-toggle="tab">Personal Details </a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="solid-rounded-justified-tab1">
                                <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                            <form action="<?=base_url('Applicationss/update/'.$myapt['App_id']);?>" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Application ID</label>
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="msg_csrf"/>
                                        <input type="text" id="autocompleteuser" value="<?= $myapt['Application_Id'] ?>" class="form-control" name="aid" readonly>
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
										<label>Applicant Name</label>
   <!-- Autocomplete -->
                                        <input type="text" id="autocompleteuser" class="form-control" name="name" value="<?= $myapt['Name'] ?>" >

									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username </label>
                                        <input type="text" id="userid" value="<?= $myapt['Username'] ?>" name="PatientId" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Email</label>
                                        <input class="form-control" type="email" id="email" value="<?= $myapt['Email'] ?>" name="email" >
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adhaar Number: </label>
                                        <input type="text" id="userid" value="<?= $myapt['adharno'] ?>" name="PatientId" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pancard Number:</label>
                                        <input class="form-control" type="text" id="dob" name="dob"  value="<?= $myapt['panno'] ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Mobile Number</label>
                                        <input class="form-control" type="text" id="phone" name="phone" value="<?= $myapt['Mobile'] ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Another Mobile Number</label>
                                        <input class="form-control" type="text" id="phone" name="phone" value="<?= $myapt['Ophone'] ?>" >
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">Intro Code </label>
                                        <input type="text" class="form-control" placeholder="Addwalls" name="rcode" id="n"value="<?= $myapt['referalcode'] ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">Gender :</label>
                                        <input type="text" class="form-control" placeholder="Agent code" name="gender" id="n"value="<?= $myapt['Gender'] ?>"readonly >
                                    </div>
                                    </div>
                                
                            </div>
                            
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="psw">How You know about us? :</label>
                                        <input type="text" class="form-control" placeholder="" name="know" id="n"value="<?= $myapt['know'] ?>"readonly >
                                   
                                    </div>
                                </div>
                            </div>
                                
                           
                    </div>
                </div>
                                </div>
                                <div class="tab-pane" id="solid-rounded-justified-tab2">
                                <div class="row col-sm-12">
                                    <div class="col-sm-6">
                                    <center>
									<div class="form-group">
                                        <?php if($myapt['afront']!=null)
                                        {
                                            $pdf='/adhar/'.$myapt['afront'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>"
                                             width="400"
                                             height="250">
                                   </object>
                                 
									</div>
                                </center>
                               </div>
                                    <div class="col-sm-6">
                                    <center>
									<div class="form-group">
                                        <?php if($myapt['aback']!=null)
                                        {
                                            $pdf='/adhar/'.$myapt['aback'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>"
                                             width="400"
                                             height="250">
                                   </object>
                                 
									</div>
                                </center>
                                    </div>
                                    <div class="col-sm-6">
                                    <center>
									<div class="form-group">
                                        <?php if($myapt['pfront']!=null)
                                        {
                                            $pdf='/pan/'.$myapt['pfront'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>"
                                             width="400"
                                             height="250">
                                   </object>
                                 
									</div>
                                </center>
                                    </div>
                                </div>
                                </div>
    
                                <div class="tab-pane" id="solid-rounded-justified-tab4">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">Country code:</label>
                                        <input type="text" class="form-control" placeholder="" name="country" id="n"value="<?= $myapt['Country'] ?>" >
                                   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">State Code:</label>
                                        <input type="text" class="form-control" placeholder="" name="state" id="n"value="<?= $myapt['state'] ?>" >
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">District</label>
                                        <input type="text" class="form-control" placeholder="" name="district" id="n"value="<?= $myapt['District'] ?>" >
                                   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="psw">City</label>
                                        <input type="text" class="form-control" placeholder="" name="city" id="n"value="<?= $myapt['City'] ?>" >
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="psw">Pincode</label>
                                        <input type="text" class="form-control" placeholder="" name="pincode" id="n"value="<?= $myapt['Pincode'] ?>" >
                                   
                                    </div>
                                </div>
                                    </div>
                                <div class="form-group">
                                <label> Permanant Address</label>
                                <textarea cols="30" rows="4" class="form-control" name="paddress" value=""><?= $myapt['Paddress'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label> Present Address</label>
                                <textarea cols="30" rows="4" class="form-control" name="caddress" value=""><?= $myapt['Caddress'] ?></textarea>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                        <label> Date of Birth : </label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" value="<?= $myapt['birthday'] ?>">
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Nominee Name : </label>
                                        <input type="text" name="nominee" placeholder="Nominee" size="15" required class="form-control" value="<?= $myapt['Nominee_Name'] ?>"/>
                                    </div>
                                    </div>
                                </div>
                               <div class="row">      
                                      <div class="col-md-6">
                                          <div class="form-group">
                                        <label> Father Name : </label>
                                        <input type="text" name="fathername" placeholder="Father Name" size="15" required class="form-control" value="<?= $myapt['Father_name'] ?>"/>
                                          </div> 
                                        </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                        <label> Nominee Relation With Applicant : </label>
                                        <input type="text" name="relation" placeholder="Nominee Relation" size="15" required class="form-control"value="<?= $myapt['Relation'] ?>"/>
                                        </div>
                                        </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Mother Name : </label>
                                        <input type="text" name="mothername" placeholder="Mother Name" size="15" required class="form-control"value="<?= $myapt['Mother_name'] ?>"/>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Spouse Name (if applicable) : </label>
                                        <input type="text" name="spouse" placeholder="Spouse" size="15" class="form-control"value="<?= $myapt['Spouse_Name'] ?>"/>
                                    </div>
                                    </div>
                                   </div>
                            <div class="form-group">
                                <label class="display-block">Application Status</label>
                                <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value="pending" checked>
									<label class="form-check-label" for="product_active">
									Pending
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value="Verified" >
									<label class="form-check-label" for="product_active">
									Verified
									</label>
								</div>
								
                            </div>
                           
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Save</button>
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
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="<?php echo base_url('/js/jquery-3.2.1.min.js')?>"></script>
	<script src="<?php echo base_url('/js/popper.min.js')?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('/js/jquery.slimscroll.js')?>"></script>
    <script src="<?php echo base_url('/js/app.js')?>"></script>
</body>


<!-- tabs23:59-->
</html>
