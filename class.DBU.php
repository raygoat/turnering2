<?php

class DBU {
	private $age;
	private $kreds;
	private $soapclient;

	public function __construct() {
		try {
			//Create the client object for the DBU WebService
			$this->soapclient = new SoapClient('http://webservice.dbu.dk/oldboys.asmx?WSDL');
		} catch (SoapFault $fault) {
			trigger_error("SOAP Fault: (faultcode: {$fault->getCode()}, faultstring: {$fault->getMessage()})", E_USER_ERROR);
		}
	}

	public function setAge( $age ) {
		$this->age = $age;
	}

	public function setKreds( $kreds ) {
		$this->kreds = $kreds;
	}

	public function getFixtures() {
		try {
			$params = array(
				'Alder' => $this->age,
				'KredsNummer' => $this->kreds
			);

			//Call the service
			$response = $this->soapclient->MatchProgram($params);
			return $response;

		} catch (SoapFault $fault) {
			trigger_error("SOAP Fault: (faultcode: {$fault->getCode()}, faultstring: {$fault->getMessage()})", E_USER_ERROR);
		}

	}

	public function getPositions() {
		try {
			//Setup the parameters to call the DBU webservice
			$params = array(
				'Alder' => $this->age,
				'KredsNummer' => $this->kreds
			);

			//Call the service
			$response = $this->soapclient->Position($params);
			return $response;

		} catch (SoapFault $fault) {
			trigger_error("SOAP Fault: (faultcode: {$fault->getCode()}, faultstring: {$fault->getMessage()})", E_USER_ERROR);
		}

	}

}