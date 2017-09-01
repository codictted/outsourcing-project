    <div class="client-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Track your Short Listed Applicants</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">Track your applicant's status after you have selected them in short list.</p>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <table id="orders-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Job Position</th>
                    <th>Shortlisted Date</th>
                    <th>Expected Deployment Date</th>
                </thead>
                <tbody>
                    <?php foreach($app_list as $app) {

                        switch ($app->ap_stat) {
                            case 8:
                                $status = "Selected";
                                break;
                            
                            case 9:
                                $status = "Job Offered";
                                break;

                            case 10:
                                $status = "Job Offer Rejected";
                                break;

                            case 11:
                                $status = "Passing of Requirements";
                                break;

                            case 12:
                                $status = "For Endorsement";
                                break;
                        }
                    ?>
                    <tr id="<?php echo $app->apid ?>" onclick="show_det(this.id)">
                        <td><?php echo $status; ?></td>
                        <td><?php echo $app->first_name." ".$app->last_name; ?></td>
                        <td><?php echo $app->jname; ?></td>
                        <td><?php echo $app->date_shortlist; ?></td>
                        <td><?php echo $app->deployment_date; ?></td>
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

                var slot = data.total_openings == null || data.total_openings == "" ? 
                    "" : data.total_openings;
                var male = data.num_male == null || data.num_male == "" ?
                    "" : " ("+ data.num_male + " Male, ";
                var female = data.num_female == null || data.num_female == "" ?
                    "" : data.num_female + " Female)";

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
                var weight = data.weight == null ? "No Preferrence" : data.weight;
                var urgent = data.urgent == 0 ? "Yes" : "No";


                $("#job_name").html(data.jname);
                $("#slot").html(slot + male + female);
                $("#age").html(age);
                $("#educ").html(educ);
                $("#course").html(course);
                $("#civil").html(civil);
                $("#height").html(height);
                $("#weight").html(weight);
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
