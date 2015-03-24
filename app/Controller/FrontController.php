<?php
App::uses('AppController', 'Controller');

/* Frontend Controller*/
class FrontController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('home','resultados');

		$this->layout = ($this->request->header('X-Request-With') == 'XMLHttpRequest')?false:'wingest_front';

		// debug($this->request->header('X-Request-With'));die();

	}

	public function home(){
		// $this->layout = false;
		$this->render ('home');
		// $this->autoRender = false;
	}

	public function resultados(){
		echo 'asdf';
		$this->autoRender = false;
	}

}