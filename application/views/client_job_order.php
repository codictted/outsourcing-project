    <div class="client-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Request a new Job Order</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b><p class="alert-p"><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></p>
                    </div>
                </div>
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
                        <select class="form-control" id="skill_set">
                            <option selected disabled>Skill Set</option>
                            <?php foreach($set as $ss) { ?>
                            <option value="<?php echo $ss->id; ?>"><?php echo $ss->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <!-- <input id="skill-ms" class="form-control" placeholder="Choose your skills"> -->
                        <input
                            type="text"
                            multiple
                            class="multipleSelect"
                            data-user-option-allowed="true"
                            data-url="cert.json"
                            data-load-once="false"
                            name="skills[]";/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inquiry" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Description:
                    </label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="5" id="order_job_desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        Details:
                    </label>
                    <div class="col-lg-2">
                        <select class="form-control">
                            <option selected disabled>Education</option>
                            <option>High School</option>
                            <option>College</option>
                        </select>
                        <span class="help-block">Highest Educational Attainment</span>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control">
                            <option selected disabled>Course</option>
                            <option>BSIT</option>
                            <option>No Preference</option>
                        </select>
                        <span class="help-block">Preferred Course</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control">
                        <span class="help-block">y/o (Age Range-From)</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control">
                        <span class="help-block">y/o (Age Range-To)</span>
                    </div>
                    <div class="col-lg-1">
                        <input type="checkbox"><text class="small">&nbsp;<br>No preffered age</text>
                    </div>
                    <div class="col-lg-1">
                        <input type="checkbox"><text class="small">&nbsp;<br>Must be single</text>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-2">
                        <input type="number" class="form-control">
                        <span class="help-block">Number of Openings (Male)</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control">
                        <span class="help-block">Number of Openings (Female)</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control">
                        <span class="help-block">Number of Openings (No Preference)</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control" placeholder="Height">
                        <span class="help-block">in cm</span>
                    </div>
                    <div class="col-lg-2">
                        <input type="number" class="form-control" placeholder="Weight">
                        <span class="help-block">in kg</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Schedule:
                    </label>
                    <div class="col-lg-10" id="hide">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scheduler-modal">
                            <span class="glyphicon glyphicon-time"></span>
                            Add Shifting Schedule
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-10">
                        <table id="sched-table" class="details">
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Benefits:
                    </label>
                    <div class="col-lg-10">
                        <input  id="job-order-benefit-ms" class="form-control" placeholder="Choose or Type Benefits">
                    </div>
                </div>
                <div class="form-group">
                    <label for="order-skills" class="col-lg-2 control-label form-label">
                        Additional Requirement:
                    </label>
                    <div class="col-lg-10">
                        <input  id="job-order-req-ms" class="form-control" placeholder="Choose or Type Additional Requirement">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="button" class="btn btn-primary pull-right" onclick="window.location.href='order_confirm'">Submit</button>
                        <button type="reset" class="btn btn-default pull-right">Cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<!-- pop scheduler modal -->
<div class="modal fade" role="modal" id="scheduler-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Shift Schedule</h4>
            </div>
            <div class="modal-body" id="wschedule">
                <div class="day-schedule-selector">
                    <table class="schedule-table">
                        <thead class="schedule-header"></thead>
                        <tbody class="schedule-rows"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="save_sched()">Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function() {

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

            $(".multipleSelect").fastselect();

        });

        $("#skill_set").change(function() {

             var id = $("#skill_set").val();
             var url = "<?php echo base_url() ?>applicant/get_skill_list/";

            // $.ajax({
            //     dataType: "JSON",
            //     url: url + id,
            //     type: "GET",
            //     success: function(data) {

            //         var list = [];
            //         $.each(data, function(id, name) {
            //             list.push('<option value="' + id.id + '">' + name.name + '</option>');
            //         });
                    //$("#skill-ms").html(list.join('')).prop("disabled", false);

                    $("#skill-ms").prop("disabled", false);

                     $("#skill-ms").magicSuggest({
                        data: url + id,
                        valueField: "id",
                        displayField: "name"

                        // alert(id);
                    });
                     
             alert(id);
                //}
            //});
        });
    });
    CKEDITOR.replace('order_job_desc');
    $("#wschedule").dayScheduleSelector({

    });
    // $("#wschedule").on('selected.artsy.dayScheduleSelector', function(e, selected)) {
    //    selected is an array of time slots selected this time. 
    //   // alert('ksdjfk');
    // }
    var schedule = [{
            "day": "initial",
            "time": [{"one": 0}] 
    }];
    function save_sched() {

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
