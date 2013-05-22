<?php
class LanguagesController extends AppController{
	var $name = 'Languages';
	var $helpers = array();
	var $components = array();
	var $uses = array('Language');
	var $paginate = array();
	
	function admin_index($search=NULL,$limit = 20) {
		
		$this->paginate = array();
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions'] = array('Language.name like'=>urldecode($search).'%');
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
							'name'=>'Language Manager'
							);
		/* breadcrumbs end */
		
		
		
		
		//$this->set('languages',$languages);
		
		$this->set('breadcrumbs',$breadcrumbs); 
		
		$this->paginate['order'] = array('Language.reorder'=>'ASC');
		
		$this->set('languages', $this->paginate('Language'));
		$this->set('search', urldecode($search));
		$this->set('limit', $limit);
		
	}
	function admin_change_order(){
		$this->autoRender =false;
		$i=0; 
		foreach($_GET['listItem'] as $id)
		{  
			$this->Page->query("update languages set `reorder`='".$i."' where id='".$id."'");
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
		$language = $this->Language->read(null,$id);
		$this->set('language',$language);
	}
	
	
	function add($id=null){
		if (!empty($this->request->data))
		{
			if($this->request->data['Language']['id']){
				$this->Session->setFlash(__('language').' '.__('has_been').' '.__('updated').' '.__('successfully'));
			}else{
				$this->Session->setFlash(__('language').' '.__('has_been').' '.__('added').' '.__('successfully'));
			}
			$this->Language->create();
			$this->Language->save($this->request->data);
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($id) {
			if (empty($this->data)) {
				$this->request->data = $this->Language->read(null, $id);
			}
		}
		
		
		/*$breadcrumbs  =  array();
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
		$this->set('breadcrumbs',$breadcrumbs);*/
		
		
	}
	function admin_delete($id=null){
		 $data=$this->data['Language'];
		 array_splice($data,0,1); 
		 array_splice($data,0,1);
		 $ans="0";
		 foreach($data as $value)
		 {
			 if($value!='0')
			 {
				 if($this->data['Language']['action']=='Publish')
				{
					$language=$this->Language->read(null,$value);
					$language['Language']['status']=1;
					$this->Language->create();
					$this->Language->save($language);
					$this->Session->setFlash(__('languages').' '.__('has_been').' '.__('published').' '.__('successfully'));
				}
				if($this->data['Language']['action']=='Unpublish')
				{
					$language=$this->Language->read(null,$value);
					$language['Language']['status']=0;
					$this->Language->create();
					$this->Language->save($language);
					$this->Session->setFlash(__('languages').' '.__('has_been').' '.__('unpublished').' '.__('successfully'));
				}
				if($this->data['Language']['action']=='Delete')
				{
					$this->Language->delete($value);
					$this->Session->setFlash(__('languages').' '.__('has_been').' '.__('deleted').' '.__('successfully'));
				}
				$ans="1";
				}
		  }
		 
        
      $this->redirect(array('action'=>'index',$id));	
  
  }
}
?>
