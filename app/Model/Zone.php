<?php
App::uses('AppModel', 'Model');
/**
 * Zone Model
 *
 * @property Tournament $Tournament
 * @property Match $Match
 * @property Team $Team
 */
class Zone extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

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
		'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'zone_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('date' => 'ASC','time' => 'ASC'),
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
		'Team' => array(
			'className' => 'Team',
			'joinTable' => 'zones_teams',
			'foreignKey' => 'zone_id',
			'associationForeignKey' => 'team_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public function positionTable($id = null){
		$zones = $this->find('all',array('containable' => false,'fields' => array('id'),'recursive' => 0));

		$positions = [];
		foreach ($zones as $zone) {
			$positions[] = $this->getPositions($zone['Zone']['id']);
		}

		return $positions;
	}

	public function getPositions($id = null){
		$this->Team->virtualFields = array(
			'id' => 0,
			'totalPoints' => 0,
			'playedMatches'=> 0,
			'winMatches'=> 0,
			'drawMatches'=> 0,
		);
		$position = $this->Team->query(
			'SELECT
				team_id as Team__id,
				SUM(team_points) as Team__totalPoints,
				COUNT(*) as Team__playedMatches,
				SUM(team_win) as Team__winMatches,
				SUM(team_draw) as Team__drawMatches
			FROM
			(SELECT
				team1_id as team_id,
				team1_points as team_points,
				team1_win as team_win,
				team1_draw as team_draw
			FROM (SELECT
				winners.team1_id as team1_id,
				IF(winners.winner = 1,3,IF(winners.winner = 0,1,0)) as team1_points,
				IF(winners.winner = 1,1,0) as team1_win,
				IF(winners.winner = 0,1,0) as team1_draw
			FROM (
				SELECT
					id,
					team1_id,
					team2_id,
					IF(
						goals_team1 = goals_team2,
						0,
						IF(
							goals_team1 > goals_team2,
							1,
							2
						  )
						) as winner
					FROM matches
					WHERE compute = 1 AND zone_id = :id
			) as winners) as points
			UNION ALL
			SELECT
				team2_id as team_id,
				team2_points as team_points,
				team2_win as team_win,
				team2_draw as team_draw
			FROM (SELECT
				winners.team2_id as team2_id,
				IF(winners.winner = 2,3,IF(winners.winner = 0,1,0)) as team2_points,
				IF(winners.winner = 2,1,0) as team2_win,
				IF(winners.winner = 0,1,0) as team2_draw
			FROM (
				SELECT
					id,
					team1_id,
					team2_id,
					IF(
						goals_team1 = goals_team2,
						0,
						IF(
							goals_team1 > goals_team2,
							1,
							2
						  )
						) as winner
					FROM matches
					WHERE compute = 1 AND zone_id = :id

			) as winners) as matches_points) as team
			GROUP BY Team_id
			ORDER BY Team__totalPoints DESC, Team__playedMatches ASC, Team__playedMatches DESC',
			array('id'=>$id));
		return $position;
	}

}
