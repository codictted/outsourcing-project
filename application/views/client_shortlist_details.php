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
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $gen; ?></td>
                        <td><?php echo $match_res; ?>%</td>
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
                Send Shortlist
            </button><br><br>
        </div>
    </form>
</div>
</body>
</html>

<script type="text/javascript">
    $(document).ready (function () {
      $("#choose_shortlist, #send_shortlist").dataTable();
    });

    function client_select(id) {

        var i = left.map(x => x.id).indexOf(id);
        console.log(i);
        // temp = {
        //     id: left[i].id,
        //     gender: left[i].gender,
        //     name: left[i].name,
        //     match: left[i].match
        // }
        // right.push(temp);
        // left.splice(i, 1);

        // final_id.push(id);
        
        // repopulate_right_table();
        // repopulate_left_table();
    }

    function client_unselect(id) {

        var i = right.map(x => x.id).indexOf(id);
        
        temp = {
            id: right[i].id,
            gender: right[i].gender,
            name: right[i].name,
            match: left[i].match
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
                string_tr += value.name;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.gender;
                string_tr += "</td>";
                string_tr += "<td class='sub-label'>";
                string_tr += value.match + "%";
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
                string_tr += value.match + "%";
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
</script>