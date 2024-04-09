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
        <?php echo view('Admin/c_menu'); ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Admin</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="<?=site_url('admin/update/'.$admin['admin_id']) ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group">
                                    <input type="hidden" name="admin_id" value="<?=$admin['admin_id']?>">
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>User Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="<?=$admin['username']?>"
                                            name="username" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger"></span></label>
                                        <input class="form-control" type="text" value="<?=$admin['password']?>"
                                            name="password">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" value="<?=$admin['email']?>" type="email"
                                            name="email">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Current Address</label>
                                        <textarea class="form-control" rows="3" cols="30" name="caddress"
                                            required><?=$admin['Caddress']?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Permanent Address</label>
                                        <textarea class="form-control" rows="3" cols="30" name="paddress"
                                            required><?=$admin['Paddress']?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth </label>
                                        <input class="form-control" value="<?=$admin['Dob']?>" type="date"
                                            name="birthday">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nominee </label>
                                        <input class="form-control" value="<?=$admin['Nominee']?>" type="text"
                                            name="nominee">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Relationship With Nominee</label>
                                        <input class="form-control" value="<?=$admin['Relationship_with_nominee']?>"
                                            type="text" name="rnominee">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father</label>
                                        <input class="form-control" value="<?=$admin['Father']?>" type="text"
                                            name="father">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mother</label>
                                        <input class="form-control" value="<?=$admin['Mother']?>" type="text"
                                            name="mother">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Education</label>
                                        <input class="form-control" value="<?=$admin['Education']?>" type="text"
                                            name="education">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Number : <span style="color:red">*</span></label>
                                    <input type="text" value="<?=$admin['Adhar_cardno']?>" name="adharno" id="adharno"
                                        placeholder="Aadhar No" required class="form-control"
                                        onkeyup="validateAadhaar()" />
                                    <p id="validationResult" style="color: red;"></p>

                                </div>
                                <div class="col-md-6">
                                    <label> Pancard Number: <span style="color:red">*</span></label>
                                    <input type="text" value="<?=$admin['Pancardno']?>" name="panno"
                                        placeholder="Pancard No" id="panInput" onkeyup="validatePAN()" maxlength="10"
                                        required class="form-control" />
                                    <p id="panError" style="color: red;"></p>
                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Front page :<span style="color:red">*</span> </label>
                                    <input type="file" name="Adharfront" placeholder="Aadhar No" size="15"
                                        class="form-control" />
                                    <br>
                                    <div class="form-group">
                                        <?php if($admin['Adhar_card_front']!=null)
                                        {
                                            $pdf='/adhar/'.$admin['Adhar_card_front'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>" width="400" height="250">
                                        </object>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Back page : <span style="color:red">*</span></label>
                                    <input type="file" name="adharback" placeholder="Aadhar No" size="15"
                                        class="form-control" />
                                    <br>
                                    <div class="form-group">
                                        <?php if($admin['Adhar_card_back']!=null)
                                        {
                                            $pdf='/adhar/'.$admin['Adhar_card_back'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>" width="400" height="250">
                                        </object>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label> Pancard (Front page ): <span style="color:red">*</span></label>
                                    <input type="file" name="pfront" placeholder="Pancard No" size="15"
                                        class="form-control" />
                                    <br>
                                    <div class="form-group">
                                        <?php if($admin['Pancard_front']!=null)
                                        {
                                            $pdf='/pan/'.$admin['Pancard_front'];
                                        }
                                        else {
                                            $pdf="No data";
                                        }
                                        ?>
                                        <object data="<?php echo base_url( $pdf)?>" width="400" height="250">
                                        </object>

                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>Country:</span></label>
                                    <input type="text" value="<?= $countryName ?>" name="country" placeholder=""
                                        id="panInput" required class="form-control"readonly />

                                    <label>State:</span></label>
                                    <input type="text" value="<?= $stateName ?>" name="state" placeholder=""
                                        id="panInput" required class="form-control" readonly />
                                    <label>District:</span></label>
                                    <input type="text" value="<?= $districtName ?>" name="district"
                                        placeholder="" id="panInput" required class="form-control" readonly/>
                                    <label>City:</span></label>
                                    <input type="text" value="<?= $cityName ?>" name="city" placeholder=""
                                        id="panInput" required class="form-control" readonly/>

                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input class="form-control" type="text" name="pin" value="<?=$admin['Pin']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="patient_active"
                                            value="active" <?php if ($admin['Status'] == "active")  echo "checked"?>>
                                        <label class="form-check-label" for="patient_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="patient_inactive"
                                            value="In-active"
                                            <?php if ($admin['Status'] == "In-active")  echo "checked"?>>
                                        <label class="form-check-label" for="patient_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update</button>
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

    </script>


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
            document.getElementById('panInput').innerHTML = panNumber;
            panError.textContent = ''; // Clear error message
        } else {
            panError.textContent = 'Invalid PAN Card Number';
        }
        panInput.value = panNumber;
    }
    </script>
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
            document.getElementById('panInput').innerHTML = panNumber;
            panError.textContent = ''; // Clear error message
        } else {
            panError.textContent = 'Invalid PAN Card Number';
        }
        panInput.value = panNumber;
    }

    function checkPasswords() {
        var password = document.getElementById('pass').value;
        var confirmPassword = document.getElementById('rpass').value;
        var resultMessage = document.getElementById('passMessage');

        if (password === confirmPassword) {
            resultMessage.innerHTML = '';
        } else {
            resultMessage.innerHTML = 'Passwords do not match.';
        }
    }
    var addressTextarea = document.getElementById("pa");
    var billingAddressTextarea = document.getElementById("ca");
    var sameAddressCheckbox = document.getElementById("sameAddressCheckbox");

    sameAddressCheckbox.addEventListener("change", function() {
        if (sameAddressCheckbox.checked) {
            billingAddressTextarea.value = addressTextarea.value;
        } else {
            billingAddressTextarea.value = ""; // Clear the billing address if the checkbox is unchecked
        }
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#country').change(function() {
            var countryId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/get_states'); ?>",
                data: {
                    country_id: countryId
                },
                dataType: 'json',
                success: function(states) {
                    $('#state').empty();
                    $('#state').append('<option value="">Select State</option>');
                    $.each(states, function(index, state) {
                        $('#state').append('<option value="' + state.state_id +
                            '">' + state.state_name + '</option>');
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#state').change(function() {
                var stateId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/get_districts'); ?>",
                    data: {
                        state_id: stateId
                    },
                    dataType: 'json',
                    success: function(districts) {
                        $('#dist').empty();
                        $('#dist').append(
                            '<option value="">Select District</option>');
                        $.each(districts, function(index, districts) {
                            $('#dist').append('<option value="' + districts
                                .dist_id + '">' + districts.dist_name +
                                '</option>');
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#dist').change(function() {
                var distId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/get_cities'); ?>",
                    data: {
                        dist_id: distId
                    },
                    dataType: 'json',
                    success: function(cities) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(cities, function(index, cities) {
                            $('#city').append('<option value="' + cities
                                .city_id + '">' + cities.city_name +
                                '</option>');
                        });
                    }
                });
            });
        });

    });

    // Similar AJAX calls for districts and cities

    function updateTextField(targetId) {
        var selectedValue = event.target.value;
        document.getElementById(targetId).value = selectedValue;
    }
    </script>


</body>


<!-- add-patient24:07-->

</html>