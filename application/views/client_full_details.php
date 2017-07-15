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
                            <li><a href="#order_history">Job Order History</a></li>
                            <li><a href="#staff_history">Staff History</a></li>
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
                                    <td colspan="2"><b>Full Name:</b></td>
                                    <td><i><?php echo $client->full_name; ?></i></td>
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
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="order_history">
                        <div class="col-lg-12">
                            <table id="order-table" class="custom-table-large table-hover">
                                <thead>
                                    <th>Status</th>
                                    <th>Job Position</th>
                                    <th>Date Ordered</th>
                                </thead>
                                <tbody>
                                    <tr class="tr-click-client-det">
                                        <td>New</td>
                                        <td>Bagger</td>
                                        <td>2017-07-03 5:45PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div id="staff_history">
                        <div class="form-group">
                            <h4><center>Staff History</center></h4>
                            <table class="col-lg-12 custom-table">
                                <tr>
                                    <td><b>Employer's Name:</b></td>
                                    <td><b>Address</b></td>
                                    <td><b>Years Employed</b></td>
                                </tr>
                                <tr>
                                    <td><i>Microsoft:</i></td>
                                    <td><i>New York City, USA</i></td>
                                    <td><i>5</i></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Skills:</b></td>
                                    <td><i>PHP, RDBMS, Codeigniter, Exceptional logic</i></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <a href="#family_form" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
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