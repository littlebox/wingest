<?php
App::uses('AppController', 'Controller');
/**
 * Tournaments Controller
 *
 * @property Tournament $Tournament
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TournamentsController extends AppController {

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
	public function index() {
		$this->layout = 'metrobox';

		$this->paginate = array(
			'fields' => array('id','name','players_per_team'),
			'contain' => false, //Only brings Tournaments, whitout any asociated model
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
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
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
		$this->set('tournament', $this->Tournament->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Tournament->create();
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'metrobox';

		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		} else {
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
			$this->request->data = $this->Tournament->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			$this->Tournament->id = $id;
			if (!$this->Tournament->exists()) {
				$data['error'] = __('Invalid Tournament');
			} else {
				if ($this->Tournament->delete()) {
					$data['content'] = __('Tournament deleted');
				} else {
					$data['error'] = __('Tournament was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Tournament->id = $id;
			if (!$this->Tournament->exists()) {
				throw new NotFoundException(__('Invalid Tournament'));
			}
			if ($this->Tournament->delete()) {
				$this->Session->setFlash(__('Tournament deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Tournament was not deleted'), 'metrobox/flash_danger');
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function schedule_stages ($id = null) {
		$this->layout = 'metrobox';

		if ($this->request->is(array('post', 'put'))) {
			if (!$this->Tournament->exists($id)) {
				throw new NotFoundException(__('Invalid tournament'));
			}

			//Set tournament ID to save groups asociated to it.
			$this->request->data['Tournament']['id'] = $id;
			$this->request->data['Zone'] = [];

			$groupName = "A";

			//Leer datos y crear grupos y Playoffs
			for ($i=0; $i < intval($this->request->data['Tournament']['number_of_zones']); $i++) {
				$this->request->data['Zone'][$i]['name'] = $groupName;
				$groupName++; //Next letter in the abc
			}

			//Guardamos los datos
			if ( $this->Tournament->saveAssociated($this->request->data) ) {
				$this->Session->setFlash(__('Stages were sheduled.'), 'metrobox/flash_success');
			} else {
				$this->Session->setFlash(__('A problem happened whe try to schedule stages'), 'metrobox/flash_danger');
			}
			return $this->redirect(array('controller' => 'tournaments','action' => 'index'));
		} else {
			//Lleva los
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id), 'contain' => false);
			$this->request->data = $this->Tournament->find('first', $options);
		}

	}

	public function schedule_zones ($id = null) {
		//Check if Tournament exist
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}

		$this->layout = 'metrobox';

		if ($this->request->is(array('ajax'))) {
			//Check if request is post or put
			if ($this->request->is('post') || $this->request->is('put')) {

				$this->loadModel('Zone');

				//Return array
				$data = array(
					'content' => '',
					'error' => '',
				);

				$jsonDecoded = json_decode($this->request->data['Tournament']['json'], true);

				if ( $this->Zone->saveAll($jsonDecoded) ) {
					$data['content'] = __('The changes has been saved');
				}else{
					$data['error'] = __('The changes could not be saved. Please, try again.');
				}

				$this->set(compact('data')); // Pass $data to the view
				$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use


			} else {
				throw new BadRequestException(__('Invalid request type (has to be post or put)'));
			}
		} else {
			//Si la consulta no es AJAZ, devuelve los TOrneos, equipos y zonas para msotrar en la vista
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id), 'contain' => array('Team.id','Team.name','Zone.id','Zone.name','Zone.Team' => array('fields' => array('id', 'name'))));
			$this->set('tournament', $this->Tournament->find('first', $options));
		}

	}


	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'metrobox';

	}

}