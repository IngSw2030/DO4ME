<?php   

$filename =  './config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file = file_exists($filename);

if($file){

  if(!filesize($filename) > 0){

    header('location:d4minstall.php');

  }

  else{

    include(dirname(__FILE__) . "/objects/class_connection.php");

    $cvars = new do4me_myvariable();

    $host = trim($cvars->hostnames);

    $un = trim($cvars->username);

    $ps = trim($cvars->passwords); 

    $db = trim($cvars->database);



    $con = new do4me_db();

    $conn = $con->connect();

    

    if(($conn->conned4merrno=='0' && ($host=='' || $db=='')) || $conn->conned4merrno!='0' ) {

      header('Location: ./config_index.php');

    }

  }

}else{

  echo "Config file does not exist";

}



session_start();

$service_array = array("method" => array());

$_SESSION['d4mcart'] = $service_array;

$_SESSION['freq_dis_amount'] = '';

$_SESSION['d4mdetails'] = '';

$_SESSION['staff_id_cal'] = '';

$_SESSION['time_duration'] = 0;



include(dirname(__FILE__) . '/class_configure.php');

include(dirname(__FILE__) . "/header.php");

include(dirname(__FILE__) . "/objects/class_services.php");

include(dirname(__FILE__) . "/objects/class_users.php");

include(dirname(__FILE__) . '/objects/class_setting.php');

include(dirname(__FILE__) . '/objects/class_frequently_discount.php');

include(dirname(__FILE__) . '/objects/class_service_methods_design.php');

include(dirname(__FILE__) . "/objects/class_version_update.php");

include(dirname(__FILE__) . "/objects/class_payment_hook.php");

include(dirname(__FILE__)."/objects/class_promo_code.php");

include(dirname(__FILE__)."/objects/class_front_first_step.php");

include(dirname(__FILE__). "/objects/class_userdetails.php"); 



$cvars = new do4me_myvariable();

$host = trim($cvars->hostnames);

$un = trim($cvars->username);

$ps = trim($cvars->passwords); 

$db = trim($cvars->database);



$con = @new do4me_db();

$conn = $con->connect();



$objuserdetails = new do4me_userdetails();

$objuserdetails->conn = $conn;



if(($conn->conned4merrno=='0' && ($host=='' || $db=='')) || $conn->conned4merrno!='0' ) {

  header('Location: '.BASE_URL.'/config_index.php');

    exit(0);

}



$check_existing_tables_index = $con->check_existing_tables_index($conn);

if($check_existing_tables_index == 'table_not_exist' || $check_existing_tables_index == 'table_exist_but_no_data'){

  ?>

    <script type="text/javascript">

      var AdminloginCredentialObj={'site_url':'<?php  echo SITE_URL;?>'};

      var AdminloginCredential_url=AdminloginCredentialObj.site_url;

      window.location=AdminloginCredential_url+"config_index.php";

    </script>

  <?php  

}



$promo = new do4me_promo_code();

$promo->conn = $conn;



$first_step=new do4me_first_step();

$first_step->conn=$conn;



/*

Language

*/



$language_names = array(

"en"=> urlencode("English (United States)"),

"ary"=> urlencode("العربية المغربية"),

"ar"=> urlencode("العربية"),

"az"=> urlencode("Azərbaycan dili"),

"azb"=> urlencode("گؤنئی آذربایجان"),

"bg_BG"=> urlencode("Български"),

"bn_BD"=> urlencode("বাংলা"),

"bs_BA"=> urlencode("Bosanski"),

"ca"=> urlencode("Català"),

"ceb"=> urlencode("Cebuano"),

"cs_CZ"=> urlencode("Čeština‎"),

"cy"=> urlencode("Cymraeg"),

"da_DK"=> urlencode("Dansk"),

"de_CH_informal"=> urlencode("Deutsch (Schweiz, Du)"),

"de_DE_formal"=> urlencode("Deutsch (Sie)"),

"de_DE"=> urlencode("Deutsch"),

"de_CH"=> urlencode("Deutsch (Schweiz)"),

"el"=> urlencode("Ελληνικά"),

"en_CA"=> urlencode("English (Canada)"),

"en_GB"=> urlencode("English (UK)"),

"en_NZ"=> urlencode("English (New Zealand)"),

"en_ZA"=> urlencode("English (South Africa)"),

"en_AU"=> urlencode("English (Australia)"),

"eo"=> urlencode("Esperanto"),

"es_ES"=> urlencode("Español"),

"et"=> urlencode("Eesti"),

"eu"=> urlencode("Euskara"),

"fa_IR"=> urlencode("فارسی"),

"fi"=> urlencode("Suomi"),

"fr_FR"=> urlencode("Français"),

"gd"=> urlencode("Gàidhlig"),

"gl_ES"=> urlencode("Galego"),

"gu"=> urlencode("ગુજરાતી"),

"haz"=> urlencode("هزاره گی"),

"hi_IN"=> urlencode("हिन्दी"),

"hr"=> urlencode("Hrvatski"),

"hu_HU"=> urlencode("Magyar"),

"hy"=> urlencode("Հայերեն"),

"id_ID"=> urlencode("Bahasa Indonesia"),

"is_IS"=> urlencode("Íslenska"),

"it_IT"=> urlencode("Italiano"),

"ja"=> urlencode("日本語"),

"ka_GE"=> urlencode("ქართული"),

"ko_KR"=> urlencode("한국어"),

"lt_LT"=> urlencode("Lietuvių kalba"),

"lv"=> urlencode("Latviešu valoda"),

"mk_MK"=> urlencode("Македонски јазик"),

"mr"=> urlencode("मराठी"),

"ms_MY"=> urlencode("Bahasa Melayu"),

"my_MM"=> urlencode("ဗမာစာ"),

"nb_NO"=> urlencode("Norsk bokmål"),

"nl_NL"=> urlencode("Nederlands"),

"nl_NL_formal"=> urlencode("Nederlands (Formeel)"),

"nn_NO"=> urlencode("Norsk nynorsk"),

"oci"=> urlencode("Occitan"),

"pl_PL"=> urlencode("Polski"),

"pt_PT"=> urlencode("Português"),

"pt_BR"=> urlencode("Português do Brasil"),

"ro_RO"=> urlencode("Română"),

"ru_RU"=> urlencode("Русский"),

"sk_SK"=> urlencode("Slovenčina"),

"sl_SI"=> urlencode("Slovenščina"),

"sq"=> urlencode("Shqip"),

"sr_RS"=> urlencode("Српски језик"),

"sv_SE"=> urlencode("Svenska"),

"szl"=> urlencode("Ślōnskŏ gŏdka"),

"th"=> urlencode("ไทย"),

"tl"=> urlencode("Tagalog"),

"tr_TR"=> urlencode("Türkçe"),

"ug_CN"=> urlencode("Uyƣurqə"),

"uk"=> urlencode("Українська"),

"vi"=> urlencode("Tiếng Việt"),

"zh_TW"=> urlencode("繁體中文"),

"zh_HK"=> urlencode("香港中文版"),

"zh_CN"=> urlencode("简体中文"),

);

/* NAME */

$objservice = new do4me_services();

$objservice->conn = $conn;

$user = new do4me_users();

$user->conn = $conn;

$settings = new do4me_setting();

$settings->conn = $conn;

$frequently_discount = new do4me_frequently_discount();

$frequently_discount->conn = $conn;

$objservice_method_design = new do4me_service_methods_design();

$objservice_method_design->conn = $conn;



$payment_hook = new do4me_paymentHook();

$payment_hook->conn = $conn;

$payment_hook->payment_extenstions_exist();

$purchase_check = $payment_hook->payment_purchase_status();



$objcheckversion = new do4me_version_update();

$objcheckversion->conn = $conn;

$current = $settings->get_option('d4mversion');

if($current == ""){

  $objcheckversion->insert_option("d4mversion","1.1");

}

if($current < 1.1){

  $settings->set_option("d4mversion","1.1");

  $objcheckversion->update1_1();

}

if($current < 1.2){

  $settings->set_option("d4mversion","1.2");

  $objcheckversion->update1_2();

}

if($current < 1.3){

  $settings->set_option("d4mversion","1.3");

  $objcheckversion->update1_3();

}

if($current < 1.4){

  $settings->set_option("d4mversion","1.4");

  $objcheckversion->update1_4();

}

if($current < 1.5){

  $settings->set_option("d4mversion","1.5");

  $objcheckversion->update1_5();

}

if($current < 1.6){

  $settings->set_option("d4mversion","1.6");

  $objcheckversion->update1_6();

}

if($current < 2.0){

  $settings->set_option("d4mversion","2.0");

  $objcheckversion->update2_0();

}

if($current < 2.1){

  $settings->set_option("d4mversion","2.1");

}

if($current < 2.2){

  $settings->set_option("d4mversion","2.2");

  $objcheckversion->update2_2();

}

if($current < 2.3){

  $settings->set_option("d4mversion","2.3");

  $objcheckversion->update2_3();

}

if($current < 2.4){

  $settings->set_option("d4mversion","2.4");

  $objcheckversion->update2_4();

}

if($current < 2.5){

  $settings->set_option("d4mversion","2.5");

  $objcheckversion->update2_5();

}

if($current < 2.6){

  $settings->set_option("d4mversion","2.6");

  $objcheckversion->update2_6();

}

if($current < 2.7){

  $settings->set_option("d4mversion","2.7");

  $objcheckversion->update2_7();

}

if($current < 2.8){

  $settings->set_option("d4mversion","2.8");

  $objcheckversion->update2_8();

}

if($current < 3.0){

  $settings->set_option("d4mversion","3.0");

  $objcheckversion->update3_0();

}

if($current < 3.1){

  $settings->set_option("d4mversion","3.1");

}

if($current < 3.2){

  $settings->set_option("d4mversion","3.2");

  $objcheckversion->update3_2();

}

if($current < 3.3){

  $settings->set_option("d4mversion","3.3");

  $objcheckversion->update3_3();

}

if($current < 4.0){

  $settings->set_option("d4mversion","4.0");

  $objcheckversion->update4_0();

}

if($current < 4.1){

  $settings->set_option("d4mversion","4.1");

  $objcheckversion->update4_1();

}

if($current < 4.2){

  $settings->set_option("d4mversion","4.2");

  $objcheckversion->update4_2();

}

if($current < 4.3){

  $settings->set_option("d4mversion","4.3");

  $objcheckversion->update4_3();

}

if($current < 4.4){

  $settings->set_option("d4mversion","4.4");

  $objcheckversion->update4_4();

}

if($current < 5.0){

  $settings->set_option("d4mversion","5.0");

  $objcheckversion->update5_0();

}

if($current < 5.1){

  $settings->set_option("d4mversion","5.1");

}

if($current < 5.2){

  $settings->set_option("d4mversion","5.2");

  $objcheckversion->update5_2();

}

if($current < 5.3){

  $settings->set_option("d4mversion","5.3");

  $objcheckversion->update5_3();

}

if($current < 6.0){

  $settings->set_option("d4mversion","6.0");

  $objcheckversion->update6_0();

}

if($current < 6.1){

  $settings->set_option("d4mversion","6.1");

}

if($current < 6.2){

  $settings->set_option("d4mversion","6.2");

  $objcheckversion->update6_2();

}

if($current < 6.3){

  $settings->set_option("d4mversion","6.3");

  $objcheckversion->update6_3();

}

if($current < 6.4){

  $settings->set_option("d4mversion","6.4");

  $objcheckversion->update6_4();

}



if($current < 6.5){
  $settings->set_option("d4mversion","6.5");
}

if($current < 7.0){
  $settings->set_option("d4mversion","7.0");
  $objcheckversion->update7_0();
}



$design_page=$settings->get_option('d4mbooking_page_design');

if($design_page=='M'){

 header('Location:'.SITE_URL);

}



$label_language_values = array();

if(isset($_SESSION['current_lang'])){

  $lang = $_SESSION['current_lang'];

  $language_label_arr = $settings->get_all_labelsbyid($_SESSION['current_lang']);

}

else {

  $lang = $settings->get_option("d4mlanguage");

  $language_label_arr = $settings->get_all_labelsbyid($lang);

}

if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "" || $language_label_arr[6] != "")

{

  $default_language_arr = $settings->get_all_labelsbyid("en");

  if($language_label_arr[1] != ''){

    $label_decode_front = base64_decode($language_label_arr[1]);

  }else{

    $label_decode_front = base64_decode($default_language_arr[1]);

  }

  if($language_label_arr[3] != ''){

    $label_decode_admin = base64_decode($language_label_arr[3]);

  }else{

    $label_decode_admin = base64_decode($default_language_arr[3]);

  }

  if($language_label_arr[4] != ''){

    $label_decode_error = base64_decode($language_label_arr[4]);

  }else{

    $label_decode_error = base64_decode($default_language_arr[4]);

  }

  if($language_label_arr[5] != ''){

    $label_decode_extra = base64_decode($language_label_arr[5]);

  }else{

    $label_decode_extra = base64_decode($default_language_arr[5]);

  }

  if($language_label_arr[6] != ''){

    $label_decode_front_form_errors = base64_decode($language_label_arr[6]);

  }else{

    $label_decode_front_form_errors = base64_decode($default_language_arr[6]);

  }

    

  $label_decode_front_unserial = unserialize($label_decode_front);

  $label_decode_admin_unserial = unserialize($label_decode_admin);

  $label_decode_error_unserial = unserialize($label_decode_error);

  $label_decode_extra_unserial = unserialize($label_decode_extra);

  $label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);

    

  $label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);

  foreach($label_language_arr as $key => $value){

    $label_language_values[$key] = urldecode($value);

  }

}

else

{

    $default_language_arr = $settings->get_all_labelsbyid("en");

    

  $label_decode_front = base64_decode($default_language_arr[1]);

  $label_decode_admin = base64_decode($default_language_arr[3]);

  $label_decode_error = base64_decode($default_language_arr[4]);

  $label_decode_extra = base64_decode($default_language_arr[5]);

  $label_decode_front_form_errors = base64_decode($default_language_arr[6]);

    

  

  $label_decode_front_unserial = unserialize($label_decode_front);

  $label_decode_admin_unserial = unserialize($label_decode_admin);

  $label_decode_error_unserial = unserialize($label_decode_error);

  $label_decode_extra_unserial = unserialize($label_decode_extra);

  $label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);

    

  $label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);

  foreach($label_language_arr as $key => $value){

    $label_language_values[$key] = urldecode($value);

  }

}

$frontimage=$settings->get_option('d4mfront_image');

if($frontimage!=''){

$imagepath=SITE_URL."assets/images/backgrounds/".$frontimage;

}else{

$imagepath='';

} 

  $english_date_array = array(

"January","Jan","February","Feb","March","Mar","April","Apr","May","June","Jun","July","Jul","August","Aug","September","Sep","October","Oct","November","Nov","December","Dec","Sun","Mon","Tue","Wed","Thu","Fri","Sat","su","mo","tu","we","th","fr","sa","AM","PM");

  $selected_lang_label = array(

ucfirst(strtolower($label_language_values['january'])),

ucfirst(strtolower($label_language_values['jan'])),

ucfirst(strtolower($label_language_values['february'])),

ucfirst(strtolower($label_language_values['feb'])),

ucfirst(strtolower($label_language_values['march'])),

ucfirst(strtolower($label_language_values['mar'])),

ucfirst(strtolower($label_language_values['april'])),

ucfirst(strtolower($label_language_values['apr'])),

ucfirst(strtolower($label_language_values['may'])),

ucfirst(strtolower($label_language_values['june'])),

ucfirst(strtolower($label_language_values['jun'])),

ucfirst(strtolower($label_language_values['july'])),

ucfirst(strtolower($label_language_values['jul'])),

ucfirst(strtolower($label_language_values['august'])),

ucfirst(strtolower($label_language_values['aug'])),

ucfirst(strtolower($label_language_values['september'])),

ucfirst(strtolower($label_language_values['sep'])),

ucfirst(strtolower($label_language_values['october'])),

ucfirst(strtolower($label_language_values['oct'])),

ucfirst(strtolower($label_language_values['november'])),

ucfirst(strtolower($label_language_values['nov'])),

ucfirst(strtolower($label_language_values['december'])),

ucfirst(strtolower($label_language_values['dec'])),

ucfirst(strtolower($label_language_values['sun'])),

ucfirst(strtolower($label_language_values['mon'])),

ucfirst(strtolower($label_language_values['tue'])),

ucfirst(strtolower($label_language_values['wed'])),

ucfirst(strtolower($label_language_values['thu'])),

ucfirst(strtolower($label_language_values['fri'])),

ucfirst(strtolower($label_language_values['sat'])),

ucfirst(strtolower($label_language_values['su'])),

ucfirst(strtolower($label_language_values['mo'])),

ucfirst(strtolower($label_language_values['tu'])),

ucfirst(strtolower($label_language_values['we'])),

ucfirst(strtolower($label_language_values['th'])),

ucfirst(strtolower($label_language_values['fr'])),

ucfirst(strtolower($label_language_values['sa'])),

strtoupper($label_language_values['am']),

strtoupper($label_language_values['pm']));

  ?>

<!Doctype html>



<head>

    <title><?php  echo $settings->get_option("d4mpage_title"); ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/png" href="<?php  echo BASE_URL; ?>/assets/images/backgrounds/<?php  echo $settings->get_option('d4mfavicon_image');?>"/>

  <?php   if($settings->get_option('d4mseo_meta_description') != ''){ ?>

    <meta name="description" content="<?php  echo $settings->get_option('d4mseo_meta_description'); ?>">

  <?php   } ?>

  <?php   if($settings->get_option('d4mseo_og_title') != ''){ ?>

    <meta property="og:title" content="<?php  echo $settings->get_option('d4mseo_og_title'); ?>" />

  <?php   } ?>

  <?php   if($settings->get_option('d4mseo_og_type') != ''){ ?>

    <meta property="og:type" content="<?php  echo $settings->get_option('d4mseo_og_type'); ?>" />

  <?php   } ?>

  <?php   if($settings->get_option('d4mseo_og_url') != ''){ ?>

    <meta property="og:url" content="<?php  echo $settings->get_option('d4mseo_og_url'); ?>" />

  <?php   } ?>

  <?php   if($settings->get_option('d4mseo_og_image') != ''){ ?>

    <meta property="og:image" content="<?php  echo SITE_URL; ?>assets/images/og_tag_img/<?php  echo $settings->get_option('d4mseo_og_image'); ?>" />

  <?php   } ?>

  <?php  

  if($settings->get_option('d4mgoogle_analytics_code') != ''){

    ?>

     <script async src="https://www.googletagmanager.com/gtag/js?id=<?php  echo $settings->get_option('d4mgoogle_analytics_code'); ?>"></script>

     <script>

       window.dataLayer = window.dataLayer || [];

       function gtag(){dataLayer.push(arguments);}

       gtag('js', new Date());

       gtag('config', '<?php  echo $settings->get_option('d4mgoogle_analytics_code'); ?>');

     </script>

    <?php  

  }

  ?>

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/d4m-main.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/d4m-common.css" type="text/css" media="all" />

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/tooltipster.bundle.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/tooltipster-sideTip-shadow.min.css" type="text/css" media="all" />

  <?php   

  if(in_array($lang,array('ary','ar','azb','fa_IR','haz'))){ ?> 

  <!-- Front RTL style -->

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/cta-front-rtl.css" type="text/css" media="all" />

  <?php   }

    $check_zip_code = explode(",",$settings->get_option('d4mbf_zip_code'));

    $dateFormat = $settings->get_option('d4mdate_picker_date_format');

function date_format_js($date_Format) {

  

  $chars = array(

    // Day

    'd' => 'DD',

    'j' => 'DD',

    // Month

    'm' => 'MM',

    'M' => 'MMM',

    'F' => 'MMMM',

    // Year

    'Y' => 'YYYY',

    'y' => 'YYYY',

  );

  return strtr( (string) $date_Format, $chars );

}

  ?>

  <script>

  var d4mpostalcode_statusObj = {'d4mpostalcode_status': '<?php   echo $settings->get_option('d4mpostalcode_status');?>','zip_show_status':'<?php    echo $check_zip_code[0]; ?>'};

  var date_format_for_js = '<?php  echo date_format_js($dateFormat); ?>';

  var scrollable_cartObj = {'scrollable_cart': '<?php   echo $settings->get_option('d4mcart_scrollable'); ?>'};

  </script>

  <?php  

  $d4mfrontend_fonts_val = $settings->get_option('d4mfrontend_fonts');

  if($d4mfrontend_fonts_val == 'Molle'){

    ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Molle:400i" />

    <?php  

  }elseif($d4mfrontend_fonts_val == 'Coda Caption'){

    ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Coda+Caption:800" />

    <?php  

  }else{

    ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php  echo $d4mfrontend_fonts_val; ?>:300,400,700" />

    <?php  

  }

  ?>

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/login-style.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/d4m-responsive.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/d4m-reset.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/jquery-ui.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/intlTelInput.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/jquery-ui.theme.min.css" type="text/css" media="all" />

   <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/font-awesome/css/font-awesome.min.css" type="text/css" media="all">

    <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/line-icons/simple-line-icons.css" type="text/css" media="all" />

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/daterangepicker.css" type="text/css" media="all" />

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/bootstrap/bootstrap.css" type="text/css" media="all" />

  <link rel="stylesheet" href="<?php  echo BASE_URL; ?>/assets/css/star_rating.min.css" type="text/css" media="all">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap/bootstrap.min.css" type="text/css" media="all">

  

  <?php   if($settings->get_option('d4mstripe_payment_form_status') == 'on'){  ?>

  <script src="https://js.stripe.com/v2/" type="text/javascript"></script>  

  <?php   } ?>

  <?php   if($settings->get_option('d4m2checkout_status') == 'Y'){  ?>

  <script src="https://www.2checkout.com/checkout/api/2co.min.js" type="text/javascript"></script>  

  <?php   } ?>

    <script src="<?php  echo BASE_URL; ?>/assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>

  <script src="<?php  echo BASE_URL; ?>/assets/js/jquery.mask.js" type="text/javascript"></script>

  <script src="<?php  echo BASE_URL; ?>/assets/js/moment.min.js" type="text/javascript"></script>

  <script src="<?php  echo BASE_URL; ?>/assets/js/daterangepicker.js" type="text/javascript"></script>

  <?php  

  include(dirname(__FILE__) . '/extension/d4m-common-front-extension-js.php');

  ?>

    <script src="<?php  echo BASE_URL; ?>/assets/js/d4m-common-jquery.js?<?php    echo time(); ?>" type="text/javascript"></script>

  

  <script src="<?php  echo BASE_URL; ?>/assets/js/tooltipster.bundle.min.js" type="text/javascript"></script>

  

  

    <?php  

    include(dirname(__FILE__)."/admin/language_js_objects.php");

    ?>

    <script src="<?php  echo BASE_URL; ?>/assets/js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="<?php  echo BASE_URL; ?>/assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>

    <script src="<?php  echo BASE_URL; ?>/assets/js/intlTelInput.js" type="text/javascript"></script>

    <script src="<?php  echo BASE_URL; ?>/assets/js/jquery.payment.min.js" type="text/javascript"></script>

    <script src="<?php  echo BASE_URL; ?>/assets/js/star_rating_min.js" type="text/javascript"></script>

    <script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js" type="text/javascript" ></script>

    <!-- **Google - Fonts** -->

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet"> 

    <script src="<?php  echo BASE_URL; ?>/assets/js/jquery.validate.min.js"></script>

  <style>

        .error {

            color: red;

        }

    #d4m, a, h1, h2, h3, h4, h5, h6, span, p, div, label, li, ul{

      font-family: <?php   echo $settings->get_option('d4mfrontend_fonts'); ?>  !important;

    }

    </style>

  <?php   if($imagepath != ''){ ?>

  <style>

    #d4m .d4m-fixed-background {

      background-image: url(<?php  echo $imagepath;?>) !important;

    }

  </style>

  <?php   }else{ ?>

  <style>

    #d4m .d4m-fixed-background {

      background: #F0F0F5 !important;

    }

  </style>

  <?php   } ?>

  <?php  

  if($settings->get_option('d4mcart_scrollable') == 'N'){

    $d4mcart_scrollable_position = 'relative !important';

    ?>

    <style>#d4m .not-scroll-custom{ margin-top: 0 !important; }</style>

    <?php  

  }else{

    $d4mcart_scrollable_position = 'relative';

  }

  ?>

    <?php  

    echo "<style>

  /* primary color */

    .do4me{

      color: " . $settings->get_option('d4mtext_color') . " !important;

    }

    .do4me .d4m-link.d4m-mybookings{

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-link.d4m-mybookings:hover{

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4mprimary_color') . " !important;

    }





    /* JAY WANKHEDE */

    .do4me .d4m-link.d4m-one-step{

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-link.d4m-one-step:hover{

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4mprimary_color') . " !important;

    }



    /* */





    .do4me .d4m-main-left .d4m-list-header .d4m-logged-in-user a.d4m-link,

    .do4me .d4m-complete-booking-main .d4m-link,

    .do4me .d4m-discount-coupons a.d4m-apply-coupon.d4m-link{

      color: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .d4m-link:hover,

    .do4me .d4m-main-left .d4m-list-header .d4m-logged-in-user a.d4m-link:hover,

    .do4me .d4m-complete-booking-main .d4m-link:hover,

    .do4me .d4m-discount-coupons a.d4m-apply-coupon.d4m-link:hover{

      color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me a,

    .do4me .d4m-link,

    .do4me .d4m-addon-count .d4m-btn-group .d4m-btn-text{

      color: " . $settings->get_option('d4mtext_color') . " !important;

    }

    .do4me a.d4m-back-to-top i.icon-arrow-up,

    .do4me .calendar-wrapper .calendar-header a.next-date:hover .icon-arrow-right:before,

    .do4me .calendar-wrapper .calendar-header a.previous-date:hover .icon-arrow-left:before{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    .do4me .calendar-body .d4m-week:hover a span,

    .do4me .d4m-extra-services-list ul.addon-service-list li .d4m-addon-ser:hover .addon-price{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    .do4me #d4m-type-2 .service-selection-main .d4m-services-dropdown .d4m-service-list:hover,

    .do4me #d4m-type-method .d4m-services-method-dropdown .d4m-service-method-list:hover,

    .do4me .common-selection-main .common-data-dropdown .data-list:hover{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .selected-is:hover,

    .do4me #d4m-type-2 .service-is:hover,

    .do4me #d4m-type-method .service-method-is:hover{

      border-color:" . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .d4m-extra-services-list ul.addon-service-list li .d4m-addon-ser:hover span:before{

      border-top-color:" . $settings->get_option('d4mprimary_color') . " !important;

    }

    

    .do4me .calendar-wrapper .calendar-header a.next-date:hover,

    .do4me .calendar-wrapper .calendar-header a.previous-date:hover,

    .do4me .calendar-body .d4m-week:hover,

    #d4m .bar:before, .bar:after{

      background:" . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    .do4me .calendar-body .dates .d4m-week.by_default_today_selected.active_today span,

    .do4me .calendar-body .d4m-show-time .time-slot-container ul li.time-slot,

    .do4me .calendar-body .dates .d4m-week.active span {

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    

    .do4me .d4m-custom-checkbox  ul.d4m-checkbox-list label:hover span,

    .do4me .d4m-custom-radio ul.d4m-radio-list label:hover span{

      border:1px solid " . $settings->get_option('d4msecondary_color') . " !important;

    }

    #d4m-login .d4m-main-forget-password .d4m-info-btn,

    .do4me button,

    .do4me #d4m-front-forget-password .d4m-front-forget-password .d4m-info-btn,  

    .do4me .d4m-button{

      color:" . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4mprimary_color') . " !important;

      border: 2px solid " . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .d4m-display-coupon-code .d4m-coupon-value{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background:" . $settings->get_option('d4msecondary_color') . " !important;

    }

    /* for front date legends */

    

    .do4me .calendar-body .d4m-show-time .time-slot-container .d4m-slot-legends .d4m-selected-new{

      background: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    /* seconday color */

    .nicescroll-cursors{

      background-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

        

      .do4me .calendar-body .dates .d4m-week.active{

        background: " . $settings->get_option('d4msecondary_color') . " !important;

      }

  /* background color all css  HOVER */

    .d4m-white-color a{

      color: #FFFFFF !important;

      background: #FFFFFF !important;

    }

    .do4me .d4m-discount-list ul.d4m-discount-often li input[type='radio']:checked + .d4m-btn-discount{

      border-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-selected,

    .do4me .d4m-selected-data,

    .do4me .d4m-provider-list ul.provders-list li input[type='radio']:checked + lable span,

    .do4me .d4m-list-services ul.services-list li input[type='radio']:checked + lable span,

    .do4me .d4m-extra-services-list ul.addon-service-list li input[type='checkbox']:checked label span,

    .do4me #d4m-tslots .d4m-date-time-main .time-slot-selection-main .time-slot.d4m-selected,

    .do4me .d4m-button:hover,

    .do4me-login .d4m-main-forget-password .d4m-info-btn:hover,

    .do4me #d4m-front-forget-password .d4m-front-forget-password .d4m-info-btn:hover,

    .do4me  input[type='submit']:hover,

    .do4me  input[type='reset']:hover,

    .do4me  input[type='button']:hover,

    .do4me  button:hover{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

      background: " . $settings->get_option('d4msecondary_color') . " !important;

      border-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    .do4me .promocodes{

       color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

       background: " . $settings->get_option('d4msecondary_color') . " !important;

       border-color: " . $settings->get_option('d4msecondary_color') . " !important;

      }

    .do4me #d4m-price-scroll{

      border-color: " . $settings->get_option('d4mprimary_color') . " !important;

      box-shadow: 0 4px 4px #ccc !important;

      position: ".$d4mcart_scrollable_position.";

    }

    

    .do4me .d4m-cart-wrapper .d4m-cart-label-total-amount,

    .do4me .d4m-cart-wrapper .d4m-cart-total-amount{

      color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    .do4me .d4m-list-services ul.services-list li input[type='radio']:checked + .d4m-service ,

    .do4me .d4m-provider-list ul.provders-list li input[type='radio']:checked + .d4m-provider ,

    .do4me .d4m-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .d4m-addon-ser {

      border-color: " . $settings->get_option('d4msecondary_color') . " !important;

      box-shadow: 0 0 5px 1px " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .d4m-addon-ser span:before{

      border-top-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .d4m-addon-ser .addon-price{

      color: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    

    

    .do4me .border-c:hover,

    .do4me .d4m-list-services ul.services-list li .d4m-service:hover,

    .do4me .d4m-list-services ul.addon-service-list li .d4m-addon-ser:hover,

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bedroom-box .d4m-bedroom-btn:hover,

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bathroom-box .d4m-bathroom-btn:hover,

    .do4me #d4m-duration-main.d4m-service-duration .d4m-duration-list .duration-box .d4m-duration-btn:hover,

    .do4me .d4m-extra-services-list .d4m-addon-extra-count .d4m-common-addon-list .d4m-addon-box .d4m-addon-btn:hover,

    .do4me .d4m-discount-list ul.d4m-discount-often li .d4m-btn-discount:hover,

    .do4me .d4m-custom-radio ul.d4m-radio-list label:hover span,

    .do4me .d4m-custom-checkbox  ul.d4m-checkbox-list label:hover span{

      border-color: " . $settings->get_option('d4mprimary_color') . " !important;

      

    }

    

    

    .do4me .d4m-custom-checkbox  ul.d4m-checkbox-list input[type='checkbox']:checked + label span{

      border: 1px solid " . $settings->get_option('d4msecondary_color') . " !important;

      background: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4m-custom-radio ul.d4m-radio-list input[type='radio']:checked + label span{

      border:5px solid " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bedroom-box .d4m-bedroom-btn.d4m-bed-selected,

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bathroom-box .d4m-bathroom-btn.d4m-bath-selected,

    .do4me #d4m-duration-main.d4m-service-duration .d4m-duration-list .duration-box .d4m-duration-btn.duration-box-selected,

    .do4me .d4m-extra-services-list .d4m-addon-extra-count .d4m-common-addon-list .d4m-addon-box .d4m-addon-selected{

      background: " . $settings->get_option('d4msecondary_color') . " !important;

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

      border-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    .do4me .d4m-button.d4m-btn-abs,

    .do4me .panel-login .panel-heading .col-xs-6,

    .do4me a.d4m-back-to-top {

      background-color: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me a.d4m-back-to-top:hover

    {

      background-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    .do4me .calendar-body .dates .d4m-week.by_default_today_selected{

      background-color: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .calendar-body .dates .d4m-week.by_default_today_selected a span{

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    

    .do4me .calendar-body .dates .d4m-week.selected_date.active{

      background-color: " . $settings->get_option('d4msecondary_color') . " !important;

      border-bottom: thin solid " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .calendar-body .d4m-show-time .time-slot-container ul li.time-slot:hover,

    .do4me .calendar-body .d4m-show-time .time-slot-container ul li.time-slot.d4m-booked{

      background-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    

    

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bedroom-box .d4m-bedroom-btn.d4m-bed-selected,

    .do4me #d4m-meth-unit-type-2.d4m-meth-unit-count .bathroom-box .d4m-bathroom-btn.d4m-bath-selected,

    .do4me #d4m-duration-main.d4m-service-duration .d4m-duration-list .duration-box .d4m-duration-btn.duration-box-selected,

    .do4me .d4m-extra-services-list .d4m-addon-extra-count .d4m-common-addon-list .d4m-addon-box .d4m-addon-selected{

      /* background: " . $settings->get_option('d4msecondary_color') . " !important; */

    }

    

    

    

    /* hover inputs */

    .do4me input[type='text']:hover,

    .do4me input[type='password']:hover,

    .do4me input[type='email']:hover,

    .do4me input[type='url']:hover,

    .do4me input[type='tel']:hover,

    .do4me input[type='number']:hover,

    .do4me input[type='range']:hover,

    .do4me input[type='date']:hover,

    .do4me textarea:hover,

    .do4me select:hover,

    .do4me input[type='search']:hover,

    .do4me input[type='submit']:hover,

    .do4me input[type='button']:hover{

      border-color: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    

    /* Focus inputs */

    .do4me input[type='text']:focus,

    .do4me input[type='password']:focus,

    .do4me input[type='email']:focus,

    .do4me input[type='url']:focus,

    .do4me input[type='tel']:focus,

    .do4me input[type='number']:focus,

    .do4me input[type='range']:focus,

    .do4me input[type='date']:focus,

    .do4me textarea:focus,

    .do4me select:focus,

    .do4me input[type='search']:focus,

    .do4me input[type='submit']:focus,

    .do4me input[type='button']:focus{

      border-color: " . $settings->get_option('d4msecondary_color') . " !important;

      /* box-shadow: 0 0 0 1.5px " . $settings->get_option('d4msecondary_color') . " inset !important; */

    }

    .do4me .d4m-tooltip-link {color: " . $settings->get_option('d4msecondary_color') . " !important;}

      /* for custom css option */

    ".$settings->get_option('d4mcustom_css')."

    

    .do4me .d4mmethod_tab-slider--nav .d4mmethod_tab-slider-tabs {

      background: " . $settings->get_option('d4mprimary_color') . " !important;

    }

    .do4me .d4mmethod_tab-slider--nav .d4mmethod_tab-slider-tabs:after {

      background: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .do4me .d4mmethod_tab-slider--nav .d4mmethod_tab-slider-trigger {

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    .do4me .d4mmethod_tab-slider--nav .d4mmethod_tab-slider-trigger.active {

      color: " . $settings->get_option('d4mtext_color_on_bg') . " !important;

    }

    .d4m-list-services ul.services-list li input[type=\"radio\"]:checked + .d4m-service::after{

      background-color: " . $settings->get_option('d4msecondary_color') . " !important;

    }

    .rating-md{

      font-size: 1.5em !important ;

      display: table;

      margin: auto;

    }

  </style>";

    ?>

    <script>

        jQuery(document).ready(function () {

            var $sidebar = jQuery("#d4m-price-scroll"),

                $window = jQuery(window),

                offset = $sidebar.offset(),

                topPadding = 250;

            fulloffset = jQuery("#d4m").offset();



            $window.scroll(function () {

                var color = jQuery('#color_box').val();

                jQuery("#d4m-price-scroll").css({'box-shadow': '0px 0px 1px ' + color + '', 'position': 'absolute'});

            });

        });

    </script>

    <script type="text/javascript">

      function myFunction() {

        var input = document.getElementById('coupon_val')

        var div = document.getElementById('display_code');

        div.innerHTML = input.value;

      }

    </script>



    <script type="text/javascript">

      function myFunction() {

        var input = document.getElementById('user_coupon_val')

        var div = document.getElementById('display_user_code');

        div.innerHTML = input.value;

      }

    </script>

  

</head>

<body>

<div class="d4m-wrapper do4me" id="d4m"> <!-- main wrapper -->

<div class="d4m-fixed-background"></div>

  <!-- loader -->

  <?php   if($settings->get_option("d4mloader")== 'css' && $settings->get_option("d4mcustom_css_loader") != ''){ ?>

    <div class="d4m-loading-main" align="center">

      <?php   echo $settings->get_option("d4mcustom_css_loader"); ?>

    </div>

  <?php   }elseif($settings->get_option("d4mloader")== 'gif' && $settings->get_option("d4mcustom_gif_loader") != ''){ ?>

    <div class="d4m-loading-main" align="center">

      <img style="margin-top:18%;" src="<?php  echo BASE_URL; ?>/assets/images/gif-loader/<?php  echo $settings->get_option("d4mcustom_gif_loader"); ?>"></img>

    </div>

  <?php   }else{ ?>

    <div class="d4m-loading-main">

      <div class="loader">Loading...</div>

    </div>

  <?php   } ?>

  <?php  

  if($settings->get_option("d4mspecial_offer") == "Y"){

  ?>

<div class="promocodes" id="promocodes"><?php  echo $settings->get_option("d4mspecial_offer_text"); ?></div>

  <?php  

  }

  ?>

    <div class="d4m-main-wrapper">

      <div class="d4mcontainer">

        <!-- left side main booking form -->



        <?php  

        /* added for display flags start */

        $langs_selects = $settings->count_lang();

        if($settings->get_option("d4mfront_language_selection_dropdown") == "Y"  && $langs_selects > 1 ){

          ?>

          <div class="d4m-sm-12 mb-30 mt-25 np">

          

          </div>

          <?php  

        }

        /* added for display flags end */

        ?>

        <?php  

        /* added for display flags start */

        $langs_selects = $settings->count_lang();

        if($settings->get_option("d4mfront_language_selection_dropdown") == "Y"  && $langs_selects > 1 ){

          ?>

          <div class="d4m-main-left d4m-sm-7 d4m-md-7 d4m-xs-12 br-5 np d4mmb_10 common-bg">

          <?php  

        }else{

          ?>

          <div class="d4m-main-left d4m-sm-7 d4m-md-7 d4m-xs-12 mt-30 br-5 np">

          <?php  

        }

        ?>

            <div class="d4m-sm-12 d4m-md-12 ta-c d4m-location-header">

        <?php   if($settings->get_option('d4mcompany_logo') != "" &&  $settings->get_option('d4mcompany_logo_display') == "Y"){?>

        

        <div id="d4m-logo">

         <a href="<?php  echo SITE_URL; ?>">

          <img style="max-height: 150px; max-width: 150px;" src="<?php  echo SITE_URL."assets/images/services/".$settings->get_option('d4mcompany_logo');?>" />

         </a>

        </div>

        <?php   } ?>

        <?php   if($settings->get_option('d4mcompany_title_display') == "Y"){ ?>

        <h2 class="header2"><?php  echo $settings->get_option('d4mcompany_name'); ?></h2>

        <?php   } ?>

                    <?php  

          if($settings->get_option('d4mcompany_header_address') == "Y"){

            $address = $settings->get_option('d4mcompany_address');

                    $city = $settings->get_option('d4mcompany_city');

                    $state = $settings->get_option('d4mcompany_state');

          $phone = $settings->get_option('d4mcompany_phone');

                    ?>

                    

                    <h6 class="header6"><?php  if ($address == '') {

                            echo '';

                        } else {

                            echo $address . ', ';

                        } ?><?php  if ($city == '') {

                            echo '';

                        } else {

                            echo $city . ', ';

                        } ?><?php  if ($state == '') {

                            echo '';

                        } else {

                            echo $state;

                        } ?><span class="d4m-company-phone">

              <?php   if ($phone == '' || strlen($phone) <= 6 ) {

                echo '';

              } else {

                echo $phone;

              } ?>



            </span>

            <br>

            

          </h6>

          <?php   } ?>

          

          <a class="d4m-link d4m-mybookings" target="_blank" href="<?php  echo SITE_URL . "admin/my-appointments.php"; ?>"><?php  echo $label_language_values['my_bookings']; ?></a>

          <br>

        



          <?php  if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_my_bookings")!=''){?>

          <a class="d4m-tooltip mybooking-tt" href="#" data-placement="right" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_my_bookings");?>"><i class="fa fa-info-circle fa-lg"></i></a>

          <?php   } ?>

             

                </div>

        <?php   if($settings->get_option("d4mpostalcode_status") == 'Y'){ ?>

                <div class="d4m-list-services d4m-common-box">

                    <div class="d4m-list-header">

                        <h3 class="header3"><?php  echo $label_language_values['where_would_you_like_us_to_provide_service']; ?></h3>

                        <!--<p class="d4m-sub">Choose your service and property size</p>-->

                    </div>

                    <div class="d4m-address-area-main">



                        <div class="d4m-postal-code">

                            <h6 class="header6"><?php  echo $label_language_values['your_postal_code']; ?>

              <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_postal_code")!=''){?>

                 <a class="d4m-tooltip" href='#' title="<?php  echo $settings->get_option("d4mfront_tool_tips_postal_code");?>"><i class="fa fa-info-circle fa-lg"></i></a>  

                <?php   } ?></h6>

                            <div class="d4m-md-3 d4m-sm-6 d4m-xs-12 remove_show_error_class">

                                <?php  

                                $postalcode_placeholder = explode(',',$settings->get_option_postal("d4mpostal_code"));

                                ?>

                                <input type="text" class="d4m-postal-input" name="d4mpostal_code" id="d4mpostal_code" placeholder="<?php  echo $postalcode_placeholder[0]; ?>"/>

                                <label class="postal_code_error error"></label>

                                <label class="postal_code_available"></label>

                            </div>

                        </div>

                    </div>

                </div>

        <?php   } ?>

        

                <!-- end area based -->

                <div class="d4m-list-services d4m-common-box fl hide_allsss">

                    <div class="d4m-list-header">

                        <h3 class="header3"><?php  echo $label_language_values['choose_service']; ?>

             <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_services")!=''){?>

            <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_services");?>"><i class="fa fa-info-circle fa-lg"></i></a>  

            <?php   } ?>

            </h3>

            

                        <label class="service_not_selected_error" id="service_not_selected_error"></label>

                    </div>

                    <input id="total_cart_count" type="hidden" name="total_cart_count" value='1'/>

                    <!-- area based select cleaning -->

                    <?php  

                    if ($settings->get_option('d4mservice_default_design') == 1) {

                        ?>

                        <!-- 1.box style services selection radio selection -->

                        <ul class="services-list">

                            <?php  

                            $services_data = $objservice->readall_for_frontend_services();

                            if (mysqli_num_rows($services_data) > 0) {

                                while ($s_arr = mysqli_fetch_array($services_data)) {

                                    ?>

                                    <li 

                  <?php   if($settings->get_option('d4mcompany_service_desc_status') != "" &&  $settings->get_option('d4mcompany_service_desc_status') == "Y"){ ?>

                  

                  

                  title='<?php  echo $s_arr['description'];?>' class="d4m-sm-6 d4m-md-4 d4m-lg-3 d4m-xs-12 remove_service_class ser_details d4m-tooltip-services tooltipstered mb-20"

                  <?php   } else {

                    echo "class='d4m-sm-6 d4m-md-4 d4m-lg-3 d4m-xs-12 remove_service_class ser_details'";                   

                  }  ?>

                                        data-servicetitle="<?php  echo $s_arr['title']; ?>"

                                        data-id="<?php  echo $s_arr['id']; ?>">

                                        <input type="radio" name="service-radio"

                                               id="d4m-service-<?php  echo $s_arr['id']; ?>"

                                               class="make_service_disable"/>

                                        <label class="d4m-service d4m-service-embed border-c" for="d4m-service-<?php  echo $s_arr['id']; ?>">

                                            <?php  

                                            if ($s_arr['image'] == '') {

                                                $s_image = 'default_service.png';

                                            } else {

                                                $s_image = $s_arr['image'];

                                            }

                                            ?>
                                      <?php 
                                  if($settings->get_option('d4mservice_design') == "d4msquare"){
                                ?>
                                  <div class="d4m-service-img-square">
                                    <img class="d4m-image" src="<?php  echo SITE_URL; ?>assets/images/services/<?php  echo $s_image; ?>"/>
                                  </div>
                                <?php 
                                  } else {
                                ?>
                                  <div class="d4m-service-img">
                                    <img class="d4m-image" src="<?php  echo SITE_URL; ?>assets/images/services/<?php  echo $s_image; ?>"/>
                                  </div>
                                <?php 
                                  }
                                ?>
                                    
                             <div class="service-name fl ta-c"><?php  echo $s_arr['title']; ?></div>

                                        </label>
                             </li>

                                <?php  

                                }?>

                           <?php    } else {

                                ?>

                                <li class="d4m-sm-12 d4m-md-12 d4m-xs-12 d4m-no-service-box"><?php  echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?>

                                </li>

                            <?php  

                            }

                            ?>

                        </ul>

                        <!--  1 end box style service selection -->

            <?php  

            if (mysqli_num_rows($services_data) === 1){

              $ser_arry = mysqli_fetch_array($services_data)

              ?>

              <script>

              /** Make Service Selected **/

              jQuery(document).ready(function() {

                jQuery('.ser_details').trigger('click');

              });

              </script>

              <?php  

            }

                    } else {

                        ?>

            <input type="radio" style="display:none;" name="service-radio" id="d4m-service-0" value='off' class="make_service_disable"/>

                        <!-- 2. sevice dropdown selection -->

          <?php  

                        $services_data = $objservice->readall_for_frontend_services();

                        if (mysqli_num_rows($services_data) > 0) {

                            ?>

                            <label class="service_not_selected_error_d2" id="service_not_selected_error_d2"><?php  echo $label_language_values['please_seled4mservice']; ?></label>

                            <div class="services-list-dropdown fl" id="d4m-type-2">

                            <div class="service-selection-main">

                                <div class="service-is" title="<?php  echo $label_language_values['choose_your_service'];?>">

                                    <div class="d4m-service-list" id="d4mselected_service">

                                        <i class="icon-settings service-image icons"></i>



                                        <h3 class="service-name ser_name_for_error"><?php  echo $label_language_values['cleaning_service']; ?></h3>

                                    </div>

                                </div>

                                <div class="d4m-services-dropdown remove_service_data"> <?php  

                                    while ($s_arr = mysqli_fetch_array($services_data)) { ?>

                                        <div class="d4m-service-list seled4mservice remove_service_class ser_details"

                                             data-servicetitle="<?php  echo $s_arr['title']; ?>"

                                             data-id="<?php  echo $s_arr['id']; ?>">

                                            <?php  

                                            if ($s_arr['image'] == '') {

                                                $s_image = 'default_service.png';

                                            } else {

                                                $s_image = $s_arr['image'];

                                            }

                                            ?>

                                            <img class="service-image"

                                                 src="<?php  echo SITE_URL; ?>assets/images/services/<?php  echo $s_image; ?>"

                                                 title="<?php  echo $label_language_values['service_image']; ?>"/>



                                            <h3 class="service-name"><?php  echo $s_arr['title']; ?></h3>

                                        </div>

                                    <?php   }

                                ?></div>

                            </div> </div><?php 

              if (mysqli_num_rows($services_data) === 1){

                  $st_arry = mysqli_fetch_array($services_data)

                  ?>

                  <script>

                  /** Make Service Selected **/

                  jQuery(document).ready(function() {

                    jQuery('.seled4mservice').trigger('click');

                  });

                  </script>

                  <?php  

                }

                        } else {

                            ?>

                            <div class="d4m-sm-12 d4m-md-12 d4m-xs-12 d4m-no-service-box"><?php  echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?></div>

                        <?php  

                        }

                        ?>

                    <!-- 2. end service dropdown selection -->

                    <?php  

                    }

                    ?>

          <div class="d4m-scroll-meth-unit"></div>



                    <div class="services-method-list-dropdown fl show_methods_after_service_selection show_single_service_method" id="d4m-type-method">

                        <div class="service-method-selection-main">

                            <div class="d4m-services-method-dropdown s_method_names">

                            </div>

                        </div>

                    </div>

                    <label class="empty_cart_error" id="empty_cart_error"></label>

          <label class="no_units_in_cart_error" id="no_units_in_cart_error"></label>

                    <input type='hidden' id="no_units_in_cart_err" value=''>

                    <input type='hidden' id="no_units_in_cart_err_count" value=''>

                    <!-- hrs selected  -->

                    <div class="d4m-service-duration d4m-md-12 d4m-sm-12 s_m_units_design_1" id="d4m-duration-main">

                        <div class="d4m-inner-box border-c">



                            <div class="fl d4m-md-12 mt-5 mb-15 np duration_hrs">

                            </div>

                            <!-- end duration hrs  -->

                        </div>

                    </div>

                    <!-- 1. bedroom and bathroom counting dropdown -->

                    <div class="d4m-meth-unit-count d4m-md-12 d4m-sm-12 np d4mhidden fl s_m_units_design_2"

                         id="d4m-meth-unit-type-1">

                        <div class="d4m-inner-box border-c ser_design_2_units">



                        </div>

                    </div>

                    <!-- 1.end dropdown list bathroom bedroom -->

                    <!-- 2. boxed bathroom bedroom  -->

                    <div class="d4m-meth-unit-count d4m-md-12 d4m-sm-12 np s_m_units_design_3" id="d4m-meth-unit-type-2">

                        <div class="d4m-inner-box border-c ser_design_3_units">



                        </div>

                    </div>

                    <!-- 2. end boxed bathroom bedroom -->



                    <div class="d4m-meth-unit-count d4m-md-12 d4m-sm-12 s_m_units_design_4" id="d4m-meth-unit-type-3">

                        <div class="d4m-inner-box border-c ">

                            <div class="fl d4m-bedrooms d4m-btn-group d4m-md-12 mt-5 mb-15 np">

                                <div class="d4m-inner-box border-c ser_design_4_units">



                                </div>

                            </div>

                        </div>

                    </div>





                </div>

                <!-- end service list -->





                <!-- Module third area based -->

                <div class="d4m-list-services d4m-common-box s_m_units_design_5 ser_design_5_units">



                </div>

                <!-- end area based -->

                <!-- end module third area based -->



                <div class="d4m-extra-services-list d4m-common-box add_on_lists hide_allsss_addons mt-20">



                </div>



                <!-- how often discount -->

                <?php      

                if($settings->get_option("d4mrecurrence_booking_status") == "Y"){

                $d_data = $frequently_discount->readall_front();

                if (mysqli_num_rows($d_data) > 0) {

                    ?>

                    <div class="d4m-discount-list d4m-common-box">

                        <div class="d4m-list-header">

                          <h3 class="header3"><?php  echo $label_language_values['how_often_would_you_like_us_provide_service']; ?>

               <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_frequently_discount")!=''){?>

              <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_frequently_discount");?>"><i class="fa fa-info-circle fa-lg"></i></a> 

              <?php   } ?>

                          </h3>

                      <label class="freq_disc_empty_cart_error error" style="color:red"></label>

                        </div>

                        <ul class="d4m-discount-often">

                            <?php  

                            while ($f_discount = mysqli_fetch_array($d_data)) {

                                ?>

                                <li class="d4m-sm-6 d4m-md-3 d4m-xs-12 mb-10">

                                    <div class="discount-text f-l"><span class="discount-price"><?php  if ($f_discount['labels'] != '') { ?> <?php   echo ucwords($f_discount['labels']); } ?></span>

                                    </div>

                                    <input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>"/>

                                    <label class="d4m-btn-discount" for="discount-often-<?php  echo $f_discount['id']; ?>">

                                      <span class="float-left"><?php  echo ucwords($f_discount['discount_typename']); ?></span>

                                      <span class="d4m-discount-check float-right"></span>

                                    </label>

                                </li>

                            <?php  

                            }

                            ?>

                        </ul>

                    </div><!-- how often discount end -->

                <?php  

                } else {

                  $d_data = $frequently_discount->readall_first_once();

                  $f_discount = mysqli_fetch_assoc($d_data);

                    ?>

                    <input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>" style="display: none;"/>

                  <?php    

                }

                }else{

                  $d_data = $frequently_discount->readall_first_once();

                  $f_discount = mysqli_fetch_assoc($d_data);

                    ?>

                    <input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>" style="display: none;" />

                  <?php     

                }

                ?>

        

        <div class="d4m-provider-list d4m-common-box">

          <div class="d4m-list-header">

          <h3 class="header3 show_seled4mstaff_title" style="display:none;"><?php  echo $label_language_values['please_seled4mprovider'];;?></h3>

            <ul class="provders-list"></ul>

          </div>

        </div>

        

                <!-- date time selection -->

                <div class="d4m-date-time-main d4m-common-box hide_allsss">

                    <div class="d4m-list-header">

                        <h3 class="header3"><?php  echo $label_language_values['when_would_you_like_us_to_come']; ?>

             <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_time_slots")!=''){?>

            <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_time_slots");?>"><i class="fa fa-info-circle fa-lg"></i></a>  

            <?php   } ?>

            </h3>

                    </div>



                    <div class="d4m-md-12 d4m-sm-12 d4m-xs-12 d4m-datetime-select-main">

                        <div class="d4m-datetime-select">

                            <label class="date_time_error" id="date_time_error_id" for="complete_bookings"></label>



                            <div class="calendar-wrapper cal_info">



                            </div>

                            <!-- end calendar-wrapper -->

                        </div>

                    </div>

                </div>

                <!-- date and time slots end  -->

                <!-- personal details -->

        <div class="d4m-user-info-main d4m-common-box existing_user_details hide_allsss mt-30">

                    <div class="d4m-list-header">

                        <h3 class="header3"><?php  echo $label_language_values['your_personal_details']; ?>

             <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_personal_details")!=''){?>

            <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_personal_details");?>"><i class="fa fa-info-circle fa-lg"></i></a>  

            <?php   } ?>

            </h3>

            

                        <p class="d4m-sub"><?php  echo $label_language_values['please_provide_your_address_and_contad4mdetails']; ?></p>



            <div class="d4m-logged-in-user client_logout">

                            <p class="welcome_msg_after_login pull-left log-per"><?php  echo $label_language_values['you_are_logged_in_as']; ?> <span class='fname'></span> <span class='lname'></span></p>

                            <a href="javascript:void(0)" class="d4m-link ml-10 per-logout" id="logout" data-id="<?php  if (isset($_SESSION['d4mlogin_user_id'])) { echo $_SESSION['d4mlogin_user_id']; } ?>" title="<?php  echo $label_language_values['log_out']; ?>"><?php  echo $label_language_values['log_out']; ?></a>

                        </div>

                    </div>

            <div class="d4m-main-details">

                            <div class="d4m-login-exist" id="d4m-login">

                                <div class="d4m-custom-radio">

                                    <ul class="d4m-radio-list hide_radio_btn_after_login">

                    <?php  

                    if($settings->get_option('d4mexisting_and_new_user_checkout') == 'on' && $settings->get_option('d4mguest_user_checkout') == 'on'){

                    ?>

                    <li class="d4m-exiting-user d4m-md-4 d4m-sm-6 d4m-xs-12">

                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>

                                            <label for="existing-user" class=""><span></span><?php  echo $label_language_values['existing_user']; ?></label>

                                        </li>

                                        <li class="d4m-new-user d4m-md-4 d4m-sm-6 d4m-xs-12">

                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>

                                            <label for="new-user" class=""><span></span><?php  echo $label_language_values['new_user']; ?>

                                            </label>

                                        </li>

                    <li class="d4m-guest-user d4m-md-4 d4m-sm-6 d4m-xs-12">

                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" name="user-selection" value="Guest-User"/>

                                            <label for="guest-user" class=""><span></span><?php  echo $label_language_values['guest_user']; ?></label>

                                        </li>

                    <?php  

                    }elseif($settings->get_option('d4mexisting_and_new_user_checkout') == 'off' && $settings->get_option('d4mguest_user_checkout') == 'on'){

                    ?>

                    <li class="d4m-guest-user d4m-md-4 d4m-sm-6 d4m-xs-12" style='display:none;'>

                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" checked="checked"  name="user-selection" value="Guest-User"/>

                                            <label for="guest-user" class=""><span></span><?php  echo $label_language_values['guest_user']; ?></label>

                                        </li>           

                    <?php  

                    }elseif($settings->get_option('d4mexisting_and_new_user_checkout') == 'on' && $settings->get_option('d4mguest_user_checkout') == 'off'){

                    ?>

                    <li class="d4m-exiting-user d4m-md-4 d4m-sm-6 d4m-xs-12">

                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>

                                            <label for="existing-user" class=""><span></span><?php  echo $label_language_values['existing_user']; ?></label>

                                        </li>

                                        <li class="d4m-new-user d4m-md-4 d4m-sm-6 d4m-xs-12">

                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>

                                            <label for="new-user" class=""><span></span><?php  echo $label_language_values['new_user']; ?>

                                            </label>

                                        </li>

                    <?php  

                    }

                    ?>

                                    </ul>

                                </div>



                                <div class="d4m-login-existing d4mhidden">

                                    <form id="user_login_form" class="" method="POST">

                                        

                                        <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row hide_login_email fancy_input_wrap">

                                            

                                            <input type="text" class="add_show_error_class_for_login error fancy_input" name="d4muser_name" id="d4m-user-name" onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>

                                                <span class="highlight"></span>

                          <span class="bar"></span>

                                            <label for="d4m-user-name" class="fancy_label"><?php  echo $label_language_values['your_email']; ?></label>



                                        </div>



                                        <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row hide_password fancy_input_wrap">

                                            

                                            <input type="password" class="add_show_error_class_for_login error fancy_input" name="d4muser_pass" id="d4m-user-pass" onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>

                                                <span class="highlight"></span>

                          <span class="bar"></span>

                                            <label for="d4m-user-pass" class="fancy_label"><?php  echo $label_language_values['your_password']; ?>

                                            </label>

                                        </div>



                                        <label class="login_unsuccessfull"></label>



                                        <div class="d4m-md-12 d4m-xs-12 mb-15 hide_login_btn">

                      <input type="hidden" value='not' id="check_login_click" />

                                            <a href="javascript:void(0)" class="d4m-button" id="login_existing_user" title="<?php  echo $label_language_values['log_in']; ?>"><?php  echo $label_language_values['log_in']; ?></a>

                                            <a href="javascript:void(0)" id="d4mforget_password" class="d4m-link" title="<?php  echo $label_language_values['forget_password']; ?>?"><?php  echo $label_language_values['forget_password']; ?></a>

                                        </div>



                                    </form>

                                </div>

                            </div>                        

                        <input type="hidden" id="color_box" data-id="<?php  echo $settings->get_option('d4msecondary_color'); ?>" value="<?php  echo $settings->get_option('d4msecondary_color'); ?>"/>



                        <form id="user_details_form" class="" method="post">

                <div class="d4m-new-user-details remove_preferred_password_and_preferred_email">

                                   

                                    <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                        <input type="text" name="d4memail" id="d4m-email" class="add_show_error_class error fancy_input"/>

                                            <span class="highlight"></span>

                        <span class="bar"></span>

                                        <label for="d4m-email" class="fancy_label"><?php  echo $label_language_values['preferred_email']; ?></label>

                                    </div>



                                    <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                        <input type="password" name="d4mpreffered_pass" id="d4m-preffered-pass" class="add_show_error_class error fancy_input"/>

                                            <span class="highlight"></span>

                        <span class="bar"></span>

                                        <label for="d4m-preffered-pass" class="fancy_label"><?php  echo $label_language_values['preferred_password']; ?></label>

                                    </div>



                                </div>

                            <div class="d4m-peronal-details">

                

                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row remove_guest_user_preferred_email fancy_input_wrap">

                  

                  <input type="text" name="d4memail_guest" class="add_show_error_class error fancy_input" id="d4m-email-guest" />

                      <span class="highlight"></span>

                      <span class="bar"></span>

                  <label for="d4m-email-guest" class="fancy_label"><?php  echo $label_language_values['preferred_email']; ?>

                  </label>

                </div>



                <?php   $fn_check = explode(",",$settings->get_option("d4mbf_first_name"));if($fn_check[0] == 'on'){ ?>

                                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                    

                                    <input type="text" name="d4mfirst_name" class="add_show_error_class error fancy_input" id="d4m-first-name" />

                                        <span class="highlight"></span>

                                        <span class="bar"></span>

                                    <label for="d4m-first-name" class="fancy_label"><?php  echo $label_language_values['first_name']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mfirst_name" id="d4m-first-name" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $ln_check = explode(",",$settings->get_option("d4mbf_last_name"));if($ln_check[0] == 'on'){ ?>

                                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                    

                                    <input type="text" class="add_show_error_class error fancy_input" name="d4mlast_name" id="d4m-last-name"/>

                                        <span class="highlight"></span>

                                        <span class="bar"></span>

                                    <label for="d4m-last-pass" class="fancy_label"><?php  echo $label_language_values['last_name']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mlast_name" id="d4m-last-name" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $phone_check = explode(",",$settings->get_option("d4mbf_phone")); if($phone_check[0] == 'on'){ ?>

                  <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap phone_no_wrap">

                    <input type="tel" value="" id="d4m-user-phone" class="add_show_error_class error fancy_input" name="d4muser_phone"/>

                    <span class="highlight"></span>

                    <span class="bar"></span>

                    <label for="d4m-user-phone" class="fancy_label"><?php  echo $label_language_values['phone']; ?></label>

<?php   if($settings->get_option('d4msms_nexmo_status') == "Y" ||  $settings->get_option('d4msms_twilio_status') == "Y" ||  $settings->get_option('d4msms_plivo_status') == "Y" ||  $settings->get_option('d4msms_textlocal_status') == "Y"){?>
                    <!-- Verify OTP Jay Wankhede -->
 <div class="verify-otp-wrap">
                       <button type="button" id="send_otp" class="btn btn-primary btn_otp" data-toggle="modal" data-target="#verify_otp">Verify OTP</button> 



                      <i class="fa fa-check fa-2x text-success checkmark" title="Verified Successfull"></i>
                  </div>
                   
										
<?php } ?>

                  </div>
   

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4muser_phone" id="d4m-user-phone" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $address_check = explode(",",$settings->get_option("d4mbf_address"));if($address_check[0] == 'on'){ ?>

                                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                   

                                    <input type="text" name="d4mstreet_address" id="d4m-street-address" class="add_show_error_class error fancy_input" />

                                          <span class="highlight"></span>

                                          <span class="bar"></span>

                                     <label for="d4m-street-address" class="fancy_label"><?php  echo $label_language_values['street_address']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mstreet_address" id="d4m-street-address" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $zip_check = explode(",",$settings->get_option("d4mbf_zip_code"));if($zip_check[0] == 'on'){ ?>

                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row remove_zip_code_class fancy_input_wrap">

                                    

                                    <input type="text" name="d4mzip_code" id="d4m-zip-code" class="add_show_error_class error fancy_input" />

                                          <span class="highlight"></span>

                                          <span class="bar"></span>

                                    <label for="d4m-zip-code" class="fancy_label"><?php  echo $label_language_values['zip_code']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mzip_code" id="d4m-zip-code" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $city_check = explode(",",$settings->get_option("d4mbf_city")); if($city_check[0] == 'on'){ ?>

                                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row remove_city_class fancy_input_wrap">

                                    

                                    <input type="text" name="d4mcity" id="d4m-city" class="add_show_error_class error fancy_input" />

                                          <span class="highlight"></span>

                                          <span class="bar"></span>

                                    <label for="d4m-city" class="fancy_label"><?php  echo $label_language_values['city']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mcity" id="d4m-city" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $state_check = explode(",",$settings->get_option("d4mbf_state")); if($state_check[0] == 'on'){ ?>

                                <div class="d4m-md-6 d4m-sm-6 d4m-xs-12 d4m-form-row remove_state_class fancy_input_wrap">

                                    

                                    <input type="text" name="d4mstate" id="d4m-state" class="add_show_error_class error fancy_input" />

                                          <span class="highlight"></span>

                                          <span class="bar"></span>

                                    <label for="d4m-state" class="fancy_label"><?php  echo $label_language_values['state']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" name="d4mstate" id="d4m-state" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                <?php   $notes_check = explode(",",$settings->get_option("d4mbf_notes")); if($notes_check[0] == 'on'){ ?>

                <div class="d4m-md-12 d4m-xs-12 d4m-form-row fancy_input_wrap">

                                   

                                    <textarea id="d4m-notes" class="add_show_error_class error fancy_input" rows="10"></textarea>

                                          <span class="highlight"></span>

                                          <span class="bar"></span>

                                     <label for="d4m-notes" class="fancy_label"><?php  echo $label_language_values['special_requests_notes']; ?></label>

                                </div>

                <?php   } else {

                  ?>

                  <input type="hidden" id="d4m-notes" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                



                <?php   

                if($settings->get_option('d4mvc_status')=="Y"){

                  ?>

                                <div class="d4m-custom-radio d4m-options-new d4m-md-6 d4m-sm-6 d4m-xs-12 mb-15">

                                    <label><?php  echo $label_language_values['do_you_have_a_vaccum_cleaner']; ?></label>

                                    <ul class="d4m-radio-list">

                                        <li>

                                            <input id="vaccum-yes" type="radio" checked="checked" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-Yes"/>

                                            <label for="vaccum-yes"><span></span><?php  echo $label_language_values['yes']; ?></label>

                                        </li>

                                        <li>

                                            <input id="vaccum-no" type="radio" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-No"/>

                                            <label for="vaccum-no"><span></span><?php  echo $label_language_values['no']; ?></label>

                                        </li>

                                    </ul>

                                </div>

                <?php   }?>

                <?php   

                if($settings->get_option('d4mp_status')=="Y"){

                  ?>

                                <div class="d4m-custom-radio d4m-options-new d4m-md-6 d4m-sm-6 d4m-xs-12 mb-10">

                                    <label><?php  echo $label_language_values['do_you_have_parking']; ?></label>

                                    <ul class="d4m-radio-list">

                                        <li>

                                            <input id="parking-yes" type="radio" checked="checked" class="input-radio p_status" name="parking" value="Parking-Yes"/>

                                            <label for="parking-yes"><span></span><?php  echo $label_language_values['yes']; ?></label>

                                        </li>

                                        <li>

                                            <input id="parking-no" type="radio" class="input-radio p_status"

                                                   name="parking" value="Parking-No"/>

                                            <label for="parking-no"><span></span><?php  echo $label_language_values['no']; ?></label>

                                        </li>



                                    </ul>

                                </div>

                <?php   }?>

                <?php   if($settings->get_option('d4mcompany_willwe_getin_status') != "" &&  $settings->get_option('d4mcompany_willwe_getin_status') == "Y"){?>

                                <div class="d4m-options-new d4m-md-12 d4m-xs-12 mb-10 d4m-form-row">

                                    <label><?php  echo $label_language_values['how_will_we_get_in']; ?></label>



                                    <div class="d4m-option-select">

                                        <select class="d4m-option-select" id="contad4mstatus">

                                            <option value="I'll be at home"><?php  echo $label_language_values['i_will_be_at_home']; ?></option>

                                            <option value="Please call me"><?php  echo $label_language_values['please_call_me']; ?></option>

                                            <option value="The key is with the doorman"><?php  echo $label_language_values['the_key_is_with_the_doorman']; ?></option>

                                            <option value="Other"><?php  echo $label_language_values['other']; ?></option>

                                        </select>

                                    </div>

                                    <div class="d4m-option-others pt-10 d4mhidden">

                                        <input type="text" name="other_contad4mstatus" class="add_show_error_class error" id="other_contad4mstatus" />

                                    </div>

                                </div>

                <?php   } ?>

<?php   

if( $settings->get_option('d4mappointment_details_display') == 'on' && ($address_check[0] == 'on' || $zip_check[0] == 'on' || $city_check[0] == 'on' || $state_check[0] == 'on'))

{ ?>            

                <div class="d4m-md-12 d4m-xs-12 d4m-form-row np">

                  <div class="row d4m-xs-12 mbi-30">

                    <h3 class="header3 pull-left mt-10 pl-5"><?php  echo $label_language_values['appointment_details']; ?></h3>

                    <div class="pull-left ml-10">

                    <div class="d4m-custom-checkbox">

                      <ul class="d4m-checkbox-list">

                        <li>

                          <input type="checkbox" id="retype_status" /> 

                          <label for="retype_status" class="">

                            (<?php  echo $label_language_values['same_as_above']; ?>) &nbsp;<span></span>

                          </label>

                        </li>

                      </ul>

                    </div>

                    </div>

                  </div>

                  <div class="cb"></div>

                  

                  

                  

                  <?php   

                  if($address_check[0] == 'on')

                  { ?>

                    <div class="d4m-md-12 d4m-xs-12 d4m-form-row fancy_input_wrap">

                      

                      <input type="text" id="app-street-address" name="app_street_address" class="add_show_error_class error fancy_input" >

                          <span class="highlight"></span>

                          <span class="bar"></span>

                      <label for="app-notes" class="fancy_label"><?php  echo $label_language_values['appointment_address']; ?></label>

                    </div>

              <?php     } else {

                  ?>

                  <input type="hidden" name="app_street_address" id="app-street-address" class="add_show_error_class error" value=""/>

                  <?php   } ?>

                  

                  

                  

                  <?php   

                  if($zip_check[0] == 'on')

                  { ?>

                    <div class="d4m-md-4 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                      

                      <input type="text" name="app_zip_code" id="app-zip-code" class="add_show_error_class error fancy_input"  <?php   if($settings->get_option('d4mpostalcode_status') == 'Y'){echo "readonly";} ?>/>

                          <span class="highlight"></span>

                          <span class="bar"></span>

                      <label for="app-zip-code" class="fancy_label"><?php  echo $label_language_values['appointment_zip']; ?></label>

                    </div>

              <?php     } else {

                  ?>

                  <input type="hidden" name="app_zip_code" id="app-zip-code" class="add_show_error_class error" value=""/>

                  <?php   

                  } ?>

                  

                  <?php    

                  if($city_check[0] == 'on')

                  { ?>

                    <div class="d4m-md-4 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                      

                      <input type="text" name="app_city" id="app-city" class="add_show_error_class error fancy_input" />

                          <span class="highlight"></span>

                          <span class="bar"></span>

                      <label for="app-city" class="fancy_label"><?php  echo $label_language_values['appointment_city']; ?></label>

                    </div>

              <?php     } else {

                  ?>

                  <input type="hidden" name="app_city" id="app-city" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                

                  <?php   

                  if($state_check[0] == 'on')

                  { ?>                      

         

                    <div class="d4m-md-4 d4m-sm-6 d4m-xs-12 d4m-form-row fancy_input_wrap">

                      

                      <input type="text" name="app_state" id="app-state" class="add_show_error_class error fancy_input" />

                          <span class="highlight"></span>

                          <span class="bar"></span>

                      <label for="app-state" class="fancy_label"><?php  echo $label_language_values['appointment_state']; ?></label>

                    </div>

              <?php     } else {

                  ?>

                  <input type="hidden" name="app_state" id="app-state" class="add_show_error_class error" value=""/>

                  <?php   

                } ?>

                  

                </div>

<?php    } ?> 

                            </div>

                    </div>

                    <!-- main details end -->

                </div>

                <!-- end personal details -->

                <!-- payment details -->



                <div class="d4m-common-box hide_allsss">

                    <!-- Promocodes -->

                    <?php  

              if ($settings->get_option('d4mshow_coupons_input_on_checkout') == 'on') {

              ?>

                <div class="d4m-discount-coupons d4m-md-12 mb-20">

                  <div class="d4m-form-rown">

                      <div class="d4m-coupon-input d4m-md-6 d4m-sm-12 d4m-xs-12 mt-10 mb-15 np fancy_input_wrap">

                          <input id="coupon_val" type="text" name="coupon_apply" class="d4m-coupon-input-text hide_coupon_textbox fancy_input coupon_val" placeholder="<?php  echo $label_language_values['have_a_promocode']; ?>" maxlength="22" onchange="myFunction()"/>

                                <span class="highlight"></span>

                                <span class="bar"></span>

                                <label for="d4m-user-name" class="fancy_label"></label>

                                <a href="javascript:void(0);" class="d4m-apply-coupon d4m-link hide_coupon_textbox"

                             name="apply-coupon" id="apply_coupon"><?php  echo $label_language_values['apply']; ?></a>

                               <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_tips_promocode")!=''){?>

                                  <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_tips_promocode");?>"><i class="fa fa-info-circle fa-lg"></i></a> 

                                <?php   } ?>

                          <label class="d4m-error ofh coupon_invalid_error"></label>

                          <!-- display coupon -->

                          <div class="d4m-display-coupon-code">

                            <div class="d4m-form-rown">

                              <div class="d4m-column d4m-md-7 d4m-xs-12 ofh">

                                <label><?php  echo $label_language_values['applied_promocode']; ?></label>

                              </div>

                              <div class="d4m-coupon-value-main d4m-md-5 d4m-xs-12">

                                <span class="d4m-coupon-value border-2" id="display_code"></span>

                                <img id="d4m-remove-applied-coupon" src="<?php  echo SITE_URL; ?>/assets/images/d4m-close.png" class="reverse_coupon" title="<?php  echo $label_language_values['remove_applied_coupon']; ?>"/>

                              </div>

                            </div>

                          </div>

                      </div>

                  </div>

                </div>

              <?php  

              }

              ?>



              <!-- Referral code -->

              <?php 

                

                if ($settings->get_option('d4mwallet_section') == 'on') {
                if ($settings->get_option('d4mreferral_status') == 'Y') {

                  if(empty($_GET["refer_code"])){

                ?>

                <div class="d4m-discount-coupons spaical_referral_class d4m-md-12 mb-20" style="<?php if(isset($_SESSION['d4mlogin_user_id']) && $_SESSION['d4mlogin_user_id'] !=""){ echo 'display:none'; }?>">

                  <div class="d4m-form-rown">

                    <div class="d4m-coupon-input d4m-md-6 d4m-sm-12 d4m-xs-12 mt-10 mb-15 np fancy_input_wrap">

                      <input id="referral_val" type="text" name="referral_val" class="d4m-coupon-input-text hide_referral_textbox fancy_input referral_val" placeholder="<?php  echo $label_language_values['have_a_referral_code']; ?>" maxlength="22"/>

                      <span class="highlight"></span>

                      <span class="bar"></span>

                      <label for="d4m-user-name" class="fancy_label"></label>

                      <a href="javascript:void(0);" class="d4m-apply-coupon d4m-link hide_referral_textbox" name="apply-coupon" id="apply_referral"><?php  echo $label_language_values['apply']; ?>

                      </a>

                      <label class="d4m-error ofh invalid_referral_error"></label>

                      <!-- display coupon -->

                      <div class="d4m-display-referral-code">

                        <div class="d4m-form-rown">

                          <div class="d4m-column d4m-md-7 d4m-xs-12 ofh">

                              <label>Applied referral code</label>

                          </div>

                          <div class="d4m-coupon-value-main d4m-md-5 d4m-xs-12">

                            <span class="d4m-coupon-value border-2" id="display_referral"></span>

                            <img id="d4m-remove-applied-coupon" src="<?php  echo SITE_URL; ?>/assets/images/d4m-close.png" class="user_referral_coupon" title="Remove applied coupon"/>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              <?php

                  
									}  


              }
              }

              ?>



              <div class="d4m-list-header mt-10">

                                <h3 class="header3"><?php  echo $label_language_values['preferred_payment_method']; ?>

                  <?php   if($settings->get_option("d4mfront_tool_tips_status")=='on' && $settings->get_option("d4mfront_tool_payment_method")!=''){?>

                <a class="d4m-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("d4mfront_tool_payment_method");?>"><i class="fa fa-info-circle fa-lg"></i></a> 

                <?php   } ?>

                </h3>

                

                            </div>

                       

                        <div class="d4m-main-payments fl padding10">

                            <div class="payments-container f-l" id="d4m-payments">

                                <label class="d4m-error-msg"><?php  echo $label_language_values['please_seled4mone_payment_method']; ?></label>

                                <label class="d4m-error-msg d4m-paypal-error" id="paypal_error"></label>



                                <div class="d4m-custom-radio d4m-payment-methods f-l">

                                    <ul class="d4m-radio-list d4m-all-pay-methods">

                    <?php    if ($settings->get_option('d4mpay_locally_status') == 'on') { ?>

                    <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="pay-at-venue">

                      <input type="radio" name="payment-methods" value="pay at venue" class="input-radio payment_gateway pay-cash" id="pay-cash"  checked="checked"/>

                      <label for="pay-cash" class="locally-radio"><span></span><?php  echo $label_language_values['pay_locally']; ?></label>

                                        </li>
										

                    

                    <?php   } ?>  

                    

                    <!-- bank transfer -->

                    <?php    if ($settings->get_option('d4mbank_transfer_status') == 'Y' && ($settings->get_option('d4mbank_name') != '' || $settings->get_option('d4maccount_name') != ''  || $settings->get_option('d4maccount_number') != '' || $settings->get_option('d4mbranch_code') != '' || $settings->get_option('d4mifsc_code') != '' || $settings->get_option('d4mbank_description') != '')) { ?>

                    <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="d4m-bank-transer">

                      <input type="radio" name="payment-methods" value="bank transfer" class="input-radio bank_transfer payment_gateway" id="bank-transer"  />

                      <label for="bank-transer" class="locally-radio"><span></span><?php  echo $label_language_values['bank_transfer']; ?></label>

                                        </li>

                    <?php   }?>

                

                    <?php if ($settings->get_option('d4mpaypal_express_checkout_status') == 'on') {

                    ?>

                      <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="pay-at-venue">

                        <input type="radio" name="payment-methods" value="paypal" class="input-radio payment_gateway" id="pay-paypal" checked="checked" />

                        <label for="pay-paypal"  class="locally-radio"><span></span><?php  echo $label_language_values['paypal']; ?><img src="<?php  echo SITE_URL; ?>/assets/images/cards/paypal.png" class="d4m-paypal-image" alt="PayPal"></label>

                      </li>

                    <?php  

                    } ?>



                     
<?php

 $wallet_status = $settings->get_option('d4mwallet_section');

 if($wallet_status=='on'){
	 
	
                if(isset($_SESSION['d4mlogin_user_id']) && $_SESSION['d4mlogin_user_id'] !=""){
												$id = $_SESSION['d4mlogin_user_id'];
												$objuserdetails->id = $id;
												$wallet_details = $objuserdetails->get_user_wallet_details();
												
												if(isset($wallet_details)){
													$wallet_amount =  $wallet_details[0];
												}else{
													$wallet_amount =  '';
												}
											?>                     

                      <li class="d4m-md-3 d4m-sm-6 d4m-xs-12 wallet_amount_display" id="pay-at-venue" style="<?php if($wallet_amount==''){ echo "display:none";}else{ echo "display:block"; } ?>">

                        <input type="radio" name="payment-methods" value="Wallet-payment" class="input-radio payment_gateway user_wallet_amount_value wallet_amount Wallet_payment" data-wallet="<?php echo $wallet_amount; ?>" id="wallet" checked="checked" />

                        <label for="wallet"  class="locally-radio"><?php echo "<span class='user_wallet_amount'><p style='margin-left: 25px;line-height: 1.2;'>".$label_language_values['wallet']."(".$settings->get_option('d4mcurrency_symbol').$wallet_amount.")</p></span>"; ?></label>

                      </li>

                    <?php  
										}else{ ?>
											<li class="d4m-md-3 d4m-sm-6 d4m-xs-12 wallet_amount_display" id="pay-at-venue" style="display:none">

                        

                      </li>
									<?php 	}
                     
                    } ?>

                    

                    <?php  

                    if ($settings->get_option('d4mpayumoney_status') == 'Y') {

                    ?>            

                      <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="pay-at-venue">

                        <input type="radio" name="payment-methods" value="payumoney" class="input-radio payment_gateway" id="payumoney" checked="checked" />

                        <label for="payumoney"  class="locally-radio"><span></span> <?php   echo $label_language_values['payumoney']; ?></label>

                      </li>

                    <?php  

                    } ?>

                     <?php   if($settings->get_option('d4mauthorizenet_status') == 'on' && $settings->get_option('d4mstripe_payment_form_status') != 'on' && $settings->get_option('d4m2checkout_status') != 'Y'){  ?>

                    <!-- new added -->

                    <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="card-payment">

                      <input type="radio" name="payment-methods" value="card-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>

                      <label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>

                    </li>

                    <?php    }  ?>

                    <?php   if ($settings->get_option('d4mauthorizenet_status') != 'on' && $settings->get_option('d4mstripe_payment_form_status') == 'on' && $settings->get_option('d4m2checkout_status') != 'Y'){  ?>

                    <!-- new added -->

                    <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="card-payment">

                      <input type="radio" name="payment-methods" value="stripe-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>

                      <label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>

                    </li>

                    <?php    }  ?>

                    <?php   if ($settings->get_option('d4mauthorizenet_status') != 'on' && $settings->get_option('d4mstripe_payment_form_status') != 'on' && $settings->get_option('d4m2checkout_status') == 'Y'){  ?>

                    <!-- new added -->

                    <li class="d4m-md-3 d4m-sm-6 d4m-xs-12" id="card-payment">

                      <input type="radio" name="payment-methods" value="2checkout-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>

                      <label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>

                    </li>

                    <?php    } ?>

                    <!-- Payment Start -->

                    <?php  

                    if(sizeof((array)$purchase_check)>0){

                      foreach($purchase_check as $key=>$val){

                        if($val == 'Y'){

                          echo $payment_hook->payment_payment_selection_hook($key);

                        }

                      }

                    }

                    ?>

                    <!-- Payment End -->

                                    </ul>

                                </div>

                            </div>

              

              

              

              <div id="d4m-pay-methods" class="payment-method-container f-l">



                                <div class="card-type-center f-l">

                                    <div class="common-payment-style d4mhidden" <?php   

                    if ($settings->get_option('d4mauthorizenet_status') == 'on' || $settings->get_option('d4mstripe_payment_form_status') == 'on' || $settings->get_option('d4m2checkout_status') == 'Y') {

                      echo " style='display:block;' ";

                    }

                    elseif(sizeof((array)$purchase_check)>0){

                      $check_pay = 'N';

                      $display_check = '';

                      foreach($purchase_check as $key=>$val){

                        if($val == 'Y'){

                          if($payment_hook->payment_display_cardbox_condition_hook($key) == true){

                            if($display_check == ''){

                              $display_check = " style='display:block;' ";

                              $check_pay = 'Y';

                            }elseif($display_check == " style='display:none;' "){

                              $display_check = " style='display:block;' ";

                              $check_pay = 'Y';

                            }

                          }else{

                            if($display_check == ''){

                              $display_check = " style='display:none;' ";

                              $check_pay = 'Y';

                            }elseif($display_check == " style='display:block;' "){

                              $display_check = " style='display:none;' ";

                              $check_pay = 'Y';

                            }

                          }

                        }

                      }

                      echo $display_check;

                    } ?> >

                                        <div class="payment-inner">

                      <?php   if($settings->get_option('d4m2checkout_status') == 'Y'){ ?>

                      <input id="token" name="token" type="hidden" value="">

                      <?php   } ?>

                                            <div id="card-payment-fields" class="d4m-md-12 d4m-sm-12">

                                                <div class="d4m-md-12 d4m-xs-12 d4m-header-bg">

                                                    <h4 class="header4"><?php  echo $label_language_values['card_details']; ?></h4>

                                                    

                                                </div>

                                                <div class="d4m-md-12">

                                                    <label id="d4m-card-payment-error" class="d4m-error-msg d4m-payment-error"><?php  echo $label_language_values['invalid_card_number']; ?><?php  echo $label_language_values['expiry_date_or_csv']; ?></label>  

                        </div>

                                                <div class="d4m-md-12 d4m-sm-12 d4m-xs-12 d4m-card-details">

                                                    <div class="d4m-form-row d4m-md-6 d4m-xs-12 d4m-sm-12">

                                                        <label><?php  echo $label_language_values['card_number']; ?></label>

                                                        <i class="icon-credit-card icons"></i>

                                                        <input class="cc-number d4m-card-number d4m-card-number1 common-fc" maxlength="20" size="20" data-stripe="number" type="tel">

                                                        <span class="card" aria-hidden="true"></span>



                                                    </div>



                                                    <div class="d4m-form-row d4m-md-4 d4m-sm-10 d4m-xs-12 d4m-exp-mnyr">

                                                      <div class="ex-month-set">
                                                        <!-- <label><?php //echo $label_language_values['expiry']; ?><?php  //echo $label_language_values['mm_yyyy']; ?></label> -->

                                                        <!-- <i class="icon-calendar icons"></i> -->
                                                        <label>Exp. Month</label>
                                                        <input data-stripe="exp-month" class="cc-exp-month d4m-exp-month common-fc" maxlength="2" type="tel" placeholder="<?php    echo date('m'); ?>" />
                                                      </div>

                                                      <div> <label>Exp. Year</label>
                                                        <input data-stripe="exp-year" class="cc-exp-year d4m-exp-year common-fc-2" maxlength="4" type="tel" placeholder="<?php    echo date('Y'); ?>" />
                                                      </div>

                                                    </div>

                                                    <div class="d4m-form-row d4m-md-2 d4m-sm-2 d4m-xs-12 d4m-stripe-cvc">

                                                        <label><?php  echo $label_language_values['cvc']; ?></label>

                                                        <i class="icon-lock icons"></i>

                                                        <input type="password" placeholder="●●●" maxlength="4" size="4" data-stripe="cvc" class="cc-cvc d4m-cvc-code common-fc" type="tel"/>



                                                    </div>

                                                </div>

                                                <div class="d4m-lock-image">

                                                  <div class="float-left">

                                                    <img src="<?php  echo SITE_URL; ?>/assets/images/cards/card-images.png" class="d4m-stripe-image" alt="Stripe" />

                                                  </div>

                                                  <div class="float-left ml-50">

                                                    <div class="d4m-lock-img"></div>

                                                    <div class="debit-lock-text">SAFE AND SECURE 256-BIT<br/> SSL ENCRYPTED PAYMENT</div>

                                                  </div>

                                                </div>



                                            </div>

                                        </div>

                                    </div>

                                </div>

              </div>  

              <!--  bank details popup -->

              <div id="d4m-bank-transfer-box" class="payment-method-container f-l">

                <div class="card-type-center f-l">

                                    <div class="common-payment-style-bank-transfer d4mhidden">

                                        <div class="payment-inner">

                      <div id="card-payment-fields" style="">

                                                <div class="d4m-md-12 d4m-xs-12 d4m-header-bg">

                                                    <h4 class="header4"><?php  echo $label_language_values['bank_details']; ?></h4>

                                                </div>

                                                <div class="d4m-md-12">

                                                    <table>

                            <tbody>

                              <?php   if($settings->get_option('d4mbank_name') != "")

                {?>

                <tr class="dc_acc_name">

                 <th><i class="fa fa-university b-icon" aria-hidden="true"></i><strong><?php  echo $label_language_values['bank_name']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4mbank_name');?></span></td>

                </tr>

               <?php   } 

               if($settings->get_option('d4maccount_name') != "")

                {?>

                <tr class="dc_acc_name">

                 <th><i class="fa fa-address-card b-icon" aria-hidden="true"></i><strong><?php  echo $label_language_values['account_name']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4maccount_name');?></span></td>

                </tr>

               <?php   }

               if($settings->get_option('d4maccount_number') != "")

                {?>

                <tr class="dc_acc_number">

                 <th><i class="fa fa-sort-numeric-asc b-icon" aria-hidden="true"></i><strong><?php  echo $label_language_values['account_number']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4maccount_number');?></span></td>

                </tr>

               <?php   } 

               if($settings->get_option('d4mbranch_code') != "")

                {?>

                <tr class="dc_branch_code">

                 <th><i class="fa fa-building b-icon" aria-hidden="true"></i><strong><?php  echo $label_language_values['branch_code']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4mbranch_code');?></span></td>

                </tr>

               <?php   }

               if($settings->get_option('d4mifsc_code') != "")

                {?>

                <tr class="dc_ifc_code">

                 <th><i class="fa fa-code b-icon" aria-hidden="true"></i><strong><?php  echo $label_language_values['ifsc_code']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4mifsc_code');?></span></td>

                </tr>

               <?php   }

               if($settings->get_option('d4mbank_description') != "")

                {?>

                <tr class="dc_ifc_code">

                 <th><strong><i class="fa fa-pencil-square-o b-icon" aria-hidden="true"></i><?php  echo $label_language_values['bank_description']; ?></strong></th>

                 <td><span class="amount"><?php  echo $settings->get_option('d4mbank_description');?></span></td>

                </tr>

                <?php   } ?>        

                            </tbody>

                          </table>

                        </div>

                      </div>

                    </div>

                  </div>  

                </div>

              </div>  

                         

                        </div>

                  

                </div>

                <!-- end payment detials -->

  

            </div>

            <!-- left side end -->

      

            <!-- right side cart -->

      <?php  

      /* added for display flags start */

      $langs_selects = $settings->count_lang();

      if($settings->get_option("d4mfront_language_selection_dropdown") == "Y"  && $langs_selects > 1 ){

        ?>

        <div class="d4m-main-right d4m-sm-4 d4m-md-4 d4m-xs-12 mb-20 br-5 pull-right hide_allsss">

        <?php  

      }else{

        ?>

        <div class="d4m-main-right d4m-sm-4 d4m-md-4 d4m-xs-12 mt-30 mb-30 br-5 pull-right hide_allsss">

        <?php  

      }

      ?>

          <!-- features -->

                <?php  

                if ($settings->get_option('d4mpartial_deposit_status') == 'Y' || $settings->get_option('d4mallow_front_desc') == 'Y') {

                    ?>

                    <div

                        class="hidden-xs  d4m-static-right-side border-c <?php   if ($settings->get_option('d4mpartial_deposit_status') == 'Y' && $settings->get_option('d4mallow_front_desc') == 'N') {

                            echo ' hide_right_side_box';

                        } ?>" id="d4m-not-scroll">



                        <div class="d4m-cart-wrapper f-l">

                            <div class="main-inner-container">

                                <!--  partial amount pay -->

                                <?php  

                                if ($settings->get_option('d4mpartial_deposit_status') == 'Y' && $settings->get_option('d4mstripe_payment_form_status') == 'off' && $settings->get_option('d4mpay_locally_status') == 'on' && $settings->get_option('d4mpaypal_express_checkout_status') == 'off' && $settings->get_option('d4m2checkout_status') == 'N' && $settings->get_option('d4mpayumoney_status') == 'N' && $settings->get_option('d4mauthorizenet_status') != 'on'){

                                    echo '';

                                } else {

                                   

                                }

                                ?>

                                <div class="mb-30"></div>

                                <?php  

                                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 

                                  $protocol = 'https';

                                } else { 

                                  $protocol = 'http';

                                }

                                $one_step =  SITE_URL."index_one_step.php";

                                $GET_URL = $protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];



                                 if ($settings->get_option('d4mallow_front_desc') == 'Y' && $one_step == $GET_URL) {

                                 ?>

                                  <div class="features-list">  

                                      <?php   

                                      $var = $settings->get_option('d4mfront_desc');

                                      echo eval("?>" . $var . "<?php  "); ?>

                                  </div>

                                <?php   } ?>

                            </div>

                        </div>

                    </div>

                <?php   } ?>

        

                  <div class="fl">

                    <div class="main-inner-container border-c d4m-price-scroll" id="d4m-price-scroll" style="margin-top: 20px;">

                        <div class="d4m-step-heading mb-15"><h3 class="header3"><?php  echo $label_language_values['booking_summary']; ?></h3></div>

                        <div class="d4m-cart-wrapper f-l" id="">

                            <div class="d4m-summary hideservice_name">

                                <div class="d4m-image">

                                    <img src="<?php  echo SITE_URL; ?>/assets/images/icon-service.png" alt="">

                                </div>

                                <p class="d4m-text sel-service"></p>

                            </div>

                            <div class="d4m-summary hidedatetime_value">

                                <div class="d4m-image">

                                    <img src="<?php  echo SITE_URL; ?>/assets/images/icon-calendar.png" alt="">

                                </div>

                                <p class="d4m-text sel-datetime"><span class='cart_date' data-date_val=""></span><span class="space_between_date_time"> @ </span><span class='cart_time' data-time_val=""></span></p>

                            </div>

                            <?php  

                            if($settings->get_option("d4mrecurrence_booking_status") == "Y"){

                              $count_f_dis = $frequently_discount->readall_front();

                              if (mysqli_num_rows($count_f_dis) > 0) {

                                ?>

                                <div class="d4m-summary">

                                  <div class="d4m-image f_dis_img">

                                    <img src="<?php  echo SITE_URL; ?>/assets/images/icon-frequency.png" alt="">

                                  </div>

                                  <p class="d4m-text sel-datetime f_discount_name"></p>

                                </div>

                              <?php     

                              }

                            }

                            ?>

                            <div class="d4m-summary hideduration_value <?php   if ($settings->get_option('d4mshow_time_duration') == 'N') {echo "force_hidden";} ?>">

                                <div class="d4m-image total_time_duration">

                                    <img src="<?php  echo SITE_URL; ?>/assets/images/icon-timer.png" alt="">

                                </div>

                                <p class="d4m-text total_time_duration_text"></p>

                            </div>

                            <div class="d4m-form-rown d4m-addons-list-main mbi-30">

                                <div class="step_heading f-l mt-10"><h6 class="header6 d4m-item-list"><?php  echo $label_language_values['cart_items']; ?></h6>

                                </div>

                                <div class="cart-items-main f-l">

                                    <label class="cart_empty_msg"><?php  echo $label_language_values['cart_is_empty']; ?></label>

                                    <ul class="d4m-addon-items-list cart_item_listing">



                                    </ul>

                                </div>

                            </div>

                            <div class="d4m-form-rown">

                                <div class="d4m-cart-label-common ofh"><?php  echo $label_language_values['sub_total']; ?></div>

                                <div class="d4m-cart-amount-common ofh">

                                    <span class="d4m-sub-total cart_sub_total"></span>

                                </div>

                            </div>

                            <?php  

                            if($settings->get_option("d4mrecurrence_booking_status") == "Y"){

                              $count_f_dis = $frequently_discount->readall_front();

                              if (mysqli_num_rows($count_f_dis) > 0) {

                                  ?>

                                  <div class="d4m-form-rown freq_discount_display">

                                      <div class="d4m-cart-label-common ofh"><?php  echo ucwords(strtolower($label_language_values['frequently_discount'])); ?></div>

                                      <div class="d4m-cart-amount-common ofh">

                                          <span class="d4m-frequently-discount frequent_discount"></span>

                                      </div>

                                  </div>

                              <?php     

                              }

                            }

                            if ($settings->get_option('d4mshow_coupons_input_on_checkout') == 'on') {

                                ?>

                                <div class="d4m-form-rown coupon_display">

                                    <div class="d4m-cart-label-common ofh"><?php  echo $label_language_values['coupon_discount']; ?></div>

                                    <div class="d4m-cart-amount-common ofh">

                                      <span class="d4m-coupon-discount cart_discount"></span>

                                    </div>

                                </div>

                            <?php  

                            }

                            ?>





                            <?php if ($settings->get_option('d4mshow_referral_input_on_checkout') == 'on'){ ?>

                              <div class="d4m-form-rown user_coupon_display">

                                <div class="d4m-cart-label-common ofh"><?php  echo "Referral coupon discount"; ?></div>

                                <div class="d4m-cart-amount-common ofh">

                                  <span class="d4m-coupon-discount cart_discount"></span>

                                </div>

                              </div>

                            <?php  } ?>

                            <?php  

                            if ($settings->get_option('d4mtax_vat_status') == 'Y') {

                                ?>

                                <div class="d4m-form-rown">

                                    <div class="d4m-cart-label-common ofh"><?php  echo $label_language_values['tax']; ?></div>

                                    <div class="d4m-cart-amount-common ofh">

                                        <span class="d4m-tax-amount cart_tax"></span>

                                    </div>

                                </div>

                            <?php  

                            }

                            if ($settings->get_option('d4mpartial_deposit_status') == 'Y') {

                            ?>

                            <div class="d4m-form-rown partial_amount_hide_on_load mb-15">

                              <div class="d4m-partial-amount-wrapper border-c border-2">

                                <div class="d4m-partial-amount-message">

                                  <?php   echo $settings->get_option('d4mpartial_deposit_message'); ?>

                                </div>

                                <div class="d4m-form-rown">

                                  <div class="d4m-cart-label-common ofh"><?php  echo $label_language_values['partial_deposit']; ?></div>

                                  <div class="d4m-cart-amount-common ofh">

                                    <span class="d4m-partial-deposit partial_amount"></span>

                                  </div>

                                </div>

                                <div class="d4m-form-rown">

                                  <div class="d4m-cart-label-common ofh"><?php  echo $label_language_values['remaining_amount']; ?></div>

                                  <div class="d4m-cart-amount-common ofh">

                                    <span class="d4m-remaining-amount remain_amount"></span>

                                  </div>

                                </div>

                              </div>

                            </div>

                          <?php  

                          }

                          ?>

                            <div class="d4m-clear"></div>

                            <div id="d4m-line"></div>

                            <div class="d4m-form-rown">

                                <div class="d4m-cart-label-total-amount ofh"><?php  echo $label_language_values['total']; ?></div>

                                <div class="d4m-cart-total-amount ofh">

                                    <span class="d4m-total-amount cart_total"></span>

                                </div>

                            </div>



                            <div class="d4m-clear"></div>

                            <!-- discount coupons -->

                        </div>

                        <!-- cart wrapper end here -->





                      </div>

                    </div> 

                  </div>

            <!-- right side card end -->
			
			
			



            <div class="d4m-main-right d4m-complete-booking-main d4m-sm-7 d4m-md-7 mb-30 d4m-xs-12 br-5 mt-10">  

              <div class="d4m-list-header">

                          <p class="d4m-sub-complete-booking"></p>

                      </div>

              <?php   if ($settings->get_option('d4mcancelation_policy_status') == 'Y') { ?>



                      <div class="d4m-complete-booking d4m-md-12 cb">

                          <h5 class="d4m-cancel-booking"><?php  echo $label_language_values['cancellation_policy']; ?></h5>



                          <div class="d4m-cancel-policy">

                              <p><?php  echo $settings->get_option('d4mcancel_policy_header'); ?></p>

                              <span class="show-more-toggler d4m-link"><?php  echo $label_language_values['show_more']; ?></span>

                              <ul class="bullet-more">

                                  <li><?php  echo $settings->get_option('d4mcancel_policy_textarea'); ?></li>

                              </ul>

                          </div>

                      </div>

              <?php   } ?>



                      <?php   if ($settings->get_option('d4mallow_terms_and_conditions') == 'Y' || $settings->get_option('d4mallow_privacy_policy') == 'Y') { ?>

                          <div class="bi-terms-agree d4m-md-12">

                              <div class="d4m-custom-checkbox">

                                  <ul class="d4m-checkbox-list">

                                      <li>

                                          <input type="checkbox" name="accept-conditions" class="input-radio"

                                                 id="accept-conditions"/>

                                          <label for="accept-conditions" class="">

                                              <span></span>

                                              <?php   echo $label_language_values['i_have_read_and_accepted_the']; ?>

                                              <?php   if ($settings->get_option('d4mallow_terms_and_conditions') == 'Y' && $settings->get_option('d4mallow_privacy_policy') == 'N') { ?>

                                                  <a href="<?php  if ($settings->get_option('d4mterms_condition_link') != '') { echo $settings->get_option('d4mterms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('d4mterms_condition_link') != ''){ ?> target="-BLANK" <?php   } ?> class="d4m-link">

                                                      <?php   echo $label_language_values['terms_and_condition']; ?>

                                                  </a>.

                                              <?php   } elseif ($settings->get_option('d4mallow_terms_and_conditions') == 'N' && $settings->get_option('d4mallow_privacy_policy') == 'Y') { ?>

                                                  <a href="<?php  if ($settings->get_option('d4mprivacy_policy_link') != ''){ echo $settings->get_option('d4mprivacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('d4mprivacy_policy_link') != ''){ ?> target="-BLANK" <?php   } ?> class="d4m-link"><?php  echo $label_language_values['privacy_policy']; ?></a>.

                                              <?php   } else { ?>

                                                  <a href="<?php  if ($settings->get_option('d4mterms_condition_link') != ''){ echo $settings->get_option('d4mterms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('d4mterms_condition_link') != ''){ ?> target="-BLANK" <?php   } ?> class="d4m-link"><?php  echo $label_language_values['terms_and_condition']; ?></a>

                                                  <?php   echo $label_language_values['and']; ?>

                                                  <a href="<?php  if ($settings->get_option('d4mprivacy_policy_link') != '') { echo $settings->get_option('d4mprivacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('d4mprivacy_policy_link') != ''){ ?> target="-BLANK" <?php   } ?> class="d4m-link"><?php  echo $label_language_values['privacy_policy']; ?></a>.

                                              <?php   } ?>

                                          </label>

                                      </li>

                                  </ul>

                              </div>

                              <label class="terms_and_condition"></label>

                          </div>

                      <?php   } ?>

              

                      <div class="ta-center fl">

                <?php   if($settings->get_option("d4mloader")== 'css' && $settings->get_option("d4mcustom_css_loader") != ''){ ?>

                  <div class="d4m-loading-main-complete_booking" align="center">

                    <?php   echo $settings->get_option("d4mcustom_css_loader"); ?>

                  </div>

                <?php   }elseif($settings->get_option("d4mloader")== 'gif' && $settings->get_option("d4mcustom_gif_loader") != ''){ ?>

                  <div class="d4m-loading-main-complete_booking" align="center">

                    <img style="margin-top:18%;" src="<?php  echo BASE_URL; ?>/assets/images/gif-loader/<?php  echo $settings->get_option("d4mcustom_gif_loader"); ?>"></img>

                  </div>

                <?php   }else{ ?>

                  <div class="d4m-loading-main-complete_booking">

                    <div class="loader">Loading...</div>

                  </div>

                <?php   } ?>          

                

                        <a href="javascript:void(0)" type='submit' data-currency_symbol="<?php  echo $settings->get_option('d4mcurrency_symbol'); ?>" id='complete_bookings' class="d4m-button scroll_top_complete d4m-btn-big d4mremove_id"><?php  echo $label_language_values['complete_booking'];?></a>

                      </div>

            </div>



      <!-- terms and condiotion end -->



            </form>

            <a href="javascript:void(0)" class="d4m-back-to-top br-2"><i class="icon-arrow-up icons"></i></a>

            <?php  

      if($settings->get_option('d4mpayumoney_status') == 'Y'){

      ?>

      <!--form action="https://sandboxsecure.payu.in/_payment" method="post" name="payuForm" id="payuForm"-->

      <form action="https://secure.payu.in/_payment" method="post" name="payuForm" id="payuForm">

        <input type="hidden" name="key" id="payu_key" value="" />

        <input type="hidden" name="hash" id="payu_hash" value=""/>

        <input type="hidden" name="txnid" id="payu_txnid" value="" />

        <input type="hidden" name="amount" id="payu_amount" value="" />

        <input type="hidden" name="firstname" id="payu_fname" value="" />

        <input type="hidden" name="email" id="payu_email" value="" />

        <input type="hidden" name="phone" id="payu_phone" value="" />

        <input type="hidden" name="productinfo" id="payu_productinfo" value="" />

        <input type="hidden" name="surl" id="payu_surl" value="" />

        <input type="hidden" name="furl" id="payu_furl" value="" />

        <input type="hidden" name="service_provider" id="payu_service_provider" value="" />

      </form>

      <?php  

      }

      if(sizeof((array)$purchase_check)>0){

        foreach($purchase_check as $key=>$val){

          if($val == 'Y'){

            echo $payment_hook->payment_form_hook($key);

          }

        }

      }

      ?>

        </div>

        <!-- end container -->

    </div>

    

    <!-- forget password -->

    <div class="main">

        <div id="d4m-front-forget-password">



            <div class="vertical-alignment-helper">

                <div class="vertical-align-center">

                    <div class="d4m-front-forget-password visible">

                        <div class="form-container">

                            <div class="tab-content">

                                <form id="forget_pass" name="" method="POST">

                                    <h1 class="forget-password"><?php  echo $label_language_values['reset_password']; ?></h1>

                                    <h4><?php  echo $label_language_values['enter_your_email_and_we_send_you_instructions_on_resetting_your_password']; ?></h4>



                                    <div class="form-group fl mt-15">

                                        <label for="userEmail"><i class="icon-envelope-alt"></i><?php  echo $label_language_values['email']; ?></label>

                                        <input type="email" class="add_show_error_class error" id="rp_user_email" name="rp_user_email" placeholder="<?php  echo $label_language_values['registered_email']; ?>">

                                    </div>

                                    <label class="forget_pass_correct"></label>

                                    <label class="forget_pass_incorrect"></label>



                                    <div class="clearfix">

                                        <a class="btn d4m-info-btn btn-lg d4m-xs-12" href="javascript:void(0)"

                                           id="reset_pass"><?php  echo $label_language_values['send_mail']; ?></a>

                                    </div>

                                    <div class="clearfix">

                                        <a class="btn btn-link d4m-xs-12" id="d4mlogin_user" href="javascript:void(0)"><?php  echo $label_language_values['back_to_login']; ?></a>

                                    </div>



                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



</div>



<div class="modal fade" id="verify_otp" tabindex="-1" role="dialog" aria-labelledby="verify_otp" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <center>

        <h3 class="modal-title" id="verify_otp"><?php echo $label_language_values['verify_your_otp']; ?></h3></center>

      </div>

      <form method="post" class="verify_otp" id="verify_otp" name="verify_otp" enctype="multipart/form-data">

        <div class="modal-body">

          <label class="control-label">

            <?php echo $label_language_values['enter_otp']; ?>

          </label>

          <input type="text" id="otp_input" name="otp_input" class="form-control" placeholder="<?php echo $label_language_values['enter_your_otp']; ?>" style="margin-bottom: 10px; margin-top: 10px;">

          <input type="hidden" id="phone_number">

          <input type="text" name="invalid-otp" value="" id="invalid-otp" style="display: none;width: 100%;border: unset;">

        </div>

      </form>

      <div class="modal-footer">

        <button type="button" id="otp_model_close" class="btn btn-secondary"><?php echo $label_language_values['close']; ?></button>

        <button type="button" id="input_otp_check" class="btn btn-primary"><?php echo $label_language_values['verify']; ?></button>

      </div>

    </div>

  </div>

</div>
<input type="hidden" name="staff_count_forservice" id="staff_count_forservice" value="" />

<?php if (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "de_DE" ) { ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-Deutsch");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "es_ES" ) {  ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-Español");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "fr_FR" ) {  ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-Français");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "pt_PT" ) {  ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-Português");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "ru_RU" ) {  ?>
  <script type="text/javascript">
    $("#ld").addClass("lg-Русский");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "ar" ) {  ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-العربية");
  </script>
<?php 
}elseif (isset($_SESSION['current_lang']) && $_SESSION['current_lang']  == "zh_CN" ) {  ?>
  <script type="text/javascript">
    $("#d4m").addClass("lg-简体中文");
  </script>
<?php 
}
?>

<script>

  

    var baseurlObj = {'base_url': '<?php  echo BASE_URL;?>','stripe_publishkey':'<?php  echo $settings->get_option('d4mstripe_publishablekey');?>','stripe_status':'<?php  echo $settings->get_option('d4mstripe_payment_form_status');?>'};

    var siteurlObj = {'site_url': '<?php  echo SITE_URL;?>'};

    var ajaxurlObj = {'ajax_url': '<?php  echo AJAX_URL;?>'};

    var fronturlObj = {'front_url': '<?php  echo FRONT_URL;?>'};

    var termsconditionObj = {'terms_condition': '<?php  echo $settings->get_option('d4mallow_terms_and_conditions');?>'};

    var privacypolicyObj = {'privacy_policy': '<?php  echo $settings->get_option('d4mallow_privacy_policy');?>'};

    <?php  

    

  if($settings->get_option('d4mthankyou_page_url') == ''){

        $thankyou_page_url = SITE_URL.'front/thankyou.php';

    }else{

        $thankyou_page_url = $settings->get_option('d4mthankyou_page_url');

    }

  $phone = explode(",",$settings->get_option('d4mbf_phone'));

  $check_password = explode(",",$settings->get_option('d4mbf_password'));

  $check_fn = explode(",",$settings->get_option('d4mbf_first_name'));

  $check_ln = explode(",",$settings->get_option('d4mbf_last_name'));

  $check_addresss = explode(",",$settings->get_option('d4mbf_address'));

  $check_zip_code = explode(",",$settings->get_option('d4mbf_zip_code'));

  $check_city = explode(",",$settings->get_option('d4mbf_city'));

  $check_state = explode(",",$settings->get_option('d4mbf_state'));

  $check_notes = explode(",",$settings->get_option('d4mbf_notes'));

  $check_notes = explode(",",$settings->get_option('d4mbf_notes'));



  $d4mcurrency_symbol = $settings->get_option('d4mcurrency_symbol');

  $d4mcurrency_symbol_position = $settings->get_option('d4mcurrency_symbol_position');

  $d4mprice_format_decimal_places = $settings->get_option('d4mprice_format_decimal_places');

  $d4mpartial_deposit_status = $settings->get_option('d4mpartial_deposit_status');

  $d4mpartial_deposit_amount = $settings->get_option('d4mpartial_deposit_amount');

  $d4mpartial_type = $settings->get_option('d4mpartial_type');

  ?>



  var currency_symbol = '<?php   echo $d4mcurrency_symbol; ?>';

  var currency_symbol_position = '<?php   echo $d4mcurrency_symbol_position; ?>';

  var price_format_decimal_places = '<?php   echo $d4mprice_format_decimal_places; ?>';

  var thankyoupageObj = {'thankyou_page': '<?php  echo $thankyou_page_url;?>'};

  var partial_deposit = {'partial_deposit_status' : '<?php  echo $d4mpartial_deposit_status;?>','partial_deposit_amount' : '<?php  echo $d4mpartial_deposit_amount;?>','partial_deposit_type' : '<?php  echo $d4mpartial_type;?>'};

  var phone_status = {'statuss' : '<?php  echo $phone[0];?>','required' : '<?php  echo $phone[1];?>','min' : '<?php  echo $phone[2];?>','max' : '<?php  echo $phone[3];?>'};

  var check_password = {'statuss' : '<?php  echo $check_password[0];?>','required' : '<?php  echo $check_password[1];?>','min' : '<?php  echo $check_password[2];?>','max' : '<?php  echo $check_password[3];?>'};

  var check_fn = {'statuss' : '<?php  echo $check_fn[0];?>','required' : '<?php  echo $check_fn[1];?>','min' : '<?php  echo $check_fn[2];?>','max' : '<?php  echo $check_fn[3];?>'};

  var check_ln = {'statuss' : '<?php  echo $check_ln[0];?>','required' : '<?php  echo $check_ln[1];?>','min' : '<?php  echo $check_ln[2];?>','max' : '<?php  echo $check_ln[3];?>'};

  var check_addresss = {'statuss' : '<?php  echo $check_addresss[0];?>','required' : '<?php  echo $check_addresss[1];?>','min' : '<?php  echo $check_addresss[2];?>','max' : '<?php  echo $check_addresss[3];?>'};

  var check_zip_code = {'statuss' : '<?php  echo $check_zip_code[0];?>','required' : '<?php  echo $check_zip_code[1];?>','min' : '<?php  echo $check_zip_code[2];?>','max' : '<?php  echo $check_zip_code[3];?>'};

  var check_city = {'statuss' : '<?php  echo $check_city[0];?>','required' : '<?php  echo $check_city[1];?>','min' : '<?php  echo $check_city[2];?>','max' : '<?php  echo $check_city[3];?>'};

  var check_state = {'statuss' : '<?php  echo $check_state[0];?>','required' : '<?php  echo $check_state[1];?>','min' : '<?php  echo $check_state[2];?>','max' : '<?php  echo $check_state[3];?>'};

  var check_notes = {'statuss' : '<?php  echo $check_notes[0];?>','required' : '<?php  echo $check_notes[1];?>','min' : '<?php  echo $check_notes[2];?>','max' : '<?php  echo $check_notes[3];?>'}; 

  <?php  

  $nacode = explode(',',$settings->get_option("d4mcompany_country_code"));

  $allowed = $settings->get_option("d4mphone_display_country_code");

  ?>

  var countrycodeObj = {'numbercode': '<?php  echo $nacode[0];?>', 'alphacode': '<?php  echo $nacode[1];?>', 'countrytitle': '<?php  echo $nacode[2];?>', 'allowed': '<?php  echo $allowed;?>'};

  var subheaderObj = {'subheader_status': '<?php  echo $settings->get_option('d4msubheaders');?>'};

  var twocheckout_Obj = {'sellerId': '<?php  echo $settings->get_option('d4m2checkout_sellerid');?>', 'publishKey': '<?php  echo $settings->get_option('d4m2checkout_publishkey');?>', 'twocheckout_status': '<?php  echo $settings->get_option('d4m2checkout_status'); ?>'};

  var appoint_details = {'status':'<?php  echo $settings->get_option('d4mappointment_details_display');?>'};
  var frequency_status = {'status':'<?php  echo $settings->get_option('d4mrecurrence_booking_status');?>'};

  <?php   $is_login_user = "N"; if(isset($_SESSION['d4mlogin_user_id'])){$is_login_user = "Y";} ?>

  var is_login_user = '<?php   echo $is_login_user; ?>';

</script>

</body>

</html>