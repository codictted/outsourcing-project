<div class="admin-container">
    <form action="<?php echo base_url('utilities/update_text_message') ?>" method="POST" class="form-horizontal fade-effect" id="text_message_form">
        <fieldset>
            <legend>Text Messages</legend>

            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable small">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b>
                    <p class="alert-p">This sets the job interview and job offer text messages to be sent to the applicants.</p>
                </div>
            </div>

            <?php if($this->session->flashdata('success_notification')): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Well done!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('success_notification'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata("fail_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oh snap!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('fail_notification'); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                <br>
                <hr>
                <br>
            </div>

            <div class="col-lg-6">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h4>
                            *Job Interview Text Message:
                            </h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-form">
                                <!-- <span class="indiv-error"><?php //echo form_error("contact_name"); ?></span> -->
                                <textarea class="form-control" rows="2" name="ji_text_mess"
                                maxlength="100"><?php echo $teme[0]->job_interview_text; ?></textarea>
                                <!--<input type="number" id="jobmatch_passrate" value="<?php echo $rate; ?>" name="jobmatch_passrate" class="form-control" min="1" max="100">-->
                            </div>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary center-block">Save Changes</button>
                        </div>
                    </div>-->
                  </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h4>
                            *Job Offer Text Message:
                            </h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-form">
                                <!-- <span class="indiv-error"><?php //echo form_error("contact_name"); ?></span> -->
                                <textarea class="form-control" rows="2" name="jo_text_mess"
                                maxlength="100"><?php echo $teme[0]->job_offer_text; ?></textarea>
                                <!--<input type="number" id="jobmatch_passrate" value="<?php echo $rate; ?>" name="jobmatch_passrate" class="form-control" min="1" max="100">-->
                            </div>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary center-block">Save Changes</button>
                        </div>
                    </div>-->
                  </div>
                </div>
            </div>

        </fieldset>
    </form>
</div>
</body>
</html>