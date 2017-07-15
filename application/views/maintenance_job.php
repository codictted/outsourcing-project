    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Manage Job Position</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">You can always filter the list by your own specifications.</p>
                </div>
            </fieldset>
        </form>
        <hr>
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary col-lg-2 pull-right" onclick="window.location.href='create_client'"><span class="glyphicon glyphicon-plus"></span>Add Job Position
            </button><br><br><br>
        </div>
        <div class="col-lg-12">
            <table id="job-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Company Name/ Contact Person</th>
                    <th>Nature of Business</th>
                    <th>Date Activated</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr class="tr_click_client">
                        <td>Active</td>
                        <td>Company/Institution/Organization</td>
                        <td>Puregold/ Arlene Mariano</td>
                        <td>Retail/ Sales</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_new'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <!-- <tr class="tr_click">
                        <td>Job Matched</td>
                        <td>Ryoma Echizen</td>
                        <td>Tennis Player</td>
                        <td>17/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_matched'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>For Interview</td>
                        <td>Izahaya Orihara</td>
                        <td>Company Driver</td>
                        <td>39/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_interview'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Failed Interview</td>
                        <td>Len Tsukimori</td>
                        <td>Janitor</td>
                        <td>19/Male</td>
                        <td>Pinoy</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_finterview'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Ready to Short List</td>
                        <td>Hino Kahoko</td>
                        <td>Violinist</td>
                        <td>19/Female</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_shortlist'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Shortlisted (Rejected)</td>
                        <td>Naruto Uzumaki</td>
                        <td>Hokage</td>
                        <td>18/Male</td>
                        <td>Japanese</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_short_rejected'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Shortlisted (Selected)</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_joboffer'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Job Offered</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Job Offered (Rejected)</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Passing of Requirements</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_requirements'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>For Endorsement</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <tr class="tr_click">
                        <td>Deployed</td>
                        <td>Jeremy Santos</td>
                        <td>Kitchen Staff</td>
                        <td>28/Male</td>
                        <td>Filipino/Bicol</td>
                        <td>2017-07-03 5:45PM</td>
                        <td><button class="btn btn-default btn-sm" onclick="alert('Accepted or Not')"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#job-table").dataTable();
    });
</script>