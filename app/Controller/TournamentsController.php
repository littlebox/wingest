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
		//debug($this->DataTable->getResponse());die();
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
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}

		if ($this->request->is(array('post', 'put'))) {

			// debug($this->request->data);die();

			$number_of_teams = $this->request->data['Tournament']['number_of_teams'];
			$number_of_zones = $this->request->data['Tournament']['number_of_zones'];

			$this->request->data['Round'] = [];

			//Bring count of existing zones to compare if user change it
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id) ,'contain' => array('Zone', 'Playoff', 'Round', 'Tournament'));
			$savedNumberOfZones = $this->Tournament->Zone->find('count', array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id) ,'contain' => array('Tournament')));
			$savedNumberOfPlayoffs = $this->Tournament->Playoff->find('count', $options);

			//Set tournament ID to save groups asociated to it.
			$this->request->data['Tournament']['id'] = $id;

			//If user changed zones, we delete all existing zones and create newones
			if($savedNumberOfZones != $this->request->data['Tournament']['number_of_zones'] || $this->request->data['Tournament']['zone_home_and_away_matches'] != $this->request->data['Tournament']['zone_home_and_away_matches_changed']){
				$this->Tournament->Zone->deleteAll(array('Tournament.' . $this->Tournament->primaryKey => $id));
				$this->Tournament->Round->deleteAll(array('Tournament.' . $this->Tournament->primaryKey => $id, 'is_playoff' => false));

				$this->request->data['Zone'] = [];

				$groupName = "A";

				//Leer datos y crear grupos y Playoffs
				for ($i=0; $i < intval($this->request->data['Tournament']['number_of_zones']); $i++) {
					$this->request->data['Zone'][$i]['name'] = $groupName;
					$groupName++; //Next letter in the abc
				}

				//Crear Rounds
				//If the number of teams is odd, we add one team, the ghost team
				$teams_per_zone = (($number_of_teams/$number_of_zones)%2)?$number_of_teams/$number_of_zones+1:$number_of_teams/$number_of_zones;
				$number_of_rounds = $teams_per_zone - 1;

				if($this->request->data['Tournament']['zone_home_and_away_matches']){
					$number_of_rounds *= 2;
				}

				for($i=1; $i <= $number_of_rounds; $i++){
					$this->request->data['Round'][$i]['name'] = 'Round '.$i;
					$this->request->data['Round'][$i]['is_playoff'] = false;
				}

				// debug($number_of_rounds);die();

			}

			//If user changed playoffs
			if($this->request->data['Tournament']['playoffs_number_changed'] === 'true'){
				//delete existing playoffs and rounds
				$this->Tournament->Playoff->deleteAll(array('Tournament.' . $this->Tournament->primaryKey => $id));
				$this->Tournament->Round->deleteAll(array('Tournament.' . $this->Tournament->primaryKey => $id, 'is_playoff' => true));

				$round_names = array(2 => 'Final', 4 => 'Semifinal', 8 => 'Cuartos', 16 => 'Octavos');

				foreach($this->request->data['Playoff'] as $playoff){

					if(!$playoff['home_and_away_matches']){

						for($i = $playoff['number_of_teams']; $i >= 2; $i /= 2){

							if(isset($round_names[$i])){
								array_push($this->request->data['Round'], array(
									'name' => $round_names[$i].' - '.$playoff['name'],
									'is_playoff' => true,
								));
							}else{
								array_push($this->request->data['Round'], array(
									'name' => ($i/2).'-avos - '.$playoff['name'],
									'is_playoff' => true,
								));
							}

						}


					}else{

						for($i = $playoff['number_of_teams']; $i >= 2; $i /= 2){

							if(isset($round_names[$i])){
								array_push($this->request->data['Round'], array(
									'name' => $round_names[$i].' Ida - '.$playoff['name'],
									'is_playoff' => true,
								));
								array_push($this->request->data['Round'], array(
									'name' => $round_names[$i].' Vuelta - '.$playoff['name'],
									'is_playoff' => true,
								));
							}else{
								array_push($this->request->data['Round'], array(
									'name' => ($i/2).'-avos Ida - '.$playoff['name'],
									'is_playoff' => true,
								));
								array_push($this->request->data['Round'], array(
									'name' => ($i/2).'-avos Vuelta - '.$playoff['name'],
									'is_playoff' => true,
								));
							}

						}

					}

				}

			}

			// debug($this->request->data);die();

			//Guardamos los datos
			if ( $this->Tournament->saveAssociated($this->request->data) ) {
				$this->Session->setFlash(__('Stages were sheduled.'), 'metrobox/flash_success');
			} else {
				$this->Session->setFlash(__('A problem happened whe try to schedule stages'), 'metrobox/flash_danger');
			}
			return $this->redirect(array('controller' => 'tournaments','action' => 'index'));
		} else {

			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id) , 'contain' => array('Playoff'));
			$this->request->data = $this->Tournament->find('first', $options);

			$this->request->data['Tournament']['actual_number_of_zones'] = $this->Tournament->Zone->find('count', array('conditions' => array('Tournament.id'=> $id)));
			$this->request->data['Tournament']['number_of_playoffs'] = $this->Tournament->Playoff->find('count', $options);
			$this->request->data['Tournament']['actual_number_of_playoffs'] = $this->request->data['Tournament']['number_of_playoffs'];

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
			//Si la consulta no es AJAX, devuelve los Torneos, equipos y zonas para mostrar en la vista
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id), 'contain' => array('Team.id','Team.name','Team.main_shirt_color','Team.secondary_shirt_color','Zone.id','Zone.name','Zone.Team' => array('fields' => array('id', 'name','main_shirt_color','secondary_shirt_color'))));
			$this->set('tournament', $this->Tournament->find('first', $options));
			$this->set('id', $id);
		}

	}

	public function schedule_matches($id = null){
		//Check if Tournament exist
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}

		$this->layout = 'metrobox';

		if ($this->request->is(array('ajax'))) {
			//Check if request is post or put
			if ($this->request->is('post') || $this->request->is('put')) {

				$this->loadModel('Match');

				//Return array
				$data = array(
					'content' => '',
					'error' => '',
				);

				$jsonDecoded = json_decode($this->request->data['Tournament']['json'], true);

				if ( $this->Match->saveAll($jsonDecoded) ) {
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
			//Si la consulta no es AJAX, devuelve los Torneos, equipos y zonas para mostrar en la vista
			$options = array(
				'conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id),
				'contain' => array(
					'Zone.id',
					'Zone.name',
					'Zone.Match' => array(
						'fields' => array(
							'id',
							'zone_id',
							'playoff_id',
							'round_id',
							'match_type_id',
							'team1_id',
							'team2_id',
							'date',
							'time',
							'field',
						)
					),
					'Zone.Match.TeamLocal' => array(
						'fields' => array(
							'id',
							'name',
							'main_shirt_color',
							'secondary_shirt_color'
						)
					),
					'Zone.Match.TeamVisitor' => array(
						'fields' => array(
							'id',
							'name',
							'main_shirt_color',
							'secondary_shirt_color'
						)
					),
					'Playoff.id',
					'Playoff.name',
					'Playoff.Match.MatchType',
					'Playoff.Match.TeamLocal' => array(
						'fields' => array(
							'id',
							'name',
							'main_shirt_color',
							'secondary_shirt_color'
						)
					),
					'Playoff.Match.TeamVisitor' => array(
						'fields' => array(
							'id',
							'name',
							'main_shirt_color',
							'secondary_shirt_color'
						)
					),
					'RoundZone'=> array(
						'fields' => array(
							'id',
							'name',
							'start_date',
							'end_date',
						)
					),
					'RoundPlayoff'=> array(
						'fields' => array(
							'id',
							'name',
							'start_date',
							'end_date',
						),
					)
				),
				// 'order' => array('Zone.Match.date DESC'),
			);
			// debug($this->Tournament->find('first', $options));die();
			$this->set('tournament', $this->Tournament->find('first', $options));
		}
	}

	//create new matches
	public function generate_zone_matches($id = null){

		if ($this->request->is(array('ajax'))) {

			$this->autoRender = false;

			$matches = [];

			//Delete all matches of tournament
			$this->Tournament->Zone->Match->deleteAll(array('Zone.tournament_id' => $id));

			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id) ,'contain' => array('Tournament.id','Tournament.zone_home_and_away_matches','Team.id','Team.name'));
			$zones = $this->Tournament->Zone->find('all',$options);

			$rounds = $this->Tournament->Round->find('all', array(
				'conditions' => array( 'tournament_id' => $id ) ,
				'contain' => 'Tournament.id',
				'fields' => array('tournament_id')
				)
			);

			// debug($rounds);die();

			foreach($zones as $zone){
				if(!$zone['Tournament']['zone_home_and_away_matches']){
					foreach($zone['Team'] as $k=>$team){
						for($i = $k+1; $i <= (count($zone['Team']) - 1 ); $i++ ){

							array_push($matches, array(
								'team1_id' => $zone['Team'][$k]['id'],
								'team2_id' => $zone['Team'][$i]['id'],
								'zone_id' => $zone['Zone']['id'],
								'match_type_id' => 1,
								)
							);

						}
					}
				}else{
					foreach($zone['Team'] as $k=>$team){
						for($i = $k+1; $i <= (count($zone['Team']) - 1 ); $i++ ){

							array_push($matches, array(
								'team1_id' => $zone['Team'][$k]['id'],
								'team2_id' => $zone['Team'][$i]['id'],
								'zone_id' => $zone['Zone']['id'],
								'match_type_id' => 1,
								)
							);

							array_push($matches, array(
								'team2_id' => $zone['Team'][$k]['id'],
								'team1_id' => $zone['Team'][$i]['id'],
								'zone_id' => $zone['Zone']['id'],
								'match_type_id' => 1,
								)
							);

						}
					}
				}
			}

			//Save new matches
			$response = [];
			if($this->Tournament->Zone->Match->saveMany($matches)){
				$response['success'] = __('The matches have been generated succesfully!');
			}else{
				$response['error'] = __('There was some error');
			}

			echo json_encode($response);

		}
	}

	public function schedule_rounds($id = null){

		//Check if Tournament exist
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}

		if ($this->request->is(array('ajax'))) {

			$this->loadModel('Round');

			if ($this->request->is('post') || $this->request->is('put')) {

				//set date format for database
				foreach($this->request->data as &$round){ //pass variable by reference
					if(!empty($round['Round']['start_date'])){
						$round['Round']['start_date'] = str_replace('/','-',$round['Round']['start_date']);
						$round['Round']['start_date'] = date('Y-m-d',strtotime($round['Round']['start_date']));
					}
					if(!empty($round['Round']['end_date'])){
						$round['Round']['end_date'] = str_replace('/','-',$round['Round']['end_date']);
						$round['Round']['end_date'] = date('Y-m-d',strtotime($round['Round']['end_date']));
					}
				}

				if( $this->Round->saveMany($this->request->data) ){
					$data['content'] = __('The changes has been saved');
				}else{
					$data['error'] = __('The changes could not be saved. Please, try again.');
				}

				$this->set(compact('data'));
				$this->set('_serialize', 'data');

			}

		}else{

			$this->layout = 'metrobox';

			$rounds = [];

			$rounds['playoff'] = $this->Tournament->RoundPlayoff->find('all', array(
				'conditions' => array(
					'tournament_id' => $id,
					'is_playoff' => true,
				),
				'fields' => array(
					'id',
					'name',
					'start_date',
					'end_date',
					'is_playoff',
					'tournament_id',
				),
				'contain' => false,
			));

			$rounds['not_playoff'] = $this->Tournament->RoundZone->find('all', array(
				'conditions' => array(
					'tournament_id' => $id,
					'is_playoff' => false,
				),
				'fields' => array(
					'id',
					'name',
					'start_date',
					'end_date',
					'is_playoff',
					'tournament_id',
				),
				'contain' => false,
			));

			$this->set('rounds', $rounds);

		}

	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'metrobox';

	}

}