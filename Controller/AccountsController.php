<?php
class AccountsController extends AppController{
	var $name = 'Accounts';
	var $helpers = array('Fck');
	var $components = array();
	var $uses = array('Contractor','HomeOwner');
	
	function change_password(){
		if(!empty($this->request->data) && self::__validateChangePassword()){
			$id = $this->Member->getActiveContractorId();
			$this->request->data['Contractor']['password1'] = $this->request->data['account']['password'];
			$this->request->data['Contractor']['password'] =self::__generateEnryptPassword($this->request->data['account']['password']);
			$this->request->data['Contractor']['id'] =$id;
			unset($this->request->data['account']);
			$this->Contractor->create();
			$this->Contractor->save($this->request->data);
			$contractor_detail = $this->Contractor->read(null,$id);
			$this->Member->update_contractor_session($contractor_detail);
			$this->Session->setFlash('Password Updated Successfully');
			$this->redirect(array('action'=>'change_password'));
			
		}
	}
        
        
        
        function test(){
            echo "sfsdfsdfsd";
            
        }
	
		
	function pay_dues(){
		
		$contractor_id = $this->Member->getActiveContractorId();
		
		
		if($this->request->is('post')){
			//print_r($this->request->data);
			
			//self::authorize_payment();
			$login_id = Configure::read('AUTHORIZE_NET_LOGIN_ID');
			$transaction_key = Configure::read('AUTHORIZE_NET_TRANSACTION_KEY');
			//App::import('Vendor','authorize_net/AuthorizeNet',array('file' => 'AuthorizeNet.php'));
			$response = self::authorize_payment($login_id , $transaction_key,true,$this->request->data['cardnum'],$this->request->data['securitycode'],$this->request->data['exp'],'',$this->request->data['total_value']);
			
			$period_start = date("Y-m-d");
			$period_end = date("Y-m-d",mktime(0, 0, 0, date("m")+3  , date("d"), date("Y")));
			
			$payment['Payment']['id']  =  '';
			$payment['Payment']['contractor_id'] = $contractor_id;
			$payment['Payment']['date'] = strtotime('today');
			$payment['Payment']['amount']  =  $response->amount;
			//$payment['Payment']['period_start']  =  $this->Contractor->getContractorPeriodEnd($contractor_id);
			$payment['Payment']['period_start'] = $period_start; 
			$payment['Payment']['period_end'] = $period_end;
			$payment['Payment']['paid_for'] = 1;
			$payment['Payment']['status'] = $response->response_code;
			$payment['Payment']['response_code'] = $response->response_code;
			$payment['Payment']['response_subcode'] = $response->response_subcode;
			$payment['Payment']['response_reason_text'] = $response->response_reason_text;
			$payment['Payment']['authorization_code'] = $response->authorization_code;
			$payment['Payment']['avs_response'] = $response->avs_response;
			$payment['Payment']['transaction_id'] = $response->transaction_id;
			$payment['Payment']['card_code_response'] = $response->card_code_response;
			$payment['Payment']['cavv_response'] = $response->cavv_response;
			$payment['Payment']['account_number'] = $response->account_number;
			$payment['Payment']['card_type'] = $response->card_type;
			$payment['Payment']['transaction_type'] = $response->transaction_type;
			$payment['Payment']['method'] = $response->method;
			$payment['Payment']['created_at'] = date('Y-m-d H:i:s');
			
			$this->loadModel('Payment');
			$this->Payment->create();
			$this->Payment->save($payment);
			
			if($response->response_code==1){ 
				
				$contractor['Contractor']['id'] = $contractor_id;
				$contractor['Contractor']['paid_sign_up_fee'] = 1;
				$contractor['Contractor']['start_date'] = $period_start;
				$contractor['Contractor']['end_date'] = $period_end;
				$contractor['Contractor']['status'] = 1;
				$contractor['Contractor']['updated_at'] = date('Y-m-d H:i:s');
				$this->Contractor->create();
				$this->Contractor->save($contractor);
				$contractor_detail = $this->Contractor->read(null,$contractor_id);
				$this->Member->update_contractor_session($contractor_detail);
				$this->Session->setFlash('Thanks for payment.');
				$this->redirect(array('controller'=>'contractors','action'=>'home'));
			}else{
				$this->Session->setFlash($response->response_reason_text,'default','','error');
				
			}
			

			
			
			
		}
		
		$contractor_id = $this->Member->getActiveContractorId();
		$critria = array();
		$critria['conditions'] = array('Contractor.id'=>$contractor_id);
		$contractor = $this->Contractor->find('first',$critria);
		$total_fee = 0;
		
		if(!$contractor['Contractor']['paid_sign_up_fee']){
			$total_fee += $contractor['Contractor']['sign_up_fee'];
			
		}
		$total_fee += $contractor['Contractor']['quarterly_fee'];
		$this->set('contractor',$contractor);
		$this->set('total_fee',$total_fee);
		
	}
	private function authorize_payment($login,$trans_id,$test_mode=true,$card_num,$card_code,$card_exp,$card_type,$price){

		

		App::import('Vendor', 'AuthorizeNet', array('file' => 'authorize_net' . DS . 'AuthorizeNet.php'));

		$sale = new AuthorizeNetAIM($login,$trans_id);

		$sale->setSandbox($test_mode);

		//echo "<pre>";print_r($billing_info);

			

			

			/* insert credit card information  ---start */

			$creditCard = array(

            'exp_date' => $card_exp,

            'card_num' => $card_num,

            'card_code' => $card_code,

            );

           // $creditCard['card_num']="4007000000027";

			$sale->setFields($creditCard);

            /* insert credit card information  ---end */

            

            

            /* insert tranction amount detail and email notification  ---start */

        

             $transaction = array(

				'amount' => $price,

				'duplicate_window' => '10',

				// 'email_customer' => 'true',

				'footer_email_receipt' => 'thank you for your business! National Insurance Bureau',

				'header_email_receipt' => 'a copy of your receipt is below',

			);

			$sale->setFields($transaction);

			//$sale->invoice_num = $order_ref;

             /* insert tranction amount detail and email notification  ---end */


             /*

             $customer = (object)array();

			$customer->first_name = $billing_info['Order']['b_fname'];

			$customer->last_name = $billing_info['Order']['b_lname'];

			$customer->company = $billing_info['Order']['compny_name'];

			$customer->address = $billing_info['Order']['b_address'];

			$customer->city = $billing_info['Order']['b_city'];

			$customer->state = $billing_info['Order']['b_state'];

			$customer->zip = $billing_info['Order']['b_zip_code'];

			$customer->country = $billing_info['Order']['b_country'];

			$customer->phone = $billing_info['Order']['b_phone_number'];

			$customer->fax = $billing_info['Order']['b_phone_number'];

			$customer->email = $billing_info['Order']['b_email'];

			$customer->cust_id = "";

			//$customer->customer_ip = "192.168.0.1";

            $sale->setFields($customer);

            

            $shipping_info = (object)array();

			$shipping_info->ship_to_first_name = $billing_info['Order']['s_fname'];

			$shipping_info->ship_to_last_name = $billing_info['Order']['s_lname'];

			$shipping_info->ship_to_company = $billing_info['Order']['s_company_name'];

			$shipping_info->ship_to_address = $billing_info['Order']['s_addres'];

			$shipping_info->ship_to_city = $billing_info['Order']['s_city'];

			$shipping_info->ship_to_state = $billing_info['Order']['s_state'];

			$shipping_info->ship_to_zip = $billing_info['Order']['s_zip_code'];

			$shipping_info->ship_to_country = $billing_info['Order']['s_country'];

			$sale->setFields($shipping_info);

            */

            

            

            

		  

		  /*

		  $return_data = array();

		  if ($response->approved) {

			  /*

			  echo "Sale successful!"; 

			  echo "<br /> Response COde ".$response->response_code;

			  echo "<br /> Response subCOde ".$response->response_subcode;

			  echo "<br /> Response Reason COde ".$response->response_reason_code;

			  echo "<br /> Response Reason TExt COde ".$response->response_reason_text;

			  echo "<br /> authorization_code =  ".$response->authorization_code;

			  echo "<br /> avs_response =  ".$response->avs_response;

			  echo "<br />transaction_id =  ".$response->transaction_id;

			  echo "<br /> method =  ".$response->method;

			  echo "<br /> transaction_type ".$response->transaction_type;

			  echo "<br /> balance_on_card =  ".$response->balance_on_card;

			  *

			  return $response;

			  

			} else {

				return $response->error_message;

			}



          */

		/*

		$sale->invoice_num = $order_ref;

		$sale->addLineItem('item1', 'Golf tees', 'Blue tees', '2', '5.00', 'N');

        $sale->addLineItem('item2', 'Golf shirt', 'XL', '1', '40.00', 'N');

		

        

        $transaction = array(

        'amount' => '5.00',

        'duplicate_window' => '10',

        // 'email_customer' => 'true',

        'footer_email_receipt' => 'thank you for your business! PencilCheap',

        'header_email_receipt' => 'a copy of your receipt is below',

        );

            

        $order = array(

            'description' => 'Johns Bday Gift',

            'invoice_num' => '3123',

            'line_item' => 'item1<|>golf balls<|><|>2<|>18.95<|>Y',

            );



        



        $shipping_info = (object)array();

        $shipping_info->ship_to_first_name = "Himanshu Shipping";

        $shipping_info->ship_to_last_name = "Mahara Shipping";

        $shipping_info->ship_to_company = "Saamarth Shipping";

        $shipping_info->ship_to_address = "B-99";

        $shipping_info->ship_to_city = "Noida Shipping";

        $shipping_info->ship_to_state = "Utter Pradesh";

        $shipping_info->ship_to_zip = "201301";

        $shipping_info->ship_to_country = "INDIA SHipping";

        //$shipping_info->tax = "CA";

        //$shipping_info->freight = "Freight<|>ground overnight<|>12.95";

        //$shipping_info->duty = "Duty1<|>export<|>15.00";

        //$shipping_info->tax_exempt = "false";

        //$shipping_info->po_num = "12";



       

        

        $sale->setFields($shipping_info);

        $sale->setFields($customer);

        $sale->setFields($order);

       // $sale->setFields($merchant);

        $sale->setFields($transaction);

        $response = $sale->authorizeAndCapture();

		

		

		

		$response = $sale->authorizeAndCapture();

		  if ($response->approved) {

			  echo "Sale successful!"; 

			  echo "<br /> Response COde ".$response->response_code;

			  echo "<br /> Response subCOde ".$response->response_subcode;

			  echo "<br /> Response Reason COde ".$response->response_reason_code;

			  echo "<br /> Response Reason TExt COde ".$response->response_reason_text;

			  echo "<br /> authorization_code =  ".$response->authorization_code;

			  echo "<br /> avs_response =  ".$response->avs_response;

			  echo "<br />transaction_id =  ".$response->transaction_id;

			  echo "<br /> method =  ".$response->method;

			  echo "<br /> transaction_type ".$response->transaction_type;

			  echo "<br /> balance_on_card =  ".$response->balance_on_card;

			  

			  

			  

			  } else {

			  echo $response->error_message;

		  }



		 

		*/

		$response = $sale->authorizeAndCapture();
		
		  return $response;

		 

		

	}
		
		
	private function __validateChangePassword(){
		//print_r($this->request->data);
		if($this->request->data['account']['password1']==''){
			$this->Session->setFlash('Please enter current password','default','','error');
			return false;
		}
		
		
		$id = $this->Member->getActiveContractorId();
		$password=$this->Contractor->getPasswordEnrypt($id);
		$pass=self::__generateEnryptPassword($this->request->data['account']['password1']);
		if($password!=$pass){
			$this->Session->setFlash('your current password is wrong','default','','error');
			return false;
		}
			
		if($this->request->data['account']['password']==''){
			$this->Session->setFlash('Please enter new password','default','','error');
			return false;
		}	
			
		if($this->request->data['account']['confirmPassword']==''){
			$this->Session->setFlash('Please enter confirm password','default','','error');
			return false;
		}
			
		if(($this->request->data['account']['password'])!=($this->request->data['account']['confirmPassword'])){
			$this->Session->setFlash('New Password and confirm password does not match','default','','error');
			return false;
		}
		return true;
	}
		
	private function __generateEnryptPassword($password=null){
		return Security::hash($password);
	}
		
	function change_homeowner_username($id=null){
		if(!empty($this->request->data) && self::__validateHomeownerUsername()){
			unset($this->request->data['HomeOwner']['password']);
			//$this->request->data['HomeOwner']['id']=$id;
			//$this->request->data['HomeOwner']['username']=$this->request->data['contractor']['username'];
			//$this->HomeOwner->create();
			$this->HomeOwner->save($this->request->data);
			$this->Session->setFlash('You have successfully update homweowner username');
			$this->redirect(array('action'=>'homeowner_account'));
		}
		else{
			$this->request->data['HomeOwner']['id']=$id;
		}
	}
	
	function change_homeowner_password($id=null){
		if(!empty($this->request->data) && self::__validateHomeownerpassword()){
			unset($this->request->data['HomeOwner']['password']);
			$new_pwd= self::__generateEnryptPassword($this->request->data['HomeOwner']['password1']);
			$this->request->data['HomeOwner']['password'] =$new_pwd;
			$this->HomeOwner->save($this->request->data);		
			$this->Session->setFlash('Password Updated Successfully');
			$this->redirect(array('action'=>'homeowner_account'));
		}
		else{
			$this->request->data['HomeOwner']['id']=$id;
		}
	}
		
	private function __validateHomeownerpassword(){
		if($this->request->data['HomeOwner']['password']==''){
			$this->Session->setFlash('Please enter password','default','','error');
			return false;
		}
		$password=$this->Session->read('Member.contractor.Contractor.password1');
		$pass=$this->request->data['HomeOwner']['password'];
		if($password!=$pass){
			$this->Session->setFlash('you have entered wrong password','default','','error');
			return false;
		}
		if($this->request->data['HomeOwner']['password1']==''){
			$this->Session->setFlash('Please enter new password','default','','error');
			return false;	
		}
		if($this->request->data['HomeOwner']['password2']==''){
			$this->Session->setFlash('Please enter concfirm password','default','','error');
			return false;	
		}
		if(($this->request->data['HomeOwner']['password1'])!=($this->request->data['HomeOwner']['password2'])){
			$this->Session->setFlash('New Password and confirm password does not match','default','','error');
			return false;
		}
		return true;
	}
	
	private function __validateHomeownerUsername(){
		if($this->request->data['HomeOwner']['username']==''){
			$this->Session->setFlash('Please enter name','default','','error');
			return false;
		}
		if($this->request->data['HomeOwner']['password']==''){
			$this->Session->setFlash('Please enter password','default','','error');
			return false;
		}
		$password=$this->Session->read('Member.contractor.Contractor.password1');
		$pass=$this->request->data['HomeOwner']['password'];
		if($password!=$pass){
			$this->Session->setFlash('you have entered wrong password','default','','error');
			return false;
		}
	return true;
	}
	
	function homeowner_account(){
		$id=$this->Session->read('Member.contractor.Contractor.id');
		$homeowners=$this->HomeOwner->find('first',array('conditions'=>array('HomeOwner.contractor_id'=>$id)));
		$this->set('homeowners',$homeowners);
	}
	
	private function __validateChangeUserName($username=NULL){
			$id = $this->Member->getActiveContractorId();
			
			$pass1= self::__generateEnryptPassword($this->request->data['account']['password1']);
			$pass=$this->Contractor->getPasswordEnrypt($id);
			if($pass1!=$pass){
				$this->request->data = array();
				$this->Session->setFlash('You have entered wrong password','default','','error');
				return false;
			}
			
			$username=$this->request->data['account']['username'];
			$count=$this->Contractor->find('count',array('conditions'=>array('NOT'=>array('Contractor.id'=>$id) , 'Contractor.username' =>$username)));
			if($count > 0){
				$this->request->data = array();
				$this->Session->setFlash('User Name already exist');
				return false;
			}
			
			
		
			return true;
		}
	
	function change_username(){
		
		if(!empty($this->request->data) && self::__validateChangeUserName()){
			$id = $this->Member->getActiveContractorId();
			$this->request->data['Contractor']['id'] =$id;
			$this->request->data['Contractor']['username']=$this->request->data['account']['username'];
			unset($this->request->data['account']);
			$this->Contractor->create();
			$this->Contractor->save($this->request->data);
			
			$contractor_detail = $this->Contractor->read(null,$id);
			$this->Member->update_contractor_session($contractor_detail);
			
			$this->Session->setFlash('User Name Updated Successfully');
			$this->redirect(array('action'=>'change_username'));
		}
		
	}
		
	function account_status(){
		$id = $this->Member->getActiveContractorId();
		$account_info=$this->Contractor->find('first',array('conditions'=>array('Contractor.id'=>$id)));
		$this->loadModel('Payment');
		$critria = array();
		$critria['fields'] = array('Payment.date','Payment.amount');
		$critria['conditions'] = array(
								'Payment.contractor_id' => $id,
								'Payment.paid_for' => 1,
								'Payment.status' => 1,
								);
		$critria['order']  = array('Payment.id'=>'DESC');
		$this->set('payments',$this->Payment->find('all',$critria));
		$this->set('account_info',$account_info);
		
		
		
	}
		
	private function __checkUserName($username=NULL){
		 $id = $this->Member->getActiveContractorId();
		
		//$this->login_criteria['conditions']['Contractor.status'] = 1;
		return $this->Contractor->find('count',array('conditions'=>array('NOT'=>array('Contractor.id'=>$id) , 'Contractor.username' =>$username)));
		
	}
}
?>
