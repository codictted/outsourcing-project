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
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="button" class="btn btn-primary pull-right" onclick="window.location.href='order_confirm'">Post Job</button>
                <button type="reset" class="btn btn-default pull-right">Reject</button>
            </div>
        </div>
    </div>
</body>
</html>
