<?php
class PropertyPrice extends AppModel {
     public $name = 'PropertyPrice';
    
     public $validate = array(
								'min_night'=>
									array(
										'rule1' => 
											array(
												'rule'    => array('numeric'),
												'message' => 'Please enter minimum number of nights.',
												'allowEmpty' => false
											)
									),
								'max_night'=>
									array(
										'rule1' => 
											array(
												'rule'    => array('numeric'),
												'message' => 'Please enter maximum number of nights.',
												'allowEmpty' => false
												
											),
											array(
												'rule' =>'notEmpty',
												'message'=>'Please enter owner surname'
											),
											
									),
									
								
								'price'=>
									array(
										'rule1' => 
											array(
												'rule'    => array('decimal', 2),
												'message' => 'price should be in decimal form'
											),
											array(
												'rule' =>'notEmpty',
												'message'=>'Please enter price in decimal form'
											),
											
											
									),
									
									
								);
}
?>
