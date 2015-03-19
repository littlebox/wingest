<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property Tournament $Tournament
 * @property Player $Player
 * @property Match $Match
 * @property Match $Match
 * @property Playoff $Playoff
 * @property Zone $Zone
 */
class Team extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//Activa el comportamiento containable
	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre del equipo no puede estar vacio',
			),
			'unique' => array(
				'on' => 'create',
				'rule' => 'isUnique',
				'message' => 'Este nombre de equipo ya fue usado'
			),
		),
		'captain' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre del delegado no puede estar vacio',
			)
		),
		'captain2' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre del delegado no puede estar vacio',
			)
		),

		'captain_email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email invalido',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Este email ya fue usado'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El email no puede estar vacio',
			)
		),

		'captain2_email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email invalido',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Este email ya fue usado'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El email no puede estar vacio',
			)
		),

		// 'captain_phone' => array(
		// 	'numeric' => array(
		// 		'rule' => array('numeric'),
		// 		'message' => 'El celular debe ser un número',
		// 	)
		// ),
		// 'captain2_phone' => array(
		// 	'numeric' => array(
		// 		'rule' => array('numeric'),
		// 		'message' => 'El celular debe ser un número',
		// 	)
		// ),
		// 'tournament_id' => array(
		// 	'between' => array(
		// 		'rule' => array('between',1,3),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'has_shirts' => array(
		// 	'boolean' => array(
		// 		'rule' => array('boolean'),
		// 		//'message' => 'Your custom message here',
		// 		'allowEmpty' => false,
		// 		'required' => true,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tournament' => array(
			'className' => 'Tournament',
			'foreignKey' => 'tournament_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Player' => array(
			'className' => 'Player',
			'foreignKey' => 'team_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MatchLocal' => array(
			'className' => 'Match',
			'foreignKey' => 'team1_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MatchVisitor' => array(
			'className' => 'Match',
			'foreignKey' => 'team2_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Playoff' => array(
			'className' => 'Playoff',
			'joinTable' => 'playoffs_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'playoff_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Zone' => array(
			'className' => 'Zone',
			'joinTable' => 'zones_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'zone_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
