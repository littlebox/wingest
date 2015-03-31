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
class TeamsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'DataTable');

	public function test(){
		$this->Team->contain('Player');
		$this->Team->contain(array('Player','MatchLocal.id'));
		$eq1 = $this->Team->find('first');
		debug($eq1);die();
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'metrobox';
		$this->Team->recursive = 0;

		$this->paginate = array(
			// 'fields' => array(),
			'recursive' => true //lee el de arriba, creo.
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

	public function players_inscription(){

		if(isset($_SESSION['auth']) && $_SESSION['auth']){


			if($this->request->is('post')){


				$teamPicture = $this->request->data['Team']['escudo'];

				if($teamPicture != ''){

					$this->setTeamPicture( $teamPicture, $_SESSION['data']['Team']['id'] );

				}else{
					$this->resetTeamPicture($_SESSION['data']['Team']['id']);
				}


				// debug($this->request->data);die();

				$this->request->data['Team']['id'] = $_SESSION['data']['Team']['id'];

				foreach( $this->request->data['Player'] as $k => $player ){

					$this->request->data['Player'][$k]['id'] = $_SESSION['data']['Team']['id'].str_pad($k, 2, '0', STR_PAD_LEFT);

				}



				if ( $this->Team->saveAssociated($this->request->data) ) {

					$this->Session->setFlash('Los datos fueron guardados!');

					return $this->redirect(array('controller' => 'teams','action' => 'players_inscription'));

				}


			}else{

				$this->layout = 'players_inscription';

				$resultado = $this->Team->find('first', array(
					'contain' => array('Player','Tournament'),
					'conditions' => array(
						'Team.id' => $_SESSION['data']['Team']['id'],
						),
				));

				$this->set('datos', $resultado);

			}

		}else{

			return $this->redirect(array('action' => 'login'));

		}


	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		$this->layout = 'registration';

		if ($this->request->is('post')) {

			//test fc at the end
			$re = "/(FC|F\\.C|F\\.C\\.|FC.)$/i";
			if(preg_match($re, $this->request->data['Team']['name'])){

				$arr = preg_split($re, $this->request->data['Team']['name']);
				$this->request->data['Team']['name'] = $arr[0];

			}

			$this->request->data['Team']['name'] = ucwords(mb_strtolower($this->request->data['Team']['name']));
			$this->request->data['Team']['captain'] = ucwords(mb_strtolower($this->request->data['Team']['captain']));
			$this->request->data['Team']['captain2'] = ucwords(mb_strtolower($this->request->data['Team']['captain2']));
			$this->request->data['Team']['captain_email'] = mb_strtolower($this->request->data['Team']['captain_email']);
			$this->request->data['Team']['captain2_email'] = mb_strtolower($this->request->data['Team']['captain2_email']);
			$this->request->data['Team']['captain_facebook'] = mb_strtolower($this->request->data['Team']['captain_facebook']);
			$this->request->data['Team']['captain2_facebook'] = mb_strtolower($this->request->data['Team']['captain2_facebook']);

			if(!isset($this->request->data['Team']['tournament_id'])){
				$this->request->data['Team']['tournament_id'] = 1;
			}

			$HttpSocket = new HttpSocket();
			// array query
			$results = $HttpSocket->get('https://www.google.com/recaptcha/api/siteverify', array(
				'secret' => '6LezRgETAAAAAPQz-768rOcYiNnx8Mmps_HuC5MG',
				'response' => $this->request->data['g-recaptcha-response'],
				'remoteip' => $this->request->clientIp(),
			));

			$response = json_decode($results['body']);

			if($response->success){

				$this->Team->create();
				if ($this->Team->save($this->request->data)) {
					$this->Session->setFlash(__('The team has been saved.'));

					// $Email = new CakeEmail();
					// $Email->template('preinscripcion')
					// 	->emailFormat('html')
					// 	->viewVars($this->request->data)
					// 	->from(array('inscripciones@torneowingest.com' => 'Inscripciones TW'))
					// 	->to(array('info@torneowingest.com','luciano@littlebox.com.ar'))
					// 	->subject('Nueva Preinscripcion')
					// 	->send();

					return $this->redirect(array('controller' => 'pages','action' => 'thanks'));

				} else {
					$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
				}

			}else{
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
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
		return $this->redirect(array('action' => 'admin_edit'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('The team has been deleted.'));
		} else {
			$this->Session->setFlash(__('The team could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		return $this->redirect(array('action' => 'index', 'admin' => false));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->layout = 'metrobox';
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$team = $this->Team->find('first', array('conditions' => array('Team.id' => $id)) );

			if(!isset($this->request->data['Team']['password'])){
				$this->request->data['Team']['password'] = $team['Team']['password'];
			}

			$this->request->data['Team']['id'] = $id;
			$this->request->data['Team']['nepass'] = $this->request->data['Team']['password'];
			$this->request->data['Team']['password'] = password_hash($this->request->data['Team']['password'], PASSWORD_DEFAULT);

			if ($this->Team->save($this->request->data)) {


				if($this->request->data['Team']['nepass'] != ''){
					$Email = new CakeEmail();
						$Email->template('passwordTeam')
							->emailFormat('html')
							->viewVars($this->request->data)
							->from(array('inscripciones@torneowingest.com' => 'Inscripciones TW'))
							->to(array('info@torneowingest.com',$team['Team']['captain_email'],'luciano@littlebox.com.ar'))
							->subject('Cambio de password - Torneo Wingest')
							->send();
					$this->Session->setFlash(__('Se le envió un mail al captain del equipo con su nueva contraseña.'),'metrobox/flash_success');
				}else{
					$this->Session->setFlash(__('The team has been saved.'),'metrobox/flash_success');
				}
				// debug($this->request->data['Team']['password']);die();

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$tournaments = $this->Team->Tournament->find('list');
			$this->set(compact('tournaments'));
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id), 'recursive' => 2);
			$this->request->data = $this->Team->find('first', $options);
			$this->request->data['Team']['password'] = '';
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('The team has been deleted.'));
		} else {
			$this->Session->setFlash(__('The team could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function login(){
		$this->layout = 'metrobox_login_players';

		if($this->request->is('post')){

			$data = $this->Team->find('first', array(
				'recursive' => 2,
				'conditions' => array(
					'Team.name' => $this->request->data['Team']['name'],
					)
			));

			// debug($data);die();

			if(isset($data['Team']['password']) && password_verify($this->request->data['Team']['password'],$data['Team']['password'])){

				if (!isset($_SESSION['auth'])) {
					$_SESSION['auth'] = true;
					$_SESSION['data'] = $data;
				}

				return $this->redirect(array('action' => 'players_inscription'));

			}else{
				$this->Session->setFlash(__('El nombre del equipo o el password son incorrectos :('),'metrobox/flash_danger');
				return $this->redirect(array('action' => 'login'));
			}

		}elseif(isset($_SESSION['auth']) && $_SESSION['auth']){
			return $this->redirect(array('action' => 'players_inscription'));
		}

	}

	public function logout(){
		session_destroy();
		return $this->redirect(array('action' => 'login'));
	}

	protected function setTeamPicture($profile_picture, $user_id){

		$src = $profile_picture['tmp_name'];

		if (is_uploaded_file($src)) {

			$img_info = getimagesize($src);

			switch ($img_info[2]) {
				case IMAGETYPE_JPEG : $image = imagecreatefromjpeg($src); break;
				case IMAGETYPE_GIF: $image = imagecreatefromgif($src);break;
				case IMAGETYPE_PNG: $image = imagecreatefrompng($src);break;
			}

			imagejpeg($image, WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.$_SESSION['data']['Team']['name'].'.jpg');
		}

	}

	protected function resetTeamPicture(){
		copy(WWW_ROOT.'img'.DS.'logotwform.jpg', WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.$_SESSION['data']['Team']['name'].'.jpg');
	}

	public function beforeFilter() {

		parent::beforeFilter();
		$this->Auth->allow(array('add','login','logout','players_inscription'));
		// $this->Auth->deny(array('index'));
	}
}
