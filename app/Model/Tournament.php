<?php
App::uses('AppModel', 'Model');
/**
 * Tournament Model
 *
 * @property Playoff $Playoff
 * @property Team $Team
 * @property Zone $Zone
 */
class Tournament extends AppModel {

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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Playoff' => array(
			'className' => 'Playoff',
			'foreignKey' => 'tournament_id',
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
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'tournament_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Team.name',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Zone' => array(
			'className' => 'Zone',
			'foreignKey' => 'tournament_id',
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
		'RoundZone' => array(
			'className' => 'Round',
			'foreignKey' => 'tournament_id',
			'dependent' => false,
			'conditions' => array('is_playoff' => false),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RoundPlayoff' => array(
			'className' => 'Round',
			'foreignKey' => 'tournament_id',
			'dependent' => false,
			'conditions' => array('is_playoff' => true),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Round' => array(
			'className' => 'Round',
			'foreignKey' => 'tournament_id',
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
