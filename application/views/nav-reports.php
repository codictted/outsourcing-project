
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">    
        <li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#dropdown_1"><i class="fa fa-fw fa-arrows-v"></i>
                    <span class="glyphicon glyphicon-briefcase small"></span>Client<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="dropdown_1" class="collapse">
                        <li>
                            <a href="<?php echo base_url()?>reports/"><span class="glyphicon glyphicon-folder-open small"></span>Clients with most job ordered</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>reports/client_cns/"><span class="glyphicon glyphicon-tag small"></span>Clients with most number of staff</a>
                        </li>
                    </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#dropdown_2"><i class="fa fa-fw fa-arrows-v"></i>
                    <span class="glyphicon glyphicon-user small"></span>Applicant<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="dropdown_2" class="collapse">
                        <li>
                            <a href="<?php echo base_url()?>reports/applicant_ama/"><span class="glyphicon glyphicon-plane-calendar small"></span>Months with most applicants</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>reports/applicant_aaa/"><span class="glyphicon glyphicon-list-alt small"></span>Area with most applicants</a>
                        </li>
                    </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#dropdown_3"><i class="fa fa-fw fa-arrows-v"></i>
                    <span class="glyphicon glyphicon-list small"></span>Job<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="dropdown_3" class="collapse">
                        <li>
                            <a href="<?php echo base_url()?>reports/job_moj"><span class="glyphicon glyphicon-star small"></span>Most ordered jobs</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>reports/job_maj"><span class="glyphicon glyphicon-file small"></span>Most applied jobs</a>
                        </li>
                    </ul>
            </li>

        </li>
    </ul>
</div>