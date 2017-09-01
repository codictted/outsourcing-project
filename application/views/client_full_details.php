    <div class="admin-container slide-effect">
        <form>
            <fieldset>
                <legend>Client Details</legend>
                <?php $stat = $client->status == 1 ? "ACTIVE" : "INACTIVE";?>
                <label><a><?php echo $stat; ?></a></label>
            </fieldset>
        </form>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <label class="form-label larger-label"><?php $name = $client->type == 1 ? $client->comp_name : $client->full_name; echo $name; ?>,</label>
                <label class="form-label sub-label"><?php $type = $client->type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; echo $type; ?></label>
            </div>
        </div>
        <br><br><br>
        <div class="col-lg-12 client_form_det">
            <form class="col-lg-12">
                <fieldset>
                    <br>
                    <div id="application-details">
                        <ul class="breadcrumb">
                            <li><a href="#client_info">Client Information</a></li>
                        </ul><hr>
                    <div id="client_info">
                        <div class="form-group">
                            <h4><center>Client Information
                                <label><a href="<?php echo base_url(); ?>admin/edit_client/<?php echo $client->id;?>"><b>EDIT</b></a></label>
                            </center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td colspan="2"><b>Company Name:</b></td>
                                    <?php $name = $client->type == 1 ? $client->comp_name : "N/A"; ?>
                                    <td><i><?php echo $name; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Business Nature:</b></td>
                                    <td><i><?php $bn = $client->type == 1 ? $client->bn : "N/A"; echo $bn;?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Adress:</b></td>
                                    <td><i><?php $address = $client->street_address.' '.$client->city.', '.$client->province.' '.$client->zip; echo $address;?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Contact Person:</b></td>
                                    <td><i><?php echo $client->full_name; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Job Position:</b></td>
                                    <td><i><?php echo $client->job_position; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Email Address:</b></td>
                                    <td><i><?php echo $client->email; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Mobile Number:</b></td>
                                    <td><i><?php echo $client->mobile_no; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Telephone Number:</b></td>
                                    <td><i><?php $tel = is_null($client->tel_no) || $client->tel_no == "" ? "N/A" : $client->tel_no; echo $tel; ?></i></td>
                                    <td colspan="2"><b></b></td>
                                    <td><i></i></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#order-table").dataTable();
    });
</script>