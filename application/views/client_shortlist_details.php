<script type="text/javascript">

    var left = [];
    var right = [];
    var final_id = [];
    var temp_id =[];
    var temp = {};

    function insert_value(a, b, c, d) {

        temp = {
            id: a,
            gender: b,
            name: c,
            match: d,
        }
        left.push(temp);
    }
</script>
<div class="client-container fade-effect">
    <form class="form-horizontal" method="POST" action="<?php echo base_url()?>client/send_shortlist">
        <fieldset>
            <legend>Applicant Shortlist Details for <?php echo $shortlist_det[0]->jname; ?></legend>
        </fieldset>
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable small">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="glyphicon glyphicon-info-sign"></i><b>REMINDER:</b> <p class="alert-p">Please review thoroughly before submitting, unselected applicants will automatically be rejected.</p><br>
                <p class="alert-p">Next to the applicant's name is the percentage from the auto job match between the qualifications from your job order and the applicant's skills.</p>
            </div>
        </div>
        <div id="left_shortlist" class="col-lg-6">
            <form>
                <fieldset>
                    <legend class="custom-legend">Short List</legend>
                </fieldset>
            </form>
            <input type="hidden" id="joborder_id" value="<?php echo $shortlist_det[0]->order_id; ?>">
            <table id="choose_shortlist" class="table-hover">
                <thead>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Match Result</th>
                    <th>Selected</th>
                </thead>
                <tbody id="pop_left">
                    <?php foreach($shortlist_det as $sh) {

                    $gen = $sh->gender == 1 ? "Male" : "Female";
                    $full_name = $sh->first_name." ".$sh->last_name;
                    $match_res = round(($sh->job_match['matched']/$sh->job_match['total']) * 100, 2);
                    ?>

                    <?php echo "<script>
                                insert_value(".$sh->id.", \"$gen\", \"$full_name\", ".$match_res.");
                                </script>"; ?>
                    <tr>
                        <td><a onclick="window.location.href='../../<?php base_url(); ?>client/applicant_full_details/<?php echo $sh->applicant_id; ?>'"><?php echo $full_name; ?></a></td>
                        <td><?php echo $gen; ?></td>
                        <td><a id="<?php echo $sh->id; ?>" onclick="show_modal_match(this.id)"><?php echo $match_res; ?>%</a></td>
                        <td>
                            <button type="button" id="<?php echo $sh->id; ?>" class="btn-success" onclick="client_select(this.id)">
                            <span class='glyphicon glyphicon-arrow-right'></span>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
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
                Hire Applicants
            </button><br><br>
        </div>
    </form>
</div>
</body>
</html>

<div class="modal" role="dialog" id="finalize_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to hire the following applicant(s)?</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('client/save_shortlist'); ?>" method="post" class="form-horizontal">
                <input type="hidden" name="client_id">
                <input type="hidden" name="order_id">
                <ul id="short_list">
                    
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="match-details-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Auto Job Match Details</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="panel-heading">
                    </div>
                    <table class="table col-lg-12 custom-table-large table-striped">
                        <tr>
                            <td colspan="2"><b><center>QUALIFICATIONS</center></b></td>
                            <td colspan="2"><b><center>SKILLS</center></b></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-ok"></span>Matched</td>
                            <td><span class="glyphicon glyphicon-remove"></span>Did Not Matched</td>
                            <td><span class="glyphicon glyphicon-ok"></span>Matched</td>
                            <td><span class="glyphicon glyphicon-remove"></span>Did Not Matched</td>
                        </tr>
                        <tr>
                            <td>
                                <ul id="match_quali">
                                    
                                </ul>
                            </td>
                            <td>
                                <ul id="nonmatch_quali">
                                </ul>
                            </td>
                            <td>
                                <ul id="match_skill">
                                </ul>
                            </td>
                            <td>
                                <ul id="nonmatch_skill">
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <div class="panel-footer">
                        <text>Total number of items: &nbsp;<text id="total"></text></text><br>
                        <text>Total number of matched items: &nbsp;<text id="matched"></text></text><br>
                        <text>Auto Match Result: <text id="result"></text></text>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form> 
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready (function () {
      $("#choose_shortlist, #send_shortlist").dataTable();
    });

    function show_modal_match(id) {

        var url = "<?php echo base_url(); ?>client/get_match_details/";
        var oid = $("#joborder_id").val();
        $.ajax({

            dataType: "JSON",
            url: url + id + "/" + oid,
            type: "GET",
            success: function(data) {

                var arr = [];
                var temp;
                $.each(data['match_quali'], function(index, value){

                    temp = "<li>";
                    temp += value;
                    temp += "</li>";

                    arr.push(temp);
                });

                $("#match_quali").html(arr.join(''));

                arr = [];
                temp = "";
                $.each(data['nonmatch_quali'], function(index, value){

                    temp = "<li>";
                    temp += value;
                    temp += "</li>";

                    arr.push(temp);
                });

                $("#nonmatch_quali").html(arr.join(''));

                arr = [];
                temp = "";
                $.each(data['match_skill'], function(index, value){

                    temp = "<li>";
                    temp += value;
                    temp += "</li>";

                    arr.push(temp);
                });

                $("#match_skill").html(arr.join(''));

                arr = [];
                temp = "";
                $.each(data['nonmatch_skill'], function(index, value){

                    temp = "<li>";
                    temp += value;
                    temp += "</li>";

                    arr.push(temp);
                });

                $("#nonmatch_skill").html(arr.join(''));

                $("#total").html(data['total']);
                $("#matched").html(data['matched']);

                var percentage = ((data['matched'] / data['total']) * 100).toFixed(2);
                $("#result").html(percentage+"%");
            }
        });

        $("#match-details-modal").modal("show");
    }

    function client_select(id) {

        var i = left.map(x => x.id).indexOf(parseInt(id));
        temp = {
            id: left[i].id,
            gender: left[i].gender,
            name: left[i].name,
            match: left[i].match
        }
        right.push(temp);
        left.splice(i, 1);

        final_id.push(id);
        
        repopulate_right_table();
        repopulate_left_table();
    }

    function client_unselect(id) {

        var i = right.map(x => x.id).indexOf(parseInt(id));
        temp = {
            id: right[i].id,
            gender: right[i].gender,
            name: right[i].name,
            match: right[i].match
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
                string_tr += "<button type='button' class='btn-danger' id ="+ value.id +" onclick='client_unselect(this.id)'>";
                string_tr += "<span class='glyphicon glyphicon-arrow-left'>";
                string_tr += "</span>";
                string_tr += "</button>";
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += "<a onclick=\"window.location.href='../../<?php base_url(); ?>client/applicant_full_details/"+ value.id + "'\">";
                string_tr += value.name;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.gender;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += "<a id=" + value.id + " onclick=\"show_modal_match(this.id)\">";
                string_tr += value.match + "%";
                string_tr += "</a>";
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
                string_tr += "<a onclick=\"window.location.href='../../<?php base_url(); ?>client/applicant_full_details/"+ value.id + "'\">";
                string_tr += value.name;
                string_tr += "</a>";
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.gender;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += "<a id=" + value.id + " onclick=\"show_modal_match(this.id)\">";
                string_tr += value.match + "%";
                string_tr += "</a>";
                string_tr += "</td>";
                string_tr += "<td>";
                string_tr += "<button type='button' class='btn-success' id ="+ value.id +" onclick='client_select(this.id)'>";
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