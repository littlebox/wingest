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

		if ($this->request->is(array('ajax'))) {
			//Check if request is post or put
			if ($this->request->is('post') || $this->request->is('put')) {

				// debug(json_decode($this->request->data['jsonData'],true));die();

				//Return array
				$data = array(
					'content' => '',
					'error' => '',
				);

				//delete goals and bookings associated to match
				$this->Match->Goal->deleteAll(array('Goal.match_id' => $id));
				$this->Match->Booking->deleteAll(array('Booking.match_id' => $id));
				$this->Match->PlayersShirtNumber->deleteAll(array('PlayersShirtNumber.match_id' => $id));

				//Save new data
				if ( $this->Match->saveAssociated( json_decode($this->request->data['jsonData'],true) ) ) {
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

			$this->layout = 'metrobox';

			$options = array('conditions' => array('Match.' . $this->Match->primaryKey => $id), 'contain' => array(
				'Zone.name',
				'TeamLocal' => array(
					'fields' => array(
						'name',
						'main_shirt_color',
					)
				),
				'TeamVisitor' => array(
					'fields' => array(
						'name',
						'main_shirt_color',
					),
				),
				'TeamLocal.Player' => array(
					'fields' => array(
						'name',
						'last_name'
					),
				),
				'TeamVisitor.Player' =>
					array('fields' => array(
						'name',
						'last_name'
						)
					),
				'Zone.Tournament.players_per_team',
				'PlayersShirtNumber' =>
					array('fields' => array(
						'id',
						'player_id',
						'shirt_number',
						)
					),
				'GoalsByPlayer',
				'BookingsByPlayer',
				'BookingsByPlayer.Type'
			));



			$result = $this->Match->find('first', $options);


			/* Order PlayerShirtNumber by player_id */
			$res = [];
			foreach ($result['PlayersShirtNumber'] as $key => $val) {
				$res[$val['player_id']] = $val;
			}
			$result['PlayersShirtNumber'] = $res;

			/*Order Goals by player_id*/
			$res = [];
			foreach ($result['GoalsByPlayer'] as $key => $val) {
				if(!isset($res[$val['player_id']])){
					$res[$val['player_id']] = [];
				}
				array_push($res[$val['player_id']], $val);
			}
			$result['GoalsByPlayer'] = $res;

			// debug($result);die();
			/*Order Bookings by player_id*/
			$res = [];
			foreach ($result['BookingsByPlayer'] as $key => $val) {
				if(!isset($res[$val['player_id']])){
					$res[$val['player_id']] = [];
				}
				array_push($res[$val['player_id']], $val);
			}
			$result['BookingsByPlayer'] = $res;

			$this->set('match', $result);

		}
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
