    <div class="admin-container slide-effect">
        <form>
            <fieldset>
                <legend>Job Order Details</legend>
            </fieldset>
        </form>
        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable">
                    <i class="glyphicon glyphicon-info-sign"></i><b>INFORMATION:</b>
                    <table class="table custom-table">
                        <tr>
                            <td><b>Status:</b></td>
                            <td><i>New</i></td>
                        </tr>
                        <tr>
                            <td><b>Job Advertisement Status:</b></td>
                            <td><i>Not Posted</i></td>
                        </tr>
                        <tr>
                            <td><b>Position:</b></td>
                            <td><i><?php echo $order_details->jname; ?></i></td>
                        </tr>                      
                        <tr>
                            <td><b>Client:</b></td>
                            <td><i><?php echo $processed_data['name']; ?></i></td>
                        </tr>
                        <tr>
                            <td><b>Quantity:</b></td>
                            <td><i><?php echo $processed_data['total']; ?></i></td>
                        </tr>
                            <td><b>Date Ordered:</b></td>
                            <td><i><?php echo $order_details->order_date; ?></i></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <form class="col-lg-12">
                <fieldset>
                    <legend>Job Description</legend>
                </fieldset>
            </form>
            <div class="col-lg-12">
                <table class="details">
                    <tr>
                        <td><b>Benefits: </b></td>
                        <td><?php echo $processed_data['benefits']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Additional Requirement: </b></td>
                        <td><?php echo $processed_data['requirements']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Schedule: </b></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr><tr><td><hr></td><td></td></tr>
                    <tr>
                        <td><b>Skills: </b></td>
                        <td><?php echo $processed_data['skills']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Qualifications </b>
                            <table class="details">
                                <tr>
                                    <td>Age:</td>
                                    <td><?php echo $processed_data['age']; ?></td>
                                </tr>
                                <tr>
                                    <td>Height:</td>
                                    <td><?php echo $processed_data['height']; ?></td>
                                </tr>
                                <tr>
                                    <td>Must be Single:</td>
                                    <td><?php echo $processed_data['single']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td><?php echo $processed_data['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Education:</td>
                                    <td><?php echo $processed_data['education']; ?></td>
                                </tr>
                                <tr>
                                    <td>Course:</td>
                                    <td><?php echo $processed_data['course']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12 jdesc">
                <label class="sub-label">Description: </label><br>
                <div class="jcontent">
                    <?php echo $order_details->description; ?>
                </div>
            </div>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#edit_ad">Post Job</button>
                    <button type="reset" class="btn btn-default pull-right">Reject</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="edit_ad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Job Advertisement</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('admin/post_ad'); ?>" method="post" id="job_capt">
                <div class="modal-body">
                    <label class="sub-label"><b><?php echo $order_details->jname; ?></b></label><br><br>
                    <table class="details">
                        <thead>
                            <th class="small" colspan="4">Show in Job Ad</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="employer" checked></center></td>
                                <td><b>Employer: </b></td>
                                <td><?php echo $processed_data['name']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="slot"></center></td>
                                <td><b>Total Slot: </b></td>
                                <td><?php echo $processed_data['total']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="age" checked></center></td>
                                <td><b>Age: </b></td>
                                <td><?php echo $processed_data['age']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="education" checked></center></td>
                                <td><b>Education: </b></td>
                                <td><?php echo $processed_data['education']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="course" checked></center></td>
                                <td><b>Course: </b></td>
                                <td><?php echo $processed_data['course']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="single" checked></center></td>
                                <td><b>Must be Single: </b></td>
                                <td><?php echo $processed_data['single']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="height" checked></center></td>
                                <td><b>Height: </b></td>
                                <td><?php echo $processed_data['height']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="urgent" checked></center></td>
                                <td><b>Urgent: </b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="skills" checked></center></td>
                                <td><b>Skills: </b></td>
                                <td><?php echo $processed_data['skills']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="benefits" checked></center></td>
                                <td><b>Benefits: </b></td>
                                <td><?php echo $processed_data['benefits']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="requirements"></center></td>
                                <td><b>Additional Requirement: </b></td>
                                <td><?php echo $processed_data['requirements']; ?></td>
                            </tr>
                            <tr>
                                <td><center><input type="checkbox" name="on[]" value="description" checked></center></td>
                                <td><b>Description: </b></td>
                                <td><?php echo $order_details->description; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p>Submit the word you see below to proceed:</p>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <p id="captImg"><?php echo $captcha_img; ?></p>
                        </div>
                        <div class="error-form col-lg-6">
                            <input type="hidden" name="code" value="<?php echo $this->session->userdata('captchaCode'); ?>">
                            <input type="hidden" name="jobid" value="<?php echo $job_id; ?>">
                            <input type="text" name="captcha" id="captcha" required class="form-control" placeholder="Type captcha here">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>