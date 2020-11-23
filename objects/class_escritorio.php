<?php  class do4me_dashboard{        /* get all data for popup of the click */        /* get cleint detail */        public function getclient($id)        {            $query = "SELECT * FROM `d4musers` WHERE `id` = $id";            $result=mysqli_query($this->conn,$query);						if(!empty($result)){            $value=mysqli_fetch_row($result);							return $value;						}}/* get guest client info */        public function getguestclient($orderid)        {          $query = "SELECT * FROM `d4morder_client_info` WHERE `order_id` = $orderid";          $result=mysqli_query($this->conn,$query);          $value=mysqli_fetch_row($result);          return $value;        }        /* get client order for popup */        public function getclientorder($orderid)        {          $query = "SELECT DISTINCT `b`.`booking_date_time`,					`s`.`title`,					`p`.`net_amount`,					`b`.`client_id`,					`b`.`order_id`,					`p`.`payment_method`,					`b`.`booking_status`,					`b`.`rejed4mreason`,					`oci`.`order_duration`,					`b`.`staff_ids`					FROM `d4mbookings` as `b`,`d4mservices` as `s`,`d4mpayments` as `p`,`d4morder_client_info` as `oci`                    WHERE `b`.`service_id` = `s`.`id`                    and `b`.`order_id` = `p`.`order_id`					and `b`.`order_id` = `oci`.`order_id`                    and `b`.`order_id` = $orderid ";            $result = mysqli_query($this->conn, $query);            $value = mysqli_fetch_row($result);            return $value;        }         /* notificatrion code */    /* get total no of bookings */    public function getallbookings_notify(){		        $query = "SELECT DISTINCT `b`.`read_status`,  `b`.`order_id`, `b`.`booking_status`, `b`.`booking_date_time`, `b`.`lastmodify`, `b`.`client_id`, `s`.`title` FROM `d4mbookings` as `b`,`d4mservices` as `s` WHERE `b`.`service_id` = `s`.`id`  ORDER BY `b`.`lastmodify` DESC";        $result=mysqli_query($this->conn,$query);        return $result;    }/* get total no of bookings */    public function getallbookingsunread_count(){        $query = "SELECT DISTINCT `order_id` FROM `d4mbookings` WHERE `read_status` = 'U'  ORDER BY `order_id` DESC";        $result=mysqli_query($this->conn,$query);        return $result;    }    /* Confirm the booking */        public function confirm_bookings($orderid,$lastmodify)        {            $query="update `d4mbookings` set `booking_status`='C',`lastmodify` = '".$lastmodify."' where `order_id`='".$orderid."' ";            $result=mysqli_query($this->conn,$query);            return $result;        }        /* function to update the read ststus of the notification */        public function update_read_status($orderid){            $query="update `d4mbookings` set `read_status`='R' where `order_id`='".$orderid."' ";            $result=mysqli_query($this->conn,$query);            return $result;        }        /* reject the order/bookings */        public function rejed4mbookings($orderid,$reason,$lastmodify){            $query="update `d4mbookings` set `booking_status`='R',`rejed4mreason`='".$reason."',`lastmodify` = '".$lastmodify."' where `order_id`='".$orderid."'";            $result=mysqli_query($this->conn,$query);            return $result;        }        /*  delete the booking */        public function delete_booking($orderid)        {            /* d4mstaff_commission */            $query5 = "delete from `d4mstaff_commission` where `order_id`='".$orderid."'";            $result5=mysqli_query($this->conn,$query5);            /* bookings */            $query1 = "delete from `d4mbookings` where `order_id`='".$orderid."'";            $result=mysqli_query($this->conn,$query1);            /* booking_addons */            $query2 = "delete from `d4mbooking_addons` where `order_id`='".$orderid."'";            $result=mysqli_query($this->conn,$query2);            /* payments */            $query3 = "delete from `d4mpayments` where `order_id`='".$orderid."'";            $result=mysqli_query($this->conn,$query3);            /* order_client_info */            $query4 = "delete from `d4morder_client_info` where `order_id`='".$orderid."'";            $result=mysqli_query($this->conn,$query4);        }        /* get total guest users */        public function total_guest_users(){            $query="select DISTINCT count(*) from `d4mbookings` where `client_id` = 0  ORDER BY `order_id`;";            $result=mysqli_query($this->conn,$query);            return count(mysqli_num_rows($result));        }				/* newly added */    public function clientemailsender($orderid)    { $query="select `s`.`title`,`oci`.`client_name`,`oci`.`client_email`,`b`.`booking_date_time`,`a`.`email`, `a`.`fullname`from`d4morder_client_info` as `oci`,`d4mbookings` as `b`,`d4mservices` as `s` , `d4madmin_info` as `a`where`b`.`order_id` = '".$orderid."'and `b`.`order_id`  = `oci`.`order_id`and `b`.`service_id` = `s`.`id`";            $result=mysqli_query($this->conn,$query);        $value=mysqli_fetch_array($result);        return $value;    }			 /*function to count total no of services */        public function countallservice()        {            $query="select count(*) as `c` from `d4mservices`";            $result=mysqli_query($this->conn,$query);            $value= @mysqli_fetch_row($result);            return $value= isset($value[0])? $value[0] : '' ;        }    /*NEWLY ADDED FUNCTIONS */    /*SMS TEMPLATE GET FOR CONFIRM*/    public function gettemplate_sms($action,$user){        $query="select * from `d4msms_templates` where `sms_template_type` = '".$action."' and `user_type` = '".$user."'";        $result=mysqli_query($this->conn,$query);        $value= @mysqli_fetch_row($result);        return $value;    }		/* get client order for popup api */        public function getclientorder_api($orderid)        {           $query = "SELECT DISTINCT `b`.`booking_date_time`,					`s`.`title`,					`p`.`net_amount`,					`b`.`client_id`,					`b`.`order_id`,					`p`.`payment_method`,					`b`.`booking_status`					FROM `d4mbookings` as `b`,`d4mservices` as `s`,`d4mpayments` as `p`                    WHERE `b`.`service_id` = `s`.`id`                    and `b`.`order_id` = `p`.`order_id`                    and `b`.`order_id` = $orderid ";            $result = mysqli_query($this->conn, $query);            $value = mysqli_fetch_row($result);            return $value;        }}?>