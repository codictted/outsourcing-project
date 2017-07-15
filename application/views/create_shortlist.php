    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Create a Short List</legend>
                <!-- convert sa bootstrap information panel -->
                <!-- <span class="help-block">
                </span><br> -->
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>IMPORTANT:</b> <p class="alert-p">In creating a shortlist, it is necessary to choose a client and its respective order first so that the system can automatically filter the applicant list based on client's job orders.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="job" class="col-lg-2 control-label form-label"><text class="required">*</text> Client:</label>
                    <div class="col-lg-4">
                        <select class="form-control">
                            <option selected disabled>--Job Category--</option>
                            <option>Driver</option>
                            <option>Caregiver</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control">
                            <option selected disabled>--Job Order List--</option>
                            <option>Family Driver</option>
                            <option>Company Driver</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                    </label>
                    <div class="col-lg-8 order-details">
                        <table width="600px" class="table custom-table">
                            <thead class="custom-thead">
                                <td colspan="5">Job Position</td>
                                <td colspan="3">Quantity</td>
                                <td colspan="3">Selected</td>
                                <td colspan="4">Full Details</td>
                            </thead>
                            <tbody>
                                <tr>                                    
                                    <td colspan="5">Project Manager</td>
                                    <td colspan="3">5</td>
                                    <td colspan="3">3</td>
                                    <td colspan="4"><a href="#">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </form>
        <br><br>
        <div id="left_shortlist" class="col-lg-6">
            <form>
                <fieldset>
                    <legend class="custom-legend">Ready for Shortlisting Applicants</legend>
                </fieldset>
            </form>
            <table id="choose_shortlist" class="drag_tr table-hover">
                <thead>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Match Result</th>
                    <th>Match Result</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Arlene Mariano</td>
                        <td>Female</td>
                        <td>Hyaku Parsento</td>
                        <td><button onclick="alert('dfa')">hey</button></td>
                    </tr>                    
                    <tr>
                        <td>Edward Elrick</td>
                        <td>Male</td>
                        <td>Hyaku Parsento</td>
                        <td><button onclick="alert('dfa')">hey</button></td>
                    </tr>
                    <tr>
                        <td>Alphonse Elrick</td>
                        <td>Male</td>
                        <td>Hyaku Parsento</td>
                        <td><button onclick="alert('dfa')">hey</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div id="right_shortlist" class="col-lg-6">
            <form>
                <fieldset>
                    <legend class="custom-legend">Selected Applicants</legend>
                </fieldset>
            </form>
            <table id="send_shortlist" class="drag_tr table-hover">
                <thead>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Match Result</th>
                    <th>Match Result</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Alphonse Elrick</td>
                        <td>Male</td>
                        <td>Hyaku Parsento</td>
                        <td><button onclick="alert('dfa')">hey</button></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <button class="btn btn-sm btn-primary pull-right">
                <span class="glyphicon glyphicon-th-list"></span>
                Finalize Shortlist
            </button><br><br>
        </div>        
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#choose_shortlist, #send_shortlist").dataTable();
    });
</script>