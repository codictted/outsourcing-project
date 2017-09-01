 <!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-function.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery-weekly-scheduler/src/index.js"></script>
        <script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sb-admin.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootswatch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/select2/dist/css/select2.min.css">
    </head>
    <body>
    <?php if($this->session->userdata('name')): ?>
    <?php endif; ?>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo base_url(); ?>" class="navbar-brand">Outsourcing Management System</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Good to see you again, <?php echo $this->session->userdata('name'); ?>!</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>login/logout">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <hr class="custom">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav client-side-nav">    
                <li>
                    <a href="<?php echo base_url()?>client/">
                    <span class="glyphicon glyphicon-home small"></span>Home</a>
                </li>
                <li>
                    <a href="<?php echo base_url()?>client/client_order_list"><span class="glyphicon glyphicon-import small"></span>Job Order</a>
                </li>
                <li>
                    <a href="<?php echo base_url()?>client/shortlist"><span class="glyphicon glyphicon-list-alt small"></span>Short List</a>
                </li>
                <li>
                    <a href="<?php echo base_url()?>client/staff"><span class="glyphicon glyphicon-king small"></span>Staff Management</a>
                </li>
            </ul>
        </div>