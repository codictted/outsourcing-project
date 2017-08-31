$(function() {

//EDUC ATTAIN//

	$("#edit_ea_panel").hide();

	$(".edit_ea_button").click(function() {
    $("#edit_ea_panel").show();
    $("#add_ea_panel").hide();
    $("[name='edit_ea']").val(this.id);
		var eaid = $("#edit_ea").val();
		var name = $("#" + this.id + "edit_educ_attain").val();
		$("[name='edit_educ_attainment']").val(name);
		$("#edit_ea-form").attr("action", "http://localhost/outsourcing/outsourcing-project/utilities/update_educ_attain/"+ eaid);
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


//JOB MATCH PASS RATE//
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


//AGENCY'S EMAIL//

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


//ESSAY QUESTIONS//
  
  $("#edit_eq_panel").hide();

  $(".edit_eq_button").click(function() {
    $("#edit_eq_panel").show();
    $("#add_eq_panel").hide();
    $("[name='edit_eq']").val(this.id);
    var eqid = $("#edit_eq").val();
    var name = $("#" + this.id + "edit_essayq").val();
    $("[name='edit_essay_question']").val(name);
    $("#edit_eq-form").attr("action", "http://localhost/outsourcing/outsourcing-project/utilities/update_essay_question/"+ eqid);
  });

  $('#add_eq-form').validate({
    rules: {
      add_essay_question: {
        required: true,
        nowhitespace: true
      }
    },
    messages: {
      add_essay_question: {
        required: "Please enter an essay question."
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

  $('#edit_eq-form').validate({
    rules: {
      edit_essay_question: {
        required: true,
        nowhitespace: true
      }
    },
    messages: {
      edit_essay_question: {
        required: "Please enter an essay question."
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

//return to add from edit (educ attain)
function returnAdd() {
  $("#add_ea_panel").show();
  $("#edit_ea_panel").hide();
}

function returnAddEssay() {
  $("#add_eq_panel").show();
  $("#edit_eq_panel").hide();
}