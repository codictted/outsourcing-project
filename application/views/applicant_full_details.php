    <?php
        $middle = is_null($applicant_det->middle_name) || $applicant_det->middle_name == "" ?
                    "" : $applicant_det->middle_name;
        $gender = $applicant_det->gender == 1 ? "Male" : "Female";
        if($applicant_det->civil_status == 1)
            $civil = "Single";
        elseif($applicant_det->civil_status == 2)
            $civil = "Married";
        else
            $civil = "Widow";
        $tel = is_null($applicant_det->tel_num) || $applicant_det->tel_num == "" ?
                "N/A" : $applicant_det->tel_num;

        $birthdate = new DateTime($applicant_det->birthdate);
        $today = new DateTime('today');
        $app_age = $birthdate->diff($today)->y;
    ?>
    <div class="admin-container slide-effect">
        <form>
            <fieldset>
                <legend>Application Form</legend>
                <label><a><?php echo $status; ?></a></label>
            </fieldset>
        </form>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <label class="form-label larger-label"><?php echo $applicant_det->first_name.' '.$applicant_det->last_name; ?>,</label>
                <label class="form-label sub-label"><?php echo $applicant_det->jname; ?></label>
            </div>
        </div>
        <br><br><br>
        <div class="col-lg-12">
            <form class="col-lg-12">
                <fieldset>
                    <br>
                    <div id="application-details">
                        <ul class="breadcrumb">
                            <li><a href="#personal_form">Personal Information</a></li>
                            <li><a href="#family_form">Family Background</a></li>
                            <li><a href="#work_form">Work Experience</a></li>
                            <li><a href="#personality_form">Personality Test</a></li>
                            <li><a href="#essay_form">Essay Questions</a></li>
                        </ul><hr>
                    <div id="personal_form">
                        <div class="form-group">
                            <h4><center>Personal Information</center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td colspan="2"><b>Full Name:</b></td>
                                    <td><i><?php echo $applicant_det->first_name.' '.$middle.' '.$applicant_det->last_name; ?></i></td>
                                    <td colspan="2"><b>Gender:</b></td>
                                    <td><i><?php echo $gender; ?></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Adress:</b></td>
                                    <td><i><?php echo $applicant_det->street_address.' '.$applicant_det->city.', '.$applicant_det->province.' '.$applicant_det->zip; ?></i></td>
                                    <td colspan="2"><b>Civil Status:</b></td>
                                    <td><i><?php echo $civil; ?></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Birthdate:</b></td>
                                    <td><i><?php echo $applicant_det->birthdate; ?> (<?php echo $app_age; ?>y/o)</i></td>
                                    <td colspan="2"><b>Nationality:</b></td>
                                    <td><i>Filipino</i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Birthplace:</b></td>
                                    <td><i><?php echo $applicant_det->birth_address.' '.$applicant_det->birth_city.', '.$applicant_det->birth_province.' '.$applicant_det->birth_zip; ?></i></td>
                                    <td colspan="2"><b>Religion:</b></td>
                                    <td><i>Roman Catholic</i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Highest Educational Attainment:</b></td>
                                    <td><i>College, <?php echo $applicant_det->school; ?></i></td>
                                    <td colspan="2"><b>Spoken Languages:</b></td>
                                    <td><i>English, Filipino</i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Mobile Number:</b></td>
                                    <td><i><?php echo $applicant_det->mobile; ?></i></td>
                                    <td colspan="2"><b>Telephone:</b></td>
                                    <td><i><?php echo $tel; ?></i></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="family_form">
                        <div class="form-group">
                            <h4><center>Family Background</center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td><b>Spouse's Name:</b></td>
                                    <td><i><?php echo $applicant_det->spouse; ?></i></td>
                                </tr>
                                <tr>
                                    <td><b>Contact Person:</b></td>
                                    <td><i><?php echo $applicant_det->guardian.', '.$applicant_det->relationship.' ('.$applicant_det->guardian_contact.')'; ?></i></td>
                                </tr>
                                <tr><td><b>-----</b></td></tr>
                                <tr>
                                    <td colspan="2"><b>Descendants:</b></td>
                                    <table class="custom-table col-lg-12">
                                        <tr>
                                            <td>Name</td>
                                            <td>Gender</td>
                                            <td>Birthdate</td>
                                        </tr>
                                        <?php foreach($applicant_family as $af) {
                                            $gen = $af->gender == 1 ? "Male" : "Female";?>
                                        <tr>
                                            <td><?php echo $af->name; ?></td>
                                            <td><?php echo $gen; ?></td>
                                            <td><?php echo $af->bdate; ?> (17y/o)</td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="work_form">
                        <div class="form-group">
                            <h4><center>Work Experience and Training</center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td><b>Employer's Name</b></td>
                                    <td><b>Address</b></td>
                                    <td><b>Position</b></td>
                                    <td><b>Years Employed</b></td>
                                </tr>
                                <?php foreach($applicant_exp as $ae) { 
                                    $ename = is_null($ae->employer) || $ae->employer == "" ?
                                            "N/A" : $ae->employer;
                                    $add = is_null($ae->address) || $ae->address == "" ?
                                            "N/A" : $ae->address;
                                    $pos = is_null($ae->position) || $ae->position == "" ?
                                            "N/A" : $ae->position;?>
                                <tr>
                                    <td><i><?php echo $ename; ?></i></td>
                                    <td><i><?php echo $add; ?></i></td>
                                    <td><i><?php echo $pos; ?></i></td>
                                </tr>
                                <?php } ?>
                                <tr><td><b>-----</b></td></tr>
                                <tr><td><b>Seminar and Training</b></td></tr>
                                <tr>
                                    <td><b>Title</b></td>
                                    <td><b>Organizer</b></td>
                                    <td><b>Address</b></td>
                                    <td><b>Years Employed</b></td>
                                </tr>
                                <?php foreach($applicant_sem as $as) { 
                                    $name = is_null($as->name) || $as->name == "" ?
                                            "N/A" : $as->name;
                                    $org = is_null($as->organizer) || $as->organizer == "" ?
                                            "N/A" : $as->organizer;
                                    $add = is_null($as->address) || $as->address == "" ?
                                            "N/A" : $as->address;?>
                                <tr>
                                    <td><i><?php echo $name; ?></i></td>
                                    <td><i><?php echo $org; ?></i></td>
                                    <td><i><?php echo $add; ?></i></td>
                                </tr>
                                <?php } ?>
                                <tr><td><b>----</b></td></tr>
                                <tr>
                                    <td><b>Skills:</b></td>
                                    <td><i>
                                        <?php foreach($skills as $sk) {
                                        echo $sk->skname .", "; } ?>
                                    </i></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="personality_form">
                        <div class="form-group">
                            <h4><center>Personality Test</center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td></td>
                                    <td><b>Question</b></td>
                                    <td><b>Answer</b></td>
                                </tr>
                                <?php foreach($applicant_personality as $ap) {
                                    if($ap->answer == 0)
                                        $ans = "True";
                                    elseif ($ap->answer == 1)
                                        $ans = "False";
                                    elseif ($ap->answer == 3)
                                        $ans = "Strongly Disagree";
                                    elseif ($ap->answer == 4)
                                        $ans = "Disagree";
                                    elseif ($ap->answer == 5)
                                        $ans ="Unsure";
                                    elseif ($ap->answer == 6)
                                        $ans = "Agree"; 
                                    elseif ($ap->answer == 7)
                                        $ans = "Agree";
                                    else
                                        $ans = "N/A";?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $ap->question; ?></td>
                                    <td><i><?php echo $ans; ?></i></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="essay_form">
                        <div class="form-group">
                            <h4><center>Essay Question</center></h4>
                            <table class="col-lg-12 custom-table">
                                <?php foreach($applicant_essay as $ess) { ?>
                                <tr>
                                    <td><b><?php echo $ess->question; ?></b></td>
                                </tr>
                                <tr>
                                    <td><i><br><?php echo $ess->answer; ?></td>
                                </tr>
                                <tr><td>---</td></tr>
                                <tr><td>---</td></tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>