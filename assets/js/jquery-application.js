$(function() {

//birthplace same as address
	$("#same_address").change(function() {
		if(this.checked) {
			$('[name="bstreet"]').val($("#street").val());
			$('[name="bcity"]').val($("#city").val());
			$('[name="bprovince"]').val($("#province").val());
			$('[name="bzip"]').val($("#zip").val());
		}
		else {
			$('[name="bstreet"]').val('');
			$('[name="bcity"]').val('');
			$('[name="bprovince"]').val('');
			$('[name="bzip"]').val('');
		}
	});

	//add fields for descendants
	$("#add_descendant").click(function() {

		$("#div-descendants").clone(true).appendTo("#descendants");
		$("#div-descendants").removeAttr("id");
		$('div[id="div-descendants"] button[id="add_descendant"]').remove();
		$('div[id="div-descendants"] span[id="des_help"]').remove();
		$('div[id="div-descendants"] input[name="d_name[]"]').val('');
	});


	//add fields for employers
	$("#add_emp").click(function() {

		$("#div-employer").clone(true).appendTo("#employers");
		$("<hr>").appendTo("#div-employer");
		$("#div-employer").removeAttr("id");
		$('div[id="div-employer"] button[id="add_emp"]').remove();
		$('div[id="div-employer"] span[id="emp_help"]').remove();
    $('div[id="div-employer"] input[name="employer[]"]').val('');
    $('div[id="div-employer"] input[name="emp_address[]"]').val('');
	});


	//add fields for seminar
	$("#add_sem").click(function() {

		$("#div-seminar").clone(true).appendTo("#seminars");
		$("<hr>").appendTo("#div-seminar");
		$("#div-seminar").removeAttr("id");
		$('div[id="div-seminar"] button[id="add_sem"]').remove();
		$('div[id="div-seminar"] span[id="sem_help"]').remove();
    $('div[id="div-employer"] input[name="traning_title[]"]').val('');
    $('div[id="div-employer"] input[name="training_org[]"]').val('');
    $('div[id="div-employer"] input[name="training_addres[]"]').val('');
	});

	//form validation

$('#application-form').validate({
    rules: {
      fname: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      lname: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      cnum: {
        digits: true,
        required: true,
        exactlength: 11
      },
      tnum: {
        digits: true,
        exactlength: 7
      },
      street: {
        required: true,
        nowhitespace: true
      },
      city: {
        required: true,
        nowhitespace: true
      },
      province: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      zip: {
        digits: true,
        exactlength: 4
      },
      bstreet: {
        required: true,
        nowhitespace: true
      },
      bcity: {
        required: true,
        nowhitespace: true
      },
      bprovince: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      bzip: {
        digits: true,
        exactlength: 4
      },
      guardian: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      g_relation: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      g_contact: {
        digits: true,
        required: true,
        exactlength: 11
      }
    },
    messages: {
      job_pos: {
        required: "Please choose a job position"
      },
      fname: {
        required: "Please enter your first name"
      },
      lname: {
        required: "Please enter your last name"
      },
      civil: {
        required: "Please choose your civil status"
      },
      nationality: {
        required: "Please choose your nationality"
      },
      cnum: {
        required: "Please enter your contact number",
        digits: "Invalid character"
      },
      tnum: {
        digits: "Invalid character"
      },
      street: {
        required: "Please enter street address",
      },
      city: {
        required: "Please enter city",
      },
      province: {
        required: "Please enter province",
      },
      zip: {
        // required: "Please enter zip code",
        digits: "Invalid character"
      },
      bstreet: {
        required: "Please enter street address",
      },
      bcity: {
        required: "Please enter city",
      },
      bprovince: {
        required: "Please enter province",
      },
      bzip: {
        //required: "Please enter zip code",
        digits: "Invalid character"
      },
      // religion: {
      //   required: "Please choose your religion"
      // },
      education: {
        required: "Please choose your highest educational attainment"
      },
      level: {
        required: "Please choose your year level"
      },
      guardian: {
        required: "Please enter your guardian's name"
      },
      g_relation: {
        required: "Please enter your relationship to your guardian"
      },
      g_contact: {
        required: "Please enter your guardian's contact number"
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


  $("#spoken-ms").magicSuggest({
    
  });
});