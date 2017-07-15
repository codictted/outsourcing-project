<div class="admin-container">
	<form class="form-horizontal">
        <fieldset>
            <legend>Filter Applicant</legend>
            <div class="form-group col-lg-12">
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
    <br><hr><br>
    <div class="col-lg-12">
        <table id="applicant-table" class="custom-table-large table-hover">
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
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    
    $(function() {

        $("#applicant-table").dataTable();
    });

</script>