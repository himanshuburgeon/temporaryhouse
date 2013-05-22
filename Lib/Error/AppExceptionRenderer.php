<?php
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
	public function missingController($error) {
		$this->controller->beforeFilter();
        $this->controller->header('HTTP/1.1 404 Not Found');
        $this->controller->render('/Errors/error400', 'default');
        $this->controller->response->send();
    }
    public function missingAction($error) {
		$this->controller->beforeFilter();
        $this->controller->header('HTTP/1.1 404 Not Found');
        $this->controller->render('/Errors/error400', 'default');
        $this->controller->response->send();
    }

    public function notFound($error) {
		echo "HimanshuNF";die;
       // $this->controller->redirect(array('controller' => 'errors', 'action' => 'error404'));
    }
}

?>
