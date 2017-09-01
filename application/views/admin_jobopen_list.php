    <div class="admin-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>List of Job Openings</legend>
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">This shows the list of job openings to be displayed on the main page of the website.</p>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <div>
            <table id="jobopen-table" class="custom-table-large table-hover">
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
                        <td><button class="btn btn-default btn-sm" onclick="window.location.href='applist_new'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#jobopen-table").dataTable();
    });
</script>