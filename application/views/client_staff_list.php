    <div class="client-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Your Staff List</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification_replace")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Well done!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('success_notification_replace'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification_replace")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_replace'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
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
                    <div class="col-lg-2 pull-right">
                        <button id="repl-btn" type="button" class="btn btn-primary col-lg-12" onclick="change_table()"><span class="glyphicon glyphicon-king small"></span>
                            Replace Staff
                        </button>
                        <button id="cancel-btn" type="button" class="btn btn-primary col-lg-12" onclick="cancel()"><span class="glyphicon glyphicon-remove small"></span>
                            Cancel
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12" id="normal-table">
            <table id="staff-table-client" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Age/Gender</th>
                    <th>Job Position</th>
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
                                $stat = "For Replacement";
                                break;

                            case 2:
                                $stat = "Reshortlist";
                                break;

                            case 3:
                                $stat = "Terminated";
                                break;
                        }
                        $gen = $st->gender == 1 ? "Male" : "Female";
                    ?>
                    <tr id="<?php echo $st->applicant_id; ?>" onclick="get_app(this.id)">
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $st->first_name." ".$st->last_name; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td><?php echo $st->jname; ?></td>
                        <td><?php echo $st->deployment_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-12" id="checkbox_table">
            <form class="form-horizontal" action="<?php echo base_url(); ?>client/submit_replace" method="POST">
            <table id="staff-table-client-check" class="custom-table-large table-hover">
                <thead>
                    <th>Select</th>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Age/Gender</th>
                    <th>Job Position</th>
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
                                break;

                            case 2:
                                $stat = "Reshortlist";
                                break;

                            case 3:
                                $stat = "Terminated";
                                break;
                        }
                        $gen = $st->gender == 1 ? "Male" : "Female";
                    ?>
                    <tr id="<?php echo $st->applicant_id; ?>" onclick="get_app(this.id)">
                        <?php if($st->status == 1 ) {?>
                            <td></td>
                        <?php } else { ?>
                        <td><input type="checkbox" name="staff[]" class="checkb table-btn" id="<?php echo $st->staff_id; ?>" value="<?php echo $st->staff_id; ?>"></td>
                        <?php } ?>
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $st->first_name." ".$st->last_name; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td><?php echo $st->jname; ?></td>
                        <td><?php echo $st->deployment_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br><br>
            <div class="form-group">
                <label class="form-label col-lg-5" >
                    <text class="required">*</text>Please state your reason for replacement:
                </label>
                <div class="col-lg-4">
                    <input type="text" name="reason" class="form-control">
                </div>
                <div class="col-lg-3 pull-right">
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    
    $("#checkbox_table, #cancel-btn, #submit-replace-btn").hide();
    $("#staff-table-client, #staff-table-client-check").dataTable();


    function change_table() {

        $("#normal-table").hide();
        $("#repl-btn").hide();
        $("#checkbox_table").show();
        $("#cancel-btn").show();
        $("#submit-replace-btn").show();
    }

    function cancel() {

        $("#checkbox_table").hide();
        $("#cancel-btn").hide();
        $("#submit-replace-btn").hide();
        $("#normal-table").show();  
        $("#repl-btn").show();
    }

</script>
