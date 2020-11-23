<?php     
class do4me_users{
	public $user_id;
	public $existing_username;
	public $existing_password;
	public $username;
	public $user_email;
	public $user_pwd;
	public $first_name;
	public $last_name;
	public $phone;
	public $zip;
	public $address;
	public $city;
	public $state;
	public $notes;
	public $vc_status;
	public $p_status;
	public $contad4mstatus;
	public $status;
	public $usertype;
	public $user_status;									 
	public $stripe_id="";		
  public $update_wallet_amt;						 
	public $conn;
	public $table_name="d4musers";
	public $table_name1 = "d4morder_client_info";
	public $table_name_admin = "d4madmin_info";
	public $table_otp = "d4motp";
	public $email = "";
	public $otp = "";
	public $offset;
	public $limit;													
	
	/* Function for add users */
	public function add_user(){
		$dftdt=date('Y-m-d H:m:s');
    $random_string = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 10)),1,10);
    $query="insert into `".$this->table_name."` (`id`,`user_email`,`user_pwd`,`first_name`,`last_name`,`phone`,`zip`,`address`,`city`,`state`,`notes`,`vc_status`,`p_status`,`contad4mstatus`,`status`,`usertype`,`cus_dt`,`stripe_id`,`referal_code`,`wallet_amount`) values(NULL,'".$this->user_email."','".$this->user_pwd."','".$this->first_name."','".$this->last_name."','".$this->phone."','".$this->zip."','".$this->address."','".$this->city."','".$this->state."','".$this->notes."','".$this->vc_status."','".$this->p_status."','".$this->contad4mstatus."','".$this->status."','".$this->usertype."','".$dftdt."','".$this->stripe_id."','".$random_string."','".$this->update_wallet_amt."')";
		$result=mysqli_query($this->conn,$query);	
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	/* Function for add register customer */
	public function add_customer_register(){
    $random_string = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 10)),1,10);
    $query="insert into `".$this->table_name."` (`id`,`user_email`,`user_pwd`,`first_name`,`last_name`,`phone`,`zip`,`address`,`city`,`state`,`notes`,`vc_status`,`p_status`,`contad4mstatus`,`status`,`usertype`,`stripe_id`,`referal_code`,`wallet_amount`) values(NULL,'".$this->user_email."','".$this->user_pwd."','".$this->first_name."','".$this->last_name."','".$this->phone."','".$this->zip."','".$this->address."','".$this->city."','".$this->state."','".$this->notes."','N','N','','E','".$this->usertype."','".$this->stripe_id."','".$random_string."','".$this->update_wallet_amt."')";
		$result=mysqli_query($this->conn,$query);	
		return $result;
	}
	/* Function for update users  */
	public function update_user(){	
		$query="update `".$this->table_name."` set `user_email`='".$this->user_email."',`user_pwd`='".$this->user_pwd."',`first_name`='".$this->first_name."',`last_name`='".$this->last_name."',`phone`='".$this->phone."',`zip`='".$this->zip."',`address`='".$this->address."',`city`='".$this->city."',`state`='".$this->state."',`notes`='".$this->notes."',`vc_status`='".$this->vc_status."',`p_status`='".$this->p_status."',`contad4mstatus`='".$this->contad4mstatus."' ,`status`='".$this->status."', `usertype`='".$this->usertype."' where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	public function readone(){
		$query="select * from `".$this->table_name."` where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
	/* read one data of the guest client by his order_id  */
	public function readoneguest($order){
		$query="select * from `".$this->table_name1."` where `order_id`='".$order."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_row($result);
		return $value;
	}
  /* Function for login users */
	public function check_login(){
		$query="select * from `".$this->table_name."` where `user_email`='".$this->existing_username."' and `user_pwd`='".$this->existing_password."' and `status`='E'";
		$result=mysqli_query($this->conn,$query);
		$res=mysqli_fetch_row($result);
		return $res;
	}
	/* Function for login users */
	public function check_login_user(){
		$query="SELECT * FROM `".$this->table_name."` WHERE `user_email`='".$this->existing_username."' AND `status`='E'";
		$result=mysqli_query($this->conn,$query);
		$res=mysqli_fetch_row($result);
		return $res;
	}
	/* Function for Display Customer In export page */
	public function display_customer(){
		$query = "SELECT * FROM `".$this->table_name."`";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	/*  display all customers in customers page in admin pane  */
	public function readall(){
		$query = "select * from `".$this->table_name."`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* display customer register email check */
	public function check_customer_email_existing(){
		$query="select * from `".$this->table_name_admin."` where `email`='".$this->user_email."'";
    $result=mysqli_query($this->conn,$query);
		$value = mysqli_fetch_array($result);
		if(mysqli_num_rows($result)>0){
      return $value= isset($value[0])? $value[0] : '' ;
		}else{
			$query2="select * from `".$this->table_name."` where `user_email`='".$this->user_email."'";
			$result_user=mysqli_query($this->conn,$query2);
			$value1 = mysqli_fetch_array($result_user);
			return $value1[0];
		}
	}
	/* display total bookings of the users */
	public function get_users_totalbookings($userid){
		$query  = "select DISTINCT `order_id` from `d4mbookings` where `client_id` ='".$userid."'";
		$result=mysqli_query($this->conn,$query);
		$val=mysqli_num_rows($result);
		return $val;
	}
	/* get service name by client_id */
	public function get_user_bookings(){
    $query = "select DISTINCT `d4mbookings`.*,`d4mservices`.`title` as `sname`,`d4mpayments`.`payment_method` as `c_payment_method`,`d4mservices_method`.`method_title` as `c_method_name` from `d4mbookings`,`d4mservices`,`d4mpayments`,`d4mservices_method` where `d4mbookings`.`client_id`='".$this->user_id."' and `d4mbookings`.`service_id` = `d4mservices`.`id` and `d4mbookings`.`method_id` = `d4mservices_method`.`id` and `d4mbookings`.`order_id` = `d4mpayments`.`order_id` ORDER BY `d4mbookings`.`order_id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* new method for customers page to display customer booking */
	public function get_user_bookingss(){
		$query = "select DISTINCT `b`.`booking_status`, `b`.`booking_date_time`, `p`.`order_id`,`s`.`title` as `sname`,`p`.`payment_method` as `c_payment_method`,`p`.`net_amount` as `pna` from `d4mbookings` as `b`, `d4mservices` as `s`, `d4mpayments` as `p`,`d4mservices_method` as `sm` where `b`.`client_id`='".$this->user_id."' and `b`.`service_id` = `s`.`id` and `b`.`order_id` = `p`.`order_id`  ORDER BY `b`.`order_id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
  public function get_addon_name($order_id){
		$query = "select `d4mbooking_addons`.*,`d4mservices_addon`.`addon_service_name` from `d4mbooking_addons`,`d4mservices_addon` where `d4mbooking_addons`.`order_id` = '".$order_id."' and `d4mbooking_addons`.`addons_service_id` = `d4mservices_addon`.`id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
  }
	/* get all guest users list */
	public function read_all_guestuser(){
    $query = "select DISTINCT `d4mbookings`.`order_id`,`d4morder_client_info`.* from `d4mbookings`,`d4morder_client_info` where `d4mbookings`.`client_id` = 0 and `d4mbookings`.`order_id` =`d4morder_client_info`.`order_id`   ORDER by `d4mbookings`.`order_id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
  }
	/* to get the guest users bookings */
	public function get_bookings_guest($orderid,$email){
    $query = "select DISTINCT `d4mbookings`.*,`d4mservices`.`title` as `sname`, `d4mpayments`.`payment_method` as `c_payment_method`,`d4mservices_method`.`method_title` as `c_method_name` from `d4morder_client_info`,`d4mbookings`,`d4mservices`,`d4mpayments`,`d4mservices_method` where `d4mbookings`.`order_id`= '".$orderid."' and `d4morder_client_info`.`client_email` = '".$email."' and `d4mbookings`.`service_id` = `d4mservices`.`id` and `d4mbookings`.`method_id` = `d4mservices_method`.`id` and `d4mbookings`.`order_id` = `d4mpayments`.`order_id` and `d4mbookings`.`order_id` = `d4morder_client_info`.`order_id`  ORDER BY `d4mbookings`.`order_id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* whole new methods for get guest bookings */
	public function get_bookings_guests($orderid,$email){
    $query = "select DISTINCT `b`.`booking_status`, `b`.`booking_date_time`, `p`.`order_id`,`s`.`title` as `sname`,`p`.`payment_method` as `c_payment_method`,`p`.`net_amount` as `pna` from `d4morder_client_info` as `oc`,`d4mbookings` as `b`,`d4mservices` as `s`, `d4mpayments` as `p` where `oc`.`order_id`= '".$orderid."' and `oc`.`client_email` = '".$email."' and `b`.`service_id` = `s`.`id` and `b`.`order_id` = `p`.`order_id` and `b`.`order_id` = `oc`.`order_id`  ORDER BY `b`.`order_id`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* get all units */
	public function get_all_bookingsbyorderid($order_id){
		$query = "select * from `d4mbookings` where `order_id` = '".$order_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	public function get_name_unitbyid($unitid){
		$query = "select `units_title` from `d4mservice_methods_units` where `id` = '".$unitid."'";
		$result=mysqli_query($this->conn,$query);
		$val=mysqli_fetch_row($result);
		return $val[0];
	}
	public function delete_bookings_guestcustomers($orderid){
		/* bookings */
		$query1 = "delete from `d4mbookings` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query1);

		/* booking_addons */
		$query2 = "delete from `d4mbooking_addons` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query2);

		/* payments */
		$query3 = "delete from `d4mpayments` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query3);

		/* order_client_info */
		$query4 = "delete from `".$this->table_name1."` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query4);
		
		/* staff_status */
		$query5 = "delete from `d4mstaff_status` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query5);
		
		/* staff_commission */
		$query6 = "delete from `d4mstaff_commission` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query6);
  }
	public function check_email(){
		$query="select * from `".$this->table_name_admin."` where `email`='".$this->user_email."'";
		$result_admin=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result_admin) > 0){
			return $result_admin;
		}
		else
		{
			$query="select * from `".$this->table_name."` where `user_email`='".$this->user_email."'";
			$result_user=mysqli_query($this->conn,$query);
			return $result_user;
		}
	}
	public function forget_password(){
		$query = "SELECT `id` as `user_id` FROM  `".$this->table_name."` where `user_email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query);
		$res = mysqli_fetch_row($result);
		return $res;
	}
	public function update_password(){
		$query = "update `".$this->table_name."`  set `user_pwd`='".md5($this->user_pwd)."'  where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
  public function get_client_info($orderid){
		$query = "SELECT * FROM  `".$this->table_name1."` where `order_id`='".$orderid."'";
		$result=mysqli_query($this->conn,$query);
		$res = mysqli_fetch_row($result);
		return $res;
  }
	public function delete_bookings_registeredcustomers($usersid){
		/* bookings */
		$query1 = "select * from `d4mbookings` where `client_id`='".$usersid."'";
		$result1=mysqli_query($this->conn,$query1);
		
		while( $arr = mysqli_fetch_array ( $result1 ) ){
			/* booking_addons */
			$query2 = "delete from `d4mbooking_addons` where `order_id`='".$arr['order_id']."'";
			$result2=mysqli_query($this->conn,$query2);

			/* payments */
			$query3 = "delete from `d4mpayments` where `order_id`='".$arr['order_id']."'";
			$result3=mysqli_query($this->conn,$query3);

			/* order_client_info */
			$query4 = "delete from  `".$this->table_name1."` where `order_id`='".$arr['order_id']."'";
			$result4=mysqli_query($this->conn,$query4);
			
			/* staff_status */
			$query5 = "delete from `d4mstaff_status` where `order_id`='".$arr['order_id']."'";
			$result=mysqli_query($this->conn,$query5);
			
			/* staff_commission */
			$query6 = "delete from `d4mstaff_commission` where `order_id`='".$arr['order_id']."'";
			$result=mysqli_query($this->conn,$query6);
		}
		
		$query7 = "delete from `d4mbookings` where `client_id`='".$usersid."'";
    $result7=mysqli_query($this->conn,$query7);
		
		$query8 = "delete from `d4musers` where `id`='".$usersid."'";
    $result8 = mysqli_query($this->conn,$query8);
  }
	public function check_login_process(){
		$query="SELECT * FROM `".$this->table_name."` WHERE `user_email`='".$this->existing_username."' AND `user_pwd`='".$this->existing_password."' AND `status`='E'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result) > 0){
			return $result;
			die;
		}
		$query="SELECT * FROM `".$this->table_name_admin."` WHERE `email`='".$this->existing_username."' AND `password`='".$this->existing_password."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* API Functions */
	public function get_payment_order_record(){
    $query="SELECT `cb`.`order_id`,`cb`.`order_date`,`cb`.`booking_date_time`,`cb`.`order_id`,`cs`.`title` as `service_name`,`cp`.`order_id`,`cp`.`payment_method`,`cp`.`transaction_id`,`cp`.`net_amount`,`cp`.`payment_status`,`cp`.`payment_method`,`cp`.`payment_date` FROM `d4mbookings`as `cb`,`d4mservices` as `cs`,`d4mpayments` as `cp` WHERE `cb`.`client_id` = '".$this->user_id."' AND `cb`.`service_id` = `cs`.`id` AND `cb`.`order_id` = `cp`.`order_id` limit ".$this->limit." offset ".$this->offset;
    $result = mysqli_query($this->conn,$query);
    return $result;
  }
	public function get_staff_payment_order_record(){
		$query="SELECT `cb`.`order_id`,`cb`.`order_date`,`cb`.`booking_date_time`,`cb`.`order_id`,`cs`.`title` as `service_name`,`cp`.`order_id`,`cp`.`payment_method`,`cp`.`transaction_id`,`cp`.`payment_status`,`cp`.`payment_method`,`cp`.`payment_date` FROM `d4mbookings`as `cb`,`d4mservices` as `cs`,`d4mpayments` as `cp` WHERE `cb`.`staff_ids` = '".$this->user_id."' AND `cb`.`service_id` = `cs`.`id` AND `cb`.`order_id` = `cp`.`order_id`";
		$result = mysqli_query($this->conn,$query);
		return $result;
  }
	public function get_data(){
		$query="select * from new_table";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}																					
	/* API OTP Functions */
	public function readall_opt(){
		$query  = "select * from `".$this->table_otp."` where `email`='".$this->email."' ORDER BY id desc limit 1";
    $result=mysqli_query($this->conn,$query);
		$value1 = mysqli_fetch_array($result);
    return $value1[2];
	}
	public function opt_update_status(){
		$query="update `".$this->table_otp."` set `status`='V' where `email`='".$this->email."' and `otp`='".$this->otp."'";
		$result=mysqli_query($this->conn,$query);
		return $result[2];	
	}
	public function forgot_update_password(){
		$query="update `".$this->table_name_admin."` set `password`='".$this->user_pwd."' where `email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query);		
		$query1="update `".$this->table_name."` set `user_pwd`='".$this->user_pwd."' where `user_email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query1);
		return $result;	
	}
	public function send_otp_using_mail(){
		$query="insert into `".$this->table_otp."` (`id`,`email`,`otp`,`status`) values(NULL,'".$this->user_email."','".$this->user_otp."','NV')";
		$result=mysqli_query($this->conn,$query);	
		return $result;
	}
	public function update_user_stripe_id(){
		$query="update `".$this->table_name."` set `stripe_id`='".$this->stripe_id."' where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
}
?>