<?php
class AdminController extends AppController
{
	var $name = 'admin';
	var $helpers = array('Html', 'Form','Javascript', 'Fck');
	var $components = array('Auth');
	var $uses = array();
	function index()
	{
		//echo "<pre>";print_r($this->Auth->user);die();
		if (!$this->Auth->user('id'))
		{
			//$this->layout="admin";
			$this->redirect('/users/login');
			//$this->redirect(array('controller'=>'users','action'=>'login'));
		}
		else if($this->Auth->user('id'))
		{//die('ffffff');
			$this->layout="admin";
			$this->redirect('/admin/users/welcome');
			//$this->params['prefix']='admin';
			//$this->redirect(array('controller'=>'users','action'=>'welcome'));
			
		}
	}
}
?>