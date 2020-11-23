<?php        
class do4me_adminprofile {
	public $id;
	public $email;
	public $pass;
	public $fullname;
	public $password;
	public $phone;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $role;
	public $description;
	public $enable_booking;
	public $service_commission;
	public $commission_value;
	public $staff_seled4maccording_service;
	public $schedule_type;
  public $APIUsername;
  public $APIPassword;
  public $APISignature;
  public $APItestmode;
	public $d4mservice_staff;
	public $tablename="d4madmin_info";
	public $tablename_user="d4musers";
  public $tablename_otp="d4mregister_otp";
  public $update_wallet_value;
	public $conn;


	/*Function for Read Only one data matched with Id*/
	public function readone(){
		$query="select * from `".$this->tablename."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
	/*Function for Update service-Not Used in this*/
	public function update_profile(){
		$address = mysqli_real_escape_string($this->conn,$this->address);
		$query="update `".$this->tablename."` set `fullname`='".$this->fullname."' ,email='".$this->email."' ,`phone`='".$this->phone."' ,`address`='".$address."' ,`city`='".$this->city."' ,`state`='".$this->state."' ,`zip`='".$this->zip."' ,`country`='".$this->country."',`password`='".$this->password."' where `id`='".$this->id."' ";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	public function forget_password(){
		$query = "SELECT `id` as `user_id` FROM `".$this->tablename."` where `email`='".$this->email."'";
		$result=mysqli_query($this->conn,$query);
		$res = mysqli_fetch_row($result);
		if(count((array)$res) != 0 ){
			$_SESSION['fp_admin'] = "yes";
			return $res;
		} else {
			$query = "SELECT `id` as `user_id` FROM `".$this->tablename_user."` where `user_email`='".$this->email."'";
			$result=mysqli_query($this->conn,$query);
			$res = mysqli_fetch_row($result);
			$_SESSION['fp_user'] = "yes";
			return $res;
		}
	}
	public function update_password(){
		if(isset($_SESSION['fp_admin'])){
			$query = "update `".$this->tablename."`  set `password`='".md5($this->password)."'  where `id`='".$this->id."'";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}
		elseif(isset($_SESSION['fp_user'])){
			$query = "update `".$this->tablename_user."` set `user_pwd`='".md5($this->password)."'  where `id`='".$this->id."'";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}
	}
	public function readone_adminname(){
		$query="select * from `".$this->tablename."` LIMIT 1";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
	/* Function for add staff */
	public function add_staff(){
		 $query="insert into `".$this->tablename."` (`id`, `password`, `email`, `fullname`, `phone`, `address`, `city`, `state`, `zip`, `country`,`role`, `description`, `enable_booking`, `service_commission`, `commision_value`, `schedule_type`, `image`, `service_ids`) values(NULL,'".md5($this->pass)."','".$this->email."','".$this->fullname."','', '', '', '', '', '', '".$this->role."', '', 'N', 'F', '0', 'W', '', '')";
		$result=mysqli_query($this->conn,$query);	
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	/* Function for count staff */
	public function countall_staff(){
		$query="select count(`id`) as `c_sid` from `".$this->tablename."` where `role` = 'staff'";
		$result=mysqli_query($this->conn,$query);	
		$value = mysqli_fetch_array($result);
		return $value= isset($value[0])? $value[0] : '' ;
	}	
	
	/*  display all staff in staff page in admin pane  */
	public function readall_staff(){
		$query = "select * from `".$this->tablename."` where `role` = 'staff'";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	/*  display all staff available for booking  */
	public function readall_staff_booking(){
		$query  = "select * from `".$this->tablename."` where `role` = 'staff' and `enable_booking` = 'Y'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/* staff details update*/
	public function update_staff_details(){
		$query="update `".$this->tablename."` set `fullname`='".$this->fullname."' ,`email`='".$this->email."' ,`description`='".$this->description."' ,`phone`='".$this->phone."' ,`address`='".$this->address."' ,`city`='".$this->city."' ,`state`='".$this->state."' ,`zip`='".$this->zip."' ,`country`='".$this->country."' ,`enable_booking`='".$this->enable_booking."' ,`image`='".$this->image."'  ,`service_ids`='".$this->d4mservice_staff."',`paypal_api_username`='".$this->APIUsername."',`paypal_api_password`='".$this->APIPassword."',`paypal_api_signature`='".$this->APISignature."',`paypal_test_mode_status`='".$this->APItestmode."' where `id`='".$this->id."' ";
		$result=mysqli_query($this->conn,$query);
    return $result;
	}
	/* delete staff */
	public function delete_staff(){
		$query = "delete from `".$this->tablename."` where `id` = '".$this->id."'";
		$result=mysqli_query($this->conn,$query);
	}
	/* Update image in staff page */	
	public function update_pic(){
		$query="update `".$this->tablename."` set `image`='' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/*display staff service details  in staff page*/
	public function staff_service_details(){
		$query="SELECT `d4mbookings`.`id`,`d4mservices`.`title`,`d4mbookings`.`staff_ids`, `d4madmin_info`.`fullname`,`d4mpayments`.`amount`,  `d4madmin_info`.`service_commission`, `d4madmin_info`.`commision_value`,`d4mbookings`.`booking_date_time`
		FROM `d4mbookings`, `d4mpayments`, `d4madmin_info`,`d4mservices`
		WHERE `d4mbookings`.`order_id` = `d4mpayments`.`order_id`
		AND `d4mbookings`.`staff_ids` = `d4madmin_info`.`id` and `d4mbookings`.`service_id`=`d4mservices`.`id` and `d4mbookings`.`staff_ids`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/*display staff service details  in staff page*/
	public function check_staff_email_existing(){
		$query="select count(`id`) as `c` from `".$this->tablename."` where `email`='".$this->email."'";
    $result=mysqli_query($this->conn,$query);
		$value = mysqli_fetch_array($result);
    return $value= isset($value[0])? $value[0] : '' ;
	}
	public function get_service_acc_provider(){
    $query = "select id from d4madmin_info where service_ids like '%" . $this->staff_seled4maccording_service . "%'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	public function get_search_staff_detail_byid($staff_id){
		$query = "SELECT `fullname`,`image` FROM `d4madmin_info` WHERE `id`='".$staff_id."'";
		$result = mysqli_query($this->conn, $query);
		$ress = mysqli_fetch_array($result); 
		return $ress;
  }
	public function update_password_api(){
		$query = "update `".$this->tablename."` set `password`='".md5($this->password)."'  where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* API Function */
	public function get_service_acc_provider_api(){
		$query = "select id,fullname from d4madmin_info where service_ids like '%" . $this->staff_seled4maccording_service . "%'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}

  /* Function for reg staff */
  public function reg_staff(){
    $query="insert into `".$this->tablename."` (`id`, `password`, `email`, `fullname`, `phone`, `address`, `city`, `state`, `zip`, `country`,`role`, `description`, `enable_booking`, `service_commission`, `commision_value`, `schedule_type`, `image`, `service_ids`) values(NULL,'".md5($this->pass)."','".$this->email."','".$this->fullname."','', '', '', '', '', '', 'staff', '', 'N', 'F', '0', 'W', '', '".$this->service."')";
    $result=mysqli_query($this->conn,$query); 
    $value=mysqli_insert_id($this->conn);
    return $value;
  }

  public function update_staff_details_staffsection(){
    $query="update `".$this->tablename."` set `fullname`='".$this->fullname."' ,`email`='".$this->email."' ,`description`='".$this->description."' ,`phone`='".$this->phone."' ,`address`='".$this->address."' ,`city`='".$this->city."' ,`state`='".$this->state."' ,`zip`='".$this->zip."' ,`country`='".$this->country."' ,`enable_booking`='".$this->enable_booking."' ,`image`='".$this->image."'  ,`service_ids`='".$this->d4mservice_staff."' where `id`='".$this->id."' ";
    $result=mysqli_query($this->conn,$query);
    return $result;
  }

   /*insert otp in the otp table*/
  public function insert_otp(){
    $query="insert into `".$this->tablename_otp."` (`id`, `phone`, `otp`) values(NULL,'".$this->phoneno."','".$this->otp."')";
    $result=mysqli_query($this->conn,$query); 
    $value=mysqli_insert_id($this->conn);
    return $result;
  } 

  /*check otp*/
  public function check_otp_for_phone(){
    $query="select otp from `".$this->tablename_otp."` where `phone`='".$this->phoneno."'";
        $result=mysqli_query($this->conn,$query);
        $res = mysqli_fetch_row($result);
    return $res;
  }

  /*update otp*/
  public function update_otp(){
    $query="update `".$this->tablename_otp."` set `otp`='".$this->otp."'  where `phone`='".$this->phoneno."' ";
    $result=mysqli_query($this->conn,$query);
    return $result;
  }

  /*verify otp*/
  public function verify_otp(){
    $query = "select * from `".$this->tablename_otp."` where `phone`='".$this->phone."' and `otp` = '".$this->otp."'";
        $result=mysqli_query($this->conn,$query); 
    $res = mysqli_fetch_row($result);
    return $res;   
  }

  public function get_previous_staff_wallet(){
    $query="select `staff_wallet_amount`,`email`,`fullname` from `".$this->tablename."` where `id`='".$this->id."'";
    $result=mysqli_query($this->conn,$query);
    $value=mysqli_fetch_row($result);
    return $value;
  }

  public function update_staff_wallet(){
    $query = "update `".$this->tablename."`  set `staff_wallet_amount`='".$this->update_wallet_value."' where `id`='".$this->id."'";
    $result=mysqli_query($this->conn,$query);
    return $result;
  }
    
  public function update_staff_wallet_byemail(){
    $query = "update `".$this->tablename."`  set `staff_wallet_amount`='".$this->update_wallet_value."' where `email`='".$this->email."'";
    $result=mysqli_query($this->conn,$query);
    return $result;
  }

  public function get_staff_reve($staff_id){
    $query="select `revenue_percentage` from `".$this->tablename."` WHERE `id`='".$staff_id."'";
    $result=mysqli_query($this->conn,$query);
    $value=mysqli_fetch_array($result);
    return $value= isset($value[0])? $value[0] : '' ;
  } 
	
}