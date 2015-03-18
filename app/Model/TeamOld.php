<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 */
class Team extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

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
		)
	);

}
