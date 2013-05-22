<?php

class PropertiesController extends AppController {

  var $name = 'Properties';
  var $helpers = array();
  var $components = array();
  var $uses = array('Property', 'PropertyPrice', 'PropertySpecialPrice');
  var $paginate = array();
  var $property_id = 'dsds';

  function admin_index($search = NULL, $limit = 20) {

    $this->paginate = array();
    if ($search != NULL && $search != "_blank") {
      $this->paginate['conditions'] = array('Property.name like' => urldecode($search) . '%');
    } else {
      $search = '';
    } 

    if ($limit != 'ALL') {
      $this->paginate['limit'] = $limit;
    }

    $this->paginate['fields'] = array('Property.*', 'Owner.name', 'Owner.surname');
    $this->paginate['joins'] = array(
        array(
            'table' => 'owners',
            'alias' => 'Owner',
            'type' => 'INNER',
            'conditions' => array('Owner.id = Property.owner_id')
        )
    );
    $this->paginate['order'] = array('Property.reorder' => 'ASC');
    
    $results = $this->paginate('Property');

    /* breadcrumbs start */
    $breadcrumbs = array();
    $breadcrumbs[] = array(
        'title' => 'Back to Homepage',
        'link' => $this->Session->read('Site.siteurl') . '/admin',
        'name' => ''
    );
    $breadcrumbs[] = array(
        'title' => '',
        'link' => '',
        'name' => 'Property Manager'
    );
    /* breadcrumbs end */
    
    $properties = array();
    foreach($results as $result){
      if(!is_null($result['Property']['photo']) && file_exists(WWW_ROOT."img/property/".$result['Property']['photo'])){
        $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/property/",WWW_ROOT."img/tmp/property/",$result['Property']['photo'],80,60);
        } else{
          $img_name = 'no-image.png';
          $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/",WWW_ROOT."img/tmp/",$img_name,80,60);
         }
         $result['Property']['image'] = $thumb_name;
         $properties[] = $result;
      
    }
    
    //load Categories
    
    


    $this->set('breadcrumbs', $breadcrumbs);
    $this->set('Property', $properties);
    $this->set('search', urldecode($search));
    $this->set('limit', $limit);
  }

  function admin_change_order() {
    $this->autoRender = false;
    $i = 0;
    foreach ($_GET['listItem'] as $id) {
      $this->Page->query("update properties set `reorder`='" . $i . "' where id='" . $id . "'");
      $i++;
    }
  }

  function admin_edit($id = id) {
    self::_add($id);
  }

  function admin_add() {
    self::_add();
  }

  function admin_view($id = null) {
    $this->layout = '';
    $property = $this->Property->read(null, $id);
    $this->set('property', $property);
  }

  function admin_delete($id = null) {
    $data = $this->data['Property'];
    array_splice($data, 0, 1);
    array_splice($data, 0, 1);
    $ans = "0";
    foreach ($data as $value) {
      if ($value != '0') {
        if ($this->data['Property']['action'] == 'Publish') {
          $property = $this->Property->read(null, $value);
          $property['Property']['status'] = 1;
          $this->Property->create();
          $this->Property->save($property);
          $this->Session->setFlash(__('property') . ' ' . __('has_been') . ' ' . __('published') . ' ' . __('successfully'));
        }
        if ($this->data['Property']['action'] == 'Unpublish') {
          $property = $this->Property->read(null, $value);
          $property['Property']['status'] = 0;
          $this->Property->create();
          $this->Property->save($property);
          $this->Session->setFlash(__('property') . ' ' . __('has_been') . ' ' . __('unpublished') . ' ' . __('successfully'));
        }
        if ($this->data['Property']['action'] == 'Delete') {
          $this->Property->delete($value);
          $this->Session->setFlash(__('property') . ' ' . __('has_been') . ' ' . __('deleted') . ' ' . __('successfully'));
        }
        $ans = "1";
      }
    }


    $this->redirect(array('action' => 'index', $id));
  }

  private function _manage_property_prices() {
    $this->loadModel('PropertyPrice');
    if (!empty($this->request->data['PropertyPrice'])) {
      $this->PropertyPrice->deleteAll(array('PropertyPrice.property_id' => $this->property_id));

      foreach ($this->request->data['PropertyPrice'] as $property_prices) {
        $prices = array();

        $prices['PropertyPrice']['id'] = '';
        $prices['PropertyPrice']['property_id'] = $this->property_id;
        $prices['PropertyPrice']['min_night'] = $property_prices['min_night'];
        $prices['PropertyPrice']['max_night'] = $property_prices['max_night'];
        $prices['PropertyPrice']['price'] = sprintf("%.2f", $property_prices['price']);

        $this->PropertyPrice->create();
        $this->PropertyPrice->save($prices);
      }
    }
    
  }

  private function _manage_special_prices() {
    //$this->PropertySpecialPrice->deleteAll(array('PropertySpecialPrice.property_id' => $this->property_id));
    if (!empty($this->request->data['PropertySpecialPrice'])) {
      $this->PropertySpecialPrice->deleteAll(array('PropertySpecialPrice.property_id' => $this->property_id));
     
      foreach ($this->request->data['PropertySpecialPrice'] as $special_prices) {
        if($special_prices['event_name']=='' && $special_prices['start_date']=='' &&  $special_prices['price']){
          continue;
         }
        
        
        $prices = array();
        

        $prices['PropertySpecialPrice']['id'] = '';
        $prices['PropertySpecialPrice']['property_id'] = $this->property_id;
        $prices['PropertySpecialPrice']['event_name'] = $special_prices['event_name'];
        $prices['PropertySpecialPrice']['start_date'] = $special_prices['start_date'];
        $prices['PropertySpecialPrice']['end_date'] = $special_prices['end_date'];
        $prices['PropertySpecialPrice']['price'] = sprintf("%.2f", $special_prices['price']);
       
        $this->PropertySpecialPrice->create();
        $this->PropertySpecialPrice->save($prices);
      }
    }
  
  }

  private function __validate() {
    // echo '<pre>';print_r($this->request->data);die;
    $errors = array();
    foreach ($this->request->data['PropertyPrice'] as $k => $property_prices) {
      if ($property_prices['min_night'] != '' || $property_prices['max_night'] != '' || $property_prices['price']) {
        $property_price = array();
        $property_price['PropertyPrice']['id'] = '';
        $property_price['PropertyPrice']['min_night'] = $property_prices['min_night'];
        $property_price['PropertyPrice']['max_night'] = $property_prices['max_night'];
        $property_price['PropertyPrice']['price'] = $property_prices['price'];

        $this->PropertyPrice->set($property_price);
        if ($this->PropertyPrice->validates()) {
          $errors = 'not error';
        } else {
          $this->request->data['PropertyPrice'][$k]['error'] = 1;
          $errors['PropertyPrice'][$k] = $this->PropertyPrice->validationErrors;
        }
      }
    }


    //$this->set('errors',$errors);
    $this->request->data['Property']['service'] = json_encode($this->request->data['Property']['service']);
    $this->Property->set($this->request->data);
    if ($this->Property->validates()) {
      return true;
    } else {
      $this->Session->setFlash('Please fill all required fields', 'default', '', 'error');
      $this->request->data['Property']['service'] = json_decode($this->request->data['Property']['service'], true);
      return false;
    }
  }
  
  function search($location=null,$arrival_date=null,$departure_date=null,$availability=null){
  //$this->autoRender = false;
    
      if(!empty($this->request->data)){
          if(!empty($this->request->data['Property']['location'])){
              $location = $this->request->data['Property']['location'];
          }else{
              $location = '_blank';
          }
          
          if(!empty($this->request->data['Property']['arrival_date'])){
              $arrival_date = strtotime($this->request->data['Property']['arrival_date']);
          }else{
              $arrival_date = '_blank';
          }
          
          if(!empty($this->request->data['Property']['departure_date'])){
              $departure_date = strtotime($this->request->data['Property']['departure_date']);
          }else{
              $departure_date = '_blank';
          }
          
          if(isset($this->request->data['Property']['availability'])){
              $availability = $this->request->data['Property']['availability'];
          }else{
              $availability = '_blank';
          }
          
          
         
        
          $this->redirect('/search/'.$location.'/'.$arrival_date.'/'.$departure_date.'/'.$availability);
          //echo $departure_date.'<br />';
          //echo date("Y-m-d",$departure_date);
          //echo '<pre>';print_r($this->request->data);die;
          
      }
      
      
      $conditions = null;
      if($location!=null && $location!='_blank'){
          $this->loadModel('Category');
          //$location_list = $this->Category->find('list',array('fields'=>array('Category.id'),'conditions'=>array('Category.name like'=>'%'.$location.'%')));
          
           $conditions['Property.category_id'] = $location;
          
      }
      if(($arrival_date!=null && $arrival_date!='_blank') && ($departure_date!=null && $departure_date!='_blank') ){
          $arrival_date = date('Y-m-d',$arrival_date);
          $departure_date = date('Y-m-d',$departure_date);
       
          //$conditions['OR'] = array('Property.nation like'=>'%'.$location.'%','Property.city like'=>'%'.$location.'%','Property.category_id'=>$location_list);
      }else{
          $arrival_date ='';
          $departure_date = '';
          
      }
       
      if($availability!=null && $availability!='_blank'){
         
          if($availability=='avail_furniture_fair'){
              $conditions['Property.avail_furniture_fair'] = 1;
          }
          if($availability=='avail_fashion_week'){
              $conditions['Property.avail_fashion_week'] = 1;
          }
          if($availability=='avail_burgo'){
              $conditions['Property.avail_burgo'] = 1;
          }
          
          
      
      }
      
      
     $results = $this->Property->find('all',array('conditions'=>$conditions));
     
     $properties = array();
    foreach($results as $result){
      $result['Property']['min_stay'] = Configure::read('STAY.'.$result['Property']['min_stay']);
      $result['Property']['max_stay'] = Configure::read('STAY.'.$result['Property']['max_stay']);
      
      $result['Property']['description'] = (strlen($result['Property']['description']) > 531)?substr ( $result['Property']['description'], 0 ,520 ).'....':$result['Property']['description'];
      
        
        
        if(!is_null($result['Property']['photo']) && file_exists(WWW_ROOT."img/property/".$result['Property']['photo'])){
        $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/property/",WWW_ROOT."img/tmp/property/",$result['Property']['photo'],255,182);
        } else{
          $img_name = 'no-image.png';
          $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/",WWW_ROOT."img/tmp/",$img_name,255,182);
         }
         $result['Property']['image'] = $thumb_name;
         $properties[] = $result;
      
    }
    
   $categories = self::_loadCategories();
     
   // echo '<pre>';print_r($properties);die;
   
   
   
  
   
    $this->set('properties',$properties);
    $this->set('categories',$categories);
     $this->set('location',$location);
     $this->set('availability',$availability);
     $this->set('arrival_date',$arrival_date);
     $this->set('departure_date',$departure_date);
    
  }
  
  private function _manage_image($image = array(),$property_id=null){
    if($image['error'] > 0 && ($property_id==null || $property_id=='')){
      return '';
    }else{
      $existing_image = array();
      if($property_id){
        $existing_image = $this->Property->find('first',array('fields'=>array('Property.photo'),'conditions'=>array('Property.id'=>$property_id)));
       }
      if($image['error'] > 0){
         return $existing_image['Property']['photo'];
        }else{
          $destination = WWW_ROOT."img/property/";
          $ext = explode('.', $image['name']);
          $image_name = time().'_'.time().'.'.array_pop($ext);
          move_uploaded_file($image['tmp_name'],$destination.$image_name);
          if(!empty($existing_image)){
            unlink($destination.$existing_image['Property']['photo']);
          }
          //move_uploaded_file($filename, $destination);
           return $image_name;
        }
       
      
      
    }
            
    
  }

  private function _add($id = null) {
    if (!empty($this->request->data) && self::__validate()) {
      //if (!empty($this->request->data)){
      
      

      $this->request->data['Property']['service'] = json_encode($this->request->data['Property']['service']);
      //echo '<pre>';print_r($this->request->data);die;

      if ($this->request->data['Property']['id']) {
        $this->Session->setFlash(__('property') . ' ' . __('details') . ' ' . __('has_been') . ' ' . __('updated') . ' ' . __('successfully'));
      } else {
        $this->Session->setFlash(__('property') . ' ' . __('details') . ' ' . __('has_been') . ' ' . __('added') . ' ' . __('successfully'));
        $this->request->data['Property']['created_at'] = date('Y-m-d H:i:s');
        $this->request->data['Property']['status'] = 1;
      }
      $this->request->data['Property']['photo'] = self::_manage_image($this->request->data['Property']['photo'],$this->request->data['Property']['id']);
     // echo '<pre>'; print_r($this->request->data);die;
      $this->Property->create();
      $this->Property->save($this->request->data);
      $this->property_id = $this->Property->id;
      

      self::_manage_property_prices();
      self::_manage_special_prices();
      $this->redirect(array('action' => 'admin_index'));
    }

    if ($id) {
      if (empty($this->request->data)) {
        $this->Property->recursive = 2;
        $this->request->data = $this->Property->read(null, $id);
        $this->request->data['Property']['service'] = json_decode($this->request->data['Property']['service'], true);
        //print_r($this->request->data['Property']['service']);
          if(!is_null($this->request->data['Property']['photo']) && file_exists(WWW_ROOT."img/property/".$this->request->data['Property']['photo'])){
          $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/property/",WWW_ROOT."img/tmp/property/",$this->request->data['Property']['photo'],80,60);
          } else{
            $thumb_name = false;
           // $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/",WWW_ROOT."img/tmp/",$img_name,80,60);
           }
         $this->request->data['Property']['image'] = $thumb_name;
      }
    } else {
      $this->request->data['PropertyPrice'] = array();
    }


    $owners = self::_loadOwners();
    $categories = self::_loadCategories();
   
    $breadcrumbs = array();
    $breadcrumbs[] = array(
        'title' => 'Back to Homepage',
        'link' => $this->Session->read('Site.siteurl') . '/admin',
        'name' => ''
    );
    $breadcrumbs[] = array(
        'title' => '',
        'link' => $this->Session->read('Site.siteurl') . '/admin/properties',
        'name' => 'Property Manager'
    );
    if ($id) {
      $breadcrumbs[] = array(
          'title' => '',
          'link' => '',
          'name' => 'Update Property'
      );
    } else {
      $breadcrumbs[] = array(
          'title' => '',
          'link' => '',
          'name' => 'Add Property'
      );
    }
    $this->set('categories', $categories);
    $this->set('breadcrumbs', $breadcrumbs);
    $this->set('owners', $owners);
  }

}

?>