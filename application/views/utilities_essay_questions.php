<div class="admin-container fade-effect">

    <form class="form-horizontal">

        <fieldset>
            <legend>Essay Questions</legend>

            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable small">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b>
                    <p class="alert-p">This sets the essay questions to be answered by the applicants.</p>
                </div>
            </div>

            <?php if($this->session->flashdata('success_notification')): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="alert-p"><?php echo $this->session->flashdata('success_notification'); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata("fail_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><i class="glyphicon glyphicon-warning-sign"></i>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification'); ?></p>
                        </div>
                    </div>
            <?php endif; ?>

            <?php if($this->session->flashdata("access_error_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong><i class="glyphicon glyphicon-warning-sign"></i>Oops!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('access_error_notification'); ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </fieldset>
    </form>

    <div class="col-lg-8">
        <table id="essay-question-table" class="custom-table-large table-hover">
            <thead>
                <th><center>Status</center></th>
                <th><center>Essay Question</center></th>
                <th><center>Action</center></th>
            </thead>
            <tbody>
                <?php foreach($essayq as $c) { ?>
                    <tr id="<?php echo $c->essay_question_id ?>">
                        <?php 
                            if($c->flag == 0){
                                $status = "Active"; 
                                echo "<script>
                                        $(function(){
                                                  $('input[name=my_checkbox_$c->essay_question_id]').bootstrapSwitch('state', true, true);
                                        });  
                                    </script>";
                            }
                            else{
                                $status = "Inactive"; 
                            }
                        ?>
                        <td>
                            <center>
                                <div id='changeState_<?php echo $c->essay_question_id ?>'><?php echo $status; ?>
                                </div>
                            </center>
                        </td>

                        <td>
                            <center><?php echo $c->essay_question; ?></center>
                        </td>

                        <td>
                            <center>
                                <button id="<?php echo $c->essay_question_id ?>" class="btn btn-success btn-sm edit_eq_button">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    <input type="hidden" id="<?php echo $c->essay_question_id.'edit_essayq'; ?>" value="<?php echo $c->essay_question; ?>">
                                </button>

                                <input id='switch-state' name='my_checkbox_<?php echo $c->essay_question_id ?>' type='checkbox' value='<?php echo $c->essay_question_id; ?>' >
                            </center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col-lg-4" id="add_eq_panel">
    	<div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" id="panel-title">ADD ESSAY QUESTION</h4>
            </div>

            <div class="panel-body">
                <div class="col-lg-12">
                    <form action="<?php echo base_url('utilities/insert_essay_question') ?>" method="POST" class="form-horizontal fade-effect" id="add_eq-form">
    	        		<div class="form-group">
    	        			<h5>*Essay Question:</h5>
                            <span class="indiv-error"><?php echo form_error("add_educ_attainment"); ?></span>
                            <textarea class="form-control" placeholder="Enter Essay Question" name="add_essay_question" maxlength="100"></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-warning pull-left">Clear</button>
                            </div>
                        </div>
	        	  </form>
		  	   </div><!--col-lg-12-->
            </div><!--panel-body-->
		</div><!--panel-->
    </div><!--col-lg-4-->

    <div class="col-lg-4" id="edit_eq_panel">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title" id="panel-title">EDIT ESSAY QUESTION</h4>
            </div>

            <div class="panel-body">
                <div class="col-lg-12">
                    <form action="<?php echo base_url('utilities/update_essay_question') ?>" method="POST" class="form-horizontal fade-effect" id="edit_eq-form">
                        <div class="form-group">
                            <h5>*Essay Question:</h5>
                            <span class="indiv-error"><?php echo form_error("edit_essay_question"); ?></span>
                            <textarea class="form-control" placeholder="Enter Essay Question" name="edit_essay_question"></textarea>
                            <input type="hidden" name="edit_eq"/>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-warning pull-left" onclick="returnAddEssay()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--col-lg-4-->

</div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#essay-question-table").dataTable();
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var ID = $(this).val();
        var value = state ? value = 0 : value = 1;
        var url = "<?php echo base_url()?>utilities/status_essay_question/";
        var dataString = "essay_id=" + ID + "&";
            dataString += "essay_status=" + value;

            state ? $('#changeState_'+ ID).html("Active"): $('#changeState_'+ ID).html("Inactive");

            $.ajax({
                dataType: "JSON",
                url: url + ID,
                type: "POST",
                data: dataString,
                success: function(data) {
                }    
            }); 
    });

</script>