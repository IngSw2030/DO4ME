<?php  class do4me_general {	public $conn;	public $table_name="d4msettings";		function d4mprice_format($cal_amount,$symbol_position,$decimal) {		$return_price = '';		$amount = str_replace(' ','',$cal_amount);		$query = "select `option_value` from `d4msettings` where `option_name` = 'd4mcurrency_symbol'";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_row($result);		$currency_symbol = $value[0];		if($amount != ''){			if($symbol_position=='$100') { 						$pos = strpos($amount, '-');				if($pos === false){					$return_price = $currency_symbol.number_format($amount, $decimal, '.', '');					}else{					$final_amount = str_replace('-','',$amount);					$return_price = '-'.$currency_symbol.number_format($final_amount, $decimal, '.', '');				}			}else{				$return_price = number_format($amount, $decimal, '.', '').$currency_symbol; 			}						return $return_price;			}	}		function d4mprice_format_total($cal_amount,$symbol_position,$decimal) {		$return_price = '';		$amount = str_replace(' ','',$cal_amount);		$query = "select `option_value` from `d4msettings` where `option_name` = 'd4mcurrency_symbol'";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_row($result);		$currency_symbol = $value[0];		if($amount != ''){			if($symbol_position=='$100') { 						$pos = strpos($amount, '-');				if($pos === false){					$return_price = "<span class=d4mtotal_small>".$currency_symbol."</span>".number_format($amount, $decimal, '.', '');					}else{					$final_amount = str_replace('-','',$amount);					$return_price = '-'."<span class=d4mtotal_small>".$currency_symbol."</span>".number_format($final_amount, $decimal, '.', '');				}			}else{				$return_price = number_format($amount, $decimal, '.', '')."<span class=d4mtotal_small>".$currency_symbol."</span>"; 			}						return $return_price;			}	}		function d4mprice_format_for_pdf($cal_amount,$symbol_position,$decimal) {			$return_price = '';		$amount = str_replace(' ','',$cal_amount);		$query = "select `option_value` from `d4msettings` where `option_name` = 'd4mcurrency_symbol'";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_row($result);		$currency_symbol = $value[0];		if($amount != ''){			if($symbol_position=='$100') { 					/* $return_price .= iconv('UTF-8', 'windows-1252', $currency_symbol); */				$return_price .= $currency_symbol;				$return_price .= number_format($amount, $decimal, '.', '');			}else{				$return_price .= number_format($amount, $decimal, '.', '');				$return_price .= iconv('UTF-8', 'windows-1252', $currency_symbol);			}			return $return_price;			}			}						function d4mprice_format_without_symbol($cal_amount,$decimal) {		$return_price = '';		$amount = str_replace(' ','',$cal_amount);		if($amount != ''){			$return_price = number_format($amount, $decimal, '.', ''); 			return $return_price;			}	}}?>