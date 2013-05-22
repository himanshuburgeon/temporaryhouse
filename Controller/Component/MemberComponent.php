<?php
App::uses('Component', 'Controller');
class MemberComponent extends Component{
	public $member = array();
	private $controller,$Message;
	public $membertype='';
	public $contractor_deny = array('home','view','logout','change_password','homeowner_account','change_username','change_password','homeowner_user_list','change_homeowner_username','change_homeowner_password','order_review','order_products','checkout1','order_history');
	public $contractor_payment_pages = array('pay_dues','logout','sign_up','forgot_password');
	public $homeowner_deny = array('home','view');
	public $homeowner_user_pages = array('userform','logout');
	public $params = array() , $redirect = array();
	
	
	
	/*
	public function initialize(){
		echo "init";
		
	}
	*/
	public function startup($controller){
		$this->controller = $controller;
		$this->Message = ClassRegistry::init('Message');
		self::_setvar();
		self::_loadmember();
		//self::_checkmemberexist();
		self::_auth_pages();
		
		
	}
	public function getActiveContractorId(){
		return $this->controller->Session->read('Member.contractor.Contractor.id');
	}
	
	private function _auth_pages(){
		if($this->params['controller']=="contractors" || $this->params['controller']=="accounts"){
			
			if(in_array($this->params['action'],$this->contractor_deny) && $this->membertype!="contractor"){
				$message = $this->Message->read(null,8);
				$this->controller->Session->setFlash($message['Message']['msg'],'default','','error');
				
				$this->controller->redirect(array('controller'=>'pages','action'=>'home'));
			}else{
				
				
				if(in_array($this->params['action'],$this->contractor_payment_pages) && $this->membertype!="contractor" && $this->params['action']!='sign_up' && $this->params['action']!='forgot_password'){
					$message = $this->Message->read(null,8);
					$this->controller->Session->setFlash($message['Message']['msg'],'default','','error');
					$this->controller->redirect(array('controller'=>'pages','action'=>'home'));
				}
				
				$contractor_detail = $this->member;
				
				if(strtotime(date("Y-m-d H:i:s")) > strtotime($contractor_detail['Contractor']['end_date'])){
					if(!in_array($this->params['action'],$this->contractor_payment_pages)){
						$message = $this->Message->read(null,9);
						$this->controller->Session->setFlash($message['Message']['msg'],'default','','error');
						$this->controller->redirect(array('controller'=>'accounts','action'=>'pay_dues'));
					}
				}
				
				
			}
		}
		
		if($this->params['controller']=="homeowners"){
			if(in_array($this->params['action'],$this->homeowner_deny) && $this->membertype!="homeowner"){
				$this->controller->redirect(array('controller'=>'pages','action'=>'home'));
			}else{
				$homeowner = $this->controller->Session->read('Member.homeowner');
				if(!isset($homeowner['Homeowner']['form_fill']) || (isset($homeowner['Homeowner']['form_fill']) && $homeowner['Homeowner']['form_fill']==0 ) ){
					if(!in_array($this->params['action'],$this->homeowner_user_pages)){
						
						$message = $this->Message->read(null,10);
						$this->controller->Session->setFlash($message['Message']['msg'],'default','','error');
						$this->controller->redirect(array('controller'=>'homeowners','action'=>'userform'));
					}
				}
				
			}
		}
	}
	
	private function _loadmember(){
		$this->member = $this->controller->Session->read('Member.contractor');
		
		if(empty($this->member)){
			$this->member = $this->controller->Session->read('Member.homeowner');
			if(!empty($this->member)){
				$this->membertype="homeowner";
			}
		}else{
			$this->membertype="contractor";
		}
	}
	
	private function  _setvar(){
		$this->params = $this->controller->request->params;
		$this->redirect = array('controller'=>$this->params['controller'],'action'=>$this->params['action'],'pass'=>$this->params['pass']);
	}
	
	
	public function login($data){
		
		if(isset($data['Contractor']) && $data['Contractor']['type']=="contractor"){
			$return_data = self::_contractor_login($data);
			
			if($return_data['success']==1){
				$this->controller->redirect(array('controller'=>'contractors','action'=>'home'));
			}else{
				$this->controller->Session->setFlash($return_data['error_msg'],'default','','error');
			}
		}
		if(isset($data['HomeOwners']) && $data['HomeOwners']['type']=="homeowner"){
			
			$return_data = self::_homeowner_login($data);
			if($return_data['success']==1){
				$this->controller->redirect(array('controller'=>'homeowners','action'=>'home'));
			}else{
				$this->controller->Session->setFlash($return_data['error_msg'],'default','','error');
			}
		}
	}
	
	private function _contractor_login($data){
		$this->Contractor = ClassRegistry::init('Contractor');
		
		if($this->Contractor->countContractor($data)){
			$contractor_detail = $this->Contractor->auth_contractor_login();
			
			$this->update_contractor_session($contractor_detail);
			
			return array('success'=>1,'contractor'=>$contractor_detail,'error'=>0,'error_msg'=>'');
		}else{
			//constractor detail does not exist
			return array('success'=>0,'contractor'=>array(),'error'=>1,'error_msg'=>'Contractor detail doesn\'t exits');
		}
		
		
	}
	
	private function _homeowner_login($data){
		$this->HomeOwner = ClassRegistry::init('HomeOwner');
		if($this->HomeOwner->countHomeOwner($data)){
			$homeowners_detail = $this->HomeOwner->auth_homeowner_login();
			if(!empty($homeowners_detail)){
				$this->controller->Session->delete('Member.contractor');
				$this->controller->Session->write('Member.homeowner',$homeowners_detail);
				
				return array('success'=>1,'contractor'=>$homeowners_detail,'error'=>0,'error_msg'=>'');
			}else{
				
				$message = $this->Message->read(null,7);
				return array('success'=>0,'contractor'=>$homeowners_detail,'error'=>1,'error_msg'=>$message['Message']['msg']);
			}
			
			
		}else{
			$message = $this->Message->read(null,6);
			//constractor detail does not exist
			return array('success'=>0,'contractor'=>array(),'error'=>1,'error_msg'=>$message['Message']['msg']);
		}
		
	}
	
	
	public function memberLogin(array $memberDetail){
		$user=$memberDetail['username'];
		$pass=$memberDetail['password'];
		$tbl=ClassRegistry::init('User');
		$u=$tbl->find('count',array('fields' => 'DISTINCT User.id','conditions'=>array('User.username'=>$user,'User.password2'=>$pass)));
		
		if($u==1){
			$usr=$tbl->find('all',array('conditions'=>array('User.username'=>$user,'User.password2'=>$pass)));
		}
		echo "<pre>";print_r($usr);die;
	}
	public function get_contractor_id(){
		$contractor = $this->controller->Session->read('Member.contractor');
		
		return $contractor['Contractor']['id'];
	}
	
	public function update_contractor_session($contractor_detail = array()){
		$this->controller->Session->delete('Member.homeowner');
		$this->controller->Session->write('Member.contractor',$contractor_detail);
	
	}
	public function getActiveContractorEmail(){
		$contractor = $this->controller->Session->read('Member.contractor');
		
		return $contractor['Contractor']['email'];
		
	}
}
?>
