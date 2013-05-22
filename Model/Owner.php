<?php

class Owner extends AppModel {

    public $name = 'Owner';
    public $validate = array(
        'name' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 30),
                'message' => 'Owner name should be less than 30 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter owner name'
            ),
        ),
        'surname' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 30),
                'message' => 'Owner surname should be less than 30 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter owner surname'
            ),
        ),
        'mobile' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 20),
                'message' => 'Owner mobile should be less than 20 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter mobile number'
            ),
            array(
                'rule' => '/^(0|[1-9][0-9]*)$/',
                'message' => 'Please enter numbers only'
            ),
        ),
        'email' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 30),
                'message' => 'Owner email should be less than 30 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter owner email'
            ),
            array(
                'rule' => array('email', true),
                'message' => 'Please enter valid email address'
            ),
        ),
        'address' =>
        array(
            'rule1' =>
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter owner address'
            ),
        ),
        'city' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 30),
                'message' => 'City name should be less than 30 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter city name'
            ),
        ),
        'cap' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 30),
                'message' => 'Cap should be less than 30 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Cap'
            ),
        ),
        'vat' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 12),
                'message' => 'Vat should be less than 12 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter vat'
            ),
            array(
                'rule' => '/^(0|[1-9][0-9]*)$/',
                'message' => 'Please enter numbers only'
            ),
        ),
        'tax_code' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 12),
                'message' => 'Tax code should be less than 12 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Tax code'
            ),
        ),
        'iban' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 4),
                'message' => 'Iban should be less than 4 character(s)'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter iban'
            ),
        ),
        'bic_swift' =>
        array(
            'rule1' =>
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Bic swift'
            ),
        ),
        'holders_cc' =>
        array(
            'rule1' =>
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Holders c/c'
            ),
        ),
        'notes' =>
        array(
            'rule1' =>
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Notes'
            ),
        )
    );

}

?>
