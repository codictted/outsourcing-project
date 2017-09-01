<div class="admin-container fade-effect">
    <fieldset>
        <legend>Manage Job Category</legend>
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable small">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">This sets the selection of job categories used in job order form.</p>
            </div>
        </div>

        <?php if($this->session->flashdata('success_notification')): ?>
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissable small">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><i class="glyphicon glyphicon-thumbs-up"></i>New Job Category added!</strong>
                    <p class="alert-p"><?php echo $this->session->flashdata('success_notification'); ?></p>
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
    <hr>
    <!--<div class="col-lg-12">
        <button type="button" class="btn btn-primary col-lg-2 pull-right" onclick="window.location.href='<?php //echo base_url();?>maintenance/add_category_form/'"><span class="glyphicon glyphicon-plus"></span>Add Job Category
        </button><br><br><br>
    </div>-->
    <div class="col-lg-8">
        <table id="category-table" class="custom-table-large table-hover">
            <thead>
                <th><center>Status</center></th>
                <th><center>Category Name</center></th>
                <th><center>Action</center></th>
            </thead>
            <tbody>
                <?php foreach($cat as $c) { ?>
                    <tr id="<?php echo $c->id ?>">
                        <?php 
                            if($c->status == 0){
                                $status = "Active"; 
                                echo "<script>
                                        $(function(){
                                                  $('input[name=my_checkbox_$c->id]').bootstrapSwitch('state', true, true);
                                        });  
                                    </script>";
                            }
                            else{
                                $status = "Inactive"; 
                            }
                        ?>
                        <td>
                            <center>
                                <div id='changeState_<?php echo $c->id ?>'><?php echo $status; ?></div>
                            </center>
                        </td>

                        <td>
                            <center><?php echo $c->name; ?></center>
                        </td>

                        <td>
                            <center>
                                <button id="<?php echo $c->id ?>" class="btn btn-success btn-sm edit_jc_button">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    <input type="hidden" id="<?php echo $c->id.'edit_job_cat'; ?>" value="<?php echo $c->name; ?>">
                                </button>

                                <input id='switch-state' name='my_checkbox_<?php echo $c->id ?>' type='checkbox' value='<?php echo $c->id; ?>' >

                                <button id="<?php echo $c->id ?>" class="btn btn-danger btn-sm delete_jc_button">
                                    <input type="hidden" id="<?php echo $c->id.'delete_job_cat'; ?>" value="<?php echo $c->name; ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col-lg-4" id="add_jc-panel">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" id="add_panel-title">ADD JOB CATEGORY</h4>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <form class="form-horizontal" id="add_jc-form" action="<?php echo base_url("maintenance/add_category_form");?>" method="POST">
                        <div class="form-group">
                            <h5>*Job Category Name:</h5>
                            <div class="error-form">
                                <span class="indiv-error"><?php echo form_error("cat_name"); ?></span>
                                <input type="text" class="form-control" placeholder="Enter Job Category Name" name="add_cat_name">
                            </div>
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

    <div class="col-lg-4" id="edit_jc-panel">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" id="add_panel-title">EDIT JOB CATEGORY</h4>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <form class="form-horizontal" id="edit_jc-form" action="<?php echo base_url("maintenance/edit_category_form");?>" method="POST">
                        <div class="form-group">
                            <h5>*Job Category Name:</h5>
                            <div class="error-form">
                                <span class="indiv-error"><?php echo form_error("cat_name"); ?></span>
                                <input type="text" class="form-control" placeholder="Enter Job Category Name" name="edit_cat_name">
                                <input type="text" name="edit_jc">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-default pull-right">Save</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-warning pull-left" onclick="jc_returnAdd()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div><!--col-lg-12-->
            </div><!--panel-body-->
        </div><!--panel-->
    </div><!--col-lg-4-->

    <div class="col-lg-4" id="delete_jc-panel">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="panel-title" id="delete_panel-title">DELETE JOB CATEGORY</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" id="delete_jc-form" action="<?php echo base_url("maintenance/delete_category_form");?>">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <h5>Are you sure you want to delete?</h5>
                            <input type="text" class="form-control" name="delete_job_category" disabled>
                            <input type="hidden" id="delete_jc">
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-danger pull-right" onclick="deleteJobCat()">Delete</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-warning pull-left" onclick="jc_returnToAdd()">Cancel</button>
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
      $("#category-table").dataTable();
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var ID = $(this).val();
        var value = state ? value = 0 : value = 1;
        var url = "<?php echo base_url()?>maintenance/status_category/";
        var dataString = "cat_id=" + ID + "&";
            dataString += "cat_status=" + value;

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

</script>