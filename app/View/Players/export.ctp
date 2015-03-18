<?php

	// debug($data);die();

	$cs = ';'; //csv separator

	$str = 'Nombre'.$cs.'Apellido'.$cs.'Equipo'.$cs.'Email'.$cs.'Dni'.$cs.'Posicion'.$cs.'Fecha de Nacimiento'.$cs.'Celular'.$cs.'Facebook'."\n";


	foreach ($data as $row):

		// debug($row['Player']['name']);
		$datos = array(
			'Nombre' => ucfirst(strtolower($row['Player']['name'])),
			'Apellido' => ucfirst(strtolower($row['Player']['last_name'])),
			'Equipo' => ucfirst(strtolower($row['Team']['name'])),
			'Email' => $row['Player']['email'],
			'Dni' => $row['Player']['dni'],
			'Posicion' => strtoupper($row['Player']['position']),
			'Fecha de Nacimiento' => $row['Player']['birthday'],
			'Celular' => $row['Player']['phone'],
			'Facebook' => $row['Player']['facebook'],
		);

		foreach ($datos as $k => $v):

			$str .= $v.$cs;

		endforeach;

		$str .= "\n";



		// foreach ($row['Player'] as &$cell):
		// 	$cell = '"' . preg_replace('/"/','""',$cell) . '"';
		// endforeach;

		// echo implode(';', $row['Player']) . "\n";

	endforeach;
	echo($str);
	// die();
?>