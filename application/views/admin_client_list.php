    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Client</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Well Done!</b> <p class="alert-p"><?php echo $this->session->flashdata("success_notification"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group col-lg-12">
                    <label class="form-label col-lg-1">Filter:</label>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Type</option>
                            <option value="0">Nature of Business</option>
                            <option value="0">Application Date</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
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
                            if($c->status == 1)
                                $status = "Active"; 
                            $type = $c->type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                            $name = $c->type == 1 ? $c->comp_name."/ ".$c->full_name : $c->full_name;
                            //$business = base_url()."admin/get_nature/".$c->business_nature;
                        ?>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $c->name; ?></td>
                        <td><?php echo $c->acc_creation_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_new'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
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
</script>