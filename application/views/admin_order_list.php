    <div class="admin-container fade-effect">
        <form>
            <fieldset>
                <legend>List of Job Orders</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                    </div>
                </div>
                <?php if($this->session->flashdata("success_notification_post_joborder")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>Well Done!</b> <p class="alert-p"><?php echo $this->session->flashdata("success_notification_post_joborder"); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification_post_joborder")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_post_joborder'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group col-lg-12">
                    <label class="form-label col-lg-1">Filter:</label>
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
                        <select class="form-control">
                            <option selected disabled>--Choose--</option>
                            <option value="0">Status</option>
                            <option value="0">Client</option>
                            <option value="0">Job Position</option>
                            <option value="0">Date</option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <table id="order-table" class="custom-table-large table-hover">
                <thead>
                    <th>Urgent</th>
                    <th>Status</th>
                    <th>Client</th>
                    <th>Job Position</th>
                    <th>Quantity</th>
                    <th>Deployed</th>
                    <th>Date Ordered</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <?php
                        foreach($orders as $jo) {

                            switch($jo->status) {
                                case 0 : $status = "New";
                                        $url = "jo_new/".$jo->order_id;
                                        break;
                                case 1 : $status = "On Going";
                                        $url = "jo_ongoing/".$jo->order_id;
                                        break;
                                case 2 : $status = "Completed";
                                        $url = "jo_completed/".$jo->order_id;
                                        break;
                                case 3 : $status = "Terminated";
                                        $url = "jo_terminated/".$jo->order_id;
                                        break;
                                default : $status = "Rejected";
                                        $url = "jo_rejected/".$jo->order_id;
                                        break;
                            }
                            $urg = $jo->status == 0 ? "Yes" : "No";
                            $name = is_null($jo->comp) || $jo->comp == "" ?
                                    $jo->full :
                                    $jo->comp;
                            $num_male = is_null($jo->num_male) || $jo->num_male == "" ? 0 : $jo->num_male;
                            $num_female = is_null($jo->num_female) || $jo->num_female == "" ? 0 : $jo->num_female;
                            $num_mix = is_null($jo->total_openings) || $jo->total_openings == "" ? 0 : $jo->total_openings;

                            $total = $num_male + $num_female + $num_mix;
                    ?>
                    <tr id="<?php echo $jo->client_id; ?>" onclick="get_cl(this.id)">
                        <td><?php echo $urg; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $jo->jname; ?></td>
                        <td><?php echo $total?></td>
                        <td>0</td>
                        <td><?php echo $jo->order_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='<?php echo base_url(); ?>admin/<?php echo $url; ?>'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#order-table").dataTable();
    });

    function get_cl(id) {
        window.location.href="<?php echo base_url();?>admin/client_full_details/" + id;
    }
</script>