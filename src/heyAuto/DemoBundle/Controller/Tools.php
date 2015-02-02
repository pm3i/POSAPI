<?php

namespace heyAuto\DemoBundle\Controller;


use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;



class Tools {

    /**
     * return array
     */
    public function getAddress($lat, $lng) {

		$url 	= 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
		$json 	= @file_get_contents($url);
		$data 	= json_decode($json);
		$status = $data->status;

		if($status == "OK")
			return $data->results[0]->formatted_address;
		else return false;
	}

	/**
	 * return distance in (kilo)meters
	 */
	public function getDistance($mode, $latStart, $lngStart, $latDest, $lngDest) {

		$url 	= 'http://maps.googleapis.com/maps/api/directions/json?origin='
					.trim($latStart).','.trim($lngStart).'&destination='
					.trim($latDest).','.trim($lngDest).'&mode='.$mode.'&sensor=false&fields=routes(legs)';
		$json 	= @file_get_contents($url);
		$data 	= json_decode($json, true);
		$status = $data['status'];

		$result = array();
		if($status == "OK") {
			array_push($result, $data['routes'][0]['legs'][0]['distance']['text']);
			array_push($result, $data['routes'][0]['legs'][0]['start_address']);
			array_push($result, $data['routes'][0]['legs'][0]['end_address']);
			return $result;
		}
		else return false;
	}

	static public function checkLogged(Request $request) {
		$logged = false;
        /*get user logging*/
        $username = $request->getSession()->get(SecurityContext::LAST_USERNAME);
        if(!empty($username)) { $logged = true; }
        return $logged;
	}
}
