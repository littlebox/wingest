<?php
App::uses('AppModel', 'Model');
/**
 * Match Model
 *
 * @property Zone $Zone
 * @property Playoffs $Playoffs
 * @property MatchType $MatchType
 * @property Team1 $Team1
 * @property Team2 $Team2
 * @property Booking $Booking
 * @property Goal $Goal
 */
class Match extends AppModel {

	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Zone' => array(
			'className' => 'Zone',
			'foreignKey' => 'zone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Playoff' => array(
			'className' => 'Playoff',
			'foreignKey' => 'playoff_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MatchType' => array(
			'className' => 'MatchType',
			'foreignKey' => 'match_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TeamLocal' => array(
			'className' => 'Team',
			'foreignKey' => 'team1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TeamVisitor' => array(
			'className' => 'Team',
			'foreignKey' => 'team2_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Round' => array(
			'className' => 'Round',
			'foreignKey' => 'round_id',
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
			'foreignKey' => 'match_id',
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
			'foreignKey' => 'match_id',
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
		//This is MATCHES PLAYERS!!!!!
		'PlayersShirtNumber' => array(
			'className' => 'MatchesPlayers',
			'foreignKey' => 'match_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => array(
				'id',
				'player_id',
				'shirt_number',
			),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		),
		'BookingsByPlayer' => array(
			'className' => 'Booking',
			'foreignKey' => 'match_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT
				COUNT(*) as `BookingsByPlayer__TotalBookings`,
				`BookingsByPlayer`.`match_id`,
				`BookingsByPlayer`.`player_id`,
				`BookingsByPlayer`.`booking_type_id`
				FROM `bookings` AS `BookingsByPlayer`
				WHERE `BookingsByPlayer`.`match_id` = {$__cakeID__$}
				GROUP BY `BookingsByPlayer`.`player_id`,`BookingsByPlayer`.`booking_type_id`',
			'counterQuery' => ''
		),
		'GoalsByPlayer' => array(
			'className' => 'Goal',
			'foreignKey' => 'match_id',
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
				`GoalsByPlayer`.`player_id`,
				`GoalsByPlayer`.`own_goal`
				FROM `goals` AS `GoalsByPlayer`
				WHERE `GoalsByPlayer`.`match_id` = {$__cakeID__$}
				GROUP BY `GoalsByPlayer`.`player_id`,`GoalsByPlayer`.`own_goal`',
			'counterQuery' => ''
		)
	);

}
