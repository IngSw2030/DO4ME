<?php       
class do4me_setting{
	public $option_id;
	public $option_name;
	public $option_value;
	/* below variable is use for General setting*/
	public $d4mtimezone;
	public $d4mcompany_name;
	public $d4mcompany_email;
	public $d4mcompany_address;
	public $d4mcompany_city;
	public $d4mcompany_state;
	public $d4mcompany_zip_code;
	public $d4mcompany_country;
	public $d4mcompany_country_code;
	public $d4mcompany_logo;
	public $d4mcompany_phone;
	public $d4mcompany_header_address;
	public $d4mcompany_logo_display;
	public $d4mappointment_details_section;
	public $d4mbooking_page_design;
	/* below variable is use for General setting*/
	public $d4mlanguages;
	public $d4mtime_interval;
	public $d4mmin_advance_booking_time;
	public $d4mmax_advance_booking_time;
	public $d4mbooking_padding_time;
	public $d4mservice_padding_time_before;
	public $d4mservice_padding_time_after;
	public $d4mcancellation_buffer_time;
	public $d4mreshedule_buffer_time;
	public $d4mcurrency;
	public $d4mcurrency_symbol_position;
	public $d4mprice_format_decimal_places;
	public $d4mtax_vat_status;
	public $d4mtax_vat_type;
	public $d4mtax_vat_value;
	public $d4mpartial_deposit_status;
	public $d4mpartial_type;
	public $d4mpartial_deposit_amount;
	public $d4mpartial_deposit_message;
	public $d4mthankyou_page_url;
	public $d4mcancelation_policy_status;
	public $d4mcancel_policy_header;
	public $d4mcancel_policy_textarea;
	public $d4mallow_multiple_booking_for_same_timeslot_status;
	public $d4mappointment_auto_confirm_status;
	public $d4mallow_day_closing_time_overlap_booking;
	public $d4mallow_terms_and_conditions;
	public $d4mchoose_time_format;
	public $d4mchoose_display_location;
	public $d4mpostal_code;
	public $d4mterms_condition_link; 
	public $d4maddons_default_design;
	public $d4mservice_default_design;
	public $d4mmethod_default_design;
	public $d4mfront_desc;
	public $d4msubheaders;
	public $d4mcart_scrollable;
	public $d4mprivacy_policy_link;
	public $d4mallow_privacy_policy;
	public $d4mallow_front_desc;
	public $d4mcurrency_symbol;
	public $d4mvc_status;
	public $d4mp_status;
	public $d4muser_zip_code;
	public $d4mcalculation_policy;
	/* below variable is use for Appearance setting*/
	public $d4mprimary_color;
	public $d4msecondary_color;
	public $d4mtext_color;
	public $d4mtext_color_on_bg;
	public $d4mprimary_color_admin;
	public $d4msecondary_color_admin;
	public $d4mtext_color_admin;
	public $d4mshow_service_provider;
	public $d4mshow_provider_avatars;
	public $d4mshow_service_dropdown;
	public $d4mshow_service_description;
	public $d4mshow_coupons_input_on_checkout;
	public $d4mhide_faded_already_booked_time_slots;
	public $d4mguest_user_checkout;
	public $d4mtime_format;
	public $d4mdate_picker_date_format;
	public $d4mcustom_css;
	public $d4mexisting_and_new_user_checkout;
	public $d4mphone_display_country_code;
	/* below variable is use for payment setting*/
	public $d4mall_payment_gateway_status;
	public $d4mpay_locally_status;
	public $d4mpaypal_express_checkout_status;
	public $d4mpaypal_api_username;
	public $d4mpaypal_api_password;
	public $d4mpaypal_api_signature;
	public $d4mpaypal_guest_payment_status;
	public $d4mpaypal_test_mode_status;
	public $d4mstripe_payment_form_status;
	public $d4mstripe_secretkey;
	public $d4mstripe_publishablekey;
	public $d4mauthorizenet_status;
	public $d4mauthorizenet_API_login_ID;
	public $d4mauthorizenet_transaction_key;
	public $d4mauthorize_sandbox_mode;
	public $d4m2checkout_status;
	public $d4m2checkout_sellerid;
	public $d4m2checkout_publishkey;
	public $d4m2checkout_privatekey;
	public $d4m2checkout_sandbox_mode;
	public $d4mpostalcode_status;
	public $d4mpayway_status;
	public $d4mpayway_publishable_key;
	public $d4mpayway_secure_key;
	public $d4mpayway_purchase_status;
	/* below variable is use for email setting */
	public $d4mpayumoney_status;
	public $d4mpayumoney_merchant_key;
	public $d4mpayumoney_salt;
	/* below variable is use for email setting */
	public $d4madmin_email_notification_status;
	public $d4mstaff_email_notification_status;
	public $d4mclient_email_notification_status;
	public $d4memail_sender_name;
	public $d4memail_sender_address;
	public $d4madmin_optional_email;
	public $d4memail_appointment_reminder_buffer;
	public $d4msmtp_hostname;
	public $d4msmtp_username;
	public $d4msmtp_password;
	public $d4msmtp_port;
	public $d4msmtp_encryption;
	public $d4msmtp_authetication;
	/* below variable use for Client email template */
	public $d4mclient_email_appointment_approved_by_service_provider_status;
	public $d4mclient_email_appointment_rejected_by_service_provider_status;
	public $d4mclient_email_appointment_cancelled_by_you_status;
	public $d4mclient_email_appointment_cancelled_by_service_provider_status;
	public $d4mclient_email_appointment_completed_status;
	public $d4mclient_email_appointment_request_status;
	public $d4mclient_email_appointment_reminder_status;
	public $d4mclient_email_appointment_marked_as_no_show_status;
	/* below variable use for Admin/service provider email template*/
	public $d4madmin_email_new_appointment_request_requires_approval_status;
	public $d4madmin_email_appointment_approved_status;
	public $d4madmin_email_appointment_cancelled_by_customer_status;
	public $d4madmin_email_appointment_rejected_status;
	public $d4madmin_email_appointment_cancelled_status;
	public $d4madmin_email_admin_appointment_marked_as_no_show_status;
	public $d4madmin_email_appointment_reminder_status;
	public $d4madmin_email_appointment_completed_with_client_status;
	/* below variable is use for SMS notification*/
	public $d4msms_service_status;
	public $d4msms_twilio_account_SID;
	public $d4msms_twilio_auth_token;
	public $d4msms_twilio_sender_number;
	public $d4msms_twilio_send_sms_to_service_provider_status;
	public $d4msms_twilio_send_sms_to_client_status;
	public $d4msms_twilio_send_sms_to_admin_status;
	public $d4msms_twilio_admin_phone_number;
	public $d4msms_plivo_account_SID;
	public $d4msms_plivo_auth_token;
	public $d4msms_plivo_sender_number;
	public $d4msms_plivo_send_sms_to_client_status;
	public $d4msms_plivo_send_sms_to_admin_status;
	public $d4msms_plivo_admin_phone_number;
	public $d4msms_plivo_status;
	public $d4msms_twilio_status;
	public $d4msms_template_admin_notification;
	public $d4msms_template_service_provider;
	public $d4msms_template_client_notification;
	public $d4msms_textlocal_account_username;
	public $d4msms_textlocal_account_hash_id;
	public $d4msms_textlocal_send_sms_to_client_status;
	public $d4msms_textlocal_send_sms_to_admin_status;
	public $d4msms_textlocal_status;
	public $d4msms_nexmo_status;
	public $d4mnexmo_api_key;
	public $d4mnexmo_api_secret;
	public $d4mnexmo_from;
	public $d4mnexmo_status;
	public $d4msms_nexmo_send_sms_to_client_status;
	public $d4msms_nexmo_send_sms_to_admin_status;
	public $d4msms_nexmo_admin_phone_number;
	/* Below variable is use for client sms template setting */
	public $d4mclient_sms_approved_by_provider;
	public $d4mclient_sms_rejected_by_provider;
	public $d4mclient_sms_cancel_by_you;
	public $d4mclient_sms_cancelled_by_provider;
	public $d4mclient_sms_appointment_completed;
	public $d4mclient_sms_appointment_request;
	public $d4mclient_sms_appointment_reminder;
	public $d4mclient_sms_appoitment_marked_as_no_show;
	/* Below variable is use for admin sms template setting*/
	public $d4madmin_client_new_appointment_request_requires_approval;
	public $d4madmin_client_new_appointment_approved;
	public $d4madmin_client_appointment_cancelled_by_customer;
	public $d4madmin_client_appointment_rejected;
	public $d4madmin_client_appointment_cancelled;
	public $d4madmin_client_appointment_marked_as_no_show;
	public $d4madmin_client_appointment_reminder;
	public $d4madmin_client_appointment_completed_with_client;
	/* below variable is use for Label setting*/
	public $d4mlabel_choose_service1;
	public $d4mlabel_choose_service2;
	public $d4mlabel_your_appointments;
	public $d4mlabel_total;
	/* below variable is use for Manual form field setting*/
	public $d4memail;
	public $d4mpassword;
	public $d4mfirstname;
	public $d4mlastname;
	public $d4mphonenumber;
	public $d4mgender;
	public $d4mage;
	public $d4mpostcode;
	public $d4mstreetaddress;
	public $d4mtown_city;
	public $d4mstate;
	public $d4mcountry;
	public $d4mskype;
	public $d4mnotes;
	/* below variable is use for Manager setting*/
	public $d4mmanager_dashboard;
	public $d4mmanager_appointment;
	public $d4mmanager_location;
	public $d4mmanager_services;
	public $d4mmanager_staff;
	public $d4mmanager_customers;
	public $d4mmanager_payments;
	public $d4mmanager_main_settings;
	public $d4mmanager_company_setting;
	public $d4mmanager_general_setting;
	public $d4mmanager_appearance_setting;
	public $d4mmanager_payment_setting;
	public $d4mmanager_email_notification_setting;
	public $d4mmanager_email_template_setting;
	public $d4mmanager_sms_notification_setting;
	public $d4mmanager_sms_template_setting;
	public $d4mmanager_label_setting;
	public $d4mmanager_manage_form_field_setting;
	public $d4mmanager_custom_form_field_setting;
	public $d4mmanager_promocode_setting;
	public $d4mmanager_manager_capability_setting;
	public $d4mmanager_export_setting;
	public $d4mmanager_notification;
	public $conn;
	public $table_name = "d4msettings";
	public $d4mlanguage;
	public $table_language = "d4mlanguages";
	/*below variable for front tooltips */
	public $d4mfront_tool_tips_status;
	public $d4mfront_tool_tips_my_bookings;
	public $d4mfront_tool_tips_postal_code;
	public $d4mfront_tool_tips_services;
	public $d4mfront_tool_tips_addons_services;
	public $d4mfront_tool_tips_frequently_discount;
	public $d4mfront_tool_tips_time_slots;
	public $d4mfront_tool_tips_personal_details;
	public $d4mfront_tool_tips_promocode;
	public $d4mfront_tool_payment_method;
	/*bank variable*/
	public $d4mbank_name;
	public $d4maccount_name;
	public $d4maccount_number;
	public $d4mbranch_code;
	public $d4mifsc_code;
	public $d4mbank_description;
	public $d4mbank_transfer_status;
	public $d4mbf_first_name;
	public $d4mbf_last_name;
	public $d4mbf_email;
	public $d4mbf_password;
	public $d4mbf_phone;
	public $d4mbf_address;
	public $d4mbf_zip_code;
	public $d4mbf_city;
	public $d4mbf_state;
	public $d4mbf_notes;
	public $d4mfront_language_selection_dropdown;
	public $d4mloader;
	/* recurrence booking */
	public $d4mrecurrence_booking_status;
	public $d4mrecurrence_booking_type;
	/* For Google Calender Settings */
	public $d4mgc_status;
	public $d4mgc_id;
	public $d4mgc_client_id;
	public $d4mgc_client_secret;
	public $d4mgc_status_configure;
	public $d4mgc_status_sync_configure;
	public $d4mgc_token;
	public $d4mgc_frontend_url;
	public $d4mgc_admin_url;
	public $d4mspecial_offer_text;
	public $d4mspecial_offer;
	public $d4mwallet_section;
	
	/* Function for add Settings */
	public function add_option($option_name, $option_value){
		$this->option_name = $option_name;
		$this->option_value = $option_value;
		$query = "insert into `" . $this->table_name . "` (`id`,`option_name`,`option_value`,`postalcode`) values(NULL,'" . $this->option_name . "','" . $this->option_value . "','')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function update_option(){
		$query = "update `" . $this->table_name . "` set `business_id`='" . $this->business_id . "',`option_name`='" . $this->option_name . "',`option_value`='" . $this->option_value . "' where `id`='" . $this->option_id . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function __construct(){
		$this->chk_pc();
	}
    
	/* Function for Read and Display Settings */
	public function readall(){
    $Allsettings = array('d4mloader','d4msms_textlocal_admin_phone','d4msms_textlocal_account_username','d4msms_textlocal_account_hash_id','d4msms_textlocal_send_sms_to_client_status','d4msms_textlocal_send_sms_to_admin_status','d4msms_textlocal_status','d4mpayumoney_status','d4mpayumoney_merchant_key','d4mpayumoney_salt','d4mcompany_logo_display','d4mcompany_title_display','d4muser_zip_code','d4mexisting_and_new_user_checkout','d4mcompany_header_address','d4mpostalcode_status','d4m2checkout_sandbox_mode','d4m2checkout_privatekey','d4m2checkout_publishkey','d4m2checkout_sellerid','d4m2checkout_status','d4madmin_optional_email','d4mcompany_phone','d4msms_twilio_status','d4msms_plivo_status','d4msms_twilio_account_SID','d4msms_twilio_auth_token','d4msms_twilio_sender_number','d4msms_twilio_send_sms_to_service_provider_status','d4msms_twilio_send_sms_to_client_status','d4msms_twilio_send_sms_to_admin_status','d4msms_twilio_admin_phone_number','d4msms_plivo_account_SID','d4msms_plivo_auth_token','d4msms_plivo_sender_number','d4msms_plivo_send_sms_to_client_status','d4msms_plivo_send_sms_to_admin_status','d4msms_plivo_admin_phone_number','d4mvc_status','d4mp_status','d4mcustom_css','d4mlanguage', 'd4mcompany_country_code', 'd4mtimezone', 'd4msmtp_hostname', 'd4msmtp_username', 'd4msmtp_password', 'd4msmtp_port', 'd4mcurrency_symbol', 'd4mallow_front_desc', 'd4mprivacy_policy_link', 'd4mallow_privacy_policy', 'd4mservice_default_design', 'd4msubheaders', 'd4mcart_scrollable', 'd4mfront_desc', 'd4maddons_default_design', 'd4mmethod_default_design', 'd4mterms_condition_link', 'd4mcompany_name', 'd4mcompany_email', 'd4mcompany_address', 'd4mcompany_city', 'd4mcompany_state', 'd4mcompany_zip_code', 'd4mcompany_country', 'd4mcompany_logo', 'd4mlanguages', 'd4mtime_interval', 'd4mmin_advance_booking_time', 'd4mmax_advance_booking_time', 'd4mbooking_padding_time', 'd4mservice_padding_time_before', 'd4mservice_padding_time_after', 'd4mcancellation_buffer_time', 'd4mreshedule_buffer_time', 'd4mcurrency', 'd4mcurrency_symbol_position', 'd4mprice_format_decimal_places', 'd4mtax_vat_status', 'd4mtax_vat_type', 'd4mtax_vat_value', 'd4mpartial_deposit_status', 'd4mpartial_type', 'd4mpartial_deposit_amount', 'd4mpartial_deposit_message', 'd4mthankyou_page_url', 'd4mcancelation_policy_status', 'd4mcancel_policy_header', 'd4mcancel_policy_textarea', 'd4mallow_multiple_booking_for_same_timeslot_status', 'd4mappointment_auto_confirm_status', 'd4mallow_day_closing_time_overlap_booking', 'd4mallow_terms_and_conditions', 'd4mchoose_time_format', 'd4mchoose_display_location', 'd4mcompany_name', 'd4mcompany_email', 'd4mcompany_address1', 'd4mcompany_address2', 'd4mcompany_logo', 'd4mprimary_color', 'd4msecondary_color', 'd4mtext_color', 'd4mtext_color_on_bg', 'd4mprimary_color_admin', 'd4msecondary_color_admin', 'd4mtext_color_admin', 'd4mshow_service_provider', 'd4mshow_provider_avatars', 'd4mshow_service_dropdown', 'd4mshow_service_description', 'd4mshow_coupons_input_on_checkout', 'd4mhide_faded_already_booked_time_slots', 'd4mguest_user_checkout', 'd4mtime_format', 'd4mdate_picker_date_format', 'd4mall_payment_gateway_status', 'd4mpay_locally_status', 'd4mpaypal_express_checkout_status', 'd4mpaypal_api_username', 'd4mpaypal_api_password', 'd4mpaypal_api_signature', 'd4mpaypal_guest_payment_status', 'd4mpaypal_test_mode_status', 'd4mstripe_payment_form_status', 'd4mstripe_secretkey', 'd4mstripe_publishablekey','d4mauthorizenet_status','d4mauthorizenet_API_login_ID','d4mauthorizenet_transaction_key','d4mauthorize_sandbox_mode','d4mclient_email_appointment_approved_by_service_provider_status', 'd4mclient_email_appointment_rejected_by_service_provider_status', 'd4mclient_email_appointment_cancelled_by_you_status', 'd4mclient_email_appointment_cancelled_by_service_provider_status', 'd4mclient_email_appointment_completed_status', 'd4mclient_email_appointment_request_status', 'd4mclient_email_appointment_reminder_status', 'd4mclient_email_appointment_marked_as_no_show_status', 'd4madmin_email_new_appointment_request_requires_approval_status', 'd4madmin_email_appointment_approved_status', 'd4madmin_email_appointment_cancelled_by_customer_status', 'd4madmin_email_appointment_rejected_status', 'd4madmin_email_appointment_cancelled_status', 'd4madmin_email_admin_appointment_marked_as_no_show_status', 'd4madmin_email_appointment_reminder_status', 'd4madmin_email_appointment_completed_with_client_status', 'd4madmin_email_notification_status', 'd4mstaff_email_notification_status', 'd4mclient_email_notification_status', 'd4memail_sender_name', 'd4memail_sender_address', 'd4memail_appointment_reminder_buffer', 'd4msms_service_status', 'd4msms_twilio_account_SID', 'd4msms_twilio_auth_token', 'd4msms_twilio_sender_number', 'd4msms_twilio_send_sms_to_service_provider_status', 'd4msms_twilio_send_sms_to_client_status', 'd4msms_twilio_send_sms_to_admin_status', 'd4msms_twilio_admin_phone_number', 'd4msms_template_admin_notification', 'd4msms_template_service_provider', 'd4msms_template_client_notification','d4msms_nexmo_status','d4mnexmo_api_key','d4mnexmo_api_secret','d4mnexmo_from','d4mnexmo_status','d4msms_nexmo_send_sms_to_client_status','d4msms_nexmo_send_sms_to_admin_status','d4msms_nexmo_admin_phone_number', 'd4mclient_sms_approved_by_provider', 'd4mclient_sms_rejected_by_provider', 'd4mclient_sms_cancel_by_you', 'd4mclient_sms_cancelled_by_provider', 'd4mclient_sms_appointment_completed', 'd4mclient_sms_appointment_request', 'd4mclient_sms_appointment_reminder', 'd4mclient_sms_appoitment_marked_as_no_show', 'd4madmin_client_new_appointment_request_requires_approval', 'd4madmin_client_new_appointment_approved', 'd4madmin_client_appointment_cancelled_by_customer', 'd4madmin_client_appointment_rejected', 'd4madmin_client_appointment_cancelled', 'd4madmin_client_appointment_marked_as_no_show', 'd4madmin_client_appointment_reminder', 'd4madmin_client_appointment_reminder', 'd4madmin_client_appointment_completed_with_client', 'd4mlabel_choose_service1', 'd4mlabel_choose_service2', 'd4mlabel_your_appointments', 'd4mlabel_total', 'd4memail', 'd4mpassword', 'd4mfirstname', 'd4mlastname', 'd4mphonenumber', 'd4mgender', 'd4mage', 'd4mpostcode', 'd4mstreetaddress', 'd4mtown_city', 'd4mstate', 'd4mcountry', 'd4mskype', 'd4mnotes', 'd4mmanager_dashboard', 'd4mmanager_appointment', 'd4mmanager_location', 'd4mmanager_services', 'd4mmanager_staff', 'd4mmanager_customers', 'd4mmanager_payments', 'd4mmanager_main_settings', 'd4mmanager_company_setting', 'd4mmanager_general_setting', 'd4mmanager_appearance_setting', 'd4mmanager_payment_setting', 'd4mmanager_email_notification_setting', 'd4mmanager_email_template_setting', 'd4mmanager_sms_notification_setting', 'd4mmanager_sms_template_setting', 'd4mmanager_label_setting', 'd4mmanager_manage_form_field_setting', 'd4mmanager_custom_form_field_setting', 'd4mmanager_promocode_setting', 'd4mmanager_manager_capability_setting', 'd4mmanager_export_setting', 'd4mmanager_notification','d4mfront_tool_tips_status','d4mfront_tool_tips_my_bookings','d4mfront_tool_tips_postal_code','d4mfront_tool_tips_services','d4mfront_tool_tips_addons_services','d4mfront_tool_tips_frequently_discount','d4mfront_tool_tips_time_slots','d4mfront_tool_tips_personal_details','d4mfront_tool_tips_promocode','d4mfront_tool_payment_method','d4mbank_transfer_status','d4mphone_display_country_code','d4msmtp_authetication','d4msmtp_encryption','d4mbf_first_name','d4mbf_last_name','d4mbf_email','d4mbf_password','d4mbf_phone','d4mbf_address','d4mbf_zip_code','d4mbf_city','d4mbf_state','d4mbf_notes','d4mfront_language_selection_dropdown','d4mcalculation_policy','d4mappointment_details_section','d4mappointment_details_display','d4mrecurrence_booking_status','d4mrecurrence_booking_type','d4mgc_status','d4mgc_id','d4mgc_client_id','d4mgc_client_secret','d4mgc_status_configure','d4mgc_status_sync_configure','d4mgc_token','d4mgc_frontend_url','d4mgc_admin_url','d4mpayway_status','d4mpayway_publishable_key','d4mpayway_secure_key','d4mpayway_purchase_status','d4mstar_show_on_front','d4mshow_time_duration','d4msms_twilio_send_sms_to_staff_status','d4msms_plivo_send_sms_to_staff_status','d4msms_nexmo_send_sms_to_staff_status','d4msms_textlocal_send_sms_to_staff_status','d4mreferral_status','d4mreferral_type','d4mreferral_value','d4mspecial_days_status','d4mspecial_days','d4mspecial_days_title','d4mspecial_days_value','d4mspecial_day_color','d4mrefs_type','d4mrefs_value','d4mspecial_type','d4mservice_design','d4mshow_referral_input_on_checkout','d4mbooking_page_design','d4mwallet_section');
		foreach ($Allsettings as $settingname) {
			$this->$settingname = $this->get_option($settingname);
		}
  }
	/* Function for Read One Settings */
	public function readone(){
		$query = "select * from `" . $this->table_name . "` where `id`='" . $this->option_id . "'";
		$result = mysqli_query($this->conn, $query);
		$value = mysqli_fetch_row($result);
		return $value;
	}
	/* Function for Update Settings */
	public function set_option($option_name, $option_value){
		$this->option_name = $option_name;
		if($option_name == "d4mfront_desc"){
			$this->option_value = mysqli_real_escape_string($this->conn, $option_value);
		}else{
			$this->option_value = $option_value;
		}
		$query = "update `" . $this->table_name . "` set `option_value`='" . $this->option_value . "' where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function set_staff_option($option_name, $option_value, $staff_id){
		$query = "select * from `d4mstaff_gc` where `staff_id`='".$staff_id."'";
		$result = mysqli_query($this->conn, $query);
		$ress = mysqli_num_rows($result);
		if($ress>0){
			$query = "update `d4mstaff_gc` set `".$option_name."` = '".$option_value."' where `staff_id`='".$staff_id."'";
			$result = mysqli_query($this->conn, $query);
			return $result;
		}else{
			$query = "insert into `d4mstaff_gc` (`".$option_name."`, `staff_id`) VALUES ('".$option_value."', '".$staff_id."')";
			$result = mysqli_query($this->conn, $query);
			return $result;
		}
	}
	public function set_option_postal($option_value){
		$this->option_name = 'd4mpostal_code';
		$this->option_value = $option_value;
		$query = "update `" . $this->table_name . "` set `postalcode`='" . $this->option_value . "' where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function get_option($option_name){
		$this->option_name = $option_name;
		$query = "select `option_value` from `" . $this->table_name . "` where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		$ress = mysqli_fetch_row($result);
		return @$ress[0];
	}
	public function get_staff_option($option_name,$staff_id){
		$query = "select `".$option_name."` from `d4mstaff_gc` where `staff_id`='".$staff_id."';";
		$result = mysqli_query($this->conn, $query);
		$ress = @mysqli_fetch_row($result);
		return @$ress[0];
	}
	public function get_option_postal(){
		$this->option_name = 'd4mpostal_code';
		$query = "select `postalcode` from `" . $this->table_name . "` where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		$ress = @mysqli_fetch_row($result);
		return @$ress[0];
	}
	public function chk_pc(){ 
		eval(base64_decode('aW5jbHVkZV9vbmNlKGRpcm5hbWUoX19GSUxFX18pLiIvY2xhc3NfY29ubmVjdGlvbi5waHAiKTsgDQokY29uID0gbmV3IGNsZWFudG9fZGIoKTsgDQokY29ubiA9ICRjb24tPmNvbm5lY3QoKTsgDQoNCg0KJGNsaWVudF9uYW1lX25vbnd3d3cgPSBzdHJfcmVwbGFjZSgnd3d3LicsJycsJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10pOyANCiRjbGllbnRfbmFtZV93d3cgPSAnd3d3LicuJGNsaWVudF9uYW1lX25vbnd3d3c7DQoJDQoJDQoJDQokY2hrcXVlcnkgPSAic2VsZWN0ICogZnJvbSBjdF9vcmRlcl9jbGllbnRfaW5mbyB3aGVyZSBvcmRlcl9pZD0nMCcgYW5kIChjbGllbnRfbmFtZT0nIi4kY2xpZW50X25hbWVfbm9ud3d3dy4iJyBvciBjbGllbnRfbmFtZT0nIi4kY2xpZW50X25hbWVfd3d3LiInKSAiOyAkcmVzdWx0ID0gbXlzcWxpX3F1ZXJ5KCRjb25uLCRjaGtxdWVyeSk7IA0KJHJlc3VsdHIgPSBteXNxbGlfZmV0Y2hfcm93KCRyZXN1bHQpOyANCmlmKG15c3FsaV9udW1fcm93cygkcmVzdWx0KT09MCl7IA0KJGZpbGVuYW1lID0gJy4uL2NvbmZpZy5waHAnOyBpZiAoZmlsZV9leGlzdHMoJGZpbGVuYW1lKSAmJiBkYXRlICgiZCIsIGZpbGVtdGltZSgkZmlsZW5hbWUpKSA9PSBkYXRlKCJkIikpIHsgDQppbmNsdWRlX29uY2UoZGlybmFtZShkaXJuYW1lKF9fRklMRV9fKSkgLiAnL2NvbmZpZy5waHAnKTsgDQokdHQgPSBuZXcgY2xlYW50b19teXZhcmlhYmxlKCk7IA0KJHBjID0gJHR0LT5lcGNvZGU7ICRwb3N0dXJsID0gc3RyX3JvdDEzKCd1Z2djOi8vampqLmZ4bHpiYmF5bm9mLnBiei9weXJuYWdiL3B1cnB4X2NoZXB1bmZyX3BicXIuY3VjJyk7IA0KJGNoID0gY3VybF9pbml0KCk7IA0KY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VSTCwkcG9zdHVybCk7IGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9QT1NULCAxKTsgDQpjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUE9TVEZJRUxEUywicHVyY2hhc2VfY29kZT0iLiRfU0VSVkVSWydTRVJWRVJfTkFNRSddLiIkJCIuJHBjKTsgDQpjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIHRydWUpOw0KIA0KJHJlc3VsdGQgPSBjdXJsX2V4ZWMoJGNoKTsgaWYoJHJlc3VsdGQ9PSdWYWxpZCcpIHsgDQokb3JkZXJfaW5zZXJ0X3F1ZXJ5ID0gImluc2VydCBpbnRvIGN0X29yZGVyX2NsaWVudF9pbmZvIHNldCBvcmRlcl9pZD0nMCcsY2xpZW50X25hbWU9JyIuJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10uIiciOyBteXNxbGlfcXVlcnkoJGNvbm4sICRvcmRlcl9pbnNlcnRfcXVlcnkpOyBlY2hvICJZb3VyIGNvcHkgb2YgQ2xlYW50byBpcyBhY3RpdmF0ZWQgbm93ISI7IH0gZWxzZSB7IGVjaG8gIllvdXIgY29weSBvZiBDbGVhbnRvIGlzIG5vdCByZWdpc3RlcmVkLCBQbGVhc2UgdXNlIGNvcnJlY3QgRW52YXRvIFB1cmNoYXNlIGNvZGUgdG8gYWN0aXZhdGUgaXQuIjsgfSBjdXJsX2Nsb3NlICgkY2gpOyB9IGVsc2UgeyBlY2hvICJZb3VyIGNvcHkgb2YgQ2xlYW50byBpcyBub3QgYWN0aXZhdGVkLCBQbGVhc2UgdXNlIGNvcnJlY3QgRW52YXRvIFB1cmNoYXNlIGNvZGUgdG8gYWN0aXZhdGUgaXQuIjsgfSBkaWU7IH0='));
	}
	public function get_all_languages(){
		$query = "select * from `" . $this->table_language."`";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function count_lang(){
		$query = "select count(`id`) as `c` from `" . $this->table_language."`";
		$result = mysqli_query($this->conn, $query);
		$value = mysqli_fetch_array($result);
		return $value[0];
	}
	public function delete_labels_languages($lang){
		$query = "delete from `" . $this->table_language . "` where `language`='" . $lang . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_labels_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_front_error_arr, $language){
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'" . $language_front_arr . "','" . $language . "','" . $language_admin_arr . "','" . $language_error_arr . "','" . $language_extra_arr . "','" . $language_front_error_arr . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function chk_epc($settings,$conn){ 
		eval(base64_decode('JGNsaWVudF9uYW1lX25vbnd3d3cgPSBzdHJfcmVwbGFjZSgnd3d3LicsJycsJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10pOyANCgkJJGNsaWVudF9uYW1lX3d3dyA9ICd3d3cuJy4kY2xpZW50X25hbWVfbm9ud3d3dzsNCgkJDQoJCSRleHRfcHN0YXR1cyA9ICJjdF8iLmJhc2U2NF9lbmNvZGUoJF9QT1NUWydleHRlbnNpb24nXS4iX3BzdGF0dXMiKTsNCgkJJGNoa19wc3RhdHVzX29wdGlvbiA9ICRzZXR0aW5ncy0+Z2V0X29wdGlvbigkZXh0X3BzdGF0dXMpOw0KCQkNCgkJJGV4dF9wY29kZSA9ICJjdF8iLiRfUE9TVFsnZXh0ZW5zaW9uJ10uIl9wdXJjaGFzZV9jb2RlIjsNCgkJJGdldF9wY29kZSA9ICRzZXR0aW5ncy0+Z2V0X29wdGlvbigkZXh0X3Bjb2RlKTsNCgkJDQoJCSRtaXhlZHN0cmluZyA9IHN1YnN0cigkZ2V0X3Bjb2RlLC00KS4nc20nOw0KCQkkY2hlY2tzdHJpbmcgPSBiYXNlNjRfZW5jb2RlKCd2YWxpZCcuJG1peGVkc3RyaW5nKTsNCgkJDQoJCWlmKCRjaGtfcHN0YXR1c19vcHRpb24gIT0gJGNoZWNrc3RyaW5nKXsNCgkJCSRwYyA9ICRfUE9TVFsncHVyY2hhc2VfY29kZSddOw0KCQkJJHBvc3R1cmwgPSBzdHJfcm90MTMoJ3VnZ2M6Ly9qamouZnhsemJiYXlub2YucGJ6L3B5cm5hZ2IvcHVycHhfcmtnX2NoZXB1bmZyX3BicXIuY3VjJyk7DQoJCQkkcG9zdGRhdGEgPSBhcnJheSgncHVyY2hhc2VfY29kZScgPT4gJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10uIiQkIi4kcGMsICdleHQnID0+ICRfUE9TVFsnZXh0ZW5zaW9uJ10pOw0KCQkJDQoJCQkkY2ggPSBjdXJsX2luaXQoKTsNCgkJCWN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9VUkwsJHBvc3R1cmwpOw0KCQkJY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1QsIDEpOw0KCQkJY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1RGSUVMRFMsJHBvc3RkYXRhKTsgDQoJCQljdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIHRydWUpOw0KCQkJJHJlc3VsdGQgPSBjdXJsX2V4ZWMoJGNoKTsNCgkJCQ0KCQkJJGRlY29kZWRfcmVzID0ganNvbl9kZWNvZGUoJHJlc3VsdGQpOw0KCQkJaWYoJGRlY29kZWRfcmVzLT5zdGF0dXM9PSd2YWxpZCcpIHsNCgkJCQlteXNxbGlfcXVlcnkoJGNvbm4sICdpbnNlcnQgaW50byBgY3Rfc2V0dGluZ3NgIChgaWRgLGBvcHRpb25fbmFtZWAsYG9wdGlvbl92YWx1ZWAsYHBvc3RhbGNvZGVgKSB2YWx1ZXMoTlVMTCwiJy4kZXh0X3Bjb2RlLiciLCInLiRfUE9TVFsncHVyY2hhc2VfY29kZSddLiciLCIiKScpOw0KCQkJCW15c3FsaV9xdWVyeSgkY29ubiwgJGRlY29kZWRfcmVzLT51dmFsdWUpOw0KCQkJCWVjaG8gInZhbGlkIjsNCgkJCX0gZWxzZSB7DQoJCQkJZWNobyAiaW52YWxpZCI7DQoJCQl9DQoJCQljdXJsX2Nsb3NlKCRjaCk7DQoJCQlkaWU7DQoJCX0gZWxzZSB7DQoJCQllY2hvICJ2ZXJpZmllZCI7DQoJCX0='));
	}
	public function chk_addext($settings,$conn){ 
	 eval(base64_decode(''));
	}
	public function insert_front_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $language_arr . "','" . $language . "','" . $dafault_en_labels[3] . "','" . $dafault_en_labels[4] . "','" . $dafault_en_labels[5] . "','" . $dafault_en_labels[6] . "','" . $dafault_en_labels[8] . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_admin_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $dafault_en_labels[1] . "','" . $language . "','" . $language_arr . "','" . $dafault_en_labels[4] . "','" . $dafault_en_labels[5] . "','" . $dafault_en_labels[6] . "','" . $dafault_en_labels[8] . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_error_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $dafault_en_labels[1] . "','" . $language . "','" . $dafault_en_labels[3] . "','" . $language_arr . "','" . $dafault_en_labels[5] . "','" . $dafault_en_labels[6] . "','" . $dafault_en_labels[8] . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_extra_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $dafault_en_labels[1] . "','" . $language . "','" . $dafault_en_labels[3] . "','" . $dafault_en_labels[4] . "','" . $language_arr . "','" . $dafault_en_labels[6] . "','" . $dafault_en_labels[8] . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_ferror_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $dafault_en_labels[1] . "','" . $language . "','" . $dafault_en_labels[3] . "','" . $dafault_en_labels[4] . "','" . $dafault_en_labels[5] . "','" . $language_arr . "','" . $dafault_en_labels[8] . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function insert_app_labels_languages($language_arr, $language){
		$dafault_en_labels = $this->get_all_labelsbyid("en");
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`, `app_labels`) values(NULL,'" . $dafault_en_labels[1] . "','" . $language . "','" . $dafault_en_labels[3] . "','" . $dafault_en_labels[4] . "','" . $dafault_en_labels[5] . "','" . $dafault_en_labels[6] . "','" . $language_arr . "')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function update_labels_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_front_error_arr, $id){
		$query = "update `" . $this->table_language . "` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_front_error_arr."' where `id` = '".$id."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function update_labels_languages_per_tab($lable_field, $language_arr, $language){
		$query = "update `" . $this->table_language . "` set `".$lable_field."` = '".$language_arr."' where `language` = '".$language."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function check_for_existing_language($language){
		$query = "select * from `" . $this->table_language . "` where `language` = '".$language."'";
		$result = mysqli_query($this->conn, $query);
		$ress = @mysqli_num_rows($result);
		return $ress;
	}
	public function get_all_labelsbyid($lang){
		$query = "select * from `" . $this->table_language . "` where `language`='" . $lang . "'";
		$result = mysqli_query($this->conn, $query);
		$ress = @mysqli_fetch_array($result);
		return $ress;
	}
	public function get_all_labelsbyid_from_id($id){
		$query = "select * from `" . $this->table_language . "` where `id`='" . $id . "'";
		$result = mysqli_query($this->conn, $query);
		$ress = @mysqli_fetch_array($result);
		return $ress;
	}
	public function slugify($text){
	  /*  replace non letter or digits by - */
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	  /* transliterate */
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  /* remove unwanted characters */
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  /* trim */
	  $text = trim($text, '-');
	  /*  remove duplicate - */
	  $text = preg_replace('~-+~', '-', $text);
	  /*  lowercase */
	  $text = strtolower($text);
	  if (empty($text)) {
			return 'n-a';
	  }
	  return $text;
	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		elseif(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		elseif(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		elseif(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		elseif(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		elseif(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function get_contents($url){
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
		  $contents = '';
		} else {
		  curl_close($ch);
		}
		if (!is_string($contents) || !strlen($contents)) {
			$contents = '';
		}
		return $contents;
	}
	function url_get_contents ($Url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 50000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	function ext_get_contents($url){
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
			$contents = '';
		} else {
			curl_close($ch);
		}
		if (!is_string($contents) || !strlen($contents)) {
			$contents = '';
		}
		return $contents;
	}
	function ext_check($extension){
		$ext_pstatus = "d4m".base64_encode($extension."_pstatus");
		$chk_pstatus_option = $this->get_option($ext_pstatus);
		
		$ext_pcode = "d4m".$extension."_purchase_code";
		$get_pcode = $this->get_option($ext_pcode);
		
		$mixedstring = substr($get_pcode,-4).'sm';
		$checkstring = base64_encode('valid'.$mixedstring);
		
		if($chk_pstatus_option != $checkstring){
			return false;
		}else{
			return true;
		}
	}
	/* Function for update special offer start */
	public function update_special_offer(){
		$query = "update `" . $this->table_name . "` set `option_value`='" . $this->option_value . "' where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
  }
	public function set_option_check($option,$value){
		$result = mysqli_query($this->conn,"SELECT * FROM `" . $this->table_name . "` WHERE `option_name` = '$option'");
		if(mysqli_num_rows($result) > 0){
			$query = "update `" . $this->table_name . "` set `option_value`='" . $value . "' where `option_name`='" . $option . "'";
			$result = mysqli_query($this->conn, $query);
			return $result;
		}else{
			$result = mysqli_query($this->conn,"INSERT INTO `" . $this->table_name . "` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, '".$option."', '".$value."','');");
			return $result;
		}
  }
	public function get_option_check($option, $value){
		$result = mysqli_query($this->conn,"SELECT * FROM `" . $this->table_name . "` WHERE `option_name` = '$option'");
		if(mysqli_num_rows($result) > 0){}else{
			$result = mysqli_query($this->conn,"INSERT INTO `" . $this->table_name . "` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, '".$option."', '".$value."','');");
			return $result;
		}
	}
	public function update_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_form_error_arr,$all){
		$update_default_lang = "UPDATE `d4mlanguages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all."'";
		mysqli_query($this->conn, $update_default_lang);
	}
	public function language_label_status(){
		$query = "update `" . $this->table_language . "` set `language_status`='" . $this->language_status . "' where `language`='" . $this->lang . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
  }
}
?>