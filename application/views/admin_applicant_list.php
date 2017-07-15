    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Applicants</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                        <br>
                        <p class="alert-p">You can view the applicant's full application details by clicking the row.</p>
                        <br>
                        <b>STATUS LEGEND:</b>
                        <div id="legend">
                            <br>
                            <ul class="breadcrumb">
                                <li><a href="#new">New</a></li>
                                <li><a href="#job-matched">Job Matched</a></li>
                                <li><a href="#for-interview">For Interview</a></li>
                                <li><a href="#interview-default">For Interview (Default)</a></li>
                                <li><a href="#failed-interview">Failed Interview</a></li>
                                <li><a href="#shortlist-ready">Ready to Short List</a></li>
                                <li><a href="#shortlist-rejected">Shortlisted (Rejected)</a></li>
                                <li><a href="#shortlist-selected">Shortlisted (Selected)</a></li>
                                <li><a href="#job-offered">Job Offered</a></li>
                                <li><a href="#job-offered-rejected">Job Offered (Rejected)</a></li>
                                <li><a href="#requirements">Passing of Requirements</a></li>
                                <li><a href="#for-endorsement">For Endorsement</a></li>
                                <li><a href="#deployed">Deployed</a></li>
                            </ul>
                            <div id="new">
                                <p class="alert-p">If the applicant's status is new, it will undergo in job matching. The applicant will be notified for it's match result via SMS notification.</p>
                            </div>
                            <div id="job-matched">
                                <p class="alert-p">After Job Matching, if the applicant wishes to continue its application, he/she will recieve an SMS notification regarding about his interview schedule.</p>
                            </div>
                            <div id="for-interview">
                                <p class="alert-p">Failure to come after a week, will automatically change the applicant's status to default.</p>
                            </div>
                            <div id="interview-default">
                                <p class="alert-p">Failure to come on interview.</p>
                            </div>
                            <div id="failed-interview">
                                <p class="alert-p">Failed the interview.</p>
                            </div>
                            <div id="shortlist-ready">
                                <p class="alert-p">Upon success of interview, the applicant is now ready to be shortlisted.</p>
                            </div>
                            <div id="shortlist-rejected">
                                <p class="alert-p">If the applicant is rejected by the client, he can be re-shortlist to other client who needs a same job position.</p>
                            </div>
                            <div id="shortlist-selected">
                                <p class="alert-p">Shall send a job offer to selected applicants.</p>
                            </div>
                            <div id="job-offered">
                                <p class="alert-p">Already sent the job offer the applicants.</p>
                            </div>
                            <div id="job-offered-rejected">
                                <p class="alert-p">He can request to be shortlisted to other client if he doesn't like the offer.</p>
                            </div>                            
                            <div id="requirements">
                                <p class="alert-p">Requirements tracking. The applicant will only be endorsed after passing all the necessary documents.</p>
                            </div>
                            <div id="for-endorsement">
                                <p class="alert-p">Contract signing between agency and the applicant.</p>
                            </div>
                            <div id="deployed">
                                <p class="alert-p">The applicant is already hired.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="col-lg-3 pull-right">                    
                        <button type="button" class="btn btn-primary col-lg-12" onclick="window.location.href='create_shortlist'"><span class="glyphicon glyphicon-plus"></span>
                            Create a Short List
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <table id="app-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Full Name</th>
                    <th>Job Position</th>
                    <th>Age/Gender</th>
                    <th>Nationality/Race</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        foreach ($applicant as $app) { 
                        $stat = $app->status == 0 ? "New" : "Something else";
                        $gen = $app->gender == 1 ? "Male" : "Female"; ?>
                    <tr id="<?php echo $app->id; ?>" onclick="get_app(this.id)">
                        <td><?php echo $stat; ?></td>
                        <td><?php echo $app->first_name.' '.$app->last_name; ?></td>
                        <td><?php echo $app->jname; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td>Filipino/Visayan</td>
                        <td><?php echo $app->application_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" id="<?php echo $app->id; ?>" onclick="window.location.href='<?php echo base_url()?>admin/applist_new/'+this.id"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                    <!-- <tr class="tr_click">
                        <td>Job Matched</td>
                        <td>Ryoma Echizen</td>
                        <td>Tennis Player</td>
                        <td>17/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_matched'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>For Interview</td>
                        <td>Izahaya Orihara</td>
                        <td>Company Driver</td>
                        <td>39/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_interview'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Failed Interview</td>
                        <td>Len Tsukimori</td>
                        <td>Janitor</td>
                        <td>19/Male</td>
                        <td>Pinoy</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_finterview'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Ready to Short List</td>
                        <td>Hino Kahoko</td>
                        <td>Violinist</td>
                        <td>19/Female</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_shortlist'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Shortlisted (Rejected)</td>
                        <td>Naruto Uzumaki</td>
                        <td>Hokage</td>
                        <td>18/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_short_rejected'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Shortlisted (Selected)</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_joboffer'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Job Offered</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Job Offered (Rejected)</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Passing of Requirements</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_requirements'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>For Endorsement</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Deployed</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    
    $(function() {

        //initialize datatable
        $("#app-table").dataTable();
        
    });
    function get_app(id) {
        window.location.href="<?php echo base_url();?>admin/applicant_full_details/" + id;
    }
</script>