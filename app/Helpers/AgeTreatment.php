<?php namespace App\Helpers;

use \DateTime;

class AgeTreatment
{
	public static function birthdate($data)
	{
		if(!$data)
			return '?';

		list($dia, $mes, $ano) = explode('/', $data);

		$date = new DateTime( $ano .'-'. $mes  .'-'. $dia ); // data de nascimento
		$interval = $date->diff( new DateTime( 'now' ) ); // data definida

		return $interval->format( '%Y Anos, %m Meses e %d Dias' );
	}

}



