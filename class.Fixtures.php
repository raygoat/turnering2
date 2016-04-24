<?php

require_once 'class.DBU.php';
require_once 'class.Finals.php';

class Fixtures {

	private $kreds;
	private $age;
	private $fixtures = [];

	public function setKreds( $kreds ) {
		$this->kreds = $kreds;
	}

	public function setAge( $age ) {
		$this->age = $age;
	}

	public function showFixtures() {
		if( $this->kreds && $this->age ) {
			$DBU = new DBU();
			$DBU->setAge($this->age);
			$DBU->setKreds($this->kreds);
			$this->fixtures = $DBU->getFixtures();
			$this->formatFixtures();
		} else {
			echo "Parameters not correctly set!";
		}
	}

	private function formatFixtures() {
		echo "<table id='turnering_table'><thead><tr><th>Kampnr</th><th>Dato</th><th>Kl</th><th>Hjemmehold</th><th>Udehold</th><th class='turn-center'>Resultat</th><th>Spillested</th></thead>";

		foreach ($this->fixtures->MatchProgramResult->Match as $fixture) {
			echo "<tr>" .
			     "<td>" . $fixture->KampNr . "</td>" .
			     "<td>" . $this->formatDate( $fixture->Dato ) . "</td>" .
			     "<td>" . $fixture->Tid . "</td>" .
			     "<td>" . $this->formatHold( $fixture->HjemmeHold ) . "</td>" .
			     "<td>" . $this->formatHold( $fixture->UdeHold ) . "</td>" .
			     "<td class='turn-center'>" . $fixture->HjemmeScore . " - " . $fixture->UdeScore . "</td>" .
			     "<td>" . $this->formatStadion( $fixture->StadionNavn ) . "</td>" .
			     "</tr>";
		}
		echo "</table>";

		// Check if any final rounds exist and should be displayed
		$finals = new Finals();
		$finals->displayFinalRounds( $this->kreds );
	}

	/** Formatting helper functions **/

	private function formatDate( $dato ) {
		$dato = strtotime( substr( $dato, 0, 10) );
		return date( 'd-m-Y', $dato );
	}

	private function formatHold( $hold ) {
		global $oversidder;
		if( $hold == '' ) {
			$hold = '(oversidder)';
			$oversidder = true;
		} else {
			$oversidder = false;
		}
		return $hold;
	}

	private function formatStadion( $stadion ) {
		global $oversidder;
		if( $oversidder ) {
			$stadion = '';
		}
		return $stadion;
	}

}