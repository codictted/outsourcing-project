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
                            <td><i>On Going</i></td>
                        </tr>
                        <tr>
                            <td><b>Job Advertisement Status:</b></td>
                            <td><i>Posted</i></td>
                        </tr>
                        <tr>
                            <td><b>Position:</b></td>
                            <td><i><?php echo $order_details->jname; ?></i></td>
                        </tr>                      
                        <tr>
                            <td><b>Client:</b></td>
                            <td><i><?php $client = is_null($order_details->comp) ? $order_details->full : $order_details->comp; echo $client;?></i></td>
                        </tr>
                        <tr>
                            <td><b>Quantity:</b></td>
                            <td><i><?php $total = $order_details->num_male + $order_details->num_female + $order_details->total_openings; echo $total; ?></i></td>
                        </tr>
                        <tr>
                            <td><b>Deployed as of <?php echo date("m/d/Y"); ?></b></td>
                            <td><i><?php echo $emp_count[0]->staff_ctr; ?></i></td>
                        </tr>
                        <tr>
                            <td><b>Date Ordered:</b></td>
                            <td><i><?php echo $order_details->order_date; ?></i></td>
                        </tr>                        
                        <tr>
                            <td><b>Date Posted:</b></td>
                            <td><i><?php echo $order_post[0]->date_posted; ?></i></td>
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
                                    <td>Weight:</td>
                                    <td><?php echo $processed_data['weight']; ?></td>
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
        <div class="col-lg-12">
            <br>
            <form class="col-lg-12">
                <fieldset>
                    <legend>Staff History</legend>
                </fieldset>
            </form>
            <div class="col-lg-12">
                <br><br>
                <table id="jo-ongoing-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Application Date</th>
                    <th>Date of Deployment</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Active</td>
                        <td>Arlene Mariano</td>
                        <td>Female</td>
                        <td>2017-06-05</td>
                        <td>2017-07-03 5:45PM</td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>Edward Elrick</td>
                        <td>Male</td>
                        <td>2017-06-09</td>
                        <td>2017-07-03 5:45PM</td>
                    </tr>
                    <tr>
                        <td>Terminated</td>
                        <td>Arlene Mariano</td>
                        <td>Female</td>
                        <td>2017-06-05</td>
                        <td>2017-07-03 5:45PM</td>
                    </tr>
                    <tr>
                        <td>Inactive/Di na nagtatrabaho</td>
                        <td>Edward Elrick</td>
                        <td>Male</td>
                        <td>2017-06-09</td>
                        <td>2017-07-03 5:45PM</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#jo-ongoing-table").dataTable();
    });
</script>