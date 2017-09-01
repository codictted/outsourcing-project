<div class="admin-container">
	<?php echo form_open("query/showlist_client");?>
        <fieldset>
            <legend>Filter Client</legend>
            <div class="form-group col-lg-12">
                <div class="col-lg-3">
                    <select class="form-control" name="status" id="status">
                        <option selected disabled>--Status--</option>
                        <option value="0">New</option>
                        <option value="1">Pending</option>
                        <option value="2">Active</option>
                        <option value="3">Terminated</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="business_nature" id="business_nature">
                        <option selected disabled>--Business Nature--</option>
                           <?php
                            if(count($business_nature) > 0) {
                                foreach($business_nature as $bn) { 
                                    $name = $bn->name; ?>
                                    <option value="<?php echo $bn->id; ?>"><?php echo $name; ?></option>
                                <?php }} else { ?>
                               
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-lg-2">
                    <h5>Date Activated:</h5>
                </div>
                
                <div class="col-lg-3">
                    FROM:
                    <input class="form-control" type="date" name="acc_creation_date_from" id="acc_creation_date_from"/>
                </div>
                <div class="col-lg-3">
                    TO:
                    <input class="form-control" type="date" name="acc_creation_date_to" id="acc_creation_date_to"/>
                </div>
            </div>
        </fieldset>  
     <?php echo form_close();?>
    <br><hr><br>
    <div class="col-lg-12">
        <table id="client-table" class="custom-table-large table-hover">
                <thead>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Company Name/ Contact Person</th>
                    <th>Nature of Business</th>
                    <th>Date Activated</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($client as $c) { ?>
                    <tr id="<?php echo $c->id ?>" onclick="get_cl(this.id)">
                        <?php 
                           
                            if ($c->status == 0){
                                $status = "New";
                            }
                            else if ($c->status == 1){
                                $status = "Pending";
                            }
                            else if ($c->status == 2){
                                $status = "Active";
                            }
                            else if ($c->status == 3){
                                $status = "Terminated";
                            }

                            $type = $c->type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                            $name = $c->type == 1 ? $c->comp_name."/ ".$c->full_name : $c->full_name;
                            //$business = base_url()."admin/get_nature/".$c->business_nature;
                        ?>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $c->name; ?></td>
                        <td><?php echo $c->acc_creation_date; ?></td>
                        <td><button class="btn btn-default btn-sm table-btn" onclick="window.location.href='applist_new'"><span class="glyphicon glyphicon-list"></span></button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    
    $(function() {

        $("#client-table").dataTable();

        $("[name='status']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_client/';
            var dataString = $("[name='status'], [name='business_nature'], [name='acc_creation_date_from'], [name='acc_creation_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Pending";
                    }
                     else if (element.status == 2){
                        stat_name = "Active";
                    }
                     else if (element.status == 3){
                        stat_name = "Terminated";
                    }
                 
                    type = element.type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                    name = element.type == 1 ? element.comp_name + "/ " + element.full_name : element.full_name;
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + type + "</td><td>" + name + "</td><td>" + element.name +  "</td><td>" + element.acc_creation_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>admin/applist_new/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

        $("[name='business_nature']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_client/';
            var dataString = $("[name='status'], [name='business_nature'], [name='acc_creation_date_from'], [name='acc_creation_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Pending";
                    }
                     else if (element.status == 2){
                        stat_name = "Active";
                    }
                     else if (element.status == 3){
                        stat_name = "Terminated";
                    }
                 
                    type = element.type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                    name = element.type == 1 ? element.comp_name + "/ " + element.full_name : element.full_name;
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + type + "</td><td>" + name + "</td><td>" + element.name +  "</td><td>" + element.acc_creation_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>admin/applist_new/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

        $("[name='acc_creation_date_from']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_client/';
            var dataString = $("[name='status'], [name='business_nature'], [name='acc_creation_date_from'], [name='acc_creation_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Pending";
                    }
                     else if (element.status == 2){
                        stat_name = "Active";
                    }
                     else if (element.status == 3){
                        stat_name = "Terminated";
                    }
                 
                    type = element.type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                    name = element.type == 1 ? element.comp_name + "/ " + element.full_name : element.full_name;
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + type + "</td><td>" + name + "</td><td>" + element.name +  "</td><td>" + element.acc_creation_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>admin/applist_new/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

        $("[name='acc_creation_date_to']").on("change", function (e) {
            var url = '<?php echo base_url()?>query/showlist_client/';
            var dataString = $("[name='status'], [name='business_nature'], [name='acc_creation_date_from'], [name='acc_creation_date_to']").serialize();
            $.ajax({
                dataType: "JSON",
                url: url,
                type: "POST",
                data: dataString,
                success: function(data) {
                     $("tbody").empty();
                $.each(data, function(index, element) {
                    
                    if (element.status == 0){
                        stat_name = "New";
                    }
                    else if (element.status == 1){
                        stat_name = "Pending";
                    }
                     else if (element.status == 2){
                        stat_name = "Active";
                    }
                     else if (element.status == 3){
                        stat_name = "Terminated";
                    }
                 
                    type = element.type == 1 ? "Company/Institution/Organization" : "Personal/Individual"; 
                    name = element.type == 1 ? element.comp_name + "/ " + element.full_name : element.full_name;
                   $("tbody").append("<tr><td>"+ stat_name + "</td><td>" + type + "</td><td>" + name + "</td><td>" + element.name +  "</td><td>" + element.acc_creation_date + "</td><td><button class='btn btn-default btn-sm table-btn' id=" + element.app_id + "onclick='window.location.href='<?php echo base_url()?>admin/applist_new/'+this.id'><span class='glyphicon glyphicon-list'></span></button></td></tr>");
                  });  
                }
            });
        });

  
    });

    
</script>