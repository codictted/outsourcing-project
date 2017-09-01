<div class="admin-container fade-effect">
    <fieldset>
        <legend>Manage Job Category</legend>
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
                    <strong><i class="glyphicon glyphicon-thumbs-up"></i>Well done!!</strong>
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
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary col-lg-2 pull-right" onclick="window.location.href='<?php echo base_url();?>maintenance/add_category_form/'"><span class="glyphicon glyphicon-plus"></span>Add Job Category
        </button><br><br><br>
    </div>
    <div class="col-lg-12">
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
                                <button class="btn btn-success btn-sm" onclick="edit_cat('<?php echo $c->id ?>')"><span class="glyphicon glyphicon-edit"></span></button>
                                <input id='switch-state' name='my_checkbox_<?php echo $c->id ?>' type='checkbox' value='<?php echo $c->id; ?>' >
                                <button class="btn btn-danger btn-sm" onclick="delete_cat('<?php echo $c->id ?>')"><span class="glyphicon glyphicon-trash"></span></button>
                            </center>
                        </td>
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

    function edit_cat(id) {
        window.location.href="<?php echo base_url();?>maintenance/edit_category_form/" + id;
    }   

    function delete_cat(id) {
        window.location.href="<?php echo base_url();?>maintenance/delete_category_form/" + id;
    }   

</script>