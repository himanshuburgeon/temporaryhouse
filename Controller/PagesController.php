<?php

class PagesController extends AppController {

  var $name = 'Pages';
  var $helpers = array('Fck');
  var $components = array('Email');
  var $uses = array('Page', 'Mail', 'Message');
  var $paginate = array();

  function admin_index($parent_id = 0, $search = NULL, $limit = 20) {

    /* pagination start */
    $this->paginate = array();
    $this->paginate['conditions']['AND'][] = array('Page.parentId' => $parent_id);
    if ($search != NULL && $search != "_blank") {
      $this->paginate['conditions']['AND'][] = array('Page.name like' => urldecode($search) . '%');
    } else {
      $search = '';
    }

    if ($limit != 'ALL') {
      $this->paginate['limit'] = $limit;
    }
    $this->paginate['order'] = array('Page.reorder' => 'ASC');
    $pages = $this->paginate('Page');
    /* pagination end */
    
    $parent_detail = array();
    if ($parent_id != 0) {
      $parent_detail =  $this->Page->read(null, $parent_id);
    }


    /* breadcrumbs start */
    $breadcrumbs = array();
    $breadcrumbs[] = array(
        'title' => 'Back to Homepage',
        'link' => $this->Session->read('Site.siteurl') . '/admin',
        'name' => ''
    );
    $breadcrumbs[] = array(
        'title' => '',
        'link' => (!empty($parent_detail))?$this->Session->read('Site.siteurl') . '/admin/pages/':'',
        'name' => 'Content Manager'
    );
    if(!empty($parent_detail)){
       $breadcrumbs[] = array(
          'title' => '',
          'link' => '',
          'name' => $parent_detail['Page']['pageTitle']
      );
    }
    /* breadcrumbs end */



    
    $this->set('pages', $pages);
    $this->set('parent_id', $parent_id);
    $this->set('parent_detail', $parent_detail);
    $this->set('breadcrumbs', $breadcrumbs);
    $this->set('search', urldecode($search));
    $this->set('limit', $limit);
  }

  function admin_add($parent_id = 0) {
    $this->add($parent_id);
  }

  function admin_view($id = null) {
    $this->layout = '';
    $page = $this->Page->read(null, $id);
    $this->set('page', $page);
  }

  function add($parent_id = 0, $id = null) {
    if (!empty($this->data) && self::__validate()) {
      if ($this->request->data['Page']['id']) {
        $this->Session->setFlash('Content has been updated successfully');
      } else {
        $this->Session->setFlash('Content has been added successfully');
      }
      $this->request->data['Page']['parentId'] = $parent_id;

      $this->Page->create();
      $this->Page->save($this->request->data);
      $this->redirect(array('action' => 'admin_index', $parent_id));
    }
    
    
    $parent_page = array();
    $language = $this->Session->read('Site.language');
    
    if($parent_id){
      $parent_page = $this->Page->read(null,$parent_id);
      $language = $parent_page['Page']['language_code'];
    }
    
    
    if ($id) {
      if (empty($this->data)) {
        $this->request->data = $this->Page->read(null, $id);
        $language =  $this->request->data['Page']['language_code'];
      }
    }
    
    
    
    
    
    
     


    $breadcrumbs = array();
    $breadcrumbs[] = array(
        'title' => 'Back to Homepage',
        'link' => $this->Session->read('Site.siteurl') . '/admin',
        'name' => ''
    );
    $breadcrumbs[] = array(
        'title' => '',
        'link' => $this->Session->read('Site.siteurl') . '/admin/pages',
        'name' => 'Content Manager'
    );
    
    if(!empty($parent_page)){
       $breadcrumbs[] = array(
          'title' => '',
          'link' => $this->Session->read('Site.siteurl') . '/admin/pages/'.$parent_id,
          'name' => $parent_page['Page']['pageTitle']
      );
    }
    if ($id) {
      $breadcrumbs[] = array(
          'title' => '',
          'link' => '',
          'name' => 'Update Content ['.$this->request->data['Page']['pageTitle'].']'
      );
    } else {
      $breadcrumbs[] = array(
          'title' => '',
          'link' => '',
          'name' => 'Add Content'
      );
    }
    
    
    
    
    $this->set('breadcrumbs', $breadcrumbs);
    $this->set('parent_id', $parent_id);
    $this->set('language',$language);
  }

  function admin_change_order() {
    $this->autoRender = false;
    $i = 0;
    foreach ($_GET['listItem'] as $id) {
      $this->Page->query("update pages set `reorder`='" . $i . "' where id='" . $id . "'");
      $i++;
    }
  }

  function admin_edit($parent_id = 0, $id = null) {
    $this->add($parent_id, $id);
  }

  function admin_delete($parent_id = null) {
    $data = $this->data['Page'];
    array_splice($data, 0, 1);
    array_splice($data, 0, 1);
    $ans = "0";
    foreach ($data as $value) {
      if ($value != '0') {
        if ($this->data['Page']['action'] == 'Publish') {
          $page = $this->Page->read(null, $value);
          $page['Page']['status'] = 1;
          $this->Page->create();
          $this->Page->save($page);
          $this->Session->setFlash('Content(s) has been published successfully');
        }
        if ($this->data['Page']['action'] == 'Unpublish') {
          $page = $this->Page->read(null, $value);
          $page['Page']['status'] = 0;
          $this->Page->create();
          $this->Page->save($page);
          $this->Session->setFlash('Content(s) has been unpublished successfully');
        }
        if ($this->data['Page']['action'] == 'Delete') {
          $this->Page->delete($value);
          $this->Session->setFlash('Content(s) has been deleted successfully');
        }
        $ans = "1";
      }
    }


    $this->redirect(array('action' => 'index', $parent_id));
  }

  function home() {
    
  }

  function view($url_key = null) {
   $page= $this->Page->find('first', array('conditions'=>array('Page.url_key'=>$url_key,'Page.status'=>1,'Page.language_code'=>$this->Session->read('Site.language'))));
    
    $this->set('pageView', $page);
    
  }

  private function _contactus_request() {
    $mail = $this->Mail->read(null, '3');
    $admindetail = $this->Site->find('list', array('conditions' => array('Site.status' => '1'), 'fields' => array('Site.title', 'Site.value')));
    $body = str_replace('{NAME}', $this->request->data['page']['name'], $mail['Mail']['body']);
    $email = new CakeEmail();
    $email->viewVars(array('data' => $body));

    ob_start();
    $email->to($this->request->data['page']['email']);
    $email->subject($mail['Mail']['subject']);
    $email->replyTo($admindetail['contactemail']);
    $email->from($admindetail['contactemail']);
    $email->emailFormat('html');
    $email->template('send_mail');
    $email->send();
    ob_end_clean();

    //sending to admin 
    $mail = $this->Mail->read(null, '4');

    $body = str_replace('{NAME}', ucfirst($this->request->data['page']['name']), $mail['Mail']['body']);
    $body = str_replace('{EMAIL}', $this->request->data['page']['email'], $body);
    $body = str_replace('{MESSAGE}', $this->request->data['page']['message'], $body);
    $body = str_replace('{ADMIN}', ucfirst($admindetail['adminname']), $body);
    //$this->set('data',$body1);
    $email->viewVars(array('data' => $body));

    ob_start();

    //$email->to('niraj.saamarth@gmail.com');
    $email->to($admindetail['adminemail']);
    $email->subject($mail1['Mail']['subject']);
    $email->replyTo($this->request->data['page']['email']);
    $email->from($this->request->data['page']['email']);
    $email->emailFormat('html');
    $email->template('send_mail');
    $email->send();
    ob_end_clean();
    //$error=$this->Message->read(null,'26');
    //$this->Session->setFlash($error['Message']['msg']);
    //$this->Session->setFlash('Your message has been sent successfully','default','','flash');
    $this->redirect(array('controller' => 'pages', 'action' => 'view', 35));
  }

  private function __validate() {
    //echo '<pre>';print_r($this->request->data);die;
    if ($this->data['Page']['name'] == '') {
      $this->Session->setFlash('Please Enter Page Name', 'default', '', 'error');
      return false;
    }
    if ($this->data['Page']['pageTitle'] == '') {
      $this->Session->setFlash('Please Enter Page Title', 'default', '', 'error');
      return false;
    }
    if ($this->data['Page']['metaKeyword'] == '') {
      $this->Session->setFlash('Please Enter Meta Keyword ', 'default', '', 'error');
      return false;
    }

    return true;
  }

  function request_topmenu($parentid = 0) {

    $this->autoRender = false;
    $menus = $this->Page->find('all', array('conditions' => array('Page.parentId' => $parentid, 'Page.status' => 1,'Page.top_menu'=>1,'Page.language_code'=>$this->Session->read('Site.language')), 'fields' => array('Page.id','Page.parentId', 'Page.url_key', 'Page.pageTitle')));
    
    
    
    $all_menus = array();
    foreach($menus as $menu){
      $submenu = array();
      if($menu['Page']['parentId']==0){
       $submenu = $this->request_topmenu($menu['Page']['id']);
      }
      
     
      $all_menus[] = array(
          'id'=>$menu['Page']['id'],
          'title'=>$menu['Page']['pageTitle'],
          'parent'=>($menu['Page']['parentId']==0)?true:false,
          'submenu'=>$submenu,
          'url_key'=>$menu['Page']['url_key']
      );
    }
    
    

    return $all_menus;
  }
  
  function request_footermenu(){
      $this->autoRender = false;
      $url_links = array('partners','contact_us','video','newsletter');
      $menus = $this->Page->find('all', array('conditions' => array('Page.parentId' => 0, 'Page.status' => 1,'Page.top_menu'=>0,'Page.url_key'=>$url_links,'Page.language_code'=>$this->Session->read('Site.language')), 'fields' => array('Page.id','Page.parentId', 'Page.url_key', 'Page.pageTitle')));
      
      $all_menus = array();
    foreach($menus as $menu){
     
      
     
      $all_menus[] = array(
          'id'=>$menu['Page']['id'],
          'title'=>$menu['Page']['pageTitle'],
          'parent'=>($menu['Page']['parentId']==0)?true:false,
          'url_key'=>$menu['Page']['url_key']
          
      );
    }
    
    

    return $all_menus;
      
      
  }

}

?>
