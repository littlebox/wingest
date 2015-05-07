<?php
App::uses('AppModel', 'Model');
/**
 * Player Model
 *
 * @property Team $Team
 * @property Booking $Booking
 * @property Goal $Goal
 */
class Player extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
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
		'Booking' => array(
			'className' => 'Booking',
			'foreignKey' => 'player_id',
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
		'Goal' => array(
			'className' => 'Goal',
			'foreignKey' => 'player_id',
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
		'ShirtNumber' => array(
			'className' => 'MatchesPlayer',
			'foreignKey' => 'player_id',
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
		'GoalsByPlayer' => array(
			'className' => 'Goal',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT
				COUNT(*) as `GoalsByPlayer__TotalGoals`,
				`GoalsByPlayer`.`match_id`,
				`GoalsByPlayer`.`player_id`
				FROM `goals` AS `GoalsByPlayer`
				WHERE `GoalsByPlayer`.`player_id` = {$__cakeID__$}
				GROUP BY `GoalsByPlayer`.`player_id`',
			'counterQuery' => ''
		)
	);

}
