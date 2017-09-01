    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Manage Required Documents</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">This sets the different required documents based on the standard set by the agency.</p>
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
            <button type="button" class="btn btn-primary col-lg-3 pull-right" onclick="window.location.href='<?php echo base_url();?>maintenance/add_req_document_form/'"><span class="glyphicon glyphicon-plus"></span>Add Required Document
            </button><br><br><br>
        </div>
        <div class="col-lg-12">
            <table id="required-table" class="custom-table-large table-hover">
                <thead>
                    <th><center>Status</center></th>
                    <th><center>Required Document Name</center></th>
                    <th><center>Required</center></th>
                    <th><center>Action</center></th>
                </thead>
                <tbody>
                    <?php foreach($doc as $d) { ?>
                        <tr id="<?php echo $d->id ?>">
                            <?php 
                                if($d->status == 0){
                                    $status = "Active"; 
                                    echo "<script>
                                            $(function(){
                                                $('input[name=my_checkbox_$d->id]').bootstrapSwitch('state', true, true);
                                            });  
                                        </script>";
                                }
                                else{
                                    $status = "Inactive";
                                }

                                $d->is_required ? $required = "No" : $required = "Yes";
                                
                            ?>
                            <td><center><div id='changeState_<?php echo $d->id ?>'><?php echo $status; ?></div>
                            </center></td>
                            <td><center><?php echo $d->requirement; ?></center></td>
                            <td><center><?php echo $required; ?></center></td>
                            <td><center>
                                <button class="btn btn-success btn-sm table-btn" onclick="edit_req(<?php echo $d->id ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                                <input id='switch-state' name='my_checkbox_<?php echo $d->id ?>' type='checkbox' value='<?php echo $d->id ?>' >
                                <button class="btn btn-danger btn-sm table-btn" onclick="delete_req(<?php echo $d->id ?>)"><span class="glyphicon glyphicon-trash"></span></button>
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
      $("#required-table").dataTable();
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
               
        var ID = $(this).val();
        var value = state ? value = 0 : value = 1;
        var url = "<?php echo base_url()?>maintenance/status_req_document/";
        var dataString = "req_id=" + ID + "&";
            dataString += "req_status=" + value;

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

    function edit_req(id) {
        window.location.href="<?php echo base_url();?>maintenance/edit_req_document_form/" + id;
    }   

    function delete_req(id) {
        window.location.href="<?php echo base_url();?>maintenance/delete_req_document_form/" + id;
    }   

</script>