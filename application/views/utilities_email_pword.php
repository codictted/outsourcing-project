<div class="admin-container">
    <form action="<?php echo base_url('utilities/update_agency_email') ?>" method="POST" class="form-horizontal fade-effect" id="agency_email-form">
        <fieldset>
            <legend>Agency's Email</legend>
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

            <div class="col-lg-6">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h4>
                            *Enter Email:
                            </h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-form">
                                <!-- <span class="indiv-error"><?php //echo form_error("contact_name"); ?></span> -->
                                <input type="email" id="agency_email" value="<?php echo $agem[0]->agency_email; ?>" name="a_email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h4>
                            *Enter Password:
                            </h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-form">
                                <!-- <span class="indiv-error"><?php //echo form_error("contact_name"); ?></span> -->
                                <input type="text" id="agency_pword" value="<?php echo $agem[0]->agency_pword; ?>" name="a_pword" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

        </fieldset>
    </form>
</div>
</body>
</html>