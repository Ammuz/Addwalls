
<!DOCTYPE html>
<html lang="en">
<!-- add-patient24:06-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title><?=(isset($pageTitle))? $pageTitle:'document' ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/font-awesome.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/style.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/select2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/bootstrap-datetimepicker.min.css')?>">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="main-wrapper">
    <?php echo view('Admin/Manager/tertiary_manager/sidebar');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Agents</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="<?=site_url('Agents/asave') ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Agent Code </label>
                                        <input type="hidden" name="<?=csrf_token()?>" value="<?= csrf_hash() ?>" id="msg_csrf"/>
                                        <?php 
                                       //dd($pt);
                                if($pt): ?>
                                <?php foreach($pt as $Employee): ?>
                                        <input class="form-control" type="text" name="aid" hidden value="<?=$Employee['agent_code']+1?>">
										<input class="form-control" type="text" value="ADWA0<?=$Employee['agent_code']+1?>" name="agentcode" readonly="">
                                        <?php  endforeach; ?>
                                    <?php  endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="username">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Password <span class="text-danger"></span></label>
                                        <input class="form-control" type="text" name="password" id="password"
                                            onkeyup="validatePassword()" value="<?= $password; ?>">
                                        <span id="passwordError" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Father Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="fname">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" cols="30" name="add" required></textarea>
                            </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger"></span></label>
                                        <input class="form-control" type="email" name="email">
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile Number </label>
                                        <input class="form-control" type="text" name="phone">
                                    </div>
                                </div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Bank Account Number</label>
												<input type="text" class="form-control " name="accnumber" required>
											</div>
										</div>
                                        <div class="col-sm-6 ">
											<div class="form-group">
												<label>Bank Name </label>
												<input type="text" class="form-control" name="bname" required>
											</div>
										</div>
										<div class="col-sm-6 ">
											<div class="form-group">
												<label>IFSC </label>
												<input type="text" class="form-control" name="ifsc" required>
											</div>
										</div>
								
								<div class="col-md-6">
                                        <label> Aadhar Number : <span style="color:red">*</span></label>
                                        <input type="text" name="adharno" id="adharno"placeholder="Aadhar No"  required class="form-control" onkeyup="validateAadhaar()"/>
                                        <p id="validationResult"  style="color: red;"></p>

                                       </div>
                                <div class="col-md-6">
                                        <label> Pancard Number: <span style="color:red">*</span></label>
                                        <input type="text" name="panno" placeholder="Pancard No"  id="panInput" onkeyup="validatePAN()" maxlength="10" required class="form-control"/>
                                        <p id="panError" style="color: red;"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Aadhar Front page :<span style="color:red">*</span> </label>
                                        <input type="file" name="Adharfront" placeholder="Aadhar No" size="15" required class="form-control"/>
                                       </div>
                                       <div class="col-md-6">
                                        <label> Aadhar Back page : <span style="color:red">*</span></label>
                                        <input type="file" name="adharback" placeholder="Aadhar No" size="15" required class="form-control" />
                                    </div>
                                       <div class="col-md-6">
                                        <label> Pancard (Front page ): <span style="color:red">*</span></label>
                                        <input type="file" name="pfront" placeholder="Pancard No" size="15" required class="form-control"/>
                                    </div>
         <!--                       <div class="col-sm-6">-->
									<!--<div class="form-group gender-select">-->
									<!--	<label class="gen-label">Gender:</label>-->
									<!--	<div class="form-check-inline">-->
									<!--		<label class="form-check-label">-->
									<!--			<input type="radio" name="gender" class="form-check-input" value="male">Male-->
									<!--		</label>-->
									<!--	</div>-->
									<!--	<div class="form-check-inline">-->
									<!--		<label class="form-check-label">-->
									<!--			<input type="radio" name="gender" class="form-check-input" value="female">Female-->
									<!--		</label>-->
									<!--	</div>-->
									<!--</div>-->
         <!--                       </div>-->
                                
								
                                
                                <!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Previous History</label>
										<div class="profile-upload">
											<div class="upload-img">
									
											</div>
											<div class="upload-input">
												<input type="file" class="form-control" name="history">
											</div>
										</div>
									</div>
                                </div> -->
                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_active" value="active" checked>
									<label class="form-check-label" for="patient_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="In-active">
									<label class="form-check-label" for="patient_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Agent</button>
                            </div>
                        </form>
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
    <script src="<?php echo base_url('/js/select2.min.js')?>"></script>
    <script src="<?php echo base_url('/js/app.js')?>"></script>
    <script src="<?php echo base_url('/js/moment.min.js')?>"></script>
    <script src="<?php echo base_url('/js/bootstrap-datetimepicker.min.js')?>"></script>
    <script>
        function validateAadhaar() {
    var aadhaarNumber = document.getElementById("adharno").value;
    var validationResultElement = document.getElementById("validationResult");

    // Regular expression to check the Aadhaar number format (12 digits)
    var aadhaarRegex = /^\d{12}$/;

    if (aadhaarRegex.test(aadhaarNumber)) {
      validationResultElement.textContent = "";
    } else {
      validationResultElement.textContent = "Invalid Aadhaar Number. Please enter a 12-digit number.";
    }
  }
   
  function validatePAN() {
      var panInput = document.getElementById('panInput');
      var panNumber = panInput.value.toUpperCase();
      var panError = document.getElementById('panError');
      var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;

      if (panRegex.test(panNumber)) {
          document.getElementById('panInput').innerHTML=panNumber;
        panError.textContent = ''; // Clear error message
      } else {
        panError.textContent = 'Invalid PAN Card Number';
      }
      panInput.value = panNumber;
    }
    </script>

</body>


<!-- add-patient24:07-->
</html>
