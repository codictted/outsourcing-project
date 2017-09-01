    <div class="admin-container slide-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Auto Job Match Result of <?php echo $applicant_det->first_name." ".$applicant_det->last_name; ?> as <?php echo $jname[0]->name; ?></legend>
            </fieldset>
        </form>
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable small">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">The applicant's skills and qualifications were matched against all the job orders from different clients who requested the same position the applicant is applying for.</p>
            </div>
        </div>
        <div class="col-lg-12">
            <h4><i>These are the following client which has an ongoing <?php echo $jname[0]->name; ?> orders:</i></h4>
            <?php $ctr = 1; ?>
            <?php foreach($job_match as $jm) { ?>
            <div class="form-group">
                <h3>
                    <a data-toggle="collapse" href="<?php echo '#tab'.$ctr; ?>"><?php echo $jm['client']; ?>:&nbsp; <?php echo round(($jm['matched']/$jm['total']) * 100, 2); ?>%</a>
                </h3>
                <div id="<?php echo 'tab'.$ctr; ?>" class="panel-collapse collapse">
                    <div class="panel-heading">
                    </div>
                    <table class="table col-lg-12 custom-table-large table-striped">
                        <tr>
                            <td colspan="2"><b><center>QUALIFICATIONS</center></b></td>
                            <td colspan="2"><b><center>SKILLS</center></b></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-ok"></span>Matched</td>
                            <td><span class="glyphicon glyphicon-remove"></span>Did Not Matched</td>
                            <td><span class="glyphicon glyphicon-ok"></span>Matched</td>
                            <td><span class="glyphicon glyphicon-remove"></span>Did Not Matched</td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <?php foreach($jm['match_quali'] as $val) { ?>
                                    <li><?php echo $val; ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach($jm['nonmatch_quali'] as $val) { ?>
                                    <li><?php echo $val; ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach($jm['match_skill'] as $val) { ?>
                                    <li><?php echo $val; ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach($jm['nonmatch_skill'] as $val) { ?>
                                    <li><?php echo $val; ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <div class="panel-footer">
                        <text>Total number of items: &nbsp;<?php echo $jm['total']; ?></text><br>
                        <text>Total number of matched items: &nbsp;<?php echo $jm['matched']; ?></text><br>
                        <text>Auto Match Result: &nbsp;<?php echo $jm['client']; ?>: <?php echo round(($jm['matched']/$jm['total']) * 100, 2); ?>%</text>
                    </div>
                </div>
            </div>
            <?php $ctr++; } ?>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="col-lg-12">
            <div class="col-lg-6 sms">
                <div class="form-group">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <text>Notify Applicant via SMS Notification.</text>
                </div>
                <div class="form-group">
                    <button style="margin-left: 40px;" data-toggle="modal" data-target="#interview_message" class="btn btn-primary btn-sm">Confirm to Applicant</button><br>
                    <span class="help-block col-lg-12">
                        <i class="glyphicon glyphicon-info-sign"></i>
                        <i>Send an SMS notification to applicant that you have recieved his application and schedule him for an interview.</i>
                    </span>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="interview_message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notify <?php echo $applicant_det->first_name." ".$applicant_det->last_name; ?> via SMS</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url('admin/send_interview_message'); ?>" method="post" id="sms_form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label form-label">
                            Send to:
                        </label>
                        <div class="col-lg-7">
                            <div class="error-form">
                                <input type="text" id="app_number" name="app_number" class="form-control" value="<?php echo $applicant_det->mobile; ?>">
                                <input type="hidden" name="app_id" value="<?php echo $applicant_det->id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="col-lg-3 control-label form-label">
                            Message:
                        </label>
                        <div class="col-lg-7">
                            <div class="error-form">
                                <textarea rows="6" class="form-control" name="message" id="message"><?php echo "Hi, ".$applicant_det->first_name."! This is OMS and we would like to inform you the schedule of your interview."; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label form-label">
                            Time:
                        </label>
                        <div class="col-lg-7">
                            <div class="error-form">
                                <input type="time" name="interview_time" id="interview_time" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label form-label">
                            Interview Date:
                        </label>
                        <div class="col-lg-7">
                            <div class="error-form">
                                <input type="date" name="interview_date" id="interview_date" class="form-control">
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
