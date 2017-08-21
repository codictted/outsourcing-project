    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Manage Job Position</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">Creation of Job might not be the same but the same responsibilities.</p>
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
            <button type="button" class="btn btn-primary col-lg-2 pull-right" onclick="window.location.href='<?php echo base_url();?>maintenance/add_job_position_form/'"><span class="glyphicon glyphicon-plus"></span>Add Job Position
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
                        <tr id="<?php echo $j->id ?>" onclick="view_jl(this.id)">
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
                                <button class="btn btn-success btn-sm table-btn" onclick="edit_jp(<?php echo $j->id ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                                <input id='switch-state' name='my_checkbox_<?php echo $j->id ?>' type='checkbox' value='<?php echo $j->id ?>' >
                                <button class="btn btn-danger btn-sm table-btn" onclick="delete_jp(<?php echo $j->id ?>)"><span class="glyphicon glyphicon-trash"></span></button>
                            </center></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

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

</script>