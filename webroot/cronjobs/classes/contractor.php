<?php
include ("db.php");
class Contractor{
	var $data = array();
	
	
	function contractors_expire_after_one_month(){
		$befor_one_month  = mktime(0, 0, 0, date("m")+1  , date("d"), date("Y"));
		//echo date("Y-m-d",$befor_one_month);die;
		
		$query = mysql_query("select * from contractors where status <> 0 and automatic_renew = 0 and paid_sign_up_fee = 1 and end_date = ".date("Y-m-d",$befor_one_month));
		while($result = mysql_fetch_assoc($query)){
			
			//$this->data['to'] = $result['email'];
			//$this->data['from'] = $mails['from'].'<'.self::load_site_detail('adminemail').'>';
			
			$this->data[] = $result;
		}
		
		return $this->data;
	}
	
	
	function contractors_expire_after_10_days(){
		$before_10_day  = mktime(0, 0, 0, date("m")  , date("d")+10, date("Y"));
		//echo date("Y-m-d",$befor_one_month);die;
		
		$query = mysql_query("select * from contractors where status <> 0 and automatic_renew = 0 and paid_sign_up_fee = 1 and end_date = ".date("Y-m-d",$before_10_day));
		while($result = mysql_fetch_assoc($query)){
			
			//$this->data['to'] = $result['email'];
			//$this->data['from'] = $mails['from'].'<'.self::load_site_detail('adminemail').'>';
			
			$this->data[] = $result;
		}
		
		return $this->data;
	}
	
	function contractors_expire_today(){
		$today  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
		//echo date("Y-m-d",$befor_one_month);die;
		
		$query = mysql_query("select * from contractors where status <> 0 and automatic_renew = 0 and paid_sign_up_fee = 1 and end_date = ".date("Y-m-d",$today));
		while($result = mysql_fetch_assoc($query)){
			
			//$this->data['to'] = $result['email'];
			//$this->data['from'] = $mails['from'].'<'.self::load_site_detail('adminemail').'>';
			
			$this->data[] = $result;
		}
		
		return $this->data;
	}
	
	function contractors_expired_before_3days(){
		$today  = mktime(0, 0, 0, date("m")  , date("d")-3, date("Y"));
		//echo date("Y-m-d",$befor_one_month);die;
		
		$query = mysql_query("select * from contractors where status <> 0 and automatic_renew = 0 and paid_sign_up_fee = 1 and end_date = ".date("Y-m-d",$today));
		while($result = mysql_fetch_assoc($query)){
			
			//$this->data['to'] = $result['email'];
			//$this->data['from'] = $mails['from'].'<'.self::load_site_detail('adminemail').'>';
			
			$this->data[] = $result;
		}
		
		return $this->data;
	}
	
	
	
	
	
	public function load_site_detail($title = null){
		
		$query = mysql_query("select value from sites where title = '".$title."'");
		$data = mysql_fetch_assoc($query);
		return $data['value'];
	}
	
}



?>
