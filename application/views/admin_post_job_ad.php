    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Create a Job Advertisement</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p"><i>Choose a Job Position you wish to advertise. The details of the job will automatically be filled from maintenance. Should you want to change the job details, you must edit the details from maintenance.</i></p>
                    </div>
                </div>
               <!--  <small><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></small><br><br> -->
                <div class="form-group">
                    <label for="" class="col-lg-1 control-label"></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="job_category" id="job_category">
                            <option selected disabled><text class="required">* Job Category</option>
                            <?php
                            if(count($job_category) > 0) {
                                    foreach($job_category as $jc) { ?>
                                        <option value="<?php echo $jc->id; ?>"><?php echo $jc->name; ?></option>
                                    <?php }} else { ?>
                                    <option selected disabled>No pending Job categories</option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <select class="form-control">
                                <option selected disabled>* Job Position</option>
                                <option>Family Driver</option>
                                <option>Company Driver</option>
                            </select>
                        </div>
                    </div>
                </div><br>
                <div class="form-group">
                    <label for="company" class="col-lg-2 control-label form-label">
                        Details:
                    </label>
                    <div class="col-lg-10">
                        <table class="table custom-table">
                            <thead>
                                <th>Skills</th>
                                <th>Qualifications</th>
                                <th>Additional Requirement</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PHP</td>
                                    <td>Grad of 4 yr course</td>
                                    <td>Diploma</td>
                                </tr>
                                <tr>
                                    <td>PHP</td>
                                    <td>Grad of 4 yr course</td>
                                    <td>TOR</td>
                                </tr>
                                <tr>
                                    <td>PHP</td>
                                    <td>Grad of 4 yr course</td>
                                    <td></td>
                                </tr>
                                    <td>PHP</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company" class="col-lg-2 control-label form-label">
                        Additional Qualifications:
                    </label>
                    <div class="col-lg-10">
                        <!-- <ul>
                            <li>Female applicants only</li>
                            <li>Graduate of any 4-year course</li>
                            <li>Must be 150cm tall</li>
                        </ul> -->
                        <i>No addtional qualifications</i>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="inquiry" class="col-lg-2 control-label form-label">
                        Description:
                    </label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="5" id="job_desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <input type="checkbox" id="activate">
                        </div>
                        <text class="small"> Publish advertisement</text>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">
    CKEDITOR.replace('job_desc');

    $("#job_category").change(function() {

        var id = $("#job_category").val();
        var name = $(this).find('option:selected').text();
        $("[name='job_category_id']").val(id);
        var url = "<?php echo base_url() ?>admin/get_job_order/";

            $.ajax({
                dataType: "JSON",
                url: url + id,
                type: "GET",
                success: function(data) {

                    var list = [];
                    list.push("<option>Choose</option>")
                    $.each(data, function(index, value) {

                        list.push('<option value="' + value.order_id + '-' + value.job_id + '">' + value.name + '</option>');
                    });
                    $("#job_order_list").html(list.join('')).prop("disabled", false);
                }
            });
      });

</script>