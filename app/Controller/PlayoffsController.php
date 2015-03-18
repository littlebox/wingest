<?php
App::uses('AppController', 'Controller');
/**
 * Playoffs Controller
 *
 * @property Playoff $Playoff
 * @property PaginatorComponent $Paginator
 */
class PlayoffsController extends AppController {

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
		$this->Playoff->recursive = 0;
		$this->set('playoffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Playoff->exists($id)) {
			throw new NotFoundException(__('Invalid playoff'));
		}
		$options = array('conditions' => array('Playoff.' . $this->Playoff->primaryKey => $id));
		$this->set('playoff', $this->Playoff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Playoff->create();
			if ($this->Playoff->save($this->request->data)) {
				$this->Session->setFlash(__('The playoff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The playoff could not be saved. Please, try again.'));
			}
		}
		$tournaments = $this->Playoff->Tournament->find('list');
		$teams = $this->Playoff->Team->find('list');
		$this->set(compact('tournaments', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Playoff->exists($id)) {
			throw new NotFoundException(__('Invalid playoff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Playoff->save($this->request->data)) {
				$this->Session->setFlash(__('The playoff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The playoff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Playoff.' . $this->Playoff->primaryKey => $id));
			$this->request->data = $this->Playoff->find('first', $options);
		}
		$tournaments = $this->Playoff->Tournament->find('list');
		$teams = $this->Playoff->Team->find('list');
		$this->set(compact('tournaments', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Playoff->id = $id;
		if (!$this->Playoff->exists()) {
			throw new NotFoundException(__('Invalid playoff'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Playoff->delete()) {
			$this->Session->setFlash(__('The playoff has been deleted.'));
		} else {
			$this->Session->setFlash(__('The playoff could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
