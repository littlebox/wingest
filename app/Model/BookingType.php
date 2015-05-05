<?php
App::uses('AppModel', 'Model');
/**
 * BookingType Model
 *
 */

class BookingType extends AppModel {
	public $useDbConfig = 'array';

	public $useTable = false;

	public $records = array(
		array('id' => 1, 'name' => 'Amarilla'),
		array('id' => 2, 'name' => 'Roja'),
		array('id' => 3, 'name' => 'Azul'),
	);
}
