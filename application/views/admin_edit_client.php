    <?php 
        $name = $client->type == 1 ? $client->comp_name : $client->full_name;
        $comp = $client->type == 1 ? $client->comp_name : "N/A";
        $tel = is_null($client->tel_no) || $client == "" ? NULL : $client->tel_no;
    ?>
    <div class="admin-container">
        <form class="form-horizontal fade-effect" id="contact_us_form">
            <fieldset>
                <legend>Edit <?php echo $name; ?></legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b> <p class="alert-p"><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></p>
                    </div>
                </div>
                <?php if($this->session->flashdata("fail_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Oh Snap!</b> <p class="alert-p"><?php echo $this->session->flashdata("fail_notification"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="company" class="col-lg-2 control-label form-label">
                        Company Name:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Company name (Optional)" id="comp_name" name="comp_name" value="<?php echo $comp; ?>">
                            <input type="hidden" name="client" id="client" value="<?php echo $client->id; ?>">
                            <input type="hidden" name="contact_client_type" value="<?php echo $client->type; ?>">
                            <input type="hidden" name="client_nature" value="<?php echo $client->business_nature; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact Person:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Contact Person's Full Name" id="contact_name" name="contact_name" value="<?php echo $client->full_name; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Job Position:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Contact Person's Job Position" id="job_position" name="job_position" value="<?php echo $client->job_position; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact Info:
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Client's Email Address" id="contact_email" name="contact_email" value="<?php echo $client->email; ?>">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Client's Contact Number" id="contact_contact_number" name="contact_contact_number" value="<?php echo $client->mobile_no; ?>" >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Client's Telephone Number" id="contact_tel_number" name="contact_tel_number" value="<?php echo $tel; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Address:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Street Address" id="contact_street_address" name="contact_street_address" value="<?php echo $client->street_address; ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="City" id="contact_city_address" name="contact_city_address" value="<?php echo $client->city; ?>" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Province" id="contact_province_address" name="contact_province_address" value="<?php echo $client->province; ?>">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Zip Code" id="contact_zip_address" name="contact_zip_address" value="<?php echo $client->zip; ?>">
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
                            <input type="text" class="form-control" placeholder="Username" id="client_username" name="client_username" value="<?php echo $client->acc_username; ?>">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="error-form">
                            <input type="text" class="form-control" placeholder="Password" id="client_password" name="client_password" value="<?php echo $client->acc_password; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-8">
                        <div class="error-form">
                            <input type="checkbox" id="activate" name="acc_stat" value="<?php echo $client->acc_status; ?>">
                            <text class="small">Activate Account</text>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="button" class="btn btn-primary" id="sub">Edit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">
    $(function() {

        $("#comp_name").val() == "N/A" ? $("#comp_name, #job_position").prop("disabled", true) : $("#comp_name, #job_position").prop("disabled", false);

        $("#activate").val() == 0 ? $("#activate").prop("checked", true) : $("#activate").prop("checked", false);

        $("#activate").change(function() {
            this.checked ? $('[name="acc_stat"]').val(0) : $('[name="acc_stat"]').val(1);
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
                    window.location.href="<?php echo base_url()?>admin/edit_client/" + id;
                }
            });
        });
    });
</script>