    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Applicants</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                        <br>
                        <p class="alert-p">You can view the applicant's full application details by clicking the row.</p>
                        <br>
                        <b>STATUS LEGEND:</b>
                        <div id="legend">
                            <br>
                            <ul class="breadcrumb">
                                <li><a href="#new">New</a></li>
                                <li><a href="#job-matched">Job Matched</a></li>
                                <li><a href="#for-interview">For Interview</a></li>
                                <li><a href="#interview-default">For Interview (Default)</a></li>
                                <li><a href="#failed-interview">Failed Interview</a></li>
                                <li><a href="#shortlist-ready">Ready to Short List</a></li>
                                <li><a href="#shortlist-rejected">Shortlisted (Rejected)</a></li>
                                <li><a href="#shortlist-selected">Shortlisted (Selected)</a></li>
                                <li><a href="#job-offered">Job Offered</a></li>
                                <li><a href="#job-offered-rejected">Job Offered (Rejected)</a></li>
                                <li><a href="#requirements">Passing of Requirements</a></li>
                                <li><a href="#for-endorsement">For Endorsement</a></li>
                                <li><a href="#deployed">Deployed</a></li>
                            </ul>
                            <div id="new">
                                <p class="alert-p">If the applicant's status is new, it will undergo in job matching. The applicant will be notified for it's match result via SMS notification.</p>
                            </div>
                            <div id="job-matched">
                                <p class="alert-p">After Job Matching, if the applicant wishes to continue its application, he/she will recieve an SMS notification regarding about his interview schedule.</p>
                            </div>
                            <div id="for-interview">
                                <p class="alert-p">Failure to come after a week, will automatically change the applicant's status to default.</p>
                            </div>
                            <div id="interview-default">
                                <p class="alert-p">Failure to come on interview.</p>
                            </div>
                            <div id="failed-interview">
                                <p class="alert-p">Failed the interview.</p>
                            </div>
                            <div id="shortlist-ready">
                                <p class="alert-p">Upon success of interview, the applicant is now ready to be shortlisted.</p>
                            </div>
                            <div id="shortlist-rejected">
                                <p class="alert-p">If the applicant is rejected by the client, he can be re-shortlist to other client who needs a same job position.</p>
                            </div>
                            <div id="shortlist-selected">
                                <p class="alert-p">Shall send a job offer to selected applicants.</p>
                            </div>
                            <div id="job-offered">
                                <p class="alert-p">Already sent the job offer the applicants.</p>
                            </div>
                            <div id="job-offered-rejected">
                                <p class="alert-p">He can request to be shortlisted to other client if he doesn't like the offer.</p>
                            </div>                            
                            <div id="requirements">
                                <p class="alert-p">Requirements tracking. The applicant will only be endorsed after passing all the necessary documents.</p>
                            </div>
                            <div id="for-endorsement">
                                <p class="alert-p">Contract signing between agency and the applicant.</p>
                            </div>
                            <div id="deployed">
                                <p class="alert-p">The applicant is already hired.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Well Done!</b> <p class="alert-p"><?php echo $this->session->flashdata("success_notification"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_contact_us'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group col-lg-12">
                    <label class="form-label col-lg-1">Filter:</label>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
                    </div>
                    <div class="col-lg-3 pull-right">                    
                        <button type="button" class="btn btn-primary col-lg-12" onclick="window.location.href='create_shortlist'"><span class="glyphicon glyphicon-plus"></span>
                            Create a Short List
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <table id="app-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Job Position</th>
                    <th>Age/Gender</th>
                    <th>Nationality/Race</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        foreach ($applicant as $app) { 
                            $status = "";
                            $url = "";
                            $page = 1; // triggers new page; 2 if modal
                            switch ($app->status) {
                                case '0':
                                    $status = "New";
                                    $url = base_url()."admin/applist_new/";
                                    break;

                                case '1':
                                    $status = "Job Matched";
                                    $url = base_url()."admin/applist_matched/";
                                    break;

                                case '2':
                                    $status = "For Interview";
                                    $url = "interview_modal";
                                    $page = 2;
                                    break;
                                
                                case '3':
                                    $status = "For Interview(Default)";
                                    break;

                                case '4':
                                    $status = "Failed Interview";
                                    break;

                                case '5':
                                    $status = "Ready to Shortlist";
                                    break;

                                case '6':
                                    $status = "Shortlisted";
                                    $url = "shortlisted_modal";
                                    $page = 2;
                                    break;
                                
                                case '7':
                                    $status = "Shortlisted - Rejected";
                                    break;

                                case '8':
                                    $status = "Shortlisted - Selected";
                                    $url = "job_offer_modal";
                                    $page = 2;
                                    break;

                                case '9':
                                    $status = "Job Offered";
                                    $url = "job_offer_response";
                                    $page = 2;
                                    break;

                                case '10':
                                    $status = "Job Offered - Rejected";
                                    break;
                                
                                case '11':
                                    $status = "Passing of Requirements";
                                    $url = "requirements_modal";
                                    $page = 2;
                                    break;

                                case '12':
                                    $status = "For Endorsement";
                                    break;
                                
                                case '13':
                                    $status = "Deployed";
                                    break;
                            }
                            $gen = $app->gender == 1 ? "Male" : "Female"; ?>
                    <tr id="<?php echo $app->id; ?>" onclick="get_app(this.id)">
                        <td><?php echo $status; ?></td>
                        <td><?php echo $app->first_name.' '.$app->last_name; ?></td>
                        <td><?php echo $app->jname; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td>Filipino</td>
                        <td><?php echo $app->application_date; ?></td>
                        <td>
                            <?php if($page == 1) { ?>
                                <button class="btn btn-default btn-sm table-btn" id="<?php echo $app->id; ?>" onclick="window.location.href='<?php echo $url; ?>'+this.id"><span class="glyphicon glyphicon-list"></span>
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-default btn-sm modal-btn" id="<?php echo $app->id."-".$url; ?>"><span class="glyphicon glyphicon-list"></span>
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="interview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Interview Result</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/update_applicant_interview'); ?>" method="post" class="form-horizontal" id="update_interview_form">
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Result:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <input type="hidden" name="applicant_id">
                            <select class="form-control" name="result" id="result">
                                <option value="1">Passed</option>
                                <option value="2">Failed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Remarks:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <textarea rows="2" name="remarks" id="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="job_offer_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send a Job Offer to <text name="app_name"></text> through SMS</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/send_job_offer'); ?>" method="post" class="form-horizontal" id="update_interview_form">
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Mobile No:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <input type="text" name="app_number" id="app_number" class="form-control">
                            <input type="hidden" name="applicant_id">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Message:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <textarea rows="3" name="message" id="message" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="job_offer_response">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update applicant's response</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/job_offer_response'); ?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Result:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <input type="hidden" name="applicant_id">
                            <select class="form-control" name="result">
                                <option value="1">Accepted</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="shortlisted_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shortlist Details</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/job_offer_response'); ?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Client:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <text class="larger-label" id="cname"></text>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Position:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <text class="larger-label" id="pos"></text>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        Date shortlisted:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <text class="larger-label" id="shor_date"></text>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="requirements_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Requirements Tracking for <text name="app_name"></text></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/save_applicant_require'); ?>" method="post" class="form-horizontal">
                <input type="hidden" name="applicant_id">
                <table class=" table custom-table-large">
                    <thead>
                        <th><center>Submitted</center></th>
                        <th><center>Required Document</center></th>
                        <th><center>Date Submitted</center></th>
                    </thead>
                    <tbody id="req_table">
                        
                    </tbody>
                </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(function() {

        //initialize datatable
        $("#app-table").dataTable();
        
    });
    function get_app(id) {
        window.location.href="<?php echo base_url();?>admin/applicant_full_details/" + id;
    }
</script>