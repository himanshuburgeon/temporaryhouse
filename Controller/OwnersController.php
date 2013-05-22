<?php
class OwnersController extends AppController{
	var $name = 'Owners';
	var $helpers = array();
	var $components = array();
	var $uses = array('Owner');
	var $paginate = array();
	
	function admin_index($search=NULL,$limit = 20) {
		
		$this->paginate = array();
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions'] = array('Owner.name like'=>urldecode($search).'%');
		}else{
			$search = '';
		}
		
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
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
							'link'=>'',
							'name'=>'Owner Manager'
							);
		/* breadcrumbs end */
		
		
		
		
		//$this->set('languages',$languages);
		
		$this->set('breadcrumbs',$breadcrumbs); 
		
		$this->paginate['order'] = array('Language.reorder'=>'ASC');
		
		$this->set('owner', $this->paginate('Owner'));
		$this->set('search', urldecode($search));
		$this->set('limit', $limit);
		
	}
	function admin_change_order(){
		$this->autoRender =false;
		$i=0; 
		foreach($_GET['listItem'] as $id)
		{  
			$this->Owner->query("update Owner set `reorder`='".$i."' where id='".$id."'");
			$i++;
		}
	}
		
		
		
	function admin_edit($id=id){
		$this->add($id);
	}
	function admin_add(){
		$this->add();
	}
	
	
	function admin_view($id=null){
		$this->layout = '';
		$Owner = $this->Owner->read(null,$id);
		$this->set('Owner',$Owner);
	}
	
	
	function add($id=null){
		if (!empty($this->request->data) && self::__validate())
		{
			if($this->request->data['Owner']['id']){
				$this->Session->setFlash(__('owner').' '.__('has_been').' '.__('updated').' '.__('successfully'));
			}else{
				$this->Session->setFlash(__('owner').' '.__('has_been').' '.__('added').' '.__('successfully'));
			}
			$this->Owner->create();
			$this->Owner->save($this->request->data);
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($id) {
			if (empty($this->data)) {
				$this->request->data = $this->Owner->read(null, $id);
			}
		}
		
		
		$breadcrumbs  =  array();
		$breadcrumbs[] = array(
							'title'=>'Back to Homepage',
							'link'=>$this->Session->read('Site.siteurl').'/admin',
							'name'=>''
							);
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>$this->Session->read('Site.siteurl').'/admin/languages',
							'name'=>'Language Manager'
							);
		if($id){
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Update Content'
							);
		}else{
		$breadcrumbs[] = array(
							'title'=>'',
							'link'=>'',
							'name'=>'Add Content'
							);
		}
		$this->set('breadcrumbs',$breadcrumbs);
		
		
	}
	function admin_delete($id=null){
		 $data=$this->data['Owner'];
		 array_splice($data,0,1); 
		 array_splice($data,0,1);
		 $ans="0";
		 foreach($data as $value)
		 { 
			 if($value!='0')
			 {
				 if($this->data['Owner']['action']==__('publish'))
				{
					$owner=$this->Owner->read(null,$value);
					$owner['Owner']['status']=1;
					$this->Owner->create();
					$this->Owner->save($owner);
					$this->Session->setFlash(__('Owners_has_been_published_successfully'));
				}
				if($this->data['Owner']['action']==__('unpublish'))
				{
					$owner=$this->Owner->read(null,$value);
					$owner['Owner']['status']=0;
					$this->Owner->create();
					$this->Owner->save($owner);
					$this->Session->setFlash(__('Owners_has_been_unpublished_successfully'));
				}
				if($this->data['Owner']['action']==__('delete'))
				{
					$this->Owner->delete($value);
					$this->Session->setFlash(__('Owners_has_been_deleted_successfully'));
				}
				$ans="1";
				}
		  }
		 
        
      $this->redirect(array('action'=>'index',$id));	
  
  }
  private function __validate(){
	  

		$this->Owner->set($this->request->data);
		
		if ($this->Owner->validates()) {
			return true;
		} else {
			return false;
		}
		
		
		/*
	  
		if($this->data['Owner']['name']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('owner').' '.__('name'),'default','','error');
			return false;
		}
		if($this->data['Owner']['surname']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('surname'),'default','','error');
			return false;
		}
		if($this->data['Owner']['mobile']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('mobile').' '.__('number') ,'default','','error');
			return false;
		}
		if($this->data['Owner']['email']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('email'),'default','','error');
			return false;
		}
		if($this->data['Owner']['address']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('address'),'default','','error');
			return false;
		}
		if($this->data['Owner']['city']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('city'),'default','','error');
			return false;
		}
		if($this->data['Owner']['cap']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('cap'),'default','','error');
			return false;
		}
		if($this->data['Owner']['vat']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('VAT'),'default','','error');
			return false;
		}
		if($this->data['Owner']['tax_code']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('tax').' '.__('code'),'default','','error');
			return false;
		}
		if($this->data['Owner']['iban']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').''.'iban ','default','','error');
			return false;
		}
		if($this->data['Owner']['bic_swift']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.'bic / swift ','default','','error');
			return false;
		}
		if($this->data['Owner']['holders_cc']==''){
			$this->Session->setFlash(__('Please').' '.__('enter').' '.__('holder_c/c'),'default','','error');
			return false;
		}
		if($this->data['Owner']['notes']==''){
			$this->Session->setFlash('Please Enter note ','default','','error');
			return false;
		}
		* */
		//return false;
	}
}
	?>
