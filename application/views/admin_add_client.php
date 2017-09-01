    <div class="admin-container">
        <form class="form-horizontal fade-effect" id="contact_us_form">
            <fieldset>
                <legend>Add New Client</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b> <p class="alert-p"><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></p>
                    </div>
                </div>
                <?php if($this->session->flashdata('success_notification')): ?>
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
                    <label for="" class="col-lg-2 control-label form-label"></label>
                    <div class="col-lg-5">
                        <select class="form-control" id="client" name="client">
                            <option selected disabled><text class="required">Choose Client</option>
                            <?php 
                                if(count($new_client) > 0) {
                                foreach($new_client as $cl) { 
                                    $name = is_null($cl->comp_name) || $cl->comp_name == "" ? $cl->full_name : $cl->comp_name;?>
                                    <option value="<?php echo $cl->id; ?>"><?php echo $name; ?></option>
                                <?php }} else { ?>
                                <option selected disabled>No Pending Client</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_client_type"); ?></span>
                            <select class="form-control" id="contact_client_type" name="contact_client_type" required>
                                <option selected disabled>Type of Customer</option>
                                <option value="1">Company/Insitution/Organization</option>
                                <option value="2">Personal/Individual</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="company" class="col-lg-2 control-label form-label">
                        Company Name:
                    </label>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("comp_name"); ?></span>
                            <input type="text" class="form-control" placeholder="Company name (Optional)" id="comp_name" name="comp_name">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("client_nature"); ?></span>
                            <select class="form-control" id="client_nature" name="client_nature" multiple>
                                <?php foreach($nature as $bn) { ?>
                                    <option value="<?php echo $bn->name; ?>"><?php echo $bn->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact Person:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_name"); ?></span>
                            <input type="text" class="form-control" placeholder="Contact Person's Full Name" id="contact_name" name="contact_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Job Position:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("job_position"); ?></span>
                            <input type="text" class="form-control" placeholder="Contact Person's Job Position" id="job_position" name="job_position">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact Info:
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_email"); ?></span>
                            <input type="text" class="form-control" placeholder="Client's Email Address" id="contact_email" name="contact_email" >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_contact_numbers"); ?></span>
                            <input type="text" class="form-control" placeholder="Client's Contact Number" id="contact_contact_number" name="contact_contact_number" >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_tel_number"); ?></span>
                            <input type="text" class="form-control" placeholder="Client's Telephone Number" id="contact_tel_number" name="contact_tel_number">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Address:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_street_address"); ?></span>
                            <input type="text" class="form-control" placeholder="Street Address" id="contact_street_address" name="contact_street_address" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_city_address"); ?></span>
                            <input type="text" class="form-control" placeholder="City" id="contact_city_address" name="contact_city_address" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_province_address"); ?></span>
                            <input type="text" class="form-control" id="contact_province_address" name="contact_province_address"  placeholder="Province">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_zip_address"); ?></span>
                            <input type="text" class="form-control" placeholder="Zip Code" id="contact_zip_address" name="contact_zip_address">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Account Info:
                    </label>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("client_username"); ?></span>
                            <input type="text" class="form-control" placeholder="Username" id="client_username" name="client_username">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("client_password"); ?></span>
                            <input type="text" class="form-control" placeholder="Password" id="client_password" name="client_password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <input type="checkbox" id="activate" checked>
                            <input type="hidden" name="activate" value="0">
                        </div>
                        <text class="small"> Activate Account</text>
                        <i class="help-block">
                            Activating the account will mean that the client can now perform any transaction
                            with the agency. Please ensure that the contract's starting date is not later than today.
                        </i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="button" class="btn btn-primary" id="sub">Add</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">

        $("[name='client_nature']").select2({
                maximumSelectionLength: 1,
                tags: true,
                placeholder: '    Select Nature of business',
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

        $("#client").change(function() {

            var id = $("#client").val();
            var url = "<?php echo base_url();?>admin/get_client_details/";
            $.ajax({
                dataType: "JSON",
                url: url + id,
                type: "GET",
                success: function(data) {

                    var cname = data.comp_name == null ? "" : data.comp_name;

                    if(data.type == 1) {
                        $("#client_nature").prop("disabled", false);
                        $("#comp_name").prop("disabled", false);
                        $("#job_position").prop("disabled", false);
                    }
                    else {
                        $("#client_nature").prop("disabled", true);
                        $("#comp_name").prop("disabled", true);
                        $("#job_position").prop("disabled", true);
                    }

                    $('[name="contact_client_type"]').val(data.type);
                    $('[name="comp_name"]').val(cname);
                    $('[name="client_nature"]').val(data.business_nature);
                    $('[name="contact_name"]').val(data.full_name);
                    $('[name="job_position"]').val(data.job_position);
                    $('[name="contact_email"]').val(data.email);
                    $('[name="contact_contact_number"]').val(data.mobile_no);
                    $('[name="contact_tel_number"]').val(data.tel_no);
                    $('[name="contact_street_address"]').val(data.street_address);
                    $('[name="contact_city_address"]').val(data.city);
                    $('[name="contact_province_address"]').val(data.province);
                    $('[name="contact_zip_address"]').val(data.zip);
                    $('[name="client_username"]').val(data.user);
                    $('[name="client_password"]').val(data.user);
                }
            });
        });

        $("#sub").click(function() {
            var id = $("#client").val();
            var url = "<?php echo base_url()?>admin/update_client/";
          
            $.ajax({

                dataType: "JSON",
                url: url + id,
                type: "POST",
                data: $("#contact_us_form").serialize(),
                success: function(data) {

                    data.success ? 
                    window.location.href="<?php echo base_url()?>admin/admin_client_list/" :
                    location.reload();
                }
            });
        });

    });

</script>