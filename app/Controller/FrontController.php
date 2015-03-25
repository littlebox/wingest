<?php
App::uses('AppController', 'Controller');

/* Frontend Controller*/
class FrontController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('home','resultados');

		//if is ajax, set layout to false, and retrive only html for container
		$this->layout = ($this->request->header('X-Request-With') == 'XMLHttpRequest') ? false : 'wingest_front';

	}

	public function home(){

		$this->render ('home');

	}

	public function resultados(){

		$this->render('resultados');

	}

}