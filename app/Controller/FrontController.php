<?php
App::uses('AppController', 'Controller');

/* Frontend Controller*/
class FrontController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('home');

		$this->layout = 'wingest_front';
	}

	public function home(){
		// $this->layout = false;
		$this->render ('home');
		// $this->autoRender = false;
	}

}