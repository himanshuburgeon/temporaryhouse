<?php 
class CaptchaComponent extends Object
{
    function startup(&$controller)
    {
        $this->controller = $controller;
    }

    function render()
    {
	//vendor('kcaptcha/kcaptcha');
        App::import('Vendor', 'kcaptcha/kcaptcha');
        $kcaptcha = new KCAPTCHA();
        $this->controller->Session->write('captcha', $kcaptcha->getKeyString());
	//echo "<pre>";print_r($_SESSION('captcha'));die();
    }
}
?>