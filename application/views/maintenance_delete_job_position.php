<div class="admin-container">
        <form class="form-horizontal slide-effect" id="job-form" action="<?php echo base_url()?>maintenance/delete_job_position/" method="POST">
            <fieldset>
                <legend>Delete Job Position</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b> <p class="alert-p">Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</p>
                    </div>
                </div>

                <?php if($this->session->flashdata("fail_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><i class="glyphicon glyphicon-warning-sign"></i>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <input type="hidden" value="<?php echo $job[0]->id; ?>" name="job_id">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Category:
                    </label>

                    <label class="col-lg-2 control-label form-label" style="text-align:left;">
                        <text><?php echo $job[0]->JcName; ?></text>
                    </label>

                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Skill Set:
                    </label>

                    <label class="col-lg-2 control-label form-label" style="text-align:left;">
                        <text><?php echo $job[0]->SSName; ?></text>
                    </label>

                </div>

                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Position Name:
                    </label>

                    <label class="col-lg-2 control-label form-label" style="text-align:left;">
                        <text><?php echo $job[0]->name; ?></text>
                    </label>

                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Skill:
                    </label>

                    <label class="col-lg-2 control-label form-label" style="text-align:left;">
                        <?php
                            foreach ($job as $j) {
                        ?>
                                <text><?php echo $j->SName; ?></text><br>
                        <?php
                            }
                        ?>
                        
                    </label>
                </div>
                
                <hr>
                <div class="form-group">
                    <center>
                        <button type="reset" class="btn btn-default" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Delete</button>
                    </center>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">

    $('#cancel').click(function(){
        window.location.href="<?php echo base_url();?>maintenance/job_position/";
    });

</script>
