    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Staff</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.<br>You can view the staff's full application details by clicking the staff's row.</p>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
         <?php if($this->session->flashdata("success_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Well Done!</b> <p class="alert-p"><?php echo $this->session->flashdata("success_notification"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
        <div class="col-lg-12">
            <table id="staff-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Age/Gender</th>
                    <th>Job Position</th>
                    <th>Client</th>
                    <th>Deployment Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($staff as $st) {

                        switch ($st->status) {
                            case 0:
                                $stat = "Active";
                                break;
                            
                            case 1:
                                $stat = "Request for Replacement";
                                $url = "replacement_modal";
                                break;

                            case 2:
                                $stat = "Reshortlist";
                                break;

                            case 3:
                                $stat = "Terminated";
                                break;
                        }
                        $gen = $st->gender == 1 ? "Male" : "Female";
                        $client = is_null($st->comp_name) ? $st->full_name : $st->comp_name;

                    ?>

                    <tr id="<?php echo $st->applicant_id; ?>" onclick="get_app(this.id)">
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $st->first_name." ".$st->last_name; ?></td>
                        <td><?php echo $st->jname; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td><?php echo $client; ?></td>
                        <td><?php echo $st->deployment_date; ?></td>
                        <td><button type="button" class="btn btn-default btn-sm modal-btn-staff" id="<?php echo $st->staff_id."/".$url."/".$client."/".$st->jname."/".$st->date_request."/".$st->reason; ?>"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="replacement_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Replacement Details</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label class="form-label">Client: </label>
                        <text class="form-label" name="client-name"></text>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Position: </label>
                        <text class="form-label" name="job_position"></text>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Request: </label>
                        <label class="form-label" name="date_request"></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Reason: </label>
                        <label class="form-label" name="reason"></label>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" id="<?php echo $st->staff_id;?>" onclick="decline(this.id)">Decline</button>
                <button class="btn btn-primary" id="<?php echo $st->staff_id;?>" onclick="approve(this.id)">Approve</button>
            </div>
          
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(function() {

        //initialize datatable
        $("#staff-table").dataTable();
        
    });
    function get_app(id) {
        window.location.href="<?php echo base_url();?>admin/applicant_full_details/" + id;
    }

    function approve(id) {
        window.location.href="<?php echo base_url();?>admin/approve_staff_replacement/" + id;
    }

    function decline(id) {
        window.location.href="<?php echo base_url();?>admin/decline_staff_replacement/" + id;
    }


  

</script>