<div class="admin-container fade-effect">
    <fieldset>
        <legend>Clients with most job ordered</legend>
        <div id="application-tab">

            <div id="date_form">
                <div class="form-group">
                    <div class="pull-right">
                        <a id="print_date_lnk" href="#" target="_blank"><span class="glyphicon glyphicon-print small"></span> Print</a>
                    </div>

                    <label class="col-lg-2 control-label form-label"> Filter by: </label>
                    <div class="col-lg-2">
                        <select class="form-control" name="filter" style="width:130%;" required>
                            <option value="" selected disabled>-- Choose Filter --</option>   
                            <option value="0">&nbsp;&nbsp;Weekly</option>
                            <option value="1">&nbsp;&nbsp;Monthly</option>
                            <option value="2">&nbsp;&nbsp;Yearly</option>
                        </select>
                    </div>
                    

                    <form id="week-form" class="form-horizontal" action="<?php echo base_url()?>reports/filter_date_week_client_cjo/" method="POST" hidden>
                        <label for="job" class="col-lg-2 control-label form-label"> Week:</label>
                        <div class="col-lg-3" >
                            <input type='text' name='date_picker_week' class="form-control" placeholder="Select Week" />
                            <input type="hidden" name="date_picker_week_first">
                            <input type="hidden" name="date_picker_week_last">
                        </div>
                     

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-filter"></span> Filter</button>
                        </div>
                    </form> 

                    <form id="month-form" class="form-horizontal" action="<?php echo base_url()?>reports/filter_date_month_client_cjo/" method="POST" hidden>
                        <label for="job" class="col-lg-2 control-label form-label"> Month:</label>
                        <div class="col-lg-3" >
                            <input type='text' name='date_picker_month' class="form-control" placeholder="Select Month" />
                            <input type="hidden" name="date_picker_month_first">
                            <input type="hidden" name="date_picker_month_last">
                        </div>
                     

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-filter"></span> Filter</button>
                        </div>
                    </form> 

                    <form id="year-form" class="form-horizontal" action="<?php echo base_url()?>reports/filter_date_year_client_cjo/" method="POST" hidden>
                        <label for="job" class="col-lg-2 control-label form-label"> Year:</label>
                        <div class="col-lg-3" >
                            <input type='text' name='date_picker_year' class="form-control" placeholder="Select Year" />
                            <input type="hidden" name="date_picker_year_first">
                            <input type="hidden" name="date_picker_year_last">
                        </div>
                     

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-filter"></span> Filter</button>
                        </div>
                    </form> 
                    
                    <br><br><br>


                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-book"></i> Bar chart of Clients Job order
                        </div>
                          
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-11">
                                        <div id="client_date_chart"></div>
                                </div>
                            </div>
                        </div>
                         
                    </div>

                </div>
            </div>


           

            

        </div>
    </fieldset>
   
</div>
</body>
</html>

<script type='text/javascript'>
    moment.locale('en', {
      week: { dow: 1 } 
    });
    
    
    $('#print_date_lnk').click(function(){
        <?php 
            foreach ($base_date as $key => $value) {
        ?>
            var minDate = moment("<?php print_r($value->min); ?>").format("MMMM Do YYYY");
            var maxDate = moment("<?php print_r($value->max); ?>").format("MMMM Do YYYY");
        <?php                   
            }

        ?>
        window.location.href="<?php echo base_url();?>reports/print_client_cjo_date?" + "mindate=" + minDate + "&" + "maxdate=" + maxDate;
    
    });

   
    $('[name="filter"]').on('change', function(){
            if($(this).val() == '0'){
                $("[name='date_picker_week']").datetimepicker({
                    format: 'MM-DD-YYYY'
                });

                $("[name='date_picker_week']").on('dp.change', function (e) {
                    value = $("[name='date_picker_week']").val();
                    firstDate = moment(value, "MM-DD-YYYY").day(0).format("YYYY-MM-DD");
                    lastDate =  moment(value, "MM-DD-YYYY").day(6).format("YYYY-MM-DD");
                    
                    $("[name='date_picker_week_first']").val(firstDate);
                    $("[name='date_picker_week_last']").val(lastDate);
                    $("[name='date_picker_week']").val(firstDate + "   -   " + lastDate);
                });

                $('#week-form').show();
                $('#month-form').hide();
                $('#year-form').hide();
               
            }
            else if($(this).val() == '1'){
                $("[name='date_picker_month']").datetimepicker({
                    format: 'MM-YYYY'
                });

                $("[name='date_picker_month']").on('dp.change', function (e) {
                    value = $("[name='date_picker_month']").val();
                    firstDate = moment(value, "MM-YYYY").add(1, 'D').format("YYYY-MM-DD");
                    lastDate = moment(value, "MM-YYYY").endOf('month').format("YYYY-MM-DD");

                    $("[name='date_picker_month_first']").val(firstDate);
                    $("[name='date_picker_month_last']").val(lastDate);
                });

                $('#month-form').show();
                $('#week-form').hide();
                $('#year-form').hide();
            }
            else{
                $("[name='date_picker_year']").datetimepicker({
                    format: 'YYYY'
                });

                $("[name='date_picker_year']").on('dp.change', function (e) {
                    value = $("[name='date_picker_year']").val();
                    firstDate = moment(value, "YYYY").add(1, 'D').format("YYYY-MM-DD");
                    lastDate = moment(value, "YYYY").endOf('year').format("YYYY-MM-DD");

                    $("[name='date_picker_year_first']").val(firstDate);
                    $("[name='date_picker_year_last']").val(lastDate);
                });

                $('#year-form').show();
                $('#week-form').hide();
                $('#month-form').hide();
            }
    });
 
    
    new Morris.Bar({
        element: 'client_date_chart',
            data: [
                <?php 
                    $endOfKey = count($date);
                    foreach ($date as $key => $dateVal) {
                        $key != $endOfKey ? print_r("{y: '$dateVal->clientDate', $key: $dateVal->countClient},") : print_r("{y: '$dateVal->clientDate', $key: $dateVal->countClient}");
                        
                    }
                ?>
            ],
            xkey: 'y',
            ykeys: [
                <?php 
                    $endOfKey = count($date);
                    foreach ($date as $key => $dateVal) {
                        $key != $endOfKey ? print_r("'$key',") : print_r('$key');
                        
                    }
                ?>
            ],
            labels: [
                <?php 
                    $endOfKey = count($date);
                    foreach ($date as $key => $dateVal) {
                        $key != $endOfKey ? print_r("'$dateVal->clientName',") : print_r("'$dateVal->clientName'");
                        
                    }
                ?>
            ],
            hideHover: 'auto',
            resize: true
    });


</script>