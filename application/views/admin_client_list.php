    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Client</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.<br>You can view the details of the client by clicking the companies' respective row.</p>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification_client_terminate")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Well Done!</b> <p class="alert-p"><?php echo $this->session->flashdata("success_notification"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification_client_terminate")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group col-lg-12">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-3">                    
                        <button type="button" class="btn btn-primary btn-margin" onclick="window.location.href='<?php echo base_url()?>admin/create_client'"><span class="glyphicon glyphicon-plus"></span>Add Client
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <table id="client-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Company Name/ Contact Person</th>
                    <th>Nature of Business</th>
                    <th>Date Activated</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($client as $c) { ?>
                    <tr id="<?php echo $c->id ?>" onclick="get_cl(this.id)">
                        <?php
                            switch ($c->status) {
                                 case '1':
                                     $status = "Active";
                                     $url = "active_modal";
                                     break;

                                 case '2':
                                     $status = "Contract Expired";
                                     $url = "inactive_modal";
                                     break;

                                 case '3':
                                     $status = "Terminated";
                                     $url = "inactive_modal";
                                     break;
                             } 
                            $type = $c->type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                            $name = $c->type == 1 ? $c->comp_name."/ ".$c->full_name : $c->full_name;
                            //$business = base_url()."admin/get_nature/".$c->business_nature;
                        ?>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $c->name; ?></td>
                        <td><?php echo $c->acc_creation_date; ?></td>
                        <td><button class="btn btn-default btn-sm modal-btn-client" id="<?php echo $c->id."-".$url."-".$name; ?>"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="active_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terminate your client,  <text name="client-name"></text>?</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Warning!</strong>
                        <p class="alert-p">You are about to terminate <text name="client-name"></text>. Please check your client's contract's expiration date before you proceed. <span class="help-block"><i>The client will be notified via SMS and e-mail if you continue.</i></span></p>
                    </div>
                </div>
                <form action="<?php echo base_url('admin/terminate_client'); ?>" method="post" class="form-horizontal" id="update_interview_form">
                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Reason:
                    </label>
                    <div class="col-lg-7">
                        <div class="error-form">
                            <input type="hidden" name="client_id" id="client_id">
                            <select class="form-control" multiple style="width:100%;" name="reason">
                                <?php foreach($reason as $r) { ?>
                                    <option value="<?php echo $r->name; ?>"><?php echo $r->name; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label form-label">
                        <text class="required">*</text> Captcha:
                    </label>
                    <div class="col-lg-3">
                        <p id="captImg"><?php echo $captcha_img; ?></p>
                    </div>
                    <div class="error-form col-lg-4">
                        <input type="hidden" name="code" value="<?php echo $this->session->userdata('captchaCode'); ?>">
                        <input type="text" name="captcha" id="captcha" required class="form-control" placeholder="Type captcha here">
                        <span class="indiv-error"><?php echo form_error("captcha"); ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="inactive_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><text name="client-name"></text></h4>
            </div>
            <div class="modal-body">
                <h3>IDK WHAT TO PUT HERE</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="confirm()" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("[name='reason']").select2({
        maximumSelectionLength: 1,
        tags: true,
        placeholder: '    Enter',
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


    $(function () {
        //initialize datatable
      $("#client-table").dataTable();

      //populate datatable
        });

    function get_cl(id) {
        window.location.href="<?php echo base_url();?>admin/client_full_details/" + id;
    }

    function get_nature(id) {
        alert(id);
    }

    function confirm() {

        bootbox.confirm({
        message: "This is a confirm with custom button text and color! Do you like it?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
        }
    });
    }
</script>