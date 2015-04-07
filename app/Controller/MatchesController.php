<?php
App::uses('AppController', 'Controller');
/**
 * Matches Controller
 *
 * @property Match $Match
 * @property PaginatorComponent $Paginator
 */
class MatchesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Match->exists($id)) {
			throw new NotFoundException(__('Invalid match'));
		}
		$options = array('conditions' => array('Match.' . $this->Match->primaryKey => $id), 'contain' => array(
			'Zone.name',
			'TeamLocal.name',
			'TeamVisitor.name',
			'TeamLocal.Player.name',
			'TeamLocal.Player.last_name',
			'TeamVisitor.Player.name',
			'TeamVisitor.Player.last_name',
			'Goal',
			'Booking',
		));
		$this->set('match', $this->Match->find('first', $options));

		$this->layout = 'metrobox';

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Match->create();
			if ($this->Match->save($this->request->data)) {
				$this->Session->setFlash(__('The match has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.'));
			}
		}
		$zones = $this->Match->Zone->find('list');
		$playoffs = $this->Match->Playoff->find('list');
		$matchTypes = $this->Match->MatchType->find('list');
		$team1s = $this->Match->Team1->find('list');
		$team2s = $this->Match->Team2->find('list');
		$this->set(compact('zones', 'playoffs', 'matchTypes', 'team1s', 'team2s'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Match->exists($id)) {
			throw new NotFoundException(__('Invalid match'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Match->save($this->request->data)) {
				$this->Session->setFlash(__('The match has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Match.' . $this->Match->primaryKey => $id));
			$this->request->data = $this->Match->find('first', $options);
		}
		$zones = $this->Match->Zone->find('list');
		$playoffs = $this->Match->Playoff->find('list');
		$matchTypes = $this->Match->MatchType->find('list');
		$team1s = $this->Match->Team1->find('list');
		$team2s = $this->Match->Team2->find('list');
		$this->set(compact('zones', 'playoffs', 'matchTypes', 'team1s', 'team2s'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Match->id = $id;
		if (!$this->Match->exists()) {
			throw new NotFoundException(__('Invalid match'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Match->delete()) {
			$this->Session->setFlash(__('The match has been deleted.'));
		} else {
			$this->Session->setFlash(__('The match could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
