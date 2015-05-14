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

	public function positionTables($id = null){
		$zones = $this->find('all',
			array(
				'containable' => false,
				'fields' => array('id','name'),
				'recursive' => 0,
				'conditions' => array(
					'Tournament.id'=> $id
				)
			));


		$tables = [];
		foreach ($zones as $zone) {
			$tables[$zone['Zone']['id']] = $this->getPositions($zone['Zone']['id']);
		}

		// debug($tables);die();

		return $tables;
	}

	public function getPositions($id = null){
		$this->Team->virtualFields = array(
			'vid' => 0,
			'name' => 0,
			'totalPoints' => 0,
			'playedMatches'=> 0,
			'wonMatches'=> 0,
			'drawMatches'=> 0,
			'lostMatches'=> 0,
			'goalsFavor'=> 0,
			'goalsAgainst'=> 0,
		);
		$positions = $this->Team->query(
			'SELECT
				team_id as Team__vid,
				teams.name as Team__name,
				SUM(team_points) as Team__totalPoints,
				COUNT(*) as Team__playedMatches,
				SUM(team_win) as Team__wonMatches,
				SUM(team_draw) as Team__drawMatches,
				(COUNT(*) - SUM(team_win) - SUM(team_draw)) as Team__lostMatches,
				SUM(team_goalsf) as Team__goalsFavor,
				SUM(team_goalsc) as Team__goalsAgainst
			FROM
			(SELECT
				team1_id as team_id,
				team1_points as team_points,
				team1_win as team_win,
				team1_draw as team_draw,
				team1_goalsf as team_goalsf,
				team1_goalsc as team_goalsc
			FROM (SELECT
				winners.team1_id as team1_id,
				IF(winners.winner = 1,3,IF(winners.winner = 0,1,0)) as team1_points,
				IF(winners.winner = 1,1,0) as team1_win,
				IF(winners.winner = 0,1,0) as team1_draw,
				winners.goals_team1 as team1_goalsf,
				winners.goals_team2 as team1_goalsc
			FROM (
				SELECT
					id,
					team1_id,
					goals_team1,
					goals_team2,
					IF(goals_team1 = goals_team2, 0, IF(goals_team1 > goals_team2, 1, 2 ) ) as winner
					FROM matches
					WHERE compute = 1 AND zone_id = :id
			) as winners) as points
			UNION ALL
			SELECT
				team2_id as team_id,
				team2_points as team_points,
				team2_win as team_win,
				team2_draw as team_draw,
				team2_goalsf as team_goalsf,
				team2_goalsc as team_goalsc
			FROM (SELECT
				winners.team2_id as team2_id,
				IF(winners.winner = 2,3,IF(winners.winner = 0,1,0)) as team2_points,
				IF(winners.winner = 2,1,0) as team2_win,
				IF(winners.winner = 0,1,0) as team2_draw,
				winners.goals_team2 as team2_goalsf,
				winners.goals_team1 as team2_goalsc
				FROM (
					SELECT
						id,
						--team1_id,
						team2_id,
						goals_team2,
						goals_team1,
						IF(goals_team1 = goals_team2, 0, IF(goals_team1 > goals_team2, 1, 2 ) ) as winner
						FROM matches
						WHERE compute = 1 AND zone_id = :id

				) as winners)
			as matches_points)
			as team
			LEFT JOIN teams ON (team.team_id = teams.id)
			GROUP BY Team_id
			ORDER BY Team__totalPoints DESC, Team__playedMatches ASC, Team__playedMatches DESC',
			array('id'=>$id));

		return $positions;
	}

}
