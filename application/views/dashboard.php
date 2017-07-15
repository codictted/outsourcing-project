<div class="col-lg-12 dashboards">
	<h3>Keep track of your daily notifications, admin!</h3>
	<div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary dash1">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-search bigicon-white"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $new_apps; ?></div>
                            <div>New Applicant!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>admin/admin_applicant_list">
                    <div class="panel-footer">
                        <span class="pull-left">Go to Applicant Transaction</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-shopping-cart bigicon-white"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $new_orders; ?></div>
                            <div>New Job Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url()?>admin/admin_order_list">
                    <div class="panel-footer">
                        <span class="pull-left">Go to Job Order Transaction</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
        	<div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list bigicon-white"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>New Short List Request!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Go to Applicant Management</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-user bigicon-white"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>New Staff Replacement Request!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Go to Staff Transaction</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>