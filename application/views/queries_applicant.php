<div class="admin-container">
	<?php echo form_open("query/showlist_applicant");?>
        <fieldset>
            <legend>Filter Applicant</legend>
            <div class="form-group col-lg-12">
                <div class="col-lg-3">
                    <select class="form-control" id="status" name="status">
                        <option selected disabled>--Status--</option>
                        <option value="0">New</option>
                        <option value="1">Job Matched</option>
                        <option value="2">For Interview</option>
                        <option value="3">For Interview(Default)</option>
                        <option value="4">Failed Interview</option>
                        <option value="5">Ready to Shortlist</option>
                        <option value="6">Shortlisted (Rejected)</option>
                        <option value="7">Shortlisted (Selected)</option>
                        <option value="8">Job Offered</option>
                        <option value="9">Job Offered (Rejected)</option>
                        <option value="10">Passing of Requirements</option>
                        <option value="11">For Endorsement</option>
                        <option value="12">Deployed</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" id="client" name="client">
                    <option selected disabled>--Client--</option>
                        <?php
                        if(count($client) > 0) {
                                foreach($client as $cl) { 
                                    $name = is_null($cl->comp_name) || $cl->comp_name == "" ? $cl->full_name : $cl->comp_name;?>
                                    <option value="<?php echo $cl->id; ?>"><?php echo $name; ?></option>
                                <?php }} else { ?>
                                <option selected disabled>No pending clients</option>
                            <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" id="job_position" name="job_position">
                        <option selected disabled>--Position--</option>
                        <?php
                        if(count($job_position) > 0) {
                                foreach($job_position as $jp) { 
                                    $name = $jp->name; ?>
                                    <option value="<?php echo $jp->id; ?>"><?php echo $name; ?></option>
                                <?php }} else { ?>
                                <option selected disabled>No pending position</option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-lg-2">
                    <h5>Application Date:</h5>
                </div>
                <div class="col-lg-3">
                    FROM:
                    <input class="form-control" type="date" name="application_date_from" id="application_date_from"/>
                </div>
                <div class="col-lg-3">
                    TO:
                    <input class="form-control" type="date" name="application_date_to" id="application_date_to"/>
                </div>
            </div>

        </fieldset>  
   <?php echo form_close();?>
    <br><hr><br>
    
    <div class="col-lg-12">
         <table id="applicant-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Job Position</th>
                    <th>Age/Gender</th>
                    <th>Nationality/Race</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        foreach ($applicant as $app) { 
                        
                    if ($app->status == 0){
                        $stat = "New";
                    }
                    else if ($app->status == 1){
                        $stat = "Job Matched";
                    }
                     else if ($app->status == 2){
                        $stat = "For Interview";
                    }
                    else if ($app->status == 3){
                        $stat = "Third";
                    }
                    else {
                        $stat = "Secret";
                    }
                        $gen = $app->gender == 1 ? "Male" : "Female"; ?>
                    <tr id="<?php echo $app->id; ?>" onclick="get_app(this.id)">
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $app->first_name.' '.$app->last_name; ?></td>
                        <td><?php echo $app->jname; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td>Filipino/Visayan</td>
                        <td><?php echo $app->application_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" id="<?php echo $app->id; ?>" onclick="window.location.href='<?php echo base_url()?>query/applicant_info/'+this.id"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                    </tbody>
        </table>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    
    $(function() {

        $("#applicant-table").dataTable();

       


       $("[name='status']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_applicant/';
            var dataString = $("[name='status'], [name='client'], [name='job_position'], [name='application_date_from'], [name='application_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString, 
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Job Matched";
                    }
                     else if (element.status == 2){
                        stat_name = "For Interview";
                    }
                    else if (element.status == 3){
                        stat_name = "Third";
                    }
                    else {
                        stat_name = "Secret";
                    }
                    gender = element.gender == 1 ? "Male" : "Female";
                    nationality = "Filipino/Visayan";

                    console.log(stat_name);
                    console.log(element.jname);
                    console.log(element.application_date);
                    $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + element.first_name + " " + element.last_name +
                    "</td><td>" + element.jname + "</td><td>" + gender +  "</td><td>" + nationality + "</td><td>" + element.application_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>query/applicant_info/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                    
                  });  
                }
            });
        });

        $("[name='job_position']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_applicant/';
            var dataString = $("[name='status'], [name='client'], [name='job_position'], [name='application_date_from'], [name='application_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Job Matched";
                    }
                     else if (element.status == 2){
                        stat_name = "For Interview";
                    }
                    else if (element.status == 3){
                        stat_name = "Third";
                    }
                    else {
                        stat_name = "Secret";
                    }
                    
                    gender = element.gender == 1 ? "Male" : "Female";
                    nationality = "Filipino/Visayan";
                    console.log(stat_name);
                    console.log(element.jname);
                    console.log(element.application_date);
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + element.first_name + " " + element.last_name +
                    "</td><td>" + element.jname + "</td><td>" + gender +  "</td><td>" + nationality + "</td><td>" + element.application_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>query/applicant_info/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

         $("[name='application_date_from']").on("keyup", function (e) {
            var url = '<?php echo base_url()?>query/showlist_applicant/';
            var dataString = $("[name='status'], [name='client'], [name='job_position'], [name='application_date_from'], [name='application_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Job Matched";
                    }
                     else if (element.status == 2){
                        stat_name = "For Interview";
                    }
                    else if (element.status == 3){
                        stat_name = "Third";
                    }
                    else {
                        stat_name = "Secret";
                    }
                    
                    gender = element.gender == 1 ? "Male" : "Female";
                    nationality = "Filipino/Visayan";
                    console.log(stat_name);
                    console.log(element.jname);
                    console.log(element.application_date);
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + element.first_name + " " + element.last_name +
                    "</td><td>" + element.jname + "</td><td>" + gender +  "</td><td>" + nationality + "</td><td>" + element.application_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>query/applicant_info/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

       $("[name='application_date_to']").on("keyup", function (e) {
            var url = '<?php echo base_url()?>query/showlist_applicant/';
            var dataString = $("[name='status'], [name='client'], [name='job_position'], [name='application_date_from'], [name='application_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Job Matched";
                    }
                     else if (element.status == 2){
                        stat_name = "For Interview";
                    }
                    else if (element.status == 3){
                        stat_name = "Third";
                    }
                    else {
                        stat_name = "Secret";
                    }
                    
                    gender = element.gender == 1 ? "Male" : "Female";
                    nationality = "Filipino/Visayan";
                    console.log(stat_name);
                    console.log(element.jname);
                    console.log(element.application_date);
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + element.first_name + " " + element.last_name +
                    "</td><td>" + element.jname + "</td><td>" + gender +  "</td><td>" + nationality + "</td><td>" + element.application_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>query/applicant_info/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });


    });


</script>