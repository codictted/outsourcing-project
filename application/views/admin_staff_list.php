    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Staff</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label class="form-label col-lg-1">Filter:</label>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
                    </div>
                    <div class="col-lg-3 pull-right">                    
                        <button type="button" class="btn btn-primary col-lg-12" onclick="window.location.href='create_shortlist'"><span class="glyphicon glyphicon-plus"></span>
                            Create a Short List
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
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
                        <td><button type="button" class="btn btn-default btn-sm modal-btn-staff" id="<?php echo $st->staff_id."-".$url; ?>"><span class="glyphicon glyphicon-list"></span></button></td>
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
                <form action="<?php echo base_url('admin/save_applicant_require'); ?>" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="form-label">Client: </label>
                        <text class="form-label" id="client_name"></text>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Position: </label>
                        <text class="form-label" id="job_position"></text>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Request: </label>
                        <label class="form-label" id="date_req"></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Reason: </label>
                        <label class="form-label" id="reason"></label>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Approve</button>
            </div>
            </form>
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
</script>