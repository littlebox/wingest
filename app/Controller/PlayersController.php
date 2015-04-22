<?php
App::uses('AppController', 'Controller');
/**
 * Players Controller
 *
 * @property Player $Player
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PlayersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'DataTable');


/**
 * index method
 *
 * @return void
 */
	public function index($teamId = null) {

		$this->Player->recursive = 1;

		if(isset($teamId) ){
			$this->paginate = array(
				'recursive' => true,
				'conditions' => array('Team.id' => $teamId)
			);
		}else{
			$this->paginate = array(
				'recursive' => true,
				'conditions' => array('Player.name !=' => '')
			);
		}

		// $this->set('players', $this->Paginator->paginate());

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('teamId', $teamId);
		$this->set('_serialize','response');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Player->exists($id)) {
			throw new NotFoundException(__('Invalid player'));
		}
		$options = array('conditions' => array('Player.' . $this->Player->primaryKey => $id));
		$this->set('player', $this->Player->find('first', $options));
	}

	public function export() {
		$this->response->download("jugadores.csv");
		$data = $this->Player->find('all',
			array(
				'conditions' => array(
					'Player.name !=' => ''
				)
			)
		);

		$this->set(compact('data'));
		$this->layout = 'ajax';
		return;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Player->create();
			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Player->exists($id)) {
			throw new NotFoundException(__('Invalid player'));
		}
		if ($this->request->is(array('post', 'put'))) {

			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved.'),'metrobox/flash_success');

				//redirect to players view if we come from there
				if(strrpos($this->request->data['Referer'],'players')){
					return $this->redirect($this->request->data['Referer']);
				}else{
					return $this->redirect(array('controller' => 'players', 'action' => 'index'));
				}

			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'),'metrobox/flash_danger');
			}
		} else {
			$options = array('conditions' => array('Player.' . $this->Player->primaryKey => $id));
			$this->request->data = $this->Player->find('first', $options);
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Player->id = $id;

		if($this->request->is('ajax')){

			$data = array(
				'content' => '',
				'error' => '',
			);

			if (!$this->Player->exists()) {
				$data['error'] = __('Invalid Team');
				return;
			}else{

				$player = $this->Player->find('first', array(
					'fields' => array('Player.id'),
					'conditions' => array('Player.id' => $id),
					'contain' => false,
				));


				$cleanPlayer = array(
					'Player' => array(
						'dni' => '',
						'name' => '',
						'last_name' => '',
						'nickname' => '',
						'position' => '',
						'shirt_number' => '',
						'email' => '',
						'birthday' => '',
						'phone' => '',
						'facebook' => '')
					);

				$player = array_merge_recursive($player, $cleanPlayer);

				if ($this->Player->save($player)) {
					$data['content'] = __('Player deleted');
				} else {
					$data['error'] = __('Player was not deleted');
				}

				$this->set(compact('data')); // Pass $data to the view
				$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
			}
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Player->recursive = 0;
		$this->set('players', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Player->exists($id)) {
			throw new NotFoundException(__('Invalid player'));
		}
		$options = array('conditions' => array('Player.' . $this->Player->primaryKey => $id));
		$this->set('player', $this->Player->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Player->create();
			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Player->exists($id)) {
			throw new NotFoundException(__('Invalid player'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Player.' . $this->Player->primaryKey => $id));
			$this->request->data = $this->Player->find('first', $options);
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Player->id = $id;
		if (!$this->Player->exists()) {
			throw new NotFoundException(__('Invalid player'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Player->delete()) {
			$this->Session->setFlash(__('The player has been deleted.'));
		} else {
			$this->Session->setFlash(__('The player could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');
		$this->layout = 'metrobox';
	}

}
