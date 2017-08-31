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
                                $name = is_null($cl->comp_name) ? $cl->full_name : $cl->comp_name; ?>

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
            <table id="choose_shortlist" class="table-hover">
                <thead>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Match Result</th>
                    <th>Select</th>
                </thead>
                <tbody id="pop_left">
                </tbody>
            </table>
        </div>
        
        <div id="right_shortlist" class="col-lg-6">
            <form>
                <fieldset>
                    <legend class="custom-legend">Selected Applicants (<text id="app_ctr">0</text>)</legend>
                </fieldset>
            </form>
            <table id="send_shortlist" class="table-hover">
                <thead>
                    <th>Unselect</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Match Result</th>
                </thead>
                <tbody id="pop_right">
                </tbody>
            </table>
            <hr>
            <button class="btn btn-sm btn-primary pull-right" onclick="final()">
                <span class="glyphicon glyphicon-th-list"></span>
                Finalize Shortlist
            </button><br><br>
        </div>
    </div>
</body>
</html>

<div class="modal" role="dialog" id="finalize_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to shortlist the following applicant(s) to <text id="client_name_modal"></text> as <text id="position_modal"></text>?</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/save_shortlist'); ?>" method="post" class="form-horizontal">
                <input type="hidden" name="client_id">
                <input type="hidden" name="order_id">
                <ul id="short_list">
                    
                </ul>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    //initialize datatable
    $(document).ready (function () {
      $("#choose_shortlist, #send_shortlist").dataTable();
    });


    var left = [];
    var right = [];
    var final_id = [];
    var temp = {};

    $(function() {

      $("#client_shortlist").change(function() {

        var id = $("#client_shortlist").val();
        var name = $(this).find('option:selected').text();
        $("#client_name_modal").html(name);
        $("[name='client_id']").val(id);
        var url = "<?php echo base_url() ?>admin/get_job_order/";

            $.ajax({
                dataType: "JSON",
                url: url + id,
                type: "GET",
                success: function(data) {

                    var list = [];
                    list.push("<option>Choose</option>")
                    $.each(data, function(index, value) {

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
        $("[name='order_id']").val(o_id);
        $.ajax({
            dataType: "JSON",
            url: url + o_id,
            type: "GET",
            success: function(data) {

                $("#job_name").html(data.jname);
                $("#position_modal").html(data.jname);
            }
        });

        url = "<?php echo base_url(); ?>admin/get_applicant_shortlist/";

        $.ajax({

            dataType: "JSON",
            url: url + j_id,
            type: "GET",
            success: function(data) {

                left = [];
                right = [];
                if(data.length == null || data.length == 0) {

                    var empty = [];
                    var string_tbody = "<tr><td colspan='4'><center>No applicant(s) found</center></td></tr>";
                    empty.push(string_tbody);
                    $("#pop_left").html(empty.join(''));
                }
                else {

                    var populate = [];
                    var string_tr = "";
                    $.each(data, function(index, value) {

                        var gen = value.gender == 1 ? "Male" : "Female";
                        temp = {
                            id: value.id,
                            gender: gen,
                            name: value.first_name + " " + value.last_name
                        }
                        left.push(temp);
                        string_tr = "<tr>";
                        string_tr += "<td class='sub-label'>";
                        string_tr += value.first_name + " " + value.last_name;
                        string_tr += "</td>";
                        string_tr += "<td class='sub-label'>";
                        string_tr += gen;
                        string_tr += "</td>";
                        string_tr += "<td class='sub-label'>";
                        string_tr += "lol";
                        string_tr += "</td>";
                        string_tr += "<td>";
                        string_tr += "<button class='btn-success' id ="+ value.id +" onclick='select(this.id)'>";
                        string_tr += "<span class='glyphicon glyphicon-arrow-right'>";
                        string_tr += "</span>";
                        string_tr += "</button>";
                        string_tr += "</td>";
                        string_tr += "</tr>";
                        populate.push(string_tr);
                    });

                    $("#pop_left").html(populate.join(''));
                }
            }
        });

      });

    });

    function select(id) {

        //var i = left.indexOf(id);

        var i = left.map(x => x.id).indexOf(id);
        temp = {
            id: left[i].id,
            gender: left[i].gender,
            name: left[i].name
        }
        right.push(temp);
        left.splice(i, 1);

        final_id.push(id);
        
        repopulate_right_table();
        repopulate_left_table();
    }

    function unselect(id) {

        var i = right.map(x => x.id).indexOf(id);
        temp = {
            id: right[i].id,
            gender: right[i].gender,
            name: right[i].name
        }

        left.push(temp);
        right.splice(i, 1);

        i = final_id.indexOf(id);
        final_id.splice(i, 1);

        repopulate_right_table();
        repopulate_left_table();
    }

    function repopulate_right_table() {

        $("#app_ctr").html(right.length);
        var populate = [];
        var string_tr = "";
        if(right.length == 0) {

            var string_tr = "<tr><td colspan='4'><center>No applicant(s) found</center></td></tr>";
            populate.push(string_tr);
            $("#pop_right").html(populate.join(''));
        }

        else {
            $.each(right, function(index, value) {

                //left.push(value.id);
                //var gen = value.gender == 1 ? "Male" : "Female";
                string_tr = "<tr>";
                string_tr += "<td>";
                string_tr += "<button class='btn-danger' id ="+ value.id +" onclick='unselect(this.id)'>";
                string_tr += "<span class='glyphicon glyphicon-arrow-left'>";
                string_tr += "</span>";
                string_tr += "</button>";
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.name;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.gender;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += "lol";
                string_tr += "</td>";
                string_tr += "</tr>";
                populate.push(string_tr);
            });

            $("#pop_right").html(populate.join(''));
        }
    }

    function repopulate_left_table() {

        var populate = [];
        var string_tr = "";

        var string_tr = "";
        if(left.length == 0) {

            var string_tr = "<tr><td colspan='4'><center>No applicant(s) found</center></td></tr>";
            populate.push(string_tr);
            $("#pop_left").html(populate.join(''));
        }
        else {
            $.each(left, function(index, value) {

                //left.push(value.id);
                string_tr = "<tr>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.name;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.gender;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += "lol";
                string_tr += "</td>";
                string_tr += "<td>";
                string_tr += "<button class='btn-success' id ="+ value.id +" onclick='select(this.id)'>";
                string_tr += "<span class='glyphicon glyphicon-arrow-right'>";
                string_tr += "</span>";
                string_tr += "</button>";
                string_tr += "</td>";
                string_tr += "</tr>";
                populate.push(string_tr);
            });

            $("#pop_left").html(populate.join(''));
        }
    }

    function final() {

        if(right.length == 0)
            bootbox.alert("No applicants selected!");

        else {

            var populate = [];
            var string_tr = "";
            $.each(right, function(index, value) {

                string_tr = "<li class='larger-label'>";
                string_tr += "<input type='hidden' name='applist[]' value='" + value.id + "'>";
                string_tr += value.name;
                string_tr += "</li>";
                populate.push(string_tr);
            });

            $("#short_list").html(populate.join(''));
            $("#finalize_modal").modal("show");
        }
    }

</script>