//change collor of header on scroll
$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});


//application tab
$(function () {
  var effect = {
        show: { effect: "fadeIn", duration: "slow" }
        };
  $('#application-tab, #legend, #application-details').tabs(effect);
});

//onload animation
$(function(){
  $(".slide-effect").hide(0).delay(300).slideDown(2000)
});

$(function(){
  $(".fade-effect").hide(0).delay(300).fadeIn(2000)
});

//require company name when company is selected as client type
$(function () {
  $("#contact_client_type").change(function () {
      var op = $(this).val();
      op == "1" ? 
      $("#comp_name, #client_nature").prop("required", true).prop("disabled", false) : 
      $("#comp_name, #client_nature").prop("required", false).prop("disabled", true);
  });
});

//form validation
//add method for exact length
$.validator.addMethod("exactlength", function(value, element, param) {
 return this.optional(element) || value.length == param;
}, $.validator.format("Please enter exactly {0} characters."));

//add method for regex
$.validator.addMethod("regex", function(value, element, regexpr) {
    var pattern = new RegExp(regexpr);
    return pattern.test(value);
}, "Invalid input");

//add method for white spaces
$.validator.addMethod("nowhitespace", function(value, element) { 
    return $.trim(value) && value != ""; 
  }, "White spaces are not allowed");

//form validation for contact us form
$(function () {
  $('#contact_us_form').validate({
    rules: {
      contact_name: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      contact_email: {
        required: true,
        nowhitespace: true,
        email: true
      },
      contact_contact_number: {
        digits: true,
        required: true,
        exactlength: 11
      },
      contact_tel_number: {
        digits: true,
        exactlength: 7
      },
      contact_street_address : {
        required: true,
        nowhitespace: true
      },
      contact_city_address : {
        required: true,
        nowhitespace: true
      },
      contact_province_address : {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      contact_zip_address: {
        required: true,
        nowhitespace: true,
        digits: true,
        exactlength: 4
      },
      inquiry: "required",
      client_username : {
        required: true,
        nowhitespace: true
      },
      client_password : {
        required: true,
        nowhitespace: true
      }
    },
    messages: {
      contact_client_type: {
        required: "Please choose a client type"
      },
      client_nature: {
        required: "Please choose a client type"
      },
      comp_name: {
        required: "Please enter company name"
      },
      contact_name: {
        required: "Please enter full name"
      },
      contact_email: {
        required: "Please enter email address",
        email: "Please enter a valid email address"
      },
      contact_contact_number: {
        required: "Please enter contact number",
        digits: "Invalid character"
      },
      contact_tel_number: {
        digits: "Invalid character"
      },
      contact_street_address: {
        required: "Please enter street address",
      },
      contact_city_address: {
        required: "Please enter city",
      },
      contact_province_address: {
        required: "Please enter province",
      },
      contact_zip_address: {
        required: "Please enter zip code",
        digits: "Invalid character"
      },
      inquiry: {
        required: "Please provide an inquiry"
      },
      client_username: {
        required: "Please provide client's username"
      },
      client_password: {
        required: "Please provide client's password"
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

  $('#category-form').validate({
    rules: {
      cat_name: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      }
    },
    messages: {
      cat_name: {
        required: "Please enter job category name."
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

  $('#requirement-form').validate({
    rules: {
      req_name: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      }
    },
    messages: {
      req_name: {
        required: "Please enter requirement name."
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

  $('#job-form').validate({
    rules: {
      job_name: {
        required: true,
        nowhitespace: true,
        regex: /^[a-zA-Z\s'-\.]+$/
      },
      job_cat: {
        required: true,
        nowhitespace: true,
        regex: /^[0-9]+$/
      },  
      job_sf: {
        required: true,
        nowhitespace: true,
        regex: /^[0-9,.]+$/
      }
    },
    messages: {
      job_name: {
        required: "Please enter job position name."
      },
      job_cat: {
        required: "Please choose job category."
      },  
      job_sf: {
        required: "Please enter job service fee."
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

$(function() {

  $("#job_capt").validate({

      rules: {
        captcha: {
          required: true,
          nowhitespace: true
        }
      },

      messages: {
        captcha: {
          required: "You must enter the captcha"
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

$(function () {
  
  $(".tr_click").click(function (){
    window.location.href='applicant_full_details';
  });


  $(".table-btn").click(function(event) {
    event.stopPropagation();
  });


  $(".modal-btn").click(function(event) {
    event.stopPropagation();
    var id = this.id;
    var a_id = id.split("-")[0];
    var mod = id.split("-")[1];
    $("#applicant_id").val(a_id);
    $("#" + mod).modal("show");

    var url = "http://localhost/outsourcing/admin/get_applicant_det/";
    $.ajax({
      dataType: "JSON",
      url: url + a_id,
      type: "GET",
      success: function(data) {

        $("[name='app_name']").html(data.first_name);
        $("#job_pos").html(data.jname);
        $("#app_number").val(data.mobile);
        $("[name='applicant_id']").val(a_id);
      }
    });

    if(mod=="requirements_modal") {

      url = "http://localhost/outsourcing/admin/get_applicant_require/";
      $.ajax({
      dataType: "JSON",
      url: url + a_id,
      type: "GET",
      success: function(data) {

        var populate = [];
        var string_tr = "";
        var date;
        var check;
        $.each(data, function(index, value) {

          date = value.is_submitted == 1 ? "N/A" : value.date_submitted; 
          check = value.is_submitted == 1 ?
          "<input type='checkbox' class='checkb' name='passed'>" :
          "<input type='checkbox' class='checkb' checked name='passed'>";
          string_tr = "<tr>";
          string_tr += "<td class='sub-label'>";
          string_tr += "<center>";
          string_tr += check;
          string_tr += "</center>";
          string_tr += "</td>";
          string_tr += "<td class='sub-label'>";
          string_tr += "<center>";
          string_tr += value.requirement;
          string_tr += "</center>";
          string_tr += "</td>";
          string_tr += "<td>";
          string_tr += "<center>";
          string_tr += date;
          string_tr += "</center>";
          string_tr += "</td>";
          string_tr += "</tr>";
          populate.push(string_tr);
        });//EACH


        $("#req_table").html(populate.join(''));
      }
    });//AJAX
    }//IF

    else if(mod=="shortlisted_modal") {

      url = "http://localhost/outsourcing/admin/get_shortlist_det/";
      $.ajax({
        dataType: "JSON",
        url: url + a_id,
        type: "GET",
        success: function(data) {

          
        }
      });//AJAX
    }//else if
  });

  $(".modal-btn-client").click(function(event) {
    event.stopPropagation();
    var id = this.id;
    var c_id = id.split("-")[0];
    var mod = id.split("-")[1];
    var c_name = id.split("-")[2];
    $("#client_id").val(c_id);
    $("[name='client-name']").html(c_name);
    $("#" + mod).modal("show");

    // var url = "http://localhost/outsourcing/admin/get_applicant_det/";
    // $.ajax({
    //   dataType: "JSON",
    //   url: url + a_id,
    //   type: "GET",
    //   success: function(data) {

    //     $("#app_name").html(data.first_name);
    //     $("#job_pos").html(data.jname);
    //     $("#app_number").val(data.mobile);
    //     $("[name='applicant_id']").val(a_id);
    //   }
    // });
  });
});

$(function (){
  $("#show_load").click(function () {
    $("#generate-match").modal("hide");
    $("#loading").modal("show");
    setTimeout(
    function() {
      window.location.href='applist_matched';
    }, 3000);
  });
});