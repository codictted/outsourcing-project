$(function() {

	$("#delete_jc-panel").hide();
	$("#edit_jc-panel").hide();

	//JOB CATEGORY--------------------------------------
	//change ADD button to SAVE button
	$(".edit_jc_button").click(function() {
		$("#edit_jc-panel").show();
		$("#add_jc-panel").hide();
		$("#delete_jc-panel").hide();
		$("#edit_jc").val(this.id);
		var jcid = $("#edit_jc").val();
		var name = $("#" + this.id + "edit_job_cat").val();
		$("[name='edit_cat_name']").val(name);
		$("#edit_jc-form").attr("action", "http://localhost/outsourcing/outsourcing-project/maintenance/update_job_cat/"+ jcid);
	});

	$(".delete_jc_button").click(function() {
		$("#delete_jc-panel").show();
		$("#add_jc-panel").hide();
		$("#edit_jc-panel").hide();
		$("#delete_jc").val(this.id);
		var jcid = $("#delete_jc").val();
		var name = $("#" + this.id + "delete_job_cat").val();
		$("[name='delete_job_category']").val(name);
		$("#delete_jc-form").attr("action", "http://localhost/outsourcing/outsourcing-project/maintenance/delete_job_cat/"+ jcid);
	});

	//REQUIRED DOCUMENTS-------------------------------
	//change ADD button to SAVE button
	$(".edit_rd_button").click(function() {
		$("#delete_rd_panel").hide();
		$("#addedit_rd_panel").show();
		$("#cancel_edit_button").show(); // ID ba dapat 'to?
		$("#clear_add_button").hide();// ID ba dapat 'to?
		$("#add_rd_button").hide();
		$("#save_rd_button").show();
		$("#panel-title").html("EDIT REQUIRED DOCUMENTS"); // ID ba dapat 'to?
		$("#edit_rd").val(this.id);
		var rdid = $("#edit_rd").val();
		var name = $("#" + this.id + "edit_req_docu").val();
		$("[name='addedit_req_documents']").val(name);
		$("#req_docu_form").attr("action", "http://localhost/outsourcing/outsourcing-project/maintenance/edit_category_form/"+ rdid);
	});

	$(".delete_rd_button").click(function() {
		$("#addedit_rd_panel").hide();
		$("#delete_rd_panel").show();
		$("#delete_rd").val(this.id);
		var rdid = $("#delete_rd").val();
		var name = $("#" + this.id + "delete_req_docu").val();
		$("[name='delete_req_documents']").val(name);
		$("#req_docu_form").attr("action", "http://localhost/outsourcing/outsourcing-project/maintenance/delete_category_form/"+ jcid);
	});

});

function jc_returnAdd() { //return to add from edit
	$("add_jc-panel").show();
	$("edit_jc-panel").hide();
	$("delete_jc-panel").hide();
}

function jc_returnToAdd() { //return to add from delete
	$("#add_jc-panel").show();
	$("edit_jc-panel").hide();
	$("#delete_jc-panel").hide();
}

function deleteJobCat() {
	var jcid = $("#delete_jc").val();
	$("#delete_jc-form").attr("action", "http://localhost/outsourcing/outsourcing-project/maintenance/delete_job_cat/"+ jcid);
}