<?php
include ("db.php");
class Mail{
	
	
	function load_mail($id = null){
		$query = mysql_query("select * from mails where id = ".$id);
		return mysql_fetch_assoc($query);
	}
	function send_mail($mails = array()){
		$from = $mails['from'];
		mail("himanshu.saamarth@gmail.com",$mails['subject'],$mails['data'],"From:$from\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1");
	}
	
}

?>
