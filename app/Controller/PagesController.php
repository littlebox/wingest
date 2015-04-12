<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
/**
 * Teams Controller
 *
 * @property Team $Team
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','DataTable');

	public function thanks(){
		$this->layout = 'thanks';
	}

	public function index(){
		$this->layout = 'placa';
	}

	public function home(){
		$this->layout = 'metrobox';
		$Team = ClassRegistry::init('Team');
		$Player = ClassRegistry::init('Player');

		$cantEquiposMasc = $Team->find('count',array('conditions' => array('Team.tournament_id' => 1)));
		$cantEquiposFemAm = $Team->find('count',array('conditions' => array('Team.tournament_id' => 2)));
		$cantEquiposFemPro = $Team->find('count',array('conditions' => array('Team.tournament_id' => 3)));
		$cantJugadores = $Player->find('count',array('conditions' => array('Player.name !=' => '')));

		$this->set('data', compact('cantJugadores','cantEquiposMasc','cantEquiposFemPro','cantEquiposFemAm'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('thanks','index'));
	}
}

