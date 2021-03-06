<?php
class HomeownersController extends AppController
{
	var $name = 'Homeowners';
	var $helpers = array('Fck');
	var $components = array();
	var $uses = array('HomeOwner','Contractor','HomeOwnerUser','Page');
	var $paginate = array();
	var $contractor_id = null;
	
   	function admin_index($pid=NULL,$search=NULL,$search1=NULL,$limit = 20) {
		
		/* pagination start*/
		$search=urldecode($search);
		$search1=urldecode($search1);
		
		$this->loadModel('HomeOwnerUser');
		$this->paginate = array();
		$this->paginate['fields'] = array('HomeOwnerUser.id','Contractor.name','Contractor.id','HomeOwnerUser.name','HomeOwnerUser.email','HomeOwnerUser.status','HomeOwnerUser.phone','HomeOwnerUser.created_at');
		$this->paginate['joins'] = array(
			array('table' => 'contractors',
				'alias' => 'Contractor',
				'type' => 'INNER',
				'conditions' => array(
				'HomeOwnerUser.contractor_id = Contractor.id',
				)
			)
		);
		if($pid!=NULL && $pid!="_blank"){
		$this->paginate['conditions'][] = array('HomeOwnerUser.contractor_id ='=>$pid);
		$this->request->data['Contractor']['pid']=urldecode($pid);
		}else{
			$pid = '';
			$this->request->data['pid']='';
		}
		if($search1!=NULL && $search1!="_blank"){
		$this->paginate['conditions'][] = array('Contractor.name like'=>$search1.'%');
		$this->request->data['contractorSearch']=urldecode($search1);
		}else{
			$search1 = '';
			$this->request->data['contractorSearch']='';
		}
		
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions'][] = array('HomeOwnerUser.name like'=>$search.'%');
			
			$this->request->data['search']=urldecode($search);
		}else{
			$search = '';
			$this->request->data['search']='';
		}
		
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
		}
		$this->paginate['group'] = array('HomeOwnerUser.id ');
		//$this->paginate['order'] = array('Contractor.reorder'=>'ASC');
		//$this->Contractor->recursive = 2;
		
		
		$homeowners = $this->paginate('HomeOwnerUser');
		/* pagination end*/
		
		//'<pre>';print_r($homeowners);die;
		//$this->autoRender =false;
		
		/*breadcrumbs start*/
		$breadcrumbs  =  array();
		$breadcrumbs[] = array(
							'title'=>'Back to Homepage',
							'link'=>HTTP_PATH.'/admin',
							'name'=>''
							);
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Home Owner User Manager'
							);
		/*breadcrumbs end*/
		
		
		$this->set('homeowners',$homeowners);
		$this->set('breadcrumbs',$breadcrumbs);
		//$this->set('search', $search);
		$this->set('limit', $limit);
		
	}
	
	function admin_add() {
		self::__add();
	}
	
	public function home(){
		
	}
	function request_login($data){
		return self::__login($data);
	}
	
	private function __login($data){
		if($this->HomeOwner->countHomeOwner($data)){
			$homeowners_detail = $this->HomeOwner->auth_homeowner_login();
			$this->Session->delete('Member.homeowner');
			$this->Session->write('Member.homeowner',$homeowners_detail);
			return array('success'=>1,'contractor'=>$homeowners_detail,'error'=>0,'error_msg'=>'');
		}else{
			//constractor detail does not exist
			return array('success'=>0,'contractor'=>array(),'error'=>1,'error_msg'=>'Home Owner detail doesn\'t exits');
		}
		
	}
	
	private function __validate(){
		
		if($this->request->data['HomeOwnerUser']['name']==''){
			$this->Session->setFlash('Please Enter Contractor Name','default','','error');
			return false;
		}
	
		if($this->request->data['HomeOwnerUser']['email']=='' ){
		$this->Session->setFlash('Please Enter Contractor Email','default','','error');
			return false;
		}
		if(!filter_var($this->request->data['HomeOwnerUser']['email'], FILTER_VALIDATE_EMAIL)) {
			$this->Session->setFlash('Please enter valid email address','default','','error');
		   return false;
		}
		
	return true;
    }
	private function __add($id=null){
		
		//mail('himanshu.saamarth@gmail.com','this is test','this is ffff');
		$read=$this->Session->read('Member.homeowner');
		//$contractor_id=$this->Session->read('Member.homeowner.HomeOwner.contractor_id');
		//echo $contractor_id;
		//die;
						
			if(!$this->request->data['HomeOwnerUser']['id']){
				
				
				$this->request->data['HomeOwnerUser']['contractor_id']=$this->Session->read('Member.homeowner.HomeOwner.contractor_id');
				$this->request->data['HomeOwnerUser']['created_at'] = date('Y-m-d H:i:s');
				
				
			}else{
				
				$this->request->data['HomeOwnerUser']['updated_at'] = date('Y-m-d H:i:s');
				
			}
			
			$this->HomeOwnerUser->create();
			$this->HomeOwnerUser->save($this->request->data);
			
			
			$homeowner = $this->Session->read('Member.homeowner');
			$homeowner['Homeowner']['form_fill'] = 1;
			$this->Session->write('Member.homeowner',$homeowner);
				$this->loadModel('Message');
				$msg  = $this->Message->read(null,4);
				$message = $msg['Message']['msg'];
				$this->Session->setFlash($message);
				$this->redirect(array('action'=>'userform'));
		}
	
	private function __generatehomeowner($data=null){
		$password = rand();
		$username = self::__generateHomeownerUsername($data['Contractor']['name']);
		
		
		
		$this->HomeOwner->create();
		$this->HomeOwner->set(array(
			'contractor_id' => $this->contractor_id,
			'username' => self::__generateHomeownerUsername($username),
			'password1'=>$password,
			'password'=>self::__generateEnryptPassword($password)
		));
		
		$this->HomeOwner->save();
		
		return array('username'=>$username,'password'=>$password);
		
	}
	
	private function __generateHomeownerUsername($name=null){
		//$this->loadModel('HomeOwner');
		return str_replace(' ', '', strtolower($name.'_ho'));
		//echo $name;
	}
	

	private function  __successreqister_mail($mail_id=null,$data = null){
		$this->loadModel('Mail');
		$mail=$this->Mail->read(null,$mail_id);
		$body=str_replace('{NAME}',$data['Contractor']['name'],$mail['Mail']['body']);
		$body=str_replace('{USER}',$data['Contractor']['username'],$body);
		$body=str_replace('{PASSWORD}',$data['Contractor']['password1'],$body);
		$body=str_replace('{EMAIL}',$data['Contractor']['email'],$body);
		$body=str_replace('{TELEPHONE}',$data['Contractor']['home_phone_no'],$body);
		$body=str_replace('{ADDRESS}',$data['Contractor']['home_address'],$body);
		$body=str_replace('{CITY}',$data['Contractor']['home_city'],$body);
		$body=str_replace('{DATE_OF_BIRTH}',$data['Contractor']['dob'],$body);
		$body=str_replace('{STATE}',$data['Contractor']['home_state'],$body);
		$body=str_replace('{ZIP}',$data['Contractor']['home_zip'],$body);
		$body=str_replace('{SIGN_UP_FEE}',$data['Contractor']['sign_up_fee'],$body);
		$body=str_replace('{QUARTERLY_FEE}',$data['Contractor']['quarterly_fee'],$body);
		$body=str_replace('{HOME_USERNAME}',$data['Homeowner']['username'],$body);
		$body=str_replace('{HOME_PASSWORD}',$data['Homeowner']['password'],$body);
		//$body = 'this is test';
		
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();
		$email->from($this->SiteDetail['adminemail']);
		$email->to($this->request->data['Contractor']['email']);
		$email->subject($mail['Mail']['subject']);
		$email->emailFormat('html');
		$email->template('send_mail');
		$email->viewVars(array('data'=>$body));
		$email->send();
       
	}
	 function view($id=null){
	$homeOwnerUser=$this->Page->read(null,$id);
	 $this->set('homeOwnerUserView',$homeOwnerUser); 
	
}
	private function __generateUsername($name=null){
		$last_id = $this->Contractor->getLastId()+1;
		return str_replace(' ', '', strtolower($name.$last_id));
	}
	
	private function __generateEnryptPassword($password=null){
		return Security::hash($password);
	}
	function logout(){
		$this->Session->delete('Member.homeowner');
		$this->redirect(array('controller'=>'pages','action'=>'home'));
	}
	

	function admin_edit($id=null){
		self::__add($id);
	}
	function admin_view($id=null){
		
		$homeOwner= array();
	
		
		$this->layout = '';
		
		$homeOwner = $this->HomeOwnerUser->read(null,$id);
			
		$this->set('homeOwner',$homeOwner);
	}	
	
	function admin_delete($parent_id=null){
		$data=$this->data['Contractor'];
		array_splice($data,0,1);
	        array_splice($data,0,1);
		$ans="0";
		foreach($data as $value)
		{
			if($value!='0')
			{
				if($this->data['Contractor']['action']=='Approved')
				{
					$contractor=$this->Contractor->read(null,$value);
					$contractor['Contractor']['status']=1;
					$this->Contractor->create();
					$this->Contractor->save($contractor);
					$this->Session->setFlash('Contractor(s) has been Approved successfully');
				}
				if($this->data['Contractor']['action']=='Declined')
				{
					$contractor=$this->Contractor->read(null,$value);
					$contractor['Contractor']['status']=0;
					$this->Contractor->create();
					$this->Contractor->save($contractor);
					$this->Session->setFlash('Contractor(s) has been Declined successfully');
				}
				if($this->data['Contractor']['action']=='Delete')
				{
					$contractor = $this->Contractor->read(null,$value);
					//print_r($contractor);die;
					//$this->Contractor->delete($value);
					//$this->Homeowner->deleteAll(array('Homeowner.contractor_id' => $value), false);
					$this->Session->setFlash('Contractor has been deleted successfully');
				}
				$ans="1";
			}
		}
		
		$this->redirect(array('action'=>'index',$parent_id));		
	}
	
	function userform(){
		if(!empty($this->request->data) && self::__validate()){
		self::__add();	
			
		
		}
	}
}
?>
