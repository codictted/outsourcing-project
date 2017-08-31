$(function() {

	$("#edit_ea_panel").hide();
  $("#delete_ea_panel").hide();

	$(".edit_ea_button").click(function() {
    $("#edit_ea_panel").show();
    $("#add_ea_panel").hide();
    $("#delete_ea_panel").hide();
    $("[name='edit_ea']").val(this.id);
		var eaid = $("#edit_ea").val();
		var name = $("#" + this.id + "edit_educ_attain").val();
		$("[name='edit_educ_attainment']").val(name);
		$("#edit_ea-form").attr("action", "http://localhost/outsourcing/outsourcing-project/utilities/update_educ_attain/"+ eaid);
	});

	$(".delete_ea_button").click(function() {
		$("#delete_ea_panel").show();
    $("#add_ea_panel").hide();
    $("#edit_ea_panel").hide();
		$("#delete_ea").val(this.id);
		var eaid = $("#delete_ea").val();
		var name = $("#" + this.id + "delete_educ_attain").val();
		$("[name='delete_educ_attainment']").val(name);
		$("#educ_attain-form").attr("action", "http://localhost/outsourcing/outsourcing-project/utilities/delete_educ_attain/"+ eaid);
	});

	$('#add_ea-form').validate({
    rules: {
      add_educ_attainment: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      }
    },
    messages: {
      add_educ_attainment: {
        required: "Please enter educational attainment."
      }
    },
    errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass("error-mes");
          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".error-form" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
  });

  $('#edit_ea-form').validate({
    rules: {
      edit_educ_attainment: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      }
    },
    messages: {
      edit_educ_attainment: {
        required: "Please enter educational attainment."
      }
    },
    errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass("error-mes");
          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".error-form" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
  });

  $('#jobmatch_passrate_form').validate({
    rules: {
      jobmatch_passrate: {
        required: true,
        nowhitespace: true,
        digits: true
      }
    },
    messages: {
      jobmatch_passrate: {
        required: "Please enter the Job Match Passing Rate."
      }
    },
    errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass("error-mes");
          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".error-form" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
  });

  $('#agency_email-form').validate({
    rules: {
      a_pword: {
        required: true,
        nowhitespace: true
      },
      a_email: {
        required: true,
        nowhitespace: true
      }
    },
    messages: {
      a_pword: {
        required: "Please enter password."
      },
      a_email: {
        required: "Please enter e-mail."
      }
    },
    errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass("error-mes");
          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".error-form" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".error-form" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
  });
	
});


function returnAdd() { //return to add from edit
	$("#add_ea_panel").show();
  $("#edit_ea_panel").hide();
  $("#delete_ea_panel").hide();
}

function returnToAdd() { //return to add from delete
	$("#add_ea_panel").show();
	$("#delete_ea_panel").hide();
  $("#edit_ea_panel").hide();
}

function deleteEducAttain() {
	var eaid = $("#delete_ea").val();
	$("#delete_ea-form").attr("action", "http://localhost/outsourcing/outsourcing-project/utilities/delete_educ_attain/"+ eaid);
}