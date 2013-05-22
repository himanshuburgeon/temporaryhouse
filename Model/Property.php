<?php
class Property extends AppModel {
     public $name = 'Property';
    
      public $hasMany = array(
        'PropertyPrice' => array('className'  => 'PropertyPrice'),
        'PropertySpecialPrice' => array('className' =>'PropertySpecialPrice')
        );
      public $recursive = 0;
      public $validate = array(
          'owner_id'=>array(
              'rule'=>'notEmpty',
               'message'=>'Please select owner'
            ),
          'nation'=>array(
              'rule1' =>array(
                  'rule'    => array('maxLength', 30),
                  'message' => 'Nation name should be less than 30 character(s)'
                        ),
              'rule2'=>array(
                        'rule' =>'notEmpty',
                        'message'=>'Please enter nation name'
                      )
              ),
          'city'=>array(
            'rule'=>'notEmpty',
            'message'=>'Please enter city name'
              ),
          'typology'=>array(
            'rule'=>'notEmpty',
            'message'=>'Please select typology'
            ),
          'sleeps'=>array(
            'rule'=>'notEmpty',
            'message'=>'Please select sleeps'
            ),
          'bed'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select Bed'
              ),
          'description'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter description'
              ),
          'rooms'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select rooms'
              ),
          'bath'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select bath '
              ),
          'title'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter Title'
              ),
          'service'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select services'
              ),
          'address'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter address'
              ),
          'min_stay'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select minimum stay'
              ),
          'max_stay'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please select maximum stay'
              ),
          'avail_furniture_fair'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please Select Availability Of Furniture Fair'
              ),
          'avail_fashion_week'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please Select Availability Of Fashion Weeks'
              ),
          'avail_burgo'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please Select Availability Of Burgo'
              ),
          'deposit'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter deposit'
              ),
          'price_one_night'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter price one night'
              ),
          'cleaning_cost'=>array(
              'rule1' =>array(
                  'rule'    => 'notEmpty',
                  'message' => 'Please enter cleaning costs'
                        ),
              'rule2'=>array(
                        'rule' =>'numeric',
                        'message'=>'Please enter only numeric velue'
                      )
              ),
          'guest_cost'=>array(
              'rule'=>'notEmpty',
              'message'=>'Please enter guest cost'
              )
          );
							
}
?>
