    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Manage Job Position</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">This sets the selection of different job positions used in application form.</p>
                    </div>
                </div>

                <?php if($this->session->flashdata('success_notification')): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><i class="glyphicon glyphicon-thumbs-up"></i>Well done!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('success_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata("access_error_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><i class="glyphicon glyphicon-warning-sign"></i>Oppss!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('access_error_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary col-lg-2 pull-right" data-toggle="modal" data-target="#add_jp_modal"><span class="glyphicon glyphicon-plus"></span>Add Job Position
            </button><br><br><br>
        </div>
        <div class="col-lg-12">
            <table id="job-table" class="custom-table-large table-hover">
                <thead>
                    <th><center>Status</center></th>
                    <th><center>Job Category</center></th>
                    <th><center>Job Name</center></th>
                    <th><center>Service Fee</center></th>
                    <th><center>Action</center></th>
                </thead>
                <tbody>
                    <?php foreach($job as $j) { ?>
                        <tr id="<?php echo $j->id ?>">
                            <?php 
                                if($j->status == 0){
                                    $status = "Active"; 
                                    echo "<script>
                                            $(function(){
                                                      $('input[name=my_checkbox_$j->id]').bootstrapSwitch('state', true, true);
                                            });  
                                        </script>";
                                }
                                else{
                                    $status = "Inactive"; 
                                }
                            ?>
                            <td><center><div id='changeState_<?php echo $j->id ?>'><?php echo $status; ?></div>
                            </center></td>
                            <td><center><?php echo $j->JCName; ?></center></td>
                            <td><center><?php echo $j->name; ?></center></td>
                            <td><center><?php echo $j->service_fee; ?></center></td>
                            <td><center>

                                <!-- DI MAKUHA YUNG ID KAYA DI LUMALABAS YUNG TAMANG DATA-->
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_jp_modal"><span class="glyphicon glyphicon-edit"></span></button>
                                <input id='switch-state' name='my_checkbox_<?php echo $j->id ?>' type='checkbox' value='<?php echo $j->id ?>' >
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_jp_modal"><span class="glyphicon glyphicon-trash"></span></button>
                            </center></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<!-- ADD JOB POSITION MODAL -->
<div class="modal fade" id="add_jp_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD JOB POSITION</h4>
      </div>

      <div class="modal-body">

          <div class="col-lg-12">
            <form class="form-horizontal" id="job-form" action="<?php echo base_url()?>maintenance/add_job_position/" method="POST">
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
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Add</button>
                    </center>
                </div>

            </form>
          </div>

      </div>

      <div class="modal-footer">
      </div>

    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modal-->

<!-- EDIT JOB POSITION MODAL -->
<div class="modal fade" id="edit_jp_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">EDIT JOB POSITION</h4>
      </div>

      <div class="modal-body">

          <div class="col-lg-12">
            <form class="form-horizontal" id="job-form" action="<?php echo base_url()?>maintenance/edit_job_position/" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $job[0]->id; ?>" name="job_id">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Category:
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_cat"); ?><span>
                            <select class="form-control" name="job_cat" style="width:100%;" required>  
                                <?php foreach($job_cat as $jc) {   
                                    if($jc->id == $job[0]->job_cat){
                                ?>
                                        <option value="<?php echo $jc->id?>" selected>&nbsp;&nbsp;<?php echo $jc->name?></option>
                                <?php
                                    }
                                    else{
                                ?>
                                        <option value="<?php echo $jc->id?>">&nbsp;&nbsp;<?php echo $jc->name?></option>
                                <?php
                                    }
                                }?> 
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
                            <input type="text" class="form-control" placeholder="Enter Job Position Name" name="job_name" value="<?php echo $job[0]->name; ?>">
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
                            <input type="text" class="form-control" placeholder="Enter Job Service fee" name="job_sf" value="<?php echo $job[0]->service_fee; ?>">
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
                                <?php foreach($skill_set as $jss) {  
                                    if($jss->id == $job[0]->job_skill_set){
                                ?>
                                        <option value="<?php echo $jss->id?>" selected>&nbsp;&nbsp;<?php echo $jss->name?></option>
                                <?php
                                    }
                                    else{
                                ?>
                                        <option value="<?php echo $jss->id?>">&nbsp;&nbsp;<?php echo $jss->name?></option>
                                <?php
                                    }
                                }?> 
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
                                <?php 
                                foreach($job as $sk){
                                    foreach($skill as $js) {  
                                        if($js->id == $sk->skill_id){
                                ?>
                                            <option value="<?php echo $js->name?>" selected>&nbsp;&nbsp;<?php echo $js->name?></option>  
                                <?php
                                        }
                                        else{
                                ?>
                                            <option value="<?php echo $js->name?>">&nbsp;&nbsp;<?php echo $js->name?></option>
                                <?php
                                        }
                                    }
                                }?> 
                            </select>  
                        </div>  
                        
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <center>
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Save</button>
                    </center>
                </div>

            </form>
          </div>

      </div>

      <div class="modal-footer">
      </div>

    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modal-->

<!-- DELETE JOB POSITION MODAL -->
<div class="modal fade" id="delete_jp_modal" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">DELETE JOB POSITION</h4>
      </div>

      <div class="modal-body">

          <div class="col-lg-12">
            <form class="form-horizontal slide-effect" id="job-form" action="<?php echo base_url()?>maintenance/delete_job_position/" method="POST">
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

                <div class="form-group">
                    <label for="name" class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Job Service fee:
                    </label>

                    <label class="col-lg-2 control-label form-label" style="text-align:left;">
                        <text><?php echo $job[0]->service_fee; ?></text>
                    </label>
                </div>

                
                
                <hr>
                <div class="form-group">
                    <center>
                        <button type="reset" class="btn btn-default" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sub">Delete</button>
                    </center>
                </div>
            </form>
          </div>

      </div>

      <div class="modal-footer">
      </div>

    </div><!--modal-content-->
  </div><!--modal-dialog-->
</div><!--modal-->

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#job-table").dataTable();
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var ID = $(this).val();
        var value = state ? value = 0 : value = 1;
        var url = "<?php echo base_url()?>maintenance/status_job/";
        var dataString = "job_id=" + ID + "&";
            dataString += "job_status=" + value;

            state ? $('#changeState_'+ ID).html("Active"): $('#changeState_'+ ID).html("Inactive");

            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                }    
            }); 
    });

    function edit_jp(id) {
        window.location.href="<?php echo base_url();?>maintenance/edit_job_position_form/" + id;
    }  

    function delete_jp(id) {
        window.location.href="<?php echo base_url();?>maintenance/delete_job_position_form/" + id;
    }

    function view_jl(id) {
        window.location.href="<?php echo base_url();?>maintenance/view_job_position_form/" + id;
    }

    // ADD JOB POSITION SCRIPT ------------------------------------>
    $("#cancel").click(function(){
        window.location.href="<?php echo base_url();?>maintenance/job_position/";
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


    // EDIT JOB POSITION SCRIPT ------------------------------------>
    $("#cancel").click(function(){
        window.location.href="<?php echo base_url();?>maintenance/job_position/";
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

    $("[name='skill[]']").find('option:not(:selected)').remove();
   
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

    // DELETE JOB POSITION SCRIPT ------------------------------------>



</script>