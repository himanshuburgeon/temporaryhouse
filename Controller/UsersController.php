<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
   var $helpers = array('Html', 'Form');
   var $components = array('Auth','Email');
   var $uses = array('User');   
   
   function login()
   {
	  $this->layout = '';
      if($this->Auth->login())
      {
	 //return $this->redirect($this->Auth->redirect());
	 return $this->redirect('/admin/users/welcome');     
      } else {
		  if(!empty($this->data)){
			 
			  $this->Session->setFlash('Login failed. Invalid username or password.','default','','auth');
		  }
	  }		
   }
   
   function admin_login(){
    
      $this->redirect('/users/login');
   }	
   function logout() {
      $this->redirect($this->Auth->logout());
   }
   
   function admin_welcome() 
   {
      /*$this->loadModel('Contractor');
      $contractors=$this->Contractor->find('all',array('limit'=>5,'order'=>array('Contractor.created_at'=>'desc')));
      $this->set('contractors',$contractors);*/
      
      
      
      $this->loadModel('Page');
      $pages=$this->Page->find('all',array('limit'=>5,'order'=>array('Page.id'=>'desc')));
      $this->set('pages',$pages);
      
      
      $this->loadModel('Message');
      $messages=$this->Message->find('all',array('limit'=>5,'order'=>array('Message.id'=>'desc')));
      $this->set('messages',$messages);
      
      /*$this->loadModel('Product');
      $products=$this->Product->find('all',array('limit'=>5,'order'=>array('Product.created_at'=>'desc')));
      $this->set('products',$products);*/
      
      
      //echo"<pre>";print_r($messages);die;
      $this->layout='admin';      
   }
   function add(){
      
   }
   
   function admin_index($keyword=null) {
   //  $this->paginate['limit']=Configure::read('ADMIN_SIDE_PAGGING');
		$search_keyword=array();
		$condition=null;
		if($keyword!=null){
			$this->data['User']['keyword']=$keyword;
		}
		$condition['User.usertype <>'] = 'A';		
		if (!empty($this->data) and $this->data['User']['keyword']!='Name,Username or Email') {			
			$condition['OR']['User.username like']= '%'.$this->data['User']['keyword'].'%';
			$condition['OR']['User.emailId like']= '%'.$this->data['User']['keyword'].'%';
			$condition['OR']['User.firstName like']= '%'.$this->data['User']['keyword'].'%';
			$search_keyword=array('url'=>array($this->data['User']['keyword']));
			}
		$this->User->recursive = 0;
		$this->set('search_keyword',$search_keyword);
		$users=$this->paginate("User",$condition);		
		$this->set('users', $users);
		$this->set('manager', "User");
		$this->set('COUNTRY',Configure::read('COUNTRY'));
   }
   
   function admin_add(){
	   self::__manageuser();
   }
   function admin_edit($id=null){
	   self::__manageuser($id);
   }
   private function __manageuser($id=null){
	  if(!empty($this->request->data) && self::__validate()){
		  if($this->request->data['User']['id']==''){
			   $data = $this->User->find('first',array('fields'=>'MAX(User.id) as id'));
			   $user_max_id = $data[0]['id'] + 1;
			   $this->request->data['User']['password2']=$this->request->data['User']['username'].rand().$user_max_id;
			   $this->request->data['User']['password']=Security::hash(Configure::read('Security.salt').$this->request->data['User']['password2']);
			   $this->request->data['User']['usertype'] = 'S';
			   $this->request->data['User']['status'] = 1;
			   
			   $modules = array();
					if ($handle = opendir(realpath(dirname(__FILE__)))) {
						while (false !== ($entry = readdir($handle))) {
							if ($entry != "." && $entry != ".." && $entry!="AppController.php" && $entry!="UsersController.php" && $entry !="Component") {
								$modules[trim($entry,".php")] = "0";
							}
						}
						closedir($handle);
					}
			   
			   
			   
			   $this->request->data['User']['permissions'] = json_encode($modules);
			   
		 }
		 $this->User->create();
		 if($this->User->save($this->request->data)){
		 
		 }
		 
		 
		 $user_id = $this->User->id;
		 if($this->request->data['User']['id']==''){
			 $this->Session->setFlash('Sub Admin has been added successfully');
			 $this->redirect(array('controller'=>'users','action'=>'permission',$user_id));
		 }else{
			 $this->Session->setFlash('Sub Admin has been updated successfully');
			  $this->redirect(array('controller'=>'users','action'=>'index'));
		 }
		  
		  
		
		
		
		}
		
		if(empty($this->request->data) && $id!=null){
			$this->request->data = $this->User->read(NULL,$id);
		}
	   
   }
   
   private function __validate(){
	   
	   if($this->request->data['User']['firstName']==''){
		    $this->Session->setFlash('Please enter first name','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['lastName']==''){
		    $this->Session->setFlash('Please enter last name','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['emailId']==''){
		    $this->Session->setFlash('Please enter email address','default','','error');
		    return false;
		   
	   }
	   if(!filter_var($this->request->data['User']['emailId'], FILTER_VALIDATE_EMAIL)) {
			$this->Session->setFlash('Please enter valid email address','default','','error');
		   return false;
		}
		
		$total_record = $this->User->find('count',array('conditions'=>array('User.emailId'=>$this->request->data['User']['emailId'])));
		if($total_record > 0 && $this->request->data['User']['id']==''){
			$this->Session->setFlash('This email already exist in our database','default','','error');
		   return false;
			
		}
		
		
	   if($this->request->data['User']['username']==''){
		    $this->Session->setFlash('Please enter username','default','','error');
		    return false;
		   
	   }
	   	$total_record = $this->User->find('count',array('conditions'=>array('User.username'=>$this->request->data['User']['username'])));
	   	if($total_record > 0 && $this->request->data['User']['id']=='' ){
			$this->Session->setFlash('This username already exist in our database','default','','error');
		   return false;
			
		}
	   if($this->request->data['User']['phone']==''){
		    $this->Session->setFlash('Please enter phone number','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['city']==''){
		    $this->Session->setFlash('Please enter city','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['state']==''){
		    $this->Session->setFlash('Please enter state','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['zip']==''){
		    $this->Session->setFlash('Please enter zip','default','','error');
		    return false;
		   
	   }
	   if($this->request->data['User']['country']==''){
		    $this->Session->setFlash('Please enter country','default','','error');
		    return false;
		   
	   }
	   return true;
   }
   
	function admin_changepassword(){
      if(!empty($this->request->data) && self::__change_password())
      {
				  
			 $user=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id'))));	 
			 $encryptedPassword=Security::hash(Configure::read('Security.salt').$this->request->data['User']['oldpassword']);
			 
			 if($user['User']['password']==$encryptedPassword)
			 {
				$data=$this->request->data;
				$data['User']['id'] = $user['User']['id'];
				$data['User']['password'] = Security::hash(Configure::read('Security.salt').$data['User']['password']);
				
				$this->User->create();
				if($this->User->save($data))
				{	      
				   $this->Session->setFlash('Your password changed successfully.');
				   $this->redirect(array('action'=>'changepassword'));
				}	    
			 }
			 else
			 {
				$this->request->data['User']['password']='';
				$this->request->data['User']['password2']='';
				$this->request->data['User']['oldpassword']='';
				$this->Session->setFlash('Your current password didn\'t match.','default','','error');
			 }
      }
   }   
   
 private function __change_password()
   {      
      if($this->request->data['User']['password']!=$this->request->data['User']['password2'])
      {
	 $this->Session->setFlash('Your new password and confirm password do not match.','default','','error');
	 $this->request->data['User']['password']='';
	 $this->request->data['User']['password2']='';
	 $this->request->data['User']['oldpassword']='';
	 return false;
      }
      return true;
   }
   	function admin_permission($id=null)
	{ 
		$modules = array();
		if ($handle = opendir(realpath(dirname(__FILE__)))) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && $entry!="AppController.php" && $entry!="UsersController.php" && $entry!="AdminController.php" && $entry!="SitesController.php" && $entry !="Component") {
					$modules[] = array('file'=>trim($entry,".php"),'name'=>str_replace('Controller.php',' Manager',$entry));
				}
			}
			closedir($handle);
		}
	
		
		if(!empty($this->data))
		{
			
			$user['User']['id'] = $this->data['User']['user_id'];
			
			if(isset($this->data['content'])){
				$user['User']['permissions'] = json_encode($this->data['content']);
			}else{
				$user['User']['permissions'] = json_encode(array());
			}
			
			
				$this->User->create();
				if($this->User->save($user))
				{
					
					$this->Session->setFlash('Permission has been saved successfully');
					$this->redirect(array('action'=>'permission',$this->data['User']['user_id']));
				}
		}
		
		$user = $this->User->read(null,$id);
		$this->request->data['content'] = json_decode($user['User']['permissions'],true);
		$this->set('user_id',$id);
		$this->set('user_name',$user['User']['firstName'].' '.$user['User']['lastName']);
		$this->set('modules',$modules);
	}
   
   function forgotpassword()
   {
      $this->layout='';
      if(!empty($this->request->data))
      {
	 $user = $this->User->find('first',array('conditions'=>array('User.emailId'=>$this->request->data['User']['email'])));
	 if(!empty($user))
	 {
	    if(in_array($user['User']['usertype'],array('A','S')))
	    {
	       $this->__mail_send('1',$user);	       
	       
	       $this->Session->setFlash('A message containing your password has been sent to your email address. Please check your email accout to retreive your password. Thank you for your patience.');
	       $this->redirect(array('controller'=>'users','action'=>'forgotpassword'));
	    }
	    else
	    {	       
	       $this->Session->setFlash('Sorry !!!, You are not authorised to access that location','default','','error');
	    }
	 }
	 else
	 {	   
	    $this->Session->setFlash('Sorry! We cannot complete your request, the email address you entered is not registered with us. Please try again using a different email address. We are sorry for the inconvenience.','default','','error');
	 }
      }
   }
   
   private function __mail_send($mail_id=null,$user=null)
   {
      $this->loadModel('Mail');
      $mail=$this->Mail->read(null,$mail_id);
      $body=str_replace('{NAME}',$user['User']['firstName'],$mail['Mail']['body']);
      $body=str_replace('{LASTNAME}',$user['User']['lastName'],$body);
      $body=str_replace('{PASSWORD}',$user['User']['password2'],$body);
      $body=str_replace('{USER}',$user['User']['username'],$body);      
      
      $email = new CakeEmail();
      
      $email->to($user['User']['emailId']);
      $email->subject($mail['Mail']['subject']);
      $email->from($user['User']['emailId']);
      $email->emailFormat('html');
      $email->template('send_mail');
      $email->viewVars(array('data'=>$body));
      $email->send();     
      
   }
   
}
?>
