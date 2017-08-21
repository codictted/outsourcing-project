<div class="admin-container fade-effect">
    <form class="form-horizontal" id="#" action="<?php echo base_url() ?>applicant/submit" method="post">
    <fieldset>
        <legend>Total number of Applicants</legend>
        <div id="application-tab">
            <ul class="breadcrumb">
                <li><a href="#age_form">By Age</a></li>
                <li><a href="#location_form">By Location</a></li>
                <li><a href="#date_form">By Date</a></li>
                <li><a href="#nationality_form">By Nationality</a></li>
                <li><a href="#">Essay Questions</a></li>
            </ul>

            <?php if($this->session->flashdata("success_notification_application")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Well done!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('success_notification_application'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata("fail_notification_application")): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable small">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Oh snap!</strong>
                        <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_application'); ?></p>
                    </div>
                </div>
            <?php endif; ?>


            <div id="age_form">
                <div class="form-group">
                    <div class="pull-right">
                        <a href="#"><span class="glyphicon glyphicon-print small"></span> Print</a>
                    </div>

                    <label for="job" class="col-lg-2 control-label form-label"> Age Range From:</label>
                    <div class="col-lg-3">
                        <input class="form-control" type="number" name="age_from">
                    </div>
                    <label class="col-lg-2 control-label form-label"> To:</label>
                    <div class="col-lg-3">
                        <input class="form-control" type="number" name="age_to">
                    </div>
                    <br><br><br><br>

                    <div class="col-lg-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Applicant Donut Chart
                            </div>
                            <div class="panel-body">
                                <div id="app_age_donut"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="location_form">
                <div class="form-group">
                    <div class="pull-right">
                        <a href="#"><span class="glyphicon glyphicon-print small"></span> Print</a>
                    </div>
                    
                </div>
            </div>

            <div id="date_form">
                <div class="form-group">
                    <div class="pull-right">
                        <a href="#"><span class="glyphicon glyphicon-print small"></span> Print</a>
                    </div>

                    <label for="job" class="col-lg-2 control-label form-label"> Date Range From:</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="date" name="date_from">
                    </div>
                    <label class="col-lg-2 control-label form-label"> To:</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="date" name="age_to">
                    </div>
                </div>
            </div>

            <div id="nationality_form">
                <div class="form-group">
                    <div class="pull-right">
                        <a href="#"><span class="glyphicon glyphicon-print small"></span> Print</a>
                    </div>

                    
                </div>
            </div>
                
            
        </div>
    </fieldset>
    </form>
</div>
</body>
</html>

<script type='text/javascript'>
            new  Morris.Area({
                    element: 'shortlist_area',
                data: [
               
                {
                    period: '2016',
                    as: 13,
                    rs: 15
                },
                {
                    period: '2017',
                    as: 8,
                    rs: 5
                }
                ],
                xkey: 'period',
                ykeys: ['as', 'rs'],
                labels: ['Accepted Shortlist', 'Rejected Shortlist'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

            new Morris.Donut({
                element: 'app_age_donut',
                data: [
                    { label: "New Applicants", value: 10 }, 
                    { label: "Job Matched Applicants", value: 12 }
                ],
                resize: true
            });

            new Morris.Bar({
                element: 'morris-bar-chart',
                data: [{
                    y: '2006',
                    a: 100,
                    b: 90
                }, {
                    y: '2007',
                    a: 75,
                    b: 65
                }, {
                    y: '2008',
                    a: 50,
                    b: 40
                }, {
                    y: '2009',
                    a: 75,
                    b: 65
                }, {
                    y: '2010',
                    a: 50,
                    b: 40
                }, {
                    y: '2011',
                    a: 75,
                    b: 65
                }, {
                    y: '2012',
                    a: 100,
                    b: 90
                }],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B'],
                hideHover: 'auto',
                resize: true
            });

</script>