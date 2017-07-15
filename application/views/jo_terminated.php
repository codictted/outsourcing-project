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
                            <td><i>Completed</i></td>
                        </tr>
                        <tr>
                            <td><b>Job Advertisement Status:</b></td>
                            <td><i>Closed</i></td>
                        </tr>
                        <tr>
                            <td><b>Position:</b></td>
                            <td><i>Janitor</i></td>
                        </tr>                      
                        <tr>
                            <td><b>Client:</b></td>
                            <td><i>Accenture</i></td>
                        </tr>
                        <tr>
                            <td><b>Quantity:</b></td>
                            <td><i>5</i></td>
                        </tr>
                        <tr>
                            <td><b>Deployed as of 2017-0-0-0:</b></td>
                            <td><i>2</i></td>
                        </tr>
                        <tr>
                            <td><b>Date Ordered:</b></td>
                            <td><i>2017-02-02 9PM</i></td>
                        </tr>                        
                        <tr>
                            <td><b>Date Posted:</b></td>
                            <td><i>2017-02-04 9AM</i></td>
                        </tr>                       
                        <tr>
                            <td><b>Termination Date:</b></td>
                            <td><i>2017-02-04 9AM</i></td>
                        </tr>                       
                        <tr>
                            <td><b>Reason for Termination</b></td>
                            <td><i>Kolang sa budget</i></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <br>
            <form class="col-lg-12">
                <fieldset>
                    <legend>Job Description</legend>
                </fieldset>
            </form>
            <div class="col-lg-12">
                <table class="table custom-table">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Skills: </td>
                            <td><i>
                                <ul>
                                    <li>Marunong mag drive ng eroplano</li>
                                    <li>Kayang magpatakbo hanggang 180kph</li>
                                    <li>BMW</li>
                                </ul>
                            </i></td>
                        </tr>
                        <tr>
                            <td>Qualifications: </td>
                            <td><i>
                                <ul>
                                    <li>Naka experience na maglangoy</li>
                                    <li>edi wiw</li>
                                    <li>wowwo</li>
                                    <li>buburahin din naman to</li>
                                </ul>
                            </i></td>
                        </tr>
                        <tr>
                            <td>Description: </td>
                            <td><i>
                                <ul>
                                    <li>Magdrive araw araw mula bahay hanggang school</li>
                                    <li>Sunduin tuwing hapon</li>
                                    <li>kayang magturo magmaneho</li>
                                    <li>gagawin kapag nasira yung kotse</li>
                                    <li>sariling linis</li>
                                    <li>pwedeng iuwi sa bahay yung sasakyan</li>
                                </ul>
                            </i></td>
                        </tr>
                        <tr>
                            <td>Details: </td>
                            <td><i>
                                <ul>
                                    <li>No Preffered education</li>
                                    <li>No Preffered Course</li>
                                    <li>must be 25 - 30 y/o</li>
                                    <li>no preffered height</li>
                                    <li>no preffered weight</li>
                                    <li>3 male(s) and 2 female(s)</li>
                                </ul>
                            </i></td>
                        </tr>

                        <tr>
                            <td>Benefits: </td>
                            <td><i>
                                <ul>
                                    <li>No Preffered education</li>
                                    <li>No Preffered Course</li>
                                    <li>must be 25 - 30 y/o</li>
                                    <li>no preffered height</li>
                                    <li>no preffered weight</li>
                                    <li>3 male(s) and 2 female(s)</li>
                                </ul>
                            </i></td>
                        </tr>
                    </tbody>
                </table>
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
                <table id="jo-terminated-table" class="custom-table-large table-hover">
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
      $("#jo-terminated-table").dataTable();
    });
</script>