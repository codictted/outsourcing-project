    <div class="admin-container">
        <form class="form-horizontal slide-effect" id="category-form" action="<?php echo base_url()?>maintenance/edit_category/" method="POST">
            <fieldset>
                <legend>Edit Job Category</legend>
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
                    <input type="hidden" value="<?php echo $cat->id; ?>" name="cat_id">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Category Name:
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("cat_name"); ?></span>
                            <input type="text" class="form-control" placeholder="Enter Job Category Name" name="cat_name" value="<?php echo $cat->name;?>">
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="form-group">
                    <center>
                        <button type="reset" class="btn btn-default" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Edit</button>
                    </center>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">

    $('#cancel').click(function(){
        window.location.href="<?php echo base_url();?>maintenance/";
    });

</script>
