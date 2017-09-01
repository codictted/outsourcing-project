<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/jquery-function.js"></script>   

        <script src="<?php echo base_url(); ?>assets/morrisjs/morris.js"></script>
        <script src="<?php echo base_url(); ?>assets/raphael/raphael.js"></script> 
        <script src="<?php echo base_url(); ?>assets/datepicker/moment-with-locales.js"></script>
        <script src="<?php echo base_url(); ?>assets/datepicker/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-utilities.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/bootstrap-datetimepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/select2/dist/css/select2.min.css">  
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sb-admin.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootswatch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">  
        <link href="<?php echo base_url(); ?>assets/morrisjs/morris.css" rel="stylesheet">
      
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-list-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_url(); ?>" class="navbar-brand">Outsourcing Management System</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Good to see you again, Admin!</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>login/logout">Log out</a>
                    </li>
                </ul>
            </div>
             <div class="collapse navbar-collapse navbar-list-collapse horizontal-nav">
                <ul type="none">
                    <li class="horizontal horizontal-margin-left"><a href="<?php echo base_url(); ?>dashboard/"><span class="glyphicon glyphicon-globe"></span>Dashboard</a></li>
                    <li class="horizontal"><a href="<?php echo base_url(); ?>maintenance/"><span class="glyphicon glyphicon-wrench"></span>Maintenance</a></li>
                    <li class="horizontal"><a href="<?php echo base_url(); ?>admin/admin_client_list"><span class="glyphicon glyphicon-briefcase"></span>Transaction</a></li>
                    <li class="horizontal"><a href="<?php echo base_url(); ?>reports/"><span class="glyphicon glyphicon-book"></span>Reports</a></li>
                    <li class="horizontal"><a href="<?php echo base_url()?>query/"><span class="glyphicon glyphicon-th-list"></span> Queries</a></li>
                    <li class="horizontal"><a href="<?php echo base_url()?>utilities/"><span class="glyphicon glyphicon-cog"></span>Utilities</a></li>
                </ul>
            </div>
        </div>
        <!-- <hr class="custom"> -->