<?php 
include(dirname(__FILE__).'/header.php');
include_once(dirname(dirname(__FILE__)).'/header.php');
include(dirname(dirname(__FILE__))."/objed4ms/class_frequently_discount.php");
include(dirname(dirname(__FILE__))."/objed4ms/class_sms_template.php");
include(dirname(dirname(__FILE__))."/objed4ms/class_email_template.php");
include(dirname(__FILE__).'/user_session_check.php');
include(dirname(dirname(__FILE__))."/objed4ms/class_promo_code.php");
include(dirname(dirname(__FILE__))."/objed4ms/class_adminprofile.php");
if ( is_file(dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php')) 
{
  require_once dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php';
}

<?php
	class do4me_database{
	public $hostnames = "localhost";
	public $username = "u596fpzbfrxbx";
	public $passwords = "851*21B*~$17";
	public $database = "dbsbgrrdzacsjq";
} ?>
$manage_form_errors_message = 
array(

?>
<div class="d4m-alert-msg-show-main mainheader_message_fail_appearance_setting">
  <div class="d4m-all-alert-messags alert alert-danger mainheader_message_inner_fail_appearance_setting">
    <!-- <a href="#" class="close" data-dismiss="alert">&times;</a> -->
    <strong><?php echo $label_language_values['failed'];?></strong> <span id="d4m_sucess_message_fail_appearance_setting"></span>
  </div>
</div>
<?php 
$database=new do4me_db();
$conn=$database->conned4m();
$database->conn=$conn;
$promo = new do4me_promo_code();
$promo->conn = $conn;

$objfrequently = new do4me_frequently_discount();
$objfrequently->conn = $conn;

$sms_template = new do4me_sms_template();
$sms_template->conn=$conn;
$setting->readAll();

$email_template = new do4me_email_template();
$email_template->conn = $conn;

$admin_profile = new do4me_adminprofile();
$admin_profile->conn = $conn;

$admin_profile->id = $_SESSION['d4m_adminid'];
$admin_get_email = $admin_profile->readone();

$admin_optional_email = $setting->get_option('d4m_admin_optional_email');
if($admin_optional_email == ""){
  $admin_optional_email = $admin_get_email[2];
}

if($setting->get_option('d4m_paypal_express_checkout_status') == 'on' || $setting->get_option('d4m_stripe_payment_form_status') == 'on' || $setting->get_option('d4m_authorizenet_status') == 'on' || $setting->get_option('d4m_2checkout_status') == 'Y'  || $setting->get_option('d4m_payumoney_status') == 'Y'){
  $payment_status = "on";
}
elseif(sizeof((array)$purchase_check)>0){
  $payment_status = "off";
  $check_pay = 'N';
  foreach($purchase_check as $key=>$val){
    if($val == 'Y'){
      if($payment_hook->payment_partial_deposit_toggle_condition_hook($key) == true && $check_pay == 'N'){
        $payment_status = "on";
        $check_pay = 'Y';
      }
    }
  }
}
else {
  $payment_status = "off";
}
/* Add Appearance Settings */ 
$upload1=$upload2=''; 
if(isset($_POST['appreance'])){

if(isset($_FILES['d4m_frontend_gif_loader_file'])){
  $gif_mixno=time();
  $gif_ext = pathinfo($_FILES['d4m_frontend_gif_loader_file']['name'], PATHINFO_EXTENSION);
  $gif_img_type1=array('jpg','jpeg','png','gif'); 
  $gif_destination=dirname(dirname(__FILE__))."/assets/images/gif-loader/".$gif_mixno.".".$gif_ext."";
  $gif_lg_image_type=pathinfo($gif_destination,PATHINFO_EXTENSION);
  if(in_array($gif_lg_image_type,$gif_img_type1)){
    move_uploaded_file($_FILES['d4m_frontend_gif_loader_file']['tmp_name'],$gif_destination);
    $upload1='1';
    $d4m_frontend_gif_imagename=$gif_mixno.".".$gif_ext."";
  }else{
    $message="Invalid Image Type";
    $d4m_frontend_gif_imagename='';
  }
}

if(isset($_FILES['loginimg'])){
  $mixno=rand(1,1000);
  $ext = pathinfo($_FILES['loginimg']['name'], PATHINFO_EXTENSION);
  $img_type1=array('jpg','jpeg','png','gif'); 
  $destination=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."lg_".$mixno.".".$ext."";
  $lg_image_type=pathinfo($destination,PATHINFO_EXTENSION);
    if(in_array($lg_image_type,$img_type1)){
      move_uploaded_file($_FILES['loginimg']['tmp_name'],$destination);
      $upload1='1';
      $loginimagename="lg_".$mixno.".".$ext."";
    }else{
        $message="Invalid Image Type";
        $loginimagename='';
    }
}

if(isset($_FILES['frontimage'])){
  $frmixno=rand(1001,9999);
  $frext = pathinfo($_FILES['frontimage']['name'], PATHINFO_EXTENSION);
  $img_type2=array('jpg','jpeg','png','gif');
  $destination2=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."fr_".$frmixno.".".$frext."";
  $fr_image_type=pathinfo($destination2,PATHINFO_EXTENSION);
  if(in_array($fr_image_type,$img_type2)){
    move_uploaded_file($_FILES['frontimage']['tmp_name'],$destination2);
    $upload2='1';
    $frontimagename="fr_".$frmixno.".".$frext."";
  }else{
    $message="Invalid Image Type";
    $frontimagename='';
  }
}

if(isset($_FILES['faviconimage'])){
  $favmixno=rand(1001,9999);
  $favext = pathinfo($_FILES['faviconimage']['name'], PATHINFO_EXTENSION);
  $img_type3=array('jpg','jpeg','png','gif');
  $destination3=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."fr_".$favmixno.".".$favext."";
  $favicon_image_type=pathinfo($destination3,PATHINFO_EXTENSION);
  if(in_array($favicon_image_type,$img_type3)){
    move_uploaded_file($_FILES['faviconimage']['tmp_name'],$destination3);
    $upload2='1';
    $favimagename="fr_".$favmixno.".".$favext."";
  }else{
    $message="Invalid Image Type";
    $favimagename='';
  }
}

if(!isset($_POST['seled4med_country_code_display'])){
  $phone_country_code  = "";
} else {
  $phone_country_code =implode(",",$_POST['seled4med_country_code_display']);
}

/*$phone_country_code =implode(",",$_POST['seled4med_country_code_display']);*/
$seled4med_frontend_fonts_display = $_POST['seled4med_frontend_fonts_display'];
$d4m_calendar_defaultView = $_POST['d4m_calendar_defaultView'];
$d4m_calendar_firstDay = $_POST['d4m_calendar_firstDay'];
$slotstatus=(isset($_POST["fadded_slots"]) && $_POST["fadded_slots"]=='on') ? 'on':'off';
$gucstatus=(isset($_POST["guc_check"]) && $_POST["guc_check"]=='on') ? 'on':'off';
$eu_nu_status=(isset($_POST["eu_nu_check"]) && $_POST["eu_nu_check"]=='on') ? 'on':'off';
$d4m_cart_scrollable_status=(isset($_POST['d4m_cart_scrollable']) && $_POST['d4m_cart_scrollable']=='on') ? 'Y':'N';
$d4m_show_time_duration=(isset($_POST['d4m_show_time_duration']) && $_POST['d4m_show_time_duration']=='on') ? 'Y':'N';
$array1=array('d4m_primary_color','d4m_secondary_color','d4m_text_color','d4m_text_color_on_bg','d4m_primary_color_admin','d4m_secondary_color_admin','d4m_text_color_admin','d4m_hide_faded_already_booked_time_slots','d4m_guest_user_checkout','d4m_time_format','d4m_date_picker_date_format','d4m_custom_css','d4m_front_image','d4m_login_image','d4m_favicon_image','d4m_existing_and_new_user_checkout','d4m_cart_scrollable','d4m_phone_display_country_code','d4m_frontend_fonts','d4m_loader','d4m_custom_gif_loader','d4m_custom_css_loader','d4m_calendar_defaultView','d4m_calendar_firstDay','d4m_show_time_duration','d4m_special_day_color');   

$array2=array($_POST['d4m_primary_color'],$_POST['d4m_secondary_color'],$_POST['d4m_text_color'],$_POST['d4m_text_color_on_bg'],$_POST['d4m_primary_color_admin'],$_POST['d4m_secondary_color_admin'],$_POST['d4m_text_color_admin'],$slotstatus,$gucstatus,$_POST['d4m_time_format'],$_POST['d4m_date_picker_date_format'],$_POST['cust_css'],$frontimagename,$loginimagename,$favimagename,$eu_nu_status,$d4m_cart_scrollable_status,$phone_country_code,$seled4med_frontend_fonts_display,$_POST['d4m_loader_option'],$d4m_frontend_gif_imagename,$_POST['d4m_custom_css_loader'],$d4m_calendar_defaultView,$d4m_calendar_firstDay,$d4m_show_time_duration,$_POST['d4m_special_day_color']);

  if($gucstatus=='off' && $eu_nu_status=='off'){
    
  }else{
    for($i=0;$i<sizeof((array)$array1);$i++){
      if($i == 12){
        if($array2[12] != ""){
          $add3=$setting->set_option($array1[$i],$array2[$i]);
        }
      }elseif($i == 13){
        if($array2[13] != ""){
          $add3=$setting->set_option($array1[$i],$array2[$i]);
        }
      }elseif($i == 14){
        if($array2[14] != ""){
          $add3=$setting->set_option($array1[$i],$array2[$i]);
        }
      }elseif($i == 20){
        if($array2[20] != ""){
          $add3=$setting->set_option($array1[$i],$array2[$i]);
        }
      }else{
        $add3=$setting->set_option($array1[$i],$array2[$i]);
      }
      }
    header("location:".SITE_URL."admin/settings.php");
  }
  exit(); 
}   
/* save email templates */
for($kk = 1;$kk<=21;$kk++){
  if(isset($_POST['template'.$kk])){
    $id = $_POST['hdntemplate'.$kk];
    $email_template->id = $id;
    $email_template->email_message = base64_encode($_POST['email_message'.$kk]);
    $email_template->update_email_template();
    header("Location:settings.php");
    exit();
  }
} 

if(isset($_POST['btn_submit_frontend_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_front = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4mfrontlabeld4m'))){
      $language_front[str_replace('d4mfrontlabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_front_arr = base64_encode(serialize($language_front));
  
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('label_data', $language_front_arr, $update_labels);
  }else{
    
    $setting->insert_front_labels_languages($language_front_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
if(isset($_POST['btn_submit_admin_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_admin = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4madminlabeld4m'))){
      $language_admin[str_replace('d4madminlabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_admin_arr = base64_encode(serialize($language_admin));
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('admin_labels', $language_admin_arr, $update_labels);
  }else{
    $setting->insert_admin_labels_languages($language_admin_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
if(isset($_POST['btn_submit_error_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_error = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4merrorlabeld4m'))){
      $language_error[str_replace('d4merrorlabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_error_arr = base64_encode(serialize($language_error));
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('error_labels', $language_error_arr, $update_labels);
  }else{
    $setting->insert_error_labels_languages($language_error_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
if(isset($_POST['btn_submit_extra_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_extra = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4mextralabeld4m'))){
      $language_extra[str_replace('d4mextralabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_extra_arr = base64_encode(serialize($language_extra));
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('extra_labels', $language_extra_arr, $update_labels);
  }else{
    $setting->insert_extra_labels_languages($language_extra_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
if(isset($_POST['btn_submit_ferror_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_front_error = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4mfr_errorlabeld4m'))){
      $language_front_error[str_replace('d4mfr_errorlabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_front_error_arr = base64_encode(serialize($language_front_error));
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('front_error_labels', $language_front_error_arr, $update_labels);
  }else{
    $setting->insert_ferror_labels_languages($language_front_error_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
if(isset($_POST['btn_submit_app_labels']))
{
  $update_labels = $_POST['d4m_seled4med_lang_labels'];
  $language_extra = array();
  foreach($_POST as $key => $value){
    if(is_numeric(strpos($key,'d4mextralabeld4m'))){
      $language_extra[str_replace('d4mextralabeld4m','',$key)]=urlencode($value);
    }
  }
  $language_extra_arr = base64_encode(serialize($language_extra));
  if( $setting->check_for_existing_language($update_labels) > 0 ){
    $setting->update_labels_languages_per_tab('app_labels', $language_extra_arr, $update_labels);
  }else{
    $setting->insert_app_labels_languages($language_extra_arr, $update_labels);
  }
  header('Location: '.SITE_URL."admin/settings.php");
  exit;
}
?>
<script>
    var payment_status = '<?php echo $payment_status;?>';
</script>
<div class="panel d4ma-panel-default" id="d4m-settings">
    <div class="d4m-settings d4m-left-menu col-md-3 col-sm-3 col-xs-12 col-lg-3">
        <ul class="nav nav-tab nav-stacked" id="d4ma-settings-nav">
      <li class="ad4mive"><a href="#company-details" class="sot-company-details" data-toggle="pill"><i class="fa fa-building-o fa-2x"></i><br /><?php echo $label_language_values['company'];?></a></li>
      <li><a href="#general-setting" class="sot-general-setting" data-toggle="pill"><i class="fa fa-cog fa-2x"></i><br /><?php echo $label_language_values['general'];?></a></li>
      <li><a href="#appearance-setting" class="sot-appearance-setting" data-toggle="pill"><i class="fa fa-tachometer fa-2x"></i><br /><?php echo $label_language_values['appearance'];?></a></li>
      <li><a href="#payment-setting" class="sot-payment-setting" data-toggle="pill"><i class="fa fa-money fa-2x"></i><br /><?php echo $label_language_values['payments_setting'];?></a></li>
      <li><a href="#email-setting" class="sot-email-setting" data-toggle="pill"><i class="fa fa-paper-plane fa-2x"></i><br /><?php echo $label_language_values['email_notification'];?></a></li>
      <li><a href="#email-template" class="sot-email-template" data-toggle="pill"><i class="fa fa-envelope fa-2x"></i><br /><?php echo $label_language_values['email_template'];?></a></li>
      <li><a href="#sms-reminder" class="sot-sms-reminder" data-toggle="pill"><i class="fa fa-mobile fa-2x"></i><br /><?php echo $label_language_values['sms_notification'];?></a></li>
      <li><a href="#sms-template" class="sot-sms-template" data-toggle="pill"><i class="fa fa-comments fa-2x"></i><br /><?php echo $label_language_values['sms_template'];?></a></li>
      <li><a href="#recurrence-booking" class="sot-form-fields" data-toggle="pill"><i class="fa fa-repeat fa-2x"></i><br /><?php echo $label_language_values['Recurrence_booking'];?></a></li>
      <li><a href="#promocode" class="sot-promocode" data-toggle="pill"><i class="fa fa-tags fa-2x"></i><br /><?php echo $label_language_values['promocode'];?></a></li>
      <li><a href="#referal_settings" class="sot-referal_settings" data-toggle="pill"><i class="fa fa-tags fa-2x"></i><br />Referal code</a></li>
      <li><a href="#labels" class="sot-labels" data-toggle="pill"><i class="fa fa-language fa-2x"></i><br /><?php echo $label_language_values['labels'];?></a></li>
      <li><a href="#front_tooltips" class="sot-labels" data-toggle="pill"><i class="fa fa-language fa-2x"></i><br /><?php echo $label_language_values['front_tool_tips'];?></a></li>
      <li><a href="#manageable-form-fields" class="sot-form-fields" data-toggle="pill"><i class="fa fa-list fa-2x"></i><br /><?php echo $label_language_values['manageable_form_fields'];?></a></li>
      <li><a href="#seo-ga" class="sot-form-fields" data-toggle="pill"><i class="fa fa-line-chart fa-2x"></i><br /><?php echo $label_language_values['SEO'];?></a></li>
      <?php  
      if($gc_hook->gc_purchase_status() == 'exist'){
        echo $gc_hook->gc_setting_menu_hook();
      }
      ?>
        </ul>
    </div>
    <div class="panel-body">
    <div class="d4m-setting-details tab-content col-md-9 col-sm-9 col-lg-9 col-xs-12">
            <div class="company-details tab-pane fade in ad4mive" id="company-details">
                <form id="business_setting_form" method="post" type="" class="d4m-company-details" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['company_info_settings'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a id="company_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                            <table class="form-inline d4m-common-table">
                                <tbody>
                
                                <tr>
                                    <td><label><?php echo $label_language_values['seled4m_language_to_display'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_setted_language" id="display_language_user"   class="seled4mpicker" data-size="10" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>"  style="display: none;">
                                                <option value=""><?php echo $label_language_values['set_language'];?></option>
                                                <option value="en" <?php  echo ($setting->get_option("d4m_language")=="en" ? "seled4med" : "");?>>English (United States)</option>
                        <option value="ary" <?php  echo ($setting->get_option("d4m_language")=="ary" ? "seled4med" : "");?>>العربية المغربية</option>
                        <option value="ar" <?php  echo ($setting->get_option("d4m_language")=="ar" ? "seled4med" : "");?>>العربية</option>
                                                <option value="az" <?php  echo ($setting->get_option("d4m_language")=="az" ? "seled4med" : "");?>>Azərbaycan dili</option>
                        <option value="azb" <?php  echo ($setting->get_option("d4m_language")=="azb" ? "seled4med" : "");?>>گؤنئی آذربایجان</option>
                                                <option value="bg_BG" <?php  echo ($setting->get_option("d4m_language")=="bg_BG" ? "seled4med" : "");?>>Български</option>
                                                <option value="bn_BD" <?php  echo ($setting->get_option("d4m_language")=="bn_BD" ? "seled4med" : "");?>>বাংলা</option>
                                                <option value="bs_BA" <?php  echo ($setting->get_option("d4m_language")=="bs_BA" ? "seled4med" : "");?>>Bosanski</option>
                                                <option value="ca" <?php  echo ($setting->get_option("d4m_language")=="ca" ? "seled4med" : "");?>>Català</option>
                                                <option value="ceb" <?php  echo ($setting->get_option("d4m_language")=="ceb" ? "seled4med" : "");?>>Cebuano</option>
                                                <option value="cs_CZ" <?php  echo ($setting->get_option("d4m_language")=="cs_CZ" ? "seled4med" : "");?>>Čeština‎</option>
                                                <option value="cy" <?php  echo ($setting->get_option("d4m_language")=="cy" ? "seled4med" : "");?>>Cymraeg</option>
                                                <option value="da_DK" <?php  echo ($setting->get_option("d4m_language")=="da_DK" ? "seled4med" : "");?>>Dansk</option>
                                                <option value="de_CH_informal" <?php  echo ($setting->get_option("d4m_language")=="de_CH_informal" ? "seled4med" : "");?>>Deutsch (Schweiz, Du)</option>
                                                <option value="de_DE_formal" <?php  echo ($setting->get_option("d4m_language")=="de_DE_formal" ? "seled4med" : "");?>>Deutsch (Sie)</option>
                                                <option value="de_DE" <?php  echo ($setting->get_option("d4m_language")=="de_DE" ? "seled4med" : "");?>>Deutsch</option>
                                                <option value="de_CH" <?php  echo ($setting->get_option("d4m_language")=="de_CH" ? "seled4med" : "");?>>Deutsch (Schweiz)</option>
                                                <option value="el" <?php  echo ($setting->get_option("d4m_language")=="el" ? "seled4med" : "");?>>Ελληνικά</option>
                                                <option value="en_CA" <?php  echo ($setting->get_option("d4m_language")=="en_CA" ? "seled4med" : "");?>>English (Canada)</option>
                                                <option value="en_GB" <?php  echo ($setting->get_option("d4m_language")=="en_GB" ? "seled4med" : "");?>>English (UK)</option>
                                                <option value="en_NZ" <?php  echo ($setting->get_option("d4m_language")=="en_NZ" ? "seled4med" : "");?>>English (New Zealand)</option>
                                                <option value="en_ZA" <?php  echo ($setting->get_option("d4m_language")=="en_ZA" ? "seled4med" : "");?>>English (South Africa)</option>
                                                <option value="en_AU" <?php  echo ($setting->get_option("d4m_language")=="en_AU" ? "seled4med" : "");?>>English (Australia)</option>
                                                <option value="eo" <?php  echo ($setting->get_option("d4m_language")=="eo" ? "seled4med" : "");?>>Esperanto</option>
                                                <option value="es_ES" <?php  echo ($setting->get_option("d4m_language")=="es_ES" ? "seled4med" : "");?>>Español</option>
                                                <option value="et" <?php  echo ($setting->get_option("d4m_language")=="et" ? "seled4med" : "");?>>Eesti</option>
                                                <option value="eu" <?php  echo ($setting->get_option("d4m_language")=="eu" ? "seled4med" : "");?>>Euskara</option>
                        <option value="fa_IR" <?php  echo ($setting->get_option("d4m_language")=="fa_IR" ? "seled4med" : "");?>>فارسی</option>
                                                <option value="fi" <?php  echo ($setting->get_option("d4m_language")=="fi" ? "seled4med" : "");?>>Suomi</option>
                                                <option value="fr_FR" <?php  echo ($setting->get_option("d4m_language")=="fr_FR" ? "seled4med" : "");?>>Français</option>
                                                <option value="gd" <?php  echo ($setting->get_option("d4m_language")=="gd" ? "seled4med" : "");?>>Gàidhlig</option>
                                                <option value="gl_ES" <?php  echo ($setting->get_option("d4m_language")=="gl_ES" ? "seled4med" : "");?>>Galego</option>
                                                <option value="gu" <?php  echo ($setting->get_option("d4m_language")=="gu" ? "seled4med" : "");?>>ગુજરાતી</option>
                        <option value="haz" <?php  echo ($setting->get_option("d4m_language")=="haz" ? "seled4med" : "");?>>هزاره گی</option>
                                                <option value="hi_IN" <?php  echo ($setting->get_option("d4m_language")=="hi_IN" ? "seled4med" : "");?>>हिन्दी</option>
                                                <option value="hr" <?php  echo ($setting->get_option("d4m_language")=="hr" ? "seled4med" : "");?>>Hrvatski</option>
                                                <option value="hu_HU" <?php  echo ($setting->get_option("d4m_language")=="hu_HU" ? "seled4med" : "");?>>Magyar</option>
                                                <option value="hy" <?php  echo ($setting->get_option("d4m_language")=="hy" ? "seled4med" : "");?>>Հայերեն</option>
                                                <option value="id_ID" <?php  echo ($setting->get_option("d4m_language")=="id_ID" ? "seled4med" : "");?>>Bahasa Indonesia</option>
                                                <option value="is_IS" <?php  echo ($setting->get_option("d4m_language")=="is_IS" ? "seled4med" : "");?>>Íslenska</option>
                                                <option value="it_IT" <?php  echo ($setting->get_option("d4m_language")=="it_IT" ? "seled4med" : "");?>>Italiano</option>
                                                <option value="ja" <?php  echo ($setting->get_option("d4m_language")=="ja" ? "seled4med" : "");?>>日本語</option>
                                                <option value="ka_GE" <?php  echo ($setting->get_option("d4m_language")=="ka_GE" ? "seled4med" : "");?>>ქართული</option>
                                                <option value="ko_KR" <?php  echo ($setting->get_option("d4m_language")=="ko_KR" ? "seled4med" : "");?>>한국어</option>
                                                <option value="lt_LT" <?php  echo ($setting->get_option("d4m_language")=="lt_LT" ? "seled4med" : "");?>>Lietuvių kalba</option>
                                                <option value="lv" <?php  echo ($setting->get_option("d4m_language")=="lv" ? "seled4med" : "");?>>Latviešu valoda</option>
                                                <option value="mk_MK" <?php  echo ($setting->get_option("d4m_language")=="mk_MK" ? "seled4med" : "");?>>Македонски јазик</option>
                                                <option value="mr" <?php  echo ($setting->get_option("d4m_language")=="mr" ? "seled4med" : "");?>>मराठी</option>
                                                <option value="ms_MY" <?php  echo ($setting->get_option("d4m_language")=="ms_MY" ? "seled4med" : "");?>>Bahasa Melayu</option>
                                                <option value="my_MM" <?php  echo ($setting->get_option("d4m_language")=="my_MM" ? "seled4med" : "");?>>ဗမာစာ</option>
                                                <option value="nb_NO" <?php  echo ($setting->get_option("d4m_language")=="nb_NO" ? "seled4med" : "");?>>Norsk bokmål</option>
                                                <option value="nl_NL" <?php  echo ($setting->get_option("d4m_language")=="nl_NL" ? "seled4med" : "");?>>Nederlands</option>
                                                <option value="nl_NL_formal" <?php  echo ($setting->get_option("d4m_language")=="nl_NL_formal" ? "seled4med" : "");?>>Nederlands (Formeel)</option>
                                                <option value="nn_NO" <?php  echo ($setting->get_option("d4m_language")=="nn_NO" ? "seled4med" : "");?>>Norsk nynorsk</option>
                                                <option value="oci" <?php  echo ($setting->get_option("d4m_language")=="oci" ? "seled4med" : "");?>>Occitan</option>
                                                <option value="pl_PL" <?php  echo ($setting->get_option("d4m_language")=="pl_PL" ? "seled4med" : "");?>>Polski</option>
                                                <option value="pt_PT" <?php  echo ($setting->get_option("d4m_language")=="pt_PT" ? "seled4med" : "");?>>Português</option>
                                                <option value="pt_BR" <?php  echo ($setting->get_option("d4m_language")=="pt_BR" ? "seled4med" : "");?>>Português do Brasil</option>
                                                <option value="ro_RO" <?php  echo ($setting->get_option("d4m_language")=="ro_RO" ? "seled4med" : "");?>>Română</option>
                                                <option value="ru_RU" <?php  echo ($setting->get_option("d4m_language")=="ru_RU" ? "seled4med" : "");?>>Русский</option>
                                                <option value="sk_SK" <?php  echo ($setting->get_option("d4m_language")=="sk_SK" ? "seled4med" : "");?>>Slovenčina</option>
                                                <option value="sl_SI" <?php  echo ($setting->get_option("d4m_language")=="sl_SI" ? "seled4med" : "");?>>Slovenščina</option>
                                                <option value="sq" <?php  echo ($setting->get_option("d4m_language")=="sq" ? "seled4med" : "");?>>Shqip</option>
                                                <option value="sr_RS" <?php  echo ($setting->get_option("d4m_language")=="sr_RS" ? "seled4med" : "");?>>Српски језик</option>
                                                <option value="sv_SE" <?php  echo ($setting->get_option("d4m_language")=="sv_SE" ? "seled4med" : "");?>>Svenska</option>
                                                <option value="szl" <?php  echo ($setting->get_option("d4m_language")=="szl" ? "seled4med" : "");?>>Ślōnskŏ gŏdka</option>
                                                <option value="th" <?php  echo ($setting->get_option("d4m_language")=="th" ? "seled4med" : "");?>>ไทย</option>
                                                <option value="tl" <?php  echo ($setting->get_option("d4m_language")=="tl" ? "seled4med" : "");?>>Tagalog</option>
                                                <option value="tr_TR" <?php  echo ($setting->get_option("d4m_language")=="tr_TR" ? "seled4med" : "");?>>Türkçe</option>
                                                <option value="ug_CN" <?php  echo ($setting->get_option("d4m_language")=="ug_CN" ? "seled4med" : "");?>>Uyƣurqə</option>
                                                <option value="uk" <?php  echo ($setting->get_option("d4m_language")=="uk" ? "seled4med" : "");?>>Українська</option>
                                                <option value="vi" <?php  echo ($setting->get_option("d4m_language")=="vi" ? "seled4med" : "");?>>Tiếng Việt</option>
                                                <option value="zh_TW" <?php  echo ($setting->get_option("d4m_language")=="zh_TW" ? "seled4med" : "");?>>繁體中文</option>
                                                <option value="zh_HK" <?php  echo ($setting->get_option("d4m_language")=="zh_HK" ? "seled4med" : "");?>>香港中文版</option>
                                                <option value="zh_CN" <?php  echo ($setting->get_option("d4m_language")=="zh_CN" ? "seled4med" : "");?>>简体中文</option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label><?php echo $label_language_values['timezone'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m class="seled4mpicker" id="time-zone" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-size="10" style="display: none;">
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Niue'){ echo "seled4med"; } ?> value="Pacific/Niue" data-posinset="3">(GMT-11:00) Niue Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Pago_Pago'){ echo "seled4med"; } ?> value="Pacific/Pago_Pago" data-posinset="4">(GMT-11:00) Samoa Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Rarotonga'){ echo "seled4med"; } ?> value="Pacific/Rarotonga" data-posinset="5">(GMT-10:00) Cook Islands Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Honolulu'){ echo "seled4med"; } ?> value="Pacific/Honolulu" data-posinset="6">(GMT-10:00) Hawaii-Aleutian Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Tahiti'){ echo "seled4med"; } ?> value="Pacific/Tahiti" data-posinset="7">(GMT-10:00) Tahiti Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Marquesas'){ echo "seled4med"; } ?> value="Pacific/Marquesas" data-posinset="8">(GMT-09:30) Marquesas Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Gambier'){ echo "seled4med"; } ?> value="Pacific/Gambier" data-posinset="9">(GMT-09:30) Gambier Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Anchorage'){ echo "seled4med"; } ?> value="America/Anchorage" data-posinset="10">(GMT-08:00) Alaska Time - Anchorage</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Pitcairn'){ echo "seled4med"; } ?> value="Pacific/Pitcairn" data-posinset="11">(GMT-08:00) Pitcairn Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Hermosillo'){ echo "seled4med"; } ?> value="America/Hermosillo" data-posinset="12">(GMT-07:00) Mexican Pacific Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Dawson_Creek'){ echo "seled4med"; } ?> value="America/Dawson_Creek" data-posinset="13">(GMT-07:00) Mountain Standard Time - Dawson Creek</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Phoenix'){ echo "seled4med"; } ?> value="America/Phoenix" data-posinset="14">(GMT-07:00) Mountain Standard Time - Phoenix</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Dawson'){ echo "seled4med"; } ?> value="America/Dawson" data-posinset="15">(GMT-07:00) Pacific Time - Dawson</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Los_Angeles'){ echo "seled4med"; } ?> value="America/Los_Angeles" data-posinset="16">(GMT-07:00) Pacific Time - Los Angeles</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Tijuana'){ echo "seled4med"; } ?> value="America/Tijuana" data-posinset="17">(GMT-07:00) Pacific Time - Tijuana</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Vancouver'){ echo "seled4med"; } ?> value="America/Vancouver" data-posinset="18">(GMT-07:00) Pacific Time - Vancouver</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Whitehorse'){ echo "seled4med"; } ?> value="America/Whitehorse" data-posinset="19">(GMT-07:00) Pacific Time - Whitehorse</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Belize'){ echo "seled4med"; } ?> value="America/Belize" data-posinset="20">(GMT-06:00) Central Standard Time - Belize</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Costa_Rica'){ echo "seled4med"; } ?> value="America/Costa_Rica" data-posinset="21">(GMT-06:00) Central Standard Time - Costa Rica</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/El_Salvador'){ echo "seled4med"; } ?> value="America/El_Salvador" data-posinset="22">(GMT-06:00) Central Standard Time - El Salvador</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Guatemala'){ echo "seled4med"; } ?> value="America/Guatemala" data-posinset="23">(GMT-06:00) Central Standard Time - Guatemala</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Managua'){ echo "seled4med"; } ?> value="America/Managua" data-posinset="24">(GMT-06:00) Central Standard Time - Managua</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Regina'){ echo "seled4med"; } ?> value="America/Regina" data-posinset="25">(GMT-06:00) Central Standard Time - Regina</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Tegucigalpa'){ echo "seled4med"; } ?> value="America/Tegucigalpa" data-posinset="26">(GMT-06:00) Central Standard Time - Tegucigalpa</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Easter'){ echo "seled4med"; } ?> value="Pacific/Easter" data-posinset="27">(GMT-06:00) Easter Island Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Galapagos'){ echo "seled4med"; } ?> value="Pacific/Galapagos" data-posinset="28">(GMT-06:00) Galapagos Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Mazatlan'){ echo "seled4med"; } ?> value="America/Mazatlan" data-posinset="29">(GMT-06:00) Mexican Pacific Time - Mazatlan</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Boise'){ echo "seled4med"; } ?> value="America/Boise" data-posinset="30">(GMT-06:00) Mountain Time - Boise</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Denver'){ echo "seled4med"; } ?> value="America/Denver" data-posinset="31">(GMT-06:00) Mountain Time - Denver</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Edmonton'){ echo "seled4med"; } ?> value="America/Edmonton" data-posinset="32">(GMT-06:00) Mountain Time - Edmonton</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Yellowknife'){ echo "seled4med"; } ?> value="America/Yellowknife" data-posinset="33">(GMT-06:00) Mountain Time - Yellowknife</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Rio_Branco'){ echo "seled4med"; } ?> value="America/Rio_Branco" data-posinset="34">(GMT-05:00) Acre Standard Time - Rio Branco</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Chicago'){ echo "seled4med"; } ?> value="America/Chicago" data-posinset="35">(GMT-05:00) Central Time - Chicago</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Mexico_City'){ echo "seled4med"; } ?> value="America/Mexico_City" data-posinset="36">(GMT-05:00) Central Time - Mexico City</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Winnipeg'){ echo "seled4med"; } ?> value="America/Winnipeg" data-posinset="37">(GMT-05:00) Central Time - Winnipeg</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Bogota'){ echo "seled4med"; } ?> value="America/Bogota" data-posinset="38">(GMT-05:00) Colombia Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Cancun'){ echo "seled4med"; } ?> value="America/Cancun" data-posinset="39">(GMT-05:00) Eastern Standard Time - Cancun</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Jamaica'){ echo "seled4med"; } ?> value="America/Jamaica" data-posinset="40">(GMT-05:00) Eastern Standard Time - Jamaica</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Panama'){ echo "seled4med"; } ?> value="America/Panama" data-posinset="41">(GMT-05:00) Eastern Standard Time - Panama</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Guayaquil'){ echo "seled4med"; } ?> value="America/Guayaquil" data-posinset="42">(GMT-05:00) Ecuador Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Lima'){ echo "seled4med"; } ?> value="America/Lima" data-posinset="43">(GMT-05:00) Peru Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Boa_Vista'){ echo "seled4med"; } ?> value="America/Boa_Vista" data-posinset="44">(GMT-04:00) Amazon Standard Time - Boa Vista</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Manaus'){ echo "seled4med"; } ?> value="America/Manaus" data-posinset="45">(GMT-04:00) Amazon Standard Time - Manaus</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Porto_Velho'){ echo "seled4med"; } ?> value="America/Porto_Velho" data-posinset="46">(GMT-04:00) Amazon Standard Time - Porto Velho</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Campo_Grande'){ echo "seled4med"; } ?> value="America/Campo_Grande" data-posinset="47">(GMT-04:00) Amazon Time - Campo Grande</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Cuiaba'){ echo "seled4med"; } ?> value="America/Cuiaba" data-posinset="48">(GMT-04:00) Amazon Time - Cuiaba</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Barbados'){ echo "seled4med"; } ?> value="America/Barbados" data-posinset="49">(GMT-04:00) Atlantic Standard Time - Barbados</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Curacao'){ echo "seled4med"; } ?> value="America/Curacao" data-posinset="50">(GMT-04:00) Atlantic Standard Time - Curaçao</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Martinique'){ echo "seled4med"; } ?> value="America/Martinique" data-posinset="51">(GMT-04:00) Atlantic Standard Time - Martinique</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Port_of_Spain'){ echo "seled4med"; } ?> value="America/Port_of_Spain" data-posinset="52">(GMT-04:00) Atlantic Standard Time - Port of Spain</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Puerto_Rico'){ echo "seled4med"; } ?> value="America/Puerto_Rico" data-posinset="53">(GMT-04:00) Atlantic Standard Time - Puerto Rico</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Santo_Domingo'){ echo "seled4med"; } ?> value="America/Santo_Domingo" data-posinset="54">(GMT-04:00) Atlantic Standard Time - Santo Domingo</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/La_Paz'){ echo "seled4med"; } ?> value="America/La_Paz" data-posinset="55">(GMT-04:00) Bolivia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Santiago'){ echo "seled4med"; } ?> value="America/Santiago" data-posinset="56">(GMT-04:00) Chile Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Havana'){ echo "seled4med"; } ?> value="America/Havana" data-posinset="57">(GMT-04:00) Cuba Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Detroit'){ echo "seled4med"; } ?> value="America/Detroit" data-posinset="58">(GMT-04:00) Eastern Time - Detroit</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Grand_Turk'){ echo "seled4med"; } ?> value="America/Grand_Turk" data-posinset="59">(GMT-04:00) Eastern Time - Grand Turk</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Iqaluit'){ echo "seled4med"; } ?> value="America/Iqaluit" data-posinset="60">(GMT-04:00) Eastern Time - Iqaluit</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Nassau'){ echo "seled4med"; } ?> value="America/Nassau" data-posinset="61">(GMT-04:00) Eastern Time - Nassau</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/New_York'){ echo "seled4med"; } ?> value="America/New_York" data-posinset="62">(GMT-04:00) Eastern Time - New York</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Port-au-Prince'){ echo "seled4med"; } ?> value="America/Port-au-Prince" data-posinset="63">(GMT-04:00) Eastern Time - Port-au-Prince</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Toronto'){ echo "seled4med"; } ?> value="America/Toronto" data-posinset="64">(GMT-04:00) Eastern Time - Toronto</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Guyana'){ echo "seled4med"; } ?> value="America/Guyana" data-posinset="65">(GMT-04:00) Guyana Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Asuncion'){ echo "seled4med"; } ?> value="America/Asuncion" data-posinset="66">(GMT-04:00) Paraguay Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Caracas'){ echo "seled4med"; } ?> value="America/Caracas" data-posinset="67">(GMT-04:00) Venezuela Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Argentina/Buenos_Aires'){ echo "seled4med"; } ?> value="America/Argentina/Buenos_Aires" data-posinset="68">(GMT-03:00) Argentina Standard Time - Buenos Aires</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Argentina/Cordoba'){ echo "seled4med"; } ?> value="America/Argentina/Cordoba" data-posinset="69">(GMT-03:00) Argentina Standard Time - Cordoba</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Bermuda'){ echo "seled4med"; } ?> value="Atlantic/Bermuda" data-posinset="70">(GMT-03:00) Atlantic Time - Bermuda</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Halifax'){ echo "seled4med"; } ?> value="America/Halifax" data-posinset="71">(GMT-03:00) Atlantic Time - Halifax</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Thule'){ echo "seled4med"; } ?> value="America/Thule" data-posinset="72">(GMT-03:00) Atlantic Time - Thule</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Araguaina'){ echo "seled4med"; } ?> value="America/Araguaina" data-posinset="73">(GMT-03:00) Brasilia Standard Time - Araguaina</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Bahia'){ echo "seled4med"; } ?> value="America/Bahia" data-posinset="74">(GMT-03:00) Brasilia Standard Time - Bahia</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Belem'){ echo "seled4med"; } ?> value="America/Belem" data-posinset="75">(GMT-03:00) Brasilia Standard Time - Belem</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Fortaleza'){ echo "seled4med"; } ?> value="America/Fortaleza" data-posinset="76">(GMT-03:00) Brasilia Standard Time - Fortaleza</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Maceio'){ echo "seled4med"; } ?> value="America/Maceio" data-posinset="77">(GMT-03:00) Brasilia Standard Time - Maceio</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Recife'){ echo "seled4med"; } ?> value="America/Recife" data-posinset="78">(GMT-03:00) Brasilia Standard Time - Recife</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Sao_Paulo'){ echo "seled4med"; } ?> value="America/Sao_Paulo" data-posinset="79">(GMT-03:00) Brasilia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Stanley'){ echo "seled4med"; } ?> value="Atlantic/Stanley" data-posinset="80">(GMT-03:00) Falkland Islands Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Cayenne'){ echo "seled4med"; } ?> value="America/Cayenne" data-posinset="81">(GMT-03:00) French Guiana Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Palmer'){ echo "seled4med"; } ?> value="Antard4mica/Palmer" data-posinset="82">(GMT-03:00) Palmer Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Punta_Arenas'){ echo "seled4med"; } ?> value="America/Punta_Arenas" data-posinset="83">(GMT-03:00) Punta Arenas Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Rothera'){ echo "seled4med"; } ?> value="Antard4mica/Rothera" data-posinset="84">(GMT-03:00) Rothera Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Paramaribo'){ echo "seled4med"; } ?> value="America/Paramaribo" data-posinset="85">(GMT-03:00) Suriname Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Montevideo'){ echo "seled4med"; } ?> value="America/Montevideo" data-posinset="86">(GMT-03:00) Uruguay Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/St_Johns'){ echo "seled4med"; } ?> value="America/St_Johns" data-posinset="87">(GMT-02:30) Newfoundland Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Noronha'){ echo "seled4med"; } ?> value="America/Noronha" data-posinset="88">(GMT-02:00) Fernando de Noronha Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/South_Georgia'){ echo "seled4med"; } ?> value="Atlantic/South_Georgia" data-posinset="89">(GMT-02:00) South Georgia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Miquelon'){ echo "seled4med"; } ?> value="America/Miquelon" data-posinset="90">(GMT-02:00) St. Pierre &amp; Miquelon Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Godthab'){ echo "seled4med"; } ?> value="America/Godthab" data-posinset="91">(GMT-02:00) West Greenland Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Cape_Verde'){ echo "seled4med"; } ?> value="Atlantic/Cape_Verde" data-posinset="92">(GMT-01:00) Cape Verde Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Azores'){ echo "seled4med"; } ?> value="Atlantic/Azores" data-posinset="93">(GMT+00:00) Azores Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Scoresbysund'){ echo "seled4med"; } ?> value="America/Scoresbysund" data-posinset="94">(GMT+00:00) East Greenland Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Etc/GMT'){ echo "seled4med"; } ?> value="Etc/GMT" data-posinset="95">(GMT+00:00) Greenwich Mean Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Abidjan'){ echo "seled4med"; } ?> value="Africa/Abidjan" data-posinset="96">(GMT+00:00) Greenwich Mean Time - Abidjan</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Accra'){ echo "seled4med"; } ?> value="Africa/Accra" data-posinset="97">(GMT+00:00) Greenwich Mean Time - Accra</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Bissau'){ echo "seled4med"; } ?> value="Africa/Bissau" data-posinset="98">(GMT+00:00) Greenwich Mean Time - Bissau</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='America/Danmarkshavn'){ echo "seled4med"; } ?> value="America/Danmarkshavn" data-posinset="99">(GMT+00:00) Greenwich Mean Time - Danmarkshavn</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Monrovia'){ echo "seled4med"; } ?> value="Africa/Monrovia" data-posinset="100">(GMT+00:00) Greenwich Mean Time - Monrovia</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Reykjavik'){ echo "seled4med"; } ?> value="Atlantic/Reykjavik" data-posinset="101">(GMT+00:00) Greenwich Mean Time - Reykjavik</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='UTC'){ echo "seled4med"; } ?> value="UTC" data-posinset="102">UTC</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Algiers'){ echo "seled4med"; } ?> value="Africa/Algiers" data-posinset="103">(GMT+01:00) Central European Standard Time - Algiers</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Tunis'){ echo "seled4med"; } ?> value="Africa/Tunis" data-posinset="104">(GMT+01:00) Central European Standard Time - Tunis</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Dublin'){ echo "seled4med"; } ?> value="Europe/Dublin" data-posinset="105">(GMT+01:00) Ireland Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/London'){ echo "seled4med"; } ?> value="Europe/London" data-posinset="106">(GMT+01:00) United Kingdom Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Lagos'){ echo "seled4med"; } ?> value="Africa/Lagos" data-posinset="107">(GMT+01:00) West Africa Standard Time - Lagos</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Ndjamena'){ echo "seled4med"; } ?> value="Africa/Ndjamena" data-posinset="108">(GMT+01:00) West Africa Standard Time - Ndjamena</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Sao_Tome'){ echo "seled4med"; } ?> value="Africa/Sao_Tome" data-posinset="109">(GMT+01:00) West Africa Standard Time - São Tomé</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Canary'){ echo "seled4med"; } ?> value="Atlantic/Canary" data-posinset="110">(GMT+01:00) Western European Time - Canary</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Casablanca'){ echo "seled4med"; } ?> value="Africa/Casablanca" data-posinset="111">(GMT+01:00) Western European Time - Casablanca</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/El_Aaiun'){ echo "seled4med"; } ?> value="Africa/El_Aaiun" data-posinset="112">(GMT+01:00) Western European Time - El Aaiun</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Atlantic/Faroe'){ echo "seled4med"; } ?> value="Atlantic/Faroe" data-posinset="113">(GMT+01:00) Western European Time - Faroe</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Lisbon'){ echo "seled4med"; } ?> value="Europe/Lisbon" data-posinset="114">(GMT+01:00) Western European Time - Lisbon</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Khartoum'){ echo "seled4med"; } ?> value="Africa/Khartoum" data-posinset="115">(GMT+02:00) Central Africa Time - Khartoum</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Maputo'){ echo "seled4med"; } ?> value="Africa/Maputo" data-posinset="116">(GMT+02:00) Central Africa Time - Maputo</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Windhoek'){ echo "seled4med"; } ?> value="Africa/Windhoek" data-posinset="117">(GMT+02:00) Central Africa Time - Windhoek</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Amsterdam'){ echo "seled4med"; } ?> value="Europe/Amsterdam" data-posinset="118">(GMT+02:00) Central European Time - Amsterdam</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Andorra'){ echo "seled4med"; } ?> value="Europe/Andorra" data-posinset="119">(GMT+02:00) Central European Time - Andorra</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Belgrade'){ echo "seled4med"; } ?> value="Europe/Belgrade" data-posinset="120">(GMT+02:00) Central European Time - Belgrade</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Berlin'){ echo "seled4med"; } ?> value="Europe/Berlin" data-posinset="121">(GMT+02:00) Central European Time - Berlin</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Brussels'){ echo "seled4med"; } ?> value="Europe/Brussels" data-posinset="122">(GMT+02:00) Central European Time - Brussels</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Budapest'){ echo "seled4med"; } ?> value="Europe/Budapest" data-posinset="123">(GMT+02:00) Central European Time - Budapest</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Ceuta'){ echo "seled4med"; } ?> value="Africa/Ceuta" data-posinset="124">(GMT+02:00) Central European Time - Ceuta</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Copenhagen'){ echo "seled4med"; } ?> value="Europe/Copenhagen" data-posinset="125">(GMT+02:00) Central European Time - Copenhagen</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Gibraltar'){ echo "seled4med"; } ?> value="Europe/Gibraltar" data-posinset="126">(GMT+02:00) Central European Time - Gibraltar</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Luxembourg'){ echo "seled4med"; } ?> value="Europe/Luxembourg" data-posinset="127">(GMT+02:00) Central European Time - Luxembourg</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Madrid'){ echo "seled4med"; } ?> value="Europe/Madrid" data-posinset="128">(GMT+02:00) Central European Time - Madrid</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Malta'){ echo "seled4med"; } ?> value="Europe/Malta" data-posinset="129">(GMT+02:00) Central European Time - Malta</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Monaco'){ echo "seled4med"; } ?> value="Europe/Monaco" data-posinset="130">(GMT+02:00) Central European Time - Monaco</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Oslo'){ echo "seled4med"; } ?> value="Europe/Oslo" data-posinset="131">(GMT+02:00) Central European Time - Oslo</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Paris'){ echo "seled4med"; } ?> value="Europe/Paris" data-posinset="132">(GMT+02:00) Central European Time - Paris</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Prague'){ echo "seled4med"; } ?> value="Europe/Prague" data-posinset="133">(GMT+02:00) Central European Time - Prague</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Rome'){ echo "seled4med"; } ?> value="Europe/Rome" data-posinset="134">(GMT+02:00) Central European Time - Rome</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Stockholm'){ echo "seled4med"; } ?> value="Europe/Stockholm" data-posinset="135">(GMT+02:00) Central European Time - Stockholm</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Tirane'){ echo "seled4med"; } ?> value="Europe/Tirane" data-posinset="136">(GMT+02:00) Central European Time - Tirane</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Vienna'){ echo "seled4med"; } ?> value="Europe/Vienna" data-posinset="137">(GMT+02:00) Central European Time - Vienna</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Warsaw'){ echo "seled4med"; } ?> value="Europe/Warsaw" data-posinset="138">(GMT+02:00) Central European Time - Warsaw</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Zurich'){ echo "seled4med"; } ?> value="Europe/Zurich" data-posinset="139">(GMT+02:00) Central European Time - Zurich</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Cairo'){ echo "seled4med"; } ?> value="Africa/Cairo" data-posinset="140">(GMT+02:00) Eastern European Standard Time - Cairo</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Kaliningrad'){ echo "seled4med"; } ?> value="Europe/Kaliningrad" data-posinset="141">(GMT+02:00) Eastern European Standard Time - Kaliningrad</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Tripoli'){ echo "seled4med"; } ?> value="Africa/Tripoli" data-posinset="142">(GMT+02:00) Eastern European Standard Time - Tripoli</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Johannesburg'){ echo "seled4med"; } ?> value="Africa/Johannesburg" data-posinset="143">(GMT+02:00) South Africa Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Baghdad'){ echo "seled4med"; } ?> value="Asia/Baghdad" data-posinset="144">(GMT+03:00) Arabian Standard Time - Baghdad</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Qatar'){ echo "seled4med"; } ?> value="Asia/Qatar" data-posinset="145">(GMT+03:00) Arabian Standard Time - Qatar</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Riyadh'){ echo "seled4med"; } ?> value="Asia/Riyadh" data-posinset="146">(GMT+03:00) Arabian Standard Time - Riyadh</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Africa/Nairobi'){ echo "seled4med"; } ?> value="Africa/Nairobi" data-posinset="147">(GMT+03:00) East Africa Time - Nairobi</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Amman'){ echo "seled4med"; } ?> value="Asia/Amman" data-posinset="148">(GMT+03:00) Eastern European Time - Amman</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Athens'){ echo "seled4med"; } ?> value="Europe/Athens" data-posinset="149">(GMT+03:00) Eastern European Time - Athens</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Beirut'){ echo "seled4med"; } ?> value="Asia/Beirut" data-posinset="150">(GMT+03:00) Eastern European Time - Beirut</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Bucharest'){ echo "seled4med"; } ?> value="Europe/Bucharest" data-posinset="151">(GMT+03:00) Eastern European Time - Bucharest</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Chisinau'){ echo "seled4med"; } ?> value="Europe/Chisinau" data-posinset="152">(GMT+03:00) Eastern European Time - Chisinau</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Damascus'){ echo "seled4med"; } ?> value="Asia/Damascus" data-posinset="153">(GMT+03:00) Eastern European Time - Damascus</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Gaza'){ echo "seled4med"; } ?> value="Asia/Gaza" data-posinset="154">(GMT+03:00) Eastern European Time - Gaza</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Helsinki'){ echo "seled4med"; } ?> value="Europe/Helsinki" data-posinset="155">(GMT+03:00) Eastern European Time - Helsinki</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Kiev'){ echo "seled4med"; } ?> value="Europe/Kiev" data-posinset="156">(GMT+03:00) Eastern European Time - Kiev</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Nicosia'){ echo "seled4med"; } ?> value="Asia/Nicosia" data-posinset="157">(GMT+03:00) Eastern European Time - Nicosia</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Riga'){ echo "seled4med"; } ?> value="Europe/Riga" data-posinset="158">(GMT+03:00) Eastern European Time - Riga</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Sofia'){ echo "seled4med"; } ?> value="Europe/Sofia" data-posinset="159">(GMT+03:00) Eastern European Time - Sofia</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Tallinn'){ echo "seled4med"; } ?> value="Europe/Tallinn" data-posinset="160">(GMT+03:00) Eastern European Time - Tallinn</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Vilnius'){ echo "seled4med"; } ?> value="Europe/Vilnius" data-posinset="161">(GMT+03:00) Eastern European Time - Vilnius</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Jerusalem'){ echo "seled4med"; } ?> value="Asia/Jerusalem" data-posinset="162">(GMT+03:00) Israel Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Minsk'){ echo "seled4med"; } ?> value="Europe/Minsk" data-posinset="163">(GMT+03:00) Moscow Standard Time - Minsk</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Moscow'){ echo "seled4med"; } ?> value="Europe/Moscow" data-posinset="164">(GMT+03:00) Moscow Standard Time - Moscow</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Syowa'){ echo "seled4med"; } ?> value="Antard4mica/Syowa" data-posinset="165">(GMT+03:00) Syowa Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Istanbul'){ echo "seled4med"; } ?> value="Europe/Istanbul" data-posinset="166">(GMT+03:00) Turkey Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Yerevan'){ echo "seled4med"; } ?> value="Asia/Yerevan" data-posinset="167">(GMT+04:00) Armenia Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Baku'){ echo "seled4med"; } ?> value="Asia/Baku" data-posinset="168">(GMT+04:00) Azerbaijan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Tbilisi'){ echo "seled4med"; } ?> value="Asia/Tbilisi" data-posinset="169">(GMT+04:00) Georgia Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Dubai'){ echo "seled4med"; } ?> value="Asia/Dubai" data-posinset="170">(GMT+04:00) Gulf Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Mauritius'){ echo "seled4med"; } ?> value="Indian/Mauritius" data-posinset="171">(GMT+04:00) Mauritius Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Reunion'){ echo "seled4med"; } ?> value="Indian/Reunion" data-posinset="172">(GMT+04:00) Réunion Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Europe/Samara'){ echo "seled4med"; } ?> value="Europe/Samara" data-posinset="173">(GMT+04:00) Samara Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Mahe'){ echo "seled4med"; } ?> value="Indian/Mahe" data-posinset="174">(GMT+04:00) Seychelles Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Kabul'){ echo "seled4med"; } ?> value="Asia/Kabul" data-posinset="175">(GMT+04:30) Afghanistan Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Tehran'){ echo "seled4med"; } ?> value="Asia/Tehran" data-posinset="176">(GMT+04:30) Iran Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Kerguelen'){ echo "seled4med"; } ?> value="Indian/Kerguelen" data-posinset="177">(GMT+05:00) French Southern &amp; Antard4mic Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Maldives'){ echo "seled4med"; } ?> value="Indian/Maldives" data-posinset="178">(GMT+05:00) Maldives Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Mawson'){ echo "seled4med"; } ?> value="Antard4mica/Mawson" data-posinset="179">(GMT+05:00) Mawson Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Karachi'){ echo "seled4med"; } ?> value="Asia/Karachi" data-posinset="180">(GMT+05:00) Pakistan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Dushanbe'){ echo "seled4med"; } ?> value="Asia/Dushanbe" data-posinset="181">(GMT+05:00) Tajikistan Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Ashgabat'){ echo "seled4med"; } ?> value="Asia/Ashgabat" data-posinset="182">(GMT+05:00) Turkmenistan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Tashkent'){ echo "seled4med"; } ?> value="Asia/Tashkent" data-posinset="183">(GMT+05:00) Uzbekistan Standard Time - Tashkent</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Aqtau'){ echo "seled4med"; } ?> value="Asia/Aqtau" data-posinset="184">(GMT+05:00) West Kazakhstan Time - Aqtau</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Aqtobe'){ echo "seled4med"; } ?> value="Asia/Aqtobe" data-posinset="185">(GMT+05:00) West Kazakhstan Time - Aqtobe</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Yekaterinburg'){ echo "seled4med"; } ?> value="Asia/Yekaterinburg" data-posinset="186">(GMT+05:00) Yekaterinburg Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Colombo'){ echo "seled4med"; } ?> value="Asia/Colombo" data-posinset="187">(GMT+05:30) India Standard Time - Colombo</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Calcutta'){ echo "seled4med"; } ?> value="Asia/Calcutta" data-posinset="188">(GMT+05:30) India Standard Time - Kolkata</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Katmandu'){ echo "seled4med"; } ?> value="Asia/Katmandu" data-posinset="189">(GMT+05:45) Nepal Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Dhaka'){ echo "seled4med"; } ?> value="Asia/Dhaka" data-posinset="190">(GMT+06:00) Bangladesh Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Thimphu'){ echo "seled4med"; } ?> value="Asia/Thimphu" data-posinset="191">(GMT+06:00) Bhutan Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Almaty'){ echo "seled4med"; } ?> value="Asia/Almaty" data-posinset="192">(GMT+06:00) East Kazakhstan Time - Almaty</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Chagos'){ echo "seled4med"; } ?> value="Indian/Chagos" data-posinset="193">(GMT+06:00) Indian Ocean Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Bishkek'){ echo "seled4med"; } ?> value="Asia/Bishkek" data-posinset="194">(GMT+06:00) Kyrgyzstan Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Omsk'){ echo "seled4med"; } ?> value="Asia/Omsk" data-posinset="195">(GMT+06:00) Omsk Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Vostok'){ echo "seled4med"; } ?> value="Antard4mica/Vostok" data-posinset="196">(GMT+06:00) Vostok Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Cocos'){ echo "seled4med"; } ?> value="Indian/Cocos" data-posinset="197">(GMT+06:30) Cocos Islands Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Yangon'){ echo "seled4med"; } ?> value="Asia/Yangon" data-posinset="198">(GMT+06:30) Myanmar Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Indian/Christmas'){ echo "seled4med"; } ?> value="Indian/Christmas" data-posinset="199">(GMT+07:00) Christmas Island Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Davis'){ echo "seled4med"; } ?> value="Antard4mica/Davis" data-posinset="200">(GMT+07:00) Davis Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Hovd'){ echo "seled4med"; } ?> value="Asia/Hovd" data-posinset="201">(GMT+07:00) Hovd Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Bangkok'){ echo "seled4med"; } ?> value="Asia/Bangkok" data-posinset="202">(GMT+07:00) Indochina Time - Bangkok</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Saigon'){ echo "seled4med"; } ?> value="Asia/Saigon" data-posinset="203">(GMT+07:00) Indochina Time - Ho Chi Minh City</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Krasnoyarsk'){ echo "seled4med"; } ?> value="Asia/Krasnoyarsk" data-posinset="204">(GMT+07:00) Krasnoyarsk Standard Time - Krasnoyarsk</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Jakarta'){ echo "seled4med"; } ?> value="Asia/Jakarta" data-posinset="205">(GMT+07:00) Western Indonesia Time - Jakarta</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/Casey'){ echo "seled4med"; } ?> value="Antard4mica/Casey" data-posinset="206">(GMT+08:00) Australian Western Standard Time - Casey</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Perth'){ echo "seled4med"; } ?> value="Australia/Perth" data-posinset="207">(GMT+08:00) Australian Western Standard Time - Perth</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Brunei'){ echo "seled4med"; } ?> value="Asia/Brunei" data-posinset="208">(GMT+08:00) Brunei Darussalam Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Makassar'){ echo "seled4med"; } ?> value="Asia/Makassar" data-posinset="209">(GMT+08:00) Central Indonesia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Macau'){ echo "seled4med"; } ?> value="Asia/Macau" data-posinset="210">(GMT+08:00) China Standard Time - Macau</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Shanghai'){ echo "seled4med"; } ?> value="Asia/Shanghai" data-posinset="211">(GMT+08:00) China Standard Time - Shanghai</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Choibalsan'){ echo "seled4med"; } ?> value="Asia/Choibalsan" data-posinset="212">(GMT+08:00) Choibalsan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Hong_Kong'){ echo "seled4med"; } ?> value="Asia/Hong_Kong" data-posinset="213">(GMT+08:00) Hong Kong Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Irkutsk'){ echo "seled4med"; } ?> value="Asia/Irkutsk" data-posinset="214">(GMT+08:00) Irkutsk Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Kuala_Lumpur'){ echo "seled4med"; } ?> value="Asia/Kuala_Lumpur" data-posinset="215">(GMT+08:00) Malaysia Time - Kuala Lumpur</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Manila'){ echo "seled4med"; } ?> value="Asia/Manila" data-posinset="216">(GMT+08:00) Philippine Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Singapore'){ echo "seled4med"; } ?> value="Asia/Singapore" data-posinset="217">(GMT+08:00) Singapore Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Taipei'){ echo "seled4med"; } ?> value="Asia/Taipei" data-posinset="218">(GMT+08:00) Taipei Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Ulaanbaatar'){ echo "seled4med"; } ?> value="Asia/Ulaanbaatar" data-posinset="219">(GMT+08:00) Ulaanbaatar Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Dili'){ echo "seled4med"; } ?> value="Asia/Dili" data-posinset="220">(GMT+09:00) East Timor Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Jayapura'){ echo "seled4med"; } ?> value="Asia/Jayapura" data-posinset="221">(GMT+09:00) Eastern Indonesia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Tokyo'){ echo "seled4med"; } ?> value="Asia/Tokyo" data-posinset="222">(GMT+09:00) Japan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Pyongyang'){ echo "seled4med"; } ?> value="Asia/Pyongyang" data-posinset="223">(GMT+09:00) Korean Standard Time - Pyongyang</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Seoul'){ echo "seled4med"; } ?> value="Asia/Seoul" data-posinset="224">(GMT+09:00) Korean Standard Time - Seoul</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Palau'){ echo "seled4med"; } ?> value="Pacific/Palau" data-posinset="225">(GMT+09:00) Palau Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Yakutsk'){ echo "seled4med"; } ?> value="Asia/Yakutsk" data-posinset="226">(GMT+09:00) Yakutsk Standard Time - Yakutsk</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Darwin'){ echo "seled4med"; } ?> value="Australia/Darwin" data-posinset="227">(GMT+09:30) Australian Central Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Adelaide'){ echo "seled4med"; } ?> value="Australia/Adelaide" data-posinset="228">(GMT+09:30) Central Australia Time - Adelaide</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Brisbane'){ echo "seled4med"; } ?> value="Australia/Brisbane" data-posinset="229">(GMT+10:00) Australian Eastern Standard Time - Brisbane</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Guam'){ echo "seled4med"; } ?> value="Pacific/Guam" data-posinset="230">(GMT+10:00) Chamorro Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Chuuk'){ echo "seled4med"; } ?> value="Pacific/Chuuk" data-posinset="231">(GMT+10:00) Chuuk Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Antard4mica/DumontDUrville'){ echo "seled4med"; } ?> value="Antard4mica/DumontDUrville" data-posinset="232">(GMT+10:00) Dumont-d’Urville Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Hobart'){ echo "seled4med"; } ?> value="Australia/Hobart" data-posinset="233">(GMT+10:00) Eastern Australia Time - Hobart</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Melbourne'){ echo "seled4med"; } ?> value="Australia/Melbourne" data-posinset="234">(GMT+10:00) Eastern Australia Time - Melbourne</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Australia/Sydney'){ echo "seled4med"; } ?> value="Australia/Sydney" data-posinset="235">(GMT+10:00) Eastern Australia Time - Sydney</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Port_Moresby'){ echo "seled4med"; } ?> value="Pacific/Port_Moresby" data-posinset="236">(GMT+10:00) Papua New Guinea Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Vladivostok'){ echo "seled4med"; } ?> value="Asia/Vladivostok" data-posinset="237">(GMT+10:00) Vladivostok Standard Time - Vladivostok</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Kosrae'){ echo "seled4med"; } ?> value="Pacific/Kosrae" data-posinset="238">(GMT+11:00) Kosrae Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Magadan'){ echo "seled4med"; } ?> value="Asia/Magadan" data-posinset="239">(GMT+11:00) Magadan Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Noumea'){ echo "seled4med"; } ?> value="Pacific/Noumea" data-posinset="240">(GMT+11:00) New Caledonia Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Norfolk'){ echo "seled4med"; } ?> value="Pacific/Norfolk" data-posinset="241">(GMT+11:00) Norfolk Island Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Pohnpei'){ echo "seled4med"; } ?> value="Pacific/Pohnpei" data-posinset="242">(GMT+11:00) Ponape Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Guadalcanal'){ echo "seled4med"; } ?> value="Pacific/Guadalcanal" data-posinset="243">(GMT+11:00) Solomon Islands Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Efate'){ echo "seled4med"; } ?> value="Pacific/Efate" data-posinset="244">(GMT+11:00) Vanuatu Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Fiji'){ echo "seled4med"; } ?> value="Pacific/Fiji" data-posinset="245">(GMT+12:00) Fiji Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Tarawa'){ echo "seled4med"; } ?> value="Pacific/Tarawa" data-posinset="246">(GMT+12:00) Gilbert Islands Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Kwajalein'){ echo "seled4med"; } ?> value="Pacific/Kwajalein" data-posinset="247">(GMT+12:00) Marshall Islands Time - Kwajalein</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Majuro'){ echo "seled4med"; } ?> value="Pacific/Majuro" data-posinset="248">(GMT+12:00) Marshall Islands Time - Majuro</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Nauru'){ echo "seled4med"; } ?> value="Pacific/Nauru" data-posinset="249">(GMT+12:00) Nauru Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Auckland'){ echo "seled4med"; } ?> value="Pacific/Auckland" data-posinset="250">(GMT+12:00) New Zealand Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Asia/Kamchatka'){ echo "seled4med"; } ?> value="Asia/Kamchatka" data-posinset="251">(GMT+12:00) Petropavlovsk-Kamchatski Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Funafuti'){ echo "seled4med"; } ?> value="Pacific/Funafuti" data-posinset="252">(GMT+12:00) Tuvalu Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Wake'){ echo "seled4med"; } ?> value="Pacific/Wake" data-posinset="253">(GMT+12:00) Wake Island Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Wallis'){ echo "seled4med"; } ?> value="Pacific/Wallis" data-posinset="254">(GMT+12:00) Wallis &amp; Futuna Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Apia'){ echo "seled4med"; } ?> value="Pacific/Apia" data-posinset="255">(GMT+13:00) Apia Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Enderbury'){ echo "seled4med"; } ?> value="Pacific/Enderbury" data-posinset="256">(GMT+13:00) Phoenix Islands Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Fakaofo'){ echo "seled4med"; } ?> value="Pacific/Fakaofo" data-posinset="257">(GMT+13:00) Tokelau Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Tongatapu'){ echo "seled4med"; } ?> value="Pacific/Tongatapu" data-posinset="258">(GMT+13:00) Tonga Standard Time</option>
                        <option <?php if($setting->get_option('d4m_timezone')=='Pacific/Kiritimati'){ echo "seled4med"; } ?> value="Pacific/Kiritimati" data-posinset="259">(GMT+14:00) Line Islands Time</option>
                      </seled4m>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['companyname'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="company_name" style="width: 300px;"class="form-control" size="35" name="d4m_company_name" value="<?php echo $setting->get_option('d4m_company_name');?>" placeholder="<?php echo $label_language_values['company_name'];?>" />
                      <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['company_name_is_used_for_invoice_purpose'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                    <td><label><?php echo $label_language_values['company_email'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" style="width: 300px;" class="form-control" id="company_email" size="35" name="d4m_company_email" value="<?php echo $setting->get_option('d4m_company_email');?>" placeholder="<?php echo $label_language_values['company_email'];?>" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                  <td><?php echo $label_language_values['default_country_code'];?></td>
                                  <td>
                                    <div class="form-group">
                                      <div class="d4ma-country-code-flag" id="country_phone_code_div">
                                        <?php  $country_codes = explode(',',$setting->get_option("d4m_company_country_code"));?>
                                        <input type="tel" id="company_country_code" class="form-control d4ma-col6" value="<?php echo $country_codes[0];?>" name="d4m_company_country_code" />
                                        <label class="numbercode hide"><?php echo $country_codes[0];?></label>
                                        <label class="alphacode hide"><?php echo $country_codes[1];?></label>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><label><?php echo $label_language_values['company_phone'];?></label></td>
                                  <td>
                                  <div class="input-group">
                                    <span class="input-group-addon"><span class="company_country_code_value"><?php echo $country_codes[0];?></span></span>
                                    <input type="text" class="form-control" id="company_phone" name="d4m_company_phone" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('d4m_company_phone'));?>" placeholder="<?php echo $label_language_values['company_phone'];?>" />
                                  </div>
                                  <label for="company_phone" generated="true" class="error"></label>
                                  </td>
                                </tr>
                
                
                                <tr>
                                    <td><label><?php echo $label_language_values['company_address'];?></label></td>

                                    <td><div class="form-group">
                                            <div class="d4ma-col12"><textarea id="company_address" name="d4m_company_address" class="form-control" cols="44"><?php echo $setting->get_option('d4m_company_address');?></textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><div class="form-group">
                                            <div class="d4ma-col6 d4m-w-50">
                                                <input type="text" class="form-control" id="company_city" name="d4m_company_city" value="<?php echo $setting->get_option('d4m_company_city');?>" placeholder="<?php echo $label_language_values['city'];?>" />
                                            </div>
                                            <div class="d4ma-col6 d4m-w-50 float-right">
                                                <input type="text" class="form-control" id="company_state" name="d4m_company_state" value="<?php echo $setting->get_option('d4m_company_state');?>" placeholder="<?php echo $label_language_values['state'];?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="d4ma-col6 d4m-w-50">
                                                <input type="text" class="form-control" id="company_zip" name="d4m_company_zip" value="<?php echo $setting->get_option('d4m_company_zip_code');?>" placeholder="<?php echo $label_language_values['zip'];?>" />
                                            </div>
                                            <div class="d4ma-col6 d4m-w-50 float-right">
                                                <input type="text" class="form-control" id="company_country" name="d4m_company_country" value="<?php echo $setting->get_option('d4m_company_country');?>" placeholder="<?php echo $label_language_values['country'];?>" />
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['company_logo'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="d4m-company-logo-uploader">
                                                <?php 
                                                if($setting->get_option('d4m_company_logo')==''){
                                                    $imagepath=SITE_URL."assets/images/company-logo.png";
                                                }else{
                                                    $imagepath=SITE_URL."assets/images/services/".$setting->get_option('d4m_company_logo');

                                                }?>
                                                <img id="d4msisalonlogo" src="<?php echo $imagepath;?>" class="d4m-company-logo br-5">
                                                <?php 
                                                if($setting->get_option('d4m_company_logo')==''){
                                                    ?>
                                                    <label for="d4m-upload-imaged4msi" class="d4m-company-logo-icon-label set_cam_icon">
                                                        <i class="d4m-camera-icon-common br-100 fa fa-camera"></i>
                                                        <i class="pull-left fa fa-plus-circle fa-2x"></i>
                                                    </label>
                                                <?php 
                                                }
                                                ?>
                                                <input data-us="d4msi" class="hide d4m-upload-images" type="file" name="" id="d4m-upload-imaged4msi"/>
                                                <label for="d4m-upload-imaged4msi" class="d4m-company-logo-icon-label set_newcam_icon">
                                                    <i class="d4m-camera-icon-common br-100 fa fa-camera"></i>
                                                    <i class="pull-left fa fa-plus-circle fa-2x"></i>
                                                </label>
                                                <?php 
                                                if($setting->get_option('d4m_company_logo')!==''){
                                                    ?>
                                                    <a id="d4m-remove-company-logo-new" class="pull-left br-100 btn-danger bt-remove-company-logo btn-xs del_set_popup" rel="popover" data-placement='left' title="<?php echo $label_language_values['remove_image'];?>?"> <i class="fa fa-trash" title="<?php echo $label_language_values['remove_company_logo'];?>"></i></a>
                                                <?php 
                                                }
                                                ?>
                                                <a id="d4m-remove-company-logo-new" class="pull-left br-100 btn-danger bt-remove-company-logo btn-xs del_btn" rel="popover" data-placement='left' title="<?php echo $label_language_values['remove_image'];?>?"> <i class="fa fa-trash" title="<?php echo $label_language_values['remove_company_logo'];?>"></i></a>
                                                <div id="popover-d4m-remove-company-logo-new" style="display: none;">
                                                    <div class="arrow"></div>
                                                    <table class="form-horizontal" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <a id="d4m-close-popover-salon-logo" value="Delete" class="btn btn-danger btn-sm delete_com_logo" data-comp_id="<?php echo $setting->d4m_company_logo;?>" type="submit"><?php echo $label_language_values['yes'];?></a>
                                                                <a href="javascript:void(0)" id="d4m-close-popover-salon-logod4msi" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <label class="error_image"></label>
                                                <div class="d4m-salon-logo-popup-view">

                                                    <div id="d4m-image-upload-popupd4msi" class="d4m-image-upload-popup modal fade" tabindex="-1" role="dialog">
                                                        <div class="vertical-alignment-helper">
                                                            <div class="modal-dialog modal-md vertical-align-center">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="col-md-12 col-xs-12">

                                                                            <a data-us="d4msi" class="btn btn-success d4m_upload_img3"  data-imageinputid="d4m-upload-imaged4msi"><?php echo $label_language_values['crop_and_save'];?></a>
                                                                            
                                                                            <button type="button" class="btn btn-default hidemodal" data-dismiss="modal" aria-hidden="true"><?php echo $label_language_values['cancel'];?></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img id="d4m-preview-imgd4msi" class="d4m-preview-img" name="image" />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="col-md-12 np">
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left"><?php echo $label_language_values['file_size'];?></label> <input type="text" class="form-control" id="d4msifilesize" name="filesize" />
                                                                            </div>
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left">H</label> <input type="text" class="form-control" id="d4msih" name="h" />
                                                                            </div>
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left">W</label> <input type="text" class="form-control" id="d4msiw" name="w" />
                                                                            </div>
                                                                            <input type="hidden" id="d4msix1" name="x1" />
                                                                            <input type="hidden" id="d4msiy1" name="y1" />
                                                                            <input type="hidden" id="d4msix2" name="x2" />
                                                                            <input type="hidden" id="d4msiy2" name="y2" />
                                                                            <input type="hidden" id="d4msiid" name="id" value="1" />
                                                                            <input type="hidden" name="d4mimage" id="d4msid4mimage" />
                                                                            <input type="hidden" id="d4msid4mimagename" name="d4mimagename" value="<?php echo $setting->d4m_company_logo;?>" />
                                                                            <input type="hidden" id="d4msinewname" value="company_" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['company_logo_is_used_for_invoice_purpose'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                </tbody>

                                <tfoot>
                                <tr>
                                    <td class="dis_none"></td>
                                    <td>
                                        <a id="company_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a>
                  </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <!-- file upload preview -->

            <div class="tab-pane fade in" id="general-setting">
                <form id="general_setting_form" method="post" type="" class="d4m-general-setting" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['general_settings'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a id="general_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                            <table class="form-inline d4m-common-table" >
                                <tbody>
                <tr>
                                    <td><label><?php echo $label_language_values['postal_codes'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="d4moggle-postal-code" for="postal-code">
                                                    <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_postalcode_status=='Y'){echo 'checked';}?> id="postalcode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          
                         <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['postal_codes_ed'];?>"><i class="fa fa-info-circle fa-lg"></i></a> 
                                                </label>
                                                <div class="hide-div mycollapse_postalcode pt-15" <?php  if($setting->d4m_postalcode_status=='Y'){echo 'style="display:block;"';}?>>
                                                    <textarea class="form-control" name="d4m_postal_code" id="d4m_postal_code" row="4" cols="40"><?php echo $setting->get_option_postal();?></textarea> 
                          
                          <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['postal_codes_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php  echo $label_language_values['time_interval'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_time_interval" id="time_interval" class="seled4mpicker" data-size="5" style="display: none;">
                                                <option  value="10" <?php  if($setting->d4m_time_interval=='10'){echo 'seled4med';} ?>>10 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="15" <?php  if($setting->d4m_time_interval=='15'){echo 'seled4med';} ?>>15 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="20" <?php  if($setting->d4m_time_interval=='20'){echo 'seled4med';} ?>>20 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="30" <?php  if($setting->d4m_time_interval=='30'){echo 'seled4med';} ?>>30 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="45" <?php  if($setting->d4m_time_interval=='45'){echo 'seled4med';} ?>>45 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="60" <?php  if($setting->d4m_time_interval=='60'){echo 'seled4med';} ?>>1 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="90" <?php  if($setting->d4m_time_interval=='90'){echo 'seled4med';} ?>>1.5 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="120" <?php  if($setting->d4m_time_interval=='120'){echo 'seled4med';} ?>>2 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="150" <?php  if($setting->d4m_time_interval=='150'){echo 'seled4med';} ?>>2.5 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php  if($setting->d4m_time_interval=='180'){echo 'seled4med';} ?>>3 <?php  echo $label_language_values['hours'];?></option>
                                            </seled4m>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['time_interval_is_helpful_to_show_time_difference_between_availability_time_slots'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php  echo $label_language_values['minimum_advance_booking_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_min_advance_booking_time" id="d4m_min_advance_booking_time" class="seled4mpicker" data-size="5" style="display: none;">
                                                <option value=""><?php echo $label_language_values['minimum_advance_booking_time'];?></option>
                                                <option  value="10" <?php  if($setting->d4m_min_advance_booking_time=='10'){echo 'seled4med';} ?>>10 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="20" <?php  if($setting->d4m_min_advance_booking_time=='20'){echo 'seled4med';} ?>>20 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="30" <?php  if($setting->d4m_min_advance_booking_time=='30'){echo 'seled4med';} ?>>30 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="40" <?php  if($setting->d4m_min_advance_booking_time=='40'){echo 'seled4med';} ?>>40 <?php  echo $label_language_values['minutes'];?></option>
                                                <option  value="60" <?php  if($setting->d4m_min_advance_booking_time=='60'){echo 'seled4med';} ?>>1 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="120" <?php  if($setting->d4m_min_advance_booking_time=='120'){echo 'seled4med';} ?>>2 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php  if($setting->d4m_min_advance_booking_time=='180'){echo 'seled4med';} ?>>3 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="240" <?php  if($setting->d4m_min_advance_booking_time=='240'){echo 'seled4med';} ?>>4 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="300" <?php  if($setting->d4m_min_advance_booking_time=='300'){echo 'seled4med';} ?>>5 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="360" <?php  if($setting->d4m_min_advance_booking_time=='360'){echo 'seled4med';} ?>>6 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="420" <?php  if($setting->d4m_min_advance_booking_time=='420'){echo 'seled4med';} ?>>7 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="480" <?php  if($setting->d4m_min_advance_booking_time=='480'){echo 'seled4med';} ?>>8 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="720" <?php  if($setting->d4m_min_advance_booking_time=='720'){echo 'seled4med';} ?>>12 <?php  echo $label_language_values['hours'];?></option>
                        
                        <option  value="1440" <?php  if($setting->d4m_min_advance_booking_time=='1440'){echo 'seled4med';} ?>>24 <?php  echo $label_language_values['hours'];?></option>
                        
                        <option  value="1440" <?php  if($setting->d4m_min_advance_booking_time=='1440'){echo 'seled4med';} ?>>1 <?php  echo str_replace("s","",$label_language_values['days']);?></option>
                        
                        <option  value="2880" <?php  if($setting->d4m_min_advance_booking_time=='2880'){echo 'seled4med';} ?>>2 <?php  echo $label_language_values['days'];?></option>
                        
                        <option  value="4320" <?php  if($setting->d4m_min_advance_booking_time=='4320'){echo 'seled4med';} ?>>3 <?php  echo $label_language_values['days'];?></option>
                        <option  value="5760" <?php  if($setting->d4m_min_advance_booking_time=='5760'){echo 'seled4med';} ?>>4 <?php  echo $label_language_values['days'];?></option>
                        <option  value="7200" <?php  if($setting->d4m_min_advance_booking_time=='7200'){echo 'seled4med';} ?>>5 <?php  echo $label_language_values['days'];?></option>
                        <option  value="8640" <?php  if($setting->d4m_min_advance_booking_time=='8640'){echo 'seled4med';} ?>>6 <?php  echo $label_language_values['days'];?></option>
                        
                                                <option value="10080" <?php  if($setting->d4m_min_advance_booking_time=='10080'){echo 'seled4med';} ?>>7 <?php  echo $label_language_values['days'];?></option>
                                            </seled4m>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['minimum_advance_booking_time_restrid4m_client_to_book_last_minute_booking_so_that_you_should_have_sufficient_time_before_appointment'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['maximum_advance_booking_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_max_advance_booking_time" id="d4m_max_advance_booking_time"  class="seled4mpicker" data-size="5" style="display: none;">
                                                <option value="" <?php  if($setting->d4m_max_advance_booking_time==''){echo 'seled4med';} ?>><?php echo $label_language_values['maximum_advance_booking_time'];?></option>
                                                <option value="1" <?php  if($setting->d4m_max_advance_booking_time=='1'){echo 'seled4med';} ?>>1 <?php  echo $label_language_values['months'];?></option>
                                                <option value="2" <?php  if($setting->d4m_max_advance_booking_time=='2'){echo 'seled4med';} ?>>2 <?php  echo $label_language_values['months'];?></option>
                                                <option value="3" <?php  if($setting->d4m_max_advance_booking_time=='3'){echo 'seled4med';} ?>>3 <?php  echo $label_language_values['months'];?></option>
                                                <option value="4" <?php  if($setting->d4m_max_advance_booking_time=='4'){echo 'seled4med';} ?>>4 <?php  echo $label_language_values['months'];?></option>
                                                <option value="5" <?php  if($setting->d4m_max_advance_booking_time=='5'){echo 'seled4med';} ?>>5 <?php  echo $label_language_values['months'];?></option>
                                                <option value="6" <?php  if($setting->d4m_max_advance_booking_time=='6'){echo 'seled4med';} ?>>6 <?php  echo $label_language_values['months'];?></option>
                                                <option value="12" <?php  if($setting->d4m_max_advance_booking_time=='12'){echo 'seled4med';} ?>>1 <?php  echo $label_language_values['year'];?></option>
                                                <option  value="24" <?php  if($setting->d4m_max_advance_booking_time=='24'){echo 'seled4med';} ?>>2 <?php  echo $label_language_values['year'];?></option>
                                                <option  value="36" <?php  if($setting->d4m_max_advance_booking_time=='36'){echo 'seled4med';} ?>>3 <?php  echo $label_language_values['year'];?></option>
                                                <option value="48" <?php  if($setting->d4m_max_advance_booking_time=='48'){echo 'seled4med';} ?>>4 <?php  echo $label_language_values['year'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['cancellation_buffer_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_cancellation_buffer_time" id="d4m_cancellation_buffer_time" class="seled4mpicker" data-size="5" style="display: none;">
                                                <option value=""><?php echo $label_language_values['cancellation_buffer_time'];?></option>
                                                <option  value="60" <?php  if($setting->d4m_cancellation_buffer_time=='60'){echo 'seled4med';} ?> >1 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="120" <?php  if($setting->d4m_cancellation_buffer_time=='120'){echo 'seled4med';} ?> >2 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="180" <?php  if($setting->d4m_cancellation_buffer_time=='180'){echo 'seled4med';} ?> >3 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="240" <?php  if($setting->d4m_cancellation_buffer_time=='240'){echo 'seled4med';} ?> >4 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="300" <?php  if($setting->d4m_cancellation_buffer_time=='300'){echo 'seled4med';} ?> >5 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="360" <?php  if($setting->d4m_cancellation_buffer_time=='360'){echo 'seled4med';} ?>>6 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="420" <?php  if($setting->d4m_cancellation_buffer_time=='420'){echo 'seled4med';} ?>>7 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="480" <?php  if($setting->d4m_cancellation_buffer_time=='480'){echo 'seled4med';} ?>>8 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="540" <?php  if($setting->d4m_cancellation_buffer_time=='540'){echo 'seled4med';} ?>>9 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="600" <?php  if($setting->d4m_cancellation_buffer_time=='600'){echo 'seled4med';} ?>>10 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="660" <?php  if($setting->d4m_cancellation_buffer_time=='660'){echo 'seled4med';} ?>>11 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="720" <?php  if($setting->d4m_cancellation_buffer_time=='720'){echo 'seled4med';} ?>>12 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="1440" <?php  if($setting->d4m_cancellation_buffer_time=='1440'){echo 'seled4med';} ?>>24 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="2880" <?php  if($setting->d4m_cancellation_buffer_time=='2880'){echo 'seled4med';} ?>>48 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="4320" <?php  if($setting->d4m_cancellation_buffer_time=='4320'){echo 'seled4med';} ?>>72 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="5760" <?php  if($setting->d4m_cancellation_buffer_time=='5760'){echo 'seled4med';} ?>>96 <?php  echo $label_language_values['hours'];?></option>
                       </seled4m>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['cancellation_buffer_helps_service_providers_to_avoid_last_minute_cancellation_by_their_clients'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['reshedule_buffer_time'];?> </label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m class="seled4mpicker" name="d4m_reshedule_buffer_time" id="d4m_reshedule_buffer_time" data-size="5"  style="display: none;">
                                                <option value=""><?php echo $label_language_values['reshedule_buffer_time'];?></option>
                                                <option value="60" <?php  if($setting->d4m_reshedule_buffer_time=='60'){echo 'seled4med';} ?> >1 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="120" <?php  if($setting->d4m_reshedule_buffer_time=='120'){echo 'seled4med';} ?> >2 <?php  echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php  if($setting->d4m_reshedule_buffer_time=='180'){echo 'seled4med';} ?> >3 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="240" <?php  if($setting->d4m_reshedule_buffer_time=='240'){echo 'seled4med';} ?> >4 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="300" <?php  if($setting->d4m_reshedule_buffer_time=='300'){echo 'seled4med';} ?> >5 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="360" <?php  if($setting->d4m_reshedule_buffer_time=='360'){echo 'seled4med';} ?> >6 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="420" <?php  if($setting->d4m_reshedule_buffer_time=='420'){echo 'seled4med';} ?> >7 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="480" <?php  if($setting->d4m_reshedule_buffer_time=='480'){echo 'seled4med';} ?> >8 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="540" <?php  if($setting->d4m_reshedule_buffer_time=='540'){echo 'seled4med';} ?> >9 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="600" <?php  if($setting->d4m_reshedule_buffer_time=='600'){echo 'seled4med';} ?> >10 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="660" <?php  if($setting->d4m_reshedule_buffer_time=='660'){echo 'seled4med';} ?> >11 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="720" <?php  if($setting->d4m_reshedule_buffer_time=='720'){echo 'seled4med';} ?> >12 <?php  echo $label_language_values['hours'];?></option>
                                            </seled4m>
                                        </div>
                                        <!-- <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="Lorem ipsem"><i class="fa fa-info-circle fa-lg"></i></a> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['currency'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_currency" class="seled4mpicker form-control" data-live-search="true" id="d4m_currency" data-size="5" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-ad4mions-box="true" >
                                                <option value=""><?php echo"-- Seled4m Currency --";?></option>
                                                <option value="ALL" <?php  if($setting->d4m_currency =='ALL' ){ echo ' seled4med '; }?>>Lek <?php  echo "Albania Lek";?></option>

                                                <option value="AED" <?php  if($setting->d4m_currency =='AED' ){ echo ' seled4med '; }?>>د.إ <?php  echo "UAE Dirham";?></option>

                                                <option value="AFN" <?php  if($setting->d4m_currency =='AFN' ){ echo ' seled4med '; }?>>؋ <?php  echo "Afghanistan Afghani";?></option>
                                                <option value="ARS" <?php  if($setting->d4m_currency =='ARS' ){ echo ' seled4med '; }?>>$ <?php  echo "Argentina Peso";?></option>


                                                <option value="ANG" <?php  if($setting->d4m_currency =='ANG' ){ echo ' seled4med '; }?>>NAƒ <?php  echo "Neth Antilles Guilder";?></option>

                                                <option value="AWG" <?php  if($setting->d4m_currency =='AWG' ){ echo ' seled4med '; }?>>ƒ <?php  echo "Aruba Guilder";?></option>
                                                <option value="AUD" <?php  if($setting->d4m_currency =='AUD' ){ echo ' seled4med '; }?>>$ <?php  echo "Australia Dollar";?></option>
                                                <option value="AZN" <?php  if($setting->d4m_currency =='AZN' ){ echo ' seled4med '; }?>>ман <?php  echo "Azerbaijan Manat";?></option>
                                                <option value="BSD" <?php  if($setting->d4m_currency =='BSD' ){ echo ' seled4med '; }?>>$ <?php  echo "Bahamas Dollar";?></option>
                                                <option value="BBD" <?php  if($setting->d4m_currency =='BBD' ){ echo ' seled4med '; }?>>$ <?php  echo "Barbados Dollar";?></option>
                                                <option value="BYR" <?php  if($setting->d4m_currency =='BYR' ){ echo ' seled4med '; }?>>p <?php  echo "Belarus Ruble";?></option>
                                                <option value="BZD" <?php  if($setting->d4m_currency =='BZD' ){ echo ' seled4med '; }?>>BZ$ <?php  echo "Belize Dollar";?></option>
                                                <option value="BMD" <?php  if($setting->d4m_currency =='BMD' ){ echo ' seled4med '; }?>>$ <?php  echo "Bermuda Dollar";?></option>
                                                <option value="BOB" <?php  if($setting->d4m_currency =='BOB' ){ echo ' seled4med '; }?>>$b <?php  echo "Bolivia Boliviano";?></option>
                                                <option value="BAM" <?php  if($setting->d4m_currency =='BAM' ){ echo ' seled4med '; }?>>KM <?php  echo "Bosnia and Herzegovina Convertible Marka";?></option>
                                                <option value="BWP" <?php  if($setting->d4m_currency =='BWP' ){ echo ' seled4med '; }?>>P <?php  echo "Botswana Pula";?></option>
                                                <option value="BGN" <?php  if($setting->d4m_currency =='BGN' ){ echo ' seled4med '; }?>>лв <?php  echo "Bulgaria Lev";?></option>
                                                <option value="BRL" <?php  if($setting->d4m_currency =='BRL' ){ echo ' seled4med '; }?>>R$ <?php  echo "Brazil Real";?></option>
                                                <option value="BND" <?php  if($setting->d4m_currency =='BND' ){ echo ' seled4med '; }?>>$ <?php  echo "Brunei Darussalam Dollar";?></option>

                                                <option value="BDT" <?php  if($setting->d4m_currency =='BDT' ){ echo ' seled4med '; }?>>Tk <?php  echo "Bangladesh Taka";?></option>
                                                <option value="BIF" <?php  if($setting->d4m_currency =='BIF' ){ echo ' seled4med '; }?>>FBu <?php  echo "Burundi Franc";?></option>

                                                <option value="CHF" <?php  if($setting->d4m_currency =='CHF' ){ echo ' seled4med '; }?>>CHF<?php  echo "Swiss Franc";?></option>


                                                <option value="KHR" <?php  if($setting->d4m_currency =='KHR' ){ echo ' seled4med '; }?>>៛  <?php  echo "Cambodia Riel";?></option>
                                                <option value="KMF" <?php  if($setting->d4m_currency =='KMF' ){ echo ' seled4med '; }?>>KMF <?php  echo "Comoros Franc";?></option>

                                                <option value="CAD" <?php  if($setting->d4m_currency =='CAD' ){ echo ' seled4med '; }?>>$ <?php  echo "Canada Dollar";?></option>
                                                <option value="KYD" <?php  if($setting->d4m_currency =='KYD' ){ echo ' seled4med '; }?>>$ <?php  echo "Cayman Dollar";?></option>

                                                <option value="CLP" <?php  if($setting->d4m_currency =='CLP' ){ echo ' seled4med '; }?>>$ <?php  echo "Chile Peso";?></option>
                                                <option value="CYN" <?php  if($setting->d4m_currency =='CYN' ){ echo ' seled4med '; }?>>¥ <?php  echo "China Yuan Renminbi";?></option>

                                                <option value="CVE" <?php  if($setting->d4m_currency =='CVE' ){ echo ' seled4med '; }?>>Esc <?php  echo "Cape Verde Escudo";?></option>

                                                <option value="COP" <?php  if($setting->d4m_currency =='COP' ){ echo ' seled4med '; }?>>$ <?php  echo "Colombia Peso";?></option>
                                                <option value="CRC" <?php  if($setting->d4m_currency =='CRC' ){ echo ' seled4med '; }?>>₡ <?php  echo "Costa Rica Colon";?></option>
                                                <option value="HRK" <?php  if($setting->d4m_currency =='HRK' ){ echo ' seled4med '; }?>>kn <?php  echo "Croatia Kuna";?></option>
                                                <option value="CUP" <?php  if($setting->d4m_currency =='CUP' ){ echo ' seled4med '; }?>>₱ <?php  echo "Cuba Peso";?></option>
                                                <option value="CZK" <?php  if($setting->d4m_currency =='CZK' ){ echo ' seled4med '; }?>>Kč <?php  echo "Czech Republic Koruna";?></option>
                                                <option value="DKK" <?php  if($setting->d4m_currency =='DKK' ){ echo ' seled4med '; }?>>kr <?php  echo "Denmark Krone";?></option>
                                                <option value="DOP" <?php  if($setting->d4m_currency =='DOP' ){ echo ' seled4med '; }?>>RD$ <?php  echo "Dominican Republic Peso";?></option>

                                                <option value="DJF" <?php  if($setting->d4m_currency =='DJF' ){ echo ' seled4med '; }?>>Fdj <?php  echo "Djibouti Franc";?></option>
                                                <option value="DZD" <?php  if($setting->d4m_currency =='DZD' ){ echo ' seled4med '; }?>>دج <?php  echo "Algerian Dinar";?></option>


                                                <option value="XCD" <?php  if($setting->d4m_currency =='XCD' ){ echo ' seled4med '; }?>>$  <?php  echo "East Caribbean Dollar";?></option>
                                                <option value="EGP" <?php  if($setting->d4m_currency =='EGP' ){ echo ' seled4med '; }?>>£ <?php  echo "Egypt Pound";?></option>

                                                <option value="ETB" <?php  if($setting->d4m_currency =='ETB' ){ echo ' seled4med '; }?>>Br <?php  echo "Ethiopian Birr";?></option>

                                                <option value="SVC" <?php  if($setting->d4m_currency =='SVC' ){ echo ' seled4med '; }?>>$  <?php  echo "El Salvador Colon";?></option>
                                                <option value="EEK" <?php  if($setting->d4m_currency =='EEK' ){ echo ' seled4med '; }?>>kr <?php  echo "Estonia Kroon";?></option>
                                                <option value="EUR" <?php  if($setting->d4m_currency =='EUR' ){ echo ' seled4med '; }?>>€  <?php  echo "Euro Member Euro";?></option>
                                                <option value="FKP" <?php  if($setting->d4m_currency =='FKP' ){ echo ' seled4med '; }?>>£ <?php  echo "Falkland Islands Pound";?></option>
                                                <option value="FJD" <?php  if($setting->d4m_currency =='FJD' ){ echo ' seled4med '; }?>>$  <?php  echo "Fiji Dollar";?></option>

                                                <option value="GHC" <?php  if($setting->d4m_currency =='GHC' ){ echo ' seled4med '; }?>>¢ <?php  echo "Ghana Cedis";?></option>
                                                <option value="GIP" <?php  if($setting->d4m_currency =='GIP' ){ echo ' seled4med '; }?>>£ <?php  echo "Gibraltar Pound";?></option>

                                                <option value="GMD" <?php  if($setting->d4m_currency =='GMD' ){ echo ' seled4med '; }?>>D <?php  echo "Gambian Dalasi";?></option>
                                                <option value="GNF" <?php  if($setting->d4m_currency =='GNF' ){ echo ' seled4med '; }?>>FG <?php  echo "Guinea Franc";?></option>

                                                <option value="GTQ" <?php  if($setting->d4m_currency =='GTQ' ){ echo ' seled4med '; }?>>Q <?php  echo "Guatemala Quetzal";?></option>
                                                <option value="GGP" <?php  if($setting->d4m_currency =='GGP' ){ echo ' seled4med '; }?>>£ <?php  echo "Guernsey Pound";?></option>
                                                <option value="GYD" <?php  if($setting->d4m_currency =='GYD' ){ echo ' seled4med '; }?>>$ <?php  echo "Guyana Dollar";?></option>

                                                <option value="HNL" <?php  if($setting->d4m_currency =='HNL' ){ echo ' seled4med '; }?>>L <?php  echo "Honduras Lempira";?></option>
                                                <option value="HKD" <?php  if($setting->d4m_currency =='HKD' ){ echo ' seled4med '; }?>>$ <?php  echo "Hong Kong Dollar";?></option>

                                                <option value="HRK" <?php  if($setting->d4m_currency =='HRK' ){ echo ' seled4med '; }?>>kn <?php  echo "Croatian Kuna";?></option>
                                                <option value="HTG" <?php  if($setting->d4m_currency =='HTG' ){ echo ' seled4med '; }?>>G <?php  echo "Haitian Gourde";?></option>


                                                <option value="HUF" <?php  if($setting->d4m_currency =='HUF' ){ echo ' seled4med '; }?>>Ft <?php  echo "Hungary Forint";?></option>
                                                <option value="ISK" <?php  if($setting->d4m_currency =='ISK' ){ echo ' seled4med '; }?>>kr <?php  echo "Iceland Krona";?></option>
                                                <option value="INR" <?php  if($setting->d4m_currency =='INR' ){ echo ' seled4med '; }?>>Rs <?php  echo "India Rupee";?></option>
                                                <option value="IDR" <?php  if($setting->d4m_currency =='IDR' ){ echo ' seled4med '; }?>>Rp <?php  echo "Indonesia Rupiah";?></option>
                                                <option value="IRR" <?php  if($setting->d4m_currency =='IRR' ){ echo ' seled4med '; }?>>﷼ <?php  echo "Iran Rial";?></option>
                                                <option value="IMP" <?php  if($setting->d4m_currency =='IMP' ){ echo ' seled4med '; }?>>£ <?php  echo "Isle of Man Pound";?></option>
                                                <option value="ILS" <?php  if($setting->d4m_currency =='ILS' ){ echo ' seled4med '; }?>>₪ <?php  echo "Israel Shekel";?></option>
                                                <option value="JMD" <?php  if($setting->d4m_currency =='JMD' ){ echo ' seled4med '; }?>>J$ <?php  echo "Jamaica Dollar";?></option>
                                                <option value="JPY" <?php  if($setting->d4m_currency =='JPY' ){ echo ' seled4med '; }?>>¥ <?php  echo "Japan Yen";?></option>
                                                <option value="JEP" <?php  if($setting->d4m_currency =='JEP' ){ echo ' seled4med '; }?>>£ <?php  echo "Jersey Pound";?></option>
                                                <option value="KZT" <?php  if($setting->d4m_currency =='KZT' ){ echo ' seled4med '; }?>>лв <?php  echo "Kazakhstan Tenge";?></option>
                                                <option value="KPW" <?php  if($setting->d4m_currency =='KPW' ){ echo ' seled4med '; }?>>₩ <?php  echo "Korea(North) Won";?></option>
                                                <option value="KRW" <?php  if($setting->d4m_currency =='KRW' ){ echo ' seled4med '; }?>>₩ <?php  echo "Korea(South) Won";?></option>
                                                <option value="KGS" <?php  if($setting->d4m_currency =='KGS' ){ echo ' seled4med '; }?>>лв <?php  echo "Kyrgyzstan Som";?></option>

                                                <option value="KES" <?php  if($setting->d4m_currency =='KES' ){ echo ' seled4med '; }?>>KSh <?php  echo "Kenyan Shilling";?></option>


                                                <option value="LAK" <?php  if($setting->d4m_currency =='LAK' ){ echo ' seled4med '; }?>>₭ <?php  echo "Laos Kip";?></option>
                                                <option value="LVL" <?php  if($setting->d4m_currency =='LVL' ){ echo ' seled4med '; }?>>Ls <?php  echo "Latvia Lat";?></option>
                                                <option value="LBP" <?php  if($setting->d4m_currency =='LBP' ){ echo ' seled4med '; }?>>£ <?php  echo "Lebanon Pound";?></option>
                                                <option value="LRD" <?php  if($setting->d4m_currency =='LRD' ){ echo ' seled4med '; }?>>$ <?php  echo "Liberia Dollar";?></option>
                                                <option value="LTL" <?php  if($setting->d4m_currency =='LTL' ){ echo ' seled4med '; }?>>Lt <?php  echo "Lithuania Litas";?></option>
                                                <option value="MKD" <?php  if($setting->d4m_currency =='MKD' ){ echo ' seled4med '; }?>>ден <?php  echo "Macedonia Denar";?>  </option>
                                                <option value="MYR" <?php  if($setting->d4m_currency =='MYR' ){ echo ' seled4med '; }?>>RM <?php  echo "Malaysia Ringgit";?></option>
                                                <option value="MUR" <?php  if($setting->d4m_currency =='MUR' ){ echo ' seled4med '; }?>>₨ <?php  echo "Mauritius Rupee";?></option>
                                                <option value="MXN" <?php  if($setting->d4m_currency =='MXN' ){ echo ' seled4med '; }?>>$ <?php  echo "Mexico Peso";?></option>
                                                <option value="MNT" <?php  if($setting->d4m_currency =='MNT' ){ echo ' seled4med '; }?>>₮ <?php  echo "Mongolia Tughrik";?></option>
                                                <option value="MZN" <?php  if($setting->d4m_currency =='MZN' ){ echo ' seled4med '; }?>>MT <?php  echo "Mozambique Metical";?></option>

                                                <option value="MAD" <?php  if($setting->d4m_currency =='MAD' ){ echo ' seled4med '; }?>>د.م. <?php  echo "Moroccan Dirham";?></option>
                                                <option value="MDL" <?php  if($setting->d4m_currency =='MDL' ){ echo ' seled4med '; }?>>MDL <?php  echo "Moldovan Leu";?></option>
                                                <option value="MOP" <?php  if($setting->d4m_currency =='MOP' ){ echo ' seled4med '; }?>>$ <?php  echo "Macau Pataca";?></option>
                                                <option value="MRO" <?php  if($setting->d4m_currency =='MRO' ){ echo ' seled4med '; }?>>UM <?php  echo "Mauritania Ougulya";?></option>
                                                <option value="MVR" <?php  if($setting->d4m_currency =='MVR' ){ echo ' seled4med '; }?>>Rf <?php  echo "Maldives Rufiyaa";?></option>
                                                <option value="PGK" <?php  if($setting->d4m_currency =='PGK' ){ echo ' seled4med '; }?>>K <?php  echo "Papua New Guinea Kina";?></option>



                                                <option value="NAD" <?php  if($setting->d4m_currency =='NAD' ){ echo ' seled4med '; }?>>$ <?php  echo "Namibia Dollar";?></option>
                                                <option value="NPR" <?php  if($setting->d4m_currency =='NPR' ){ echo ' seled4med '; }?>>₨ <?php  echo "Nepal Rupee";?></option>
                                                <option value="ANG" <?php  if($setting->d4m_currency =='ANG' ){ echo ' seled4med '; }?>>ƒ <?php  echo "Netherlands Antilles Guilder";?></option>
                                                <option value="NZD" <?php  if($setting->d4m_currency =='NZD' ){ echo ' seled4med '; }?>>$ <?php  echo "New Zealand Dollar";?></option>
                                                <option value="NIO" <?php  if($setting->d4m_currency =='NIO' ){ echo ' seled4med '; }?>>C$ <?php  echo "Nicaragua Cordoba";?></option>
                                                <option value="NGN" <?php  if($setting->d4m_currency =='NGN' ){ echo ' seled4med '; }?>>₦ <?php  echo "Nigeria Naira";?></option>
                                                <option value="NOK" <?php  if($setting->d4m_currency =='NOK' ){ echo ' seled4med '; }?>>kr <?php  echo "Norway Krone";?></option>
                                                <option value="OMR" <?php  if($setting->d4m_currency =='OMR' ){ echo ' seled4med '; }?>>﷼ <?php  echo "Oman Rial";?></option>
                                                <option value="MWK" <?php  if($setting->d4m_currency =='MWK' ){ echo ' seled4med '; }?>>MK <?php  echo "Malawi Kwacha";?></option>



                                                <option value="PKR" <?php  if($setting->d4m_currency =='PKR' ){ echo ' seled4med '; }?>>₨ <?php  echo "Pakistan Rupee";?></option>
                                                <option value="PAB" <?php  if($setting->d4m_currency =='PAB' ){ echo ' seled4med '; }?>>B/ <?php  echo "Panama Balboa";?></option>
                                                <option value="PYG" <?php  if($setting->d4m_currency =='PYG' ){ echo ' seled4med '; }?>>Gs <?php  echo "Paraguay Guarani";?></option>
                                                <option value="PEN" <?php  if($setting->d4m_currency =='PEN' ){ echo ' seled4med '; }?>>S/ <?php  echo "Peru Nuevo Sol";?></option>
                                                <option value="PHP" <?php  if($setting->d4m_currency =='PHP' ){ echo ' seled4med '; }?>>₱ <?php  echo "Philippines Peso";?></option>
                                                <option value="PLN" <?php  if($setting->d4m_currency =='PLN' ){ echo ' seled4med '; }?>>zł <?php  echo "Poland Zloty";?></option>
                                                <option value="QAR" <?php  if($setting->d4m_currency =='QAR' ){ echo ' seled4med '; }?>>﷼ <?php  echo "Qatar Riyal";?></option>
                                                <option value="RON" <?php  if($setting->d4m_currency =='RON' ){ echo ' seled4med '; }?>>lei <?php  echo "Romania New Leu";?></option>
                                                <option value="RUB" <?php  if($setting->d4m_currency =='RUB' ){ echo ' seled4med '; }?>>руб <?php  echo "Russia Ruble";?></option>
                                                <option value="SHP" <?php  if($setting->d4m_currency =='SHP' ){ echo ' seled4med '; }?>>£ <?php  echo "Saint Helena Pound";?></option>
                                                <option value="SAR" <?php  if($setting->d4m_currency =='SAR' ){ echo ' seled4med '; }?>>﷼ <?php  echo "Saudi Arabia Riyal";?></option>
                                                <option value="RSD" <?php  if($setting->d4m_currency =='RSD' ){ echo ' seled4med '; }?>>Дин <?php  echo "Serbia Dinar";?></option>
                                                <option value="SCR" <?php  if($setting->d4m_currency =='SCR' ){ echo ' seled4med '; }?>>₨ <?php  echo "Seychelles Rupee";?></option>
                                                <option value="SGD" <?php  if($setting->d4m_currency =='SGD' ){ echo ' seled4med '; }?>>$ <?php  echo "Singapore  Dollar";?></option>
                                                <option value="SBD" <?php  if($setting->d4m_currency =='SBD' ){ echo ' seled4med '; }?>>$ <?php  echo "Solomon Islands Dollar";?></option>
                                                <option value="SOS" <?php  if($setting->d4m_currency =='SOS' ){ echo ' seled4med '; }?>>S <?php  echo "Somalia Shilling";?></option>

                                                <option value="SLL" <?php  if($setting->d4m_currency =='SLL' ){ echo ' seled4med '; }?>>Le <?php  echo "Sierra Leone Leone";?></option>
                                                <option value="STD" <?php  if($setting->d4m_currency =='STD' ){ echo ' seled4med '; }?>>Db <?php  echo "Sao Tome Dobra";?></option>
                                                <option value="SZL" <?php  if($setting->d4m_currency =='SZL' ){ echo ' seled4med '; }?>>SZL <?php  echo "Swaziland Lilageni";?></option>

                                                <option value="ZAR" <?php  if($setting->d4m_currency =='ZAR' ){ echo ' seled4med '; }?>>R <?php  echo "South Africa Rand";?></option>
                                                <option value="LKR" <?php  if($setting->d4m_currency =='LKR' ){ echo ' seled4med '; }?>>₨ <?php  echo "Sri Lanka Rupee";?></option>
                                                <option value="SEK" <?php  if($setting->d4m_currency =='SEK' ){ echo ' seled4med '; }?>>kr <?php  echo "Sweden Krona";?></option>
                                                <option value="CHF" <?php  if($setting->d4m_currency =='CHF' ){ echo ' seled4med '; }?>>CHF <?php  echo "Switzerland Franc";?> </option>
                                                <option value="SRD" <?php  if($setting->d4m_currency =='SRD' ){ echo ' seled4med '; }?>>$ <?php  echo "Suriname Dollar";?></option>
                                                <option value="SYP" <?php  if($setting->d4m_currency =='SYP' ){ echo ' seled4med '; }?>>£ <?php  echo "Syria  Pound";?></option>

                                                <option value="TWD" <?php  if($setting->d4m_currency =='TWD' ){ echo ' seled4med '; }?>>NT <?php  echo "Taiwan New Dollar";?></option>
                                                <option value="THB" <?php  if($setting->d4m_currency =='THB' ){ echo ' seled4med '; }?>>฿ <?php  echo "Thailand Baht";?></option>

                                                <option value="TOP" <?php  if($setting->d4m_currency =='TOP' ){ echo ' seled4med '; }?>>T$ <?php  echo "Tonga Pa'ang";?></option>
                                                <option value="TZS" <?php  if($setting->d4m_currency =='TZS' ){ echo ' seled4med '; }?>>x <?php  echo "Tanzanian Shilling";?></option>


                                                <option value="TTD" <?php  if($setting->d4m_currency =='TTD' ){ echo ' seled4med '; }?>>TTD <?php  echo "Trinidad and Tobago Dollar";?></option>
                                                <option value="TRY" <?php  if($setting->d4m_currency =='TRY' ){ echo ' seled4med '; }?>>₤ <?php  echo "Turkey Lira";?></option>
                                                <option value="TVD" <?php  if($setting->d4m_currency =='TVD' ){ echo ' seled4med '; }?>>$ <?php  echo "Tuvalu Dollar";?></option>
                                                <option value="UAH" <?php  if($setting->d4m_currency =='UAH' ){ echo ' seled4med '; }?>>₴ <?php  echo "Ukraine Hryvna";?></option>

                                                <option value="UGX" <?php  if($setting->d4m_currency =='UGX' ){ echo ' seled4med '; }?>>USh <?php  echo "Ugandan Shilling";?></option>

                                                <option value="GBP" <?php  if($setting->d4m_currency =='GBP' ){ echo ' seled4med '; }?>>£ <?php  echo "United Kingdom Pound";?></option>
                                                <option value="USD" <?php  if($setting->d4m_currency =='USD' ){ echo ' seled4med '; }?>>$ <?php  echo "United States  Dollar";?></option>
                                                <option value="UYU" <?php  if($setting->d4m_currency =='UYU' ){ echo ' seled4med '; }?>>$U <?php  echo "Uruguay Peso";?></option>
                                                <option value="UZS" <?php  if($setting->d4m_currency =='UZS' ){ echo ' seled4med '; }?>>лв <?php  echo "Uzbekistan Som";?></option>
                                                <option value="VEF" <?php  if($setting->d4m_currency =='VEF' ){ echo ' seled4med '; }?>>Bs <?php  echo "Venezuela Bolivar Fuerte";?></option>
                                                <option value="VND" <?php  if($setting->d4m_currency =='VND' ){ echo ' seled4med '; }?>>₫ <?php  echo "Viet Nam Dong";?></option>

                                                <option value="VUV" <?php  if($setting->d4m_currency =='VUV' ){ echo ' seled4med '; }?>>Vt <?php  echo "Vanuatu Vatu";?></option>

                                                <option value="XAF" <?php  if($setting->d4m_currency =='XAF' ){ echo ' seled4med '; }?>>BEAC <?php  echo "CFA Franc (BEAC)";?></option>
                                                <option value="XOF" <?php  if($setting->d4m_currency =='XOF' ){ echo ' seled4med '; }?>>BCEAO <?php  echo "CFA Franc (BCEAO)";?></option>
                                                <option value="XPF" <?php  if($setting->d4m_currency =='XPF' ){ echo ' seled4med '; }?>>F <?php  echo "Pacific Franc";?></option>

                                                <option value="YER" <?php  if($setting->d4m_currency =='YER' ){ echo ' seled4med '; }?>>﷼ <?php  echo "Yemen  Rial";?></option>

                                                <option value="WST" <?php  if($setting->d4m_currency =='WST' ){ echo ' seled4med '; }?>>WS$ <?php  echo "Samoa Tala";?></option>


                                                <option value="ZAR" <?php  if($setting->d4m_currency =='ZAR' ){ echo ' seled4med '; }?>>R <?php  echo "South African Rand";?></option>
                                                <option value="ZWD" <?php  if($setting->d4m_currency =='ZWD' ){ echo ' seled4med '; }?>>Z$ <?php  echo "Zimbabwe Dollar";?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['price_format_decimal_places'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m class="seled4mpicker" id="d4m_price_format_decimal_places" name="d4m_price_format_decimal_places" data-size="10"  style="display: none;">
                                                <option value="0" <?php  if($setting->d4m_price_format_decimal_places=='0'){echo 'seled4med';} ?>>0 (e.g.$100)</option>
                                                <option value="1" <?php  if($setting->d4m_price_format_decimal_places=='1'){echo 'seled4med';} ?>>1 (e.g.$100.0)</option>
                                                <option value="2" <?php  if($setting->d4m_price_format_decimal_places=='2'){echo 'seled4med';} ?>>2 (e.g.$100.00)</option>
                                                <option value="3" <?php  if($setting->d4m_price_format_decimal_places=='3'){echo 'seled4med';} ?>>3 (e.g.$100.000)</option>
                                                <option value="4" <?php  if($setting->d4m_price_format_decimal_places=='4'){echo 'seled4med';} ?>>4 (e.g.$100.0000)</option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['currency_symbol_position'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_currency_symbol_position" id="d4m_currency_symbol_position" class="seled4mpicker" style="display: none;">
                                                <option value="$100" <?php  if($setting->d4m_currency_symbol_position=='$100'){echo 'seled4med';} ?>><?php echo $label_language_values['before_e_g_100'];?></option>
                                                <option value="100$" <?php  if($setting->d4m_currency_symbol_position=='100$'){echo 'seled4med';} ?>><?php echo $label_language_values['after_e_g_100'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                  <td><label>Service design</label></td>
                                  <td>
                                    <div class="form-group">
                                      <seled4m name="d4m_service_design" id="d4m_service_design" class="seled4mpicker" style="display: none;">
                                        <option value="d4m_square" <?php  if($setting->d4m_service_design=='d4m_square'){echo 'seled4med';} ?>> <?php echo "Square"; ?></option>
                                        <option value="d4m_circle" <?php  if($setting->d4m_service_design=='d4m_circle'){echo 'seled4med';} ?>><?php  echo "Circle"; ?></option>
                                      </seled4m>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                    <td><label><?php echo $label_language_values['tax_vat'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-tax-vat" for="tax-vat">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_tax_vat_status=='Y'){echo 'checked';}?> id="tax-vat" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                            <div class="hide-div mycollapse_tax-vat" <?php  if($setting->d4m_tax_vat_status=='Y'){echo 'style="display:block;"';}?>>
                                                <div class="d4m-custom-radio">
                                                    <ul class="d4m-radio-list">
                                                        <li>
                                                            <input type="radio" id="tax-vat-percentage" class="d4ma-radio tax_vat_radio" name="tax-vat-radio" <?php  if($setting->d4m_tax_vat_type=='P'){echo 'checked';}?> value="P" />
                                                            <label for="tax-vat-percentage"><span></span> <?php  echo $label_language_values['percentage'];?> </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="tax-vat-flatfree" class="d4m_radio tax_vat_radio" name="tax-vat-radio" <?php  if($setting->d4m_tax_vat_type=='F'){ echo 'checked';}?> value="F" />
                                                            <label for="tax-vat-flatfree"><span></span><?php echo $label_language_values['flat_fee'];?></label>
                                                        </li>
                                                        <li class="d4m-tax-vat-input-container">
                                                            <input type="text" class="form-control" name="d4m_tax_vat_value" id="d4m_tax_vat_value" value="<?php echo ($setting->d4m_tax_vat_value); ?>" size="3" maxlength="5" />
                                                            <i class="d4m-tax-percent <?php  if($setting->d4m_tax_vat_type=='P'){echo 'fa fa-percent';}?>"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['partial_deposit'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-patial-deposit" for="patial-deposit">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_partial_deposit_status=='Y'){echo 'checked';}?> id="patial-deposit" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                            <a class="d4m-tooltip-link pr-t0" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['partial_payment_option_will_help_you_to_charge_partial_payment_of_total_amount_from_client_and_remaining_you_can_colled4m_locally'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php  if($setting->d4m_partial_deposit_status=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_patial-deposit">
                                                <div class="d4m-custom-radio">
                                                    <ul class="d4m-radio-list">
                                                        <li class="d4m-partial-li-width">
                                                            <input type="radio" id="partial-percentage" class="d4ma-radio partial_radio" checked="checked"  name="partial-radio" <?php  if($setting->d4m_partial_type=='P'){echo 'checked';}?> value="P" />
                                                            <label for="partial-percentage"><span></span> <?php  echo $label_language_values['percentage'];?> </label>
                                                        </li>
                                                        <li class="d4m-partial-li-width">
                                                            <input type="radio" id="partial-flatfree" class="d4m_radio partial_radio" name="partial-radio" <?php  if($setting->d4m_partial_type=='F'){ echo 'checked';}?> value="F" />
                                                            <label for="partial-flatfree"><span></span><?php echo $label_language_values['flat_fee'];?></label>
                                                        </li>
                                                        <li class="d4m-tax-vat-input-container">
                              <span class="d4m-tax-vat-input-container">
                                <label class="pull-left mr-10"><?php echo $label_language_values['partial_deposit_amount'];?></label>
                                <span class="d4m-partial-input-per"><input type="text" class="form-control" id="d4m_partial_deposit_amount" name="d4ma-partial-deposit" value="<?php echo ($setting->d4m_partial_deposit_amount)?>" size="3" maxlength="3" /> <i class="d4m-partial-deposit-percent <?php  if($setting->d4m_partial_type=='P'){echo 'fa fa-percent';}?>"></i></span>
                              </span><br/>
                                                        </li>
                                                        <li>
                                                            <label><?php echo $label_language_values['partial_deposit_message'];?></label>

                                                            <textarea class="form-control" id="d4m_partial_deposit_message" row="4" cols="40"><?php echo ($setting->d4m_partial_deposit_message)?></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <span id="d4m-partial-depost_error" style="color:red;"><?php echo $label_language_values['please_enable_payment_gateway'];?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>'<?php echo $label_language_values['thankyou_page_url'];?>'</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="d4m_thankyou_page_url" class="form-control" size="50" name="d4m_thankyou_page_url" value="<?php echo ($setting->d4m_thankyou_page_url)?>" placeholder="<?php echo $label_language_values['custom_thankyou_page_url'];?>" /><br />
                                            <i><?php echo $label_language_values['default_url_is'];?> : <?php  if($setting->d4m_thankyou_page_url == ''){ echo SITE_URL.'front/thankyou.php'; }else{ echo ($setting->d4m_thankyou_page_url); } ?></i>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                               <!-- <tr><td><hr /></td><td><hr /></td></tr> -->
                                <tr>
                                    <td><label><?php echo $label_language_values['cancellation_policy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-cancel-policy" for="cancel-policy">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="d4m_cancelation_policy_status" <?php  if ($setting->d4m_cancelation_policy_status == 'Y') { echo 'checked'; } ?> id="cancel-policy" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                        </label>

                                            <div <?php  if ($setting->d4m_cancelation_policy_status == 'Y') {
                                                echo 'style="display:block;"';
                                            } ?> class="hide-div mycollapse_cancel-policy">
                                                <div class="d4m-custom-radio">
                                                    <ul class="d4m-radio-list np mb-15">
                                                        <li class="w100">
                                                            <label><?php echo $label_language_values['cancellation_policy_header'];?></label>
                                                            <input type="text" class="w100 form-control" id="d4m_cancel_policy_header" name="d4m_cancel_policy_header" value="<?php echo($setting->d4m_cancel_policy_header) ?>"/>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <label><?php echo $label_language_values['cancellation_policy_textarea'];?></label>
                                               <textarea class="form-control w100" id="d4m_cancel_policy_textarea" name="d4m_cancel_policy_textarea" row="4" cols="40"><?php echo($setting->d4m_cancel_policy_textarea) ?></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr><td><hr /></td><td><hr /></td> -->

                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['allow_multiple_booking_for_same_timeslot'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-multiple-booking-same-time" for="multiple-booking-same-time">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="d4m_allow_multiple_booking_for_same_timeslot_status" <?php  if($setting->d4m_allow_multiple_booking_for_same_timeslot_status=='Y'){ echo 'checked';} ?> id="multiple-booking-same-time" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                       </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['allow_multiple_appointment_booking_at_same_time_slot_will_allow_you_to_show_availability_time_slot_even_you_have_booking_already_for_that_time'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['appointment_auto_confirm'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-appointment-auto-confirm" for="appointment-auto-confirm">
                        <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_appointment_auto_confirm_status" <?php  if($setting->d4m_appointment_auto_confirm_status=='Y'){echo 'checked';}?> id="appointment-auto-confirm" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['with_Enable_of_this_feature_Appointment_request_from_clients_will_be_auto_confirmed'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['show_frontend_staff_rating'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-star_show_on_front" for="star_show_on_front">
                        <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_star_show_on_front" <?php  if($setting->d4m_star_show_on_front=='Y'){echo 'checked';}?> id="star_show_on_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['with_enable_of_this_feature_shows_staff_rating_on_front_side'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['terms_and_condition'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-allow-dc-terms-condition" for="allow-dc-terms-condition">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="d4m_allow_terms_and_conditions" <?php  if($setting->d4m_allow_terms_and_conditions=='Y'){echo 'checked';}?> id="allow-dc-terms-condition" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                       </label>
                      <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['terms_and_condition'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php  if($setting->d4m_allow_terms_and_conditions=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_allow-dc-terms-condition">
                                                <div class="d4m-custom-radio">
                                                    <ul class="d4m-radio-list">
                                                        <li>
                                                            <label><?php echo $label_language_values['terms_and_condition_link'];?></label>
                                                            <input type="text" class="form-control" size="50" id="d4m_terms_condition_header" name="d4m_terms_condition_header" value="<?php echo ($setting->d4m_terms_condition_link);?>"></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['privacy_policy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-allow-dc-privacy_policy" for="allow-dc-privacy_policy">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="allow-dc-privacy_policy" <?php  if($setting->d4m_allow_privacy_policy=='Y'){echo 'checked';}?> id="allow-dc-privacy_policy" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                      <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['privacy_policy'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php  if($setting->d4m_allow_privacy_policy=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_allow-dc-privacy_policy">
                                                <div class="d4m-custom-radio">
                                                    <ul class="d4m-radio-list">
                                                        <li class="d4m-privacy-policy-li-width">
                                                            <label><?php echo $label_language_values['privacy_policy'];?></label>
                                                            <input type="text" class="form-control" size="50" id="d4m_privacy_policy_link" name="d4m_privacy_policy_link" value="<?php echo ($setting->d4m_privacy_policy_link);?>"></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_methods_with_multiple_units'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_method_default_design" id="d4m_method_default_design" class="seled4mpicker" style="display: none;">
                                                <option value="2" <?php  if($setting->d4m_method_default_design=='2'){echo 'seled4med';} ?>><?php echo $label_language_values['dropdown_design'];?></option>
                                                <option value="3" <?php  if($setting->d4m_method_default_design=='3'){echo 'seled4med';} ?>><?php echo $label_language_values['blocks_as_button_design'];?></option>
                                                <option value="4" <?php  if($setting->d4m_method_default_design=='4'){echo 'seled4med';} ?>><?php echo $label_language_values['qty_control_design'];?></option>
                                            </seled4m>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_addons'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_addons_default_design" id="d4m_addons_default_design" class="seled4mpicker" style="display: none;">
                                                <option value="1" <?php  if($setting->d4m_addons_default_design=='1'){echo 'seled4med';} ?>><?php echo $label_language_values['qty_control_design'];?></option>
                                                <option value="2" <?php  if($setting->d4m_addons_default_design=='2'){echo 'seled4med';} ?>><?php echo $label_language_values['blocks_as_button_design'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_services'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_service_default_design" id="d4m_service_default_design" class="seled4mpicker" style="display: none;">
                                                <option value="1" <?php  if($setting->d4m_service_default_design=='1'){echo 'seled4med';} ?>><?php echo $label_language_values['big_images_radio'];?></option>
                                                <option value="2" <?php  if($setting->d4m_service_default_design=='2'){echo 'seled4med';} ?>><?php echo $label_language_values['dropdown_design'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
               
																
																 <tr>
                                    <td><label><?php echo $label_language_values['change_calculation_policyy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_service_default_design" id="d4m_price_calculation_method" class="seled4mpicker" style="display: none;">
                                                <option value="M" <?php  if($setting->get_option("d4m_calculation_policy")=='M'){echo 'seled4med';} ?>><?php echo $label_language_values['multiply'];?></option>
                                                <option value="E" <?php  if($setting->get_option("d4m_calculation_policy")=='E'){echo 'seled4med';} ?>><?php echo $label_language_values['equal'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
																
 <tr>
		<td><label><?php echo $label_language_values['front_booking_design'];?></label></td>
		<td>
				<div class="form-group">
						<seled4m name="d4m_service_default_design" id="d4m_booking_page_design" class="seled4mpicker" style="display: none;">
								<option value="S" <?php  if($setting->get_option("d4m_booking_page_design")=='S'){echo 'seled4med';} ?>><?php echo $label_language_values['single_step_booking_design'];?></option>
								<option value="M" <?php  if($setting->get_option("d4m_booking_page_design")=='M'){echo 'seled4med';} ?>><?php echo $label_language_values['multi_step_booking_design'];?></option>
						</seled4m>
				</div>
		</td>
</tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['right_side_description'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-d4m_allow_front_desc" for="d4m_allow_front_desc">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="d4m_allow_front_desc" <?php  if($setting->d4m_allow_front_desc=='Y'){echo 'checked';}?> id="d4m_allow_front_desc" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                      <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['write_html_code_for_the_right_side_panel'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                           
                                        </div>
                                        <div <?php  if($setting->d4m_allow_front_desc=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_d4m_allow_front_desc">
                                            <textarea class="form-control" id="d4m_front_desc" row="12" cols="80"><?php echo ($setting->get_option('d4m_front_desc'));?></textarea>
                                        </div>
                                    </td>
                                </tr>

                                <?php  /*<tr>
                                    <td><label><?php echo $label_language_values['display_sub_headers_below_headers'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-d4m_subheaders" for="d4m_subheaders">
                        <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_subheaders" <?php  if($setting->d4m_subheaders=='Y'){echo 'checked';}?> id="d4m_subheaders" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['do_you_want_to_show_subheaders_below_the_headers'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['vaccum_cleaner_frontend_option_display_status'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-d4m_vc_status" for="d4m_vc_status">
                        <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_vc_status" <?php  if($setting->d4m_vc_status=='Y'){echo 'checked';}?> id="d4m_vc_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['parking_availability_frontend_option_display_status'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-d4m_p_status" for="d4m_p_status">
                        <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_p_status" <?php  if($setting->d4m_p_status=='Y'){echo 'checked';}?> id="d4m_p_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                    </td>
                                </tr>
                */ ?>
                <?php  /*
                <tr>
                                    <td><label><?php echo $label_language_values['user_zip_code'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="d4moggle-d4m_user_zip_code" for="d4m_user_zip_code">
                        <input data-toggle="toggle" data-width="73" data-size="small" type='checkbox' name="d4m_user_zip_code" <?php  if($setting->d4m_user_zip_code=='Y'){echo 'checked';}?> id="d4m_user_zip_code" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      </label>
                                        </div>
                                    </td>
                                </tr>
                <?php  */?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a id="general_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade in" id="appearance-setting">
        <form id="loginpageimage" method="post" end4mype="multipart/form-data" class="d4m-appearance-settings">
                
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['appearance_settings'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"><button id="appearance_settings" type="submit" name="appreance" class="btn btn-success appearance_settings_btn_check"><?php echo $label_language_values['save_setting'];?></button></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                <table class="form-inline d4m-common-table" >
                
                                <tbody>
                <tr>
                                    <td><label><?php echo $label_language_values['color_scheme'];?></label></td>
                                    <td>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15 npl">
                                            <label><?php echo $label_language_values['primary_color'];?></label>
                                            <input type="text" name="d4m_primary_color" id="d4m-primary-color" class="form-control demo primary_color" data-control="saturation" value="<?php echo ($setting->d4m_primary_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['secondary_color'];?></label>
                                            <input type="text" name="d4m_secondary_color" id="d4m-secondary-color" class="form-control demo secondary_color" data-control="saturation" value="<?php echo ($setting->d4m_secondary_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color'];?></label>
                                            <input type="text" name="d4m_text_color" id="d4m-text-color" class="form-control demo text_color" data-control="saturation" value="<?php echo ($setting->d4m_text_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color_on_bg'];?></label>
                                            <input type="text" name="d4m_text_color_on_bg" id="d4m-text-color-bg" class="form-control demo text_color_bg" data-control="saturation" value="<?php echo ($setting->d4m_text_color_on_bg)?>" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php  echo $label_language_values['admin_area_color_scheme'];?></label></td>
                                    <td>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 npl mb-15">
                                            <label><?php echo $label_language_values['primary_color'];?></label>
                                            <input type="text" name="d4m_primary_color_admin" id="d4m-primary-color-admin" class="form-control demo d4m_primary_color_admin" data-control="saturation" value="<?php echo ($setting->d4m_primary_color_admin)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['secondary_color'];?></label>
                                            <input type="text" name="d4m_secondary_color_admin" id="d4m-secondary-color-admin" class="form-control demo secondary_color_admin" data-control="saturation" value="<?php echo ($setting->d4m_secondary_color_admin)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color'];?></label>
                                            <input type="text" name="d4m_text_color_admin" id="d4m-text-color-admin" class="form-control demo text_color_admin" data-control="saturation" value="<?php echo ($setting->d4m_text_color_admin)?>" />
                                        </div>
                                        <!-- <div class="col-lg-12 col-md-12 col-xs-12 mb-15">   
                                                    <input type="text" name="d4m_admin_area_color_scheme" id="d4m-primary-color" class="form-control demo admin_area_color" data-control="saturation" value="<?php /* echo ($setting->d4m_admin_area_color_scheme) */ ?>" />
                                                </div>  -->
                        <div class="col-lg-3 col-md-3 col-sm-6 mb-15"> 
                        </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 mb-15">
                      <p class="btn" style="color:#31b0d5;" name="reset_color" id="reset_color"><?php echo $label_language_values['Reset_Color'];?></p>
                     </div>
                                    </td>
                                </tr>
                                <!--<tr>
                                <td><label>Front background image</label></td>
                                <td>
                                <div class="form-group">
                                </div>
                                <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="It will manage Front background image."><i class="fa fa-info-circle fa-lg"></i></a>
                                </td>
                                </tr>
                <tr>
                                <td><label>Login background image</label></td>
                                <td>
                                <div class="form-group">
                
                                </div>
                                <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="It will manage login background image."><i class="fa fa-info-circle fa-lg"></i></a>
                                </td>
                                </tr>-->
                                <?php  /*<tr>
                                    <td><label><?php echo $label_language_values['show_coupons_input_on_checkout'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="show-coupons-input-oc">
                        <input data-toggle="toggle" data-size="small" name="coupon_checkout" type='checkbox' <?php  if($setting->d4m_show_coupons_input_on_checkout=='on'){echo 'checked';}?> name="d4m_show_service_description" id="show-coupons-input-oc" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_show_hide_coupon_input_on_checkout_form'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr> */?>
                                <tr>
                                    <td><label><?php echo $label_language_values['hide_faded_already_booked_time_slots'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="hide-booked-slot">
                        <input data-toggle="toggle" data-size="small" name="fadded_slots" type='checkbox' <?php  if($setting->d4m_hide_faded_already_booked_time_slots=='on'){echo 'checked';}?> id="hide-booked-slot" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="With this you can hide the already booked slots just to hide your bookings from your Competitors."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['guest_user_checkout'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="guest-user-checkout">
                        <input data-toggle="toggle" name="guc_check" data-size="small" type='checkbox' <?php  if($setting->d4m_guest_user_checkout=='on'){echo 'checked';}?> name="" id="guest-user-checkout" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['with_this_feature_you_can_allow_a_visitor_to_book_appointment_without_registration'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['existing_and_new_user_checkout'];?> </label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="existing-and-new-user-checkout">
                        <input data-toggle="toggle" name="eu_nu_check" data-size="small" type='checkbox' <?php  if($setting->d4m_existing_and_new_user_checkout=='on'){echo 'checked';}?> id="existing-and-new-user-checkout" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                        <a class="d4m-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['it_will_allow_option_for_user_to_get_booking_with_new_user_or_existing_user'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['time_format'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m class="seled4mpicker" id="d4m_time_format" data-size="5" name="d4m_time_format" style="display: none;width:auto">
                                                <option value="12" <?php  if($setting->d4m_time_format=='12'){echo 'seled4med';} ?>>12 <?php  echo $label_language_values['hours'];?></option>
                                                <option value="24" <?php  if($setting->d4m_time_format=='24'){echo 'seled4med';} ?>>24 <?php  echo $label_language_values['hours'];?></option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['scrollable_cart'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="d4m_cart_scrollable">
                        <input data-toggle="toggle" name="d4m_cart_scrollable" data-size="small" type='checkbox' <?php  if($setting->d4m_cart_scrollable=='Y'){echo 'checked';}?> id="d4m_cart_scrollable" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['display_time_duration_on_summary'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="d4m_show_time_duration">
                        <input data-toggle="toggle" name="d4m_show_time_duration" data-size="small" type='checkbox' <?php  if($setting->d4m_show_time_duration=='Y'){echo 'checked';}?> id="d4m_show_time_duration" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                      </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['date_picker_date_format'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <seled4m name="d4m_date_picker_date_format" id="date_format_datepicker" class="seled4mpicker form-control" data-size="5" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-ad4mions-box="true" >
                                                <option value="d-m-Y" <?php  if($setting->d4m_date_picker_date_format=='d-m-Y'){echo 'seled4med';} ?>>dd-mm-yyyy (eg. <?php  echo date('d-m-Y');?>)</option>
                                                <option value="j-m-Y" <?php  if($setting->d4m_date_picker_date_format=='j-m-Y'){echo 'seled4med';} ?>>d-mm-yyyy (eg. <?php  echo date('j-n-Y');?>)</option>
                                                <option value="d-M-Y" <?php  if($setting->d4m_date_picker_date_format=='d-M-Y'){echo 'seled4med';} ?>>dd-m-yyyy (eg. <?php  echo date('d-M-Y');?>)</option>
                                                <option value="d-F-Y" <?php  if($setting->d4m_date_picker_date_format=='d-F-Y'){echo 'seled4med';} ?>>dd-m-yyyy (eg. <?php  echo date('d-F-Y');?>)</option>
                                                <option value="j-M-Y" <?php  if($setting->d4m_date_picker_date_format=='j-M-Y'){echo 'seled4med';} ?>>d-m-yyyy (eg. <?php  echo date('j-M-Y');?>)</option>
                                                <option value="j-F-Y" <?php  if($setting->d4m_date_picker_date_format=='j-F-Y'){echo 'seled4med';} ?>>dd-m-yyyy (eg. <?php  echo date('j-F-Y');?>)</option>

                                                <!-- With Slashes -->
                                                <option value="d/m/Y" <?php  if($setting->d4m_date_picker_date_format=='d/m/Y'){echo 'seled4med';} ?>>dd/mm/yyyy (eg. <?php  echo date('d/m/Y');?>)</option>
                                                <option value="j/m/Y" <?php  if($setting->d4m_date_picker_date_format=='j/m/Y'){echo 'seled4med';} ?>>d/mm/yyyy (eg. <?php  echo date('j/m/Y');?>)</option>
                                                <option value="d/M/Y" <?php  if($setting->d4m_date_picker_date_format=='d/M/Y'){echo 'seled4med';} ?>>dd/m/yyyy (eg. <?php  echo date('d/M/Y');?>)</option>
                                                <option value="d/F/Y" <?php  if($setting->d4m_date_picker_date_format=='d/F/Y'){echo 'seled4med';} ?>>dd/M/yyyy (eg. <?php  echo date('d/F/Y');?>)</option>
                                                <option value="j/M/Y" <?php  if($setting->d4m_date_picker_date_format=='j/M/Y'){echo 'seled4med';} ?>>d/m/yyyy (eg. <?php  echo date('j/M/Y');?>)</option>
                                                <option value="j/F/Y" <?php  if($setting->d4m_date_picker_date_format=='j/F/Y'){echo 'seled4med';} ?>>d/M/yyyy (eg. <?php  echo date('j/F/Y');?>)</option>

                                                <!-- Month Day Year Suffled -->
                                                <option value="m-d-Y"  <?php  if($setting->d4m_date_picker_date_format=='m-d-Y'){echo 'seled4med';} ?> >mm-dd-yyyy (eg. <?php  echo date('m-d-Y');?>)</option>
                                                <option value="m-j-Y" <?php  if($setting->d4m_date_picker_date_format=='m-j-Y'){echo 'seled4med';} ?> >mm-d-yyyy (eg. <?php  echo date('m-j-Y');?>)</option>
                                                <option value="M-d-Y" <?php  if($setting->d4m_date_picker_date_format=='M-d-Y'){echo 'seled4med';} ?>>m-dd-yyyy (eg. <?php  echo date('M-d-Y');?>)</option>
                                                <option value="F-d-Y" <?php  if($setting->d4m_date_picker_date_format=='F-d-Y'){echo 'seled4med';} ?>>m-dd-yyyy (eg. <?php  echo date('F-d-Y');?>)</option>
                                                <option value="M-j-Y" <?php  if($setting->d4m_date_picker_date_format=='M-j-Y'){echo 'seled4med';} ?>>m-d-yyyy (eg. <?php  echo date('M-j-Y');?>)</option>
                                                <option value="F-j-Y" <?php  if($setting->d4m_date_picker_date_format=='F-j-Y'){echo 'seled4med';} ?>>m-dd-yyyy (eg. <?php  echo date('F-j-Y');?>)</option>
                                                <!-- With Slashes -->
                                                <option value="m/d/Y" <?php  if($setting->d4m_date_picker_date_format=='m/d/Y'){echo 'seled4med';} ?>>mm/dd/yyyy (eg. <?php  echo date('m/d/Y');?>)</option>
                                                <option value="m/j/Y" <?php  if($setting->d4m_date_picker_date_format=='m/j/Y'){echo 'seled4med';} ?>>mm/d/yyyy (eg. <?php  echo date('m/j/Y');?>)</option>
                                                <option value="M/d/Y" <?php  if($setting->d4m_date_picker_date_format=='M/d/Y'){echo 'seled4med';} ?>>m/dd/yyyy (eg. <?php  echo date('M/d/Y');?>)</option>
                                                <option value="F/d/Y" <?php  if($setting->d4m_date_picker_date_format=='F/d/Y'){echo 'seled4med';} ?>>m/dd/yyyy (eg. <?php  echo date('F/d/Y');?>)</option>
                                                <option value="M/j/Y" <?php  if($setting->d4m_date_picker_date_format=='M/j/Y'){echo 'seled4med';} ?>>m/d/yyyy (eg. <?php  echo date('M/j/Y');?>)</option>
                                                <option value="F/j/Y" <?php  if($setting->d4m_date_picker_date_format=='F/j/Y'){echo 'seled4med';} ?>>m/dd/yyyy (eg. <?php  echo date('F/j/Y');?>)</option>

                                                <option value="j M,Y" <?php  if($setting->d4m_date_picker_date_format=='j M,Y'){echo 'seled4med';} ?>>dd m,yyyy (eg. <?php  echo date('j M,Y');?>)</option>
                                                <option value="M j, Y" <?php  if($setting->d4m_date_picker_date_format=='M j, Y'){echo 'seled4med';} ?>>m dd,yyyy (eg. <?php  echo date('M j, Y');?>)</option>
                                            </seled4m>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                 <td><?php echo $label_language_values['default_country_code'];?></td>
                 <?php   
            $arrs = explode(",",$setting->get_option("d4m_phone_display_country_code"));
            $country_code_alpha_array = array
  (
  array("af","Afghanistan (&#8235;افغانستان&#8236;&lrm;)","+93"),array("al","Albania (Shqipëri)","+355  "),array("dz","Algeria (&#8235;الجزائر&#8236;&lrm;)","+213"),array("as","American Samoa","+1684 "),array("ad","Andorra","+376"),array("ao","Angola","+244"),array("ai","Anguilla","+1264"),array("ag","Antigua and Barbuda","+1268"),array("ar","Argentina","+54"),array("am","Armenia (Հայաստան)","+374"), array("aw","Aruba","+297"), array("au","Australia","+61"),array("at","Austria (Österreich)","+43"),array("az","Azerbaijan (Azərbaycan)","+994"),array("bs","Bahamas","+1242"),array("bh","Bahrain (&#8235;البحرين&#8236;&lrm;)","+973"),array("d4m","Bangladesh (বাংলাদেশ)","+880"),array("bb","Barbados","+1246"), array("by","Belarus (Беларусь)","+375"),array("be","Belgium (België)","+32"),array("bz","Belize","+501"),array("bj","Benin (Bénin)","+229"),array("bm","Bermuda","+1441"),array("bt","Bhutan (འབྲུག)  ","+975"),array("bo","Bolivia","+591"),array("ba","Bosnia and Herzegovina (Босна и Херцеговина)","+387"),array("bw","Botswana","+267"),array("br","Brazil (Brasil)","+55"),array("io","British Indian Ocean Territory","+246"),array("vg","British Virgin Islands","+1284"),array("bn","Brunei","+673"),array("bg","Bulgaria (България)","+359"),array("bf","Burkina Faso","+226"),array("bi","Burundi (Uburundi)","+257"),array("kh","Cambodia (កម្ពុជា)","+855 "), array("cm","Cameroon (Cameroun)","+237"),array("ca","Canada","+1"),array("cv","Cape Verde (Kabu Verdi)","+238 "),array("bq","Caribbean Netherlands","+599 "), array("ky","Cayman Islands","+1345"), array("cf","Central African Republic (République centrafricaine)","+236"),array("td","Chad (Tchad)","+23"),array("cl","Chile","+56"),array("cn","China (中国)","+86"),array("cx","Christmas Island","+61"),array("cc","Cocos (Keeling) Islands","+61"),array("co","Colombia","+57"),array("km","Comoros (&#8235;جزر القمر&#8236;&lrm;)","+269"),array("cd","Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)","+243"),array("cg","Congo (Republic) (Congo-Brazzaville)","+242"),array("ck","Cook Islands","+682"),array("cr","Costa Rica","+506"),array("ci","Côte d’Ivoire","+225"),array("hr","Croatia (Hrvatska)","+385"),array("cu","Cuba","+53"),array("cw","Curaçao","+599"),array("cy","Cyprus (Κύπρος)","+357"),array("cz","Czech Republic (Česká republika)","+420"),array("dk","Denmark (Danmark)","+45"),array("dj","Djibouti","+253"),array("dm","Dominica","+1767"),array("do","Dominican Republic (República Dominicana)","+1"),array("ec","Ecuador","+593"),array("eg","Egypt (&#8235;مصر&#8236;&lrm;)","+20 "),array("sv","El Salvador","+503"),array("gq","Equatorial Guinea (Guinea Ecuatorial)","+240"),array("er","Eritrea","+291"),array("ee","Estonia (Eesti)","+372"),array("et","Ethiopia","+251"),array("fk","Falkland Islands (Islas Malvinas)","+500"),array("fo","Faroe Islands (Føroyar)","+298"),array("fj","Fiji","+679"),array("fi","Finland (Suomi)","+358"),array("fr","France","+33"),array("gf","French Guiana (Guyane française)","+594"),array("pf","French Polynesia (Polynésie française)","+689"),array("ga","Gabon","+241"), array("gm","Gambia","+220"),array("ge","Georgia (საქართველო)","+995"),array("de","Germany (Deutschland)","+49"),array("gh","Ghana (Gaana)","+233"),array("gi","Gibraltar","+350"),array("gr","Greece (Ελλάδα)","+30"),array("gl","Greenland (Kalaallit Nunaat)","+299"),array("gd","Grenada","+1473"), array("gp","Guadeloupe","+590"),array("gu","Guam","+1671"),array("gt","Guatemala","+502"),array("gg","Guernsey","+44"),array("gn","Guinea (Guinée)","+224"),array("gw","Guinea-Bissau (Guiné Bissau)","+245"),array("gy","Guyana","+592"),array("ht","Haiti","+509"),array("hn","Honduras","+504"),array("hk","Hong Kong (香港)","+852"),array("hu","Hungary (Magyarország)","+36"),array("is","Iceland (Ísland)","+354"),array("in","India (भारत)","+91"),array("id","Indonesia","+62"),array("ir","Iran (&#8235;ایران&#8236;&lrm;)","+98"),array("iq","Iraq (&#8235;العراق&#8236;&lrm;)","+964"),array("ie","Ireland","+353"),array("im","Isle of Man","+44"),array("il","Israel (&#8235;ישראל&#8236;&lrm;)","+972"),array("it","Italy (Italia)","+39"),array("jm","Jamaica","+1876"),array("jp","Japan (日本)","+81"),array("je","Jersey","+44"),array("jo","Jordan (&#8235;الأردن&#8236;&lrm;)","+962"),array("kz","Kazakhstan (Казахстан)","+7"),array("ke","Kenya","+254"),array("ki","Kiribati","+686"),array("kw","Kuwait (&#8235;الكويت&#8236;&lrm;)","+965"),array("kg","Kyrgyzstan (Кыргызстан)","+996"),array("la","Laos (ລາວ)","+856"),array("lv","Latvia (Latvija)","+371"),array("lb","Lebanon (&#8235;لبنان&#8236;&lrm;)","+961"),array("ls","Lesotho","+266"),array("lr","Liberia","+231"),array("ly","Libya (&#8235;ليبيا&#8236;&lrm;)","+218"),array("li","Liechtenstein","+423"),array("lt","Lithuania (Lietuva)","+370"),array("lu","Luxembourg","+352"),array("mo","Macau (澳門)","+853"),array("mk","Macedonia (FYROM) (Македонија)","+389"),array("mg","Madagascar (Madagasikara)","+261"),array("mw","Malawi","+265"),array("my","Malaysia","+60"),array("mv","Maldives","+960"),array("ml","Mali","+223"), array("mt","Malta","+356"),array("mh","Marshall Islands","+692"),array("mq","Martinique","+596"),array("mr","Mauritania (&#8235;موريتانيا&#8236;&lrm;)","+222"),array("mu","Mauritius (Moris)","+230"),array("yt","Mayotte","+262"),array("mx","Mexico (México)","+52"),array("fm","Micronesia","+691"),array("md","Moldova (Republica Moldova)","+373"),array("mc","Monaco","+377"),array("mn","Mongolia (Монгол)","+976"),array("me","Montenegro (Crna Gora)","+382"),array("ms","Montserrat","+1664"),array("ma","Morocco (&#8235;المغرب&#8236;&lrm;)","+212"),array("mz","Mozambique (Moçambique)","+258"),array("mm","Myanmar (Burma) (မြန်မာ)","+95"),array("na","Namibia (Namibië)","+264"),array("nr","Nauru","+674"),array("np","Nepal (नेपाल)","+977"),array("nl","Netherlands (Nederland)","+31"),array("nc","New Caledonia (Nouvelle-Calédonie)","+687"),array("nz","New Zealand","+64"),array("ni","Nicaragua","+505"),array("ne","Niger (Nijar)","+227"),array("ng","Nigeria","+234"),array("nu","Niue","+683"),array("nf","Norfolk Island","+672"),array("kp","North Korea (조선 민주주의 인민 공화국)","+850"),array("mp","Northern Mariana Islands","+1670"),array("no","Norway (Norge)","+47"),array("om","Oman (&#8235;عُمان&#8236;&lrm;)","+968"),array("pk","Pakistan (&#8235;پاکستان&#8236;&lrm;)","+92"),array("pw","Palau","+680"),array("ps","Palestine (&#8235;فلسطين&#8236;&lrm;)","+970"),array("pa","Panama (Panamá)","+507"),array("pg","Papua New Guinea","+675"),array("py","Paraguay","+595"),array("pe","Peru (Perú)","+51"),array("ph","Philippines","+63"),array("pl","Poland (Polska)","+48"),array("pt","Portugal","+351"),array("pr","Puerto Rico","+1"),array("qa","Qatar (&#8235;قطر&#8236;&lrm;)","+974"),array("re","Réunion (La Réunion)","+262"),array("ro","Romania (România)","+40"),array("ru","Russia (Россия)","+7"),array("rw","Rwanda","+250"),array("bl","Saint Barthélemy (Saint-Barthélemy)","+590"),array("sh","Saint Helena","+290"), array("kn","Saint Kitts and Nevis","+1869"),array("lc","Saint Lucia","+1758"), array("mf","Saint Martin (Saint-Martin (partie française))","+590"),array("pm","Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)","+508"), array("vc","Saint Vincent and the Grenadines","+1784"),array("ws","Samoa","+685"),array("sm","San Marino","+378"),array("st","São Tomé and Príncipe (São Tomé e Príncipe)","+239"),array("sa","Saudi Arabia (&#8235;المملكة العربية السعودية&#8236;&lrm;)","+966"),array("sn","Senegal (Sénégal)","+221"),array("rs","Serbia (Србија)","+381"),array("sc","Seychelles","+248"),array("sl","Sierra Leone","+232"),array("sg","Singapore","+65"),array("sx","Sint Maarten","+1721"),array("sk","Slovakia (Slovensko)","+421"),array("si","Slovenia (Slovenija)","+386"),array("sb","Solomon Islands","+677"),array("so","Somalia (Soomaaliya)","+252"),array("za","South Africa","+27"),array("kr","South Korea (대한민국)","+82"),array("ss","South Sudan (&#8235;جنوب السودان&#8236;&lrm;)","+211"),array("es","Spain (España)","+34"),array("lk","Sri Lanka (ශ්&zwj;රී ලංකාව)","+94"),array("sd","Sudan (&#8235;السودان&#8236;&lrm;)","+249"),array("sr","Suriname","+597"),array("sj","Svalbard and Jan Mayen","+47"),array("sz","Swaziland","+268"),array("se","Sweden (Sverige)","+46"),array("ch","Switzerland (Schweiz)","+41"),array("sy","Syria (&#8235;سوريا&#8236;&lrm;)","+963"),array("tw","Taiwan (台灣)","+886"),array("tj","Tajikistan","+992"),array("tz","Tanzania","+255"),array("th","Thailand (ไทย)","+66"),array("tl","Timor-Leste","+670"),array("tg","Togo","+228"),array("tk","Tokelau","+690"),array("to","Tonga","+676"),array("tt","Trinidad and Tobago","+1868"),array("tn","Tunisia (&#8235;تونس&#8236;&lrm;)","+216"),array("tr","Turkey (Türkiye)","+90"),array("tm","Turkmenistan","+993"),array("tc","Turks and Caicos Islands","+1649"),array("tv","Tuvalu","+688"),array("vi","U.S. Virgin Islands","+1340"),array("ug","Uganda","+256"),array("ua","Ukraine (Україна)","+380"),array("ae","United Arab Emirates (&#8235;الإمارات العربية المتحدة&#8236;&lrm;)","+971"),array("gb","United Kingdom","+44"),array("us","United States","+1"),array("uy","Uruguay","+598"),array("uz","Uzbekistan (Oʻzbekiston)","+998"),array("vu","Vanuatu","+678"),array("va","Vatican City (Città del Vaticano)","+39"),array("ve","Venezuela","+58"),array("vn","Vietnam (Việt Nam)","+84"),array("wf","Wallis and Futuna","+681"),array("eh","Western Sahara (&#8235;الصحراء الغربية&#8236;&lrm;)","+212"),array("ye","Yemen (&#8235;اليمن&#8236;&lrm;)","+967"),array("zm","Zambia","+260"),array("zw","Zimbabwe","+263"),array("ax","Åland Islands","+358")); ?>
                 <td>
                 <seled4m name="seled4med_country_code_display[]" multiple class="seled4mpicker" data-size="10" data-live-search="true" data-live-search-placeholder="search">
                  
                 <?php  
                    for($i=0;$i<count((array)$country_code_alpha_array);$i++){
                      ?>
                      <option <?php  if(in_array($country_code_alpha_array[$i][0],$arrs)){ echo "seled4med"; }?> data-subtext="<?php echo $country_code_alpha_array[$i][1]; ?> - <?php  echo $country_code_alpha_array[$i][2]?>" value="<?php echo $country_code_alpha_array[$i][0];?>"><?php echo $country_code_alpha_array[$i][0]?></option>
                      <?php  
                    }
                  ?>
                </seled4m>
                 
                 </td>
                </tr>
                
                <tr>
                 <td><?php echo $label_language_values['frontend_fonts'];?></td>
                 <?php 
                 include 'font_array.php';
                 $d4m_frontend_fonts_val = $setting->get_option("d4m_frontend_fonts");
                 ?>
                 <td>
                 <seled4m name="seled4med_frontend_fonts_display" class="seled4mpicker" data-size="10" data-live-search="true" data-live-search-placeholder="search">
                  
                 <?php  
                    foreach($customfonts as $customfont){
                      ?>
                      <option style="font-family:<?php echo $customfont; ?>" <?php  if($customfont == $d4m_frontend_fonts_val){ echo "seled4med"; }?> value="<?php echo $customfont;?>"><?php echo $customfont; ?></option>
                      <?php  
                    }
                  ?>
                </seled4m>
                 
                 </td>
                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['custom_css'];?></label></td>
                                    <td>
                                        <div class="form-group col-xs-12 np">
                                            <textarea class="form-control" style="width: 100%; min-height: 150px;" name="cust_css" id="d4m_custom_css"><?php echo $setting->get_option("d4m_custom_css");?></textarea>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['login_page'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-default btn-file mt-15"><input type="file" id="login_page" name="loginimg" /></span>
                        <a id="loginbg" class="mt-15 btn btn-info"><i class="fa fa-edit"></i><?php echo $label_language_values['restore_default'];?></a><br>
                        <span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
                      </div>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['front_page'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-default btn-file mt-15"><input type="file" id="front_page" name="frontimage" /></span>
                        <a id="frontbg"  class="mt-15 btn btn-info"><i class="fa fa-edit"></i><?php echo $label_language_values['restore_default'];?></a><br>
                        <span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
                      </div>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                                    <td><label><?php echo $label_language_values['favicon_image'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-default btn-file mt-15"><input type="file" id="favicon_page" name="faviconimage" /></span>
                        <br>
                        <span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
                      </div>
                                        </div>
                                    </td>
                                </tr>
                <tr>
                  <td><?php echo $label_language_values['Loader'];?></td>
                  <td>
                  <div class="d4m-custom-radio">
                    <ul class="d4m-radio-list app-set" style="margin-bottom: 0px;padding-left: 0px;">
                      <label class="radio-inline"><input type="radio" name="d4m_loader_option" id="d4m_cssloader" <?php  if($setting->get_option("d4m_loader")== 'css'){echo 'checked'; } ?> value="css"><?php echo $label_language_values['CSS_Loader'];?></label>
                      
                      <label class="radio-inline"><input type="radio" name="d4m_loader_option" id="d4m_gifloader" <?php  if($setting->get_option("d4m_loader")== 'gif'){echo 'checked'; } ?> value="gif"><?php echo $label_language_values['GIF_Loader'];?></label>
                      
                      <label class="radio-inline"><input type="radio" name="d4m_loader_option" id="d4m_defaultloader" <?php  if($setting->get_option("d4m_loader")== 'default'){echo 'checked'; } ?>  value="default"><?php echo $label_language_values['Default_Loader'];?></label>
                    </ul>
                  </div>
                  </td>
                </tr>
                <tr class="d4m_GIF_Loader_div">
                  <td><?php echo $label_language_values['GIF_Loader'];?></td>
                  <td>
                    <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-default btn-file mt-15"><input type="file" class="d4m_frontend_gif_loader_file" name="d4m_frontend_gif_loader_file" /></span>
                        &nbsp;
                        <img id="d4m_upload_gif_loader_preview" <?php  if($setting->get_option("d4m_custom_gif_loader") == ''){ echo 'style="display:none;"'; } ?> class="mt-15" height="40px" width="40px" <?php  if($setting->get_option("d4m_custom_gif_loader") != ''){ echo 'src="'.SITE_URL.'/assets/images/gif-loader/'.$setting->get_option("d4m_custom_gif_loader").'"'; } ?> />
                        <br>
                        <span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
                      </div>
                                        </div>
                  </td>
                </tr>
                <tr class="d4m_CSS_Loader_div">
                  <td><?php echo $label_language_values['CSS_Loader'];?></td>
                  <td>
                     <div class="form-group col-xs-12 np">
                      <div class="col-md-7 np">
                        <textarea class="form-control" style="width: 100%; min-height: 150px;" name="d4m_custom_css_loader" id="d4m_custom_css_loader"><?php echo $setting->get_option("d4m_custom_css_loader");?></textarea>
                      </div>
                      <div class="col-md-4 d4m_custom_css_loader_preview_overlay">
                        <?php  echo $setting->get_option("d4m_custom_css_loader"); ?>
                      </div>
                                        </div>
                  </td>
                </tr>
                <tr class="d4m_calendar_defaultView">
                  <td><?php echo $label_language_values['Calendar_Default_View'];?></td>
                  <td>
                     <div class="form-group col-xs-12 np">
                      <div class="col-md-7 np">
                        <seled4m name="d4m_calendar_defaultView" class="seled4mpicker">
                          <option <?php  if($setting->get_option("d4m_calendar_defaultView") == 'month'){ echo "seled4med"; } ?> value="month">Month</option>
                          <option <?php  if($setting->get_option("d4m_calendar_defaultView") == 'agendaWeek'){ echo "seled4med"; } ?> value="agendaWeek">Week</option>
                          <option <?php  if($setting->get_option("d4m_calendar_defaultView") == 'agendaDay'){ echo "seled4med"; } ?> value="agendaDay">Day</option>
                        </seled4m>
                      </div>
                                        </div>
                  </td>
                </tr>
                <tr class="d4m_calendar_firstDay">
                  <td><?php echo $label_language_values['Calendar_Fisrt_Day'];?></td>
                  <td>
                     <div class="form-group col-xs-12 np">
                      <div class="col-md-7 np">
                        <seled4m name="d4m_calendar_firstDay" class="seled4mpicker">
                          <option <?php  if($setting->get_option("d4m_calendar_firstDay") == '0'){ echo "seled4med"; } ?> value="0">Sunday</option>
                          <option <?php  if($setting->get_option("d4m_calendar_firstDay") == '1'){ echo "seled4med"; } ?> value="1">Monday</option>
                        </seled4m>
                      </div>
                                        </div>
                  </td>
                </tr>

    

                </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td>
                        <button id="appreance" value="Save Member" class="btn btn-success appearance_settings_btn_check" type="submit" name="appreance"><?php echo $label_language_values['save_setting'];?></button>
                      </td>
                    </tr>
                  </tfoot>
                </table>

                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade in" id="payment-setting">
                <form id="payment_getway_form" method="post" type="" class="d4m-payment-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['payment_gateways'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"><a id="payment_setting" name="save-payment-gateways-setting" class="btn btn-success d4m-btn-width" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 pt plr-10">
                            <div id="accordion" class="panel-group">
                                <div class="panel panel-default d4m-all-payments-main">
                                    <!-- <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <span><?php /* echo $label_language_values['all_payment_gateways']; */?></span>
                                            <div class="d4m-enable-disable-right pull-right">
                                                <label class="d4m-toggle-medium" for="all-payment-gateways">
                                                    <input class="d4m-toggle-medium-input" <?php  /* if($setting->d4m_all_payment_gateway_status=='on'){echo 'checked';} */ ?> type="checkbox" name="" id="all-payment-gateways" />
                          <span class="d4m-toggle-medium-label" data-enable="<?php /* echo $label_language_values['enable']; */ ?>" data-disable="<?php /* echo $label_language_values['disable']; */ ?>"></span>
                          <span class="d4m-toggle-medium-handle"></span
                        </label>
                          </div>
                          </h4>
                        </div> -->

                                    <!-- <div <?php  /* if($setting->d4m_all_payment_gateway_status=='on'){echo 'style="display:block;"';} */ ?> id="collapseOne" class="panel-collapse collapse mycollapse_all-payment-gateways"> -->
                                    <div style="display:block;" id="collapseOne" class="panel-collapse collapse mycollapse_all-payment-gateways">
                                        <div class="panel-body p-10">

                                            <div class="alert alert-danger payment_warning" style="display:none;">
                                                <a href="#" class="payment_warning_close close" >&times;</a>
                                                <strong>Warning! </strong><p id="payment_warning" style="display: inline;" class=""></p>
                                            </div>
                                            <div id="accordion" class="panel-group">
                                                <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['pay_locally'];?></span>
                                                            <div class="d4m-enable-disable-right d4m-pay-locally pull-right">
                                                                <label class="d4moggle-pay-locally" for="pay-locally">
                                  <input class='d4ma-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_pay_locally_status=='on'){echo 'checked';}?> id="pay-locally" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                
                                                                </label>
                                                            </div>

                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['paypal_express_checkout'];?><img class="d4ma-paypal-img-payments" src="<?php echo SITE_URL; ?>/assets/images/paypal.png" /></span>
                                                            <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-paypal-checkout" for="paypal-checkout">
                                  <input class='d4ma-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_paypal_express_checkout_status=='on'){echo 'checked';}?> id="paypal-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                
                                                                </label>
                                                            </div>

                                                        </h4>
                                                    </div>
                                                    <div <?php  if($setting->d4m_paypal_express_checkout_status=='on'){echo 'style="display:block"';}?> id="collapseOne" class="panel-collapse collapse mycollapse_paypal-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_username'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group d4m-lgf">
                                                                            <input type="text" class="form-control" id="d4m_paypal_api_username" value="<?php echo ($setting->d4m_paypal_api_username)?>" name="d4m-paypal-api-username" size="50" />
                                      <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_username_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_password'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group d4m-lgf">
                                                                            <input type="text" class="form-control" id="d4m_paypal_api_password" value="<?php echo ($setting->d4m_paypal_api_password)?>" name="d4m-paypal-api-password" size="50" />
                                      <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_password_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['signature'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group d4m-lgf">
                                                                            <input type="text" class="form-control" id="d4m_paypal_api_signature" value="<?php echo ($setting->d4m_paypal_api_signature)?>"  name="d4m-paypal-api-signature" size="50" />
                                      <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_signature_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['paypal_guest_payment'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="d4moggle-paypal-guest-payment" for="paypal-guest-payment">
                                        <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_paypal_guest_payment_status=='on'){echo 'checked';}?> name="" id="paypal-guest-payment" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                      
                                                                            </label>
                                                                        </div>
                                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['let_user_pay_through_credit_card_without_having_paypal_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['test_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="d4moggle-paypal-test-mode" for="paypal-test-mode">
                                        <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_paypal_test_mode_status=='on'){echo 'checked';}?> name="" id="paypal-test-mode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                      
                                                                            </label>
                                                                        </div>
                                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_enable_paypal_test_mode_for_sandbox_account_testing'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['authorize_net'];?> <?php  echo $label_language_values['payment_form'];?></span><img class="d4ma-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/authorize-net.png" />
                                                            <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-authorizedotnet-payment-checkout" for="authorizedotnet-payment-checkout">
                                  <input class='d4ma-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_authorizenet_status=='on'){echo 'checked';} ?> name="" id="authorizedotnet-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                  
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php  if($setting->d4m_authorizenet_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_authorizedotnet-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_login_id'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m-authorizenet-API-login-ID" value="<?php echo ($setting->d4m_authorizenet_API_login_ID);?>" name="d4m-authorizenet-API-login-ID" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['transad4mion_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m-authorize-transad4mion-key" name="d4m-authorize-transad4mion-key" value="<?php echo ($setting->d4m_authorizenet_transad4mion_key);?>" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['sandbox_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="d4moggle-authorize-sandbox-mode" for="authorize-sandbox-mode">
                                        <input data-toggle="toggle" data-size="small" type='checkbox' id="authorize-sandbox-mode" <?php  if($setting->d4m_authorize_sandbox_mode=='on'){echo 'checked';}?> data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                      </label>
                                                                        </div>
                                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_enable_authorize_net_test_mode_for_sandbox_account_testing'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['stripe'];?> <?php  echo $label_language_values['payment_form'];?></span><img class="d4ma-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/stripe.jpg" />
                                                            <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-stripe-payment-checkout" for="stripe-payment-checkout">
                                  <input class="d4ma-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_stripe_payment_form_status=='on'){echo 'checked';} ?> name="" id="stripe-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php  if($setting->d4m_stripe_payment_form_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_stripe-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['secret_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_stripe_secretkey" value="<?php echo ($setting->d4m_stripe_secretkey) ?>" name="d4m-stripe-secretKey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['publishable_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_stripe_publishablekey" value="<?php echo ($setting->d4m_stripe_publishablekey) ?>" name="d4m-paypal-stripe- publishableKey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                        <!--2checkout payment gateway start-->
                        <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['checkout_title'];?> <?php  echo $label_language_values['payment_form'];?></span><img class="d4ma-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/2checkout.png" />
                                                            <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-twocheckout-payment-checkout" for="twocheckout-payment-checkout">
                                  <input class="d4ma-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_2checkout_status=='Y'){echo 'checked';} ?> name="" id="twocheckout-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php  if($setting->d4m_2checkout_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_twocheckout-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['publishable_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_2checkout_publishkey" value="<?php echo $setting->d4m_2checkout_publishkey; ?>" name="d4m_2checkout_publishkey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['private_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_2checkout_privatekey" value="<?php echo $setting->d4m_2checkout_privatekey; ?>" name="d4m_2checkout_privatekey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['seller_id'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_2checkout_sellerid" value="<?php echo $setting->d4m_2checkout_sellerid; ?>" name="d4m_2checkout_sellerid" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['test_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="d4moggle-2checkout-test-mode" for="d4m_2checkout_sandbox_mode">
                                        <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_2checkout_sandbox_mode=='Y'){echo 'checked';}?> name="" id="d4m_2checkout_sandbox_mode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                      
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                        <!--2checkout payment gateway end-->
                        
                        <!-- New Added -->
                        <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['payumoney'];?></span><img class="d4ma-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/payumoney.jpg" />
                                                            <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-payumoney-payment-checkout" for="payu-money">
                                  <input class="d4ma-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_payumoney_status=='Y'){echo 'checked';} ?> name="" id="payu-money" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php  if($setting->d4m_payumoney_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_payu-money">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['merchant_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_payumoney_merchant_key" value="<?php echo $setting->d4m_payumoney_merchant_key; ?>" name="d4m_payumoney_merchant_key" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['salt_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_payumoney_salt" value="<?php echo $setting->d4m_payumoney_salt; ?>" name="d4m_payumoney_salt" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                        <!-- bank trasfer new -->
                        <div class="panel panel-default d4m-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['bank_transfer'];?></span><div class="payment-icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                              <div class="d4m-enable-disable-right pull-right">
                                                                <label class="d4moggle-bank-transfer-payment-checkout" for="bank-transfer-payment-checkout">
                                  <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_bank_transfer_status=='Y'){echo 'checked';} ?> name="" id="bank-transfer-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                
                                                                </label>
                                                            </div>
                                                        </h4>
                            
                                                    </div>
                          
                          
                                                    <div id="collapseOne" <?php  if($setting->d4m_bank_transfer_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_bank-transfer-payment-checkout" >
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline d4m-common-table">
                                                                <tbody>
                                
                                <tr>
                                                                    <td><label><?php echo $label_language_values['bank_name'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_bank_name" value="<?php echo  $setting->get_option('d4m_bank_name');?>" name="" size="50" />
                                                                           
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['account_name'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_account_name" value="<?php echo  $setting->get_option('d4m_account_name');?>" name="" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['account_number'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_account_number" value="<?php echo  $setting->get_option('d4m_account_number');?>" name="" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['branch_code'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_branch_code" value="<?php echo  $setting->get_option('d4m_branch_code');?>" name="" size="10" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['ifsc_code'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="d4m_ifsc_code" value="<?php echo  $setting->get_option('d4m_ifsc_code');?>" name="" size="30" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                <tr>
                                                                    <td><label><?php echo $label_language_values['bank_description'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control"  id="d4m_bank_description" value="" cols="48" rows="3"><?php echo  $setting->get_option('d4m_bank_description');?></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                        <!-- new bank transfer end -->
                        <!-- Payment start -->
                        <?php  
                        if(sizeof((array)$purchase_check)>0){
                          foreach($purchase_check as $key=>$val){
                            if($val == 'Y'){
                              echo $payment_hook->payment_setting_hook($key);
                            }
                          }
                        }
                        ?>
                        <!-- Payment end -->
                        <!-- End -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <a id="payment_setting" name="save-payment-gateways-setting" class="btn btn-success d4m-btn-width mt-20 ml-10" ><?php echo $label_language_values['save_setting'];?></a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade in" id="email-setting">
                <form method="post" type="" class="d4m-email-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['email_settings'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a id="email_setting" name="" class="btn btn-success"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">

                            <div class="panel-body">
                                <table class="form-inline d4m-common-table" >
                                    <tbody>
                                    <tr>
                                        <td><label><?php echo $label_language_values['admin_email_notifications'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="d4moggle-admin-email-notification" for="admin-email-notification">
                          <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_admin_email_notification_status=='Y'){echo 'checked';}?> name="" id="admin-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label><?php echo $label_language_values['client_email_notifications'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="d4moggle-client-email-notification" for="client-email-notification">
                          <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_client_email_notification_status=='Y'){echo 'checked';}?> name="" id="client-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                  <tr>
                                        <td><label><?php echo $label_language_values['staff_email_notification'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="d4moggle-client-email-notification" for="client-email-notification">
                          <input data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_staff_email_notification_status=='Y'){echo 'checked';}?> name="" id="staff-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                  
                  <tr>
                                        <td><label><?php echo $label_language_values['administrator_email'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php  echo $admin_optional_email;?>" class="form-control w-300" name="admin_optional_email" id="admin_optional_email" placeholder="admin@example.com" />
                                            </div>
                                        </td>
                                    </tr>
                <!--  <tr><td class="np"><hr /></td><td class="np"><hr /></td></tr> -->
                                    <tr>
                                        <td><label><?php echo $label_language_values['sender_name'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo htmlentities($setting->d4m_email_sender_name);?>" class="form-control w-300" name="" id="sender_name" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><?php echo $label_language_values['sender_email_address_do4me_admin_email'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->d4m_email_sender_address)?>" class="form-control w-300" name="d4m_email_sender_address" id="sender_email" placeholder="admin@example.com" />
                                            </div>
                                        </td>
                                    </tr>
                 <!-- <tr><td class="np"><hr /></td><td class="np"><hr /></td></tr> -->
                                   
                                    <tr>
                                        <td><label>SMTP <?php  echo $label_language_values['hostname'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->d4m_smtp_hostname);?>" class="form-control w-300" name="" id="d4m_smtp_hostname" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>SMTP <?php  echo $label_language_values['username'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->d4m_smtp_username)?>" class="form-control w-300" name="" id="d4m_smtp_username" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>SMTP <?php  echo $label_language_values['password'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->d4m_smtp_password)?>" class="form-control w-300" name="" id="d4m_smtp_password" />
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label>SMTP <?php  echo $label_language_values['port'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->d4m_smtp_port)?>" class="form-control w-300" name="" id="d4m_smtp_port" />
                                            </div>
                                        </td>
                                    </tr>
                  <tr>
                                        <td><label><?php echo $label_language_values['encryption_type'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <seled4m name="d4m_email_appointment_encryption" id="encryption_val" class="seled4mpicker" data-size="5" style="display: none;">
                                                    <option <?php  if($setting->d4m_smtp_encryption==''){echo "seled4med";}?> value=""><?php echo $label_language_values['plain'];?></option>
                          <option <?php  if($setting->d4m_smtp_encryption=='tls'){echo "seled4med";}?> value="tls">TLS</option>
                          <option <?php  if($setting->d4m_smtp_encryption=='ssl'){echo "seled4med";}?> value="ssl">SSL</option>
                                                </seled4m>
                                            </div>                      
                                        </td>
                                    </tr>
                  <tr>
                                        <td><label>SMTP <?php  echo $label_language_values['authetication'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <seled4m name="d4m_email_appointment_authentication" id="authentication_val" class="seled4mpicker" data-size="5" style="display: none;">
                          <option <?php  if($setting->d4m_smtp_authetication=='false'){echo "seled4med";}?> value="false"><?php echo $label_language_values['false'];?></option>
                          <option <?php  if($setting->d4m_smtp_authetication=='true'){echo "seled4med";}?> value="true"><?php echo $label_language_values['true'];?></option>
                                                </seled4m>
                                            </div>                      
                                        </td>
                                    </tr>
                 <!-- <tr><td class="np"><hr /></td><td class="np"><hr /></td></tr> -->
                  
                  <tr>
                                        <td><label><?php echo $label_language_values['appointment_reminder_buffer'];?></label></td>
                                        <td class="appo-reminder">
                                            <div class="form-group">
                                                <seled4m name="d4m_email_appointment_reminder_buffer" id="appointment_reminder" class="seled4mpicker" data-size="5" style="display: none;">
                                                    <option value=""><?php echo $label_language_values['set_email_reminder_buffer'];?></option>
                                                    <option value="60" <?php  if($setting->d4m_email_appointment_reminder_buffer=='60'){echo 'seled4med';} ?> >1 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="120"  <?php  if($setting->d4m_email_appointment_reminder_buffer=='120'){echo 'seled4med';} ?> >2 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="180"  <?php  if($setting->d4m_email_appointment_reminder_buffer=='180'){echo 'seled4med';} ?> >3 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="240"  <?php  if($setting->d4m_email_appointment_reminder_buffer=='240'){echo 'seled4med';} ?> >4 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="300"  <?php  if($setting->d4m_email_appointment_reminder_buffer=='300'){echo 'seled4med';} ?> >5 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="360"  <?php  if($setting->d4m_email_appointment_reminder_buffer=='360'){echo 'seled4med';} ?> >6 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="420" <?php  if($setting->d4m_email_appointment_reminder_buffer=='420'){echo 'seled4med';} ?> >7 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="480" <?php  if($setting->d4m_email_appointment_reminder_buffer=='480'){echo 'seled4med';} ?> >8 <?php  echo $label_language_values['hours'];?></option>
                                                    <option value="1440" <?php  if($setting->d4m_email_appointment_reminder_buffer=='1440'){echo 'seled4med';} ?> >1 <?php  echo $label_language_values['days'];?></option>
                                                </seled4m>
                                            </div>
                      <div class="d4m-reminder-buffer">
                         Note: You can set the following file as a cron job on your server to make the 'appointment reminder notification' working.<br /> 
                        <b>Cronjob file:</b>&nbsp;<?php echo ROOT_PATH; ?>assets/lib/email_reminder_ajax.php
                      </div>
                                        </td>
                                    </tr>
                  

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a id="email_setting" name="" class="btn btn-success"><?php echo $label_language_values['save_setting'];?></a>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>


                            </div>

                        </div>
                    </div>
                </form>
            </div>

      <div class="tab-pane fade in" id="email-template">
          <div class="d4m-email-template-panel panel panel-default wf-100">
            <div class="panel-heading">
              <h1 class="panel-title"><?php echo $label_language_values['email_template_settings'];?></h1>
            </div>
            <!-- Client email templates -->
            <ul class="nav nav-tabs nav-justified">
              <li class="ad4mive"><a data-toggle="tab" href="#client-email-template"><?php echo $label_language_values['client_email_templates'];?></a></li>
              <li><a data-toggle="tab" href="#admin-email-template"><?php echo $label_language_values['admin_email_template'];?></a></li>
              <li><a data-toggle="tab" href="#staff-email-template"><?php echo $label_language_values['staff_email_template'];?></a></li>
            </ul>
            <div class="tab-content">
              <div id="client-email-template" class="tab-pane fade in ad4mive">
                <h3><?php echo $label_language_values['client_email_templates'];?></h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                    <?php 
                    $readall_client_email_template = $email_template->readall_client_email_template();
                    $ti = 1;
                    while($readall_client = mysqli_fetch_array($readall_client_email_template)){
                      ?>
                      <li class="panel panel-default d4m-client-email-temp-panel" >
                      <div class="panel-heading br-2">
                        <h4 class="panel-title">
                          <div class="d4ma-col11">
                            <div class="pull-left">
                              <div class="d4m-yes-no-email-right pull-left">
                                <label class="d4m-toggle" for="email-client<?php  echo $readall_client['id']; ?>">     
                                    <input class='d4ma-toggle-checkbox save_client_email_template_status' <?php  if($readall_client['email_template_status'] =='E'){ ?> checked <?php  } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_client['id']; ?>" id="email-client<?php  echo $readall_client['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                  
                                </label>
                              </div>
                            </div>  
                            <span class="d4m-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_client['email_subjed4m']))]; ?></span>
                          </div>
                          <div class="pull-right d4ma-col1">
                            <div class="pull-right">
                              <div class="d4m-show-hide pull-right">
                                <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox d4m_open_close_email_template" id="ce<?php  echo $readall_client['id']; ?>" data-id="<?php echo $readall_client['id']; ?>">
                                <label class="d4m-show-hide-label" for="ce<?php  echo $readall_client['id']; ?>"></label>
                              </div>
                            </div>
                          </div>
                          
                        </h4>
                      </div>
                      <div id="detail_email_templates_<?php  echo $readall_client['id']; ?>" class="panel-collapse collapse email_content detail_ce<?php  echo $readall_client['id']; ?>">
                        <div class="panel-body p-10">
                          <div class="d4m-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                            <form id="" method="post" type="" class="slide-toggle email_template_form" >
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea class="form-control" name="email_message<?php  echo $ti;?>" id="email_message_<?php  echo $readall_client['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_client['email_message'] != ''){ echo base64_decode($readall_client['email_message']); }else{ echo base64_decode($readall_client['default_message']); } ?></textarea>
                                
                                <input type="submit"  class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" name="template<?php  echo $ti;?>" value="Save Template">
                                <input type="hidden" name="hdntemplate<?php  echo $ti;?>" value="<?php echo $readall_client['id']; ?>">
                              
                                <a id="default_email_contents" name="" data-id="<?php echo $readall_client['id']; ?>" class="btn btn-primary d4m-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                
                                <a name="" data-id="<?php  echo $readall_client['id']; ?>" class="btn btn-warning d4m-btn-width cb ml-15 mt-20 preview_email_contents" data-title="<?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_client['email_subjed4m']))]; ?>" type="submit"><?php echo $label_language_values['preview_template'];?></a>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="d4m-email-content-tags">
                                  <b><?php echo $label_language_values['tags'];?></b><br>
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_promocode}}">{{<?php echo $label_language_values['client__promocode'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                </div>     
                              </div>
                              <?php  /*
                              <a id="save_email_template" name="" data-id="<?php echo $readall_client['id']; ?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                              */
                              ?>
                              <?php  $ti++;?>
                            </form>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php 
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <div id="admin-email-template" class="tab-pane fade">
                <h3><?php echo $label_language_values['admin_email_template'];?></h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                    <?php 
                    $readall_admin_email_template = $email_template->readall_admin_email_template();
                    while($readall_admin = mysqli_fetch_array($readall_admin_email_template)){
                    ?>
                      <li class="panel panel-default d4m-admin-email-temp-panel" >
                      <div class="panel-heading br-2">
                        <h4 class="panel-title">
                          <div class="d4ma-col11">
                            <div class="pull-left">
                              <div class="d4m-yes-no-email-right pull-left">
                                <label class="d4m-toggle" for="email-admin<?php  echo $readall_admin['id']; ?>">
                                    
                                    <input class='d4ma-toggle-checkbox save_admin_email_template_status' <?php  if($readall_admin['email_template_status'] =='E'){ ?> checked <?php  } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_admin['id']; ?>" id="email-admin<?php  echo $readall_admin['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                    
                                </label>
                              </div>
                            </div>  
                            <span class="d4m-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_admin['email_subjed4m']))]; ?></span>
                          </div>
                          <div class="pull-right d4ma-col1">
                            <div class="pull-right">
                              <div class="d4m-show-hide pull-right">
                                <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox d4m_open_close_email_template" id="ae<?php  echo $readall_admin['id']; ?>" data-id="<?php echo $readall_admin['id']; ?>">
                                <label class="d4m-show-hide-label" for="ae<?php  echo $readall_admin['id']; ?>"></label>
                              </div>
                            </div>
                          </div>
                          
                        </h4>
                      </div>
                      <div id="detail_email_templates_<?php  echo $readall_admin['id']; ?>" class="panel-collapse collapse email_content detail_ae<?php  echo $readall_admin['id']; ?>">
                        <div class="panel-body p-10">
                          <div class="d4m-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                            <form id="" method="post" type="" class="slide-toggle email_template_form" >
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea class="form-control" name="email_message<?php  echo $ti;?>"  id="email_message_<?php  echo $readall_admin['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_admin['email_message'] != ''){ echo base64_decode($readall_admin['email_message']); }else{ echo base64_decode($readall_admin['default_message']); } ?></textarea>
                                
                                <input type="submit"  class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" name="template<?php  echo $ti;?>" value="Save Template">
                              
                                <input type="hidden" name="hdntemplate<?php  echo $ti;?>" value="<?php echo $readall_admin['id']; ?>">
                                
                                <a id="default_email_contents" name="" data-id="<?php echo $readall_admin['id']; ?>" class="btn btn-primary d4m-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                <a name="" data-id="<?php  echo $readall_admin['id']; ?>" class="btn btn-warning d4m-btn-width cb ml-15 mt-20 preview_email_contents" data-title="<?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_admin['email_subjed4m']))]; ?>" type="submit"><?php echo $label_language_values['preview_template'];?></a>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="d4m-email-content-tags">
                                  <b><?php echo $label_language_values['tags'];?></b><br>
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_promocode}}">{{<?php echo $label_language_values['client__promocode'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                </div>
                              </div>
                            <?php  /*
                            <a id="save_email_template" name="" data-id="<?php echo $readall_admin['id']; ?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                              */
                              ?>
                              <?php  $ti++;?>
                            </form> 
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php 
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <div id="staff-email-template" class="tab-pane fade">
                <h3><?php echo $label_language_values['staff_email_template'];?></h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                    <?php 
                    $readall_staff_email_template = $email_template->readall_staff_email_template();
                    
                    while($readall_staff = mysqli_fetch_array($readall_staff_email_template)){
                    ?>
                      <li class="panel panel-default d4m-staff-email-temp-panel" >
                      <div class="panel-heading br-2">
                        <h4 class="panel-title">
                          <div class="d4ma-col11">
                            <div class="pull-left">
                              <div class="d4m-yes-no-email-right pull-left">
                                <label class="d4m-toggle" for="email-staff<?php  echo $readall_staff['id']; ?>">
                                    
                                    <input class='d4ma-toggle-checkbox save_staff_email_template_status' <?php  if($readall_staff['email_template_status'] =='E'){ ?> checked <?php  } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_staff['id']; ?>" id="email-staff<?php  echo $readall_staff['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                    
                                </label>
                              </div>
                            </div>  
                            <span class="d4m-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_staff['email_subjed4m']))]; ?></span>
                          </div>
                          <div class="pull-right d4ma-col1">
                            <div class="pull-right">
                              <div class="d4m-show-hide pull-right">
                                <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox d4m_open_close_email_template" id="ae<?php  echo $readall_staff['id']; ?>" data-id="<?php echo $readall_staff['id']; ?>">
                                <label class="d4m-show-hide-label" for="ae<?php  echo $readall_staff['id']; ?>"></label>
                              </div>
                            </div>
                          </div>
                          
                        </h4>
                      </div>
                      <div id="detail_email_templates_<?php  echo $readall_staff['id']; ?>" class="panel-collapse collapse email_content detail_ae<?php  echo $readall_staff['id']; ?>">
                        <div class="panel-body p-10">
                          <div class="d4m-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                            <form id="" method="post" type="" class="slide-toggle email_template_form" >
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea class="form-control" name="email_message<?php  echo $ti;?>"  id="email_message_<?php  echo $readall_staff['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_staff['email_message'] != ''){ echo base64_decode($readall_staff['email_message']); }else{ echo base64_decode($readall_staff['default_message']); } ?></textarea>
                                
                                <input type="submit"  class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" name="template<?php  echo $ti;?>" value="Save Template">
                              
                                <input type="hidden" name="hdntemplate<?php  echo $ti;?>" value="<?php echo $readall_staff['id']; ?>">
                                <a id="default_email_contents" name="" data-id="<?php echo $readall_staff['id']; ?>" class="btn btn-primary d4m-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                
                                <a name="" data-id="<?php  echo $readall_staff['id']; ?>" class="btn btn-warning d4m-btn-width cb ml-15 mt-20 preview_email_contents" data-title="<?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_staff['email_subjed4m']))]; ?>" type="submit"><?php echo $label_language_values['preview_template'];?></a>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="d4m-email-content-tags">
                                                                    <b><?php echo $label_language_values['tags'];?></b><br>
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_promocode}}">{{<?php echo $label_language_values['client__promocode'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{staff_name}}">{{<?php echo $label_language_values['staff__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{staff_email}}">{{<?php echo $label_language_values['staff__email'];?>}}</a><br />
                                </div>
                              </div>
                              <?php  /*
                            <a id="save_email_template" name="" data-id="<?php echo $readall_staff['id']; ?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                              */
                              ?>
                              <?php  $ti++;?>
                            </form> 
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php 
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
              
          </div>
        </div>

        <div class="tab-pane fade in" id="sms-reminder">
          <form id="sms_setting_form" method="post" type="" class="d4m-sms-reminder" >
            <div class="panel panel-default ">
              <div class="panel-heading d4ma-top-right">
                <h1 class="panel-title"><?php echo $label_language_values['sms_reminder'];?></h1>
                <span class="pull-right d4ma-setting-fix-btn"> <a class="btn btn-success" id="btnsave_sms_service"><?php echo $label_language_values['save_sms_settings'];?></a></span>
              </div>
              <div class="panel-body plr-10 pt-50">
                <div id="accordion" class="panel-group">
                  <div class="panel panel-default d4m-all-sms-gateway-main">
                    
                    <div id="collapseOne" style="display: block;" class="panel-collapse collapse mycollapse_sms-service-ena-dis d4m-sms-reminder-input pb-p">
                      <div class="panel-body p-10">
                        <div id="accordion" class="panel-group">
                          <div class="panel panel-default d4m-sms-gateway">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <span><?php echo $label_language_values['twilio_sms_gateway'];?></span><img class="d4ma-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/twilio-logo.png" />
                                <div class="d4m-enable-disable-right pull-right">
                                  <label class="d4moggle-sms-noti-twilio" for="sms-noti-twilio">
                                    <input class='d4ma-toggle-checkbox' data-toggle="toggle"  <?php  if($setting->d4m_sms_twilio_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-twilio" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                  </label>
                                </div>
                              </h4>
                            </div>
                            <div <?php  if($setting->d4m_sms_twilio_status == "Y"){?> style="display:block;" <?php  }?>  id="collapseOne" class="panel-collapse collapse mycollapse_sms-noti-twilio">
                              <div class="panel-body p-10"> 
                                <table class="form-inline table d4m-common-table table-hover table-bordered table-striped" >
                                    <tr><th colspan="3"><?php echo $label_language_values['twilio_account_settings'];?></th></tr>
                                    <tbody>
                                      <tr>
                                        <td><label><?php echo $label_language_values['account_sid'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="mytwilio_account_sid" class="form-control" value="<?php echo $setting->d4m_sms_twilio_account_SID;?>" name="mytwilio_account_sid" size="70" />
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="mytwilio_account_sid" generated="true" class="error" style="display: none;"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['auth_token'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="password" id="mytwilio_auth_token" class="form-control" value="<?php echo $setting->d4m_sms_twilio_auth_token;?>" name="mytwilio_auth_token" size="70" />
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="mytwilio_auth_token" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['twilio_sender_number'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="mytwilio_sender_number" class="form-control" value="<?php echo $setting->d4m_sms_twilio_sender_number;?>" name="mytwilio_sender_number" size="70" />
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['must_be_a_valid_number_associated_with_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="mytwilio_sender_number" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                    <tbody>
                                    <th colspan="3"><?php echo $label_language_values['twilio_sms_settings'];?></th>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-client-status" for="d4m-sms-reminder-client-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_twilio_send_sms_to_client_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-client-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-admin-status" for="d4m-sms-reminder-admin-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_twilio_send_sms_to_admin_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-admin-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_staff'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-staff-status" for="d4m-sms-reminder-staff-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_twilio_send_sms_to_staff_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-staff-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_staff_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['admin_phone_number']; ?></label></td>
                                        <td colspan="2">
                                          <div class="input-group">
                                            <span class="input-group-addon"><span class="company_country_code_value_twilio"><?php echo $country_codes[0];?></span></span>
                                            <input type="text" class="form-control" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('d4m_sms_twilio_admin_phone_number'));?>" name="myadmin_phone_number" id="myadmin_phone_number" />
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                    
                                  </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default d4m-sms-gateway">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <span><?php echo $label_language_values['plivo_sms_gateway'];?></span><img class="d4ma-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/plivo-logo.png" />
                                <div class="d4m-enable-disable-right pull-right">
                                  <label class="d4moggle-sms-noti-plivo" for="sms-noti-plivo">
                                    <input class='d4ma-toggle-checkbox' data-toggle="toggle" <?php  if($setting->d4m_sms_plivo_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                  </label>
                                </div>

                              </h4>
                            </div>
                            <div id="collapseOne" <?php  if($setting->d4m_sms_plivo_status == "Y"){?> style="display:block;" <?php  }?>   class="panel-collapse collapse mycollapse_sms-noti-plivo">
                              <div class="panel-body p-10"> 
                                <div class="table-responsive"> 
                                  <table class="form-inline table d4m-common-table table-hover table-bordered table-striped" >
                                    <tr><th colspan="3"><?php echo $label_language_values['plivo_account_settings'];?></th></tr>
                                    <tbody>
                                      <tr>
                                        <td><label><?php echo $label_language_values['account_sid'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="myplivo_account_sid" class="form-control" value="<?php echo $setting->d4m_sms_plivo_account_SID;?>" name="myplivo_account_sid" size="70" />
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="myplivo_account_sid" generated="true" class="error" style="display: none;"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['auth_token'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="password" id="myplivo_auth_token" class="form-control" value="<?php echo $setting->d4m_sms_plivo_auth_token;?>" name="myplivo_auth_token" size="70" />
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="myplivo_auth_token" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['plivo_sender_number'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="myplivo_sender_number" class="form-control" value="<?php echo $setting->d4m_sms_plivo_sender_number;?>" name="myplivo_sender_number" size="70" />
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['must_be_a_valid_number_associated_with_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="myplivo_sender_number" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                    
                                    <tbody>
                                    
                                    <th colspan="3"><?php echo $label_language_values['plivo_sms_settings'];?></th>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-client-status-plivo" for="d4m-sms-reminder-client-status-plivo">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_plivo_send_sms_to_client_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-client-status-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-admin-status-plivo" for="d4m-sms-reminder-admin-status-plivo">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_plivo_send_sms_to_admin_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-admin-status-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_admin_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_staff'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-staff-status-plivo" for="d4m-sms-reminder-staff-status-plivo">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_plivo_send_sms_to_staff_status == "Y"){echo "checked";}else{echo "";}?> id="d4m-sms-reminder-staff-status-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_staff_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                      <td><label><?php echo $label_language_values['admin_phone_number']; ?></label></td>
                                        <td colspan="2">
                                          <div class="input-group">
                                            <span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
                                            <input type="text" class="form-control" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('d4m_sms_plivo_admin_phone_number'));?>" name="myadmin_phone_number_plivo" id="myadmin_phone_number_plivo" />
                                          </div>
                                        </td>
                                        
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>  
                                
                              </div>
                            </div>
                          </div>
                          
                          <!-- Nexmo Settings -->
                          <div class="panel panel-default d4m-sms-gateway">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <span><?php echo $label_language_values['nexmo_sms_gateway'];?></span><img class="d4ma-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/nexmo_logo.png" />
                                <div class="d4m-enable-disable-right pull-right">
                                  <label class="d4moggle-sms-noti-plivo" for="sms-noti-nexmo">
                                    <input class='d4ma-toggle-checkbox' data-toggle="toggle" <?php  if($setting->d4m_sms_nexmo_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-nexmo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                  </label>
                                </div>

                              </h4>
                            </div>
                            <div id="collapseOne" <?php  if($setting->d4m_sms_nexmo_status == "Y"){?> style="display:block;" <?php  }?>   class="panel-collapse collapse mycollapse_sms-noti-nexmo">
                              <div class="panel-body p-10"> 
                                <div class="table-responsive"> 
                                  <table class="form-inline table d4m-common-table table-hover table-bordered table-striped" >
                                    <tr><th colspan="3"><?php echo $label_language_values['nexmo_sms_setting'];?></th></tr>
                                    <tbody>
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_api_key'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="d4m_nexmo_api_key" class="form-control" value="<?php echo $setting->d4m_nexmo_api_key;?>" name="d4m_nexmo_api_key" size="70" />
                                          </div>  
                                          <label for="myplivo_account_sid" generated="true" class="error" style="display: none;"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_api_secret'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="password" id="d4m_nexmo_api_secret" class="form-control" value="<?php echo $setting->d4m_nexmo_api_secret;?>" name="d4m_nexmo_api_secret" size="70" />
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="myplivo_auth_token" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_from'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="d4m_nexmo_from" class="form-control" value="<?php echo $setting->d4m_nexmo_from;?>" name="d4m_nexmo_from" size="70" />
                                          </div>  
                                          <label for="myplivo_sender_number" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                    
                                    <tbody>
                                    
                                    
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_status'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-client-status-plivo" for="d4m_nexmo_status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_nexmo_status == "Y"){echo "checked";}else{echo "";}?> id="d4m_nexmo_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                           <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_send_sms_to_client_status'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-admin-status-plivo" for="d4m_sms_nexmo_send_sms_to_client_status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_nexmo_send_sms_to_client_status == "Y"){echo "checked";}else{echo "";}?> id="d4m_sms_nexmo_send_sms_to_client_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>  
                                        </td>
                                      </tr>
                                      <tr>
                                      <td><label><?php echo $label_language_values['nexmo_send_sms_to_admin_status'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-admin-status-plivo" for="d4m_sms_nexmo_send_sms_to_admin_status">
                                            <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_nexmo_send_sms_to_admin_status == "Y"){echo "checked";}else{echo "";}?> id="d4m_sms_nexmo_send_sms_to_admin_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>
                                        </td>
                                        
                                      </tr>
                                      <tr>
                                      <td><label><?php echo $label_language_values['send_sms_to_staff'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-staff-status-plivo" for="d4m_sms_nexmo_send_sms_to_staff_status">
                                            <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->d4m_sms_nexmo_send_sms_to_staff_status == "Y"){echo "checked";}else{echo "";}?> id="d4m_sms_nexmo_send_sms_to_staff_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>
                                        </td>                                       
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['nexmo_admin_phone_number'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                          <div class="input-group">
                                            <span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
                                            <input type="text" id="d4m_sms_nexmo_admin_phone_number" class="form-control" value="<?php echo $setting->d4m_sms_nexmo_admin_phone_number;?>" name="d4m_sms_nexmo_admin_phone_number" size="70" />
                                          </div>
                                          </div>                                        
                                        </td>
                                          
                                          <label for="d4m_sms_nexmo_admin_phone_number" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"></td><td id="hr"></td><td id="hr"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>  
                                
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default d4m-sms-gateway">
                              <div class="panel-heading">
                                <h4 class="panel-title"><span><?php echo $label_language_values['textlocal_sms_gateway'];?></span><img class="d4ma-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/textlocal-logo.png" />
                                  <div class="d4m-enable-disable-right pull-right">
                                    <label class="d4moggle-sms-noti-plivo" for="sms-noti-textlocal">
                                      <input class='d4ma-toggle-checkbox' data-toggle="toggle"  <?php  if($setting->d4m_sms_textlocal_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-textlocal" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                    </label>
                                  </div>
                                </h4>
                              </div>
                              <div <?php  if($setting->d4m_sms_textlocal_status == "Y"){?> style="display:block;" <?php  }?>  id="collapseOne" class="panel-collapse collapse mycollapse_sms-noti-textlocal">
                                <div class="panel-body p-10">
                                  <table class="form-inline table d4m-common-table table-hover table-bordered table-striped">
                                    <tr><th colspan="3"><?php echo $label_language_values['textlocal_account_settings'];?></th></tr>
                                    <tbody>
                                      <tr>
                                        <td><label><?php echo $label_language_values['account_username'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="text" id="mytextlocal_username" class="form-control" value="<?php echo $setting->d4m_sms_textlocal_account_username;?>" name="mytextlocal_username" size="70" />
                                          </div>
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['email_id_registered_with_you_textlocal'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="mytextlocal_username" generated="true" class="error" style="display: none;"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['account_hash_id'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <input type="password" id="mytextlocal_account_hash_id" class="form-control" value="<?php echo $setting->d4m_sms_textlocal_account_hash_id;?>" name="mytextlocal_account_hash_id" size="70" />
                                          </div>
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['hash_id_provided_by_textlocal'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                          <label for="mytextlocal_account_hash_id" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                      </tr>
                                    </tbody>
                                    <tbody>
                                      <th colspan="3"><?php echo $label_language_values['textlocal_sms_settings'];?></th>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-client-status" for="d4m-sms-reminder-client-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_sms_textlocal_send_sms_to_client_status') == "Y"){echo "checked";}else{echo "";}?> id="d4m-textlocal-sms-reminder-client-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-admin-status" for="d4m-sms-reminder-admin-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_sms_textlocal_send_sms_to_admin_status') == "Y"){echo "checked";}else{echo "";}?> id="d4m-textlocal-sms-reminder-admin-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_admin_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['send_sms_to_staff'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group">
                                            <label class="d4moggle-d4m-sms-reminder-staff-status" for="d4m-sms-reminder-staff-status">
                                              <input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_sms_textlocal_send_sms_to_staff_status') == "Y"){echo "checked";}else{echo "";}?> id="d4m-textlocal-sms-reminder-staff-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                          </div>
                                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_staff_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                      </tr>
                                      <tr>
                                        <td><label><?php echo $label_language_values['admin_phone_number'];?></label></td>
                                        <td colspan="2">
                                          <div class="form-group d4m-lgf">
                                            <div class="input-group">
                                              <span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
                                              <input type="text" id="d4m_sms_textlocal_admin_phone" class="form-control" value="<?php echo $setting->d4m_sms_textlocal_admin_phone;?>" name="d4m_sms_textlocal_admin_phone" size="70" />
                                            </div>
                                          </div>
                                          <label for="d4m_sms_textlocal_admin_phone" generated="true" class="error"></label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                        <td id="hr"/>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        <a id="btnsave_sms_service" name="" class="btn btn-success mt-20 ml-10" ><?php echo $label_language_values['save_sms_settings'];?></a>
                      </div><!-- panel body end -->
                    </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        
        <div class="tab-pane fade in" id="sms-template">
          <div class="d4m-sms-template-panel panel panel-default wf-100">
            <div class="panel-heading">
              <h1 class="panel-title"><?php echo $label_language_values['sms_template_settings'];?></h1>
            </div>
            <!-- Client email templates -->
            <ul class="nav nav-tabs nav-justified">
              <li class="ad4mive"><a data-toggle="tab" href="#client-sms-template"><?php echo $label_language_values['client_sms_templates'];?></a></li>
              <li><a data-toggle="tab" href="#admin-sms-template"><?php echo $label_language_values['admin_sms_template'];?></a></li>
              <li><a data-toggle="tab" href="#staff-sms-template">Staff SMS Template</a></li>
              
            </ul>
            <div class="tab-content">
              <div id="client-sms-template" class="tab-pane fade in ad4mive">
                <h3><?php echo $label_language_values['client_sms_templates'];?></h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                                        <?php 
                                            $readall_client_sms_template=$sms_template->readall_client_sms_template();
                                        while($client_template = @mysqli_fetch_array($readall_client_sms_template))
                                        {
                                            ?>
                                            <li class="panel panel-default d4m-client-sms-panel" >
                                                <div class="panel-heading br-2">
                                                    <h4 class="panel-title">
                                                        <div class="d4ma-col11">
                                                            <div class="pull-left">
                                                                <div class="d4m-yes-no-sms-right pull-left">
                                                                    <label for="sms-client<?php  echo $client_template['id'];?>">
                                    <input class="save_client_sms_template_status" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($client_template['sms_template_status']=='E'){echo "checked";} else { echo ""; } ?> data-id="<?php echo $client_template['id'];?>" id="sms-client<?php  echo $client_template['id'];?>" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                    
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <span class="d4m-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$client_template['sms_subjed4m']))]; ?></span>
                                                        </div>
                                                        <div class="pull-right d4ma-col1">
                                                            <div class="pull-right">
                                                                <div class="d4m-show-hide pull-right">
                                                                    <input type="checkbox" name="d4m-show-hide" 
                                  class="d4m-show-hide-checkbox d4m_show_hide_checkbox" id="cm<?php  echo $client_template['id'];?>" data-id="<?php echo $client_template['id']; ?>"><!--Added Serivce Id-->
                                                                    <label class="d4m-show-hide-label" for="cm<?php  echo $client_template['id'];?>"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </h4>
                                                </div>
                                                <div id="detail_sms_template_<?php  echo $client_template['id'];?>" class="panel-collapse collapse sms_content detail_cm<?php  echo $client_template['id'];?> sms_template_detail"  >
                                                    <div class="panel-body p-10">
                                                        <div class="d4m-sms-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                                                            <form id="sms_template_form_<?php  echo $client_template['id'];?>" method="post" type="" class="slide-toggle" >
                                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                                    <textarea class="form-control" name="sms_message" id="sms_message_<?php  echo $client_template['id'];?>" cols="50" rows="20" placeholder="Add here your message for sms"><?php if($client_template['sms_message'] != ''){ echo base64_decode($client_template['sms_message']); }else{ echo base64_decode($client_template['default_message']); } ?></textarea>
                                  
                                  <a id="save_sms_template" name="" data-id="<?php echo $client_template['id'];?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                                  <a id="default_sms_contents" name="" data-id="<?php echo $client_template['id'];?>" class="btn btn-primary d4m-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="d4m-sms-content-tags">
                                                                        <b><?php echo $label_language_values['tags'];?></b><br>
                                                                   <!--  <a href="javascript:void(0);" data-id="<?php /* echo $client_template['id']; */ ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php /* echo $label_language_values['booking_date']; */ ?>}}</a><br /> -->
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_promocode}}">{{<?php //echo $label_language_values['client_promocode'];?>client_promocode}}</a><br />
                                  
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php  /* <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                                                    </div>
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php 
                                        }
                                        ?>
                  </ul>
                </div>
              </div>
              <div id="admin-sms-template" class="tab-pane fade">
                <h3><?php echo $label_language_values['admin_sms_template'];?></h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                                            <?php 
                                            $readall_admin_sms_template=$sms_template->readall_admin_sms_template();
                                            while($admin_template = @mysqli_fetch_array($readall_admin_sms_template))
                                            {
                                                ?>
                                                <li class="panel panel-default d4m-admin-sms-temp-panel" >
                                                    <div class="panel-heading br-2">
                                                        <h4 class="panel-title">
                                                            <div class="d4ma-col11">
                                                                <div class="pull-left">
                                                                    <div class="d4m-yes-no-sms-right pull-left">
                                                                        <label for="sms-admin<?php  echo $admin_template['id'];?>">
                                      <input class='save_admin_sms_template_status' data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $admin_template['id'];?>" type="checkbox" name="" <?php  if($admin_template['sms_template_status']=='E'){echo "checked";}else{echo "";}?> id="sms-admin<?php  echo $admin_template['id'];?>" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                      
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <span class="d4m-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$admin_template['sms_subjed4m']))]; ?></span>
                                                            </div>
                                                            <div class="pull-right d4ma-col1">
                                                                <div class="pull-right">
                                                                    <div class="d4m-show-hide pull-right">
                                                                        <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox d4m_show_hide_checkbox" id="as<?php  echo $admin_template['id'];?>" data-id="<?php echo $admin_template['id']; ?>">
                                                                        <label class="d4m-show-hide-label" for="as<?php  echo $admin_template['id'];?>"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="detail_sms_template_<?php  echo $admin_template['id'];?>" class="panel-collapse collapse sms_content detail_as<?php  echo $admin_template['id'];?> sms_template_detail_admin">
                                                        <div class="panel-body p-10">
                                                            <div class="d4m-sms-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                                                                <form id="sms_template_form_<?php  echo $admin_template['id'];?>" method="post" type="" class="slide-toggle" >
                                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                                        <textarea class="form-control" name="sms_message" id="sms_message_<?php  echo $admin_template['id'];?>" cols="50" rows="20" placeholder="Add here your message"><?php if($admin_template['sms_message'] != ''){ echo base64_decode($admin_template['sms_message']); }else{ echo base64_decode($admin_template['default_message']); } ?></textarea>
                                    <a id="save_sms_template" name="" data-id="<?php echo $admin_template['id'];?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                                    <a id="default_sms_contents" name="" data-id="<?php echo $admin_template['id'];?>" class="btn btn-primary d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <div class="d4m-sms-content-tags">
                                                                            <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_promocode}}">{{<?php //echo $label_language_values['client_promocode'];?>client_promocode}}</a><br />
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php  /* <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php 
                                            }
                                            ?>

                  </ul>

                </div>
              </div>
              
              <div id="staff-sms-template" class="tab-pane fade">
                <h3>Staff SMS Template</h3>
                <div id="accordion" class="panel-group">
                  <ul class="nav nav-tab nav-stacked">
                                            <?php 
                                            $readall_staff_sms_template=$sms_template->readall_staff_sms_template();
                                            while($staff_template = @mysqli_fetch_array($readall_staff_sms_template))
                                            {
                                                ?>
                                                <li class="panel panel-default d4m-staff-sms-temp-panel" >
                                                    <div class="panel-heading br-2">
                                                        <h4 class="panel-title">
                                                            <div class="d4ma-col11">
                                                                <div class="pull-left">
                                                                    <div class="d4m-yes-no-sms-right pull-left">
                                                                        <label for="sms-staff<?php  echo $staff_template['id'];?>">
                                      <input class='save_staff_sms_template_status' data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $staff_template['id'];?>" type="checkbox" name="" <?php  if($staff_template['sms_template_status']=='E'){echo "checked";}else{echo "";}?> id="sms-staff<?php  echo $staff_template['id'];?>" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
                                      
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <span class="d4m-template-name"><?php echo $staff_template['sms_subjed4m']; ?></span>
                                                            </div>
                                                            <div class="pull-right d4ma-col1">
                                                                <div class="pull-right">
                                                                    <div class="d4m-show-hide pull-right">
                                                                        <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox d4m_show_hide_checkbox" id="as<?php  echo $staff_template['id'];?>" data-id="<?php echo $staff_template['id']; ?>">
                                                                        <label class="d4m-show-hide-label" for="as<?php  echo $staff_template['id'];?>"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="detail_sms_template_<?php  echo $staff_template['id'];?>" class="panel-collapse collapse sms_content detail_as<?php  echo $staff_template['id'];?> sms_template_detail_admin">
                                                        <div class="panel-body p-10">
                                                            <div class="d4m-sms-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                                                                <form id="sms_template_form_<?php  echo $staff_template['id'];?>" method="post" type="" class="slide-toggle" >
                                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                                        <textarea class="form-control" name="sms_message" id="sms_message_<?php  echo $staff_template['id'];?>" cols="50" rows="20" placeholder="Add here your message"><?php if($staff_template['sms_message'] != ''){ echo base64_decode($staff_template['sms_message']); }else{ echo base64_decode($staff_template['default_message']); } ?></textarea>
                                    <a id="save_sms_template" name="" data-id="<?php echo $staff_template['id'];?>" class="btn btn-success d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
                                    <a id="default_sms_contents" name="" data-id="<?php echo $staff_template['id'];?>" class="btn btn-primary d4m-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <div class="d4m-sms-content-tags">
                                                                            <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{contad4m_status}}">{{<?php echo $label_language_values['contad4m_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_promocode}}">{{<?php //echo $label_language_values['client_promocode'];?>client_promocode}}</a><br />
                                  
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{rejed4m_status}}">{{<?php echo $label_language_values['rejed4m_status'];?>}}</a><br />
                                  
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php  /* <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{staff_email}}">{{staff_email}}</a><br />
                                  <a href="javascript:void(0);" data-id="<?php echo $staff_template['id']; ?>" class="tags sms_short_tags" data-value="{{staff_name}}">{{staff_name}}</a><br />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php 
                                            }
                                            ?>

                  </ul>

                </div>
              </div>
              
            </div>
          </div>
        </div>
      <!-----recurrence booking start---->
      <div class="tab-pane fade in" id="recurrence-booking">
        <div class="panel panel-default">
          <div class="panel-heading d4ma-top-right">
            <h1 class="panel-title"><?php     echo $label_language_values['Recurrence_booking'];?></h1>
          </div>
          <div class="panel-body pt-50 plr-10">
            <?php    $show_reccurence_div = "none"; ?>
            <div class="table-responsive">
              <table class="form-inline d4m-common-table">
                <tbody>
                  <tr>
                    <td><label><?php echo $label_language_values['Recurrence_booking'];?></label></td>
                    <td>
                      <div class="form-group">
                        <label class="d4moggle-postal-code"  for="show_company_logo_header">
                          <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_recurrence_booking_status') == "Y") { echo "checked"; $show_reccurence_div = "block"; } ?>  id="d4m_recurrence_booking_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                        </label>
                      </div>
                    </td>
                    <?php         
                    if($setting->get_option('d4m_stripe_payment_form_status') == "on"){
                    $plans_on_stripe_d = "none";
                    if($setting->get_option('d4m_recurrence_booking_status') == "Y") {$plans_on_stripe_d = "initial";}
                    ?>
                    <td class="plans_on_stripe_labels" ><label><?php echo $label_language_values['plans_on_stripe'];?></label></td>
                    <td class="plans_on_stripe_div">
                      <div class="form-group">
                        <label class="d4moggle-postal-code"  for="show_company_logo_header">
                          <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_stripe_create_plan') == "Y") { echo "checked";} ?>  id="d4m_stripe_create_plan" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                        </label>
                      </div>
                    </td>
                    <?php         
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-lg-12 col-xs-12 reccurence_div" style="display: <?php     echo $show_reccurence_div; ?>">
              <div class="tab-content d4m-settings-frequently-discount-details">
                <div class="tab-pane ad4mive col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button id="d4m-add-reccurence" class="btn btn-success float-right mb-15"><i class="fa fa-plus"></i><?php echo $label_language_values['add_recurrence'];?></button>
                  <div id="accordion" class="panel-group">
                    <ul class="nav nav-tab nav-stacked" id="sortable-frequently-discount" >   <!-- frequently-discount-services -->
                      <?php 
                      $getalldis = $objfrequently->readall();
                      while($getdata = @mysqli_fetch_array($getalldis)){
                        ?>
                        <li class="panel panel-default d4m-frequently-discount-panel" >
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <div class="d4ma-col8">
                                  <span class="d4m-frequently-discount-panel-title-name"><?php echo $getdata['discount_typename'];?></span>
                              </div>
                              <div class="pull-right d4ma-col4">
                                <div class="d4ma-col4">
                                  <label class="d4moggle-frequently-discount" for="sevice-endis-<?php echo $getdata['id'];?>">
                                    <input class="myfrequentlydiscount_status" data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $getdata['id'];?>" <?php  if($getdata['status']=='E'){ echo "checked";}else{ echo ""; }?> id="sevice-endis-<?php echo $getdata['id'];?>" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                  </label>
                                </div>
                                <?php       if($getdata["id"] != 1){
                                $objfrequently->id = $getdata["id"];
                                $count_id = $objfrequently->count_rec_id_in_payment();
                                ?>
                                <div class="d4ma-col4">
                                  <?php        
                                  if($count_id == 0){
                                  ?>
                                  <a class="pull-right btn-circle btn-danger btn-sm" data-toggle="popover_reccurence" rel="popover" data-placement="left" title="<?php echo $label_language_values['delete_this_recurrence'];?>"> <i class="fa fa-trash"></i></a>
                                  <div id="popover-delete-reccurence" style="display: none;">
                                    <div class="arrow"></div>
                                    <table class="form-horizontal" cellspacing="0">
                                      <tbody>
                                      <tr>
                                        <td>
                                          <a data-reccurence_id="<?php echo $getdata['id'];?>" value="Delete" class="btn btn-danger btn-sm reccurence-delete-button" ><?php echo $label_language_values['yes'];?></a>
                                          <button id="d4m-close-popover-delete-reccurence" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
                                        </td>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <?php      
                                  }else{
                                    ?>
                                    <a class="pull-right btn-circle btn-danger btn-sm"> <i class="fa fa-ban"></i></a>
                                    <?php       
                                  }
                                  ?>
                                </div>
                                <?php        } ?>
                                <div class="pull-right">
                                  <div class="d4m-show-hide pull-right">
                                    <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox" id="spss<?php  echo $getdata['id'];?>" ><!--Added Serivce Id-->
                                    <label class="d4m-show-hide-label" for="spss<?php  echo $getdata['id'];?>"></label>
                                  </div>
                                </div>
                              </div>
                            </h4>
                          </div>
                          <div id="detailspss<?php  echo $getdata['id'];?>" class="frequently-discount_detail panel-collapse collapse fdd_details">
                            <div class="panel-body p-10">
                              <div class="d4m-frequently-discount-collapse-div col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <form id="freq_discount_form<?php  echo $getdata['id'];?>" method="post" type="" class="slide-toggle" >
                                  <?php       if($getdata["id"] != 1){   ?>
                                  <table class="form-inline d4m-common-table d4m-create-frequently-discount-table">
                                    <tbody>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_name'];?></td>
                                      <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control txtfreqname<?php  echo $getdata['id'];?>" id="txtfreqname<?php  echo $getdata['id'];?>" name="txtfreqnamename<?php  echo $getdata['id'];?>" value="<?php echo $getdata['discount_typename'];?>" placeholder="<?php echo $label_language_values['weekly'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_label'];?></td>
                                      <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control txtfreqlabel<?php  echo $getdata['id'];?>" id="txtfreqlabel<?php  echo $getdata['id'];?>" name="txtfreqlabelname<?php  echo $getdata['id'];?>" value="<?php echo $getdata['labels'];?>" placeholder="<?php echo $label_language_values['save_12_5'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_days'];?></td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control txtfreqdays<?php  echo $getdata['id'];?>" name="txtfreqdaysname<?php  echo $getdata['id'];?>" id="txtfreqdaysid<?php  echo $getdata['id'];?>" placeholder="<?php echo $label_language_values['days'];?>" value="<?php echo $getdata['days'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_discount_type'];?></td>
                                      <td>
                                        <div class="form-group">
                                          <seled4m name="" id="txtfreqtype<?php  echo $getdata['id'];?>" class="seled4mpicker " data-size="3"  style="display: none;">
                                              <option value="P" <?php  if($getdata['d_type'] == 'P'){ echo "seled4med" ; }?>><?php echo $label_language_values['percentage'];?></option>
                                              <option value="F" <?php  if($getdata['d_type'] == 'F'){ echo "seled4med" ; }?>><?php echo $label_language_values['flat'];?></option>
                                          </seled4m>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_discount_value'];?></td>
                                      <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control txtfreqvalue<?php  echo $getdata['id'];?>" name="txtfreqvaluename<?php  echo $getdata['id'];?>" id="txtfreqvalueid<?php  echo $getdata['id'];?>" value="<?php echo $getdata['rates'];?>" placeholder="<?php echo $label_language_values['value'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                      <td>
                                        <a data-id="<?php echo $getdata['id'];?>" name="" id="" class="btn btn-success d4m-btn-width btnupdaterecurrence" ><?php echo $label_language_values['update'];?></a>
                                      </td>
                                    </tr>
                                    </tbody>
                                  </table>
                                  <?php      }else{
                                    ?>
                                    <table class="form-inline d4m-common-table d4m-create-frequently-discount-table">
                                    <tbody>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_name'];?></td>
                                      <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control txtfreqname<?php  echo $getdata['id'];?>" id="txtfreqname<?php  echo $getdata['id'];?>" name="txtfreqnamename<?php  echo $getdata['id'];?>" value="<?php echo $getdata['discount_typename'];?>" placeholder="<?php echo $label_language_values['weekly'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $label_language_values['recurrence_label'];?></td>
                                      <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control txtfreqlabel<?php  echo $getdata['id'];?>" id="txtfreqlabel<?php  echo $getdata['id'];?>" name="txtfreqlabelname<?php  echo $getdata['id'];?>" value="<?php echo $getdata['labels'];?>" placeholder="<?php echo $label_language_values['save_12_5'];?>" /><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <td></td>
                                      <td>
                                        <a data-id="<?php echo $getdata['id'];?>" name="" id="" class="btn btn-success d4m-btn-width btnupdaterecurrence_once" ><?php echo $label_language_values['update'];?></a>
                                      </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <?php    } ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </li>
                      <?php 
                      }
                      ?>
                      <li class="panel panel-default d4m-frequently-discount-panel add_rec_li" style="display: none;" >
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <div class="d4ma-col8">
                              <span class="d4m-frequently-discount-panel-title-name"></span>
                            </div>
                            <div class="pull-right d4ma-col4">
                              <div class="d4ma-col4"></div>
                              <div class="pull-right">
                                <div class="d4m-show-hide pull-right">
                                  <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox" id="spssadd" ><!--Added Serivce Id-->
                                  <label class="d4m-show-hide-label" for="spssadd"></label>
                                </div>
                              </div>
                            </div>
                          </h4>
                        </div>
                        <div id="detailspssadd" class="frequently-discount_detail panel-collapse collapse fdd_details">
                          <div class="panel-body p-10">
                            <div class="d4m-frequently-discount-collapse-div col-sm-12 col-md-12 col-lg-12 col-xs-12">
                              <form id="freq_discount_formadd" method="post" type="" class="slide-toggle" >
                                <table class="form-inline d4m-common-table d4m-create-frequently-discount-table">
                                  <tbody>
                                  <tr>
                                    <td><?php echo $label_language_values['recurrence_name'];?></td>
                                    <td>
                                      <div class="form-group">
                                          <input type="text" class="form-control txtfreqnameadd" id="txtfreqnameadd" name="txtfreqnamenameadd" placeholder="<?php echo $label_language_values['weekly'];?>" /><br />
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $label_language_values['recurrence_label'];?></td>
                                    <td>
                                      <div class="form-group">
                                        <input type="text" class="form-control txtfreqlabeladd" id="txtfreqlabeladd" name="txtfreqlabelnameadd" placeholder="<?php echo $label_language_values['save_12_5'];?>" /><br />
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $label_language_values['recurrence_days'];?></td>
                                    <td>
                                      <div class="form-group">
                                        <input type="text" class="form-control txtfreqdaysadd" name="txtfreqdaysnameadd" id="txtfreqdaysidadd" placeholder="<?php echo $label_language_values['days'];?>" /><br />
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $label_language_values['recurrence_discount_type'];?></td>
                                    <td>
                                      <div class="form-group">
                                        <seled4m name="" id="txtfreqtypeadd" class="seled4mpicker" style="display: none;">
                                          <option value="P"><?php echo $label_language_values['percentage'];?></option>
                                          <option value="F"><?php echo $label_language_values['flat'];?></option>
                                        </seled4m>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $label_language_values['recurrence_discount_value'];?></td>
                                    <td>
                                      <div class="form-group">
                                        <input type="text" class="form-control txtfreqvalueadd" name="txtfreqvaluenameadd" id="txtfreqvalueidadd" placeholder="<?php echo $label_language_values['value'];?>" /><br />
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                  <td></td>
                                    <td>
                                      <a class="btn btn-success d4m-btn-width btnaddreccurence" ><?php echo $label_language_values['save'];?></a>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </form>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-----recurrence booking End---->
            <div class="tab-pane fade in" id="promocode">
               <!-- <form id="form_promo_code" method="post" type="" class="d4m-promocode" >-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title"><?php echo $label_language_values['promocode_header'];?></h1>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="promocode-list-li ad4mive"><a data-toggle="tab" href="#promocode-list"><?php echo $label_language_values['promocodes'];?></a></li>
                            <li class="add_promocode"><a data-toggle="tab" href="#add-new-promocode"><?php echo $label_language_values['add_new'];?></a></li>
                            <li id="update-promocode" class="d4m-update-promocode-li hide-div"><a data-toggle="tab" class="d4m-update-promocode" href="#"><?php echo $label_language_values['update_promocode'];?></a></li>
              <li class="special_offer"><a data-toggle="tab" href="#special_offer"><?php echo $label_language_values['d4m_special_offer'];?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="promocode-list" class="tab-pane fade in ad4mive edit_form_for_coupon">
                                <h3><?php echo $label_language_values['promocodes_list'];?></h3>
                                <div class="table-responsive">
                                    <table id="d4m-promocode-list" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th><?php echo $label_language_values['coupon'];?> #</th>
                                            <th><?php echo $label_language_values['coupon_code'];?></th>
                                            <th><?php echo $label_language_values['coupon_type'];?></th>
                                            <th><?php echo $label_language_values['coupon_limit'];?></th>
                                            <th><?php echo $label_language_values['coupon_used'];?></th>
                                            <th><?php echo $label_language_values['coupon_value'];?></th>
                                            <th><?php echo $label_language_values['expiry_date'];?></th>
                                            <th><?php echo $label_language_values['ad4mions'];?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $allpromocode = $promo->readall();
                                        $cp = 1;
                                        while($row = @mysqli_fetch_array($allpromocode)) {
                                            if($row['coupon_type']=='P')
                                            {
                                                $coupon_type="Percentage";
                                            } else {
                                                $coupon_type="Flat";
                                            }
                                            ?>
                                            <tr id="coupondata_row<?php  echo $row['id']; ?>">
                                                <td><?php echo $cp; ?></td>
                                                <td><?php echo $row['coupon_code']; ?></td>
                                                <td><?php echo $coupon_type; ?></td>
                                                <td><?php echo $row['coupon_limit']; ?></td>
                                                <td><?php echo $row['coupon_used']; ?></td>
                                                <td><?php echo $row['coupon_value']; ?></td>
                                                <td><?php echo str_replace($english_date_array,$seled4med_lang_label,date($getdateformat,strtotime($row['coupon_expiry']))); ?></td>
                                                <td>
                                                    <a href="#update-promocode-form<?php  echo $row['id']; ?>"
                                                       data-id="<?php echo $row['id']; ?>"
                                                       data-toggle="tab"
                                                       class="btn-circle btn-info btn-xs d4m-edit-coupon"
                                                       title="<?php echo $label_language_values['edit_coupon_code'];?>">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>

                                                    <a id="d4m-delete-promocode"
                                                       data-toggle="popover"
                                                       class="pull-right btn-circle btn-danger btn-xs delete-promocode"
                                                       data-id="<?php echo $row['id']; ?>"
                                                       rel="popover"
                                                       data-placement="left"
                                                       title="<?php echo $label_language_values['delete_promocode'];?>">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <div id="popover-delete-promocode<?php  echo $row['id']; ?>" style="display: none;">
                                                        <div class="arrow"></div>
                                                        <table class="form-horizontal" cellspacing="0">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a id="promodata_delete" data-id="<?php echo $row['id'];?>" value="Delete" class="btn btn-danger mybtndeletepromocode" ><?php echo $label_language_values['yes'];?></a>
                                                                    <a id="d4m-close-popover-delete-promocode" class="btn btn-default" ><?php echo $label_language_values['cancel'];?></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cp++; }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="add-new-promocode" class="tab-pane fade">
                                <h3><?php echo $label_language_values['add_new_promocode'];?></h3>
                               <!-- <form id="" method="post" type="" class="d4m-promocode" >-->
                  <form id="form_promo_code" method="post" type="" class="d4m-promocode" >
                                    <div class="table-responsive">
                                        <table class="form-inline d4m-common-table">
                                            <tbody>
                                            <tr>
                                                <td><?php echo $label_language_values['coupon_code'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="" placeholder="<?php echo $label_language_values['coupon_code'];?>" /><br />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['coupon_type'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <seled4m name="coupon_type" id="coupon_type" class="seled4mpicker" data-size="3"  style="display: none;">
                                                            <option value="P"><?php echo $label_language_values['percentage'];?></option>
                                                            <option value="F"><?php echo $label_language_values['flat'];?></option>
                                                        </seled4m>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['value'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="coupon_value" id="coupon_value" value="" placeholder="<?php echo $label_language_values['value'];?>" />
                            <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['limit'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="coupon_limit" id="coupon_limit" value="" placeholder="<?php echo $label_language_values['coupon_limit'];?>" />
                            <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_limit'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['expiry_date'];?></td>
                                                <td>
                                                    <div class="form-group input-group">
                                                        <input class="form-control exp_cp_date" name="coupon_expiry_date" id="expiry_date" data-date-format="yyyy/mm/dd" data-provide="datepicker"  readonly="readonly" />
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    
                                                    </div>
                          <label for="expiry_date" style="display:none" generated="true" class="error"></label>
                          <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_date'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    
                                                </td>
                                            </tr>

                                           
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <a id="promo_code" name="promo_code" class="btn btn-success mt-20" ><?php echo $label_language_values['create'];?></a>
                                                </td>
                                            </tr>
                                            
                                            </tbody>

                                        </table>
                                    </div>
                                </form>
                            </div>
        <div id="special_offer" class="tab-pane fade">
          <form id="special_offer_form">
            <div>
              <div class="col-xs-12">
                <label class="col-xs-5 col-md-2 mt-36"><?php echo $label_language_values['d4m_special_offer'];?></label>
                  <?php 
                    $chkbx="";
                    $nnn="none";
                    $txtvl="";
                    if($setting->get_option("d4m_special_offer") == "Y"){
                      $chkbx="checked";
                      $nnn="block";
                      $txtvl=$setting->get_option("d4m_special_offer_text");
                    }
                  ?>
                <label class="d4moggle-tax-vat mt-30 col-xs-7 col-md-10 special_offer_check" for="special_offer_check">
                  <input class="d4ma-toggle-checkbox1" data-toggle="toggle" data-size="small" type='checkbox' name="special_offer_check" <?php  /* if($setting->d4m_special_offer=='Y'){echo 'checked';} */ ?> id="special_offer_check" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' <?php  echo $chkbx; ?>      />
                </label>
              </div>
              <div style="display:<?php echo $nnn; ?>;" class="form-inline d4m-common-table promocode_text col-xs-12">
                <label class="col-xs-5 col-md-2 mt-36"><?php echo $label_language_values['d4m_special_offer_text'];?></label>
                <label class="col-xs-7 col-md-10 mt-30">
                  <div class="form-group">
                    <ul class="d4m-radio-list">
                      
                      <li class="d4m-tax-vat-input-container">
                        <input type="text" name="special_text" required style="width: 400px;" class="form-control" id="special_text" name="special_text" value="<?php  echo $txtvl;?>"><br />
                      </li>
                    </ul>
                  </div>
                </label>
              </div>
            </div>
            <div class="col-xs-3 col-md-3 mt-20" style="margin-left:15px;">
              <a id="specail_offer_setting"  name="specail_offer_setting" class="btn btn-success specail_offer_setting" ><?php echo $label_language_values['save_setting'];?></a>
            </div>
          </form>
       </div>
                            <?php 
                            $readcp=$promo->readall();
                            while($rowcp = @mysqli_fetch_array($readcp)){
                                ?>
                                <div id="update-promocode-form<?php  echo $rowcp['id'];?>" class="tab-pane fade update-promocode-new">
                                    <h3><?php echo $label_language_values['update_promocode'];?></h3>
                                    <form id="update_promo_formss<?php  echo $rowcp['id'];?>" method="post" type="" class="" >
                                        <div class="table-responsive">
                                            <table class="form-inline d4m-common-table">
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $label_language_values['coupon_code'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" id="recordid" value="<?php echo $rowcp['coupon_code']; ?>">
                                                            <input type="text" class="form-control" id="edit_coupon_code<?php  echo $rowcp['id'];?>" name="coupon_code<?php  echo $rowcp['id'];?>" value="<?php echo $rowcp[1]; ?>" placeholder="<?php echo $label_language_values['coupon_code'];?>" /><br />
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['coupon_type'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <seled4m name="coupon_type" id="edit_coupon_type<?php  echo $rowcp['id'];?>" class="seled4mpicker" data-size="3"  style="display: none;">
                                                                <option value="P" <?php  if($rowcp['coupon_type']=='P') {echo "seled4med";} ?>><?php echo $label_language_values['percentage'];?></option>
                                                                <option value="F"<?php if($rowcp['coupon_type']=='F') {echo "seled4med";} ?>><?php echo $label_language_values['flat'];?></option>
                                                            </seled4m>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td><?php echo $label_language_values['value'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="edit_value<?php  echo $rowcp['id'];?>" name="valuessd<?php  echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_value']; ?>" placeholder="<?php echo $label_language_values['value'];?>" /><br />
                                                        </div>
                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                 4                   </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['limit'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="edit_limit<?php  echo $rowcp['id'];?>" class="form-control" name="limit<?php  echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_limit']; ?>" placeholder="<?php echo $label_language_values['coupon_limit'];?>" /><br />
                                                        </div>
                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_limit'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['expiry_date'];?></td>
                                                    <td>
                                                        <div class="form-group input-group">
                                                            <input class="form-control exp_cp_date" id="edit_expiry_date<?php  echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_expiry']; ?>" data-date-format="yyyy/mm/dd"
                                                                   data-provide="datepicker" readonly="readonly" />
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_date'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <a data-id="<?php echo $rowcp['id'];?>" id="edit_form_data" name="edit_form" class="btn btn-success mybtnupdatepromocode" type="submit"><?php echo $label_language_values['update'];?></a>
                                                    </td>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </form>

                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                <!--</form>-->
            </div>

            <div class="tab-pane fade in" id="referal_settings">
              <!-- <form id="form_promo_code" method="post" type="" class="d4m-promocode" >-->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h1 class="panel-title">Referral code</h1>
                </div>
                <div class="tab-content">
                  <div id="promocode-list" class="tab-pane fade in ad4mive edit_form_for_coupon">
                    <h3 class="pl-30">Referral Details</h3>
                  </div>
                  <div id="referal">
                    <div class="form-group col-xs-12">
                      <label class="pl-15"> Referral Code Status:</label>
                      <label class="d4moggle-tax-vat pl-30" for="tax-vat">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_referral_status=='Y'){echo 'checked';}?> id="refer" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                        </label>
                        <div class="hide-div mycollapse_refer" <?php  if($setting->d4m_referral_status=='Y'){echo 'style="display:block;"';}?>>

                          <div class="d4m-custom-radio col-xs-12">
                            <label class="form-label">Refferal code value</label>
                            <ul class="d4m-radio-list">
                              <li class="d4m-refer-input-container">
                                <input type="text" class="form-control" name="d4m_referral_value" id="d4m_referral_value" value="<?php echo ($setting->d4m_referral_value); ?>" size="3" maxlength="5" />
                                <i class="d4m-tax-percent <?php  if($setting->d4m_referral_type=='P'){echo 'fa fa-percent';}?>"></i>
                              </li>
                            </ul>
                          </div>

                          <div class="d4m-custom-radio col-xs-12">
                            <label class="pb-6">Refer code value</label>
                            <ul class="d4m-radio-list">
                              <li class="d4m-refer-input-container">
                                <input type="text" class="form-control" name="d4m_refs_value" id="d4m_refs_value" value="<?php echo ($setting->d4m_refs_value); ?>" size="3" maxlength="5" />
                              </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="col-xs-3" style="margin-left:15px;">
                    <a id="referral_setting"  name="referral_setting" class="btn btn-success referral_setting" ><?php echo $label_language_values['save_setting'];?></a>
                    </div>
                  </div>
                </div>
              </div>
              <!--</form>-->
            </div>



            <!-- LABELS -->
            <div class="tab-pane fade in" id="labels">
              <!--<form id="d4m-labels-settings" method="post" type="" class="d4m-labels-settings" >-->
              <div class="panel panel-default">
                <div class="panel-heading d4ma-top-right">
                  <h1 class="panel-title"><?php echo $label_language_values['labels_settings'];?></h1>
                </div>
                  <div class="panel-body pt-50 plr-10">
                    <table class="form-inline d4m-common-table" >
                      <tbody>
                        <tr>
                            <td>
                              <label><?php echo $label_language_values['seled4m_language_to_change_label'];?></label>
                            </td>
                            <td>
                              <div class="form-group">
                                <seled4m name="d4m_update_labels" id="update_labels" class="seled4mpicker" data-size="10" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" style="display: none;">
                                    <option value="none"><?php echo $label_language_values['seled4m_language_for_update'];?></option>
                                    <option value="en">English (United States)</option>
                                    <option value="ary" lang="ar">العربية المغربية</option>
                                    <option value="ar" lang="ar">العربية</option>
                                    <option value="az">Azərbaycan dili</option>
                                    <option value="azb" lang="az">گؤنئی آذربایجان</option>
                                    <option value="bg_BG">Български</option>
                                    <option value="bn_BD">বাংলা</option>
                                    <option value="bs_BA">Bosanski</option>
                                    <option value="ca">Català</option>
                                    <option value="ceb">Cebuano</option>
                                    <option value="cs_CZ">Čeština‎</option>
                                    <option value="cy">Cymraeg</option>
                                    <option value="da_DK">Dansk</option>
                                    <option value="de_CH_informal">Deutsch (Schweiz, Du)</option>
                                    <option value="de_DE_formal">Deutsch (Sie)</option>
                                    <option value="de_DE">Deutsch</option>
                                    <option value="de_CH">Deutsch (Schweiz)</option>
                                    <option value="el">Ελληνικά</option>
                                    <option value="en_CA">English (Canada)</option>
                                    <option value="en_GB">English (UK)</option>
                                    <option value="en_NZ">English (New Zealand)</option>
                                    <option value="en_ZA">English (South Africa)</option>
                                    <option value="en_AU">English (Australia)</option>
                                    <option value="eo">Esperanto</option>
                                    <option value="es_ES">Español</option>
                                    <option value="et">Eesti</option>
                                    <option value="eu">Euskara</option>
                                    <option value="fa_IR" lang="fa">فارسی</option>
                                    <option value="fi">Suomi</option>
                                    <option value="fr_FR">Français</option>
                                    <option value="gd">Gàidhlig</option>
                                    <option value="gl_ES">Galego</option>
                                    <option value="gu">ગુજરાતી</option>
                                    <option value="haz" lang="haz">هزاره گی</option>
                                    <option value="hi_IN">हिन्दी</option>
                                    <option value="hr">Hrvatski</option>
                                    <option value="hu_HU">Magyar</option>
                                    <option value="hy">Հայերեն</option>
                                    <option value="id_ID">Bahasa Indonesia</option>
                                    <option value="is_IS">Íslenska</option>
                                    <option value="it_IT">Italiano</option>
                                    <option value="ja">日本語</option>
                                    <option value="ka_GE">ქართული</option>
                                    <option value="ko_KR">한국어</option>
                                    <option value="lt_LT">Lietuvių kalba</option>
                                    <option value="lv">Latviešu valoda</option>
                                    <option value="mk_MK">Македонски јазик</option>
                                    <option value="mr">मराठी</option>
                                    <option value="ms_MY">Bahasa Melayu</option>
                                    <option value="my_MM">ဗမာစာ</option>
                                    <option value="nb_NO">Norsk bokmål</option>
                                    <option value="nl_NL">Nederlands</option>
                                    <option value="nl_NL_formal">Nederlands (Formeel)</option>
                                    <option value="nn_NO">Norsk nynorsk</option>
                                    <option value="oci">Occitan</option>
                                    <option value="pl_PL">Polski</option>
                                    <option value="pt_PT">Português</option>
                                    <option value="pt_BR">Português do Brasil</option>
                                    <option value="ro_RO">Română</option>
                                    <option value="ru_RU">Русский</option>
                                    <option value="sk_SK">Slovenčina</option>
                                    <option value="sl_SI">Slovenščina</option>
                                    <option value="sq">Shqip</option>
                                    <option value="sr_RS" >Српски језик</option>
                                    <option value="sv_SE">Svenska</option>
                                    <option value="szl">Ślōnskŏ gŏdka</option>
                                    <option value="th">ไทย</option>
                                    <option value="tl">Tagalog</option>
                                    <option value="tr_TR">Türkçe</option>
                                    <option value="ug_CN">Uyƣurqə</option>
                                    <option value="uk">Українська</option>
                                    <option value="vi">Tiếng Việt</option>
                                    <option value="zh_TW">繁體中文</option>
                                    <option value="zh_HK">香港中文版</option>
                                    <option value="zh_CN">简体中文</option>
                                </seled4m>
                              </div>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                      <?php  /* <table class="form-inline d4m-common-table show_all_labels" >
                          <ul class="nav nav-tab nav-stacked d4m-labels-lang-ul pl-15 pr-15 myall_lang_label">
            
          </ul> 
                      </table> */ ?>
                      <div class="myall_lang_label">
                      </div>
                      <table class="form-inline d4m-common-table" >
                          <tfoot>
                          <tr>
                              <td></td>
                              <td>
                              </td>
                          </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
                <!--</form>-->
            </div>
            <!-- LABELS -->
            <!-- Front Tool Tips Start -->

            <div class="tab-pane fade in" id="front_tooltips">
                <form id="d4m-fronttooltips-settings" method="post" type="" class="d4m-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['front_tool_tips'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a class="btn btn-success front_tooltips_setting" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                           
                           <div class="panel panel-default d4m-payment-methods">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <span><?php echo $label_language_values['front_tool_tips_lower'];?></span>
                    <div class="d4m-enable-disable-right pull-right">
                      <label class="d4moggle-twocheckout-payment-checkout" for="front-tooltips">
                        <input class="d4ma-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php  if($setting->d4m_front_tool_tips_status=='on'){echo 'checked';} ?> name="" id="front-tooltips" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                      
                      </label>
                    </div>
                  </h4>
                </div>
                <div id="collapseOne" <?php  if($setting->d4m_front_tool_tips_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_front-tooltips">
                  <div class="panel-body p-10">
                    <table class="form-inline d4m-common-table">
                      <tbody>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_my_bookings'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_my_bookings" value="<?php echo $setting->d4m_front_tool_tips_my_bookings; ?>" name="d4m_front_tool_tips_my_bookings" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_postal_code'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_postal_code" value="<?php echo $setting->d4m_front_tool_tips_postal_code; ?>" name="d4m_front_tool_tips_postal_code" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_services'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_services" value="<?php echo $setting->d4m_front_tool_tips_services; ?>" name="d4m_front_tool_tips_services" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_extra_service'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_addons_services" value="<?php echo $setting->d4m_front_tool_tips_addons_services; ?>" name="d4m_front_tool_tips_addons_services" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_frequently_discount'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_frequently_discount" value="<?php echo $setting->d4m_front_tool_tips_frequently_discount; ?>" name="d4m_front_tool_tips_frequently_discount" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_when_would_you_like_us_to_come'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_time_slots" value="<?php echo $setting->d4m_front_tool_tips_time_slots; ?>" name="d4m_front_tool_tips_time_slots" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_your_personal_details'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_personal_details" value="<?php echo $setting->d4m_front_tool_tips_personal_details; ?>" name="d4m_front_tool_tips_personal_details" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_have_a_promocode'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_tips_promocode" value="<?php echo $setting->d4m_front_tool_tips_promocode; ?>" name="d4m_front_tool_tips_promocode" size="50" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo $label_language_values['tool_tip_preferred_payment_method'];?></label></td>
                        <td>
                          <div class="form-group">
                            <input type="text" class="form-control" id="d4m_front_tool_payment_method" value="<?php echo $setting->d4m_front_tool_payment_method; ?>" name="d4m_front_tool_payment_method" size="50" />
                          </div>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                            </div>
                            <table class="form-inline d4m-common-table" >
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0);" name="" class="btn btn-success front_tooltips_setting" type="submit"><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>      
      <!-- Front Tool Tips END-->
      <!-- manageable form fields -->
      <div class="tab-pane fade in" id="manageable-form-fields">
                <form id="d4m-manageable-form-field-settings" method="post" type="" class="d4m-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['manageable_form_fields_front_booking_form'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a class="btn btn-success save_manage_form_fields" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><strong><?php echo $label_language_values['field_name'];?></strong></th>
                    <th><strong><?php echo $label_language_values['enable_disable'];?></strong></th>
                    <th><strong><?php echo $label_language_values['required'];?></strong></th>
                    <th><strong><?php echo $label_language_values['min_length'];?></strong></th>
                    <th><strong><?php echo $label_language_values['max_length'];?></strong></th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><label><?php echo $label_language_values['show_company_logo'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-postal-code"  for="show_company_logo_header">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_company_logo_display') == "Y") { echo "checked"; } ?>  id="show_company_logo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label>Show_company_title<?php  /* echo $label_language_values['Show_company_title']; */ ?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-postal-code"  for="show_company_title_header">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_company_title_display') == "Y") { echo "checked"; } ?>  id="show_company_title" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['show_company_address_in_header'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-postal-code"  for="Show_comapny_address_header">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_company_header_address') == "Y") { echo "checked"; } ?>  id="Show_comapny_address" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['front_language_flags_list']; ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="front_lang_dd">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_front_language_seled4mion_dropdown') == "Y") { echo "checked"; } ?>  id="front_lang_dd" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['show_description'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-postal-code"  for="show_company_logo_header">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_company_service_desc_status') == "Y") { echo "checked"; } ?>  id="show_desc_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['display_sub_headers_below_headers'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-d4m_subheaders" for="d4m_subheaders">
                            <input data-toggle="toggle" data-size="small" type='checkbox' name="d4m_subheaders" <?php  if($setting->d4m_subheaders=='Y'){echo 'checked';}?> id="d4m_subheaders" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
										
										 <tr>
                      <td><label><?php echo $label_language_values['wallet_sed4mion'];?></label></td>
                      <td>
                        <div class="form-group">
                          <label class="d4moggle-d4m_subheaders" for="d4m_wallet_sed4mion">
                            <input data-toggle="toggle" data-size="small" name="wallet_sed4mion" type='checkbox' <?php  if($setting->d4m_wallet_sed4mion=='on'){echo 'checked';}?> id="d4m_wallet_sed4mion" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                        <?php  /*
                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['if_you_are_having_booking_system_which_need_the_booking_address_then_please_make_this_field_enable_or_else_it_will_not_able_to_take_the_booking_address_and_display_blank_address_in_the_booking'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                        */ ?>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['appointment_details_sed4mion'];?></label></td>
                      <td>
                        <div class="form-group">
                          <label class="d4moggle-d4m_subheaders" for="hide-appoint-details">
                            <input data-toggle="toggle" data-size="small" name="appoint_details" type='checkbox' <?php  if($setting->d4m_appointment_details_display=='on'){echo 'checked';}?> id="hide_appoint_details" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                        <?php  /*
                        <a class="d4m-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['if_you_are_having_booking_system_which_need_the_booking_address_then_please_make_this_field_enable_or_else_it_will_not_able_to_take_the_booking_address_and_display_blank_address_in_the_booking'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                        */ ?>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['preferred_email'];?></td>
           <td><?php echo $label_language_values['enabled'];?></td>
           <td><?php echo $label_language_values['required'];?></td>
           <td></td>
           <td></td>
          </tr>
          <tr>
           <td><?php echo $label_language_values['preferred_password'];?></td>
           <td><?php echo $label_language_values['enabled'];?></td>
           <td><?php echo $label_language_values['required'];?></td>
                      <td>
                      <?php $password_check = explode(",",$setting->get_option('d4m_bf_password')); ?>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="pass_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control pass_min v_c" data-names="pass" name="pass_min" value="<?php echo $password_check['2']; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="pass_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="pass_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control pass_max v_c_pass" value="<?php echo $password_check['3']; ?>" name="pass_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="pass_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['first_name'];?><?php $check = explode(",",$setting->get_option('d4m_bf_first_name')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="d4m_bf_first_name_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>  id="d4m_bf_first_name_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="d4m_bf_first_name_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php   if( $check[1] == "Y") { echo "checked"; } ?>  id="d4m_bf_first_name_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="fname_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control fname_min v_c" data-names="fname" name="fname_min" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="fname_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="fname_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control fname_max v_c_fname" value="<?php echo $check[3]; ?>" name="fname_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="fname_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                    <td><?php echo $label_language_values['last_name']; ?><?php $check = explode(",",$setting->get_option('d4m_bf_last_name')); ?></td>
                    <td>
                      <div class="form-group nm">
                        <label class="d4moggle-large"  for="cff_last_name_1">
                          <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>  id="cff_last_name_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="form-group nm">
                        <label class="d4moggle-large"  for="cff_last_name_2">
                          <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>  id="cff_last_name_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="input-group spinner">
                        <div class="input-group-btn-horizontal">
                          <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="lname_min" type="button"><i class="fa fa-minus nm"></i></button>
                            <input type="text" class="form-control lname_min v_c" data-names="lname" name="lname_min" value="<?php echo $check[2]; ?>">
                          <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="lname_min" type="button"><i class="fa fa-plus nm"></i></button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group spinner">
                        <div class="input-group-btn-horizontal">
                          <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="lname_max" type="button"><i class="fa fa-minus nm"></i></button>
                            <input type="text" class="form-control lname_max v_c_lname" value="<?php echo $check[3]; ?>" name="lname_max">
                          <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="lname_max" type="button"><i class="fa fa-plus nm"></i></button>
                        </div>
                      </div>
                    </td>
                    </tr>

                    <tr>
                      <td><?php echo $label_language_values['phone'];?><?php $check = explode(",",$setting->get_option('d4m_bf_phone')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_phone_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_phone_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_phone_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_phone_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="phone_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control phone_min v_c" data-names="phone" name="phone_min" value="<?php echo $check[2];?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="phone_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="phone_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control phone_max v_c_phone" value="<?php echo $check[3]; ?>" name="phone_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="phone_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['street_address'];?><?php $check = explode(",",$setting->get_option('d4m_bf_address'));?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_street_address_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_street_address_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_street_address_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_street_address_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="street_address_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control street_address_min" name="street_address_min v_c" data-names="street_address" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="street_address_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="street_address_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control street_address_max v_c_street_address" value="<?php echo $check[3];?>" name="street_address_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="street_address_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['zip_code'];?><?php $check = explode(",",$setting->get_option('d4m_bf_zip_code')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_zip_code_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_zip_code_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_zip_code_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_zip_code_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="zip_code_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control zip_code_min" name="zip_code_min v_c" data-names="zip" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="zip_code_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="zip_code_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control zip_code_max v_c_zip" value="<?php echo $check[3]; ?>" name="zip_code_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="zip_code_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['city'];?><?php $check = explode(",",$setting->get_option('d4m_bf_city')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_city_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_city_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_city_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_city_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="city_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control city_min v_c" data-names="city" name="city_min" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="city_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="city_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control city_max v_c_city" value="<?php echo $check[3]; ?>" name="city_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="city_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['state'];?><?php $check = explode(",",$setting->get_option('d4m_bf_state')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_state_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_state_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_state_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_state_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="state_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control state_min v_c" data-names="state" name="state_min" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="state_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="state_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control state_max v_c_state" value="<?php echo $check[3]; ?>" name="state_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="state_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['special_requests_notes'];?><?php $check = explode(",",$setting->get_option('d4m_bf_notes')); ?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_notes_1">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[0] == "on") { echo "checked"; } ?>   id="cff_notes_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="cff_notes_2">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>  id="cff_notes_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="notes_min" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control notes_min" name="notes_min v_c" data-names="notes" value="<?php echo $check[2]; ?>">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="notes_min" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group spinner">
                          <div class="input-group-btn-horizontal">
                            <button class="btn d4m-subtrad4mion-btn btn-default input-group-addon" data-info="notes_max" type="button"><i class="fa fa-minus nm"></i></button>
                              <input type="text" class="form-control notes_max v_c_notes" value="<?php echo $check[3]; ?>" name="notes_max">
                            <button class="btn d4m-addition-btn btn-default input-group-addon" data-info="notes_max" type="button"><i class="fa fa-plus nm"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td><?php echo $label_language_values['vaccume_cleaner'];?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="d4m_vc_status">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_vc_status') == "Y") { echo "checked"; } ?>  id="d4m_vc_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>

                    <tr>
                      <td><?php echo $label_language_values['parking'];?></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-large"  for="d4m_p_status">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_p_status') == "Y") { echo "checked"; } ?>  id="d4m_p_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>

                    <tr>
                      <td><label><?php echo $label_language_values['show_how_will_we_get_in'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label class="d4moggle-postal-code"  for="show_company_logo_header">
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if($setting->get_option('d4m_company_willwe_getin_status') == "Y") { echo "checked"; } ?>  id="show_how_willwe_getin_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['show_coupons_input_on_checkout'];?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label  class="d4moggle-postal-code" for="show-coupons-input-oc">
                            
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" name="" type='checkbox' <?php  if($setting->d4m_show_coupons_input_on_checkout=='on'){echo 'checked';}?> id="show-coupons-input-oc" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>

                    <tr>
                      <td><label><?php echo "Show referral code";?></label></td>
                      <td>
                        <div class="form-group nm">
                          <label  class="d4moggle-postal-code" for="show-referral-input-oc">
                            
                            <input class='d4ma-toggle-checkbox' data-toggle="toggle" data-size="small" name="" type='checkbox' <?php  if($setting->d4m_show_referral_input_on_checkout=='on'){echo 'checked';}?> id="show-referral-input-oc" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                          </label>
                        </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    
                  </tbody>    
                </table>
              </div>  
              <table class="form-inline d4m-common-table" >
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0);" name="" class="btn btn-success save_manage_form_fields" type="submit"><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
              </table>  
              <ul class="nav nav-tab nav-stacked d4m-labels-error-ul pl-15 pr-15">
                <?php  
                $alllang = $setting->get_all_languages();
                while($all = mysqli_fetch_array($alllang))
                {
                  $language_label_arr = $setting->get_all_labelsbyid($all[2]);
                  if($language_label_arr[6] != ''){
                    $label_decode_form_field = base64_decode($language_label_arr[6]);

                    $label_decode_form_field_unserial = unserialize($label_decode_form_field);
                    ?>
                    <li class="panel panel-default d4m-labels-error-listing">              
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <div class="d4ma-col8"><span><?php echo urldecode($language_names[$all[2]]);?></span></div>
                          <div class="d4m-show-hide pull-right">
                            <input type="checkbox" name="d4m-show-hide" class="d4m-show-hide-checkbox" id="myid<?php  echo $all['id'];?>" ><!--Added Serivce Id-->
                            <label class="d4m-show-hide-label" for="myid<?php  echo $all['id'];?>"></label>
                          </div>
                        </h4>
                      </div>
                      <div id="details_myid<?php  echo $all['id'];?>"  class="panel-collapse collapse mycollapse_d4m-manageable-errors">
                        <div class="panel-body p-10">
                          <table class="form-inline d4m-common-table">
                            <tbody>
                            <?php  
                            foreach ($label_decode_form_field_unserial as $key => $value) {
                              /*$final_value = str_replace('_', ' ', $key);*/
                              ?>
                              <tr>
                              <td><label class="englabel_<?php  echo $key;?>"><?php echo $manage_form_errors_message[$key];?></label></td>
                              <td>
                                <div class="form-group">
                                  <input type="text" size="50" value="<?php echo urldecode($value);?>"  data-id="<?php echo $key;?>" class="form-control langlabel_front_error_<?php  echo $all['id'];?>" name="d4mextralabeld4m<?php  echo $key;?>"/>
                                </div>
                              </td>
                              </tr>
                            <?php  } ?>
                              <tr>
                                <td></td>
                                <td>
                                  <a href="javascript:void(0);" name="" class="btn btn-success save_front_form_error_labels" data-id="<?php echo $all['id'];?>" type="submit"><?php echo $label_language_values['save_setting'];?></a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </li>
                    <?php  
                    /* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
                    foreach($label_decode_extra_unserial as $key => $value){
                      $label_decode_form_field_unserial[$key] = urldecode($value);
                    }
                  }
                }
                ?>
              </ul>
            </div>
          </div>  
        </form>
      </div>  
      <div class="tab-pane fade in" id="seo-ga">
                <form id="d4m-seo-ga-settings" method="post" type="" class="d4m-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading d4ma-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['SEO_Settings'];?></h1>
                            <span class="pull-right d4ma-setting-fix-btn"> <a class="btn btn-success save_seo_ga" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
              <div class="table-responsive">
                <table class="form-inline d4m-common-table">
                  <tbody>
                    <tr>
                      <td><?php echo $label_language_values['Google_Analytics_Code'];?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" size="50" class="form-control" id="d4m_google_analytics_code" name="d4m_google_analytics_code" value="<?php echo $setting->get_option('d4m_google_analytics_code');?>" placeholder="e.g. XX-XXXXXXXXX-X" />
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['Page_Meta_Tag'];?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" size="50" class="form-control" id="d4m_page_meta_tag" name="d4m_page_meta_tag" value="<?php echo $setting->get_option('d4m_page_title');?>" placeholder="<?php echo $label_language_values['Page_Meta_Tag'];?>" />
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['Meta_Description'];?></td>
                      <td>
                        <div class="form-group">
                          <textarea cols="48" class="form-control" id="d4m_seo_meta_description" name="d4m_seo_meta_description" placeholder="<?php echo $label_language_values['Meta_Description'];?>"><?php echo $setting->get_option('d4m_seo_meta_description');?></textarea>
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['Page_Meta_Tag'];?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" size="50" class="form-control" id="d4m_seo_og_title" name="d4m_seo_og_title" value="<?php echo $setting->get_option('d4m_seo_og_title');?>" placeholder="<?php echo $label_language_values['og_tag_title'];?>" />
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['og_tag_type'];?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" size="50" class="form-control" id="d4m_seo_og_type" name="d4m_seo_og_type" value="<?php echo $setting->get_option('d4m_seo_og_type');?>" placeholder="<?php echo $label_language_values['og_tag_type'];?>" />
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $label_language_values['og_tag_url'];?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" size="50" class="form-control" id="d4m_seo_og_url" name="d4m_seo_og_url" value="<?php echo $setting->get_option('d4m_seo_og_url');?>" placeholder="<?php echo $label_language_values['og_tag_url'];?>" />
                        </div>

                      </td>
                    </tr>
                    <tr>
                      <td><label><?php echo $label_language_values['og_tag_image'];?></label></td>
                      <td>
                        <div class="form-group">
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-default btn-file mt-15"><input type="file" id="d4m_seo_og_image" name="d4m_seo_og_image" /></span>
                            <br>
                            <span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td>
                        <a id="save_seo_ga" name="" class="btn btn-success save_seo_ga" ><?php echo $label_language_values['save_setting'];?></a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </form>         
      </div>
      <?php  
      if($gc_hook->gc_purchase_status() == 'exist'){
        echo $gc_hook->gc_settings_menu_content_hook();
      }
      ?>
        </div>
    </div>
</div>

<!-- email template preview modal -->
<div id="email-template-preview-modal" class="email-template-preview-popup modal fade" tabindex="-1" role="dialog">
  <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
          <div class="modal-content">
              <!--<div class="modal-header">
                  <div class="col-md-12 col-xs-12">
                    Preview<button type="button" class="btn btn-default hidemodal" data-dismiss="modal" aria-hidden="true"><?php echo $label_language_values['close'];?></button>
                  </div>
              </div>-->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email Template Preview</h4>
              </div>
              <div class="modal-body email_html_content" style="display: flow-root;">
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default hidemodal" data-dismiss="modal" aria-hidden="true"><?php echo $label_language_values['close'];?></button>
              </div>
          </div>
      </div>
  </div>
</div>

<script>
  var settingObj = {'ajax_url':'<?php echo AJAX_URL;?>'};
    var ajax_url = '<?php echo AJAX_URL;?>';
    var ajaxObj = {'ajax_url':'<?php echo AJAX_URL;?>'};
    var servObj={'site_url':'<?php echo SITE_URL.'assets/images/business/';?>'};
    var imgObj={'img_url':'<?php echo SITE_URL.'assets/images/';?>'};
</script>
<?php  
if($gc_hook->gc_purchase_status() == 'exist'){
  echo $gc_hook->gc_settings_save_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
  echo $gc_hook->gc_setting_configure_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
  echo $gc_hook->gc_setting_disconned4m_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
  echo $gc_hook->gc_setting_verify_js_hook();
}
include(dirname(__FILE__).'/footer.php');
?>