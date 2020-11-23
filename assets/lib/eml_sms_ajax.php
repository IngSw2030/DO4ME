<?php  

session_start();
include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
include(dirname(dirname(dirname(__FILE__))).'/header.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_setting.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_userdetails.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/plivo.php');
include(dirname(dirname(dirname(__FILE__))).'/assets/twilio/Services/Twilio.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_nexmo.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_gc_hook.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_eml_sms.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_adminprofile.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_users.php");

$database= new do4me_db();
$conn=$database->connect();
$database->conn=$conn;

$objuserdetails = new do4me_userdetails();
$objuserdetails->conn=$conn;

$emailtemplate=new do4me_email_template();
$emailtemplate->conn=$conn;

$emlsms=new eml_sms();
$emlsms->conn=$conn;

$settings=new do4me_setting();
$settings->conn=$conn;

$objadminprofile = new do4me_adminprofile();
$objadminprofile->conn = $conn;

$setting = new do4me_setting();
$setting->conn = $conn;

$user = new do4me_users();
$user->conn = $conn;

if($settings->get_option('d4msmtp_authetication') == 'true'){
	$mail_SMTPAuth = '1';
	if($settings->get_option('d4msmtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'Yes';
	}
	
}else{
	$mail_SMTPAuth = '0';
	if($settings->get_option('d4msmtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'No';
	}
}

$nexmo_admin = new do4me_d4mnexmo();
$nexmo_client = new do4me_d4mnexmo();

$gc_hook = new do4me_gcHook();
$gc_hook->conn = $conn;

$mail = new do4me_phpmailer();
$mail->Host = $settings->get_option('d4msmtp_hostname');
$mail->Username = $settings->get_option('d4msmtp_username');
$mail->Password = $settings->get_option('d4msmtp_password');
$mail->Port = $settings->get_option('d4msmtp_port');
$mail->SMTPSecure = $settings->get_option('d4msmtp_encryption');
/*$mail->SMTPAuth = $settings->get_option('d4msmtp_authetication');*/
$mail->SMTPAuth = $mail_SMTPAuth;
$mail->CharSet = "UTF-8";

if($setting->get_option('d4msmtp_hostname') != '' && $setting->get_option('d4memail_sender_name') != '' && $setting->get_option('d4memail_sender_address') != '' && $setting->get_option('d4msmtp_username') != '' && $setting->get_option('d4msmtp_password') != '' && $setting->get_option('d4msmtp_port') != ''){
            $mail->IsSMTP();
        }else{
            $mail->IsMail();
        }

/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->d4mnexmo_api_key = $settings->get_option('d4mnexmo_api_key');
$nexmo_admin->d4mnexmo_api_secret = $settings->get_option('d4mnexmo_api_secret');
$nexmo_admin->d4mnexmo_from = $settings->get_option('d4mnexmo_from');

$nexmo_client->d4mnexmo_api_key = $settings->get_option('d4mnexmo_api_key');
$nexmo_client->d4mnexmo_api_secret = $settings->get_option('d4mnexmo_api_secret');
$nexmo_client->d4mnexmo_from = $settings->get_option('d4mnexmo_from');

/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $settings->get_option('d4msms_plivo_sender_number');
$twilio_sender_number = $settings->get_option('d4msms_twilio_sender_number');


/* textlocal gateway variables */
$textlocal_username =$settings->get_option('d4msms_textlocal_account_username');
$textlocal_hash_id = $settings->get_option('d4msms_textlocal_account_hash_id');


/*NEED VARIABLE FOR EMAIL*/$company_city = $settings->get_option('d4mcompany_city'); $company_state = $settings->get_option('d4mcompany_state'); $company_zip = $settings->get_option('d4mcompany_zip_code'); $company_country = $settings->get_option('d4mcompany_country');
$company_phone = strlen($settings->get_option('d4mcompany_phone')) < 6 ? "" : $settings->get_option('d4mcompany_phone'); 
/* $company_email = $settings->get_option('d4mcompany_email'); */
$company_address = $settings->get_option('d4mcompany_address'); 

/*  set admin name */
$get_admin_name_result = $objadminprofile->readone_adminname();
$get_admin_name = $get_admin_name_result[3];
if($get_admin_name == ""){
	$get_admin_name = "Admin";
}

if(isset($_POST['emlsend'])){
	if($setting->get_option('d4mclient_email_notification_status') == 'Y'){	
	}else{
		echo "No";
		die();}
	$cusids=$_POST['cusids'];
	$elems = json_decode($_POST['cusids'], true);
	$cusids=implode(",",$elems);

	if(isset($_FILES['image']["name"])){
		$newfilename=$_FILES['image']["name"];
		$newfolderpath=realpath(dirname(dirname(__FILE__)).'/images/emails/')."/";
		if(!file_exists($newfolderpath)){
		mkdir($newfolderpath,0777,true);
		}
		$sTempFileName=$newfolderpath.$newfilename;
		move_uploaded_file($_FILES['image']['tmp_name'], $sTempFileName);
		$emlsms->cus_img=$_FILES['image']["name"];
	}else{
		$emlsms->cus_img="";
	}
	$dftdt=date('Y-m-d H:m:s');
	$emlsms->cus_ids=$cusids;
	$emlsms->cus_sub=$_POST['cussub'];
	$emlsms->cus_msg=$_POST['cusmsg'];
	$emlsms->cus_dtfmt=$dftdt;

        $subject=$emlsms->cus_sub;
        $company_email=$settings->get_option('d4mcompany_email');
        $company_name=$settings->get_option('d4mcompany_name');
        $client_email_body=$emlsms->cus_msg;

	$cusids=explode(",", $cusids);
		
	for ($i=0; $i < sizeof((array)$cusids); $i++) {
		$objuserdetails->id=$cusids[$i];
		$res=$objuserdetails->readone();
		$client_email=$res[1];
		$client_name=$res[3]." ".$res[4];
		
		
		if($setting->get_option('d4mclient_email_notification_status') == 'Y'){


        $mail->SMTPDebug  = 0;
        $mail->IsHTML(true);
        $mail->From = $company_email;
        $mail->FromName = $company_name;
        $mail->Sender = $company_email;
        $mail->AddAddress($client_email, $client_name); 
        $mail->Subject = $emlsms->cus_sub;
        $mail->Body = $client_email_body;
		if(isset($_FILES['image']["name"])){
			$mail->addAttachment($sTempFileName);
		}
        $mail->send();
		$mail->ClearAllRecipients();

    }

	}

	$rdt = $emlsms->ins_eml_data();

	if($rdt){
		echo "done";
		die();
	}
}

if(isset($_POST['smssend'])){
	$dftdt=date('Y-m-d H:i:s');
	$emlsms->cus_msg=$_POST['cusmsg'];
	$emlsms->cus_dtfmt=$dftdt;
	$message=$_POST['cusmsg'];
	$elems = json_decode($_POST['cusids'], true);
	$cusids=implode(",", $elems);
	$emlsms->cus_ids=$cusids;
	
	if($settings->get_option('d4msms_textlocal_status') == "Y" || $settings->get_option('d4msms_plivo_status')=="Y" || $settings->get_option('d4msms_twilio_status') == "Y" || $settings->get_option('d4mnexmo_status') == "Y"){
	}else{
		echo "No";
		die();
	}
	$chkmsgsnd = "1";
	/* TEXTLOCAL CODE */
	if($settings->get_option('d4msms_textlocal_status') == "Y" && $chkmsgsnd == "1")
	{
		if($settings->get_option('d4msms_textlocal_send_sms_to_client_status') == "Y"){
			for ($i=0; $i < sizeof((array)$elems); $i++) {
				$objuserdetails->id=$elems[$i];
				$res=$objuserdetails->readone();
				
				$phone = $res[5];				
			
				$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
				$ch = curl_init('http://api.textlocal.in/send/?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);
			}
			$chkmsgsnd = "0";
		}
	}
	
	/*PLIVO CODE*/
        if($settings->get_option('d4msms_plivo_status')=="Y" && $chkmsgsnd == "1"){
		   if($settings->get_option('d4msms_plivo_send_sms_to_client_status') == "Y"){
                $auth_id = $settings->get_option('d4msms_plivo_account_SID');
				$auth_token = $settings->get_option('d4msms_plivo_auth_token');
				$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				for ($i=0; $i < sizeof((array)$elems); $i++) {
					$objuserdetails->id=$elems[$i];
					$res=$objuserdetails->readone();
					
					$phone = $res[5];				
				
					/* MESSAGE SENDING CODE THROUGH PLIVO */
                    $params = array(
                        'src' => $plivo_sender_number,
                        'dst' => $phone,
                        'text' => $message,
                        'method' => 'POST'
                    );
					$response = $p_client->send_message($params);
                    /* MESSAGE SENDING CODE ENDED HERE*/
				}
				$chkmsgsnd = "0";
            }
        }
		/*TWILIO CODE*/
		if($settings->get_option('d4msms_twilio_status') == "Y" && $chkmsgsnd == "1"){
            if($settings->get_option('d4msms_twilio_send_sms_to_client_status') == "Y"){
				$AccountSid = $settings->get_option('d4msms_twilio_account_SID');
				$AuthToken =  $settings->get_option('d4msms_twilio_auth_token'); 
				$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);
				
				for ($i=0; $i < sizeof((array)$elems); $i++) {
					$objuserdetails->id=$elems[$i];
					$res=$objuserdetails->readone();

					
					$phone = $res[5];				
				
					/*TWILIO CODE*/
                    $client_sms_body = $twilliosms_client->account->messages->create(array(
                        "From" => $twilio_sender_number,
                        "To" => $phone,
                        "Body" => $message));
				}
				$chkmsgsnd = "0";
			}
        }
		
		if($settings->get_option('d4mnexmo_status') == "Y" && $chkmsgsnd == "1"){
            if($settings->get_option('d4msms_nexmo_send_sms_to_client_status') == "Y"){
                for ($i=0; $i < sizeof((array)$elems); $i++) {
					$objuserdetails->id=$elems[$i];
					$res=$objuserdetails->readone();
					
					$phone = $res[5];				
				
					$res=$nexmo_client->send_nexmo_sms($phone,$message);
				}
				$chkmsgsnd = "0";
            }
        }
		if($chkmsgsnd == "1"){
			echo "Noo";
			die();
		}

	$rdt = $emlsms->ins_sms_data();

	if($rdt){
		echo "done";
		die();
	}
}

if (isset($_POST['action']) && $_POST['action'] == 'check_admin_cus_email')
{
	$user->user_email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$check_user_mail = $user->check_email();
	if (mysqli_num_rows($check_user_mail) > 0)
	{
		echo json_encode("Email is already exists");
	}
  else
	{
		echo "true";
	}
}
?>