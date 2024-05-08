
<!DOCTYPE html>
<html lang="en">
<!-- patients23:17-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title><?=(isset($pageTitle))? $pageTitle:'document' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/font-awesome.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/style.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/select2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/bootstrap-datetimepicker.min.css')?>">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/dataTables.bootstrap4.min.css')?>">
    <script src="<?php echo base_url('/js/dataTables.bootstrap4.min.js')?>"></script>
    <script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        //tod=new Date(form.myInput.value);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }

        }
    }
    </script>
</head>

<body>
    <div class="main-wrapper">
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Tertiarty Managers</h4>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="myTable">
                                <thead>
                                    <input class="form-control col-md-3" type="text" id="myInput" onkeyup="myFunction()"
                                        placeholder="Search for Name.." title="Type in a name">
                                    <br>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Username</th>
                                        <!-- <th>Manager Code</th> -->
                                        <th>Email</th>
                                        <th>Adhaar No</th>
                                        <th>Pan No</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Agents</th>
                                        <th>Action</th>
                                        <!--<th class="text-right">Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                  $i=1; if($tertiary_managers): ?>
                                    <?php foreach($tertiary_managers as $tertiary_manager): ?>
                                    <tr>
                                        <td><?=$i;?></td>

                                        <td><?=$tertiary_manager->username;?></td>
                                        <!-- <td><?=$tertiary_manager->manager_code;?></td> -->
                                        <td><?=$tertiary_manager->email;?></td>
                                        <td><?=$tertiary_manager->Adhar_cardno;?></td>                      
                                        <td><?=$tertiary_manager->Pancardno;?></td>
                                        <td><?=$tertiary_manager->Paddress;?></td>
                                        <td><?=$tertiary_manager->Status;?></td>
                                        <td>
                                            <a href="<?php echo base_url('show/agents/'. $tertiary_manager->Tmanager_id); ?>"
                                                class="editBtn"><button class="edit-button" ><i class="fas fa-eye"></i></button></a></td>
                                        <td>
                                            <a href="<?= base_url('tertiarymanager/edit/'.$tertiary_manager->Tmanager_id)?>"
                                                class="editBtn"><button class="edit-button" ><i class="fas fa-edit"></i></button></a>
                                            <a href="<?= base_url('tertiarymanager/delete/'.$tertiary_manager->Tmanager_id) ?>"
                                                class="deleteBtn"><button class="delete-button"><i class="fas fa-trash-alt"></i> </button></a>
                                   

                                    </tr>
                                    <?php ++$i; endforeach; ?>
                                    <?php  endif; ?>
                                </tbody>
                            </table>
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
    <script src="<?php echo base_url('/js/select2.min.js')?>"></script>
    <script src="<?php echo base_url('/js/app.js')?>"></script>
    <script src="<?php echo base_url('/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('/js/moment.min.js')?>"></script>
    <script src="<?php echo base_url('/js/bootstrap-datetimepicker.min.js')?>"></script>


    <script>
        $(document).ready(function() {
            $('.deleteBtn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action of the link
                var deleteUrl = $(this).attr('href'); // Get the delete URL from the link
                //console.log(deleteUrl);
                if (confirm("Are you sure you want to delete?")) {
                    window.location.href = deleteUrl; // Redirect to the delete URL if confirmed
                }
            });
        });
    </script>
</body>


<!-- patients23:19-->

</html>