<div id="homepage" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#homepage" data-slide-to="0" class="active"></li>
        <li data-target="#homepage" data-slide-to="1"></li>
        <li data-target="#homepage" data-slide-to="2"></li>
        <li data-target="#homepage" data-slide-to="3"></li>
    </ol>

    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo base_url(); ?>images/wp1.jpg" alt="For those in search of the incredible">
            <div class="carousel-caption">
                <h1>FOR THOSE IN SEARCH OF THE INCREDIBLE</h1>
                <p>Leave the recruitment to us!</p>
          </div>
        </div>

        <div class="item">
            <img src="<?php echo base_url(); ?>images/wp3.jpg" alt="New York">
            <div class="carousel-caption">
                <h1>OPPORTUNITIES ARE NEVER LOST</h1>
                <p>Someone will take the one you miss</p>
            </div>
        </div>

        <div class="item">
            <img src="<?php echo base_url(); ?>images/wp4.jpg" alt="New York">
            <div class="carousel-caption">
                <h1>WE HELP YOU FIND TALENT</h1>
                <p>And help talent find you!</p>
            </div>
        </div>

        <div class="item">
            <img src="<?php echo base_url(); ?>images/wp5.jpeg" alt="New York">
            <div class="carousel-caption">
                <h1>HIRE CHARACTER, TRAIN SKILL</h1>
                <p>We provide competitive services</p>
            </div>
        </div>
    </div>

    <a class="left carousel-control" href="#homepage" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#homepage" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="white">
    <div class="container div-margin">
        <h3 class="content-margin"><center>OUR UNIQUE SERVICE MODEL WILL PROVIDE YOU WITH ACCESS TO PERFECTLY MATCHED, PREVIOUSLY UNDISCOVERABLE CANDIDATES FOR YOUR NEEDS IN THE PHILIPPINES
        </center></h3><br><br><br><br><br>
        <div class="col-lg-3">
            <center>
                <img src="<?php echo base_url(); ?>images/db-icon.png">
                <h4><b>DATABASE & COMMUNITY</b></h4><br>
                <p class="div-content">
                    200,000+ Candidates: Painters, Caregivers, Drivers, and different blue collar workers. Plus unique network multipliers & community outreach programs run by all recruiters in their respective vertical focus.
                </p>
            </center>
        </div>
        <div class="col-lg-3">
            <center>
                <img src="<?php echo base_url(); ?>images/cert-icon.png">
                <h4><b>CERTIFIED RECRUITERS</b></h4><br>
                <p class="div-content">
                   Our job postings are always up to date! We pride ourselves on passive candidate sourcing. We are internationally certified in the latest sourcing strategies, and can discover and engage more candidates.
                </p>
            </center>
        </div>
        <div class="col-lg-3">
            <center>
                <img src="<?php echo base_url(); ?>images/business-icon.png">
                <h4><b>BUSINESS DRIVEN APPROACH</b></h4><br>
                <p class="div-content">
                   We invest time to align a tailored sourcing strategy with your strategic business objectives. We have expertise in Multinational expansion, corporate recruitment, plus first hires & growth for tech & start-up companies.
                </p>
            </center>
        </div>
        <div class="col-lg-3">
            <center>
                <img src="<?php echo base_url(); ?>images/market-icon.png">
                <h4><b>MARKET ENTRY STRATEGY</b></h4><br>
                <p class="div-content">
                    New to the Philippines? We have been the exclusive recruitment partner for over 100 Multinationals, corporations & start-ups entering the Filipino market. We specialize in recruiting first hires  & building core teams.
                </p>
            </center>
        </div>
    </div>
</div>
<div class="black" id="contact_us">
    <div class="container div-margin">
        <h2>CONTACT US</h2>
        <h3 class="content-margin lead"><center>Are you in need of excellent workers? You are in the right track, fill up the form below or <a href="<?php echo base_url()?>applicant/">Apply Now!</a> if you are a jobseeker. Be one of us!
        </center></h3><br><br>
        <form id="contact_us_form" class="form-horizontal" action="<?php echo base_url(); ?>home/contact_us" method="post">
            <fieldset>
                <legend>Customer Details</legend>
                <small><i>Please take note of the fileds with (<text class="required">*</text>), for they are required fields.</i></small><br><br>
                <?php if($this->session->flashdata('success_notification_contact_us')): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Well done!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('success_notification_contact_us'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata("fail_notification_contact_us")): ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable small">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oh snap!</strong>
                            <p class="alert-p"><?php echo $this->session->flashdata('fail_notification_contact_us'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label"></label>
                    <div class="col-lg-5 error-form">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_client_type"); ?></span>
                            <select class="form-control" id="contact_client_type" name="contact_client_type" required>
                                <option selected disabled>Type of Customer</option>
                                <option value="1">Company/Institution/Organization</option>
                                <option value="2">Personal/Individual</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 error-form">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("business_nature"); ?></span>
                            <select class="form-control" id="client_nature" name="business_nature" multiple>
                                <?php foreach($business_nature as $bn) { ?>
                                <option value="<?php echo $bn->name; ?>"><?php echo $bn->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company" class="col-lg-2 control-label form-label">
                        Company Name:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("comp_name"); ?></span>
                            <input type="text" class="form-control" placeholder="Your company name (Optional)" id="comp_name" name="comp_name">
                        </div>
                        <span class="help-block">
                            <i>Company name is required if you are a Company/Insitution/Organization</i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Full Name:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_name"); ?></span>
                            <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Your Full Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Email Address:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_email"); ?></span>
                            <input type="text" id="contact_email" name="contact_email" class="form-control" placeholder="Your Email Address">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cnum" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Contact Number:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_contact_number"); ?></span>
                            <input type="text" id="contact_contact_number" name="contact_contact_number" class="form-control" placeholder="Your Contact Number">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tnum" class="col-lg-2 control-label form-label">
                        Tel Number:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_tel_number"); ?></span>
                            <input type="text" id="contact_tel_number" name="contact_tel_number" class="form-control" placeholder="Your Telephone Number">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-lg-2 control-label form-label">
                        <text class="required">*</text> Address:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_street_address"); ?></span>
                            <input type="text" id="contact_street_address" name="contact_street_address" class="form-control" placeholder="Street Address">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                    </label>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_city_address"); ?></span>
                            <input type="text" id="contact_city_address" name="contact_city_address" class="form-control" placeholder="City">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_province_address"); ?></span>
                            <input type="text" id="contact_province_address" name="contact_province_address" class="form-control" placeholder="Province">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("contact_zip_address"); ?></span>
                            <input type="text" id="contact_zip_address" name="contact_zip_address" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inquiry" class="col-lg-2 control-label form-label">
                        <text class="required">*</text>
                        Inquiry:
                    </label>
                    <div class="col-lg-10">
                        <div class="error-form">
                            <span class="indiv-error"><?php echo form_error("inquiry"); ?></span>
                            <textarea class="form-control" rows="3" id="inquiry" name="inquiry"></textarea>
                        </div>
                        <span class="help-block">Thank you very much for choosing us! If you need anything feel free to ask here, we're more than happy to help you or schedule an appointment with us and talk about how we can help find right workers for your needs. Please be sure to check your mail frequently.</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="white">
    <div class="container div-margin">
        <h2 class="content-margin"><center>OUR LONG TIME CLIENTS
        </center></h2><br><br><br><br><br>
        <center>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/aside.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/baskin.png" height="80px">
            </div>
             <div class="logo">
                <img src="<?php echo base_url(); ?>images/infinit.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/ea.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/main.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/microsoft.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/nike.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/saralee.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/sm.png" height="80px">
            </div>
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/yellow.png" height="80px">
            </div>
        </center>
    </div>
</div>
<div class="black">
    <div class="container div-margin">
        
    </div>
</div>
</body>
</html>

<script type="text/javascript">


$("[name='business_nature']").select2({
        maximumSelectionLength: 1,
        tags: true,
        placeholder: '    Select Nature of business',
        allowClear: true,
        createTag: function (params) {
            var term = $.trim(params.term);
           
            if (term.match(/^[!@#$%^&*()]+$/g)) {
              return null;
            }
        
            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
        }
});

</script>
