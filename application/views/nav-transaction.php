
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">    
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_client_list">
                    <span class="glyphicon glyphicon-user small"></span>Client Management</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#dropdown_1"><i class="fa fa-fw fa-arrows-v"></i>
                    <span class="glyphicon glyphicon-briefcase small"></span>Job Management<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="dropdown_1" class="collapse">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/admin_order_list"><span class="glyphicon glyphicon-import small"></span>Job Order</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/jobopen_list"><span class="glyphicon glyphicon-dashboard small"></span>Job Openings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_applicant_list"><span class="glyphicon glyphicon-knight small"></span>Applicant Management</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_staff_list"><span class="glyphicon glyphicon-king small"></span>Staff Management</a>
                </li>
            </ul>
        </div>