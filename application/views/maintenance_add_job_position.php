    <div class="admin-container">
        <form class="form-horizontal slide-effect" id="job-form" action="<?php echo base_url()?>maintenance/add_job_position/" method="POST">
            <fieldset>
                <legend>Add Job Position</legend>
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
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Category:
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_cat"); ?><span>
                            <select class="form-control" name="job_cat" style="width:100%;" required>
                                    <option selected disabled>&nbsp;&nbsp;-- Choose Job Category --</option>   
                                <?php foreach($job_cat as $jc) {   ?>
                                    <option value="<?php echo $jc->id?>">&nbsp;&nbsp;<?php echo $jc->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Position Name:
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_name"); ?></span>
                            <input type="text" class="form-control" placeholder="Enter Job Position Name" name="job_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Service fee:
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_sf"); ?></span>
                            <input type="text" class="form-control" placeholder="Enter Job Service fee" name="job_sf">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Skill Set:  
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("skill_set"); ?></span>

                             <select class="form-control" multiple name="skill_set" style="width:100%;" required>
                                <?php foreach($job_skill_set as $jss) {   ?>
                                    <option value="<?php echo $jss->id?>">&nbsp;<?php echo $jss->name?></option>
                                <?php }?>
                            </select>  
                        </div>  
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Skill:  
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("skill"); ?></span>

                             <select class="form-control" multiple="multiple" name="skill[]" style="width:100%;" required>
                            </select>  
                        </div>  
                        
                    </div>
                </div>


                
                <hr>
                <div class="form-group">
                    <center>
                        <button type="reset" class="btn btn-default" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Add</button>
                    </center>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">

    $("#cancel").click(function(){
        window.location.href="<?php echo base_url();?>maintenance/";
    });
   
    $("[name='job_cat']").select2(); 

    $("[name='skill_set']").select2({
        maximumSelectionLength: 1,
        tags: true,
        placeholder: '    Select skill set option',
        allowClear: true,
        createTag: function (params) {
            var term = $.trim(params.term);
           
            if (term.match(/^[!@#$%^&*()]+$/g)) {
              return null;
            }
        
            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
        }
    }); 


    $("[name='skill[]']").select2({
        tags: true,
        placeholder: '    Select skill option',
        allowClear: true,
        createTag: function (params) {
            var term = $.trim(params.term);
           
            if (term.match(/^[!@#$%^&*()]+$/g)) {
              return null;
            }
        
            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
        }
    }); 
    
    $("[name='skill_set']").on("change", function (e) { 
            var url = "<?php echo base_url()?>maintenance/change_select_skill_id/";
            $("[name='skill[]']").find('option').remove().trigger('change');
            
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: $("[name='skill_set']").serialize(),
                success: function(data) {
                    $("[name='skill[]']").find('option:not(:selected)').remove().trigger('change');
                    $("[name='skill[]']").select2({
                        placeholder: '    Select skill option',
                        allowClear: true,
                        tags: true,
                        data: data
                    });
                
                }   
            }); 
    });

</script>