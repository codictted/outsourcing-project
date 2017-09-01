    <div class="client-container fade-effect">
        <form class="form-horizontal">
            <fieldset>
                <legend>Good Day, you have:</legend>
            </fieldset>
        </form>
        <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary dash1">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list bigicon-white"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $shortlist->ctr; ?></div>
                            <div>New Short List!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>client/shortlist">
                    <div class="panel-footer">
                        <span class="pull-left">Go to Short List</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
