var d4mpostalcode_status_check = d4mpostalcode_statusObj.d4mpostalcode_status;
var d4mpostalcode_zip_status = d4mpostalcode_statusObj.zip_show_status;
var guest_user_status ="off";
var get_all_postal_code = [];
/* front language dropdown show hide list */
jQuery(document).on("click",".select-custom",function() {
  jQuery(".common-selection-main").addClass("clicked");
  jQuery(".custom-dropdown").slideDown();
});
/* front language select on click on custom */
jQuery(document).on("click",".seled4mcustom",function() {
  jQuery("#selected_custom").html(jQuery(this).html());
  jQuery(".common-selection-main").removeClass("clicked");
  jQuery(".custom-dropdown").slideUp();
});
/* tooltipster jquery */
jQuery(document).ready(function() {
  jQuery(document).on("click", "#otp_model_close", function() {
    jQuery('#verify_otp').modal('hide');
    jQuery(".checkmark").hide();
  });

  jQuery(".fancy_input").on("keyup", function() {
    if (jQuery(this).val().length > 0) {
      jQuery(this).parent().addClass("focused_label_wrap");
    } else if (jQuery(this).val().length <= 0) {
      jQuery(this).parent().removeClass("focused_label_wrap");
    }
  });
  jQuery(".phone_no_wrap .fancy_input").on("keyup", function() {
    if (jQuery(this).val().length > 0) {
      jQuery(".phone_no_wrap").addClass("focused_label_wrap");
    } else if (jQuery(this).val().length <= 0) {
      jQuery(".phone_no_wrap").removeClass("focused_label_wrap");
    }
  });
  jQuery(".d4m-tooltip").tooltipster({
    animation: "grow",
    delay: 20,
    theme: "tooltipster-shadow",
    trigger: "hover"
  });
  jQuery(".d4m-tooltipss").tooltipster({
    animation: "grow",
    delay: 20,
    theme: "tooltipster-shadow",
    trigger: "hover"
  });
  jQuery(".d4m-tooltip-services").tooltipster({
    animation: "grow",
    side: "bottom",
    interactive : "true",
    theme: "tooltipster-shadow",
    trigger: "hover",
    delayTouch : 300,
    maxWidth:400,
    functionPosition: function(instance, helper, position){
      position.coord.top -= 25;
      return position;
    },
    contentAsHTML : "true"
  });

  jQuery(".d4m-tooltip-services-addons").tooltipster({
    animation: "grow",
    side: "bottom",
    interactive : "true",
    theme: "tooltipster-shadow",
    trigger: "hover",
    delayTouch : 300,
    maxWidth:400,
    functionPosition: function(instance, helper, position){
      position.coord.top -= 25;
      return position;
    },
    contentAsHTML : "true"
  });

  
  /* card payment validations */
  jQuery("input.cc-number").payment("formatCardNumber");
  jQuery("input.cc-cvc").payment("formatCardCVC");  
  jQuery("input.cc-exp-month").payment("restrictNumeric");
  jQuery("input.cc-exp-year").payment("restrictNumeric");
  jQuery("body").niceScroll();
  jQuery(".common-data-dropdown").niceScroll();
  jQuery(".d4m-services-dropdown").niceScroll();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var frequently_discount_name=jQuery("input[name=frequently_discount_radio]:checked").attr("data-name");
  if(frequently_discount_id == 0){
    jQuery(".f_dis_img").hide();
  }else{
    jQuery(".f_dis_img").show();
    jQuery(".f_discount_name").text(frequently_discount_name);
  }
  jQuery(".d4m-loading-main").hide();
    var subheader_status=subheaderObj.subheader_status;
    if(subheader_status == "Y"){
      jQuery(".d4m-sub").show();
    }else{
      jQuery(".d4m-sub").hide();
    }
  if(d4mpostalcode_status_check == "Y"){
    jQuery(".d4mremove_id").attr("id","");
    jQuery(document).on("click",".d4mremove_id",function(){
      jQuery("#d4mpostal_code").focus();
      jQuery("#d4mpostal_code").keyup();
    });
  }
  jQuery(".d4m-sub").show();
  jQuery(".d4m-loading-main-complete_booking").hide();
  jQuery(".remove_guest_user_preferred_email").hide();
  jQuery(".show_methods_after_service_selection").hide();
  jQuery(".freq_discount_display").hide();
  jQuery(".hide_allsss_addons").hide();
  jQuery(".partial_amount_hide_on_load").hide();
  jQuery(".hide_right_side_box").hide();
  jQuery(".client_logout").hide();
  jQuery(".postal_code_error").show();
  jQuery(".postal_code_error").html(errorobj_please_enter_postal_code);
  jQuery(".hideservice_name").hide();
  jQuery(".hidedatetime_value").hide();
  jQuery(".hideduration_value").hide();
  jQuery(".s_m_units_design_1").hide();
  jQuery(".s_m_units_design_2").hide();
  jQuery(".s_m_units_design_3").hide();
  jQuery(".s_m_units_design_4").hide();
  jQuery(".s_m_units_design_5").hide();
  jQuery(".d4m-provider-list").hide();
  /*Coupon Apply*/
  jQuery(".d4m-display-coupon-code").hide();
  jQuery(".coupon_display").hide();

  /* Jay */
  jQuery(".user_coupon_display").hide();
  jQuery(".d4m-display-user-coupon-code").hide();
  /* */

  /* Jay */
  jQuery(".d4m-display-referral-code").hide();
  /* */

  /* user contact no. */
  var site_url=siteurlObj.site_url;
  var country_alpha_code = countrycodeObj.alphacode;
  var allowed_country_alpha_code = countrycodeObj.allowed;
  var array = allowed_country_alpha_code.split(",");
  var phone_visi = phone_status.statuss;
  if(phone_visi == "on"){
    if(allowed_country_alpha_code = ""){
      jQuery("#d4m-user-phone").intlTelInput({
        onlyCountries: array,
        autoPlaceholder: false,
        utilsScript: site_url+"assets/js/utils.js"
      });
      jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
      jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
    } else {
      jQuery("#d4m-user-phone").intlTelInput({
        autoPlaceholder: false,
        utilsScript: site_url+"assets/js/utils.js"
      });
      jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
      jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
    }
  }
  /*  create the back to top button */
  jQuery("body").prepend('<a href="javascript:void(0)" class="d4m-back-to-top"></a>');
  var amountScrolled = 500;
  jQuery(window).scroll(function() {
    if ( jQuery(window).scrollTop() > amountScrolled ) {
      jQuery("a.d4m-back-to-top").fadeIn("slow");
    } else {
      jQuery("a.d4m-back-to-top").fadeOut("slow");
    }
  });
  jQuery("a.d4m-back-to-top, a.d4m-simple-back-to-top").click(function() {
    jQuery("html, body").animate({ scrollTop: 0 }, 2000);
    return false;
  });
  var password_check = check_password;
  jQuery("#user_login_form").validate({
    rules: {
      d4muser_name:{ required:true,email:true},
      d4muser_pass:{ required: true,minlength:password_check.min,maxlength:password_check.max}
    },
    messages: {
      d4muser_name:{ required:errorobj_please_enter_email_address,email : errorobj_please_enter_valid_email_address},
      d4muser_pass:{ required: errorobj_please_enter_password, minlength:errorobj_min_ps, maxlength:errorobj_max_ps}
    }
  });
  var front_url=fronturlObj.front_url;
  jQuery.validator.addMethod("pattern_phone", function(value, element) {
    return this.optional(element) || /^[0-9+]*$/.test(value);
  }, "Enter Only Numerics");
  jQuery.validator.addMethod("pattern_zip", function(value, element) {
    return this.optional(element) || /^[a-zA-Z 0-9\-\ ]*$/.test(value);
  }, "Enter Only Alphabets");
  jQuery.validator.addMethod("pattern_name", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ']+$/.test(value);
  }, "Enter Only Alphabets");
  jQuery.validator.addMethod("pattern_city_state", function(value, element) {
    return this.optional(element) || /^[a-zA-Z &]+$/.test(value);
  }, "Enter Only Alphabets");
  var phone_check =phone_status;
  var password_check =check_password;
  var fn_check =check_fn;
  var ln_check =check_ln;
  var address_check =check_addresss;
  var zip_check =check_zip_code;
  var city_check =check_city;
  var state_check =check_state;
  var notes_check =check_notes;
  /* validaition condition*/
  jQuery("#user_details_form").validate();
  if(appoint_details.status == "on"){
    if(check_addresss.statuss=="on" &&  check_addresss.required=="Y"){ 
      jQuery("#app-street-address").rules("add", 
      { required: true,minlength:check_addresss.min,maxlength:check_addresss.max,
      messages: { required: errorobj_req_sa, minlength:errorobj_min_sa, maxlength:errorobj_max_sa}});
    }
    if(check_zip_code.statuss=="on" &&  check_zip_code.required=="Y"){ 
      jQuery("#app-zip-code").rules("add", { required: true,minlength:check_zip_code.min,maxlength:check_zip_code.max, messages: { required: errorobj_req_zc, minlength:errorobj_min_zc, maxlength:errorobj_max_zc}});
    }
    if(check_city.statuss=="on" &&  check_city.required=="Y"){ 
      jQuery("#app-city").rules("add", 
      { required: true,minlength:check_city.min,maxlength:check_city.max,
      messages: { required: errorobj_req_ct, minlength:errorobj_min_ct, maxlength:errorobj_max_ct}});
    }
    if(check_state.statuss=="on" &&  check_state.required=="Y"){ 
      jQuery("#app-state").rules("add", 
      { required: true,minlength:check_state.min,maxlength:check_state.max,
      messages: { required: errorobj_req_st, minlength:errorobj_min_st, maxlength:errorobj_max_st
      }});
    }
  }
  if(fn_check.statuss=="on" &&  fn_check.required=="Y"){ 
    jQuery("#d4m-first-name").rules("add", 
    { required: true,minlength:fn_check.min,maxlength:fn_check.max,pattern_name:true,
    messages: { required: errorobj_req_fn, minlength:errorobj_min_fn, maxlength:errorobj_max_fn}});
  }
  if(ln_check.statuss=="on" &&  ln_check.required=="Y"){ 
    jQuery("#d4m-last-name").rules("add", 
    { required: true,minlength:ln_check.min,maxlength:ln_check.max,pattern_name:true,
    messages: { required: errorobj_req_ln, minlength:errorobj_min_ln, maxlength:errorobj_max_ln}});
  }
  if(phone_check.statuss=="on" &&  phone_check.required=="Y"){ 
    jQuery("#d4m-user-phone").rules("add", 
    { required: true,minlength:phone_check.min,maxlength:phone_check.max,
    messages: { required: errorobj_req_ph, minlength:errorobj_min_ph, maxlength:errorobj_max_ph}});
  }
  if(address_check.statuss=="on" &&  address_check.required=="Y"){ 
    jQuery("#d4m-street-address").rules("add", 
    { required: true,minlength:address_check.min,maxlength:address_check.max,
    messages: { required: errorobj_req_sa, minlength:errorobj_min_sa, maxlength:errorobj_max_sa}});
  }
  if(zip_check.statuss=="on" &&  zip_check.required=="Y"){ 
    jQuery("#d4m-zip-code").rules("add", 
    { required: true,minlength:zip_check.min,maxlength:zip_check.max,
    messages: { required: errorobj_req_zc, minlength:errorobj_min_zc, maxlength:errorobj_max_zc}});
  }
  if(city_check.statuss=="on" &&  city_check.required=="Y"){ 
    jQuery("#d4m-city").rules("add", 
    { required: true,minlength:city_check.min,maxlength:city_check.max,
    messages: { required: errorobj_req_ct, minlength:errorobj_min_ct, maxlength:errorobj_max_ct}});
  }
  if(state_check.statuss=="on" &&  state_check.required=="Y"){ 
    jQuery("#d4m-state").rules("add", 
    { required: true,minlength:state_check.min,maxlength:state_check.max,
    messages: { required: errorobj_req_st, minlength:errorobj_min_st, maxlength:errorobj_max_st}});
  }
  if(notes_check.statuss=="on" &&  notes_check.required=="Y"){ 
    jQuery("#d4m-notes").rules("add", 
    { required: true,minlength:notes_check.min,maxlength:notes_check.max,
    messages: { required: errorobj_req_srn, minlength:errorobj_min_srn, maxlength:errorobj_max_srn}});
  }
  if(password_check.statuss=="on" &&  password_check.required=="Y"){
    jQuery("#d4m-preffered-pass").rules("add", 
    { required: true,minlength:password_check.min,maxlength:password_check.max,
    messages: { required: errorobj_please_enter_password, minlength:errorobj_min_ps, maxlength:errorobj_max_ps}});
    
    jQuery("#d4m-email").rules("add", 
    { required:true, email:true, remote: {
      url:front_url+"firststep.php",
      type: "POST",
      async:false,
      data: {
        email: function(){ return jQuery("#d4m-email").val(); },
        action:"check_user_email"
      }
    },
    messages: { required:errorobj_please_enter_email_address,email: errorobj_please_enter_valid_email_address,remote: errorobj_email_already_exists}});
  }
  /* end validaition condition*/
  if(jQuery(".guest-user").is(":checked")) {
    jQuery("#d4m-email-guest").val("");
    jQuery("#d4m-user-name").val("");
    jQuery("#d4m-user-pass").val("");
    jQuery("#d4m-preffered-name").val("");
    jQuery("#d4m-preffered-pass").val("");
    jQuery("#d4m-first-name").val("");
    jQuery("#d4m-last-name").val("");
    jQuery("#d4m-email").val("");
    jQuery("#d4m-user-phone").val("");
    jQuery("#d4m-street-address").val("");
    jQuery("#d4m-zip-code").val("");
    jQuery("#d4m-city").val("");
    jQuery("#d4m-state").val("");
    jQuery("#d4m-notes").val("");
    jQuery(".d4m-new-user-details").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-login-existing").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").show( "blind", {direction: "vertical"}, 300);
    jQuery(".remove_preferred_password_and_preferred_email").hide( "blind", {direction: "vertical"}, 300);    
    jQuery(".remove_guest_user_preferred_email").show( "blind", {direction: "vertical"}, 300);
    if(jQuery( ".remove_zip_code_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_zip_code_class").removeClass("d4m-md-4");
      jQuery(".remove_zip_code_class").addClass("d4m-md-6");
    }
    if(jQuery( ".remove_city_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_city_class").removeClass("d4m-md-4");
      jQuery(".remove_city_class").addClass("d4m-md-6");
    }
    if(jQuery( ".remove_state_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_state_class").removeClass("d4m-md-4");
      jQuery(".remove_state_class").addClass("d4m-md-6");
    }
    guest_user_status ="on";
  }
  jQuery(".space_between_date_time").hide();
  jQuery(".special_day").hide();                           
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  jQuery.ajax({
    type:"POST",
    url: ajax_url+"calendar_ajax.php",
    data : { "get_calendar_on_page_load" : 1 },
    success: function(res){
      jQuery(".cal_info").html(res);
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var year = d.getFullYear();
      var output = day + "-" +(month<10 ? "0" : "") + month + "-" +  year;
      var selected_dates = jQuery(".selected_date").data("selected_dates");
      var cur_dates = jQuery(".selected_date").data("cur_dates");
      if(output == cur_dates){
        jQuery(".by_default_today_selected").addClass("active_today");
      }
      do4me_sidebar_scroll();
    }
  });
  jQuery.ajax({
    type:"POST",
    url: ajax_url+"front_ajax.php",
    data : { "get_postal_code" : 1 },
    success: function(res){
      get_all_postal_code = jQuery.parseJSON(res);
    }
  });
  /* validation for reset_password.php */
  jQuery("#forget_pass").submit(function(event){
    event.preventDefault();
    event.stopImmediatePropagation();
  });
  jQuery("#forget_pass").validate({
    rules: {
      rp_user_email: {
        required: true,
        email: true,
      }
    },
    messages:{
      rp_user_email: {
        required : errorobj_please_enter_email_address,
        email : errorobj_please_enter_valid_email_address
      },
    }
  });
  /* validation for reset_new_password.php */
  jQuery("#reset_new_passwd").submit(function(event){
    event.preventDefault();
    event.stopImmediatePropagation();
  });
  jQuery.validator.addMethod("noSpace", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
  }, "No space allowed");
  jQuery("#reset_new_passwd").validate({
    rules: {
      n_password: {
        required: true,
        minlength: 8,
        maxlength: 10,
        noSpace: true
      },
      rn_password: {
        required: true,
        minlength: 8,
        maxlength: 10,
        noSpace: true
      }
    },
    messages:{
      n_password: {
        required : errorobj_please_enter_new_password,
        minlength: errorobj_password_must_be_8_character_long,
        maxlength: errorobj_please_enter_maximum_10_chars
      },
      rn_password: {
        required: errorobj_please_enter_confirm_password,
        minlength: errorobj_password_must_be_8_character_long,
        maxlength: errorobj_please_enter_maximum_10_chars
      },
    }
  });
  var front_url=fronturlObj.front_url;
  jQuery.ajax({
    type : "post",
    data: { check_for_option : 1 },
    url : front_url+"firststep.php",
    success : function(res){      
      if(jQuery.trim(res) != ""){
        window.location=front_url+"maintainance.php";
      }
    }
  });
  jQuery('[data-toggle="tooltip"]').tooltip({"placement": "right"});
  if(is_login_user == "Y"){
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    jQuery(".add_show_error_class_for_login").each(function(){
      jQuery(this).trigger("keyup");
    });
    jQuery(".add_show_error_class").each(function(){
      var id = jQuery(this).attr("id");
      jQuery( this ).removeClass("error");
      jQuery( "#"+id ).parent().removeClass("error");
      jQuery( this ).removeClass("show-error");
      jQuery( "#"+id ).parent().removeClass("show-error");
      jQuery( ".intl-tel-input" ).parent().removeClass("show-error");
    });
    var existing_username = jQuery("#d4m-user-name").val();
    var existing_password = jQuery("#d4m-user-pass").val();
    if(!jQuery("#user_login_form").valid()){ return false; }
    dataString={action:"get_login_user_data"};
    jQuery.ajax({
      type:"POST",
      url:ajax_url+"front_ajax.php",
      data:dataString,
      success:function(response){
        var userdata=jQuery.parseJSON(response);
        if(userdata.status == "No Login"){
          is_login_user = "N";
          jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
          return false;
        }else if(userdata.status == "Incorrect Email Address or Password"){
          is_login_user = "N";
          jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
          return false;
        }else{
          is_login_user = "Y";
          jQuery("#check_login_click").val("clicked");
          jQuery(".client_logout").css("display","block");
          jQuery(".client_logout").show();
          jQuery(".fname").text(userdata.firstname);
          jQuery(".lname").text(userdata.lastname);
          jQuery("#d4m-email").val(userdata.email);
          jQuery("#d4m-user-name").val(userdata.email);
          jQuery("#existing-user").attr("checked", true);
          jQuery(".hide_login_btn").hide();
          jQuery(".hide_radio_btn_after_login").hide();
          jQuery(".hide_email").hide();
          jQuery(".hide_login_email").hide();
          jQuery(".hide_password").hide();
          jQuery(".d4m-peronal-details").show();
          jQuery(".login_unsuccessfull").hide();
          jQuery(".d4m-new-user-details").hide();
          jQuery(".d4m-sub").hide();
          jQuery("#d4m-first-name").val(userdata.firstname);
          jQuery("#d4m-last-name").val(userdata.lastname);
          jQuery("#d4m-user-phone").intlTelInput("setNumber", userdata.phone);
          if(check_addresss.statuss=="on"){ jQuery("#d4m-street-address").val(userdata.address); }
          if(check_zip_code.statuss=="on"){  jQuery("#d4m-zip-code").val(userdata.zip); }
          if(check_city.statuss=="on"){  jQuery("#d4m-city").val(userdata.city); }
          if(check_state.statuss=="on"){  jQuery("#d4m-state").val(userdata.state); }
          jQuery("#d4m-notes").val(userdata.notes);
          if(userdata.vc_status == "N"){
            jQuery("#vaccum-no").attr("checked", true);
          }else{
            jQuery("#vaccum-yes").attr("checked", true);
          }
          if(userdata.p_status == "N"){
            jQuery("#parking-no").attr("checked", true);
          }else{
            jQuery("#parking-yes").attr("checked", true);
          }
          var con_staatus = userdata.contad4mstatus;
          if(con_staatus == "I'll be at home" || con_staatus == "Please call me" || con_staatus == "The key is with the doorman"){
            jQuery("#contad4mstatus").val(userdata.contad4mstatus);
          }else{
            jQuery("#contad4mstatus").val("Other");
            jQuery(".d4m-option-others").show();
            jQuery("#other_contad4mstatus").val(userdata.contad4mstatus);
          }
          jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
        }
      }
    });
  }
});


/* scroll to next step */
jQuery(document).on("click",".d4m-service",function() {
  jQuery("html, body").stop().animate({ "scrollTop": jQuery(".d4m-scroll-meth-unit").offset().top - 30 }, 800, "swing", function () {});
});
/* forget password */
jQuery(document).on("click","#d4mforget_password",function() {
  jQuery("#rp_user_email").val("");
  jQuery(".forget_pass_correct").hide();
  jQuery(".forget_pass_incorrect").hide();
  jQuery(".d4m-front-forget-password").addClass("show-data");
  jQuery(".d4m-front-forget-password").removeClass("hide-data");
  jQuery(".main").css("display", "block");
});
jQuery(document).on("click","#d4mlogin_user",function() {
  jQuery(".d4m-front-forget-password").removeClass("show-data");
  jQuery(".d4m-front-forget-password").addClass("hide-data");
  jQuery(".main").css("display", "none");
});
/* dropdown services list */
/* services dropdown show hide list */
jQuery(document).on("click",".service-is",function() {
  jQuery(".d4m-services-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".seled4mservice",function() {
  jQuery("#d4mselected_service").html(jQuery(this).html());
  jQuery(".d4m-services-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});
/* select hours based service */
jQuery(document).on("click",".d4m-duration-btn",function() {
  jQuery(".d4m-duration-btn").each(function(){
    jQuery(this).removeClass("duration-box-selected");
  });
  jQuery(this).addClass("duration-box-selected");
});
/* for show how many addon counting when checked */
jQuery(document).on("click",'input[type="checkbox"]',function() {
	
  if(jQuery(".addon-checkbox").is(":checked")) {
    jQuery(".common-selection-main.addon-select").show();
  } else {
    jQuery(".common-selection-main.addon-select").hide();
  }
});
/* addons */
jQuery(document).on("click",".d4m-addon-btn",function() {
  var curr_methodname = jQuery(this).attr("data-method_name");
  jQuery(".d4m-addon-btn").each(function(){
    if(jQuery(this).attr("data-method_name") == curr_methodname){
      jQuery(this).removeClass("d4m-addon-selected");
    }
  });
  jQuery(this).addClass("d4m-addon-selected");
});
/* checkout payment method listing show hide */
jQuery(document).on("click",".cccard",function() {
  var test = jQuery(this).val();
  jQuery(".common-payment-style").show("blind", {direction: "vertical"}, 300);
});
jQuery(document).on("click","input[name=payment-methods]",function() {
  var abc = jQuery(this).val();

  if(jQuery(this).hasClass("cccard")) {
    jQuery(".common-payment-style-bank-transfer").hide();
    jQuery(".partial_amount_hide_on_load").hide();
		jQuery("#wallet").removeAttr('checked');
  } else if(jQuery(this).hasClass("pay-cash")){
    jQuery(".common-payment-style").hide();
    jQuery(".common-payment-style-bank-transfer").hide();
    jQuery(".partial_amount_hide_on_load").hide();
    jQuery("#wallet").removeAttr('checked');
  } else {
    jQuery(".common-payment-style").hide();
    jQuery(".common-payment-style-bank-transfer").hide();
    jQuery(".partial_amount_hide_on_load").hide();
    jQuery("#pay-cash").removeAttr('checked');
    jQuery("#pay-card").removeAttr('checked');
  }
});

/* bank transfer */
jQuery(document).on("click",".bank_transfer",function() {
  jQuery(".common-payment-style-bank-transfer").show("blind", {direction: "vertical"}, 300);
	jQuery("#wallet").removeAttr('checked');
});
jQuery(document).on("click","input[name=payment-methods]",function() {
  if(jQuery(this).hasClass("bank_transfer")) {
    jQuery(".common-payment-style").hide();
  } else {
    jQuery(".common-payment-style-bank-transfer").hide();
  }
});
/* see more instructions in service popup */
jQuery(document).on("click",".show-more-toggler",function() {
  jQuery(".bullet-more").toggle( "blind", {direction: "vertical"}, 500);
  jQuery(".show-more-toggler:after").addClass("rotate");
});
/* right side scrolling cart */
var scrollable_cart_value=scrollable_cartObj.scrollable_cart;
if(scrollable_cart_value == "Y"){
  function do4me_sidebar_scroll(){
    var $sidebar   = jQuery(".d4m-price-scroll"),
      $window    = jQuery(window),
      offset     = $sidebar.offset(),
      sel_service = jQuery(".sel-service").text();
      
    if(sel_service != ""){
      $window.scroll(function() {
        if(offset.top > $window.scrollTop()){
          $sidebar.stop().animate({
            marginTop: 20
          });
        }else{
          $sidebar.stop().animate({
            marginTop: ($window.scrollTop() - offset.top) + 40
          });
        }
      });
    }else{
      $window.scroll(function() {
        if(offset.top > $window.scrollTop()){
          $sidebar.stop().animate({
            marginTop: 20
          });
        }else{
          $sidebar.stop().animate({
            marginTop: ($window.scrollTop() - offset.top) + 20
          });
        }
      });
    }
  }
}else{
  function do4me_sidebar_scroll(){}
}
/************* Code by developer side --- ****************/
jQuery(document).on("keyup keydown blur",".add_show_error_class",function(event){
  var id = jQuery(this).attr("id");
  var Number = /(?:\(?\+\d{2}\)?\s*)?\d+(?:[ -]*\d+)*$/;
  if(jQuery(this).hasClass("error")){
    jQuery( this ).removeClass("error");
    jQuery( "#"+id ).parent().removeClass("error");
    jQuery( this ).addClass("show-error");
    jQuery( "#"+id ).parent().addClass("show-error");
    if(jQuery("#d4m-user-phone").val() != ""){
      if(!jQuery("#d4m-user-phone").val().match(Number)){
        jQuery( ".intl-tel-input" ).parent().addClass("show-error");
      }
    }
  }else{
    jQuery( this ).removeClass("error");
    jQuery( "#"+id ).parent().removeClass("error");
    jQuery( this ).removeClass("show-error");
    jQuery( "#"+id ).parent().removeClass("show-error");
    if(jQuery("#d4m-user-phone").val() != ""){
      if(jQuery("#d4m-user-phone").val().match(Number)){
        jQuery( ".intl-tel-input" ).parent().removeClass("show-error");
      }
    }
  }
});
jQuery(document).on("keyup keydown blur",".add_show_error_class_for_login",function(event){
  var id = jQuery(this).attr("id");
  if(jQuery(this).hasClass("error")){
    jQuery( this ).removeClass("error");
    jQuery( "#"+id ).parent().removeClass("error");
    jQuery( this ).addClass("show-error");
    jQuery( "#"+id ).parent().addClass("show-error");
  }else{
    jQuery( this ).removeClass("error");
    jQuery( "#"+id ).parent().removeClass("error");
    jQuery( this ).removeClass("show-error");
    jQuery( "#"+id ).parent().removeClass("show-error");
  }
});
jQuery(document).ready(function(){
  var two_checkout_status = twocheckout_Obj.twocheckout_status;
  if(two_checkout_status == "Y"){
    TCO.loadPubKey("sandbox");
  }
});
var clicked = false;
jQuery(document).ready(function () {
  jQuery(document).on("change","#recurrence-booking",function () {
    var recurrence_booking = jQuery("#recurrence-booking").prop("checked");
    if(recurrence_booking == true){
      jQuery(".recurrence_type_dropdown").show();
      jQuery(".recurrence_type_dropdown").show();
    } else{
      jQuery(".recurrence_type_dropdown").hide();
      jQuery(".recurrence_type_dropdown").hide();
    }
  });
});

jQuery(document).on("click","#complete_bookings",function(e){
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var front_url=fronturlObj.front_url;
  var stripe_pubkey = baseurlObj.stripe_publishkey;
  var stripe_status = baseurlObj.stripe_status;   
  if(stripe_status=="on"){  Stripe.setPublishableKey(stripe_pubkey);  }
  var terms_condition_setting_value=termsconditionObj.terms_condition;
  var privacy_policy_setting_value=privacypolicyObj.privacy_policy;
  var thankyou_page_setting_value=thankyoupageObj.thankyou_page;
  var existing_username = jQuery("#d4m-user-name").val();
  var existing_password = jQuery("#d4m-user-pass").val();
  var password = jQuery("#d4m-preffered-pass").val();
  var firstname = jQuery("#d4m-first-name").val();
  var lastname = jQuery("#d4m-last-name").val();
  var email = "";
  if(guest_user_status == "on"){
    email = jQuery("#d4m-email-guest").val();
  }else{
    if(is_login_user == "Y"){
      email = existing_username;
    }else{
      email = jQuery("#d4m-email").val();
    }
  }
  var phone = jQuery("#d4m-user-phone").val();
  /***newly added start***/
  var user_address = jQuery("#d4m-street-address").val();
  var user_zipcode = jQuery("#d4m-zip-code").val();
  var user_city = jQuery("#d4m-city").val();
  var user_state = jQuery("#d4m-state").val();
  if(appoint_details.status == "on"){
    if(check_addresss.status="on"){ var address = jQuery("#app-street-address").val(); }
    else { var address = jQuery("#d4m-street-address").val(); }
    if(check_zip_code.status="on"){ var zipcode = jQuery("#app-zip-code").val(); }
    else { var zipcode = jQuery("#d4m-zip-code").val(); }
    if(check_city.status="on"){ var city = jQuery("#app-city").val(); }
    else { var city = jQuery("#d4m-city").val(); }
    if(check_state.status="on"){ var state = jQuery("#app-state").val(); }
    else { var state = jQuery("#d4m-state").val(); }
  }
  else {
    var address = jQuery("#d4m-street-address").val();
    var zipcode = jQuery("#d4m-zip-code").val();
    var city = jQuery("#d4m-city").val();
    var state = jQuery("#d4m-state").val();
  }
  var notes = jQuery("#d4m-notes").val();
  var payment_method = jQuery(".payment_gateway:checked").val();
  /** new **/
  var staff_id = jQuery(".provider_disable:checked").attr("data-staff_id");
  if(staff_id == undefined){
    var staff_id = "";
  } else {
    var staff_id = staff_id;
  }
  var v_c_status = jQuery(".vc_status").prop("checked");
  var vc_status = "";
   if(v_c_status == undefined){
    vc_status = "-";
  }else{
    if(v_c_status == true){ vc_status = "Y"; }else{ vc_status = "N"; }
  }
  var prkng_status = jQuery(".p_status").prop("checked");
  var p_status = "";
  if(prkng_status == undefined){
    p_status = "-";
  }else{
    if(prkng_status == true){ p_status = "Y"; }else{ p_status = "N"; }
  }
  var con_status = jQuery("#contad4mstatus").val();
  var contad4mstatus = "";
  if(con_status == "Other"){
    contad4mstatus = jQuery("#other_contad4mstatus").val();
  }else if(con_status == undefined){
    contad4mstatus = "";
  }
  else{
    contad4mstatus = jQuery("#contad4mstatus").val();
  }
  var terms_condition = jQuery("#accept-conditions").prop("checked");
  var tc_check="N";
  if(terms_condition_setting_value == "Y" || privacy_policy_setting_value == "Y"){
    if(terms_condition == true){
      tc_check="Y";
    }
  }else{
    tc_check="Y";
  }
  var booking_date_text = jQuery(".cart_date").text();
  var booking_date = jQuery(".cart_date").attr("data-date_val");
  var booking_time = jQuery(".cart_time").attr("data-time_val");
  var booking_time_text = jQuery(".cart_time").text();
  var booking_date_time = booking_date+" "+booking_time;
  var currency_symbol = jQuery(this).attr("data-currency_symbol");
  var cart_sub_total=jQuery(".cart_sub_total").text();
  var amount = cart_sub_total.replace(currency_symbol, "");
  var cart_discount=jQuery(".cart_discount").text().substring(2);
  var discount = cart_discount.replace(currency_symbol, "");
  var cart_tax=jQuery(".cart_tax").text();
  var taxes = cart_tax.replace(currency_symbol, "");
  var cart_special_days=jQuery(".cart_special_days").text();
  var special_days = cart_special_days.replace(currency_symbol, "");
  var partialamount=jQuery(".partial_amount").text();
  var partial_amount = partialamount.replace(currency_symbol, "");
  var cart_total=jQuery(".cart_total").text();
  var net_amount = cart_total.replace(currency_symbol, "");
	
	

  if(payment_method=="Wallet-payment"){
    var current_amount = jQuery('#wallet').attr('data-wallet');
  }else{
    var current_amount = "";
  }

  var cart_counting = jQuery("#total_cart_count").val();
  var coupon_code=jQuery("#coupon_val").val();
  var user_coupon_val=jQuery("#user_coupon_val").val();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var frequent_discount_amount = 0;
  var recurrence_booking_1 = "N";
  if(frequently_discount_id != "1"){
    recurrence_booking_1 ="Y";
    var frequent_discount_text=jQuery(".frequent_discount").text();
    frequent_discount_amount = frequent_discount_text.replace(currency_symbol, "");
  }
  var no_units_in_cart_err= jQuery("#no_units_in_cart_err").val();
  var no_units_in_cart_err_count= jQuery("#no_units_in_cart_err_count").val();
  var cc_card_num = jQuery(".cc-number").val();
  var cc_exp_month = jQuery(".cc-exp-month").val();
  var cc_exp_year = jQuery(".cc-exp-year").val();
  var cc_card_code = jQuery(".cc-cvc").val();

  dataString={existing_username:existing_username,existing_password:existing_password,password:password,firstname:firstname,lastname:lastname,email:email,phone:phone,user_address:user_address,user_zipcode:user_zipcode,user_city:user_city,user_state:user_state,address:address,zipcode:zipcode,city:city,state:state,notes:notes,vc_status:vc_status,p_status:p_status,contad4mstatus:contad4mstatus,payment_method:payment_method,staff_id:staff_id,amount:amount,discount:discount,taxes:taxes,partial_amount:partial_amount,net_amount:net_amount,booking_date_time:booking_date_time,frequently_discount:frequently_discount_id,frequent_discount_amount:frequent_discount_amount,coupon_code:coupon_code,user_coupon_val:user_coupon_val,cc_card_num:cc_card_num,cc_exp_month:cc_exp_month,cc_exp_year:cc_exp_year,cc_card_code:cc_card_code,guest_user_status:guest_user_status,recurrence_booking:recurrence_booking_1,current_amount:current_amount,is_login_user:is_login_user,special_days:special_days,action:"complete_booking"};
  if(jQuery("#user_details_form").valid()){
    if(jQuery("input[name='service-radio']:checked").val() != "on" && jQuery("#d4m-service-0").val() != "off" && cart_counting == 1){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".service_not_selected_error").css("display","block");
      jQuery(".service_not_selected_error").css("color","red");
      jQuery(".service_not_selected_error").html(errorobj_please_seled4ma_service);
      jQuery(this).attr("href","#service_not_selected_error");
      /*}*/
    }else if(jQuery(".ser_name_for_error").text() == "Cleaning Service" && cart_counting == 1){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".service_not_selected_error_d2").css("color","red");
      jQuery(".service_not_selected_error_d2").html(errorobj_please_seled4ma_service);
      jQuery(this).attr("href","#service_not_selected_error_d2");
    }else if(jQuery("#d4mselected_servic_method .service-method-name").text() == "Service Usage Methods" && cart_counting == 1){
      clicked=false;
      jQuery(".method_not_selected_error").css("display","block");
      jQuery(".method_not_selected_error").css("color","red");
      jQuery(".method_not_selected_error").html("Please Select Method");
      jQuery(this).attr("href","#method_not_selected_error");
    }else if(cart_counting == 1){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".empty_cart_error").css("display","block");
      jQuery(".empty_cart_error").css("color","red");
      jQuery(".empty_cart_error").html(errorobj_please_seled4munits_or_addons);
      jQuery(this).attr("href","#empty_cart_error");
    }else if(booking_date_text == "" && booking_time_text == ""){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".date_time_error").css("display","block");
      jQuery(".date_time_error").css("color","red");
      jQuery(".date_time_error").html(errorobj_please_seled4mappointment_date);
      jQuery(this).attr("href","#date_time_error_id");
    }else if(no_units_in_cart_err == "units_and_addons_both_exists" && no_units_in_cart_err_count == "unit_not_added"){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".no_units_in_cart_error").show();
      jQuery(".no_units_in_cart_error").css("color","red");
      jQuery(".no_units_in_cart_error").html(errorobj_please_seled4matleast_one_unit);
      jQuery(this).attr("href","#no_units_in_cart_error");
    }else if(jQuery("#check_login_click").val() == "not" && jQuery("#existing-user").prop("checked") == true){
      clicked=false;
      jQuery(".d4m-loading-main-complete_booking").hide();
      jQuery(".login_unsuccessfull").css("display","block");
      jQuery(".login_unsuccessfull").css("color","red");
      jQuery(".login_unsuccessfull").css("margin-left","15px");
      jQuery(".login_unsuccessfull").html(errorobj_please_login_to_complete_booking);
      jQuery(this).attr("href","#login_unsuccessfull");
    }else{
      if(tc_check=="Y"){
        if(clicked===false){
          jQuery(this).attr("href","javascript:void(0);");
          clicked=true; 
          if(payment_method == "paypal"){
            jQuery(".d4m-loading-main-complete_booking").show();
            jQuery.ajax({
              type:"POST",
              url:front_url+"checkout.php",
              data:dataString,
              success:function(response){
                var response_detail = jQuery.parseJSON(response);
                if(response_detail.status=="success"){
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  window.location = response_detail.value; 
                }
                if(response_detail.status=="error"){
                  clicked=false; 
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  jQuery("#paypal_error").show();
                  jQuery("#paypal_error").text(response_detail.value);
                }
              }
            });
          }
          if(payment_method == "Wallet-payment"){
         if(current_amount >= net_amount){						
            jQuery(".d4m-loading-main-complete_booking").show();
            jQuery.ajax({
              type:"POST",
              url:front_url+"checkout.php",
              data:dataString,
              success:function(response){
               
                var response_detail = jQuery.parseJSON(response);
                if(response_detail.status=="success"){
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  window.location=thankyou_page_setting_value;  
                }
                if(response_detail.status=="error"){
                  clicked=false; 
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  jQuery("#paypal_error").show();
                  jQuery("#paypal_error").text(response_detail.value);
                }
              }
            });
         }else{
              jQuery("#d4m-pay-methods").html("<div id='walletamount' style='color:red'>Sorry! Not Sufficient Wallet Amount</div>");
            }
          }else if(payment_method == "card-payment"){
            jQuery(".d4m-loading-main-complete_booking").show();
            jQuery.ajax({
              type:"POST",
              url:front_url+"checkout.php",
              data:dataString,
              success:function(response){
                var response_detail = jQuery.parseJSON(response);
                if(response_detail.success==false){
                  clicked=false; 
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  jQuery("#d4m-card-payment-error").show();
                  jQuery("#d4m-card-payment-error").text(response_detail.error);
                  } else {
                   jQuery.ajax({
                    type:"POST",
                    url:front_url+"booking_complete.php",
                    data:{transaction_id:response_detail.transaction_id},
                    success:function(response){
                      if(jQuery.trim(response) == "ok"){
                        jQuery(".d4m-loading-main-complete_booking").hide();
                        window.location=thankyou_page_setting_value; 
                      }else{
                        clicked=false; 
                        jQuery(".d4m-loading-main-complete_booking").hide();
                        jQuery("#d4m-card-payment-error").show();
                        jQuery("#d4m-card-payment-error").text(response);
                      }
                    }
                    
                    /*{
                      if(jQuery.trim(response) == "ok"){
                        jQuery(".d4m-loading-main-complete_booking").hide();
                        window.location=thankyou_page_setting_value; 
                      }
                    }*/
                  })            
                }
              }
            });
          }else if(payment_method == "stripe-payment"){ 
            jQuery(".d4m-loading-main-complete_booking").show();
            var stripeResponseHandler = function(status, response) {              
                  if (response.error) {
                    /* Show the errors on the form*/
                    clicked=false; 
                    jQuery(".d4m-loading-main-complete_booking").hide();
                    jQuery("#d4m-card-payment-error").show();
                    jQuery("#d4m-card-payment-error").text(response.error.message);        
                  } else {
                  /* token contains id, last4, and card type*/
                  var token = response.id;
                  function waitForElement(){ 
                  if(typeof token !== "undefined" && token != ""){ 
                    var st_token = token;                 
                    dataString["st_token"] = st_token;
                    jQuery.ajax({
                      type:"POST",
                      url:front_url+"checkout.php",
                      data:dataString,
                      success:function(response){
                        if(jQuery.trim(response) == "ok"){
                          jQuery(".d4m-loading-main-complete_booking").hide();
                          window.location=thankyou_page_setting_value; 
                        }else{
                          clicked=false; 
                          jQuery(".d4m-loading-main-complete_booking").hide();
                          jQuery("#d4m-card-payment-error").show();
                          jQuery("#d4m-card-payment-error").text(response);
                        }
                      }
                    });
                    } else{ 
                      setTimeout(function(){ waitForElement(); },2000); 
                      } 
                    }
                    waitForElement();
                     }
                    };
                /*Disable the submit button to prevent repeated clicks*/
                Stripe.card.createToken({
                            number: jQuery(".d4m-card-number").val(),
                            cvc: jQuery(".d4m-cvc-code").val(),
                            exp_month: jQuery(".d4m-exp-month").val(),
                            exp_year: jQuery(".d4m-exp-year").val()
                          }, stripeResponseHandler); 
          }else if(payment_method == "2checkout-payment"){
            var seller_id = twocheckout_Obj.sellerId;
            var publishable_Key = twocheckout_Obj.publishKey;
            /*  Called when token created successfully. */
            jQuery(".d4m-loading-main-complete_booking").show();
            function successCallback(data) {
              /* Set the token as the value for the token input */
              var twoctoken = data.response.token.token;
              dataString["twoctoken"] = twoctoken;
                jQuery.ajax({
                  type:"POST",
                  url:front_url+"checkout.php",
                  data:dataString,
                  success:function(response){
                    if(jQuery.trim(response) == "ok"){
                      jQuery(".d4m-loading-main-complete_booking").hide();
                      window.location=thankyou_page_setting_value; 
                    }else{
                      clicked=false; 
                      jQuery(".d4m-loading-main-complete_booking").hide();
                      jQuery("#d4m-card-payment-error").show();
                      jQuery("#d4m-card-payment-error").text(response);
                    } 
                  }
                }); 
            };
            /*  Called when token creation fails. */
            function errorCallback(data) {
              if (data.errorCode === 200) {
                clicked=false; 
                jQuery(".d4m-loading-main-complete_booking").hide();
                tokenRequest();
              } else {
                clicked=false; 
                jQuery(".d4m-loading-main-complete_booking").hide();
                jQuery("#d4m-card-payment-error").show();
                jQuery("#d4m-card-payment-error").text(response.error.message);
              }
            };
            function tokenRequest() {
              /* Setup token request arguments */
              var args = {
                sellerId: seller_id,
                publishableKey: publishable_Key,
                ccNo: jQuery(".d4m-card-number").val(),
                cvv: jQuery(".d4m-cvc-code").val(),
                expMonth: jQuery(".d4m-exp-month").val(),
                expYear: jQuery(".d4m-exp-year").val()
              };
              /* Make the token request */
              TCO.requestToken(successCallback, errorCallback, args);
            };
            tokenRequest();
          }else if(payment_method == "payumoney"){
            jQuery.ajax({
              type:"POST",
              url:front_url+"checkout.php",
              data:dataString,
              success:function(response){
                var pm = jQuery.parseJSON(response);
                jQuery("#payu_key").val(pm.merchant_key);
                jQuery("#payu_hash").val(pm.hash);
                jQuery("#payu_txnid").val(pm.txnid);
                jQuery("#payu_amount").val(pm.amt);
                jQuery("#payu_fname").val(pm.fname);
                jQuery("#payu_email").val(pm.email);
                jQuery("#payu_phone").val(pm.phone);
                jQuery("#payu_productinfo").val(pm.productinfo);
                jQuery("#payu_surl").val(pm.payu_surl);
                jQuery("#payu_furl").val(pm.payu_furl);
                jQuery("#payu_service_provider").val(pm.service_provider);
                jQuery("#payuForm").submit();
              }
            });
          }else if(payment_method == "pay at venue" || payment_method == "bank transfer" || payment_method == ""){
            jQuery(".d4m-loading-main-complete_booking").show();
            jQuery.ajax({
              type:"POST",
              url:front_url+"checkout.php",
              data:dataString,
              success:function(response){
                if(jQuery.trim(response) == "ok"){
                  jQuery(".d4m-loading-main-complete_booking").hide();
                  window.location=thankyou_page_setting_value; 
                }
              }
            })
          }
          payment_process_js(payment_method,thankyou_page_setting_value,dataString,front_url);
        }else{
          e.preventDefault();
        }
      }else{
        if(terms_condition_setting_value == "Y" || privacy_policy_setting_value == "Y"){
        jQuery(this).attr("href","javascript:void(0);");
        clicked=false;
        jQuery(".d4m-loading-main-complete_booking").hide();
          jQuery(".terms_and_condition").show();
          jQuery(".terms_and_condition").css("color","red");
          jQuery(".terms_and_condition").html(errorobj_please_accept_terms_and_conditions);
        }
      }
    }
  }
  jQuery(".add_show_error_class").each(function(){
    jQuery(this).trigger("keyup");
  });
});
jQuery(document).on("click","#accept-conditions",function(){
  jQuery(".terms_and_condition").hide();
});
jQuery(document).on("click","#login_existing_user",function(){
  jQuery(".add_show_error_class_for_login").each(function(){
    jQuery(this).trigger("keyup");
  });
  jQuery(".add_show_error_class").each(function(){
    var id = jQuery(this).attr("id");
    jQuery( this ).removeClass("error");
    jQuery( "#"+id ).parent().removeClass("error");
    jQuery( this ).removeClass("show-error");
    jQuery( "#"+id ).parent().removeClass("show-error");
    jQuery( ".intl-tel-input" ).parent().removeClass("show-error");
  });
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var existing_username = jQuery("#d4m-user-name").val();
  var existing_password = jQuery("#d4m-user-pass").val();
  dataString={existing_username:existing_username,existing_password:existing_password,action:"get_existing_user_data"};
  if(!jQuery("#user_login_form").valid()){ return false; }
  jQuery.ajax({
    type:"POST",
    url:ajax_url+"front_ajax.php",
    data:dataString,
    success:function(response){
      var userdata=jQuery.parseJSON(response);
      if(userdata.status == "Incorrect Email Address or Password"){
        jQuery(".login_unsuccessfull").css("display","block");
        jQuery(".login_unsuccessfull").css("color","red");
        jQuery(".login_unsuccessfull").css("margin-left","15px");
        jQuery("#check_login_click").val("not");
        jQuery(".login_unsuccessfull").html(errorobj_incorred4memail_address_or_password);
        is_login_user = "N";
        jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
      }else{
        is_login_user = "Y";
				
        jQuery("#check_login_click").val("clicked");
        jQuery("#pay-cash").removeAttr('checked');
        jQuery(".client_logout").css("display","block");
        jQuery(".client_logout").show();
        jQuery("#d4m-email").val(existing_username);
        jQuery(".fname").text(userdata.firstname);
        jQuery(".lname").text(userdata.lastname);
        jQuery(".hide_login_btn").hide();
        jQuery(".hide_radio_btn_after_login").hide();
        jQuery(".hide_email").hide();
        jQuery(".hide_login_email").hide();
        jQuery(".hide_password").hide();
        jQuery(".d4m-peronal-details").show();
        jQuery(".login_unsuccessfull").hide();
        jQuery(".d4m-sub").hide();
        
        jQuery("#d4m-first-name").val(userdata.firstname);
        jQuery("#d4m-last-name").val(userdata.lastname);
        jQuery("#d4m-user-phone").intlTelInput("setNumber", userdata.phone);
        if(check_addresss.statuss=="on"){ jQuery("#d4m-street-address").val(userdata.address); }
        if(check_zip_code.statuss=="on"){  jQuery("#d4m-zip-code").val(userdata.zip); }
        if(check_city.statuss=="on"){  jQuery("#d4m-city").val(userdata.city); }
        if(check_state.statuss=="on"){  jQuery("#d4m-state").val(userdata.state); }
        jQuery("#d4m-notes").val(userdata.notes);
        if(userdata.vc_status == "N"){
          jQuery("#vaccum-no").attr("checked", true);
        }else{
          jQuery("#vaccum-yes").attr("checked", true);
        }
        if(userdata.p_status == "N"){
          jQuery("#parking-no").attr("checked", true);
        }else{
          jQuery("#parking-yes").attr("checked", true);
        }
        var con_staatus = userdata.contad4mstatus;
        if(con_staatus == "I'll be at home" || con_staatus == "Please call me" || con_staatus == "The key is with the doorman"){
          jQuery("#contad4mstatus").val(userdata.contad4mstatus);
        }else{
          jQuery("#contad4mstatus").val("Other");
          jQuery(".d4m-option-others").show();
          jQuery("#other_contad4mstatus").val(userdata.contad4mstatus);
        }
        jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
				
				jQuery(".wallet_amount_display").css("display","block");
				jQuery(".wallet_amount_display").html(userdata.wallet_amount);
        /* jQuery(".user_wallet_amount_value").attr('data-wallet', userdata.wallet_amount); */
      }
    }
  });
});
jQuery(document).on("click","#d4m-user-name",function(){
  jQuery(".login_unsuccessfull").hide();
});
jQuery(document).on("click","#d4m-user-pass",function(){
  jQuery(".login_unsuccessfull").hide();
});
jQuery(document).on("change",".existing-user",function() {
  if(jQuery(".existing-user").is(":checked")) {
		jQuery(".login_unsuccessfull").html("");
    jQuery("#d4m-email-guest").val("");
    jQuery("#d4m-user-name").val("");
    jQuery("#d4m-user-pass").val("");
    jQuery("#d4m-preffered-name").val("");
    jQuery("#d4m-preffered-pass").val("");
    jQuery("#d4m-first-name").val("");
    jQuery("#d4m-last-name").val("");
    jQuery("#d4m-email").val("");
    jQuery("#d4m-user-phone").val("");
    jQuery("#d4m-street-address").val("");
    jQuery("#d4m-zip-code").val("");
    jQuery("#d4m-city").val("");
    jQuery("#d4m-state").val("");
    jQuery("#d4m-notes").val("");
		jQuery(".spaical_referral_class").css("display","none");
    jQuery(".d4m-login-existing").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-new-user-details").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").hide( "blind", {direction: "vertical"}, 300);
    guest_user_status ="off";
  }
});
jQuery(document).on("change",".new-user",function() {
  if(jQuery(".new-user").is(":checked")) {
		jQuery(".login_unsuccessfull").html("");
    jQuery("#d4m-email-guest").val("");
    jQuery("#d4m-user-name").val("");
    jQuery("#d4m-user-pass").val("");
    jQuery("#d4m-preffered-name").val("");
    jQuery("#d4m-preffered-pass").val("");
    jQuery("#d4m-first-name").val("");
    jQuery("#d4m-last-name").val("");
    jQuery("#d4m-email").val("");
    jQuery("#d4m-user-phone").val("");
    jQuery("#d4m-street-address").val("");
    jQuery("#d4m-zip-code").val("");
    jQuery("#d4m-city").val("");
    jQuery("#d4m-state").val("");
    jQuery("#d4m-notes").val("");
    jQuery(".spaical_referral_class").css("display","block");
    jQuery(".d4m-new-user-details").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-login-existing").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").show( "blind", {direction: "vertical"}, 300);
    jQuery(".remove_preferred_password_and_preferred_email").show( "blind", {direction: "vertical"}, 300);    
    jQuery(".remove_guest_user_preferred_email").hide( "blind", {direction: "vertical"}, 300);  
    if(jQuery( ".remove_zip_code_class" ).hasClass( "d4m-md-6" )){
      jQuery(".remove_zip_code_class").removeClass("d4m-md-6");
      jQuery(".remove_zip_code_class").addClass("d4m-md-4");
    }
    if(jQuery( ".remove_city_class" ).hasClass( "d4m-md-6" )){
      jQuery(".remove_city_class").removeClass("d4m-md-6");
      jQuery(".remove_city_class").addClass("d4m-md-4");
    }
    if(jQuery( ".remove_state_class" ).hasClass( "d4m-md-6" )){
      jQuery(".remove_state_class").removeClass("d4m-md-6");
      jQuery(".remove_state_class").addClass("d4m-md-4");
    }
    guest_user_status ="off";
  }
});

jQuery(document).on("change",".guest-user",function() {
  if(jQuery(".guest-user").is(":checked")) {
    jQuery("#d4m-email-guest").val("");
    jQuery("#d4m-user-name").val("");
    jQuery("#d4m-user-pass").val("");
    jQuery("#d4m-preffered-name").val("");
    jQuery("#d4m-preffered-pass").val("");
    jQuery("#d4m-first-name").val("");
    jQuery("#d4m-last-name").val("");
    jQuery("#d4m-email").val("");
    jQuery("#d4m-user-phone").val("");
    jQuery("#d4m-street-address").val("");
    jQuery("#d4m-zip-code").val("");
    jQuery("#d4m-city").val("");
    jQuery("#d4m-state").val("");
    jQuery("#d4m-notes").val("");
    jQuery(".d4m-new-user-details").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-login-existing").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").show( "blind", {direction: "vertical"}, 300);
    jQuery(".remove_preferred_password_and_preferred_email").hide( "blind", {direction: "vertical"}, 300);    
    jQuery(".remove_guest_user_preferred_email").show( "blind", {direction: "vertical"}, 300);
    if(jQuery( ".remove_zip_code_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_zip_code_class").removeClass("d4m-md-4");
      jQuery(".remove_zip_code_class").addClass("d4m-md-6");
    }
    if(jQuery( ".remove_city_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_city_class").removeClass("d4m-md-4");
      jQuery(".remove_city_class").addClass("d4m-md-6");
    }
    if(jQuery( ".remove_state_class" ).hasClass( "d4m-md-4" )){
      jQuery(".remove_state_class").removeClass("d4m-md-4");
      jQuery(".remove_state_class").addClass("d4m-md-6");
    }
    guest_user_status ="on";
  }
  jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
});
jQuery(document).on("click","#logout",function() {
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var id = jQuery(this).attr("data-id");
	jQuery(".wallet_amount_display").css("display","none");
  dataString={id:id,action:"logout"};
  jQuery.ajax({
    type:"POST",
    url:ajax_url+"front_ajax.php",
    data:dataString,
    success:function(response){
      if(jQuery.trim(response)=="logout successful"){
        jQuery("#check_login_click").val("not");
        jQuery(".client_logout").hide();
        jQuery(".client_logout").css("display","none");
        jQuery("#other_contad4mstatus").hide();
        jQuery(".hide_login_btn").show();
        jQuery(".d4m-peronal-details").hide();
        jQuery(".hide_radio_btn_after_login").show();
        jQuery(".hide_email").show();
        jQuery(".hide_login_email").show();
        jQuery(".hide_password").show();
        jQuery(".d4m-sub").show();
        jQuery("#d4m-user-name").val("");
        jQuery("#d4m-user-pass").val("");
        jQuery("#d4m-preffered-name").val("");
        jQuery("#d4m-preffered-pass").val("");
        jQuery("#d4m-first-name").val("");
        jQuery("#d4m-last-name").val("");
        jQuery("#d4m-email").val("");
        jQuery("#d4m-user-phone").val("");
        jQuery("#d4m-street-address").val("");
        jQuery("#d4m-zip-code").val("");
        jQuery("#d4m-city").val("");
        jQuery("#d4m-state").val("");
        jQuery("#d4m-notes").val("");
        jQuery("#vaccum-yes").prop("checked",true);
        jQuery("#parking-yes").prop("checked",true);
        jQuery("#contad4mstatus").val("I'll be at home");
        jQuery("#other_contad4mstatus").val("");
        jQuery("#existing-user").prop("checked",true);
        jQuery(".existing-user").trigger("change");
        is_login_user = "N";
      }
      jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
    }
  })
});
/* dropdown services methods list */
/* services methods dropdown show hide list */
jQuery(document).on("click",".service-method-is",function() {
    jQuery(".d4m-services-method-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".seled4mservice_method",function() {
  jQuery("#d4mselected_servic_method").html(jQuery(this).html());
  jQuery(".d4m-services-method-dropdown").hide( "blind", {direction: "vertical"}, 300 );
  jQuery("#d4mselected_servic_method h3").removeClass("s_m_units_design");
});
jQuery(document).on("click",".ser_details",function(){
	jQuery(".custom_service_error").hide();
jQuery(".custom_item_error").html("");
  jQuery(":input",this).prop("checked",true);
  jQuery(".d4m-loading-main").show();
  jQuery(".hideduration_value").hide();
  jQuery(".total_time_duration_text").html("");
  jQuery(".show_methods_after_service_selection").show();
  jQuery(".d4mmethod_tab-slider-tabs").removeClass("d4mmethods_slide");
  jQuery(".service_not_selected_error_d2").removeAttr("style","");
  jQuery(".service_not_selected_error_d2").html(errorobj_please_seled4ma_service);
  jQuery(".freq_discount_display").hide();
  jQuery(".add_addon_in_cart_for_multipleqty").data("status","2");
  jQuery(".service_not_selected_error").hide();
  jQuery(".partial_amount_hide_on_load").hide();
  jQuery(".hide_right_side_box").hide();
  jQuery(".freq_disc_empty_cart_error").hide();
  jQuery(".s_m_units_design_1").hide();
  jQuery(".s_m_units_design_2").hide();
  jQuery(".s_m_units_design_3").hide();
  jQuery(".s_m_units_design_4").hide();
  jQuery(".s_m_units_design_5").hide();
  jQuery(".hideservice_name").show();
  jQuery("#apply_coupon").show();
  jQuery("#coupon_val").show();
  jQuery(".d4m-display-coupon-code").hide();
  jQuery(".show_seled4mstaff_title").show();
  jQuery(".empty_cart_error").hide();
  jQuery(".no_units_in_cart_error").hide();
  jQuery( ".cart_item_listing" ).empty();
  jQuery( ".frequent_discount" ).empty();
  jQuery( ".cart_sub_total" ).empty();
  jQuery( ".cart_empty_msg" ).show();
  jQuery( ".cart_tax" ).empty();
  jQuery( ".cart_special_days" ).empty();                                  
  jQuery( ".cart_total" ).empty();
  jQuery( ".remain_amount" ).empty();
  jQuery( ".partial_amount" ).empty();
  jQuery( ".cart_discount" ).empty();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var id = jQuery(this).attr("data-id");
  var name = jQuery(this).attr("data-servicetitle");
  jQuery(".sel-service").html(name);
  jQuery(".addon_qty").each(function(){
    jQuery(this).val(0);
    jQuery(".add_minus_button").hide();
  });
  if(jQuery(".ser_name_for_error").text() != "Cleaning Service" && jQuery(".service-method-name").text() == "Service Usage Methods"){
    jQuery(".method_not_selected_error").css("display","block");
    jQuery(".method_not_selected_error").css("color","red");
    jQuery(".method_not_selected_error").html("Please Select Method");
  }else if(jQuery("input[name='service-radio']:checked").val() == "on" && jQuery(".service-method-name").text() == "Service Usage Methods"){
    jQuery(".method_not_selected_error").css("display","block");
    jQuery(".method_not_selected_error").css("color","red");
    jQuery(".method_not_selected_error").html("Please Select Method");
  }
  /* display all methods of the selected services */
  jQuery.ajax({
    type : "post",
    data : { "service_id" : id, "operationgetmethods" : 1 },
    url : ajax_url+"front_ajax.php",
    success : function(res){
      jQuery(".d4m-loading-main").hide();
      var methods_data=jQuery.parseJSON(res);
      if(methods_data.status == "single"){
        jQuery(".services-method-list-dropdown").hide();
        jQuery(".show_single_service_method").html(methods_data.m_html);
        jQuery(".s_m_units_design").trigger("click");
        jQuery("#method_not_selected_error").hide();
        jQuery.ajax({
          type : "post",
          data : { "service_id" : id, "staff_seled4maccording_service" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
            var search_session_data=jQuery.parseJSON(res);
            if(search_session_data.found_status == "found"){
              jQuery(".d4m-provider-list").show();
              var search_staff_id = search_session_data.staff_id;
              jQuery.ajax({
                type:"POST",
                url: ajax_url+"front_ajax.php",
                data : { "staff_search" : search_staff_id, "get_search_staff_detail" : 1 },
                success: function(res){
                  jQuery(".provders-list").html(res);
                }
              });
            }else if(search_session_data.found_status == "not found"){
              jQuery(".d4m-provider-list").hide();
							jQuery('#staff_count_forservice').attr('value','0');
            } 
          }
        });
      }else{
        jQuery(".show_single_service_method").html(methods_data.m_html);
        jQuery(".d4mmethod_tab-slider-tabs li:first").trigger("click");
        jQuery.ajax({
          type : "post",
          data : { "service_id" : id, "staff_seled4maccording_service" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
          var search_session_data=jQuery.parseJSON(res);
            if(search_session_data.found_status == "found"){
              jQuery(".d4m-provider-list").show();
              var search_staff_id = search_session_data.staff_id;
              jQuery.ajax({
              type:"POST",
              url: ajax_url+"front_ajax.php",
              data : { "staff_search" : search_staff_id, "get_search_staff_detail" : 1 },
              success: function(res){
                jQuery(".provders-list").html(res);
              }
              });
            }else if(search_session_data.found_status == "not found"){
              jQuery(".d4m-provider-list").hide();
							jQuery('#staff_count_forservice').attr('value','0');
            }
          }
        });
      }
    }
  });
  /* display all add-on of the selected services */
  jQuery.ajax({
      type : "post",
      data : { "service_id" : id, "get_service_addons" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".d4m-loading-main").hide();
          if(res=="Extra Services Not Available"){
            jQuery(".hide_allsss_addons").hide();
          }else{
            jQuery(".hide_allsss_addons").show();
            jQuery(".add_on_lists").html(res);
            jQuery(".add_minus_button").hide();
            jQuery(".add_addon_in_cart_for_multipleqty").each(function(){
              var multiqty_addon_id = jQuery(this).attr("data-id");
              var value = jQuery(this).prop("checked");
              if(value == true){
                jQuery("#d4m-addon-"+multiqty_addon_id).attr("checked", false);
              }
            });
          }
        do4me_sidebar_scroll();
      }
  });
  jQuery(".remove_service_class").each(function() {
    jQuery(this).addClass("ser_details");
  });
  jQuery(this).removeClass("ser_details");
  return false;
});
/* display all Provider of selected service */
jQuery(document).on("click",".provider_select",function(){
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var staff_id = jQuery(this).attr("data-id");
  jQuery.ajax({
    type : "post",
    data : { "staff_id" : staff_id, "get_staff_sess" : 1 },
    url : site_url+"front/firststep.php",
    success : function(res){
      jQuery.ajax({
        type:"POST",
        url: ajax_url+"calendar_ajax.php",
        data : { "get_calendar_on_page_load" : 1 },
        success: function(res){
          jQuery(".cal_info").html(res);
          var d = new Date();
          var month = d.getMonth()+1;
          var day = d.getDate();
          var year = d.getFullYear();
          var output = day + "-" +(month<10 ? "0" : "") + month + "-" +  year;
          var selected_dates = jQuery(".selected_date").data("selected_dates");
          var cur_dates = jQuery(".selected_date").attr("data-cur_dates");
          if(output == cur_dates){
            jQuery(".by_default_today_selected").addClass("active_today");
          }
        }
      });
    }
  });
  jQuery("#d4m-provider-"+staff_id).prop("checked",true);
  return false;
});
jQuery(document).on("click",".addons_servicess_2",function(){
  var id = jQuery(this).attr("data-id");
  jQuery(".add_minus_buttonid"+id).show();
  var m_name = jQuery(this).attr("data-mnamee");
  var value = jQuery(this).prop("checked");
  if(value == false){
    jQuery(".qtyyy_"+m_name).val("1");
    var addon_id = jQuery(this).attr("data-id");
    jQuery("#minus"+addon_id).trigger("click");
  }else if(value == true){
    var addon_id = jQuery(this).attr("data-id");
    jQuery("#add"+addon_id).trigger("click");
  }
});
/* bedroom and bathroom counting for addons */
jQuery(document).on("click",".add",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var ids = jQuery(this).attr("data-ids");
  var db_qty = jQuery(this).attr("data-db-qty");
  var service_id = jQuery(this).attr("data-service_id");
  var method_id = jQuery(this).attr("data-method_id");
  var method_name = jQuery(this).attr("data-method_name");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var m_name = jQuery(this).attr("data-mnamee");
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();
  
  /* */

  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide();  

  /* */

  /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var qty_val = parseInt(jQuery(".qtyyy_"+m_name).val());
  var qty_vals = qty_val+1;
  if(qty_val < db_qty){
    jQuery(".qtyyy_"+m_name).val(qty_vals);
    var final_qty_val = qty_vals;
    jQuery.ajax({
      type : "post",
      data : { "addon_id" : ids, "qty_vals" : final_qty_val, "s_addon_units_maxlimit_4_ratesss" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".data_addon_qtyrate").attr("data-rate",res);
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : final_qty_val, "s_m_rate" : res, "method_name" : method_name, "units_id" : units_id, "frequently_discount_id" : frequently_discount_id, "type" : type, "add_to_cart" : 1 },
          url : site_url+"front/firststep.php",
          success : function(res){
            jQuery(".freq_discount_display").show();
            jQuery(".hide_right_side_box").show();
            jQuery(".partial_amount_hide_on_load").show();
            jQuery(".empty_cart_error").hide();
            var cart_session_data=jQuery.parseJSON(res);
            jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
            jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
            jQuery("#total_cart_count").val("2");
            jQuery(".coupon_invalid_error").hide();
            if(cart_session_data.status == "update"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "insert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "firstinsert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                   
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "empty calculation"){
              jQuery(".hideduration_value").hide();
              jQuery(".total_time_duration_text").html("");
              jQuery(".freq_discount_display").hide();
              jQuery(".partial_amount_hide_on_load").hide();
              jQuery(".hide_right_side_box").hide();
              jQuery( ".cart_empty_msg" ).show();
              jQuery( ".cart_item_listing" ).empty();
              jQuery( ".cart_sub_total" ).empty();
              jQuery( ".cart_tax" ).empty();
              jQuery( ".cart_special_days" ).empty();                               
              jQuery( ".cart_total" ).empty();
              jQuery(".frequent_discount").empty();
              jQuery( ".remain_amount" ).empty();
              jQuery( ".partial_amount" ).empty();
              jQuery( ".cart_discount" ).empty();
            }else if(cart_session_data.status == "delete particuler"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }
          }
        });
      }
    });
  }else{
  jQuery(".d4m-loading-main").hide();
    jQuery(".qtyyy_"+m_name).val(db_qty);
  }
});
jQuery(document).on("click",".minus",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var ids = jQuery(this).attr("data-ids");
  var service_id = jQuery(this).attr("data-service_id");
  var method_id = jQuery(this).attr("data-method_id");
  var method_name = jQuery(this).attr("data-method_name");
  var m_name = jQuery(this).attr("data-mnamee");
  var units_id=jQuery(this).attr("data-units_id");
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide(); 
  /* */

   /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var type=jQuery(this).attr("data-type");
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var qty_val = parseInt(jQuery(".qtyyy_"+m_name).val());
  var qty_vals = qty_val-1;
  var currentVal = parseInt(jQuery(".qtyyy_"+m_name).val());
  if(currentVal <= 0){
  jQuery(".add_minus_buttonid"+units_id).hide();
    jQuery(".qtyyy_"+m_name).val("0");
    jQuery( ".update_qty_of_s_m_"+m_name).remove();
    jQuery("#d4m-addon-"+units_id).attr("checked", false);
  }else if(currentVal > 0){
    jQuery(".qtyyy_"+m_name).val(qty_vals);
    jQuery.ajax({
      type : "post",
      data : { "addon_id" : ids, "qty_vals" : qty_vals, "s_addon_units_maxlimit_4_ratesss" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".data_addon_qtyrate").attr("data-rate",res);
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : qty_vals, "s_m_rate" : res, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
          url : site_url+"front/firststep.php",
          success : function(res){
            jQuery(".freq_discount_display").show();
            jQuery(".hide_right_side_box").show();
            jQuery(".partial_amount_hide_on_load").show();
            jQuery(".empty_cart_error").hide();
            jQuery("#total_cart_count").val("2");
            jQuery(".coupon_invalid_error").hide();
            var cart_session_data=jQuery.parseJSON(res);
            jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
            jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
            if(cart_session_data.status == "update"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "insert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "firstinsert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "empty calculation"){
              jQuery(".hideduration_value").hide();
              jQuery(".total_time_duration_text").html("");
              jQuery(".freq_discount_display").hide();
              jQuery(".partial_amount_hide_on_load").hide();
              jQuery(".hide_right_side_box").hide();
              jQuery(".add_minus_button").hide();
              jQuery("#d4m-addon-"+units_id).attr("checked", false);
              jQuery( ".cart_empty_msg" ).show();
              jQuery( ".cart_item_listing" ).empty();
              jQuery( ".cart_sub_total" ).empty();
              jQuery( ".cart_tax" ).empty();
              jQuery( ".cart_special_days" ).empty();                               
              jQuery( ".frequent_discount" ).empty();
              jQuery( ".cart_total" ).empty();
              jQuery( ".remain_amount" ).empty();
              jQuery( ".partial_amount" ).empty();
              jQuery( ".cart_discount" ).empty();
            }else if(cart_session_data.status == "delete particuler"){
              jQuery(".add_minus_buttonid"+units_id).hide();
              jQuery("#d4m-addon-"+units_id).attr("checked", false);
              jQuery( ".cart_empty_msg" ).hide();
              jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                 
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }
          }
        });
      }
  });
  }
});
jQuery(document).on("click",".addons_servicess",function(){
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var addon_id = jQuery(this).attr("data-id");
  var status = jQuery(this).attr("data-status");
  /*add to cart values */
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var service_id=jQuery(this).attr("data-service_id");
  var method_id=jQuery(this).attr("data-method_id");
  var method_name=jQuery(this).attr("data-method_name");
  var type="addon";
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var m_name = jQuery(this).attr("data-mnamee");
  /*end cart value */
  if(parseInt(status) == 2){
    jQuery(this).attr("data-status","1");
    jQuery.ajax({
      type : "post",
      data : { "addon_id" : addon_id, "get_service_addons_qtys" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".addons_counting").append(res);
      }
    });
  }else{
    jQuery(this).attr("data-status","2");
    jQuery(".remove_addon_intensive"+addon_id).hide();
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : 0, "s_m_rate" : 0, "method_name" : method_name, "units_id" : addon_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
      url : site_url+"front/firststep.php",
      success : function(res){
        jQuery(".freq_discount_display").show();
        jQuery(".hide_right_side_box").show();
        jQuery(".partial_amount_hide_on_load").show();
        jQuery(".empty_cart_error").hide();
        jQuery(".coupon_invalid_error").hide();
        jQuery("#total_cart_count").val("2");
        var cart_session_data=jQuery.parseJSON(res);
        jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
        jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
        if(cart_session_data.status == "empty calculation"){
          jQuery(".hideduration_value").hide();
          jQuery(".total_time_duration_text").html("");
          jQuery(".partial_amount_hide_on_load").hide();
          jQuery(".hide_right_side_box").hide();
          jQuery( ".cart_empty_msg" ).show();
          jQuery( ".cart_item_listing" ).empty();
          jQuery( ".cart_sub_total" ).empty();
          jQuery( ".cart_tax" ).empty();
          jQuery( ".cart_special_days" ).empty();                                 
          jQuery( ".cart_total" ).empty();
          jQuery( ".frequent_discount" ).empty();
          jQuery( ".remain_amount" ).empty();
          jQuery( ".partial_amount" ).empty();
          jQuery( ".cart_discount" ).empty();
        }else if(cart_session_data.status == "delete particuler"){
          jQuery( ".cart_empty_msg" ).hide();
          jQuery( ".update_qty_of_s_m_"+m_name).remove();
          jQuery(".partial_amount").html(cart_session_data.partial_amount);
          jQuery(".remain_amount").html(cart_session_data.remain_amount);
          jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
          jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          jQuery(".cart_tax").html(cart_session_data.cart_tax);
          jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                           
          jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
          jQuery(".cart_total").html(cart_session_data.total_amount);
          jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
        }
      }
    });
  }
});
/* new existing user */
/* d4muser_radio_group */
jQuery(document).on("change",".existing-user",function() {
  if(jQuery(".existing-user").is(":checked")) {
    jQuery(".d4m-login-existing").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-new-user-details").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").hide( "blind", {direction: "vertical"}, 300);
  }
  jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
  jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
});
jQuery(document).on("change",".new-user",function() {
  if(jQuery(".new-user").is(":checked")) {
    jQuery(".d4m-new-user-details").show( "blind", {direction: "vertical"}, 700);
    jQuery(".d4m-login-existing").hide( "blind", {direction: "vertical"}, 300);
    jQuery(".d4m-peronal-details").show( "blind", {direction: "vertical"}, 300);
  }
  jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
});
function price_format_with_symbol(d4mamount){
  var d4mamount = parseFloat(d4mamount);
  if(currency_symbol_position == "$100"){
    return "<span class=d4mtotal_small>"+currency_symbol+"</span>"+d4mamount.toFixed(price_format_decimal_places);
  }else{
    return d4mamount.toFixed(price_format_decimal_places)+"<span class=d4mtotal_small>"+currency_symbol+"</span>";
  }
}
function price_format_without_symbol(d4mamount){
  var d4mamount = parseFloat(d4mamount);
  return d4mamount.toFixed(price_format_decimal_places);
}
/*frequently_discount*/
jQuery(document).on("click",".cart_frequently_discount",function(){
  jQuery(".d4m-loading-main").show();
  var p_d_status = partial_deposit.partial_deposit_status;
  var p_d_amount = partial_deposit.partial_deposit_amount;
  var p_d_type = partial_deposit.partial_deposit_type;
  jQuery(".freq_disc_empty_cart_error").hide();
  var discountname = jQuery(this).attr("data-name");
  var discount_type = jQuery(this).attr("data-discount_type");
  var discount_value = parseFloat(jQuery(this).attr("data-discount_value"));
  jQuery(".f_discount_name").html(discountname);
  var index_get_val = 0;
  if(currency_symbol_position == "$100"){
    index_get_val = 1;
  }
  if(jQuery(".cart_sub_total").text() != ""){
    cart_sub_total_val = parseFloat(jQuery(".cart_sub_total").text());
    var cart_tax_val = 0;
    if(jQuery(".cart_tax").text() != ""){
      cart_tax_val = parseFloat(jQuery(".cart_tax").text());
    }
    var freq_discount_amount = 0;
    if(discount_type == "P"){
      freq_discount_amount = cart_sub_total_val * (discount_value / 100);
    }else{
      freq_discount_amount = discount_value;
    }
    var cart_total = parseFloat(cart_sub_total_val) - parseFloat(freq_discount_amount) + parseFloat(cart_tax_val);
    if(cart_total <= 0){
      cart_total = 0;
    }
    if(p_d_status == "Y"){
      var p_amount = 0;
      var r_amount = 0;
      if(p_d_type == "P"){
        var percentages = ((parseFloat(p_d_amount)) / 100);
        p_amount = parseFloat(cart_total) * parseFloat(percentages);
      }else if(p_d_type == "F"){
        p_amount = p_d_amount;
      }
      r_amount = parseFloat(cart_total) - parseFloat(p_amount);
      jQuery(".partial_amount").html(price_format_without_symbol(p_amount));
      jQuery(".remain_amount").html(price_format_without_symbol(r_amount));
    }
    jQuery(".frequent_discount").html("-"+price_format_without_symbol(freq_discount_amount));
    jQuery(".cart_total").html(price_format_with_symbol(cart_total));
    jQuery(".d4m-loading-main").hide();
    var site_url = siteurlObj.site_url;
    jQuery.ajax({
      type: "POST",
      url: site_url + "front/firststep.php",
      data: {
        "freq_discount_amount": freq_discount_amount.toFixed(2),
        "frequently_discount_set": 1
      },
      success: function(res) {}
    });
  }
  else{
    jQuery(".d4m-loading-main").hide();
  }
});
jQuery(document).on("change","#contad4mstatus",function() {
  var contad4mstatus = jQuery("#contad4mstatus").val();
  if(contad4mstatus == "Other"){
    jQuery(".d4m-option-others").show();
  }else{
    jQuery(".d4m-option-others").hide();
  }
});
/******* Service method - display design according to admin selection ******/
jQuery(document).on("click",".s_m_units_design",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".hideduration_value").hide();
  jQuery(".total_time_duration_text").html("");
  jQuery(".addons_servicess").each(function(){
    jQuery(this).attr("data-status","2");
    var value = jQuery(this).prop("checked");
    if(value == true){
      jQuery("#d4m-addon-"+jQuery(this).attr("data-id")).attr("checked", false);
    }
    jQuery(".remove_addon_intensive"+jQuery(this).attr("data-id")).hide();
  });
  jQuery(".freq_discount_display").hide();
  jQuery( ".cart_empty_msg" ).show();
  jQuery(".partial_amount_hide_on_load").hide();
  jQuery(".hide_right_side_box").hide();
  if(jQuery(".service-method-name").text() != "Service Usage Methods"){
    jQuery(".method_not_selected_error").attr("style","");
    jQuery(".empty_cart_error").css("display","none");
    jQuery(".empty_cart_error").html(errorobj_please_seled4munits_or_addons);
  }
  jQuery(".add_addon_in_cart_for_multipleqty").each(function(){
    var multiqty_addon_id = jQuery(this).attr("data-id");
    var value = jQuery(this).prop("checked");
    if(value == true){
      jQuery("#d4m-addon-"+multiqty_addon_id).attr("checked", false);
    }
  });
  jQuery(".addon_qty").each(function(){
    jQuery(this).val(0);
    jQuery(".add_minus_button").hide();
    jQuery(".addons_servicess_2").attr("checked", false);
  });
  jQuery(".freq_disc_empty_cart_error").hide();
  jQuery(".add_addon_in_cart_for_multipleqty").attr("data-status","2");
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var id = jQuery(this).attr("data-id");
  var method_id = jQuery(this).attr("data-id");
  var service_id = jQuery(this).attr("data-service_id");
  jQuery.ajax({
    type : "post",
    data : { "service_methods_id" : id, "seled4ms_m_units_design" : 1 },
    url : ajax_url+"front_ajax.php",
    success : function(response){
      jQuery(".d4m-loading-main").hide();
      if(response == 1){
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".coupon_display").hide();

        /* */
        jQuery(".user_coupon_display").hide();
        /* */

        jQuery(".s_m_units_design_1").show();
        jQuery(".s_m_units_design_2").hide();
        jQuery(".s_m_units_design_3").hide();
        jQuery(".s_m_units_design_4").hide();
        jQuery(".s_m_units_design_5").hide();
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_units_maxlimit" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(response){
            jQuery(".duration_hrs").html(response);
          }
        });
      }else if(response == 2){
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".coupon_display").hide();

        /* */
        jQuery(".user_coupon_display").hide();
        /* */

        jQuery(".s_m_units_design_1").hide();
        jQuery(".s_m_units_design_2").show();
        jQuery(".s_m_units_design_3").hide();
        jQuery(".s_m_units_design_4").hide();
        jQuery(".s_m_units_design_5").hide();
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_units_maxlimit_2" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
            jQuery(".ser_design_2_units").html(res);
           /*  if(jQuery("#row_tot").val()==1){                          
              jQuery(".seled4mbedroom").trigger("click");                         
            }  */
          }
        });
      }else if(response == 3){
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".coupon_display").hide();

        /* */
        jQuery(".user_coupon_display").hide();
        /* */

        jQuery(".s_m_units_design_1").hide();
        jQuery(".s_m_units_design_2").hide();
        jQuery(".s_m_units_design_3").show();
        jQuery(".s_m_units_design_4").hide();
        jQuery(".s_m_units_design_5").hide();
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_units_maxlimit_3" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
            jQuery(".ser_design_3_units").html(res);
           /*  if(jQuery("#row_tot").val()==1){                          
              jQuery(".seled4mm_u_btn").trigger("click");                         
            }  */
          }
        });
      }else if(response == 4){
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".coupon_display").hide();

        /* */
        jQuery(".user_coupon_display").hide();
        /* */

        jQuery(".s_m_units_design_1").hide();
        jQuery(".s_m_units_design_2").hide();
        jQuery(".s_m_units_design_3").hide();
        jQuery(".s_m_units_design_4").show();
        jQuery(".s_m_units_design_5").hide();
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_units_maxlimit_4" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
            jQuery(".ser_design_4_units").html(res);
            /* if(jQuery("#row_tot").val()==1){                          
              jQuery(".addd").trigger("click");                         
            } */
          }
        });
      }else if(response == 5){
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".coupon_display").hide();

        /* */
        jQuery(".user_coupon_display").hide();
        /* */

        jQuery(".s_m_units_design_1").hide();
        jQuery(".s_m_units_design_2").hide();
        jQuery(".s_m_units_design_3").hide();
        jQuery(".s_m_units_design_4").hide();
        jQuery(".s_m_units_design_5").show();
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_units_maxlimit_5" : 1 },
          url : ajax_url+"front_ajax.php",
          success : function(res){
            jQuery(".ser_design_5_units").html(res);
          }
        });
      }
    }
  });
});
/* bedrooms dropdown show hide list */
jQuery(document).on("click",".select-bedrooms",function() {
  var unit_id= jQuery(this).attr("data-un_id");
  jQuery(".d4m-"+unit_id+"-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});
/* select on click on bedroom */
jQuery(document).on("click",".seled4mbedroom",function() {
  var units_id= jQuery(this).attr("data-units_id");
  jQuery("#d4mselected_"+units_id).html(jQuery(this).html());
  jQuery(".d4m-"+units_id+"-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".select-language",function() {
  jQuery(".d4m-language-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".seled4mlanguage_view",function() {
  jQuery(".d4m-loading-main").show();
  var ajax_url=ajaxurlObj.ajax_url;
  jQuery("#d4mselected_language").html(jQuery(this).html());
  jQuery(".d4m-language-dropdown").hide( "blind", {direction: "vertical"}, 300 );
  jQuery.ajax({
    type : "POST",
    data : {"seled4mlanguage" : "yes","set_language" : jQuery(this).attr("data-langs")},
    url : ajax_url+"front_ajax.php",
    success : function(res){
      location.reload();
    }
  });
});
/* remove item btn-from the cart */
jQuery(document).on("click",".remove_item_from_cart",function() {
  var ajax_url=ajaxurlObj.ajax_url;
  var m_name = jQuery(this).attr("data-mnamee");
  var unit_id = jQuery(this).attr("data-units_id");
  jQuery("#apply_coupon").show();
  jQuery("#coupon_val").show();
  jQuery(".d4m-display-coupon-code").hide();
  jQuery(".coupon_display").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  /* */

  var frequently_discount = jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery.ajax({
    type : "POST",
    data : { "cart_unit_id" : unit_id, "frequently_discount_id" : frequently_discount, "m_name": m_name, "cart_item_remove" : 1 },
    url : ajax_url+"front_ajax.php",
    success : function(res){
      var cart_session_data=jQuery.parseJSON(res);
      jQuery(".select-bedrooms").each( function(){
        if(jQuery(this).attr("data-un_id") == unit_id && jQuery(this).attr("data-mnamee") == m_name){
          var dd_default_title = jQuery(this).attr("data-un_title");
          jQuery("#d4mselected_"+unit_id+" .d4m-count").html(dd_default_title);
        }
      });
      jQuery(".u_"+unit_id+"_btn").removeClass("d4m-bed-selected");
      jQuery("#d4marea_m_units").val("");
      jQuery("#qty"+unit_id).val("0");
      if (m_name.indexOf("ad_unit") > -1){
        jQuery(".add_minus_buttonid"+unit_id).hide();
        jQuery(".qtyyy_ad_unit"+unit_id).val("0");
        jQuery("#d4m-addon-"+unit_id).attr("data-status","2");
        jQuery("#d4m-addon-"+unit_id).prop("checked",false);
      }
      if(cart_session_data.status == "empty calculation"){
        jQuery(".hideduration_value").hide();
        jQuery(".total_time_duration_text").html("");
        jQuery("#total_cart_count").val("1");
        jQuery(".freq_discount_display").hide();
        jQuery(".partial_amount_hide_on_load").hide();
        jQuery(".hide_right_side_box").hide();
        jQuery( ".cart_empty_msg" ).show();
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".frequent_discount").empty();
      }else{
        jQuery("#total_cart_count").val("2");
        jQuery( ".cart_empty_msg" ).hide();
        jQuery( ".update_qty_of_s_m_"+m_name).remove();
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                                                              
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
        jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
      }
    }
  });
});
/* bedroom counting */
jQuery(document).on("click",".seled4mm_u_btn",function() {
  var units_id= jQuery(this).attr("data-units_id");
  jQuery(".u_"+units_id+"_btn").each(function(){
    jQuery(this).removeClass("d4m-bed-selected");
  });
  jQuery(this).addClass("d4m-bed-selected");
});
/* bedroom and bathroom counting */
jQuery(document).on("click",".addd",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
	jQuery(".custom_item_error").hide();
jQuery(".custom_item_error").html("");
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var ids = jQuery(this).attr("data-ids");
  var db_qty = jQuery(this).attr("data-db-qty");
  var db_minqty = jQuery(this).attr("data-db-minqty");
  var service_id = jQuery(this).attr("data-service_id");
  var method_id = jQuery(this).attr("data-method_id");
  var method_name = jQuery(this).attr("data-method_name");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var m_name = jQuery(this).attr("data-mnamee");
  var hfsec = jQuery(this).attr("data-hfsec");
  var unit_symbol = jQuery(this).attr("data-unit_symbol");
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide(); 
  /* */


   /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var qty_val = 0;
  if(unit_symbol != ""){
    var qty_val_orignal = jQuery("#qty"+ids).val();
    var qty_val_array = qty_val_orignal.split(" ");
    qty_val = parseFloat(qty_val_array[0]);
  }else{
    qty_val = parseFloat(jQuery("#qty"+ids).val());
  }
  var qty_vals = qty_val;
  if(qty_val == 0){
    qty_vals = db_minqty;
  }else if(qty_val <  db_qty){
    qty_vals = parseFloat(qty_val)+parseFloat(hfsec);
  }
  if(qty_val < db_qty){
    jQuery(".qty"+ids).val(qty_vals + " " + unit_symbol);
    var final_qty_val = qty_vals;
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "units_id" : units_id, "qty_vals" : final_qty_val, "hfsec" : hfsec, "s_m_units_maxlimit_4_ratesss" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".data_qtyrate").attr("data-rate",res);
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : final_qty_val, "s_m_rate" : res, "method_name" : method_name, "units_id" : units_id, "frequently_discount_id" : frequently_discount_id, "type" : type, "add_to_cart" : 1 },
          url : site_url+"front/firststep.php",
          success : function(res){
            jQuery(".freq_discount_display").show();
            jQuery(".hide_right_side_box").show();
            jQuery(".partial_amount_hide_on_load").show();
            jQuery(".empty_cart_error").hide();
            jQuery(".no_units_in_cart_error").hide();
            jQuery(".coupon_invalid_error").hide();
            jQuery("#total_cart_count").val("2");
            var cart_session_data=jQuery.parseJSON(res);
            jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
            jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
            if(cart_session_data.status == "update"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "insert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                            
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "firstinsert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                            
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "empty calculation"){
              jQuery(".hideduration_value").hide();
              jQuery(".total_time_duration_text").html("");
              jQuery(".freq_discount_display").hide();
              jQuery(".partial_amount_hide_on_load").hide();
              jQuery(".hide_right_side_box").hide();
              jQuery( ".cart_empty_msg" ).show();
              jQuery( ".frequent_discount" ).empty();
              jQuery( ".cart_item_listing" ).empty();
              jQuery( ".cart_sub_total" ).empty();
              jQuery( ".cart_tax" ).empty();
              jQuery( ".cart_special_days" ).empty();                               
              jQuery( ".cart_total" ).empty();
              jQuery( ".remain_amount" ).empty();
              jQuery( ".partial_amount" ).empty();
              jQuery( ".cart_discount" ).empty();
            }else if(cart_session_data.status == "delete particuler"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery( ".update_qty_of_s_m_"+m_name).remove();
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days); 
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }
          }
        });
      }
    });
  }else{
  jQuery(".d4m-loading-main").hide();
    jQuery(".qty"+ids).val(qty_vals + " " + unit_symbol);
  }
});
jQuery(document).on("click",".minuss",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
	jQuery(".custom_item_error").hide();
jQuery(".custom_item_error").html("");
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var ids = jQuery(this).attr("data-ids");
  var db_qty = jQuery(this).attr("data-db-qty");
  var db_minqty = jQuery(this).attr("data-db-minqty");
  var service_id = jQuery(this).attr("data-service_id");
  var method_id = jQuery(this).attr("data-method_id");
  var method_name = jQuery(this).attr("data-method_name");
  var hfsec = jQuery(this).attr("data-hfsec");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var unit_symbol = jQuery(this).attr("data-unit_symbol");
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide(); 
  /* */

   /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var currentVal = parseFloat(jQuery(".qty"+ids).val());
  var m_name = jQuery(this).attr("data-mnamee");
  var qty_val = 0;
  if(unit_symbol != ""){
    var qty_val_orignal = jQuery("#qty"+ids).val();
    var qty_val_array = qty_val_orignal.split(" ");
    qty_val = parseFloat(qty_val_array[0]);
  }else{
    qty_val = parseFloat(jQuery("#qty"+ids).val());
  }
  var qty_vals = qty_val;
  if(qty_val >  db_minqty){
    qty_vals = qty_val-hfsec;
  } else {
    qty_vals = 0;
  }
  if(currentVal <= 0){
    jQuery(".d4m-loading-main").hide();
    jQuery(".qty"+ids).val("0 " + unit_symbol);
    jQuery( ".update_qty_of_s_m_"+m_name).remove();
  }else if(currentVal > 0){
    jQuery(".qty"+ids).val(qty_vals + " " + unit_symbol);
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "qty_vals" : qty_vals, "units_id" : units_id, "hfsec" : hfsec, "s_m_units_maxlimit_4_ratesss" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".data_qtyrate").attr("data-rate",res);
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : qty_vals, "s_m_rate" : res, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
          url : site_url+"front/firststep.php",
          success : function(res){
            jQuery(".freq_discount_display").show();
            jQuery(".hide_right_side_box").show();
            jQuery(".partial_amount_hide_on_load").show();
            jQuery(".empty_cart_error").hide();
            jQuery(".no_units_in_cart_error").hide();
            jQuery(".coupon_invalid_error").hide();
            jQuery("#total_cart_count").val("2");
            var cart_session_data=jQuery.parseJSON(res);
            jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
            jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
            if(cart_session_data.status == "update"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "insert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);       
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "firstinsert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                            
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "empty calculation"){
              jQuery(".hideduration_value").hide();
              jQuery(".total_time_duration_text").html("");
              jQuery(".freq_discount_display").hide();
              jQuery(".partial_amount_hide_on_load").hide();
              jQuery(".hide_right_side_box").hide();
              jQuery( ".cart_empty_msg" ).show();
              jQuery( ".cart_item_listing" ).empty();
              jQuery( ".cart_sub_total" ).empty();
              jQuery( ".frequent_discount" ).empty();
              jQuery( ".cart_tax" ).empty();
              jQuery( ".cart_special_days" ).empty();                            
              jQuery( ".cart_total" ).empty();
              jQuery( ".remain_amount" ).empty();
              jQuery( ".partial_amount" ).empty();
              jQuery( ".cart_discount" ).empty();
            }else if(cart_session_data.status == "delete particuler"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }
          }
        });
      }
    });
  }
});
jQuery(document).on("keyup","#d4marea_m_units",function(event){
  jQuery(".freq_disc_empty_cart_error").hide();
  jQuery(".error_of_invalid_area").hide();
  jQuery(".error_of_min_limitss").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var area_uniit = jQuery( "#d4marea_m_units" ).val();
  var service_id = jQuery(this).attr("data-service_id");
  var method_id = jQuery(this).attr("data-method_id");
  var max_limitts = parseFloat(jQuery(this).attr("data-maxx_limit"));
  var min_limitts = parseFloat(jQuery(this).attr("data-minn_limit"));
  var method_name = jQuery(this).attr("data-method_name");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var frequently_discount_id = jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide(); 
  /* */

   /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var m_name = jQuery(this).attr("data-mnamee");
  if(event.which == 8){
    jQuery(".error_of_invalid_area").hide();
    jQuery(".error_of_max_limitss").hide();
    jQuery(".error_of_min_limitss").hide();
  }
  if(area_uniit != "" && /^[0-9\.]+$/.test(area_uniit) == false) {
    jQuery(".error_of_invalid_area").show();
    jQuery(".error_of_invalid_area").html(errorobj_invalid+" "+method_name);
    return false;
  }
  if(area_uniit == ""){
    console.log({ "method_id" : method_id, "service_id" : service_id, "s_m_qty" : 0, "s_m_rate" : 0, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 });
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : 0, "s_m_rate" : 0, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
      url : site_url+"front/firststep.php",
      success : function(res){
        jQuery(".freq_discount_display").show();
        jQuery(".hide_right_side_box").show();
        jQuery(".partial_amount_hide_on_load").show();
        jQuery(".empty_cart_error").hide();
        jQuery(".no_units_in_cart_error").hide();
        jQuery(".coupon_invalid_error").hide();
        jQuery("#total_cart_count").val("2");
        var cart_session_data=jQuery.parseJSON(res);
        jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
        jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
        if(cart_session_data.status == "empty calculation"){
          jQuery(".hideduration_value").hide();
          jQuery(".total_time_duration_text").html("");
          jQuery(".freq_discount_display").hide();
          jQuery(".partial_amount_hide_on_load").hide();
          jQuery(".hide_right_side_box").hide();
          jQuery( ".cart_empty_msg" ).show();
          jQuery( ".cart_item_listing" ).empty();
          jQuery( ".frequent_discount" ).empty();
          jQuery( ".cart_sub_total" ).empty();
          jQuery( ".cart_tax" ).empty();
          jQuery( ".cart_special_days" ).empty();                                 
          jQuery( ".cart_total" ).empty();
          jQuery( ".remain_amount" ).empty();
          jQuery( ".partial_amount" ).empty();
          jQuery( ".cart_discount" ).empty();
        }else if(cart_session_data.status == "delete particuler"){
          jQuery( ".cart_empty_msg" ).hide();
          jQuery( ".update_qty_of_s_m_"+m_name).remove();
          jQuery(".partial_amount").html(cart_session_data.partial_amount);
          jQuery(".remain_amount").html(cart_session_data.remain_amount);
          jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
          jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          jQuery(".cart_tax").html(cart_session_data.cart_tax);
          jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
          jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
          jQuery(".cart_total").html(cart_session_data.total_amount);
          jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
        }
      }
    });
  }else if(area_uniit == 0){
    jQuery(".error_of_invalid_area").show();
    jQuery(".error_of_invalid_area").html(errorobj_invalid+" "+method_name);
  }else if(area_uniit > max_limitts){
    jQuery(".error_of_max_limitss").show();
    jQuery(".error_of_max_limitss").html(errorobj_max_limit_reached);
  }else if(area_uniit < min_limitts){
    jQuery(".error_of_min_limitss").show();
    jQuery(".error_of_min_limitss").html(errorobj_min_limit_reached+min_limitts);
  }else if(area_uniit <= max_limitts){
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "units_id" : units_id, "qty_vals" : area_uniit, "s_m_units_maxlimit_4_ratesss" : 1 },
      url : ajax_url+"front_ajax.php",
      success : function(res){
        jQuery(".d4marea_m_units_rattee").attr("data-rate",res);
        jQuery.ajax({
          type : "post",
          data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : area_uniit, "s_m_rate" : res, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
          url : site_url+"front/firststep.php",
          success : function(res){
            jQuery(".freq_discount_display").show();
            jQuery(".hide_right_side_box").show();
            jQuery(".partial_amount_hide_on_load").show();
            jQuery(".empty_cart_error").hide();
            jQuery(".no_units_in_cart_error").hide();
            jQuery(".coupon_invalid_error").hide();
            jQuery("#total_cart_count").val("2");
            var cart_session_data=jQuery.parseJSON(res);
            jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
            jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
            if(cart_session_data.status == "update"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
              jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "insert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "firstinsert"){
              jQuery(".hideduration_value").show();
              jQuery( ".cart_empty_msg" ).hide();
              jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }else if(cart_session_data.status == "empty calculation"){
              jQuery(".hideduration_value").hide();
              jQuery(".total_time_duration_text").html("");
              jQuery(".freq_discount_display").hide();
              jQuery(".partial_amount_hide_on_load").hide();
              jQuery(".hide_right_side_box").hide();
              jQuery( ".cart_empty_msg" ).show();
              jQuery( ".cart_item_listing" ).empty();
              jQuery( ".cart_sub_total" ).empty();
              jQuery( ".frequent_discount" ).empty();
              jQuery( ".cart_tax" ).empty();
              jQuery( ".cart_special_days" ).empty();                          
              jQuery( ".cart_total" ).empty();
              jQuery( ".remain_amount" ).empty();
              jQuery( ".partial_amount" ).empty();
              jQuery( ".cart_discount" ).empty();
            }else if(cart_session_data.status == "delete particuler"){
              jQuery( ".cart_empty_msg" ).hide();
              jQuery( ".update_qty_of_s_m_"+m_name).remove();
              jQuery(".partial_amount").html(cart_session_data.partial_amount);
              jQuery(".remain_amount").html(cart_session_data.remain_amount);
              jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
              jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
              jQuery(".cart_tax").html(cart_session_data.cart_tax);
              jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                         
              jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
              jQuery(".cart_total").html(cart_session_data.total_amount);
              jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
            }
          }
        });
      }
    });
  }else{
    jQuery(".d4m-loading-main").hide();
    jQuery(".error_of_invalid_area").show();
    jQuery(".error_of_invalid_area").html(errorobj_invalid+" "+method_name);
  }
});
jQuery(document).on("click",".add_item_in_cart",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
	jQuery(".custom_item_error").hide();
jQuery(".custom_item_error").html("");
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();

  /* */
  jQuery(".user_coupon_display").hide();
  jQuery(".hide_user_coupon_textbox").show();
  jQuery(".d4m-display-user-coupon-code").hide(); 
  /* */

   /* */

  jQuery(".hide_referral_textbox").show();
  jQuery(".d4m-display-referral-code").hide();  

  /* */

  jQuery(".coupon_invalid_error").hide();
  var s_m_qty=jQuery(this).attr("data-duration_value");
  var s_m_rate=jQuery(this).attr("data-rate");
  var service_id=jQuery(this).attr("data-service_id");
  var method_id=jQuery(this).attr("data-method_id");
  var method_name=jQuery(this).attr("data-method_name");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var m_name = jQuery(this).attr("data-mnamee");
  jQuery.ajax({
    type : "post",
    data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : s_m_qty, "s_m_rate" : s_m_rate, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
    url : site_url+"front/firststep.php",
    success : function(res){
      jQuery(".freq_discount_display").show();
      jQuery(".hide_right_side_box").show();
      jQuery(".partial_amount_hide_on_load").show();
      jQuery(".empty_cart_error").hide();
      jQuery(".no_units_in_cart_error").hide();
      jQuery(".coupon_invalid_error").hide();
      jQuery("#total_cart_count").val("2");
      var cart_session_data=jQuery.parseJSON(res);
      jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
      jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
      if(cart_session_data.status == "update"){
        jQuery( ".cart_empty_msg" ).hide();
        jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
        jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-service_id",service_id);
        jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-method_id",method_id);
        jQuery(".update_qty_of_s_m_"+cart_session_data.method_name_without_space).val("data-units_id",units_id);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                                                              
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
        jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
      }else if(cart_session_data.status == "insert"){
        jQuery(".hideduration_value").show();
        jQuery( ".cart_empty_msg" ).hide();
        jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                                                           
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
        jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
      }else if(cart_session_data.status == "firstinsert"){
        jQuery(".hideduration_value").show();
        jQuery( ".cart_empty_msg" ).hide();
        jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                                                           
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
        jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
      }else if(cart_session_data.status == "empty calculation"){
        jQuery(".hideduration_value").hide();
        jQuery(".total_time_duration_text").html("");
        jQuery(".freq_discount_display").hide();
        jQuery(".partial_amount_hide_on_load").hide();
        jQuery(".hide_right_side_box").hide();
        jQuery( ".cart_empty_msg" ).show();
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".cart_special_days" ).empty();                                  
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery(".frequent_discount").empty();
      }else if(cart_session_data.status == "delete particuler"){
        jQuery( ".cart_empty_msg" ).hide();
        jQuery( ".update_qty_of_s_m_"+m_name).remove();
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                                                              
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
        jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
      }
    }
  });
});



jQuery(document).on("click touchstart","#apply_referral",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var referral_code = jQuery("#referral_val").val();
    if(referral_code == ""){
      jQuery(".d4m-loading-main").hide();
      jQuery(".invalid_referral_error").css("display","block");
      jQuery(".invalid_referral_error").html("Enter referral code");
    }else{
      jQuery.ajax({
        type:"POST",
        url: site_url+"front/firststep.php",
        data : { "referral_code" : referral_code,"referral_check" : 1 },
        success: function(res){
          jQuery(".d4m-loading-main").hide();
          jQuery(".freq_discount_display").show();
          jQuery(".d4m-display-referral-code").show();
          jQuery(".hide_referral_textbox").hide();
        }
      });
    }
});

jQuery(document).on("click touchstart","#apply_referral",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var referral_code = jQuery("#referral_val").val();
  var dataString={referral_code:referral_code,action:"referral_check"};
    if(referral_code == ""){
      jQuery(".d4m-loading-main").hide();
      jQuery(".invalid_referral_error").css("display","block");
      jQuery(".invalid_referral_error").html("Enter referral code");
    }else{
      jQuery.ajax({
        type:"POST",
        url: site_url+"front/checkout.php",
        data : dataString,
        success: function(res){
          jQuery(".freq_discount_display").show();
          jQuery(".d4m-display-referral-code").hide();
          jQuery(".hide_referral_textbox").show();
        }
      });
    }
});

jQuery(document).on("click","#apply_referral",function(){
  jQuery(".invalid_referral_error").hide();
});

/*Reverse Coupon Code*/
/*jQuery(document).on("click touchstart",".user_referral_coupon",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var display_referral = jQuery("#display_referral").text();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery.ajax({
    type:"POST",
    url: site_url+"front/firststep.php",
    data : { "display_referral" : display_referral, "frequently_discount_id" : frequently_discount_id, "referral_code_reversed" : 1 },
    success: function(res){
      jQuery(".d4m-loading-main").hide(); 
      jQuery(".freq_discount_display").show();
      jQuery(".d4m-display-referral-code").hide();
      jQuery(".hide_referral_textbox").show();
    }
  });
});*/

jQuery(document).on("click", ".user_referral_coupon", function(){
  jQuery("#referral_val").val('');
});



jQuery(document).on("click touchstart","#apply_user_coupon",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var user_coupon_val = jQuery(".user_coupon_val").val();
  var subtotal = jQuery(".cart_sub_total").text();

  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  if(subtotal == ""){
    jQuery(".d4m-loading-main").hide();
    jQuery(".user_coupon_invalid_error").css("display","block");
    jQuery(".user_coupon_invalid_error").html(errorobj_your_cart_is_empty_please_add_cleaning_services);
  }else{
    if(user_coupon_val == ""){
      jQuery(".d4m-loading-main").hide();
      jQuery(".user_coupon_invalid_error").css("display","block");
      jQuery(".user_coupon_invalid_error").html(errorobj_please_enter_coupon_code);
    }else{
      jQuery.ajax({
        type:"POST",
        url: site_url+"front/firststep.php",
        data : { "user_coupon_val" : user_coupon_val,"frequently_discount_id" : frequently_discount_id,"coupon_code_check" : 1 },
        success: function(res){
          jQuery(".d4m-loading-main").hide();
          var cart_session_data=jQuery.parseJSON(res);
          if(cart_session_data.discount_status == "not"){
            jQuery(".user_coupon_invalid_error").css("display","block");
            jQuery(".user_coupon_invalid_error").html(errorobj_coupon_expired);
          } else if (cart_session_data.discount_status == "wrongcode"){
            jQuery(".user_coupon_invalid_error").css("display","block");
            jQuery(".user_coupon_invalid_error").html(errorobj_invalid_coupon);
          }else if(cart_session_data.discount_status == "available"){
            jQuery(".freq_discount_display").show();
            jQuery(".d4m-display-user-coupon-code").show();
            jQuery(".hide_user_coupon_textbox").hide();
            jQuery(".user_coupon_display").show();
            jQuery(".d4m-apply-user-coupon").hide();
            jQuery(".partial_amount").html(cart_session_data.partial_amount);
            jQuery(".remain_amount").html(cart_session_data.remain_amount);
            jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
            jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
            jQuery(".cart_tax").html(cart_session_data.cart_tax);
            jQuery(".cart_total").html(cart_session_data.total_amount);
            jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          }
        }
      });
    }
  }
});

jQuery(document).on("click","#user_coupon_val",function(){
  jQuery(".user_coupon_invalid_error").hide();
});

/*Reverse Coupon Code*/
jQuery(document).on("click touchstart",".user_reverse_coupon",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var display_user_coupon = jQuery("#display_user_code").text();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery.ajax({
    type:"POST",
    url: site_url+"front/firststep.php",
    data : { "display_user_coupon" : display_user_coupon, "frequently_discount_id" : frequently_discount_id, "referral_reversed" : 1 },
    success: function(res){
      jQuery(".d4m-loading-main").hide();
      var cart_session_data=jQuery.parseJSON(res);
      if(cart_session_data.status == "reversed"){
        jQuery(".freq_discount_display").show();
        jQuery(".d4m-display-user-coupon-code").hide();
        jQuery(".hide_user_coupon_textbox").show();
        jQuery(".user_coupon_display").hide();
        jQuery(".d4m-apply-user-coupon").show();
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
      }
    }
  });
}); 


jQuery(document).on("click touchstart","#apply_coupon",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var coupon_code=jQuery("#coupon_val").val();
  var subtotal=jQuery(".cart_sub_total").text();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  if(subtotal == ""){
    jQuery(".d4m-loading-main").hide();
    jQuery(".coupon_invalid_error").css("display","block");
    jQuery(".coupon_invalid_error").html(errorobj_your_cart_is_empty_please_add_cleaning_services);
  }else{
    if(coupon_code == ""){
      jQuery(".d4m-loading-main").hide();
      jQuery(".coupon_invalid_error").css("display","block");
      jQuery(".coupon_invalid_error").html("Invalid coupon code");
    }else{
      jQuery.ajax({
        type:"POST",
        url: site_url+"front/firststep.php",
        data : { "coupon_code" : coupon_code, "frequently_discount_id" : frequently_discount_id, "coupon_check" : 1 },
        success: function(res){
          jQuery(".d4m-loading-main").hide();
          var cart_session_data=jQuery.parseJSON(res);
          if(cart_session_data.discount_status == "not"){
            jQuery(".coupon_invalid_error").css("display","block");
            jQuery(".coupon_invalid_error").html(errorobj_coupon_expired);
          }
          else if(cart_session_data.discount_status == "wrongcode"){
            jQuery(".coupon_invalid_error").css("display","block");
            jQuery(".coupon_invalid_error").html(errorobj_invalid_coupon);
          }else if(cart_session_data.discount_status == "available"){
            jQuery(".d4m-display-coupon-code").show();
            jQuery(".freq_discount_display").show();
            jQuery(".hide_coupon_textbox").hide();
            jQuery(".coupon_display").show();
            jQuery(".partial_amount").html(cart_session_data.partial_amount);
            jQuery(".remain_amount").html(cart_session_data.remain_amount);
            jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
            jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
            jQuery(".cart_tax").html(cart_session_data.cart_tax);
            jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                          
            jQuery(".cart_total").html(cart_session_data.total_amount);
            jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          }
        }
      });
    }
  }
});

jQuery(document).on("click","#coupon_val",function(){
  jQuery(".coupon_invalid_error").hide();
});
/*Reverse Coupon Code*/
jQuery(document).on("click touchstart",".reverse_coupon",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var coupon_reverse = jQuery("#display_code").text();
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  jQuery.ajax({
    type:"POST",
    url: site_url+"front/firststep.php",
    data : { "coupon_reverse" : coupon_reverse, "frequently_discount_id" : frequently_discount_id, "coupon_reversed" : 1 },
    success: function(res){
      jQuery(".d4m-loading-main").hide();
      var cart_session_data=jQuery.parseJSON(res);
      if(cart_session_data.status == "reversed"){
        jQuery(".freq_discount_display").show();
        jQuery(".d4m-display-coupon-code").hide();
        jQuery(".hide_coupon_textbox").show();
        jQuery(".coupon_display").hide();
        jQuery(".partial_amount").html(cart_session_data.partial_amount);
        jQuery(".remain_amount").html(cart_session_data.remain_amount);
        jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
        jQuery(".cart_tax").html(cart_session_data.cart_tax);
        jQuery(".cart_special_days").html(cart_session_data.cart_special_days);           
        jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
        jQuery(".cart_total").html(cart_session_data.total_amount);
      }
    }
  });
});
/*** calendar code start ***/
/* time slots dropdown show hide list */
jQuery(document).on("click",".time-slot-is",function() {
  jQuery(".time-slots-dropdown").show( "blind", {direction: "vertical"}, 700 );
});
jQuery(document).on("click",".time-slot",function() {
  jQuery(".time-slot").each(function(){
    jQuery(this).removeClass("selected-time-slot");
  });
  jQuery(this).addClass("selected-time-slot");
  jQuery(".time-slots-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".d4m-week", function() {
  var valuess = jQuery(this).val();
  var s_date = jQuery(this).attr("data-s_date");
  var c_date = jQuery(this).attr("data-c_date");
  if(s_date >= c_date){
    jQuery(".d4m-week").each(function(){
      jQuery(this).removeClass("active");
      jQuery(".d4m-show-time").removeClass("shown");
    });
    jQuery(this).addClass("active");
    jQuery(".d4m-show-time").addClass("shown");
  }else if(s_date < c_date || valuess == ""){
    jQuery(".time_slot_box").hide();
  }
});
jQuery(document).on("click",".selected_date",function() {
  jQuery(".d4m-loading-main").show();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var selected_dates = jQuery(this).attr("data-selected_dates");
  var s_date = jQuery(this).attr("data-s_date");
  var cur_dates = jQuery(this).attr("data-cur_dates");
  var c_date = jQuery(this).attr("data-c_date");
  var id = jQuery(this).attr("data-id");
  var d4mtime_selected = jQuery(".d4m-time-selected").text();
  var d4mdate = jQuery("#save_selected_date").val();
  jQuery.ajax({
    type:"POST",
    url: ajax_url+"calendar_ajax.php",
    data : { "selected_dates" : selected_dates, "id" : id, "cur_dates" : cur_dates, "get_slots" : 1 },
    success: function(res){
      jQuery(".d4m-loading-main").hide();
      jQuery(".time_slot_box").hide();
      jQuery(".display_selected_date_slots_box"+id).html(res);
      jQuery(".display_selected_date_slots_box"+id).show();
      if(d4mtime_selected != ""){
        jQuery(".time-slot").each(function(){
          var selectedtime = jQuery(this).attr("data-d4mtime_selected");
          var slot_date = jQuery(this).attr("data-slot_date");
          if(selectedtime == d4mtime_selected && slot_date == d4mdate){
            jQuery(this).addClass("d4m-booked");
          }
        });
      }
      /*jQuery.ajax({
        type:"POST",
        url: site_url + "front/firststep.php",
        data : { "selected_dates" : selected_dates, "cur_dates" : cur_dates },
        success: function(res){
          jQuery(".d4m-loading-main").hide();
          jQuery(".time_slot_box").hide();
          jQuery(".display_selected_date_slots_box"+id).html(res);
          jQuery(".display_selected_date_slots_box"+id).show();
          
          if(d4mtime_selected != ""){
            jQuery(".time-slot").each(function(){
              var selectedtime = jQuery(this).attr("data-d4mtime_selected");
              var slot_date = jQuery(this).attr("data-slot_date");
              if(selectedtime == d4mtime_selected && slot_date == d4mdate){
                jQuery(this).addClass("d4m-booked");
              }
            });
          }
        }
      });*/             
    }
  });
});
jQuery(document).on("click",".previous_next,.today_btttn",function() {
  jQuery(".d4m-loading-main").show();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  var month = jQuery(this).attr("data-next_month");
  var year = jQuery(this).attr("data-next_month_year");
  var todaybtn = jQuery(this).attr("data-istoday");
  var today_date = jQuery(this).attr("data-cur_dates");
  var d4mdate_selected = jQuery(".d4m-date-selected").text();
  var d4mtime_selected = jQuery(".d4m-time-selected").text();
  var d4mdate = jQuery(".d4m-date-selected").attr("data-date");
  jQuery.ajax({
    type:"POST",
    url: ajax_url+"calendar_ajax.php",
    data : { "month" : month, "year" : year, "get_calendar" : 1 },
    success: function(res){
      jQuery(".d4m-loading-main").hide();
      jQuery(".cal_info").html(res);
      if(d4mdate_selected != ""){
        jQuery(".add_date").addClass("d4m-date-selected");
        jQuery(".add_time").addClass("d4m-time-selected");
        jQuery(".add_date").html(d4mdate_selected);
        jQuery(".add_date").attr("data-date",d4mdate);
        jQuery(".add_time").html(d4mtime_selected);
        jQuery(".d4m-week").each(function(){
          var selecteddate = jQuery(this).attr("data-selected_dates");
          if(selecteddate == d4mdate){
            jQuery(".selected_datess"+d4mdate).addClass("active");
            jQuery(".time-slot").each(function(){
              var selectedtime = jQuery(this).attr("data-d4mtime_selected");
              if(selectedtime == d4mtime_selected && selecteddate == d4mdate){
                jQuery(this).addClass("d4m-booked");
              }
            });
          }
        });
      }
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = day + "-" +(month<10 ? "0" : "") + month + "-" +  d.getFullYear();
      var selected_dates = jQuery(".selected_date").attr("data-selected_dates");
      var cur_dates = jQuery(".selected_date").attr("data-cur_dates");
      if(output == cur_dates){
        jQuery(".by_default_today_selected").addClass("active_today");
      }
      if(todaybtn=="Y"){
        jQuery(".dates .selected_datess"+today_date).trigger("click");
      }
    }
  });
});
jQuery(document).on("click",".time_slotss",function() {
  jQuery(".d4m-selected-date-view").removeClass("pulse");
  jQuery(".date_time_error").hide();
  jQuery(".time_slot_box").hide();
  jQuery(".space_between_date_time").show();
  jQuery(".special_day").show();                                                
  jQuery(".hidedatetime_value").show();
  jQuery(".add_date").addClass("d4m-date-selected");
  jQuery(".add_time").addClass("d4m-time-selected");
  var slot_date_to_display = jQuery(this).attr("data-slot_date_to_display");
  var slot_date = jQuery(this).attr("data-slot_date");
  var slotdb_date = jQuery(this).attr("data-slotdb_date");
  var slot_time = jQuery(this).attr("data-slot_time");
  var slotdb_time = jQuery(this).attr("data-slotdb_time");
  var d4mdate_selected = jQuery(this).attr("data-d4mdate_selected");
  var d4mtime_selected = jQuery(this).attr("data-d4mtime_selected");
  jQuery(".d4m-date-selected").attr("data-date",slot_date);
  jQuery("#save_selected_date").val(slot_date); 
  jQuery(".d4m-date-selected").html(d4mdate_selected);
  jQuery(".d4m-time-selected").html(d4mtime_selected);
  jQuery(".d4m-selected-date-view").addClass("pulse");
  jQuery(".cart_date").html(slot_date_to_display);
  jQuery(".cart_date").attr("data-date_val",slotdb_date);
  jQuery(".cart_time").html(slot_time);
  jQuery(".cart_time").attr("data-time_val",slotdb_time);
});
jQuery(document).on("click",".today_btttn",function() {
  var today_date = jQuery(this).attr("data-cur_dates");
  jQuery(".dates .selected_datess"+today_date).trigger("click");
});
/*** calendar code end ***/
/* Display Country Code on click flag on phone*/
jQuery(document).on("click",".country",function() {
  var country_code=jQuery(this).attr("data-dial-code");
  jQuery("#d4m-user-phone").val("+"+country_code);
});
/** Code for area code **/
if(d4mpostalcode_status_check == "Y"){
  jQuery(document).on("keyup","#d4mpostal_code",function(event){
    var ajax_url=ajaxurlObj.ajax_url;
    var postal_code = jQuery(this).val().toLowerCase();
    if(d4mpostalcode_zip_status == "on"){
      jQuery("#app-zip-code").val(postal_code);
    }
    if(postal_code == ""){
      jQuery(".remove_show_error_class").addClass("show-error");
      jQuery("#complete_bookings").addClass("d4mremove_id");
      jQuery(document).on("click",".d4mremove_id",function(){
        jQuery("#d4mpostal_code").focus();
      });
      jQuery(".d4mremove_id").attr("id","");
      jQuery(".postal_code_available").hide();
      jQuery(".postal_code_error").show();
      jQuery(".postal_code_error").html(errorobj_please_enter_postal_code);
    }else{
      var check_postal_code = false;
      jQuery(".postal_code_error").hide();
      jQuery(".postal_code_available").hide();
      if (jQuery.inArray(postal_code, get_all_postal_code) !== -1) {
        check_postal_code = true;
      } else {
        jQuery.each(get_all_postal_code, function(key, value) {
          if (postal_code.substr(0, value.length) === value) {
            check_postal_code = true;
          }
        });
      }
      if (check_postal_code) {
        jQuery(".d4mremove_id").attr("id", "complete_bookings");
        jQuery("#complete_bookings").removeClass("d4mremove_id");
        jQuery(".remove_show_error_class").removeClass("show-error");
        jQuery(".postal_code_error").hide();
      } else {
        jQuery(".remove_show_error_class").addClass("show-error");
        jQuery("#complete_bookings").addClass("d4mremove_id");
        jQuery(document).on("click", ".d4mremove_id", function() {
          jQuery("#d4mpostal_code").focus();
        });
        jQuery(".d4mremove_id").attr("id", "");
        jQuery(".postal_code_error").show();
        jQuery(".postal_code_error").html(errorobj_our_service_not_available_at_your_location);
      }
    }
    jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
  });
}
jQuery(document).on("click",".add_addon_in_cart_for_multipleqty",function(){
  jQuery(".freq_disc_empty_cart_error").hide();
  var site_url=siteurlObj.site_url;
  var ajax_url=ajaxurlObj.ajax_url;
  jQuery(".coupon_display").hide();
  jQuery(".hide_coupon_textbox").show();
  jQuery(".d4m-display-coupon-code").hide();
  jQuery(".coupon_invalid_error").hide();
  var s_m_qty=jQuery(this).attr("data-duration_value");
  var s_m_rate=jQuery(this).attr("data-rate");
  var service_id=jQuery(this).attr("data-service_id");
  var method_id=jQuery(this).attr("data-method_id");
  var method_name=jQuery(this).attr("data-method_name");
  var units_id=jQuery(this).attr("data-units_id");
  var type=jQuery(this).attr("data-type");
  var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").attr("data-id");
  var m_name = jQuery(this).attr("data-mnamee");
  var status = jQuery(this).attr("data-status");
  if(parseInt(status) == 2){
    jQuery(this).attr("data-status","1");
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : s_m_qty, "s_m_rate" : s_m_rate, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
      url : site_url+"front/firststep.php",
      success : function(res){
        jQuery(".freq_discount_display").show();
        jQuery(".hide_right_side_box").show();
        jQuery(".partial_amount_hide_on_load").show();
        jQuery(".empty_cart_error").hide();
        jQuery(".coupon_invalid_error").hide();
        jQuery("#total_cart_count").val("2");
        var cart_session_data=jQuery.parseJSON(res);
        jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
        jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
        if(cart_session_data.status == "insert"){
          jQuery( ".cart_empty_msg" ).hide();
          jQuery(".cart_item_listing").append(cart_session_data.s_m_html);
          jQuery(".partial_amount").html(cart_session_data.partial_amount);
          jQuery(".remain_amount").html(cart_session_data.remain_amount);
          jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
          jQuery(".cart_tax").html(cart_session_data.cart_tax);
          jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                     
          jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
          jQuery(".cart_total").html(cart_session_data.total_amount);
          jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
        }else if(cart_session_data.status == "empty calculation"){
          jQuery(".hideduration_value").hide();
          jQuery(".total_time_duration_text").html("");
          jQuery(".freq_discount_display").show();
          jQuery(".partial_amount_hide_on_load").hide();
          jQuery(".hide_right_side_box").hide();
          jQuery( ".cart_empty_msg" ).show();
          jQuery( ".cart_item_listing" ).empty();
          jQuery( ".cart_sub_total" ).empty();
          jQuery( ".frequent_discount" ).empty();
          jQuery( ".cart_tax" ).empty();
          jQuery( ".cart_special_days" ).empty();                             
          jQuery( ".cart_total" ).empty();
          jQuery( ".remain_amount" ).empty();
          jQuery( ".partial_amount" ).empty();
          jQuery( ".cart_discount" ).empty();
        }else if(cart_session_data.status == "delete particuler"){
          jQuery( ".cart_empty_msg" ).hide();
          jQuery( ".update_qty_of_s_m_"+m_name).remove();
          jQuery(".partial_amount").html(cart_session_data.partial_amount);
          jQuery(".remain_amount").html(cart_session_data.remain_amount);
          jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
          jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
          jQuery(".cart_tax").html(cart_session_data.cart_tax);
          jQuery(".cart_special_days").html(cart_session_data.cart_special_days);             
          jQuery(".cart_total").html(cart_session_data.total_amount);
          jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
        }
      }
    });
  }else{
    jQuery(this).attr("data-status","2");
    jQuery.ajax({
      type : "post",
      data : { "method_id" : method_id, "service_id" : service_id, "s_m_qty" : s_m_qty, "s_m_rate" : s_m_rate, "method_name" : method_name, "units_id" : units_id, "type" : type, "frequently_discount_id" : frequently_discount_id, "add_to_cart" : 1 },
      url : site_url+"front/firststep.php",
      success : function(res){
        jQuery(".freq_discount_display").show();
        jQuery(".hide_right_side_box").show();
        jQuery(".partial_amount_hide_on_load").show();
        jQuery(".empty_cart_error").hide();
        jQuery(".coupon_invalid_error").hide();
        jQuery("#total_cart_count").val("2");
        var cart_session_data=jQuery.parseJSON(res);
        jQuery("#no_units_in_cart_err").val(cart_session_data.unit_status);
        jQuery("#no_units_in_cart_err_count").val(cart_session_data.unit_require);
        if(cart_session_data.status == "empty calculation"){
          jQuery(".hideduration_value").hide();
          jQuery(".total_time_duration_text").html("");
          jQuery(".partial_amount_hide_on_load").hide();
          jQuery(".hide_right_side_box").hide();
          jQuery( ".cart_empty_msg" ).show();
          jQuery( ".cart_item_listing" ).empty();
          jQuery( ".cart_sub_total" ).empty();
          jQuery( ".cart_tax" ).empty();
          jQuery( ".cart_special_days" ).empty();                                 
          jQuery( ".cart_total" ).empty();
          jQuery( ".frequent_discount" ).empty();
          jQuery( ".remain_amount" ).empty();
          jQuery( ".partial_amount" ).empty();
          jQuery( ".cart_discount" ).empty();
        }else if(cart_session_data.status == "delete particuler"){
          jQuery( ".cart_empty_msg" ).hide();
          jQuery( ".update_qty_of_s_m_"+m_name).remove();
          jQuery(".partial_amount").html(cart_session_data.partial_amount);
          jQuery(".remain_amount").html(cart_session_data.remain_amount);
          jQuery(".cart_sub_total").html(cart_session_data.cart_sub_total);
          jQuery(".cart_discount").html("- "+cart_session_data.cart_discount);
          jQuery(".cart_tax").html(cart_session_data.cart_tax);
          jQuery(".cart_special_days").html(cart_session_data.cart_special_days);                                                     
          jQuery(".frequent_discount").html(cart_session_data.frequent_discount);
          jQuery(".cart_total").html(cart_session_data.total_amount);
          jQuery(".total_time_duration_text").html(cart_session_data.duration_text);
        }
      }
    });
  }
});
/*Reset Password*/
jQuery(document).on("click","#reset_pass",function(){
  jQuery(".d4m-loading-main").show();
  jQuery(".add_show_error_class").each(function(){
    jQuery(this).trigger("keyup");
  });
  var front_url=fronturlObj.front_url;
  var site_url=siteurlObj.site_url;
  var email=jQuery("#rp_user_email").val();
  var dataString={email:email,action:"forget_password"};
  if(jQuery("#forget_pass").valid()){
    jQuery.ajax({
      type:"POST",
      url:front_url+"firststep.php",
      data:dataString,
      success:function(response){
        jQuery(".d4m-loading-main").hide();
        if(response=="not"){
          jQuery(".forget_pass_incorrect").css("display","block");
          jQuery(".forget_pass_incorrect").css("color","red");
          jQuery(".forget_pass_incorrect").html(errorobj_invalid_email_id_please_register_first);
        } else {
          jQuery(".forget_pass_correct").css("display","block");
          jQuery(".forget_pass_correct").css("color","green");
          jQuery(".forget_pass_correct").html(errorobj_your_password_send_successfully_at_your_registered_email_id);
          jQuery("#reset_pass").unbind("click");
          jQuery("#reset_pass").css({"pointer-events": "none", "cursor": "default"});
          setTimeout(function() { window.location.href = site_url;  },5000);
          event.preventDefault();
        }
      },
    });
  }
});
jQuery(document).on("click","#rp_user_email",function(){
  jQuery(".forget_pass_incorrect").hide();
});
jQuery(document).on("click","#rn_password",function(){
  jQuery(".mismatch_password").hide();
});
jQuery(document).on("click","#n_password",function(){
  jQuery(".mismatch_password").hide();
});
jQuery(document).on("click","#password",function(){
  jQuery(".succ_password").hide();
});
jQuery(document).on("click","#email",function(){
  jQuery(".succ_password").hide();
});
/*Reset New Password*/
jQuery(document).on("click","#reset_new_password",function(){
  jQuery(".d4m-loading-main").show();
  var front_url=fronturlObj.front_url;
  var new_reset_pass=jQuery("#n_password").val();
  var retype_new_reset_pass=jQuery("#rn_password").val();
  var dataString={retype_new_reset_pass:retype_new_reset_pass,action:"reset_new_password"};
  if(jQuery("#reset_new_passwd").valid()){
    if(new_reset_pass == retype_new_reset_pass){
      jQuery.ajax({
        type:"POST",
        url:front_url+"firststep.php",
        data:dataString,
        success:function(response){
          jQuery(".d4m-loading-main").hide();
          if(response=="password reset successfully"){
            jQuery(".succ_password").css("display","block");
            jQuery(".succ_password").addClass("txt-success");
            jQuery(".succ_password").html(errorobj_your_password_reset_successfully_please_login);
          }
        },
      });
    }else{
      jQuery(".d4m-loading-main").hide();
      jQuery(".mismatch_password").css("display","block");
      jQuery(".mismatch_password").addClass("error");
      jQuery(".mismatch_password").html(errorobj_new_password_and_retype_new_password_mismatch);
    }
  }
});
/* same as above details  */
jQuery(document).on("change","#retype_status",function() {
  var user_address = jQuery("#d4m-street-address").val();
  var user_zipcode = jQuery("#d4m-zip-code").val();
  var user_city = jQuery("#d4m-city").val();
  var user_state = jQuery("#d4m-state").val();
  if(jQuery("#retype_status").prop("checked")) {
    jQuery("#app-street-address").val(user_address);
    if(d4mpostalcode_status_check != "Y"){
      jQuery("#app-zip-code").val(user_zipcode);
    }
    jQuery("#app-city").val(user_city);
    jQuery("#app-state").val(user_state);
  }else{
    jQuery("#app-street-address").val("");
    if(d4mpostalcode_status_check != "Y"){
      jQuery("#app-zip-code").val("");
    }
    jQuery("#app-city").val("");
    jQuery("#app-state").val("");
  }
  jQuery(".fancy_input").each(function(){jQuery(this).trigger("keyup");});
});

jQuery(document).on("click",".d4mmethod_tab-slider--nav li,.d4mmethod_tab-slider--nav li.active", function() {
  if(!jQuery(this).hasClass("d4mmethod_tab-blank_li")){
    var totallis = 0; 
    var selectedli = 0;
    var currentli = jQuery(this).html();
    var divid = jQuery(this).attr("data-id");
    var maindivid = jQuery(this).attr("data-maindivid");
    jQuery(".d4mmethod_tab-slider--nav").each(function(){
      var common_id = jQuery(this).attr("data-id");
      if(jQuery(".d4mmethod_tab-slider--nav_dynamic"+common_id+" li").length == 2){
         jQuery(".d4mmethod_tab-slider--nav_dynamic"+common_id+" ul li").css('width','50%'); 
        
      }else if(jQuery(".d4mmethod_tab-slider--nav_dynamic"+common_id+" li").length == 1){
        jQuery(".d4mmethod_tab-slider--nav_dynamic"+common_id+" ul").append("<li class='d4mmethod_tab-slider-trigger d4mmethod_tab-blank_li'>&nbsp;</li><li class='d4mmethod_tab-slider-trigger d4mmethod_tab-blank_li'>&nbsp;</li>");
      }
    });
    jQuery(".d4mmethod_tab-slider--nav_dynamic"+maindivid+" li").each(function(){
      if(jQuery(this).html()==currentli){
        selectedli = totallis;
      }
      totallis++;
    });
    var leftpercent = 100/totallis;
    var currentpercent = leftpercent*selectedli;
    jQuery("head").find("style").each(function(){
      var attr = jQuery(this).attr("data-dynmicstyle");
      if (typeof attr !== typeof undefined && attr !== false) {
        jQuery(this).remove();
      }
    }); 
    jQuery("<style data-dynmicstyle>.d4mmethod_tab-slider--nav_dynamic"+maindivid+" .d4mmethod_tab-slider-tabs.d4mmethods_slide:after{width:"+leftpercent+"% !important;left:"+currentpercent+"% !important;}</style>").appendTo("head");   
    jQuery(".d4mmethod_tab-slider--nav_dynamic"+maindivid+" li").removeClass("active");
    jQuery(".d4mmethod_tab-slider-trigger_dynamic"+divid).addClass("active");
  }
});


jQuery(document).ready(function(){
  
  jQuery("#step_previous").hide();
  jQuery(document).on("click","#step_next",function() {
    if(jQuery("#d4m-step-two").not(":visible")){
      jQuery("#step_previous").show();
    }
    
    if(jQuery("#d4m-step-one").is(":visible")){
			jQuery("#step_previous").hide();
      jQuery("#postalcodefrm").validate({
		  rules: {
			d4mpostal_code:{
			  required: true,
			  digits: true
			},
		  },
		  messages: {
			d4mpostal_code:{
			  required:"The zip code is required field", 
			  digits: "Only degits allow"
			},
		  }
		});
				
			
		if(jQuery("#postalcodefrm").valid() ){ 
			var postal_code = jQuery("#d4mpostal_code").val();
			postalcode= 1;
		}else{
			postalcode= 0;
		}
		//alert(jQuery("input[name='service-radio']").is("checked"));
		var addon = document.getElementsByName('service-radio');
		if (!jQuery("input[name='service-radio']").is("checked")) {
			jQuery(".custom_service_error").first().html("Please select service");
			service = 0;
		}else{
			jQuery(".custom_service_error").html("");
			
		}
		if(jQuery(".custom_service_error").css('display') == 'none'){
			service = 1;
			if( jQuery('.cart-items-main').find('ul').find("li").length == 0){
				jQuery(".custom_item_error").show();
				jQuery(".custom_item_error").first().html("Please select service item");
				service_item = 0;
			}else{
				service_item = 1;
			}
		}
			
		//alert("hello");
		//alert(jQuery('.cart-items-main').find("ul").find("li").length);
		//alert(jQuery('.d4m-total-amount').text());
		//alert(postalcode);
		//alert(service);
		//alert(service_item);
		if(postalcode  && service && service_item && jQuery(".custom_item_error").css('display') != 'block'){
			var staff_count_forservice = jQuery("#staff_count_forservice").val();
			if(frequency_status.status=='N' && staff_count_forservice=='0'){
				
				jQuery("#d4m-step-one").slideUp(300);
				jQuery("#d4m-step-three").slideDown(300);
				jQuery("#step_previous").show();
			}else{
				jQuery("#d4m-step-one").slideUp(300);
				jQuery("#d4m-step-two").slideDown(300);
				jQuery("#step_previous").show();
			}
		}else{
			return false;
		}
    }

    else if(jQuery("#d4m-step-two").is(":visible")){
			
      jQuery("#d4m-step-two").slideUp(300);
      jQuery("#d4m-step-three").slideDown(300);
    }
    
    else if(jQuery("#d4m-step-three").is(":visible")){
      var booking_date_text = jQuery(".cart_date").text();
      var booking_date = jQuery(".cart_date").attr('data-date_val');
      var booking_time = jQuery(".cart_time").attr('data-time_val');
      var booking_time_text = jQuery(".cart_time").text();

      if(booking_date_text == '' && booking_time_text == ''){
        clicked=false;
        jQuery('.d4m-loading-main-complete_booking').hide();
        jQuery('.date_time_error').css('display','block');
        jQuery('.date_time_error').css('color','red');
        jQuery('.date_time_error').html(errorobj_please_seled4mappointment_date);
        jQuery(this).attr("href",'#date_time_error_id');
        return false;
      }
      jQuery("#d4m-step-three").slideUp(300);
      jQuery("#d4m-step-four").slideDown(300);
    }
    
    else if(jQuery("#d4m-step-four").is(":visible")){
				var exitinguser_data = 0;
				jQuery(".login_unsuccessfull").hide();
				jQuery(".login_unsuccessfull").html("");
				if(jQuery(".d4m-login-existing").css('display') == 'block'){
					jQuery("#user_login_form").validate({
						rules: {
						d4muser_name:{
							required: true,
							
						},
						d4muser_pass:{
							required: true,
						}
						},
						messages: {
						d4muser_name:{
							required:"The email is required field", 
						 
						},
						d4muser_pass:{
							required:"The password is required field", 
						 
						}
						}
					});
						if(jQuery("#user_login_form").valid()){
							jQuery(".login_unsuccessfull").hide();
							jQuery(".login_unsuccessfull").html("");
							if(jQuery("#user_details_form").valid() && is_login_user == "Y"){
								
								jQuery("#app-street-address").rules("add",{ 
									required: true,
									minlength:check_addresss.min,
									maxlength:check_addresss.max,
									messages: { 
										required: errorobj_req_sa,
										minlength:errorobj_min_sa,
										maxlength:errorobj_max_sa
									}
								});
								
								jQuery("#app-zip-code").rules("add", { 
									required: true,
									minlength:check_zip_code.min,
									maxlength:check_zip_code.max, 
									messages: { 
										required: errorobj_req_zc, 
										minlength:errorobj_min_zc, 
										maxlength:errorobj_max_zc
									}
								});
									
								jQuery("#app-city").rules("add",{ 
									required: true,
									minlength:check_city.min,
									maxlength:check_city.max, 
									messages: { 
										required: errorobj_req_ct, 
										minlength:errorobj_min_ct, 
										maxlength:errorobj_max_ct
									}
								});

								jQuery("#app-state").rules("add", { 
									required: true,
									minlength:check_state.min,
									maxlength:check_state.max, 
									messages: { 
										required: errorobj_req_st, 
										minlength:errorobj_min_st, 
										maxlength:errorobj_max_st
									}
								});

								jQuery("#d4m-first-name").rules("add", { 
									required: true,
									messages: { 
										required: errorobj_req_fn
									}
								});
									
								jQuery("#d4m-last-name").rules("add", { 
									required: true, 
									messages: { 
										required: errorobj_req_ln
									}
								});
								 
								jQuery("#d4m-street-address").rules("add",{ 
									required: true, 
									messages: { 
										required: errorobj_req_sa
									}
								});
									
								jQuery("#d4m-zip-code").rules("add", { 
									required: true,
									messages: { 
										required: errorobj_req_zc
									}
								});
								 
								jQuery("#d4m-city").rules("add", 
								{ required: true,
								messages: { required: errorobj_req_ct}});
								
								jQuery("#d4m-state").rules("add", 
								{ required: true,
								messages: { required: errorobj_req_st}});
								 
								jQuery("#d4m-notes").rules("add",{
									required: true,
									messages: { required: errorobj_req_srn}});
								
								jQuery(".login_unsuccessfull").hide();
								jQuery(".login_unsuccessfull").html("");
								jQuery("#d4m-step-four").slideUp(300);
								jQuery("#d4m-step-five").slideDown(300);
								jQuery("#step_next").hide();
								
							}else if(is_login_user != "Y"){
								jQuery(".login_unsuccessfull").show();
								jQuery(".login_unsuccessfull").html("<span style='color:red;'>Please do login</span>");
							}
							
						}
			}else{
	if(jQuery("#user_details_form").valid() ){
		jQuery(".login_unsuccessfull").hide();
		jQuery(".login_unsuccessfull").html("");
		jQuery("#app-street-address").rules("add",{ 
			required: true,
			minlength:check_addresss.min,
			maxlength:check_addresss.max,
			messages: { 
				required: errorobj_req_sa,
				minlength:errorobj_min_sa,
				maxlength:errorobj_max_sa
			}
		});
	  
		jQuery("#app-zip-code").rules("add", { 
			required: true,
			minlength:check_zip_code.min,
			maxlength:check_zip_code.max, 
			messages: { 
				required: errorobj_req_zc, 
				minlength:errorobj_min_zc, 
				maxlength:errorobj_max_zc
			}
		});
		  
		jQuery("#app-city").rules("add",{ 
			required: true,
			minlength:check_city.min,
			maxlength:check_city.max, 
			messages: { 
				required: errorobj_req_ct, 
				minlength:errorobj_min_ct, 
				maxlength:errorobj_max_ct
			}
		});

		jQuery("#app-state").rules("add", { 
			required: true,
			minlength:check_state.min,
			maxlength:check_state.max, 
			messages: { 
				required: errorobj_req_st, 
				minlength:errorobj_min_st, 
				maxlength:errorobj_max_st
			}
		});

		jQuery("#d4m-first-name").rules("add", { 
			required: true,
			messages: { 
				required: errorobj_req_fn
			}
		});
			
		jQuery("#d4m-last-name").rules("add", { 
			required: true, 
			messages: { 
				required: errorobj_req_ln
			}
		});
	   
		jQuery("#d4m-street-address").rules("add",{ 
			required: true, 
			messages: { 
				required: errorobj_req_sa
			}
		});
		  
		jQuery("#d4m-zip-code").rules("add", { 
			required: true,
			messages: { 
				required: errorobj_req_zc
			}
		});
	   
		jQuery("#d4m-city").rules("add", 
		{ required: true,
		messages: { required: errorobj_req_ct}});
	  
		jQuery("#d4m-state").rules("add", 
		{ required: true,
		messages: { required: errorobj_req_st}});
		 
		jQuery("#d4m-notes").rules("add",{
			required: true,
			messages: { required: errorobj_req_srn}});
		
		jQuery("#d4m-step-four").slideUp(300);
		jQuery("#d4m-step-five").slideDown(300);
		jQuery("#step_next").hide();
		
	}
}
		}
    jQuery(".add_show_error_class").each(function(){
      jQuery(this).trigger("keyup");
    });
  });
  
  jQuery(document).on("click","#step_previous",function() {
    if(jQuery("#d4m-step-one").is(":visible")){ 
      jQuery("#step_previous").hide();
      jQuery("#step_next").show();
    }
    else if(jQuery("#d4m-step-two").is(":visible")){ 
      jQuery("#d4m-step-two").slideUp(300); 
      jQuery("#d4m-step-one").slideDown(300); 
      jQuery("#step_previous").hide();
    }
    else if(jQuery("#d4m-step-three").is(":visible")){ 
		
		var staff_count_forservice = jQuery("#staff_count_forservice").val();
			if(frequency_status.status=='N' && staff_count_forservice=='0'){
				
				jQuery("#d4m-step-one").slideDown(300); 
        jQuery("#d4m-step-three").slideUp(300); 
			}else{
				jQuery("#d4m-step-two").slideDown(300); 
        jQuery("#d4m-step-three").slideUp(300); 
			}
      
    }
    
    else if(jQuery("#d4m-step-four").is(":visible")){ 
      jQuery("#d4m-step-three").slideDown(300); 
      jQuery("#d4m-step-four").slideUp(300); 
    }

    else if(jQuery("#d4m-step-five").is(":visible")){ 
      jQuery("#d4m-step-four").slideDown(300); 
      jQuery("#d4m-step-five").slideUp(300); 
      jQuery("#step_next").show();
    }
  });
});


/* Send OTP function Jay W */
jQuery(document).on("click", "#send_otp", function() {
  var ajax_url = ajaxurlObj.ajax_url; 
  var phoneno = jQuery("#d4m-user-phone").val();
  jQuery(".d4m-loading-main").show();
  jQuery.ajax({
    type: "post",
    data: {
      "phoneno": phoneno,
      "sendotp": 1
    },
    url: ajax_url + "staff_ajax.php",
    success: function(response) {
      jQuery(".d4m-loading-main").hide();
      var staff_phone = jQuery.parseJSON(response);
      jQuery("#phone_number").val(staff_phone);
      jQuery("#verify_otp").modal('show');
    }
  });
});
/* Send OTP function end Jay W */ 

/* Send OTP check Jay W */
jQuery(document).on("click", "#input_otp_check", function() {
  var ajax_url = ajaxurlObj.ajax_url;
  var otp_input = jQuery("#otp_input").val();
  var phone = jQuery("#phone_number").val();
  jQuery(".d4m-loading-main").show();
  jQuery.ajax({
    type: "POST",
    data: {
      "otp_input": otp_input,
      "phone": phone,
      "Verify_otp": 1
    },
    url: ajax_url + "staff_ajax.php",
    success: function(res) {
      jQuery(".d4m-loading-main").hide();
      if (res == 1) {
        jQuery('#verify_otp').modal('hide');
        jQuery('#send_otp').hide();
        jQuery('#admin_staff_phno').attr('readonly', true);
        jQuery(".checkmark").show();
        jQuery('#new_staff_add_admin').prop('disabled', false);
      } else {
        jQuery("#invalid-otp").css("display", "inline");
        jQuery("#invalid-otp").val("Invalid OTP");
        jQuery("#invalid-otp").css("color", "red");
      }
    }
  });
});
/* Send OTP check end Jay W */

jQuery(document).ready(function () {
  //called when key is pressed in textbox
  jQuery("#d4m-user-phone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        jQuery("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});


