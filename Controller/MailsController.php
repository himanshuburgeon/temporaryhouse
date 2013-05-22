<?php
class MailsController extends AppController
{
	var $name = 'Mails';
	var $helpers = array('Fck');
	var $components = array();
	var $uses = array('Mail');
	var $paginate = array();
	
    
    
   	function admin_index($search=NULL,$limit = 20) {
		
		/* pagination start*/
		$this->paginate = array();
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions'] = array('Mail.title like'=>$search.'%');
		}else{
			$search = '';
		}
		
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
		}
		
		$this->paginate['order'] = array('Mail.reorder'=>'ASC');
		$mails = $this->paginate('Mail');
		/* pagination end*/
		
		
		/*breadcrumbs start*/
		$breadcrumbs  =  array();
		$breadcrumbs[] = array(
							'title'=>'Back to Homepage',
							'link'=>$this->Session->read('Site.siteurl').'/admin',
							'name'=>''
							);
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Mail Format Manager'
							);
		/*breadcrumbs end*/
		
		
		$this->set('mails',$mails);
		$this->set('breadcrumbs',$breadcrumbs);
		$this->set('search', $search);
		$this->set('limit', $limit);
	}
	
	function admin_add() {
		$this->add();
	}
	function add($id=null){
		$this->layout="admin";
		if (!empty($this->data))
		{
			if($this->data['Mail']['id']){
				$this->Session->setFlash('Mail has been updated successfully');
			}else{
				$this->Session->setFlash('Mail has been added successfully');
			}
			$this->Mail->create();
			$this->Mail->save($this->data);
			//$this->Session->setFlash('contact','default','','error');
			$this->redirect(array('action'=>'admin_index'));
			
			
		}
		if ($id) {
			if (empty($this->request->data)) {
				$this->data = $this->Mail->read(null,$id);
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
							'link'=>$this->Session->read('Site.siteurl').'/admin/mails',
							'name'=>'Mail Format Manager'
							);
		if($id){
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Update Mail Format'
							);
		}else{
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Add Mail Format'
							);
		}
		/* breadcrumbs end */
		$this->set('breadcrumbs',$breadcrumbs);
		
	}

	function admin_edit($id=null)
	{
		$this->add($id);
	}
	function admin_view($id=null){
		$this->layout = '';
		
		$mail = $this->Mail->read(null,$id);
		$this->set('mail',$mail);
	}
	
	
	
	
	function admin_delete()
	{
		$data=$this->data['Mail'];
		array_splice($data,0,1);
		
		$ans="0";
		foreach($data as $value)
		{
			if($value!='0')
			{
				
				if($this->data['Mail']['action']=='Delete')
				{
					$this->Mail->delete($value);
					$this->Session->setFlash('Mail has been deleted successfully');
				}
				$ans="1";
			}
		}
		
		$this->redirect(array('action'=>'index',$region,$id));		
	}
	
	
	
}
?>
