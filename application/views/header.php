<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-function.js"></script>
        <script src="<?php echo base_url(); ?>assets/magicsuggest/magicsuggest-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-application.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/magicsuggest/magicsuggest.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootswatch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo base_url(); ?>" class="navbar-brand">Outsourcing Management System</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Job Services 
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">House Keeper</a>
                                </li>
                                <li>
                                    <a href="#">Caregiver/Yaya</a>
                                </li>
                                <li>
                                    <a href="#">Driver</a>
                                </li>
                                <li>
                                    <a href="#">Painter</a>
                                </li>
                                <li>
                                    <a href="#">Construction Worker</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                          <a href="../help/">About</a>
                        </li>
                        <li>
                          <a href="http://news.bootswatch.com">Contact Us</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Apply As 
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url()?>applicant/">Applicant</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>home/#contact_us">Client</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <?php if($this->session->userdata("usertype")){ ?>
                            <a href="<?php echo base_url()?>login/logout">Log out</a>
                            <?php }else { ?>
                            <a href="<?php echo base_url()?>login/">Log in</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>