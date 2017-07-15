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
        <script src="<?php echo base_url(); ?>assets/magicsuggest/magicsuggest-min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/magicsuggest/magicsuggest.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sb-admin.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootswatch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">  
    </head>
    <body>
        <div class="container">
            <div class="row fade-effect">
                <div class="contcustom">
                    <span class="glyphicon glyphicon-user bigicon"></span>
                    <h2 class="blue">Log In</h2>
                    <div class="indiv-error"><?php echo $this->session->flashdata("invalid"); ?></div><br>
                    <form class="form-horizontal" action="<?php echo base_url()?>login/check_user" method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control col-lg-12" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control col-lg-12" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary col-lg-12"><span class="glyphicon glyphicon-lock medicon"></span></button>
                        </div>
                    </form>              
                </div>
            </div>
        </div>
    </body>
</html>