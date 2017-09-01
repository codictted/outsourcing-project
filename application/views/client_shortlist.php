<div class="client-container fade-effect">
    <form class="form-horizontal">
        <fieldset>
            <legend>Applicant Shortlist</legend>
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable small">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">The data displayed by row is by job order. You will see the list of shortlisted applicants when you click the button.</p>
                </div>
            </div>
        </fieldset>
        <div class="form-group col-lg-12">
            <label class="form-label col-lg-1"></label>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <br><br>
        <hr>
        <div class="col-lg-12">
            <table id="shortlist-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Job Position</th>
                    <th>Date Shortlisted</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($shortlist as $sh) { ?>
                    <tr id="<?php echo $sh->order_id; ?>" onclick="show_det(this.id)">
                    	<td>New</td>
                    	<td><?php echo $sh->jname ;?></td>
                    	<td><?php echo $sh->date_shortlist ;?></td>
                    	<td><button type="button" class="btn btn-default btn-sm table-btn" onclick="window.location.href='<?php echo base_url(); ?>client/shortlist_full/<?php echo $sh->order_id; ?>'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
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

        $("#shortlist-table").dataTable();
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


                $("#job_name").html(data.jname);
                $("#slot").html(slot);
                $("#age").html(age);
                $("#educ").html(educ);
                $("#course").html(course);
                $("#civil").html(civil);
                $("#height").html(height);
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