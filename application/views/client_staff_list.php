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
                        <button type="button" class="btn btn-primary col-lg-12" onclick="window.location.href='<?php echo base_url(); ?>client/client_job_order/'"><span class="glyphicon glyphicon-plus"></span>
                            Create a New Job Order
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
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
                                $stat = "fasdf";
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
    </div>
</body>
</html>
<div class="modal" role="dialog" id="order_details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">DETAILS:</h4>
            </div>
            <div class="modal-body">
                <label class="sub-label" id="job_name"></label><br>
                <text class="pull-right">(0) Hired Staff</text><hr>
                <table class="details">
                    <tr>
                        <td><b>Total Slot: </b></td>
                        <td id="slot"></td>
                    </tr>
                    <tr>
                        <td><b>Age: </b></td>
                        <td id="age"></td>
                    </tr>
                    <tr>
                        <td><b>Education: </b></td>
                        <td id="educ"></td>
                    </tr>
                    <tr>
                        <td><b>Course: </b></td>
                        <td id="course"></td>
                    </tr>
                    <tr>
                        <td><b>Civil Status: </b></td>
                        <td id="civil"></td>
                    </tr>
                    <tr>
                        <td><b>Height: </b></td>
                        <td id="height"></td>
                    </tr>
                    <tr>
                        <td><b>Weight: </b></td>
                        <td id="weight"></td>
                    </tr>
                    <tr>
                        <td><b>Urgent: </b></td>
                        <td id="urgent"></td>
                    </tr>
                    <tr>
                        <td><b>Skills: </b></td>
                        <td id="skill"></td>
                    </tr>
                    <tr>
                        <td><b>Benefits: </b></td>
                        <td id="benefit"></td>
                    </tr>
                    <tr>
                        <td><b>Additional Requirement: </b></td>
                        <td id="req"></td>
                    </tr>
                    <tr>
                        <td><b>Description: </b></td>
                        <td id="desc"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#staff-table-client").dataTable();

    function get_app(id) {
        window.location.href="<?php echo base_url();?>client/applicant_full_details/" + id;
    }
    
</script>
