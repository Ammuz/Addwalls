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
                        <h4 class="page-title">Edit Dividend</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="<?=site_url('dividend/update/'.$dividends['dividend_id']) ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <input type="hidden" name="dividend_id" value="<?=$dividends['dividend_id']?>">

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Dividend <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="dividend"
                                            value="<?=$dividends['dividend']?>" required>
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

</body>


<!-- add-patient24:07-->

</html>