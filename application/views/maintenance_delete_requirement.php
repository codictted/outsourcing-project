<div class="admin-container">
        <form class="form-horizontal slide-effect" id="requirement-form" action="<?php echo base_url()?>maintenance/delete_req_document/" method="POST">
            <fieldset>
                <legend>Delete Required Document</legend>
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
                    <input type="hidden" value="<?php echo $doc->id; ?>" name="req_id">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Required Document Name:
                    </label>
                    <label class="col-lg-3 control-label form-label" style="text-align:left;">
                        <text><?php echo $doc->requirement; ?></text>
                    </label>
                </div>

                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> To Follow?
                    </label>
                    <div class="col-lg-3 control-label form-label" style="text-align:left;">
                        <text><?php $doc->is_required == 0 ? print_r("Yes") : print_r("No"); ?></text>
                    </div>
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
        window.location.href="<?php echo base_url();?>maintenance/required_documents/";
    });

</script>
