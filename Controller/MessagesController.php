<?php
class MessagesController extends AppController
{
	
	var $name = 'Messages';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	var $uses = array('Message');
	var $paginate = array();
    
  
    
    function admin_index($search=NULL,$limit = 20) {
		
		/* pagination start */
		$this->paginate = array();
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions'] = array('Message.name like'=>$search.'%');
		}else{
			$search = '';
		}
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
		}
		$this->paginate['order'] = array('Message.reorder'=>'ASC');
		$messages = $this->paginate('Message');
		/* pagination end */
		
		/* breadcrumbs start */
		$breadcrumbs  =  array();
		$breadcrumbs[] = array(
							'title'=>'Back to Homepage',
							'link'=>$this->Session->read('Site.siteurl').'/admin',
							'name'=>''
							);
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Message Manager'
							);
		/* breadcrumbs end */
		
		$this->set('messages', $messages );
		$this->set('breadcrumbs',$breadcrumbs);
		$this->set('search', $search);
		$this->set('limit', $limit);
	}
	
	function admin_add(){
		
		$this->add();
	}
	
	
	function admin_view($id=null){
		$this->layout = '';
		
		$message = $this->Message->read(null,$id);
		$this->set('message',$message);
	}
	
	
	function add($id=null){
		$this->layout="admin";
		if (!empty($this->request->data) && self::__validate())
		{
			echo "<pre>"; print_r($this->request->data);die;
			foreach($this->request->data['Message']['msg'] as $k=>$v){
				//echo "<pre>"; print_r($this->data['Message']['msg']);die;
				$data = array();
				$data['Message']['id']=$this->request->data['Message']['id'];
				$data['Message']['name']=$this->request->data['Message']['name'];
				$data['Message']['leg_code']=$k;
				$data['Message']['msg']=$v;
			
			//echo "<pre>"; print_r($data);
			      $this->Message->create();
			      $this->Message->save($data);
		     }
		      //die;
			//echo "<pre>"; print_r($this->data);
			if($this->data['Message']['id']){
				$this->Session->setFlash('Message has been updated successfully');
			}else{
				$this->Session->setFlash('Message has been added successfully');
			}
			
		
			//$this->Session->setFlash('Message','default','','error');
			$this->redirect(array('action'=>'admin_index'));
			
			
		}
		
		if ($id) {
			if (empty($this->data)) {
				$this->request->data = $this->Message->read(null, $id);
			}
			
		}
		
		/* breadcrumbs start */
		$breadcrumbs  =  array();
		$breadcrumbs[] = array(
							'title'=>'Back to Homepage',
							'link'=>$this->Session->read('Site.siteurl').'/admin',
							'name'=>''
							);
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>$this->Session->read('Site.siteurl').'/admin/messages',
							'name'=>'Message Manager'
							);
		if($id){
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Update Message'
							);
		}else{
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Add Message'
							);
		}
		/* breadcrumbs end */
		
		$this->set('breadcrumbs',$breadcrumbs);
		
		
	}
	
	
	
	function admin_edit($id=id){
	   $this->add($id);
	   
	  }
	  
	 
	function admin_delete($id=null){
		 
		 $data=$this->data['Message'];
		 array_splice($data,0,1); 
		 array_splice($data,0,1);
		 $ans="0";
		 foreach($data as $value)
		 {
			 if($value!='0')
			 {
				 if($this->data['Message']['action']=='Publish')
				{
					$message=$this->Message->read(null,$value);
					$message['Message']['status']=1;
					$this->Message->create();
					$this->Message->save($message);
				}
				if($this->data['Message']['action']=='Unpublish')
				{
					$message=$this->Message->read(null,$value);
					$message['Message']['status']=0;
					$this->Message->create();
					$this->Message->save($message);
				}
				if($this->data['Message']['action']=='Delete')
				{
					$this->Message->delete($value);
					$this->Session->setFlash('Message has been delelted');
				}
				$ans="1";
				}
		  }
		 
        
      $this->redirect(array('action'=>'index',$id));	
  
  }
  
  function home(){
	  $this->autoRender = false;
  }
  
  private function __validate(){
		if($this->data['Message']['name']==''){
			$this->Session->setFlash('Please Enter  Name','default','','error');
			return false;
		}
		if($this->data['Message']['msg']==''){
			$this->Session->setFlash('Please Enter Message Title','default','','error');
			return false;
		}
		//if($this->data['Message']['date']==''){
			//$this->Session->setFlash('Please Enter Meta Keyword ','default','','error');
			//return false;
		//}
		
		return true;
	}
  
  
  
   
}
?>
