<?php
include('classes/contractor.php');
include('classes/mail.php');
$Contractor =  new Contractor();
$Mail =  new Mail();


/***** SEND MAIL FOR DUE AFTER ONE MONTH*********/
$data = $Contractor->contractors_expire_after_one_month();

$mails = $Mail->load_mail(13);
$date_1m_after  = mktime(0, 0, 0, date("m")+1  , date("d"), date("Y"));
foreach($data as $contractor){
	$mail_detail['to'] = $contractor['email'];
	$mail_detail['from'] = $mails['from'].'<'.$Contractor->load_site_detail('adminemail').'>';
	$mail_detail['subject'] = $mails['subject'];
	$body = $mails['body'];
	$body = str_replace('{USER}',$contractor['name'],$body);
	$body = str_replace('{DATE}',date("jS , F Y",$date_1m_after),$body);
	$body = str_replace('{QUARTELY_FEE}','$'.$contractor['quarterly_fee'],$body);
	$mail_detail['data'] = $body;
	$Mail->send_mail($mail_detail);
	
}
/***** SEND MAIL FOR DUE AFTER ONE MONTH END*********/






/***** SEND MAIL FOR DUE AFTER 10 DAY*********/
$data = $Contractor->contractors_expire_after_10_days();

$mails = $Mail->load_mail(13);
$date_1m_after  = mktime(0, 0, 0, date("m")  , date("d")+10, date("Y"));
foreach($data as $contractor){
	$mail_detail['to'] = $contractor['email'];
	$mail_detail['from'] = $mails['from'].'<'.$Contractor->load_site_detail('adminemail').'>';
	$mail_detail['subject'] = $mails['subject'];
	$body = $mails['body'];
	$body = str_replace('{USER}',$contractor['name'],$body);
	$body = str_replace('{DATE}',date("jS , F Y",$date_1m_after),$body);
	$body = str_replace('{QUARTELY_FEE}','$'.$contractor['quarterly_fee'],$body);
	$mail_detail['data'] = $body;
	$Mail->send_mail($mail_detail);
	
}
/***** SEND MAIL FOR DUE AFTER 10 DAY END*********/




/***** SEND MAIL FOR DUE Today*********/
$data = $Contractor->contractors_expire_today();

$mails = $Mail->load_mail(14);
$date_1m_after  = mktime(0, 0, 0, date("m")  , date("d")+10, date("Y"));
foreach($data as $contractor){
	$mail_detail['to'] = $contractor['email'];
	$mail_detail['from'] = $mails['from'].'<'.$Contractor->load_site_detail('adminemail').'>';
	$mail_detail['subject'] = $mails['subject'];
	$body = $mails['body'];
	$body = str_replace('{USER}',$contractor['name'],$body);
	$body = str_replace('{DATE}',date("jS , F Y",$date_1m_after),$body);
	$body = str_replace('{QUARTELY_FEE}','$'.$contractor['quarterly_fee'],$body);
	$mail_detail['data'] = $body;
	$Mail->send_mail($mail_detail);
	
}
/***** SEND MAIL FOR DUE Today END*********/



/***** SEND MAIL FOR DUE Before 3 days ago*********/
$data = $Contractor->contractors_expired_before_3days();

$mails = $Mail->load_mail(15);
$date_1m_after  = mktime(0, 0, 0, date("m")  , date("d")+10, date("Y"));
foreach($data as $contractor){
	$mail_detail['to'] = $contractor['email'];
	$mail_detail['from'] = $mails['from'].'<'.$Contractor->load_site_detail('adminemail').'>';
	$mail_detail['subject'] = $mails['subject'];
	$body = $mails['body'];
	$body = str_replace('{USER}',$contractor['name'],$body);
	$body = str_replace('{DATE}',date("jS , F Y",$date_1m_after),$body);
	$body = str_replace('{QUARTELY_FEE}','$'.$contractor['quarterly_fee'],$body);
	$mail_detail['data'] = $body;
	$Mail->send_mail($mail_detail);
	
}

/***** SEND MAIL FOR DUE Before 3 days ago end*********/

?>
