    <div class="client-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Your Job Order List</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">View your list of job orders and track their status.</p>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label class="form-label col-lg-1"></label>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-3">
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
            <table id="orders-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Job Position</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($order as $jo) {
                        
                        switch ($jo->status) {
                            case 0:
                                $stat = "New";
                                break;
                            
                            case 1:
                                $stat = "Ongoing";
                                break;

                            case 2:
                                $stat = "Completed";
                                break;

                            case 3:
                                $stat = "Terminated";
                                break;

                            case 4:
                                $stat = "Rejected";
                                break;
                        }
                    ?>
                    <tr id="<?php echo $jo->order_id; ?>" onclick="show_det(this.id)">
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $jo->jname; ?></td>
                        <td><?php echo $jo->order_date; ?></td>
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
    
    $(function() {

        $("#orders-table").dataTable();
    });

    function show_det(id) {

        var url = "<?php echo base_url()?>client/job_order_details/";
        $.ajax({
            dataType: "JSON",
            url: url + id,
            type: "GET",
            success: function(data) {

                var slot = data.total_openings;

                if((data.min_age == null || data.min_age == "") && (data.max_age == null || data.max_age == ""))
                    var age = "No Age Preferrence";
                else if(!(data.min_age == null || data.min_age == "") && (data.max_age == null || data.max_age == ""))
                    var age = "Atleast " + data.min_age + " years old";
                else if((data.min_age == null || data.min_age == "") && !(data.max_age == null || data.max_age == ""))
                    var age = "Up to " + data.max_age + " years old";
                else
                    var age = "From " + data.min_age + " to " + data.max_age + " years old";

                var educ = (data.education == null || data.education == "") ?
                            "No Preferrence" : data.educ_name;

                var course = (data.course == null || data.course == "") ?
                            "No Preferrence" : data.course_name;
                var civil = data.single == 1 ? "Must be single" : "No Preferrence";
                var height = data.height == null ? "No Preferrence" : data.height;
                var urgent = data.urgent == 0 ? "Yes" : "No";


                $("#job_name").html(data.jname);
                $("#slot").html(slot);
                $("#age").html(age);
                $("#educ").html(educ);
                $("#course").html(course);
                $("#civil").html(civil);
                $("#height").html(height);
                $("#urgent").html(urgent);
                $("#desc").html(data.description);

            }
        });

        url = "<?php echo base_url()?>client/job_order_skills/";
        $.ajax({
            dataType: "JSON",
            url: url + id,
            type: "GET",
            success: function(data) {

                var temp = "";
                $.each(data, function(ctr, val){

                    ctr == 0 ?
                        temp = val.sk:
                        temp = temp + ", " + val.sk;
                });

                $("#skill").html(temp);
            }

        });

        url = "<?php echo base_url()?>client/job_order_benefits/";
        $.ajax({
            dataType: "JSON",
            url: url + id,
            type: "GET",
            success: function(data) {

                var temp = "N/A";

                if(data.length > 0) {

                    $.each(data, function(ctr, val){

                        ctr == 0 ?
                            temp = val.ben:
                            temp = temp + ", " + val.ben;
                    });
                }

                $("#benefit").html(temp);
            }

        });

        url = "<?php echo base_url()?>client/job_order_req/";
        $.ajax({
            dataType: "JSON",
            url: url + id,
            type: "GET",
            success: function(data) {

                var temp = "N/A";

                if(data.length > 0) {

                    $.each(data, function(ctr, val){

                        ctr == 0 ?
                            temp = val.req:
                            temp = temp + ", " + val.req;
                    });
                }

                $("#req").html(temp);


                $("#order_details").modal("show");
            }

        });

    }
</script>
