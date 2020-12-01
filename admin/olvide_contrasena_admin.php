<?php  
 
session_start();
include_once(dirname(dirname(__FILE__)).'/header.php');
include(dirname(__FILE__).'/user_session_check.php');
include (dirname(dirname(__FILE__)).'/objed4ms/class_setting.php');
include (dirname(dirname(__FILE__)).'/objed4ms/class_conned4mion.php');
include(dirname(dirname(__FILE__)).'/objed4ms/class_front_first_step.php');
$con = new do4me_db();
$conn = $con->conned4m();
$setting = new do4me_setting();
$setting->conn = $conn;
$first_step=new do4me_first_step();
$first_step->conn=$conn;
	$current_times = date('Y-m-d H:i:s');
	$decrypt_code = base64_decode($_GET['code']);
	
	$explode=explode("#",$decrypt_code);
	$decrypt_id = base64_decode($explode[0]);
	$user_id=$decrypt_id-135;
	$_SESSION['user_id']=$user_id;
	$url_time=$explode[1];
	$current_time=strtotime($current_times);
$lang = $setting->get_option("d4m_language");
$label_language_values = array();
$language_label_arr = $setting->get_all_labelsbyid($lang);

//IF1
if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "" || $language_label_arr[6] != "")
{
	$default_language_arr = $setting->get_all_labelsbyid("en");
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
    $default_language_arr = $setting->get_all_labelsbyid("en");
	
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
$loginimage=$setting->get_option('d4m_login_image');
if($loginimage!=''){
	$imagepath=SITE_URL."assets/images/backgrounds/".$loginimage;
}else{
	$imagepath=SITE_URL."assets/images/login-bg.jpg";
}
?>
<!DOd4mYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $label_language_values['reset_password'];?> | <?php  echo $setting->get_option("d4m_page_title"); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/login-style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/bootstrap/bootstrap-theme.min.css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/font-awesome/css/font-awesome.css" /> <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery-ui.min.js" type="text/javascript"></script>		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>			<script src="<?php echo BASE_URL; ?>/assets/js/jquery.payment.min.js" type="text/javascript"></script> 		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.validate.min.js"></script>   		<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>  		
		<script type="text/javascript">
		var ajax_url = '<?php echo AJAX_URL;?>';
		var base_url = '<?php echo BASE_URL;?>';
 		</script>		
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.validate.min.js"></script> 
		<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/login.js"></script>
		<?php  include(dirname(__FILE__)."/language_js_objed4ms.php");?> 
			
		<style>
		body{
			font-family: 'Open Sans', sans-serif;
			background: url(<?php echo $imagepath;?>) no-repeat;
			background-image: url("<?php echo $imagepath;?>");
			font-weight: 300;
			background-size: 100% 100% !important;
			font-size: 15px;
			color: #333;
			-webkit-font-smoothing: antialiased;	
		}
		</style>
			 
	</head>
    <body>
		<div id="d4m-reset-password">
		<sed4mion class="main">
			<div class="vertical-alignment-helper">
				<div class="vertical-align-center">
					<div class="d4m-reset-password visible animated fadeInUp">
						<div class="form-container">
							<div class="tab-content">
								<form id="reset_new_passwd" method="post">
									<h1 class="forget-password"><?php echo $label_language_values['reset_password'];?></h1>
										<div class="form-group fl">
											<label for="n_password"><i class="icon-lock"></i><?php echo $label_language_values['new_password'];?></label>
											<input type="password" id="n_password" name="n_password" onkeydown="if (event.keyCode == 13) document.getElementById('reset_new_password').click()" placeholder="<?php echo $label_language_values['new_password'];?>" class="showpassword npassword">
										</div>
										<div class="form-group fl">
											<label for="rn_password"><i class="icon-lock"></i><?php echo $label_language_values['retype_new_password'];?></label>
											<input type="password" id="rn_password" name="rn_password" placeholder="<?php echo $label_language_values['retype_new_password'];?>" class="showpassword rnpassword" onkeydown="if (event.keyCode == 13) document.getElementById('reset_new_password').click()" />
										</div>
										<label class="mismatch_password"></label>
									
									<?php  
									if($current_time > $url_time){	?>
										<label style="display:block;color:'red';"><?php echo $label_language_values['your_reset_password_link_expired'];?></label>
									<div class="clearfix"> 
										<a href="javascript:void(0)" class="btn d4m-reset-btn btn-lg d4m-xs-12 col-xs-12"><?php echo $label_language_values['reset_password'];?></a>
									</div>
									<?php 
										}else{
									?>
									<div class="clearfix"> 
										<a class="btn d4m-reset-btn btn-lg d4m-xs-12 col-xs-12" href="javascript:void(0)" id="reset_new_password" type="submit"><?php echo $label_language_values['reset_password'];?></a>
									</div>
									<?php 
										}
									?>								
								</form>	
							</div>​​
						</div>​​
					
					</div>​​<!-- login end here -->
					
				</div>
			</div>
		</sed4mion>
				
			
		</div>
	</body>
</html>
<script>
    var ajax_url = '<?php echo AJAX_URL;?>';
    var base_url = '<?php echo BASE_URL;?>';
    var baseurlObj = {'base_url':'<?php echo BASE_URL;?>'};
   var siteurlObj = {'site_url':'<?php echo SITE_URL;?>'};
   var ajaxurlObj={'ajax_url':'<?php echo AJAX_URL;?>'};
   var fronturlObj={'front_url':'<?php echo FRONT_URL;?>'};
</script>