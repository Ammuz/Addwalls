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
                        <h4 class="page-title">Add Admin</h4>
                        <?php if (!empty(session()->getFlashdata('errors'))): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <?= esc($error) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="<?=site_url('Admin/save') ?>" method="post"id="registrationForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">

                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>User Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="username" required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger"></span></label>
                                        <input class="form-control" type="text" name="password" id="password"
                                            onkeyup="validatePassword()" value="<?= $password; ?>">
                                        <span id="passwordError" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" onkeyup="checkEmail()" name="email">
                                        <span id="emailError" class="error"></span>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Permanent Address</label>
                                        <textarea class="form-control" rows="3" cols="30" name="paddress" id="pa"
                                            required></textarea>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Current Address</label>
                                        <textarea class="form-control" rows="3" cols="30" name="caddress" id="ca"
                                            required></textarea>
                                    </div>
                                    <h6><input type="checkbox" id="sameAddressCheckbox"> Same as Permanant Address</h6>
                                </div>

                                <div class="col-md-6">
                                    <label> Date of Birth :<span style="color:red">*</span> </label>
                                    <input type="date" id="birthday" name="birthday"class="form-control" required>
                                    <p id="resultMessage3" style="color: red;"></p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Nominee :<span style="color:red">*</span> </label>
                                        <input class="form-control" type="text" name="nominee" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Relationship With Nominee</label>
                                        <input class="form-control" type="text" name="rnominee">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father</label>
                                        <input class="form-control" type="text" name="father">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mother</label>
                                        <input class="form-control" type="text" name="mother">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Education</label>
                                        <input class="form-control" type="text" name="education">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Number : <span style="color:red">*</span></label>
                                    <input type="text" name="adharno" id="adharno" placeholder="Aadhar No" required
                                        class="form-control" onkeyup="validateAadhaar()" />
                                    <p id="validationResult" style="color: red;"></p>

                                </div>
                                <div class="col-md-6">
                                    <label> Pancard Number: <span style="color:red">*</span></label>
                                    <input type="text" name="panno" placeholder="Pancard No" id="panInput"
                                        onkeyup="validatePAN()" maxlength="10" required class="form-control" />
                                    <p id="panError" style="color: red;"></p>
                                </div>
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <select name="country" id="country" class="form-control">
    <option value="">Select Country</option>
    <?php foreach ($countries as $country): ?>
        <option value="<?=$country['country_id']?>"><?=$country['country_name']?></option>
    <?php endforeach; ?>
    
</select>

<!-- 
<select id="countryDropdown"></select>
<select id="stateDropdown"></select>
<select id="districtDropdown"></select> -->












                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Front page :<span style="color:red">*</span> </label>
                                    <input type="file" name="Adharfront" placeholder="Aadhar No" size="15" required
                                        class="form-control" />
                                </div>

                                <div class="col-md-6">

                                    <label>State :</label>
                                    <select id="state" name="state" class="form-control">
                                        <option value="">Select state</option>

                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label> Aadhar Back page : <span style="color:red">*</span></label>
                                    <input type="file" name="adharback" placeholder="Aadhar No" size="15" required
                                        class="form-control" />
                                </div>
                              
                                <div class="col-md-6">

                                    <label>District :</label>
                                    <select id="dist" name="district" class="form-control">
                                        <option value="">Select District</option>

                                    </select>

                                </div>


                                <div class="col-md-6">
                                    <label> Pancard (Front page ): <span style="color:red">*</span></label>
                                    <input type="file" name="pfront" placeholder="Pancard No" size="15" required
                                        class="form-control" />
                                </div>


                                <div class="col-md-6">

                                    <label>city :</label>
                                    <select id="city" name="city" class="form-control">
                                        <option value="">Select City</option>

                                    </select>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input class="form-control" type="text" name="pin">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="patient_active"
                                            value="active" checked>
                                        <label class="form-check-label" for="patient_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="patient_inactive"
                                            value="In-active">
                                        <label class="form-check-label" for="patient_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                             </div>
    </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn">Create Admin</button>
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
    <!-- <script src="<?php echo base_url('/js/country-states.js')?>"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   

    


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

    function validatePassword() {
        var password = document.getElementById("password").value;
        var passwordError = document.getElementById("passwordError");

        // Check if the password meets certain criteria
        if (password.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters long';
        } else {
            passwordError.textContent = "";
        }
    }
    </script>
    <script>
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



    document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('registrationForm');
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');

    form.addEventListener('submit', function(event) {
        // Clear previous error message
        emailError.textContent = '';

        // Validate email format using regular expression
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            event.preventDefault(); // Prevent form submission
            emailError.textContent = 'Invalid email format';
        }
    });
});







    </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
   <script src="https://cdn.jsdelivr.net/npm/country_state_district@1.0.6/index.min.js"type="module" defer> ></script>




  
<script>
    $(document).ready(function () {
        $('#country').change(function () {
            var countryId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/get_states'); ?>",
                data: {country_id: countryId},
                dataType: 'json',
                success: function (states) {
                    $('#state').empty();
                    $('#state').append('<option value="">Select State</option>');
                    $.each(states, function (index, state) {
                        $('#state').append('<option value="' + state.state_id + '">' + state.state_name + '</option>');
                    });
                }
            });
        });
        $(document).ready(function () {
        $('#state').change(function () {
            var stateId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/get_districts'); ?>",
                data: {state_id: stateId},
                dataType: 'json',
                success: function (districts) {
                    $('#dist').empty();
                    $('#dist').append('<option value="">Select District</option>');
                    $.each(districts, function (index,districts ) {
                        $('#dist').append('<option value="' + districts.dist_id + '">' + districts.dist_name + '</option>');
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#dist').change(function () {
            var distId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/get_cities'); ?>",
                data: {dist_id: distId},
                dataType: 'json',
                success: function (cities) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(cities, function (index,cities) {
                        $('#city').append('<option value="' + cities.city_id + '">' + cities.city_name + '</option>');
                    });
                }
            });
        });
    });

  

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize country dropdown
        CountryStateDistrict.getCountries().forEach(country => {
            let option = new Option(country.name, country.id);
            document.getElementById("countryDropdown").add(option);
        });

        // Add event listener to country dropdown
        document.getElementById("countryDropdown").addEventListener("change", function () {
            const countryId = this.value;
            const states = CountryStateDistrict.getStates(countryId);
            populateDropdown("stateDropdown", states);
        });

        // Add event listener to state dropdown
        document.getElementById("stateDropdown").addEventListener("change", function () {
            const stateId = this.value;
            const districts = CountryStateDistrict.getDistricts(stateId);
            populateDropdown("districtDropdown", districts);
        });

        // Function to populate dropdown
        function populateDropdown(selectId, options) {
            let selectElement = document.getElementById(selectId);
            selectElement.innerHTML = ""; // Clear previous options
            options.forEach(option => {
                let optionElement = new Option(option.name, option.id);
                selectElement.add(optionElement);
            });
        }
    });

// Event listener for country dropdown change
// document.getElementById('countryDropdown').addEventListener('change', function() {
//     const countryId = parseInt(this.value);
//     const states = CountryStateDistrict.getStatesByCountryId(countryId);
//     const stateDropdown = document.getElementById('stateDropdown');
//     stateDropdown.innerHTML = '<option value="">Select State</option>';
//     states.forEach(state => {
//         const option = new Option(state.name, state.id);
//         stateDropdown.add(option);
//     });
// });

// // Event listener for state dropdown change
// document.getElementById('stateDropdown').addEventListener('change', function() {
//     const stateId = parseInt(this.value);
//     const districts = CountryStateDistrict.getDistrictsByStateId(stateId);
//     const districtDropdown = document.getElementById('districtDropdown');
//     districtDropdown.innerHTML = '<option value="">Select District</option>';
//     districts.forEach(district => {
//         const option = new Option(district.name, district.id);
//         districtDropdown.add(option);
//     });
// });
    
});

    // Similar AJAX calls for districts and cities

    </script>

</body>


<!-- add-patient24:07-->

</html>