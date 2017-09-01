<br><br><br><br>
<div class="container">
    <form class="form-horizontal" id="appliation-form" action="<?php echo base_url() ?>applicant/submit" method="post">
    <fieldset>
        <legend>Applicant Information</legend>
        <small><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></small><br><br>
        <div id="application-tab">
            <ul class="breadcrumb">
                <li><a href="#personal_form">Personal Information</a></li>
                <li><a href="#family_form">Family Background</a></li>
                <li><a href="#work_form">Work Experience</a></li>
                <li><a href="#essay_form">Essay Questions</a></li>
            </ul>
            <?php if($this->session->flashdata("success_notification_application")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Well done!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('success_notification_application'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata("fail_notification_application")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oh snap!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_application'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div id="personal_form">
                <div class="form-group">
                    <label for="job" class="col-lg-2 control-label form-label"><text class="required">*</text> Job Information:</label>
                    <div class="col-lg-5">
                        <select class="form-control" id="job_cat" name="job_cat">
                            <option selected disabled>Job Category</option>
                            <?php foreach($job_cat as $jc) { ?>
                            <option value="<?php echo $jc->id; ?>"><?php echo $jc->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_pos"); ?></span>
                            <select class="form-control" id="job_pos" name="job_pos" disabled>
                                <option selected disabled>Job Position</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text>Full Name:
                    </label>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("fname"); ?></span>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name (optional)">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("lname"); ?></span>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("ext"); ?></span>
                            <input type="text" name="ext" id="ext" class="form-control" placeholder="Ext">
                        </div>
                        <span class="help-block">Ex: Jr/III</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-2">
                    <div id="magicsuggest">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("civil"); ?></span>
                            <select class="form-control" name="civil" id="civil" required>
                                <option selected disabled>* Civil Status</option>
                                <option value="1">Single</option>
                                <option value="2">Married</option>
                                <option value="3">Widow</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <input type="number" name="height" id="height" class="form-control" placeholder="Height">
                        </div>
                        <span class="small col-lg-1">in&nbsp;cm&nbsp;(optional)</span>
                    </div>
                    <div class="col-lg-2">
                        <span class="medium"><text class="required">*</text> Gender:</span><br>
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("gender"); ?></span>
                            <input type="radio" name="gender" value="1" required><text class="small"> Male</text>
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value="2"><text class="small"> Female</text>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact:
                    </label>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("cnum"); ?></span>
                            <input type="text" name="cnum" id="cnum" class="form-control" placeholder="Mobile Number" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("tnum"); ?></span>
                            <input type="text" name="tnum" id="tnum" class="form-control" placeholder="Tel Number (Optional)">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Address:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("street"); ?></span>
                            <input type="text" name="street" id="street" class="form-control" placeholder="Street Address/Bldg. No./Village/Brgy." required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("city"); ?></span>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City/Municipality" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("province"); ?></span>
                            <input type="text" name="province" id="province" class="form-control" placeholder="Province" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                    </label>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("fname"); ?></span>
                            <input type="date" name="bdate" id="bdate" class="form-control" required>
                        </div>
                        <span class="small col-lg-1"><text class="required">*</text>&nbsp;Birthdate</span>
                    </div>
                     <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("religion"); ?></span>

                            <select class="form-control" multiple name="religion" id="religion" required>
                                <?php foreach($religion as $r) { ?>
                                <option value="<?php echo $r->name; ?>"><?php echo $r->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                        <text></text>Birthplace:<br>
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("birthplace"); ?></span>
                            <input type="text" name="birthplace" id="birthplace" class="form-control" placeholder="Birthplace">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="education" class="col-lg-2 control-label form-label">
                        <text class="required">*</text>
                        Education:
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
                        <div class="error-form">
                            <select class="form-control" name="level" id="level" required>
                                <option selected disabled>--</option>
                                <option value="1">Graduate</option>
                                <option value="2">Undergraduate</option>
                            </select>
                        </div>
                        <span class="help-block"><text class="required">*</text>&nbsp;Year Level</span>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("school"); ?></span>
                            <select class="form-control" name="course" id="course" multiple disabled>
                                <?php foreach($course as $c){ ?>
                                <option value="<?php echo $c->name; ?>"><?php echo $c->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <input type="text" name="school" id="school" class="form-control" placeholder="School">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button" id="appform_view_familybg" onclick="viewFamilyBackground()"><span class="glyphicon glyphicon-arrow-right"></button>
                    </div>
                </div>
            </div>
            <div id="family_form">
                <div class="form-group">
                    <label for="spouse" class="col-lg-2 control-label form-label">Spouse:</label>
                    <div class="col-lg-6">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("spouse_name"); ?></span>
                            <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="Spouse's Name">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <input type="date" class="form-control" name="spouse_bdate" id="spouse_bdate">
                        </div>
                        <span class="help-block">Spouse's birthdate</span>
                    </div>
                </div>
                <div id="descendants">
                     <div class="form-group" id="div-descendants">
                        <label for="descendants" class="col-lg-2 control-label form-label">
                            Child:
                        </label>
                        <div class="col-lg-4">
                            <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("d_name"); ?></span>
                                <input type="text" name="d_name[]" class="form-control" placeholder="Child's Name">
                            </div>
                        </div>
                        <!-- <div class="col-lg-2">
                            <div class="error-form">
                                <select class="form-control" name="d_gender[]">
                                    <option selected disabled>Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-lg-2">
                            <div class="error-form">
                                <input type="date" name="d_date[]" class="form-control">
                            </div>
                            <span class="help-block">Child's birthdate</span>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary" type="button" id="add_descendant"><span class="glyphicon glyphicon-plus"></span></button>
                            <span class="help-block" id="des_help">Add a child</span>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="emergency_contact" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Emergency Contact Person:
                    </label>
                    <div class="col-lg-6">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("guardian"); ?></span>
                            <input type="text" name="guardian" id="guardian" class="form-control" placeholder="Emergency Contact Person">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("g_relation"); ?></span>
                            <input type="text" class="form-control" name="g_relation" id="g_relation" placeholder="Relationship">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("g_contact"); ?></span>
                            <input type="text" class="form-control" name="g_contact" id="g_contact" placeholder="Contact Number">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-default" type="button" id="appform_view_familybg" onclick="viewPersonal()"><span class="glyphicon glyphicon-arrow-left"></button>
                        <button class="btn btn-primary" type="button" id="appform_view_familybg" onclick="viewWork()"><span class="glyphicon glyphicon-arrow-right"></button>
                    </div>
                </div>
            </div>
            <div id="work_form">
                <div id="employers">
                    <div id="div-employer">
                        <div class="form-group">
                            <label for="employer" class="col-lg-2 control-label form-label">Employer's Name:</label>
                            <div class="col-lg-5">
                                <span class="indiv-error"><?php echo form_error("employer"); ?></span>
                                <input type="text" class="form-control" name="employer[]" id="employer" placeholder="Employer's Full Name">
                            </div>
                            <div class="col-lg-3">
                                <span class="indiv-error"><?php echo form_error("exp_pos"); ?></span>
                                <input type="text" class="form-control" name="exp_pos[]" id="exp_pos" placeholder="Position">
                            </div>
                            <div class="col-lg-1">
                                <input type="number" name="year_exp[]" class="form-control">
                                <span class="help-block">Years employed</span>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary" type="button" id="add_emp"><span class="glyphicon glyphicon-plus"></span></button>
                                <span class="help-block" id="emp_help">Add an employer</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="employer_address" class="col-lg-2 control-label form-label">
                                Employer's Address:
                            </label>
                            <div class="col-lg-9">
                                <span class="indiv-error"><?php echo form_error("emp_address"); ?></span>
                                <input type="text" name="emp_address[]" id="emp_address" class="form-control" placeholder="Employer's Full Address">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="seminars">
                    <div id="div-seminar">
                        <div class="form-group">
                            <label class="col-lg-2 control-label form-label">
                                Seminar/Training:
                            </label>
                            <div class="col-lg-3">
                                <input type="text" name="training_title[]" id="training_title" class="form-control" placeholder="Title">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="training_org[]" id="training_org" class="form-control" placeholder="Organizer">
                            </div>
                            <div class="col-lg-2">
                                <input type="date" class="form-control" name="start_training_date[]">
                                <span class="help-block">From</span>
                            </div>
                            <div class="col-lg-2">
                                <input type="date" class="form-control" name="end_training_date[]">
                                <span class="help-block">To</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Training/Seminar's Full Address" name="training_address[]" id="training_address">
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary" type="button" id="add_sem"><span class="glyphicon glyphicon-plus"></span></button>
                                <span class="help-block" id="sem_help">Add Training</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Skills:
                    </label>
                    <div class="col-lg-5">
                        <select class="form-control" id="skill_set">
                            <option selected disabled>Skill Set</option>
                            <?php foreach($set as $ss) { ?>
                            <option value="<?php echo $ss->id; ?>"><?php echo $ss->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <select class="form-control" id="skill-multi" multiple name="skills[]">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-default" type="button" id="appform_view_familybg" onclick="viewFamilyBackground()"><span class="glyphicon glyphicon-arrow-left"></button>
                        <button class="btn btn-primary" type="button" id="appform_view_familybg" onclick="viewEssay()"><span class="glyphicon glyphicon-arrow-right"></button>
                    </div>
                </div>
            </div>
            <div id="essay_form">
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                    </label>
                    <div class="col-lg-10">
                        <b>You will be asked some questions regarding yourself. Please type your answer in the space provided.</b><br>
                    </div>
                </div>
                <?php
                    foreach ($essayq as $eq) {
                        echo    "<div class='form-group'>
                                    <label class='col-lg-2 control-label'></label>
                                    <div class='col-lg-10'>
                                        <text class='questions'>"."$eq->essay_question"."</text>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='col-lg-2 control-label'></label>
                                    <div class='col-lg-10'>
                                        <span class='indiv-error'><?php echo form_error('essay_answer_"."$eq->essay_question_id"."'); ?></span>
                                        <textarea class='form-control' rows='4' name='essay_answer[]' id='essay_answer_"."$eq->essay_question_id"."' required></textarea>
                                        <input type='hidden' name='essay_id[]' value='$eq->essay_question_id'>
                                    </div>
                                </div>";
                    }
                ?>
                <div class="form-group">
                    <div class="pull-right col-lg-10">
                        <span class="help-block">
                            <br>
                            <i><strong>IMPORTANT: </strong>Please double check your application before submitting. Make sure all the data you entered are correct and all the required fields have been filled out. Some data you have already entered may be lost if you submitted your form and errors were found.</i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-default" type="button" id="appform_view_familybg" onclick="viewWork()"><span class="glyphicon glyphicon-arrow-left"></button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    </form>
</div>
</body>
</html>


<script type="text/javascript">

// $("#spoken-multip").select2({
//     placeholder: "Spoken Languages"
// });

$("#skill-multi").select2({
    placeholder: "Select Skills"
});


$("[name='course']").select2({
        maximumSelectionLength: 1,
        tags: true,
        placeholder: '    Select course',
        allowClear: true,
        createTag: function (params) {
            var term = $.trim(params.term);
           
            if (term.match(/^[!@#$%^&*()]+$/g)) {
              return null;
            }
        
            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
        }
});


$("[name='religion']").select2({
        maximumSelectionLength: 1,
        tags: true,
        placeholder: '    Select religion',
        allowClear: true,
        createTag: function (params) {
            var term = $.trim(params.term);
           
            if (term.match(/^[!@#$%^&*()]+$/g)) {
              return null;
            }
        
            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
        }
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

    $("#education").change(function() {

        var value = $(this).val();
        if(value == 1) {
            var add = [];
            var level = ["Lower than Grade 1", "Grade 1", "Grade 2", "Grade 3", 
            "Grade 4", "Grade 5", "Grade 6", "Graduate"];
            $("#course").prop("disabled", true);
        }
        else if(value == 2) {
            var add = [];
            var level = ["First Year", "Second Year", "Third Year", "Fourth Year", 
            "Graduate"];
            $("#course").prop("disabled", true);
        }
        else if(value == 3 || value == 4) {
            var add = [];
            var level = ["First Year", "Second Year", "Third Year", "Fourth Year", 
            "Graduate"];
            $("#course").prop("disabled", false);
        }
        for(i = 0; i < level.length; i++)
            add.push("<option value='"+i+"'>"+level[i]+"</option>");
        $("#level").html(add.join(''));
        $("#level").prop("disabled", false);

    });

    $("#skill_set").change(function() {

        var id = $("#skill_set").val();
        var url = "<?php echo base_url() ?>applicant/get_skill_list/";

        $.ajax({
            dataType: "JSON",
            url: url + id,
            type: "GET",
            success: function(data) {

                var list = [];
                $.each(data, function(id, name) {
                    list.push('<option value="' + id.id + '">' + name.name + '</option>');
                });
                $("#skill-ms").html(list.join('')).prop("disabled", false);
            }
        });
    });
});
</script>