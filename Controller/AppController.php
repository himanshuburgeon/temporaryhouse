<?php

class AppController extends Controller {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Cookie', 'Acl', 'Auth');
    public $uses = array('Site');
    public $ImageResize, $PERMISSION;

    public function beforeFilter() {

        if (isset($this->Auth)) {

            $this->Auth->allow('*');
            $this->Auth->deny('admin_welcome', 'admin_index', 'admin_edit', 'admin_add', 'admin_changepassword', 'admin_permission', 'admin_siteconfig', 'admin_delete');
            $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('controller' => 'admin', 'action' => 'index');
            $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
            $this->set('loggedIn', $this->Auth->user('id'));
            $this->Auth->authorize = array('Controller');
            $this->Auth->userScope = array('User.status' => '1', 'User.usertype' => 'A');
        }

        if (isset($this->params['admin'])) {


            if (!$this->Auth->user('id')) {
                $this->params['admin'] = '';
                $this->Auth->redirect('/users/login');
            } else {
                $this->layout = 'admin';
                $id = $this->Auth->user('id');
                $this->loadModel('User');
                $user = $this->User->read(null, $id);

                $module = ucfirst($this->params['controller'] . 'Controller');
                $user_modules = json_decode($user['User']['permissions'], true);


                if ((!isset($user_modules[$module]) || $user_modules[$module] == '' || $user_modules[$module] == 0) || $user['User']['usertype'] == 'A') {
                    if (($this->params['action'] != 'admin_welcome' && $this->params['action'] != 'admin_changepassword' ) && $user['User']['usertype'] != 'A') {
                        $this->Session->setFlash('You have not permission to access this location', 'default', 'error');
                        $this->redirect(array('controller' => 'users', 'action' => 'welcome'));
                    }
                } else {
                    $this->__setPermission($user_modules[$module]);
                }

                //print_r($user_modules);
                $this->set('ADMIN_PERMISSIONS', $user_modules);
                $this->set('ADMIN_USERS', $user);
            }
        } else {


            $this->Member = $this->Components->load('Member');

            //echo $this->Member->init();
        }

        if (!$this->Session->check('Site')) {
            self::_loadsite();
        }
        if (!$this->Session->check('Languages')) {
            self::_loadLanguages();
        }
        if (isset($this->request->query['languages'])) {
            $this->Session->write('Site.language', $this->request->query['languages']);
        }

        //echo $this->Session->read('Site.language');
        Configure::write('Config.language', $this->Session->read('Site.language'));
        Configure::load('site_config', 'default');






        $this->ImageResize = $this->Components->load('ImageResize');
        $this->set('SITE', $this->Session->read('Site'));
        $this->set('LANGUAGES', $this->Session->read('Languages'));


        return true;
    }

    public function isAuthorized() {
        return true;
    }

    private function _loadLanguages() {
        $this->loadModel('Language');
        $languages = $this->Language->find('list', array('conditions' => array('Language.status' => '1'), 'fields' => array('Language.code', 'Language.name')));


        $this->Session->write('Languages', $languages);
    }

    private function __setPermission($permission) {

        if ($permission == 2 && ($this->params['action'] == 'admin_add' || $this->params['action'] == 'admin_delete')) {

            $this->Session->setFlash('You have not permission to access this location', 'default', 'error');
            $this->redirect(array('action' => 'admin_index'));
            return;
        }
        if ($permission == 1 && ($this->params['action'] == 'admin_add' || $this->params['action'] == 'admin_edit' || $this->params['action'] == 'admin_delete')) {
            $this->Session->setFlash('You have not permission to access this location', 'default', 'error');
            $this->redirect(array('action' => 'admin_index'));
        }


        /*
          if($permission==1){
          $p = 'view';
          }else if($permission==2){
          $p = 'edit';
          }else{
          $p = 'full';
          }
          //$this->PERMISSION = $p;
          $this->set('PERMISSION',$p);
         * */
    }

    private function _loadsite() {
        $sitedetail = $this->Site->find('list', array('conditions' => array('Site.status' => '1'), 'fields' => array('Site.title', 'Site.value')));
        $this->Session->write('Site', $sitedetail);
    }

    protected function _loadOwners() {
        $this->loadModel('Owner');
        $owners = $this->Owner->find('all', array('conditions' => array('Owner.status' => '1'), 'fields' => array('Owner.id', 'Owner.name', 'Owner.surname')));
        $data = array();
        foreach ($owners as $owner) {
            $data[$owner['Owner']['id']] = $owner['Owner']['name'] . ' ' . $owner['Owner']['surname'];
        }

        return $data;
    }

    protected function _loadlocations() {
        $this->loadModel('Location');
        $categories = $this->Location->find('list', array('conditions' => array('Location.status' => '1'), 'fields' => array('Location.id', 'Location.name')));


        return $categories;
    }
    
    protected function _loadTypology() {
        $this->loadModel('Typology');
        $critria = array();
        $critria['fields'] =array('Typology.id', 'TypologyDescription.title');
        $critria['joins'] = array(
            array('table' => 'typology_descriptions',
                'alias' => 'TypologyDescription',
                'type' => 'INNER',
                'conditions' => array('Typology.id = TypologyDescription.typology_id')
        ));
        $critria['conditions'] = array(
            'Typology.status' => '1',
            'TypologyDescription.language_code'=>$this->Session->read('Site.language')
                );
        $critria['group'] = array('Typology.id');
        $typologies = $this->Typology->find('list', $critria);
        
        //$this->loadModel('TypologyDescription');
        //$data['TypologyDescription']['id'] = 7;
        //$data['TypologyDescription']['title'] = 'вилла';
        //$this->TypologyDescription->create();
        //$this->TypologyDescription->save($data);
        //print_r($typologies);die;

        return $typologies;
        
    }

}

?>
