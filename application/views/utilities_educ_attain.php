<div class="admin-container fade-effect">

    <form class="form-horizontal">

        <fieldset>
            <legend>Educational Attainment</legend>

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
        <table id="educ-attain-table" class="custom-table-large table-hover">
            <thead>
                <th><center>Status</center></th>
                <th><center>Educational Attainment</center></th>
                <th><center>Action</center></th>
            </thead>
            <tbody>
                <?php foreach($edat as $c) { ?>
                    <tr id="<?php echo $c->educ_attainment_id ?>">
                        <?php 
                            if($c->flag == 0){
                                $status = "Active"; 
                                echo "<script>
                                        $(function(){
                                                  $('input[name=my_checkbox_$c->educ_attainment_id]').bootstrapSwitch('state', true, true);
                                        });  
                                    </script>";
                            }
                            else{
                                $status = "Inactive"; 
                            }
                        ?>
                        <td>
                            <center>
                                <div id='changeState_<?php echo $c->educ_attainment_id ?>'><?php echo $status; ?>
                                </div>
                            </center>
                        </td>

                        <td>
                            <center><?php echo $c->educ_attainment; ?></center>
                        </td>

                        <td>
                            <center>
                                <button id="<?php echo $c->educ_attainment_id ?>" class="btn btn-success btn-sm edit_ea_button">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    <input type="hidden" id="<?php echo $c->educ_attainment_id.'edit_educ_attain'; ?>" value="<?php echo $c->educ_attainment; ?>">
                                </button>

                                <input id='switch-state' name='my_checkbox_<?php echo $c->educ_attainment_id ?>' type='checkbox' value='<?php echo $c->educ_attainment_id; ?>' >

                                <button id="<?php echo $c->educ_attainment_id ?>" class="btn btn-danger btn-sm delete_ea_button">
                                    <input type="hidden" id="<?php echo $c->educ_attainment_id.'delete_educ_attain'; ?>" value="<?php echo $c->educ_attainment; ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col-lg-4" id="add_ea_panel">
    	<div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" id="panel-title">ADD EDUCATIONAL ATTAINMENT</h4>
            </div>

            <div class="panel-body">
                <div class="col-lg-12">
                    <form action="<?php echo base_url('utilities/insert_educ_attain') ?>" method="POST" class="form-horizontal fade-effect" id="add_ea-form">
    	        		<div class="form-group">
    	        			<h5>*Educational Attainment:</h5>
                            <span class="indiv-error"><?php echo form_error("add_educ_attainment"); ?></span>
                            <input type="text" class="form-control" placeholder="Enter Educational Attainment" name="add_educ_attainment">
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-default pull-right">Add</button>
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

    <div class="col-lg-4" id="edit_ea_panel">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" id="panel-title">EDIT EDUCATIONAL ATTAINMENT</h4>
            </div>

            <div class="panel-body">
                <div class="col-lg-12">
                    <form action="<?php echo base_url('utilities/update_educ_attain') ?>" method="POST" class="form-horizontal fade-effect" id="edit_ea-form">
                        <div class="form-group">
                            <h5>*Educational Attainment:</h5>
                            <span class="indiv-error"><?php echo form_error("edit_educ_attainment"); ?></span>
                            <input type="text" class="form-control" placeholder="Enter Educational Attainment" name="edit_educ_attainment">
                            <input type="hidden" name="edit_ea"/>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-default pull-right">Save</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-warning pull-left" onclick="returnAdd()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--col-lg-4-->

    <div class="col-lg-4" id="delete_ea_panel">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="panel-title" id="panel-title">DELETE EDUCATIONAL ATTAINMENT</h4>
            </div>
            <div class="panel-body">
                <form method="post" id="delete_ea-form">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h5>Are you sure you want to delete?</h5>
                            <input type="text" class="form-control" name="delete_educ_attainment" disabled>
                            <input type="hidden" id="delete_ea">
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-danger pull-right" onclick="deleteEducAttain()">Delete</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-warning pull-left" onclick="returnToAdd()">Cancel</button>
                            </div>
                        </div>
                    </div><!--col-lg-12-->
                </form>
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--col-lg-4-->

</div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#educ-attain-table").dataTable();
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var ID = $(this).val();
        var value = state ? value = 0 : value = 1;
        var url = "<?php echo base_url()?>utilities/status_educ_attain/";
        var dataString = "educ_id=" + ID + "&";
            dataString += "educ_status=" + value;

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