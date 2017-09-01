    <div class="client-container fade-effect">
        <form class="form-horizontal" id="job_order_form" method="post" action="<?php echo base_url('client/send_order'); ?>">
            <fieldset>
                <legend>Request a new Job Order</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b><p class="alert-p"><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></p>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Well done!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('success_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="job" class="col-lg-2 control-label form-label"><text class="required">*</text> Job Information:</label>
                    <div class="col-lg-5">
                        <select class="form-control" id="job_cat">
                            <option selected disabled>Job Category</option>
                            <?php foreach($job_cat as $jc) { ?>
                            <option value="<?php echo $jc->id; ?>"><?php echo $jc->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <span class="indiv-error">
                        <?php echo form_error("job_pos")?></span>
                        <select class="form-control" id="job_pos" name="job_pos" disabled>
                            <option selected disabled>Job Position</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Skills:
                    </label>
                    <div class="col-lg-3">
                        <select class="form-control" id="skill_set" name="skills[]">
                            <option selected disabled>Skill Set</option>
                            <?php foreach($set as $ss) { ?>
                            <option value="<?php echo $ss->id; ?>"><?php echo $ss->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <span class="indiv-error">
                        <?php echo form_error("skills"); ?></span>
                        <select class="form-control" multiple id="skill-multi" name="skills[]">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inquiry" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Description:
                    </label>
                    <div class="col-lg-10">
                        <span class="indiv-error">
                        <?php echo form_error("job_desc"); ?></span>
                        <textarea class="form-control" rows="5" id="order_job_desc" name="job_desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        Details:
                    </label>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <select class="form-control" name="education" id="education" required>
                                <option selected disabled>--</option>
                                <?php   
                                    foreach ($edat as $ea) {
                                        echo "<option value="."'$ea->educ_attaintment_id'".">"."$ea->educ_attainment"."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <span class="help-block"><text class="required">*</text>&nbsp;Highest Attainment</span>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control" name="course">
                            <option selected disabled>Course</option>
                            <?php foreach($course as $cour) { ?>
                            <option value="<?php echo $cour->id; ?>"><?php echo $cour->name; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block">Preferred Course</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control" name="min_age">
                        <span class="help-block">y/o (Age Range-From)</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control" name="max_age">
                        <span class="help-block">y/o (Age Range-To)</span>
                    </div>
                    <div class="col-lg-1">
                        <span class="indiv-error">
                        <?php echo form_error("no_age"); ?></span>
                        <input type="checkbox" name="no_age" checked><text class="small">&nbsp;<br>No preffered age</text>
                    </div>
                    <div class="col-lg-1">
                        <input type="checkbox" name="single"><text class="small">&nbsp;<br>Must be single</text>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                        Gender:
                    </label>
                    <div class="col-lg-2">
                        <input type="radio" name="gender_pref" value="2"> All Male<br>
                        <input type="radio" name="gender_pref" value="1"> All Female<br>
                        <input type="radio" name="gender_pref" value="0"> No Preferrence
                    </div>
                    <div class="col-lg-2">
                        <span class="indiv-error">
                        <?php echo form_error("slot");?></span>
                        <input type="number" class="form-control" name="slot">
                        <span class="help-block">Number of Openings</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control" placeholder="Height" name="height">
                        <span class="help-block">in cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-10">
                        <table id="sched-table" class="details">
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Benefits:
                    </label>
                    <div class="col-lg-10">
                        <select class="form-control" id="benefit-multi" multiple name="benefits[]">
                            <?php foreach($benefit as $ben) { ?>
                            <option value="<?php echo $ben->id; ?>"><?php echo $ben->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        Additional Requirement:
                    </label>
                    <div class="col-lg-10">
                        <select class="form-control" id="require-multi" multiple name="requirements[]">
                            <?php foreach($requirement as $req) { ?>
                            <option value="<?php echo $req->id; ?>"><?php echo $req->requirement; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <button type="reset" class="btn btn-default pull-right">Cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">


    $("#benefit-multi").select2({
            placeholder: "Select Benefits"
    });

    $("#require-multi").select2({
            placeholder: "Select Additional Requirements"
    });

     $("#skill-multi").select2({
            placeholder: "Select Skills"
    });

    $(function() {

        $("#skill_set").change(function() {

            var id = $(this).val();
            var url = "<?php echo base_url(); ?>applicant/get_skill_list/";
            $.ajax({

                dataType: "JSON",
                type: "GET",
                url: url + id,
                success: function(data) {

                    var list = [];
                    $.each(data, function(ctr, val) {

                        list.push('<option value="' + val.id + '">' + val.name +'</option>');
                    });

                    $("#skill-multi").html(list.join(''));

                }
            });

        });

        $("#job_cat").change(function() {
        
            var id = $(this).val();
            var url = "<?php echo base_url('applicant/get_job_position_list/'); ?>";

            $.ajax({
                dataType: "JSON",
                type: "GET",
                url: url + id,
                success: function(data) {

                    var list = [];
                    $.each(data, function(ctr, val) {

                        list.push('<option value="'+ val.id +'">'+ val.name +'</option>');
                        //$("#job_pos").append("<option></option>").attr("value", id.id).text(name.name );
                    });
                    $("#job_pos").html(list.join(''));
                }
            });

            $("#job_pos").prop("disabled", false);

        });


        CKEDITOR.replace('order_job_desc');
        $("#wschedule").dayScheduleSelector({

        });
        // $("#wschedule").on('selected.artsy.dayScheduleSelector', function(e, selected)) {
        //    selected is an array of time slots selected this time. 
        //   // alert('ksdjfk');
        // }

    });

    function save_sched() {

        var schedule = [{
                "day": "initial",
                "time": [{"one": 0}] 
        }];

            var selected = $("#wschedule").data('artsy.dayScheduleSelector').serialize({});
            $.each(selected, function(ctr, val) {
                if(val.length > 0) {
                    schedule.push({'day': ctr, 'time': val});
                }
            });

            var table = [];
            $.each(schedule, function(ctr, sched) {
                if(ctr > 0) {
                    var str = "<tr><td>";
                    if(sched.day == 0)
                        var day = "Sunday";
                    else if(sched.day == 1)
                        var day = "Monday";
                    else if(sched.day == 2)
                        var day = "Tuesday";
                    else if(sched.day == 3)
                        var day = "Wednesday";
                    else if(sched.day == 4)
                        var day = "Thursday";
                    else if(sched.day == 5)
                        var day = "Friday";
                    else if(sched.day == 6)
                        var day = "Saturday";

                    str = str + day + '</td><td>';

                    $.each(sched.time, function(i, x) {
                        str = str + x[0] + ' - ' + x[1] + '</td></tr>';
                    });

                    table.push(str);
                }
            });
            $("#sched-table").html(table.join(''));
            $("#scheduler-modal").modal("hide");
        }
</script>
