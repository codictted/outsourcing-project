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
                        <select class="form-control" id="client_shortlist">
                            <option selected disabled>Choose</option>
                            <?php foreach($client as $cl) { 
                                $name = is_null($client->comp_name) ? $cl->full_name : $cl->comp_name; ?>

                            <option value="<?php echo $cl->id;?>"><?php echo $name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" id="job_order_list">
                            <option selected disabled value="0">Job Order List</option>
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
                                    <td colspan="5" id="job_name"></td>
                                    <td colspan="3" id="quantity"></td>
                                    <td colspan="3" id="selected"></td>
                                    <td colspan="4"><a href="#"></a></td>
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
                </thead>
                <tbody id="pop_left">
                </tbody>
            </table>
        </div>
        
        <div id="right_shortlist" class="col-lg-6" class="behind">
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
                </thead>
                <tbody>
                <tr>
                        <td>Arlene Mariano</td>
                        <td>Female</td>
                        <td>Hyaku Parsento</td>
                    </tr>                    
                    <tr>
                        <td>Edward Elrick</td>
                        <td>Male</td>
                        <td>Hyaku Parsento</td>
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

    $(function() {

      $("#client_shortlist").change(function() {

        var id = $("#client_shortlist").val();
        var url = "<?php echo base_url() ?>admin/get_job_order/";

            $.ajax({
                dataType: "JSON",
                url: url + id,
                type: "GET",
                success: function(data) {

                    var list = [];
                    $.each(data, function(index, value) {

                        if(index == 0)                            
                            $("#job_name").html(value.name);
                        list.push('<option value="' + value.order_id + '-' + value.job_id + '">' + value.name + '</option>');
                    });
                    $("#job_order_list").html(list.join('')).prop("disabled", false);
                }
            });
      });

      $("#job_order_list").change(function() {

        var id = $("#job_order_list").val();
        var o_id = id.split('-')[0];
        var j_id = id.split('-')[1];
        var url = "<?php echo base_url() ?>admin/get_job_order_details/";

        $.ajax({
            dataType: "JSON",
            url: url + o_id,
            type: "GET",
            success: function(data) {

                $("#job_name").html(data.jname);
            }
        });

        url = "<?php echo base_url(); ?>admin/get_applicant_shortlist/";

        $.ajax({

            dataType: "JSON",
            url: url + j_id,
            type: "GET",
            success: function(data) {

                var populate = [];
                var string_tr;
                $.each(data, function(index, value) {

                    var gen = value.gender == 1 ? "Male" : "Female";
                    string_tr = "<tr>";
                    string_tr += "<td>";
                    string_tr += value.first_name + " " + value.last_name;
                    string_tr += "</td>";
                    string_tr += "<td>";
                    string_tr += gen;
                    string_tr += "</td>";
                    string_tr += "<td>";
                    string_tr += "lol";
                    populate.push(string_tr);
                });


                $("#pop_left").html(populate.join(''));
            }
        });

      });

    });
</script>